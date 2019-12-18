<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;


use App\Question;
use App\Category;
use App\JobsTable;
use App\Level;
use Auth;

//Enables us to output flash messaging
use Session;

class JobsController extends Controller
{
    public function __construct() {
//      $this->middleware('auth');
    }
    
    public function index(Request $request){

        $data['sub_heading']  = 'Jobs';
        $data['page_title']   = 'Job Categorie\'s';
        $categories           = Category::orderBy('category','ASC')->get();

        /*------------ create cat arr -------------*/
        $catarr = array();
        $catdata = array();
        foreach($categories as $category){
            $countres  = JobsTable::where("category_id", $category->id)->get();
            $catarr[count($countres)] = $category->category;
            $catdata[$category->id] = $catarr;
            unset($catarr);
        }
        /*------------ create cat arr -------------*/
        $data['catdata']   = $catdata;
        return view('jobs', $data);
    }

    public function catjobs(Request $request, $id){

        $data['sub_heading']  = 'Jobs';
        $data['page_title']   = 'All job\'s in';
        $data['jobslist']     = JobsTable::where("category_id", $id)->orderBy('id','ASC')->get();
        $cat_name             = Category::find($id);
        $data['jobcat']   = $cat_name->category;

        return view('jobs', $data);
    }

    public function jobdetail(Request $request, $id){

        $data['sub_heading']  = 'Job Detail';
        $data['page_title']   = 'Job detail page';
        $data['jobres']       = JobsTable::find($id);

        return view('jobs_detail', $data);
    }

    public function search(Request $request){

        $data['sub_heading']  = 'Job Detail';
        $data['page_title']   = 'Job detail page';
        $data['what']       = $request->what;
        $data['where']       = $request->where;
        $data['_token']       = $request->_token;

        $jobres       = JobsTable::where("where", $request->where)->Where("job_title", "LIKE", "%{$request->what}%")->get();
        $resdata = "";
        $resdata .= '<h4>Search Result List</h4><hr width="100%" />';
        if(count($jobres) > 0) {
            foreach($jobres as $v) {
                $resdata .= "<p><a href='/jobdetail/".$v->id."'>" . $v->job_title ."</a><p />";
            }
        } else {
            $resdata .= "<p> No result Found !!!<p />";
        }


        return $resdata;
    }

     public function store(Request $request){
        $questions = new Question;
         $this->validate($request, [
            'question'=>'required',
            'answer'=>'required',
            'level'=>'required',
            'category'=>'required',

        ]);
        $questions->question    = $request->question;
        $questions->answer      = $request->answer;
        $questions->level_id    = $request->level;
        $questions->category_id = $request->category;
        $saved                  = $questions->save();
        if ($saved) {
         return redirect()->back()->with('message', 'Question successfully added!');
        } else {
         return redirect()->back()->with('message', 'Couldn\'t create Category!');
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
