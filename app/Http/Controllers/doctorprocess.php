<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use Session;
use Auth;
use Hash;
//DB Models
use App\Users;
use App\Departments;
use App\Places;
use App\Acyear;
use App\Groups;
use App\Sections;
use App\Courses;
use App\Prerequest;
use App\Studata;
use App\Syssta;
use App\Stucou;
use App\Messages;
use App\Uidata;
use App\Periods;
use App\Warnings;
use App\Docdata;
use App\Assisdata;
use App\Questions;
use App\Quiz;
use App\Quizques;
use App\Quizans;
use App\Drive;
use App\Absence;

class doctorprocess extends Controller
{
    public function __construct(){
  	    $this->middleware('auth:doctor,assistant');
  	}
  	public function question(Request $req){
      $valarr=[
         'cou'=>'required',
         'con'=>'required',
         'ans'=>'required',
      ];
      $this->validate($req,$valarr);
      $did=Auth::user()->id;
      $cou=$req->input('cou');
      $con=$req->input('con');
      $ans=$req->input('ans');
      
      Questions::insert(['content'=>$con,'ans'=>$ans,'course_id'=>$cou,'st_id'=>$did,'dr_id'=>$did,'seen'=>1]);

      session()->push('m','success');
      session()->push('m','New Question Has Been Added!');
      return back();

    }
    public function ansques(Request $req,$qid){
      $valarr=[
         'ans'=>'required',
      ];
      $this->validate($req,$valarr);
      $did=Auth::user()->id;
      $ans=$req->input('ans');
      
      Questions::where('id',$qid)->update(['ans'=>$ans,'dr_id'=>$did,'seen'=>1]);

      session()->push('m','success');
      session()->push('m','Question Answer Has Been Added!');
      return redirect('/doctor/ansques');

    }
    public function results(Request $req,$cid){
    	$mid=$req->input('mid');
    	$ann=$req->input('ann');
    	$syssta=Syssta::where('id',1)->first();
    	if($syssta->state==2){
    		$fin=$req->input('fin');
    	}
    	$stucou=Stucou::where('course_id',$cid)->get();
    	foreach ($stucou as $v) {
      		$midst=$mid[$v->id];
      		$annst=$ann[$v->id];
      		if($syssta->state==2){
	    		$finst=$fin[$v->id];
	    	}else{
	    		$finst=0;
	    	}
	    	Stucou::where('id',$v->id)->update(['mid_term'=>$midst,'annual_evaluation'=>$annst,'final_degree'=>$finst]);
      	}

      	session()->push('m','success');
      	session()->push('m','Results Upgraded Successfully!');
      	return back();
    }
    public function createquiz(Request $req){
      $valarr=[
         'title'=>'required|min:5|max:30',
         'course'=>'required',
      ];
      $this->validate($req,$valarr);
      $title=$req->input('title');
      $course=$req->input('course');
      $questions=$req->input('question');
      if(empty($questions[0])){
      	$error = \Illuminate\Validation\ValidationException::withMessages([
	      'questions' => ["One Question is Required"]
	   ]);
	   throw $error;
      }
      Quiz::insert(['title'=>$title,'course_id'=>$course,'dr_id'=>Auth::user()->id]);
      $quzid=Quiz::orderBy('id','desc')->first();
      foreach ($questions as $q) {
      	Quizques::insert(['quiz'=>$quzid->id,'question'=>$q]);
      }
      session()->push('m','success');
      session()->push('m','Quiz Has Been Added!');
      return redirect('/doctor/quiz');

    }
    public function quiztog($qid){
    	$quzold=Quiz::where('id',$qid)->first();
    	if($quzold->state==1){
    		Quiz::where('id',$qid)->update(['state'=>0]);
    		session()->push('m','success');
      		session()->push('m','Quiz '.$quzold->title.' is now offline!');
    	}else{
    		Quiz::where('id',$qid)->update(['state'=>1]);
    		session()->push('m','success');
      		session()->push('m','Quiz '.$quzold->title.' is now online!');
    	}
      	return back();
    }
    public function drive(Request $req){
      $valarr=[
         'title'=>'required|min:5|max:50',
         'course'=>'required',
         'file'=>'required|mimes:pdf|max:8192'
      ];
      $this->validate($req,$valarr);
      $title=$req->input('title');
      $course=$req->input('course');
      $type=$req->input('type');
      $file =$req->file('file');
      $path = public_path('/drive');
      $name=str_random(32);
      $name.='.'.$file->getClientOriginalExtension();
      $file->move($path,$name);
      Drive::insert(['title'=>$title,'course_id'=>$course,'inst_id'=>Auth::user()->id,'type'=>$type,'link'=>$name]);
      session()->push('m','success');
      session()->push('m','file Has Been Added!');
      return back();
    }
    public function remdrive($did){
     $drive=Drive::where('id',$did)->first();
      @unlink('drive/'.$drive->link);
      Drive::where('id',$did)->delete();
     return back();
    }
    public function remabs($aid){
      Absence::where('id',$aid)->delete();
     return back();
    }
}
