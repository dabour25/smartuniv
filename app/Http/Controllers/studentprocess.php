<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Auth;
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

class studentprocess extends Controller
{
  public function register(Request $req){
      $sid=Auth::user()->id;
      $cou=$req->input('cou');
      $sec=$req->input('cousec');
      $hrs=0;
      foreach ($cou as $v) {
        $chksec=Stucou::where('section',$sec[$v])->distinct('st_id')->count();
        if($chksec>=30){
          $error = \Illuminate\Validation\ValidationException::withMessages([
            'section' => ['One of Selected Sections is Full !']
         ]);
         throw $error;
        }
        $getc=Courses::where('id',$v)->first();
        $hrs+=$getc->credit;
      }
      $studata=Users::join('student_data','student_data.st_id','=','users.id')
      ->where('users.id',$sid)
      ->select('student_data.*','users.id as sid')
      ->first();
      if($studata->level!=0){
        if($studata->CGPA<2){
          if($hrs>14){
            $error = \Illuminate\Validation\ValidationException::withMessages([
              'hours' => ["You Can't Exceed 14 Hours"]
           ]);
           throw $error;
          }
        }elseif($studata->CGPA<3.6){
          if($hrs>18){
            $error = \Illuminate\Validation\ValidationException::withMessages([
              'hours' => ["You Can't Exceed 18 Hours"]
           ]);
           throw $error;
          }
        }else{
          if($hrs>21){
            $error = \Illuminate\Validation\ValidationException::withMessages([
              'hours' => ["You Can't Exceed 21 Hours"]
           ]);
           throw $error;
          }
        }
      }else{
        if($hrs>18){
          $error = \Illuminate\Validation\ValidationException::withMessages([
            'hours' => ["You Can't Exceed 18 Hours"]
         ]);
         throw $error;
        }
      }
      foreach ($cou as $v) {
        Stucou::insert(['st_id'=>$sid,'course_id'=>$v,'course_state'=>0,'section'=>$sec[$v],'grade'=>'']);
      }
      session()->push('m','success');
      session()->push('m','Registered Successfully!');
      return back();
    }
    public function question(Request $req){
      $valarr=[
         'cou'=>'required',
         'con'=>'required',
      ];
      $this->validate($req,$valarr);
      $sid=Auth::user()->id;
      $cou=$req->input('cou');
      $con=$req->input('con');
      
      Questions::insert(['content'=>$con,'ans'=>'','course_id'=>$cou,'st_id'=>$sid]);

      session()->push('m','success');
      session()->push('m','New Question Has Been Added!');
      return back();

    }
    public function quiz(Request $req,$qid){
      $ans=$req->input('ans');
      foreach($ans as $k=>$v){
        Quizans::insert(['quiz'=>$qid,'question'=>$k,'student'=>Auth::user()->id,'answer'=>$v]);
      }
      session()->push('m','success');
      session()->push('m','Answers Sent successfully!');
      return redirect('/student/quiz');
    }
    public function evaluate(Request $req){
      $evd=$req->input('evd');
      $evas=$req->input('evas');
      foreach($evd as $k=>$v){
        $oldev=Docdata::where('dr_id',$k)->first();
        $newev=($oldev->evaluation+$v)/2;
        Docdata::where('id',$oldev->id)->update(['evaluation'=>$newev]);
      }
      foreach($evas as $k=>$v){
        $oldev=Assisdata::where('assis_id',$k)->first();
        $newev=($oldev->evaluation+$v)/2;
        Assisdata::where('id',$oldev->id)->update(['evaluation'=>$newev]);
      }
      session()->push('m','success');
      session()->push('m','Evaluations Sent successfully!');
      return redirect('/student');
    }
}
