<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Input;
use Razorpay\Api\Api;
use Session;
use Redirect;
use DB;

class RazorpayController extends Controller
{    
    public function payWithRazorpay($student_id)
    {        
        $result = DB::table('cart')->where('student_id',$student_id)->select('cart.*')->get();
       
        return view('payWithRazorpay',['result'=>$result]);
    }

    public function payment(Request $request)
    {
        //Input items of form
        $input = \Request::all();

        //get API Configuration 
        $api = new Api(config('custom.razor_key'), config('custom.razor_secret'));
        //Fetch payment information by razorpay_payment_id
        $payment = $api->payment->fetch($input['razorpay_payment_id']);

        if(count($input)  && !empty($input['razorpay_payment_id'])) {
            try {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>$payment['amount'])); 

            } catch (\Exception $e) {
                return  $e->getMessage();
                \Session::put('error',$e->getMessage());
                return redirect()->back();
            }

            // Do something here for store payment details in database...
        }
                 $record['item_id'] = $request->post('item_id');
                $record['student_id'] = $request->post('student_id');
                $record['item_name'] = $request->post('item_name');
                $record['quantity'] = $request->post('quantity');
                $record['size'] = $request->post('size');
               
                $record['color'] = $request->post('color');
                $record['price'] = $request->post('price');
                $record['bookbyclass'] = $request->post('bookbyclass');
                $record['publisher'] = $request->post('publisher');
                $record['setofbooks'] = $request->post('setofbooks');
                $record['status'] = "success";
                $record['razorpay_payment_id'] = $input['razorpay_payment_id'];

        $data = DB::table('payment_history')->insert($record);
        
        \Session::put('success', 'Payment successful, your order will be despatched in the next 48 hours.');
        return redirect()->back();
    }
}