<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;


use App\Question;
use App\Category;
use App\Level;
use Auth;

//Enables us to output flash messaging
use Session;

class QuestionsController extends Controller
{
    public function __construct() {
      $this->middleware('auth');
    }
    
    public function index(Request $request){

        

        $data['sub_heading']  = 'Questions';
        $data['page_title']   = 'Super Quiz Questions';
        $data['questions']    = Question::with(['category','level'])->orderBy('id', 'ASC')->paginate(100);
        $levels               = Level::orderBy('id','ASC')->get();
        $data['levels']       = $levels;
        $categories           = Category::orderBy('category','ASC')->get();
        $data['categories']   = $categories;
        return view('questions.index', $data);
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

     public function getQuestion($id){
        $data               = [];       
        $questions          = Question::find($id);
        $data['questions']  = $questions;
        return Response::json($data);

    }
    public function update(Request $request)
    {
         $this->validate($request, [
            'question'=>'required',
            'answer'=>'required',
            'level'=>'required',
            'category'=>'required',

        ]); 

      $question               = Question::find($request->question_id);
      $question->question     = $request->question;
      $question->answer       = $request->answer;
      $question->level_id     = $request->level;
      $question->category_id  = $request->category;
      $question->save();
      return redirect()->back()->with('message', 'Question successfully Edited!');
    }

    public function destroy($id)
    {
        $ids              = explode(',', $id);
        $ids_to_delete    = array_map(function($item){ return $item; }, $ids);
        Question::whereIn('id', $ids_to_delete)->delete();
        return redirect('questions')->with('message', 'Selected questions has been deleted successfully!');
    }


}
