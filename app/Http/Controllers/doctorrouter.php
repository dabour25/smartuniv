<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;
use View;
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
use App\Cousch;
use App\Quiz;
use App\Quizques;
use App\Quizans;
use App\Experiod;
use App\Stuhis;
use App\Drive;
use App\Absence;

class doctorrouter extends Controller
{
    public function __construct(){
       $this->middleware('auth:doctor,assistant');
       $this->middleware(function ($request, $next) {
            $role = Auth::user()->role;
            if($role!='doctor'&&$role!='assistant'){
                return redirect('/');
            }else{
                return $next($request);
            }
        });
        $syssta=Syssta::where('id',1)->first();
        View::share('syssta', $syssta);
   }
   public function index(){
    if(Auth::user()->role=="doctor"){
      $docdata=Docdata::where('dr_id',Auth::user()->id)->first();
      $doccou=explode('|', $docdata->courses);
    }else{
      $docdata=Assisdata::where('assis_id',Auth::user()->id)->first();
      $doccou=explode('|', $docdata->courses);
    }
    $courses=[];
    $stucount=[];
    $quizc=[];
    $sucrate=[];
    foreach ($doccou as $v) {
      $courses[]=Courses::where('id',$v)->first();
      $stucount[$v]=Stucou::where('course_id',$v)->count();
      $quizc[$v]=Quiz::where('course_id',$v)->count();
      $all=Stuhis::where('course_id',$v)->count();
      $suc=Stuhis::where('course_id',$v)->where('course_state',1)->count();
      if($all!=0){
        $sucrate[$v]=($suc*100)/$all;
      }else{
        $sucrate[$v]=100;
      }
    }
    return view('doctor/index',compact('docdata','courses','stucount','quizc','sucrate'));
   }
   public function question(){
      if(Auth::user()->role=="doctor"){
        $docdata=Docdata::where('dr_id',Auth::user()->id)->first();
        $doccou=explode('|', $docdata->courses);
      }else{
        $docdata=Assisdata::where('assis_id',Auth::user()->id)->first();
        $doccou=explode('|', $docdata->courses);
      }
      $courses=[];
      foreach ($doccou as $v) {
        $courses[]=Courses::where('id',$v)->first();
      }

      return view('doctor/addques',compact('courses'));
     }
     public function ansques(){
      if(Auth::user()->role=="doctor"){
        $docdata=Docdata::where('dr_id',Auth::user()->id)->first();
        $doccou=explode('|', $docdata->courses);
      }else{
        $docdata=Assisdata::where('assis_id',Auth::user()->id)->first();
        $doccou=explode('|', $docdata->courses);
      }
      $courses=[];
      foreach ($doccou as $v) {
        $courses[]=Courses::where('id',$v)->first();
      }
      $questions=[];
      foreach ($courses as $v) {
        $questions[$v->id]=Questions::join('users','users.id','=','questions.st_id')
        ->where('course_id',$v->id)->where('ans','')
        ->select('questions.*','users.f_name','users.m_name')->get();
      }
      return view('doctor/ansques',compact('courses','questions'));
     }
     public function ansquesq($qid){
      $ques=Questions::where('id',$qid)->first();
      return view('doctor/ansques',compact('qid','ques'));
     }
     public function table(){
      $periods=Periods::all();
      $table[]=Cousch::join('courses','courses.id','=','course_schedule.course_id')
        ->join('places','places.id','=','course_schedule.place_id')
        ->where('instructor_id',Auth::user()->id)
        ->select('course_schedule.*','courses.course_name','places.name as pname')->get();

      $days=['sunday','monday','teusday','wednessday','tharasday'];
      return view('doctor/table',compact('periods','days','table'));
     }
     public function results()
     {
        $docdata=Docdata::where('dr_id',Auth::user()->id)->first();
        $doccou=explode('|', $docdata->courses);
        $courses=[];
        foreach ($doccou as $v) {
          $courses[]=Courses::where('id',$v)->first();
        }
        return view('doctor/resutls',compact('courses'));
     }
     public function resultsc($cid)
     {
        $stucou=Stucou::join('sections','sections.id','=','student_course.section')
        ->join('users','users.id','=','student_course.st_id')
        ->where('student_course.course_id',$cid)
        ->select('student_course.*','users.f_name','users.m_name','users.th_name','sections.section')->get();

        return view('doctor/resutls',compact('cid','stucou'));
     }
     public function quiz()
     {
        $oldquiz=Quiz::where('dr_id',Auth::user()->id)->get();

        return view('doctor/quiz',compact('oldquiz'));
     }
     public function createquiz()
     {
        if(Auth::user()->role=="doctor"){
          $docdata=Docdata::where('dr_id',Auth::user()->id)->first();
          $doccou=explode('|', $docdata->courses);
        }else{
          $docdata=Assisdata::where('assis_id',Auth::user()->id)->first();
          $doccou=explode('|', $docdata->courses);
        }
        $courses=[];
        foreach ($doccou as $v) {
          $courses[]=Courses::where('id',$v)->first();
        }
        return view('doctor/createquiz',compact('courses'));
     }
     public function quizq($qid)
     {
        $ansstu=Quizans::join('users','users.id','=','quiz_answers.student')
        ->where('quiz',$qid)->distinct('quiz_answers.student')
        ->select('users.*')->get();

        return view('doctor/quiz',compact('qid','ansstu'));
     }
     public function quizs($qid,$sid)
     {
        $ans=Quizans::join('quiz_questions','quiz_questions.id','=','quiz_answers.question')
        ->where('quiz_answers.quiz',$qid)->where('quiz_answers.student',$sid)
        ->select('quiz_answers.*','quiz_questions.question')->get();

        return view('doctor/quizans',compact('qid','ans'));
     }
     public function drive()
     {
        if(Auth::user()->role=="doctor"){
          $docdata=Docdata::where('dr_id',Auth::user()->id)->first();
          $doccou=explode('|', $docdata->courses);
        }else{
          $docdata=Assisdata::where('assis_id',Auth::user()->id)->first();
          $doccou=explode('|', $docdata->courses);
        }
        $courses=[];
        $drive=[];
        foreach ($doccou as $v) {
          $courses[]=Courses::where('id',$v)->first();
          $drive[$v]=Drive::where('inst_id',Auth::user()->id)->where('course_id',$v)->get();
        }
        return view('doctor/drive',compact('courses','drive'));
     }
     public function attend()
     {
        if(Auth::user()->role=="doctor"){
          $docdata=Docdata::where('dr_id',Auth::user()->id)->first();
          $doccou=explode('|', $docdata->courses);
          $type='lec';
        }else{
          $docdata=Assisdata::where('assis_id',Auth::user()->id)->first();
          $doccou=explode('|', $docdata->courses);
          $type='sec';
        }
        $courses=[];
        $abs=[];
        foreach ($doccou as $v) {
          $courses[]=Courses::where('id',$v)->first();
          $abs[$v]=Absence::join('users','users.id','=','absence.st_id')
          ->where('course_id',$v)->where('type',$type)
          ->select('absence.*','users.f_name','users.m_name','users.th_name')->get();
        }
        return view('doctor/attend',compact('courses','abs'));
     }
}