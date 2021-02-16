<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Barcode;
use Illuminate\Http\Request;
use App\Model\Appointments;
use Illuminate\Support\Facades\Mail;
use Session;
use DB;
use Storage;
use Milon\Barcode\DNS2D;
use getBarcodePNG;
use Illuminate\Support\Facades\Input;
use Picqer;

class AppointmentsController extends Controller
{
    public function Appointments()
    {
        $department=DB::table('departments')->groupBy('department')->get()->toArray();
        //dd($department);
        //return view('admin.Appointment')->with('department',$department);
        $appoint = Appointments::all();
        return view('admin.Appointment',compact('department','appoint'));



    }
    /*public function detail()
    {
        $department=DB::table('departments')->groupBy('department')->get();
        return view('admin.Appointment')->with('department',$department);
    }*/
    public function fetch(Request $request)
    {
        $select = $request->get('select');
        $value = $request->get('value');
        $dependent = $request->get('dependent');
        $data = DB::table('departments')
            ->where($select, $value)
            ->groupBy($dependent)
            ->get();
        $output = '<option value="">Select '.ucfirst($dependent).'</option>';
        foreach($data as $row)
        {
            $output .= '<option value="'.$row->$dependent.'">'.$row->$dependent.'</option>';
        }
        echo $output;
    }
    public function store(Request $request)
    {
        $appoint = new Appointments();

        $appoint->civil_id = $request->input('civil_id');
        $appoint->client_name = $request->input('client_name');
        $appoint->phone = $request->input('phone');
        $appoint->department = $request->input('department');
        $appoint->sub_department = $request->input('sub_department');
        $appoint->date = $request->input('date');
        $appoint->email = $request->input('email');

        $obj = new DNS2D();
        $image = $obj->getBarcodePNG( $appoint->civil_id, "PDF417");
//        $image= Barcode::generateBarcode($appoint->civil_id);
//        $image = DNS2D::getBarcodePNG($appoint->civil_id, "PDF417");
        Storage::disk('public')->put('AppointmentBarcode.png',base64_decode($image));

        $to_name = $request->name;
        $to_email = $request->email;

        $data= array(
            'client_name'=>$request->client_name,
            'civil_id'=> $request->civil_id,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'department'=>$request->department,
            'sub_department'=>$request->sub_department,
            'date'=>$request->date

        );

        $a=DB::select('select  max_appoint from departments where sub_department=?',[$appoint->sub_department]);
        $b=$a[0]->max_appoint;
        $c=DB::select('select count(sub_department) as department from _appoitments where sub_department=? and date=?',[$appoint->sub_department,$appoint->date]);
        $d=$c[0]->department;

        if($b>$d)
        {

            $appoint->save();
            Mail::send('dynamic_email_template', ['data'=>$data], function ($message) use ($data) {
                $message->to($data['email'], $data['client_name'])->subject('Appointment Notification');
                $message->from('dhruvsutail338@gmail.com', 'AppointFix');
                $message->attach(public_path()."/Images/AppointmentBarcode.png" );
            });
            Session::flash('statuscode','success');
            return redirect('/Appointment')->with('status','New Appointment Added');

        }
        else
        {
            Session::flash('statuscode','error');
            return redirect('/Appointment')->with('status','Appointment Slot Full');
        }



    }

    public function edit($id)
    {
        $appoint = Appointments::findorFail($id);
        return view('admin.Appointments.edit')->with('appoint',$appoint);
    }

    public function update(Request $request, $id)
    {
        $appoint = Appointments::findorFail($id);
        $appoint->civil_id = $request->input('civil_id');
        $appoint->client_name = $request->input('client_name');
        $appoint->phone = $request->input('phone');
        $appoint->department = $request->input('department');
        $appoint->sub_department = $request->input('sub_department');
        $appoint->date = $request->input('date');
        $appoint->email = $request->input('email');
        $appoint->update();

        Session::flash('statuscode','info');
        return redirect('Appointment')->with('status','Appointment Updated');
    }

    public function delete($id)
    {
        $appoint = Appointments::findorFail($id);
        $appoint->delete();

        Session::flash('statuscode','warning');
        return redirect('Appointment')->with('status','Appointment Deleted');
    }
    public function index()
    {
        return view('delete_appoint');
    }

    /*public function barcode()
    {
        $appoint = Appointments::all();
        return view('home')->with('appoint',$appoint);
    }*/
}
