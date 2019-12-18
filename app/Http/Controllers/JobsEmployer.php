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
use Validator;

//Enables us to output flash messaging
use Session;

class JobsEmployer extends Controller
{
    public function __construct() {
      $this->middleware('employer');
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

    public function emp_c_j(Request $request){

        $this->validate($request, [

            'page_title'=>'required',
            'content'=>'required',
            'cat_id'=>'required',
            'where'=>'required'

        ]);

        if(!empty($request->page_id)){

            $rules              = JobsTable::find($request->page_id);
            $rules->job_title  = $request->page_title;
            $rules->job_desc     = $request->content;
            $rules->category_id  = $request->cat_id;
            $rules->where         = $request->where;
            $rules->user_id       = Auth::user()->id;
            $saved              = $rules->save();
            if ($saved) {
                $request->session()->flash('message', 'Page has been successful edited!');
                return redirect('employer_listing');
            } else {
                return redirect()->back()->with('error', 'Error while edit the page');
            }
        }else{

            $rules              = new JobsTable;
            $rules->job_title  = $request->page_title;
            $rules->job_desc     = $request->content;
            $rules->category_id  = $request->cat_id;
            $rules->where         = $request->where;
            $rules->user_id       = Auth::user()->id;
            $saved              = $rules->save();
            if ($saved) {
                $request->session()->flash('message', 'Page successfully added!');
                return redirect('employer_listing');
            } else {
                return redirect()->back()->with('message', 'Couldn\'t create Page!');
            }
        }



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
