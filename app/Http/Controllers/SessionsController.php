<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

use Mail;

use App\Session;
use Auth;
use DB;

class SessionsController extends Controller
{
    public function __construct() {
      $this->middleware('auth');
    }
    
    public function index(Request $request){

        $data['sub_heading']  = 'Sessions';
        $data['page_title']   = 'Super Quiz Sessions';
        $data['sessions']     =  Session::paginate(120);
        return view('sessions.index', $data);
    }

    public function status_update(Request $request,$id){

      //SELECT * FROM `table` WHERE active=0 AND CURDATE() between dateStart and dateEnd

      $current_date   = date('Y-m-d');
   
      $check_date     = DB::table('sessions')
          ->where('start_date','<=',$current_date)
          ->where('end_date','>=',$current_date)
          ->where('id','=',$id)->count();

     if($check_date==0){

       $request->session()->flash('error_message', 'Current date is not between start and end date!');
       return redirect('sessions');

     }else{

      DB::table('sessions')->where('status', 'active')->update(array('status' => 'inactive'));
      DB::table('sessions')->where('id', $id)->update(array('status' => 'active'));
      $request->session()->flash('message', 'session updated successfully!');
      return redirect('sessions');
      }
     
    }

    public function isdateExist(Request $request) {
      $startdate            = $request->startdate;
      $startdate            = date('Y-m-d',strtotime($startdate));
      $exist                = false;
      $user                 = Session::where('end_date','>=' ,$startdate)->first();
        if($user){
          $exist        = true;
        }
     
      return Response::json(['exist'=> $exist]);
    }

    public function store(Request $request){
        $sess            = new Session;
         $this->validate($request, [
            'start_date'=>'required',
            'end_date'=>'required'
        ]); 

        $sess->start_date       = date('Y-m-d',strtotime($request->start_date));
        $sess->end_date         = date('Y-m-d',strtotime($request->end_date));
      
        $saved          = $sess->save(); 
        if ($saved) {
         $request->session()->flash('message', 'Session successfully added!');
         return redirect('sessions');
        } else {
         return redirect()->back()->with('message', 'Couldn\'t create Session!');
        } 

    }


}
