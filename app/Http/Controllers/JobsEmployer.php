<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;


use App\Question;
use App\Category;
use App\JobsTable;
use App\CreateLocationTable;
use Auth;

//Enables us to output flash messaging
use Session;

class JobsEmployer extends Controller
{
    public function __construct() {
//      $this->middleware('employer');
    }
    
    public function index(Request $request){

        $data['sub_heading']  = 'Job Detail';
        $data['page_title']   = 'Job detail page';

        return view('privateuser.employer_home', $data);
    }

    public function employer_listing(Request $request){

        $data['sub_heading']  = 'Job Detail';
        $data['page_title']   = 'Job detail page';
        $data['Jobs']         = JobsTable::where("user_id", Auth::user()->id)->orderBy('id','ASC')->get();

        return view('privateuser.employer_listing', $data);
    }

    public function create_job(Request $request){

        $data['sub_heading']  = 'Job Post';
        $data['page_title']   = 'Job Post';
        $data['catres']        =  Category::paginate(100);
        $data['locres']        =  CreateLocationTable::paginate(100);

        return view('privateuser.employer_create_job', $data);
    }
    public function create(){
        //
    }

    public function show($id){
        //
    }

    public function edit($id){
        //
    }



}
