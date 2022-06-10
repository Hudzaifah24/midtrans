<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function index(Request $request)
    {
        $datas = Order::all();

        return view('index', [
            'datas' => $datas
        ]);
    }

    public function payment(Request $request)
    {
        $firstName = $request->first_name;
        $lastName= $request->last_name;
        $email = $request->email;
        $phone = $request->phone;

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => 30000,
            ),
            'item_details' => array(
                [
                    'id' => 'a01',
                    'price' => 7000,
                    'quantity' => 2,
                    'name' => 'Apple',
                ],
                // [
                //     'id' => 'a02',
                //     'price' => 8000,
                //     'quantity' => 2,
                //     'name' => 'orange',
                // ]
            ),
            'customer_details' => array(
                'first_name' => $firstName,
                'last_name' => $lastName,
                'email' => $email,
                'phone' => $phone,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        return view('payment', [
            'snapToken' => $snapToken,
            'name' => $firstName.' '.$lastName,
            'email' => $email,
            'phone' => $phone,
        ]);
    }

    public function paymentPost(Request $req)
    {
        // return $req->all();

        $json = json_decode($req->get('json'));

        $order = Order::create([
            'name' => $req->get('name'),
            'email' => $req->get('email'),
            'phone' => $req->get('phone'),
            'status_code' => $json->status_code,
            'status_transaction' => $json->transaction_status,
            'transaction_id' => $json->transaction_id,
            'order_id' => $json->order_id,
            'gross_amount' => $json->gross_amount,
            'payment_type' => $json->payment_type,
            'payment_code' => isset($json->payment_code) ? $json->payment_code : null,
            'pdf_url' => isset($json->pdf_url) ? $json->pdf_url : null,
        ]);

        return $order ? redirect('/')->with('alert-success', 'Order Berhasil Dibuat') : redirect('/')->with('alert-failed', 'Terjadi Kesalahan');
    }
}
