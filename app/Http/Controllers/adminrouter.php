<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;
use View;
//DB Models
use App\Departments;
use App\Places;
use App\Acyear;
use App\Groups;
use App\Sections;
use App\Courses;
use App\Prerequest;
use App\Students;
use App\Syssta;
use App\Stucou;
use App\Messages;
use App\Uidata;
use App\Periods;
use App\Warnings;
use App\Doctors;
use App\Assistants;
use App\Cousch;
use App\Experiod;
use App\Extable;
use App\Stuhis;

class adminrouter extends Controller
{
    public function __construct(){
       $this->middleware('auth:admin');
       $messagescount = Messages::where('seen',0)->count();
       $syssta=Syssta::where('id',1)->first();
       $unreg=(Students::where('level','<',5)->count())-(Stucou::distinct()->count(['student_id']));
       View::share('messagescount', $messagescount);
       View::share('syssta', $syssta);
       View::share('unreg', $unreg);
   }
   public function index(){
    $doctor=Doctors::all();
    $inst=Assistants::all();
    $courses=Courses::all();
    $unlinkcd=$unlinkca=0;
    foreach ($courses as $c) {
      $finddoc=$findassis=false;
      foreach ($doctor as $d) {
        $docc=explode('|', $d->courses);
        foreach ($docc as $dc) {
          if($dc==$c->id){
            $finddoc=true;
          }
        }
      }
      foreach ($inst as $i) {
        $asc=explode('|', $i->courses);
        foreach ($asc as $ac) {
          if($ac==$c->id||$c->sec==0){
            $findassis=true;
          }
        }
      }
      if(!$finddoc){
        $unlinkcd++;
      }
      if(!$findassis){
        $unlinkca++;
      }
    }
    return view('admin/index',compact('unlinkcd','unlinkca'));
   }
   public function newdeb(){
    return view('admin/adddeb');
   }
   public function editdeb(){
    $deps=Departments::all();
    return view('admin/editdeb')->withDeps($deps);
   }
   public function editdebd($did){
    $didata=Departments::where('id',$did)->first();
    if(empty($didata)){
     return redirect('/admin/editdeb');
    }
    return view('admin/editdeb')->withDid($did)->withDidata($didata);
   }
   public function newpla(){
    return view('admin/addpla');
   }
   public function editpla(){
    $places=Places::paginate(10);
    return view('admin/editpla')->withPlaces($places);
   }
   public function editplas($sr){
    $places=Places::where('name','like','%'.$sr.'%')->paginate(10);
    return view('admin/editpla')->withPlaces($places);
   }
   public function editplap($pid){
    $pldata=Places::where('id',$pid)->first();
    if(empty($pldata)){
     return redirect('/admin/editpla');
    }
    return view('admin/editpla')->withPid($pid)->withPlace($pldata);
   }
   public function adddoctor(){
    $departments=Departments::all();
    return view('admin/adddoctor',compact('departments'));
   }
   public function edituser(){
    $users=Users::where('role','!=','sadmin')->paginate(20);
    return view('admin/edituser')->withUsers($users);
   }
   public function editusers($sr){
    $users=Users::where('role','!=','sadmin')
    ->where(function($quary)use($sr){
     $quary->where('email','like','%'.$sr.'%')->orwhere('f_name','like','%'.$sr.'%')
     ->orwhere('m_name','like','%'.$sr.'%')->orwhere('th_name','like','%'.$sr.'%')
     ->orwhere('l_name','like','%'.$sr.'%')->orwhere('mobile_no','like','%'.$sr.'%');
    })->paginate(20);
    return view('admin/edituser')->withUsers($users);
   }
   public function edituseru($uid){
    $user=Users::where('id',$uid)->first();
    if(empty($user)){
     return redirect('/admin/edituser');
    }
    return view('admin/edituser')->withUser($user)->withUid($uid);
   }
   public function acyear(){
    $acyears=Acyear::all();
    return view('admin/acyear')->withAcyears($acyears);
   }
   public function addgroup(){
    $acyears=Acyear::all();
    $deps=Departments::all();
    return view('admin/addgroup')->withAcyears($acyears)->withDeps($deps);
   }
   public function editgroup(){
    $groups=Groups::join('departments','departments.id','=','groups.department_id')
    ->join('academic_year','academic_year.id','=','groups.academic_year')
    ->select('groups.*','academic_year.year as acyear','academic_year.semister','departments.name as dep_name')->get();
    return view('admin/editgroup')->withGroups($groups);
   }
   public function addsec(){
    $acyears=Acyear::all();
    $deps=Departments::all();
    return view('admin/addsec')->withAcyears($acyears)->withDeps($deps);
   }
   public function selsecerr(){
    $syssta=Syssta::where('id',1)->first();
    return redirect('/admin/addsec');
   }
   public function selsec(Request $req){
    $valarr=[
      'acyear'=>'required|exists:academic_year,id',
      'dep'=>'required|exists:departments,id',
      'level'=>'required'
  ];
  $this->validate($req,$valarr);
  $acyear=$req->input('acyear');
  $dep=$req->input('dep');
  $level=$req->input('level');
  $groups=Groups::where('academic_year',$acyear)->where('department_id',$dep)->where('level',$level)->get();
  return view('admin/addsec')->withGroups($groups);
   }
   public function editsec(){
    $sections=Sections::join('groups','groups.id','=','sections.group_id')
    ->join('departments','departments.id','=','groups.department_id')
    ->join('academic_year','academic_year.id','=','groups.academic_year')
    ->select('sections.*','academic_year.year as acyear','departments.name as dep_name','groups.group_name','groups.level')
    ->get();
    return view('admin/editsec')->withGroups($sections);
   }
   public function editgroupg($gid){
    $group=Groups::where('id',$gid)->first();
    if(empty($group)){
     return redirect('/admin/editgroup');
    }
    return view('admin/editgroup')->withGroup($group);
   }
   public function editsecs($sid){
    $section=Sections::where('id',$sid)->first();
    if(empty($section)){
     return redirect('/admin/editsec');
    }
    return view('admin/editsec')->withSection($section);
   }
   public function addcourse(){
    $deps=Departments::all();
    $cou=Courses::all();
    return view('admin/addcourse')->withDeps($deps)->withCou($cou);
   }
   public function editcourse(){
    $cou=Courses::join('departments','departments.id','=','courses.dep_id')
    ->select('courses.*','departments.dep_name')->get();
    return view('admin/editcourse')->withCou($cou);
   }
   public function editcoursec($couid){
    $deps=Departments::all();
    $cou=Courses::join('departments','departments.id','=','courses.dep_id')
    ->where('courses.id',$couid)
    ->select('courses.*','departments.dep_name')->first();
    $cours=Courses::all();
    $pre=Prerequest::where('course_id',$couid)->get();
    return view('admin/editcourse',compact('deps','cou','cours','pre','couid'));
   }
   public function editstu(){
    $stu=Users::join('student_data','student_data.st_id','=','users.id')
    ->join('departments','departments.id','=','student_data.department')
    ->where('users.role','student')
    ->select('users.id as sid','users.f_name','users.m_name','student_data.*','departments.dep_name')
    ->paginate(20);
    return view('admin/editstu')->withStu($stu);
   }
   public function editdoc(){
    $doc=Users::leftjoin('doctor_data','doctor_data.dr_id','=','users.id')
    ->leftjoin('departments','departments.id','=','doctor_data.department')
    ->where('users.role','doctor')
    ->select('users.id as did','users.f_name','users.m_name','doctor_data.*','departments.dep_name')
    ->paginate(20);
    return view('admin/editdoc')->withDoc($doc);
   }
   public function editassis(){
    $assi=Users::leftjoin('assistant_data','assistant_data.assis_id','=','users.id')
    ->leftjoin('departments','departments.id','=','assistant_data.department')
    ->where('users.role','assistant')
    ->select('users.id as aid','users.f_name','users.m_name','assistant_data.*','departments.dep_name')
    ->paginate(20);
    return view('admin/editassis')->withAssi($assi);
   }
   public function editstus($s){
    $stu=Users::join('student_data','student_data.st_id','=','users.id')
    ->join('departments','departments.id','=','student_data.department')
    ->where('users.role','student')
    ->where('users.email','like','%'.$s.'%')
    ->select('users.id as sid','users.f_name','users.m_name','student_data.*','departments.dep_name')
    ->paginate(20);
    return view('admin/editstu')->withStu($stu);
   }
   public function editdocs($s){
    $doc=Users::leftjoin('doctor_data','doctor_data.dr_id','=','users.id')
    ->leftjoin('departments','departments.id','=','doctor_data.department')
    ->where('users.role','doctor')
    ->where('users.email','like','%'.$s.'%')
    ->select('users.id as did','users.f_name','users.m_name','doctor_data.*','departments.dep_name')
    ->paginate(20);
    return view('admin/editdoc')->withDoc($doc);
   }
   public function editassiss($s){
    $assi=Users::leftjoin('assistant_data','assistant_data.assi_id','=','users.id')
    ->leftjoin('departments','departments.id','=','assistant_data.department')
    ->where('users.role','assistant')
    ->where('users.email','like','%'.$s.'%')
    ->select('users.id as did','users.f_name','users.m_name','assistant_data.*','departments.dep_name')
    ->paginate(20);
    return view('admin/editassis')->withAssi($assi);
   }
   public function editstusd($sid){
    $stud=Users::join('student_data','student_data.st_id','=','users.id')
    ->join('departments','departments.id','=','student_data.department')
    ->where('users.role','student')
    ->where('users.id',$sid)
    ->select('users.id as sid','users.f_name','users.m_name','student_data.*','departments.dep_name')
    ->first();
    if(empty($stud)){
     return redirect('/admin/editstu');
    }
    $deps=Departments::all();
    return view('admin/editstu')->withStud($stud)->withSid($sid)->withDeps($deps);
   }
   public function editdocd($did){
    $docd=Users::leftjoin('doctor_data','doctor_data.dr_id','=','users.id')
    ->leftjoin('departments','departments.id','=','doctor_data.department')
    ->where('users.role','doctor')
    ->where('users.id',$did)
    ->select('users.id as did','users.f_name','users.m_name','doctor_data.*','departments.dep_name')
    ->first();
    if(empty($docd)){
     return redirect('/admin/editdoc');
    }
    $deps=Departments::all();
    $ac=Syssta::where('id',1)->first();
    $groups=Groups::join('departments','departments.id','=','groups.department')
    ->where('groups.year',$ac->ac_year)
    ->select('groups.*','departments.dep_name')->get();
    $courses=Courses::all();
    return view('admin/editdoc',compact('docd','did','deps','groups','courses'));
   }
   public function editassisd($aid){
    $assis=Users::leftjoin('assistant_data','assistant_data.assis_id','=','users.id')
    ->leftjoin('departments','departments.id','=','assistant_data.department')
    ->where('users.role','assistant')
    ->where('users.id',$aid)
    ->select('users.id as aid','users.f_name','users.m_name','assistant_data.*','departments.dep_name')
    ->first();
    if(empty($assis)){
     return redirect('/admin/editassis');
    }
    $deps=Departments::all();
    $ac=Syssta::where('id',1)->first();
    $sects=Sections::join('groups','groups.id','=','sections.group_id')
    ->join('departments','departments.id','=','groups.department')
    ->where('groups.year',$ac->ac_year)
    ->select('sections.*','departments.dep_name','groups.group_name','groups.level')->get();
    $courses=Courses::all();
    return view('admin/editassis',compact('assis','aid','deps','sects','courses'));
   }
   public function stureg(){
    $syssta=Syssta::where('id',1)->first();
   	if($syssta->state!=0){
   		return redirect('/admin');
   	}
    return view('admin/stureg');
   }
   public function edstureg(){
    $syssta=Syssta::where('id',1)->first();
    if($syssta->state!=0){
        return redirect('/admin');
    }
    return view('admin/edstureg');
   }
   public function sturegs(Request $req){
    $stu=Users::join('student_data','student_data.st_id','=','users.id')
    ->join('departments','departments.id','=','student_data.department')
    ->where('users.email',$req->input('email'))
    ->where('users.role','student')
    ->select('student_data.*','users.id as sid','users.f_name','users.m_name','users.email','departments.dep_name')
    ->first();
    if(empty($stu)){
     return redirect('/admin/stureg');
    }
    $chk=Stucou::where('st_id',$stu->sid)->first();
    if(!empty($chk)){
     return redirect('/admin/stureg');
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
    return view('admin/sturegs')->withStu($stu)->withSec($sec)->withCou($cou)->withCouf($couf);
 }
    public function edsturegs(Request $req){
        $stu=Users::join('student_data','student_data.st_id','=','users.id')
        ->join('departments','departments.id','=','student_data.department')
        ->where('users.email',$req->input('email'))
        ->where('users.role','student')
        ->select('student_data.*','users.id as sid','users.f_name','users.m_name','users.email','departments.dep_name')
        ->first();
        if(empty($stu)){
         return redirect('/admin/stureg');
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
          if(!empty($stucou))
           $couf[]=$co;
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
        return view('admin/edsturegs',compact('stu','sec','cou','couf','oldreg'));
     }
     public function sysst(){
      $acyears=Acyear::all();
      return view('admin/sysst')->withAcyears($acyears);
     }
     public function messages(){
      $newmes=Messages::where('seen',0)->orderBy('id','desc')->get();
      $oldmes=Messages::where('seen',1)->orderBy('id','desc')->get();
      Messages::where('seen',0)->update(['seen'=>1]);
      return view('admin/messages',compact('newmes','oldmes'));
     }
     public function ui(){
        $data=Uidata::all();
        return view('admin/uidata',compact('data'));
     }
     public function upload(){
        return view('admin/upload')->withUrl('');
     }
     public function periods(){
        $per=Periods::all();
        return view('admin/periods',compact('per'));
     }
     public function editperiod($pid){
        $per=Periods::all();
        $perd=Periods::where('id',$pid)->first();
        return view('admin/periods',compact('per','perd','pid'));
     }
     public function warnings(){
        $warn=Warnings::all();
        return view('admin/warnings',compact('warn'));
     }
     public function editwarning($wid){
        $warn=Warnings::all();
        $wrn=Warnings::where('id',$wid)->first();
        return view('admin/warnings',compact('warn','wrn','wid'));
     }
     public function experiod(){
        $experiod=Experiod::all();
        return view('admin/experiod',compact('experiod'));
     }
     public function editexperiod($pid){
        $experiod=Experiod::all();
        $perd=Experiod::where('id',$pid)->first();
        return view('admin/experiod',compact('experiod','perd','pid'));
     }
     public function extables(){
        return view('admin/extables');
     }
     public function extablesl($lvl){
        $courses=Courses::where('level',$lvl)->get();
        $periods=Experiod::all();
        $places=Places::where('exam_capacity','>',0)->get();
        $table=Extable::join('courses','courses.id','=','exam_schedule.course_id')
        ->join('exam_periods','exam_periods.id','=','exam_schedule.exam_period')
        ->join('places','places.id','=','exam_schedule.place')
        ->where('exam_schedule.level',$lvl)
        ->select('exam_schedule.*','courses.course_name','exam_periods.name as pname','places.name as plname')->get();
        return view('admin/extables',compact('lvl','places','courses','periods','table'));
     }
}