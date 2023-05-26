<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    public function createPayment(Request $request){
        // Lấy thông tin từ PayPal và lưu vào biến
        $paymentId = $request->input('paymentID');
        $payerId = $request->input('payerID');
        $payerEmail = $request->input('payerEmail');
        $amount = $request->input('amount');
        $currency = $request->input('currency');
        $paymentStatus = $request->input('paymentStatus');

        // Lưu thông tin thanh toán vào cơ sở dữ liệu
        $payment = new Payment();
        $payment->payment_id = $paymentId;
        $payment->payer_id = $payerId;
        $payment->payer_email = $payerEmail;
        $payment->amount = $amount;
        $payment->currency = $currency;
        $payment->payment_status = $paymentStatus;
        $payment->save();

        // Thực hiện các hành động khác (nếu cần)
        // ...

        return response()->json([
            'message' => 'Payment captured and saved successfully.', 
            'data' => $request->input()]);
    }
}
