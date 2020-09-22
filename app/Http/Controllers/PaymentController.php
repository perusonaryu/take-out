<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\User;
use App\Payment;

class PaymentController extends Controller
{
    //
    public function getCurrentPayment(){
        $user = Auth::user(); //要するにUser情報を取得したい
        $defaultCard = Payment::getDefaultcard($user);

        return $defaultCard;
        // return view('user.payment.index', compact('user', 'defaultCard'));

    }

    public function getPaymentForm(){




        $user = Auth::user(); //要するにUser情報を取得したい
        // return view('user.payment.form');

    }

    //フロントエンドから送信されてきたtokenを取得
    public function storePaymentInfo(Request $request){
        $token = $request->stripeToken;
        // dd($token);
        $user = Auth::user();//ユーザー情報を引っ張ってくる
        $ret = null;//??

        if ($token) {

            if (!$user->stripe_id) {
                $result = Payment::setCustomer($token, $user);
                if(!$result){
                    return ["error" => "カード登録に失敗しました。入力いただいた内容に相違がないかを確認いただき、問題ない場合は別のカードで登録を行ってみてください。１"];
                    // return redirect('/user/payment/form')->with('errors', $errors);
                }
                
            }else {
                    $defaultCard = Payment::getDefaultcard($user);
                    if (isset($defaultCard['id'])) {
                        Payment::deleteCard($user);
                    }
                    $result = Payment::updateCustomer($token, $user);

                /* card error */
                    if(!$result){
                        
                        // return redirect('/user/payment/form')->with('errors', $errors);
                        return ["error" => "カード登録に失敗しました。入力いただいた内容に相違がないかを確認いただき、問題ない場合は別のカードで登録を行ってみてください。2"];
                    }
                }
            }else {
                return ['errors' => '申し訳ありません、通信状況の良い場所で再度ご登録をしていただくか、しばらく立ってから再度登録を行ってみてください。'];
            }
        
        return ["success" => "カード情報の登録が完了しました。"];
    }

    public function deletePaymentInfo(){
        $user = User::find(Auth::id());

        $result = Payment::deleteCard($user);

        if($result){
            return ["success" => "カード情報の削除が完了しました。"];
        }else{
            return ['errors' => 'カード情報の削除に失敗しました。恐れ入りますが、通信状況の良い場所で再度お試しいただくか、しばらく経ってから再度お試しください。'];
        }
    }

}