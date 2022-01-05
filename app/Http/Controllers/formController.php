<?php

namespace App\Http\Controllers;

use App\Models\Form;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;

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

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function cart() {
        return view('coach.forms.cart');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function checkout(Request $request) {

        $selectedForms = $request->post('selected');
        $forms = array();

        if(!empty($selectedForms)) {
            $items = array();
            $ids = array();
            foreach ($selectedForms as $key => $value) {
                $form = Form::findOrFail($value);
                $forms[] = $form;
                $items[] = [
                    'price_data' => [
                        'currency' => 'huf',
                        'unit_amount' => $form->payments->isEmpty() ? 300000 : 150000,
                        'product_data' => [
                            "name" => ($form->title ? $form->title . ' ' : '') . $form->vnev . ' ' . $form->knev,
                            "metadata" => [
                                "forms_id" => $form->id,
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

            $session = Session::create([
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

        $session = Session::retrieve(request()->get('session_id'));

        foreach($session->metadata->values() as $key => $id) {
            $form = Form::find($id);
            $form->payment = Form::PAYMENT_PENDING;
            $form->save();
        }

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

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function licences() {
        return view('coach.licences');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function payments() {
        return view('coach.payments');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Form $form
     * @return \Illuminate\Http\Response
     */
    public function show(Form $form) {

        abort_if(request()->user()->cannot('view', $form), 403);

        return view('coach.forms.show', compact('form'));
    }
}
