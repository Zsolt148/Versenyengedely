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

    public function __construct(WebhookCall $webhookCall)
    {
        $this->webhookCall = $webhookCall;
    }

    public function handle()
    {
        $event = $this->webhookCall;
        $session = $event->payload['data']['object'];

        //Log::info(json_encode($event));
        //Log::info(json_encode($session));

        switch ($event->payload['type']) {
            case 'checkout.session.completed':

                foreach($session['metadata'] as $key => $id) {
                    $form = Form::find($id);
                    $form->payment = 'pending';
                    $form->save();
                }

                if($session['payment_status'] == 'paid') {
                    $this->completePayment($session);
                }

                break;

            case 'checkout.session.async_payment_succeeded':

                $this->completePayment($session);

                break;

            case 'checkout.session.async_payment_failed':

                foreach($session['metadata'] as $key => $id) {
                    $form = Form::find($id);
                    $form->payment = 'none';
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

    protected function completePayment($session) {

        $user = User::find($session['client_reference_id']);
        $address = $user->address; //address model

        //vevo adatok
        $buyer = new Buyer([
            'name' => $address->name,
            'address' => $address->zip . ' ' . $address->address,
            'code' => $address->tax_id,
            'custom_fields' => [
                'email' => $user->email,
            ],
        ]);

        $payment = Payment::create([
            'users_id' => $user->id,
            'teams_id' => $user->team->id,
            'stripe_id' => $session['payment_intent'],
            'amount_subtotal' => $session['amount_subtotal'],
            'amount_total' => $session['amount_total'],
        ]);

        $items = [];
        foreach($session['metadata'] as $key => $id) {
            //Form done
            $form = Form::find($id);
            $form->payment = 'done';
            $form->payment_id = $payment->id;
            $form->save();
            //versenyengedely
            createLicenseJob::dispatch($form); //license create
            //invoice
            $name = ($form->title ? $form->title . ' ' : '') . $form->vnev . ' ' . $form->knev;
            array_push($items, (new InvoiceItem())->title($name)->pricePerUnit(1000)->quantity(1));
        }


        $invoice = Invoice::make('Számla')
            ->buyer($buyer)
            ->sequence($payment->id)
            ->addItems($items)
            ->filename('számla_' . now()->format('Y') . '_' . str_pad($payment->id, 5, '0', STR_PAD_LEFT))
            ->save('invoice');

        $payment->invoice = $invoice->filename;
        $payment->save();

        Mail::to($user)->queue(new SuccessfulPayment($invoice->filename)); // Mail with invoice
    }
}
