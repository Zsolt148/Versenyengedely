<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use LaravelDaily\Invoices\Invoice;
use Stripe\Checkout\Session;
use Stripe\TaxRate;

class formController extends Controller
{
    public function __construct() {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('coach.forms.index');
    }

    public function cart() {
        return view('coach.forms.cart');
    }

    public function checkout(Request $request) {
        $selectedForms = $request->get('selected');
        $forms = array();

        if(!empty($selectedForms)) {
            $items = array();
            $ids = array();
            foreach ($selectedForms as $key => $value) {
                $form = Form::find($value);
                $forms[] = $form;
                $items[] =
                    [
                        'price_data' => [
                            'currency' => 'huf',
                            'unit_amount' => 300000,
                            'product_data' => [
                                "name" => ($form->title ? $form->title . ' ' : '') . $form->vnev . ' ' . $form->knev,
                                "metadata" => [
                                    "forms_id" => $form->id,
                                    "test" => "test"
                                ],
                            ],
                        ],
                        'description' => ($form->title ? $form->title . ' ' : '') . $form->vnev . ' ' . $form->knev,
                        'quantity' => 1,
                        //'metadata' => ["forms_id" => $form->id],
                        //'tax_rates' => [$tax_rate->id],
                    ];
                $ids[] = $form->id;
            }

            $session = \Stripe\Checkout\Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [$items],
                'metadata' => $ids,
                'mode' => 'payment',
                'client_reference_id' => request()->user()->id,
                'locale' => 'hu',
                'success_url' => url('coach/forms/success' . '?session_id={CHECKOUT_SESSION_ID}'),
                'cancel_url' => route('coach.forms.cart'),
            ]);
        }else {
            $session = null;
        }

        return view('coach.forms.checkout', compact('session', 'forms'));
    }

    public function success() {
        $session = \Stripe\Checkout\Session::retrieve(request()->get('session_id'));

        foreach($session->metadata->values() as $key => $id) {
            $form = Form::find($id);
            $form->payment = 'pending';
            $form->save();
        }

        //$event = $events->autoPagingIterator();

        //$pay = $events->data->object;
        //$stripe = new \Stripe\StripeClient("sk_test_51IDWHqDMnzdEZBuny2E7pLLTSM6vv7OH7fqNr5NyCN7k9bCJRIa5RmPkn00t5jbGwkptaq9bxISLLNOk1g2S2pZU00IBbv9AXM");
        //$line_items = $stripe->checkout->sessions->allLineItems($pay->id);

        return redirect()->route('coach.forms.index')->with('success', 'success');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('coach.forms.create');
    }

    public function licences() {
        return view('coach.licences');
    }

    public function payments() {
        return view('coach.payments');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Form $form
     * @return \Illuminate\Http\Response
     */
    public function show(Form $form) {
        if (request()->user()->cannot('view', $form)) {
            abort(403);
        }
        return view('coach.forms.show', compact('form'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Form $form
     * @return \Illuminate\Http\Response
     */
    public function edit(Form $form) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Form $form
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Form $form) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Form $form
     * @return \Illuminate\Http\Response
     */
    public function destroy(Form $form) {
        //
    }
}
