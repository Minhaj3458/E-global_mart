<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Payment;
use App\Models\Settings;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;
use Auth;

class WalletController extends Controller
{
    public function index(Request $request)
    {
        $walletamount=User::select('wallet')->where('id',@Auth::user()->id)->first();

        $transaction_data=Transaction::select('order_number','transaction_type','wallet',\DB::raw('DATE_FORMAT(created_at, "%d-%m-%Y") as date'),'username')->where('user_id',@Auth::user()->id)->orderBy('id', 'DESC')->paginate(10);

        $paymentlist=Payment::where('status','1')
        ->where('payment_name','!=','COD')
        ->where('payment_name','!=','Wallet')
        ->get();

        return view('Front.wallet',compact('walletamount','transaction_data','paymentlist'));
    }

    public function recharge(Request $request)
    {

        $gettimezone=Settings::select('timezone')->first();

        date_default_timezone_set($gettimezone->timezone);

        try {
            //RazorPay : 3, Stripe : 4, Flutterwave : 5 , Paystack : 6

            if ($request->payment_type == 3 OR $request->payment_type == 5 OR $request->payment_type == 6) {
                $payment_id = $request->payment_id;
            }

            if ($request->payment_type == 4) {
                $getstripe=Payment::select('environment','test_secret_key','live_secret_key')->where('payment_name','Stripe')->first();

                if ($getstripe->environment == "1") {
                    $skey = $getstripe->test_secret_key;
                } else {
                    $skey = $getstripe->live_secret_key;
                }

                Stripe::setApiKey($skey);

                $customer = Customer::create(array(
                    'email' => Auth::user()->email,
                    'source' => $request->stripeToken,
                    'name' => Auth::user()->full_name,
                ));

                $charge = Charge::create(array(
                    'customer' => $customer->id,
                    'amount' => $request->recharge_amount*100,
                    'currency' => 'usd',
                    'description' => 'eCommerce',
                ));

                $payment_id = $charge['id'];
            }

            $wallet = new Transaction;
            $wallet->user_id = Auth::user()->id;
            $wallet->order_id = null;
            $wallet->order_number = null;
            $wallet->wallet = $request->recharge_amount;
            $wallet->payment_id = $payment_id;
            $wallet->transaction_type = '4';
            $wallet->username = Auth::user()->name;
            $wallet->type = $request->payment_type;
            $wallet->save();

            $updatewallet = Auth::user()->wallet + $request->recharge_amount;

            $UpdateWalletDetails = User::where('id', Auth::user()->id)
            ->update(['wallet' => $updatewallet]);

            return response()->json(['status'=>1,'message'=>'Recharge success'],200);

        } catch (Exception $e) {
            return response()->json(['status'=>0,'message'=>'Error'.$e],200);
        }
    }
}
