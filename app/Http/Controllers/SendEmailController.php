<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Storage;
use Milon\Barcode\DNS1D;
use Session;

class SendEmailController extends Controller
{
    public function index()
    {
        return view('send_email');
    }

    public function send(Request $request)
    {

        //        $this->validate($request, [
//            'name' => 'required',
//            'email' => 'required|email',
//            'message'=>'required'
//        ]);

        $to_name = $request->name;
        $to_email = $request->email;

        $data= array(
            'name'=>$request->name,
            'email'=>$request->email,
            'message'=>$request->message
        );

//        $data = array('invdetail' => $invdetail, 'clientinfo' => $clientinfo, 'id' => $argOrderID, 'sales' => 12);


//        Mail::send('orders::pdf', ['data' => $data], function ($message) use ($data) {
//            $message->to($data['invdetail']->email, 'Order Committed');
//            $message->subject($data['clientinfo']->company_name.' received your Order');
//            $message->cc($data['clientinfo']->email);
//            $message->from('sandip.sathavara@gmail.com', 'WIMS');
//            $message->attach(public_path() . "/assets/invoice/#" . $data['invdetail']->invoice_no . ".pdf");
//        });
       // \Storage::disk('public')->put('test.png',DNS1D::getBarcodePNGPath("767647", "QRCODE"));
        Mail::send('dynamic_email_template', ['data'=>$data], function ($message) use ($data) {
        $message->to($data['email'], $data['name'])->subject('Appointment Notification');
        $message->from('dhruvsutail338@gmail.com', 'AppointFix');
        $message->attach(public_path()."/Images/AppointBarcode.png");
        });

        return redirect('sendemail')->with('success','Thanks for Contacting !!');

    }
}
