<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\User;
use App\Payment;

class UserPaymentController extends Controller
{
    public function getUserInfo(){
        $user = Auth::user();
        $defaultCard = Payment::getDefaultcard($user);

        return view('user.index', compact('user', 'defaultCard'));
    }

    public function itemPaid(Request $request ){
        // dd($request->price);
        \Stripe\Stripe::setApiKey(\Config::get('payment.stripe_secret_key'));
        
        try {
            $user = User::find(Auth::id());
            $chargeOject = [
                'amount'      => $request->price,
                'currency'    => 'jpy',
                'description' => 'ユーザー：'.$user->name."、商品購入",
                'customer'      => $user->stripe_id,
            ];

            $charge = \Stripe\Charge::create($chargeOject);

        } catch (\Stripe\Exception\CardException $e) {
            $body = $e->getJsonBody();
            $errors  = $body['error'];

            return ['errors', "決済に失敗しました。しばらく経ってから再度お試しください。"];
        }

        // $user->status = 1;
        // $user->save();

        return ['success', "商品購入が完了しました。"];
    }
}
