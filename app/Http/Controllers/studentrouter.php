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
use App\Questions;
use App\Periods;
use App\Docdata;
use App\Assisdata;
use App\Cousch;
use App\Quiz;
use App\Quizques;
use App\Quizans;
use App\Extable;
use App\Stuhis;
use App\Drive;
use App\Absence;
use App\Warnings;

class studentrouter extends Controller
{
    public function __construct(){
       	$this->middleware('auth:student');
        $syssta=Syssta::where('id',1)->first();
        View::share('syssta', $syssta);
    }
    public function index(){
    	$studata=Studata::join('users','users.id','=','st_id')
    	->join('departments','departments.id','=','student_data.department')
    	->where('users.id',Auth::user()->id)
    	->select('student_data.*','users.f_name','users.m_name','users.th_name','users.rfid','departments.dep_name')
    	->first();
    	return view('student/index',compact('studata'));
    }
    public function warnings(){
        $data=Stucou::join('courses','courses.id','=','course_id')
        ->where('student_course.st_id',Auth::user()->id)
        ->select('student_course.*','courses.id as cid','courses.course_name','courses.code')
        ->get();
        $warnings=Warnings::all();
        $abs=[];
        $warn=[];
        foreach ($data as $v) {
          $abs[$v->cid]=Absence::where('course_id',$v->cid)->count();
          $warn[$v->cid]=Warnings::where('count','>',$abs[$v->cid])->first();
          if($warn[$v->cid]->withdraw==1){
            Stucou::where('student',$v->id)->delete();//withdraw subject
          }
        }
        
        return view('student/warnings',compact('data','abs','warn'));
    }
    public function register(){
        $stu=Users::join('student_data','student_data.st_id','=','users.id')
        ->join('departments','departments.id','=','student_data.department')
        ->where('users.email',Auth::user()->email)
        ->where('users.role','student')
        ->select('student_data.*','users.id as sid','users.f_name','users.m_name','users.email','departments.dep_name')
        ->first();
        if(empty($stu)){
            return redirect('/student');
        }
        $ac=Syssta::where('id',1)->first();
        $cour=Courses::where('dep_id',$stu->department)->where('level','<=',$stu->level)->where('state',1)->get();
        $sec=[];
        $cou=[];
        $couf=[];
        foreach ($cour as $co) {
         $chk=false;
         $prereq=Prerequest::where('course_id',$co->id)->get();
         if(count($prereq)==0){
          $stucou=Stuhis::where('st_id',$stu->sid)->where('course_state','>',0)
          ->where('course_id',$co->id)->first();
          if(empty($stucou))
            $cou[]=$co;
            $stucou=Stuhis::where('st_id',$stu->sid)->where('course_state',2)
            ->where('course_id',$co->id)->first();
          if(!empty($stucou)){
            $stucouchk=Stuhis::where('st_id',$stu->sid)->where('course_state',1)
            ->where('course_id',$stucou->course_id)->first();
            if(empty($stucouchk))
              $couf[]=$co;
          }
         }else{
          foreach ($prereq as $pre) {
           $stucou=Stuhis::where('st_id',$stu->sid)->where('course_state',1)
           ->where('course_id',$pre->prereq)->first();
           if(!empty($stucou)){
            $cou[]=Courses::where('dep_id',$stu->department)->where('id',$pre->course_id)->where('state',1)
            ->first();
           }
          }
         }
        }
        foreach ($cou as $c) {
            $sec[$c->id]=Sections::join('groups','groups.id','=','sections.group_id')
            ->where('groups.year',$ac->ac_year)->where('groups.level',$c->level)->where('groups.department',$c->dep_id)
            ->select('sections.*')->get();
        }
        foreach ($couf as $c) {
            $sec[$c->id]=Sections::join('groups','groups.id','=','sections.group_id')
            ->where('groups.year',$ac->ac_year)->where('groups.level',$c->level)->where('groups.department',$c->dep_id)
            ->select('sections.*')->get();
        }
        $oldreg=Stucou::where('st_id',$stu->sid)->get();
        if(count($oldreg)>0){
            session()->push('m','danger');
            session()->push('m','Registered Before!');
            return redirect('/student');
        }
        return view('student/register',compact('stu','sec','cou','couf'));
     }
     public function results(){
        $studentcou=Stucou::join('courses','courses.id','=','student_course.course_id')
        ->where('st_id',Auth::user()->id)->get();
        return view('student/resutls',compact('studentcou'));
    }
    public function question(){
      $ques=Questions::where('st_id',Auth::user()->id)->get();

      $course=Courses::join('student_course','student_course.course_id','=','courses.id')
      ->where('student_course.st_id',Auth::user()->id)->select('courses.*')->get();

      return view('student/question',compact('ques','course'));
     }
     public function table(){
      $periods=Periods::all();
      $stucou=Stucou::where('st_id',Auth::user()->id)->get();
      $table=[];
      foreach ($stucou as $st) {
        $table[]=Cousch::join('courses','courses.id','=','course_schedule.course_id')
        ->where('course_id',$st->course_id)->where('section_id',$st->section)->where('type','lab')
        ->select('course_schedule.*','courses.course_name')->get();
      }
      foreach ($stucou as $st) {
        $table[]=Cousch::join('courses','courses.id','=','course_schedule.course_id')
        ->join('places','places.id','=','course_schedule.place_id')
        ->where('course_id',$st->course_id)->where('course_schedule.type','sec')->where('section_id',$st->section)
        ->select('course_schedule.*','courses.course_name','places.name as pname')->get();
      }foreach ($stucou as $st) {
        $group=Groups::join('sections','sections.group_id','=','groups.id')
        ->where('sections.id',$st->section)->select('groups.id')->first();
        $table[]=Cousch::join('courses','courses.id','=','course_schedule.course_id')
        ->join('places','places.id','=','course_schedule.place_id')
        ->where('course_id',$st->course_id)->where('course_schedule.type','lec')->where('section_id',$group->id)
        ->select('course_schedule.*','courses.course_name','places.name as pname')->get();
      }
      $days=['sunday','monday','teusday','wednessday','tharasday'];
      return view('student/table',compact('periods','table','days'));
     }
     public function showques(){
      $ques=Questions::all();

      $course=Courses::join('student_course','student_course.course_id','=','courses.id')
      ->where('student_course.st_id',Auth::user()->id)->select('courses.*')->get();

      return view('student/showques',compact('ques','course'));
     }
     public function quiz(){
      $regcou=Stucou::where('st_id',Auth::user()->id)->get();
      $avquiz=[];
      foreach ($regcou as $c) {
        $avquiz[]=Quiz::join('courses','courses.id','=','quiz.course_id')
        ->where('quiz.course_id',$c->course_id)->where('quiz.state',1)
        ->select('quiz.*','courses.course_name')->first();
      }
      foreach ($avquiz as $k=>$q) {
        if($q!=null){
          $chkqu=Quizans::where('quiz',$q->id)->where('student',Auth::user()->id)->first();
          if(!empty($chkqu)){
            unset($avquiz[$k]);
          }
        }
      }
      return view('student/quiz',compact('avquiz'));
     }
     public function quizs($qid){
      $ques=Quizques::where('quiz',$qid)->get();
      return view('student/quizq',compact('qid','ques'));
     }
     public function ftable(){
      $stucou=Stucou::where('st_id',Auth::user()->id)->get();
      $table=[];
      foreach ($stucou as $c) {
          $table[]=Extable::join('courses','courses.id','=','exam_schedule.course_id')
        ->join('exam_periods','exam_periods.id','=','exam_schedule.exam_period')
        ->join('places','places.id','=','exam_schedule.place')
        ->where('exam_schedule.course_id',$c->course_id)
        ->select('exam_schedule.*','courses.course_name','courses.code','exam_periods.name as pname','exam_periods.start_time','exam_periods.end_time','places.name as plname')->first();
      }
      return view('student/ftable',compact('table'));
     }
     public function evaluation(){
      $stucou=Stucou::join('courses','courses.id','=','student_course.course_id')
      ->where('student_course.st_id',Auth::user()->id)
      ->select('student_course.*','courses.course_name')->get();
      $inst=[];
      $doc=[];
      foreach ($stucou as $v) {
        $inst[$v->course_name]=Cousch::join('users','users.id','=','course_schedule.instructor_id')
        ->where('course_schedule.section_id',$v->section)->where('course_schedule.course_id',$v->course_id)
        ->where('type','sec')
        ->select('users.id','users.f_name','users.m_name')->first();
      }
      foreach ($stucou as $v) {
        $group=Sections::join('groups','groups.id','=','sections.group_id')
            ->where('sections.id',$v->section)
            ->select('groups.*')->first();
        $doc[$v->course_name]=Cousch::join('users','users.id','=','course_schedule.instructor_id')
        ->where('course_schedule.section_id',$group->id)->where('course_schedule.course_id',$v->course_id)
        ->where('type','lec')
        ->select('users.id','users.f_name','users.m_name')->first();
      }
      return view('student/evaluation',compact('inst','doc','stucou'));
     }
     public function history(){
        $stucou=Stuhis::join('courses','courses.id','=','student_history.course_id')
        ->where('st_id',Auth::user()->id)
        ->select('student_history.*','courses.course_name','courses.code')->get();
        $acyears=Acyear::all();
        return view('student/reshist',compact('stucou','acyears'));
    }
    public function drive()
     {
        $stucou=Stucou::where('st_id',Auth::user()->id)->get();
        $courses=[];
        $drive=[];
        foreach ($stucou as $v) {
          $courses[]=Courses::where('id',$v->course_id)->first();
          $drive[$v->course_id]=Drive::where('course_id',$v->course_id)->get();
        }
        return view('student/drive',compact('courses','drive'));
     }
}