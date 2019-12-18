<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;


use App\User_question;
use Auth;
use DB;
use Session;


class ReportsController extends Controller
{
    public function __construct() {
      $this->middleware('auth');
    }
    
    public function index(Request $request){
     
        $data['sub_heading']  = 'Reports';

        $data['page_title']   = 'Super Quiz Reports';
        $where='';

         $data['sessions'] = DB::table('sessions')->get();

        if(!isset($request->sessiondate)){
          $active_session = DB::table('sessions')->where('status','active')->pluck('id');
          $active_session = $active_session[0];
          }else{
           $active_session = $request->sessiondate;
          }
          Session::put('active_session', $active_session);

        if(isset($request->startDate) && isset($request->endDate)){
          $start_date= date('Y-m-d',strtotime($request->startDate));
          $end_Date= date('Y-m-d',strtotime($request->endDate));
          $data['start_date'] = $request->startDate;
          $data['end_Date'] = $request->endDate;

          $data['reports'] = DB::table('user_questions')
            ->join("users", 'users.id', '=', 'user_questions.user_id')
            ->join('user_experience_points', 'user_questions.user_id', '=' , 'user_experience_points.user_id')
            ->select('users.id', 'users.username','user_questions.user_id','user_questions.is_correct','user_questions.created_at','user_questions.level_id','user_experience_points.user_level', DB::raw("count(user_questions.level_id) as ranking"))
            ->where('user_questions.created_at', '>=', $start_date)
            ->where('user_questions.created_at', '<=', $end_Date)
            ->where('user_questions.is_correct', '=',1)
            ->where('user_questions.is_correct', '=',1)
            ->where('user_questions.session_id','=',$active_session)
            ->groupBy('user_questions.user_id')
            ->orderBy('ranking','DESC')
            ->take(100)
            ->get();
          $point_array      = array();

                    

          foreach ($data['reports'] as $reg) {

            $single_point = DB::table('user_questions')
                ->where('created_at', '>=', $start_date)
                ->where('created_at', '<=', $end_Date)
                ->where('is_correct', '=',1)
                ->where('session_id','=',$active_session)
                ->where('user_id', '=',$reg->id)->get();
            $regular_points=0;

                foreach ($single_point as $single) {
                    if($single->level_id==1){
                      $regular_points = $regular_points+1;
                    }else if($single->level_id==2){
                      $regular_points = $regular_points+2;
                    }else if($single->level_id==3){
                      $regular_points = $regular_points+3;
                    }
                }

            $point_array[$reg->user_id]  = $regular_points;
          }
          $data["regular_points"] = $point_array;

          Session::put('start_date', $start_date);
          Session::put('end_Date', $end_Date);
          return view('reports.date_vs_report', $data);

          
          }else{
        
          $users = DB::table('user_questions')
            ->leftJoin('users', 'users.id', '=', 'user_questions.user_id')
            ->leftJoin('regular_points', 'users.id', '=', 'regular_points.user_id')
            ->leftJoin('user_experience_points', 'user_questions.user_id', '=' , 'user_experience_points.user_id')
            ->leftJoin('super_points', 'users.id', '=', 'super_points.user_id')
            ->select('users.id','users.username', 'user_questions.user_id', 'user_questions.created_at','user_questions.is_correct','regular_points.regular_point','user_experience_points.user_level','super_points.superpoint');
          if(isset($request->startDate) && isset($request->endDate)){
            $users->where('user_questions.created_at', '>=', $start_date);
            $users->where('user_questions.created_at', '<=', $end_Date);
            

          }
          if(!isset($request->sessiondate)){
            $users->where('user_questions.session_id','=',$active_session);
          }else if(isset($request->sessiondate)){
            $users->where('user_questions.session_id','=',$active_session);
          }
         

          $users->groupBy('users.id')->orderBy('regular_points.regular_point', 'desc');

          
          $data['reports']  = $users->paginate(100); 

         
         
           
            
        return view('reports.index', $data);

          }

    }


}