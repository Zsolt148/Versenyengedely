<?php

namespace App\Jobs\StripeWebhooks;

use App\Jobs\createLicenseJob;
use App\Mail\FailedPayment;
use App\Mail\SuccessfulPayment;
use App\Models\Form;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use LaravelDaily\Invoices\Invoice;
use Spatie\WebhookClient\Models\WebhookCall;

class CheckoutSessionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var \Spatie\WebhookClient\Models\WebhookCall */
    public $webhookCall;

    /**
     * CheckoutSessionJob constructor.
     * @param WebhookCall $webhookCall
     */
    public function __construct(WebhookCall $webhookCall)
    {
        $this->webhookCall = $webhookCall;
    }

    /**
     * A webhookot feldolgozasa
     */
    public function handle()
    {
        $event = $this->webhookCall;
        $session = $event->payload['data']['object'];

        //Log::info(json_encode($event));
        //Log::info(json_encode($session));

        switch ($event->payload['type']) {

            case 'checkout.session.completed':
            case 'checkout.session.async_payment_succeeded':

                $check = false;
                foreach($session['metadata'] as $key => $id) {
                    $form = Form::find($id);
                    if($form->payment == 'pending') {
                        $check = true;
                    }
                }

                if($session['payment_status'] == 'paid') {
                    if($check) $this->completePayment($session);
                }

                break;

            case 'checkout.session.async_payment_failed':

                foreach($session['metadata'] as $key => $id) {
                    $form = Form::find($id);
                    $form->payment = null;
                    $form->save();
                }

                $user = User::find($session['client_reference_id']);

                Mail::to($user)->queue(new FailedPayment());

                break;

            default:
                //
            break;
        }

        // do your work here

        // you can access the payload of the webhook call with `$this->webhookCall->payload`
    }

    /**
     * Fizetes veglegesitese
     * @param $session
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function completePayment($session) {

        //Fizeto adatai
        $user = User::find($session['client_reference_id']);
        $address = $user->address; //address model

        //Fizeto = vevo adatok
        $buyer = new Buyer([
            'name' => $address->name,
            'address' => $address->zip . ' ' . $address->address,
            'code' => $address->tax_id,
            'custom_fields' => [
                'email' => $user->email,
            ],
        ]);

        //Egy darab Payment letrehozasa a vevo es a stripe adatokkal
        $payment = Payment::create([
            'users_id' => $user->id,
            'teams_id' => $user->team->id,
            'stripe_id' => $session['payment_intent'],
            'amount_subtotal' => $session['amount_subtotal'],
            'amount_total' => $session['amount_total'],
        ]);

        $items = [];
        //fizetett engedelyeken vegig foreach
        foreach($session['metadata'] as $key => $id) {
            //Form done
            $form = Form::find($id);
            $form->payment = 'done';
            //payment-hez csatolas
            $form->payments()->attach($payment->id);
            $form->save();
            //versenyengedely keszitese
            createLicenseJob::dispatch($form); //license create
            //bizonylat teteleinek elkeszitese
            $name = ($form->title ? $form->title . ' ' : '') . $form->vnev . ' ' . $form->knev;
            $items[] = (new InvoiceItem())
                ->title($name)
                ->pricePerUnit($form->payments->isEmpty() ? 3000 : 1500)
                ->quantity(1);
        }

        //bizonylat letrehozasa
        $receipt = Invoice::make('Befizetési Bizonlyat')
            ->buyer($buyer)
            ->sequence($payment->id)
            ->addItems($items)
            ->filename('receipt_' . now()->format('Y') . '_' . str_pad($payment->id, 5, '0', STR_PAD_LEFT))
            ->save('receipt');

        //bizonylat payment hez csatolasa
        $payment->receipt = $receipt->filename;
        $payment->save();

        //email a sikeres befizetesrol a bizonylattal egyutt
        Mail::to($user)->queue(new SuccessfulPayment($receipt->filename));
    }
}
