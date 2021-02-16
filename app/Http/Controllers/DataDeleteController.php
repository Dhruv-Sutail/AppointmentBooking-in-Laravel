<?php

namespace App\Http\Controllers;

use App\Model\Appointments;
use Illuminate\Http\Request;
use Session;
use DB;

class DataDeleteController extends Controller
{
    public function delete(Request $request)
    {

        $a=$request->input('civil_id');
        $b=DB::delete('delete from _appoitments where civil_id=?',[$a]);
        if($b==1)
        {
            Session::flash('statuscode','warning');
            return redirect('user-delete')->with('status','Appointment Deleted');
        }
        else
            {
                Session::flash('statuscode','error');
                return redirect('user-delete')->with('status','No Appointment Found with this Civil ID');
        }

        /*$file = Input::file(DNS2D::getBarcodeHTML(335553, 'QRCODE'));
        $file->move(public_path().'/Images/',$user->civil_id.'.png');*/

    }
}
