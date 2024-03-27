<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Creagia\Redsys\Enums\PayMethod;
use App\Models\Order;
use Creagia\LaravelRedsys\Request as RedsysRequest;
use Creagia\LaravelRedsys\RedsysRequestStatus;

class OrderController extends Controller
{
    public function pay(Request $request, $code)
    {
        $order = Order::get()->where('code', $code)->first();
        if (empty($order)) {
            return abort(404);
        } elseif ($order->is_paid) {
            return view('already-paid', compact('order'));
        }
        
        $redsysRequest = $order->createRedsysRequest(
            productDescription: $order->title,
            payMethod: PayMethod::Card,
        );

        return $redsysRequest->redirect();
    }

    public function status(Request $request, $uuid)
    {
        $payment = RedsysRequest::get()->where('uuid', $uuid)->first();
        if (empty($payment)) {
            return abort(404);
        } elseif ($payment->status == RedsysRequestStatus::Paid->value) {
            return view('success', compact('payment'));
        } else {
            return view('failure', compact('payment'));
        }
    }
}
