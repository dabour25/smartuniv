<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use Session;
use Auth;
use Hash;
//DB Models
use App\Admins;
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
use App\Absence;

class adminprocess extends Controller
{
    public function __construct(){
  	    $this->middleware('auth:admin');
  	}
  	public function adddep(Request $req){
  		$valarr=[
	       'department'=>'required|unique:departments,name'
	    ];
	    $this->validate($req,$valarr);
	    $dname=$req->input('department');
	    Departments::insert(['name'=>$dname]);
	    session()->push('m','success');
	   	session()->push('m','Department has been added successfully!');
  		return back();
  	}
  	public function editdeb(Request $req,$did){
  		$chk=Departments::where('id',$did)->first();
  		if(empty($chk)){
  			return redirect('/admin/editdeb');
  		}
  		if($chk->dep_name!=$req->input('department')){
	  		$valarr=[
		       'department'=>'required|unique:departments,name'
		    ];
		    $this->validate($req,$valarr);
		}
	    $dname=$req->input('department');
	    Departments::where('id',$did)->update(['name'=>$dname]);
	    session()->push('m','success');
	    session()->push('m','Department ('.$chk->name.') has been updated successfully!');

  		return back();
  	}
  	public function addpla(Request $req){
  		$valarr=[
	       'name'=>'required',
	       'capacity'=>'required|integer',
	       'examcapacity'=>'required|integer'
	    ];
	    $this->validate($req,$valarr);
	    $type=$req->input('type');
	    $name=$req->input('name');
	    $cap=$req->input('capacity');
	    $excap=$req->input('examcapacity');
	    Places::insert(['type'=>$type,'name'=>$name,'capacity'=>$cap,'exam_capacity'=>$excap]);
	    session()->push('m','success');
	    session()->push('m','Place has been added successfully!');
  		return back();
  	}
  	public function editpla(Request $req,$pid){
  		$chk=Places::where('id',$pid)->first();
  		if(empty($chk)){
  			return redirect('/admin/editpla');
  		}
  		$valarr=[
	       'name'=>'required',
	       'capacity'=>'required|integer',
	       'examcapacity'=>'required|integer'
	    ];
	    $this->validate($req,$valarr);
	    $type=$req->input('type');
	    $name=$req->input('name');
	    $cap=$req->input('capacity');
	    $excap=$req->input('examcapacity');
	    Places::where('id',$pid)->update(['type'=>$type,'name'=>$name,'capacity'=>$cap,'exam_capacity'=>$excap]);
	    session()->push('m','success');
	    session()->push('m','Place has been updated successfully!');

  		return back();
  	}
  	public function rempla($pid){
  		Places::where('id',$pid)->delete();
  		return redirect('/admin/editpla');
  	}
  	public function adduser(Request $req){
  		$valarr=[
	       'fname'=>'required|max:80',
	       'mname'=>'required|max:80',
	       'thname'=>'required|max:80',
	       'lname'=>'required|max:80',
	       'rfid'=>'unique:users,rfid|max:12',
	       'birthdate'=>'required',
	       'mobile'=>'required|min:10|max:20',
	       'email'=>'required|email|min:5|max:60|unique:users,email',
	       'password'=>'required|min:8|max:20|regex:/[A-z]*[0-9]+[A-z]*/'
	    ];
	    $this->validate($req,$valarr);
	    $fname=$req->input('fname');
	    $mname=$req->input('mname');
	    $thname=$req->input('thname');
	    $lname=$req->input('lname');
	    $rfid=$req->input('rfid');
	    $birthdate=$req->input('birthdate');
	    $mobile=$req->input('mobile');
	    $email=$req->input('email');
	    $password=Hash::make($req->input('password'));
	    $role=$req->input('role');
	    Users::insert(['email'=>$email,'password'=>$password,'rfid'=>$rfid,'f_name'=>$fname,'m_name'=>$mname,'th_name'=>$thname,'l_name'=>$lname,'mobile_no'=>$mobile,'role'=>$role,'date_of_birth'=>$birthdate]);
	    if($role=='student'){
	    	$getid=Users::orderBy('id','desc')->first();
	    	$acyear=Syssta::where('id',1)->first();
	    	Studata::insert(['st_id'=>$getid->id,'ac_year'=>$acyear->ac_year]);
	    }
	    session()->push('m','success');
	    session()->push('m','User has been added successfully!');
  		return back();
  	}
  	public function edituser(Request $req,$uid){
  		$valarr=[
	       'fname'=>'required|max:80',
	       'mname'=>'required|max:80',
	       'thname'=>'required|max:80',
	       'lname'=>'required|max:80',
	       'rfid'=>'max:255',
	       'birthdate'=>'required',
	       'mobile'=>'required|min:10|max:20',
	       'email'=>'required|email|min:5|max:60'
	    ];
	    $this->validate($req,$valarr);
	    $fname=$req->input('fname');
	    $mname=$req->input('mname');
	    $thname=$req->input('thname');
	    $lname=$req->input('lname');
	    $rfid=$req->input('rfid');
	    $birthdate=$req->input('birthdate');
	    $mobile=$req->input('mobile');
	    $email=$req->input('email');
	    $role=$req->input('role');
	    $olddata=Users::where('id',$uid)->first();
	    if($olddata->email!=$email){
	    	$valarr=[
		       'email'=>'required|unique:users,email'
		    ];
		    $this->validate($req,$valarr);
	    }
	    if($olddata->rfid!=$rfid){
	    	$valarr=[
		       'rfid'=>'required|unique:users,rfid'
		    ];
		    $this->validate($req,$valarr);
	    }
	    if(!empty($req->input('password'))){
	    	$valarr=[
		       'password'=>'required|min:8|max:20|regex:/[A-z]*[0-9]+[A-z]*/'
		    ];
		    $this->validate($req,$valarr);	
	    	$password=Hash::make($req->input('password'));
	    }else{
	    	$password=$olddata->password;
	    }
	    Users::where('id',$uid)->update(['email'=>$email,'password'=>$password,'rfid'=>$rfid,'f_name'=>$fname,'m_name'=>$mname,'th_name'=>$thname,'l_name'=>$lname,'mobile_no'=>$mobile,'role'=>$role,'date_of_birth'=>$birthdate]);
	     session()->push('m','success');
	    	    session()->push('m','User has been updated successfully!');
  		return back();
  	}
  	public function addac(Request $req){
  		$valarr=[
		    'acyear'=>'required|unique:academic_year,year|max:30',
		    'semister'=>'required|max:30',
		];
		$this->validate($req,$valarr);
		$acyear=$req->input('acyear');
		$semister=$req->input('semister');
		$level=$req->input('level');
		$lvl=0;
		if($level){
			$lvl=1;
		}
		Acyear::insert(['year'=>$acyear,'semister'=>$semister,'level_up'=>$lvl]);
		session()->push('m','success');
	    session()->push('m','New academic year has been added successfully!');
		return back();
  	}
  	public function editac(Request $req,$id){
  		$olddata=Acyear::where('id',$id)->first();
  		if(empty($olddata)){
  			return redirect('/admin/acyear');
  		}elseif($olddata->year!=$req->input('acyear')){
	  		$valarr=[
			    'acyear'=>'required|unique:academic_year,year|max:30',
			    'semister'=>'required|max:30',
			];
			$this->validate($req,$valarr);
		}
		$acyear=$req->input('acyear');
		$semister=$req->input('semister');
		$level=$req->input('level');
		$lvl=0;
		if($level){
			$lvl=1;
		}
		Acyear::where('id',$id)->update(['year'=>$acyear,'semister'=>$semister,'level_up'=>$lvl]);
		session()->push('m','success');
	    	    session()->push('m','Academic Year ('.$olddata->year.') has been updated successfully!');
		return back();
  	}
  	public function addgroup(Request $req){
  		$valarr=[
		    'acyear'=>'required|exists:academic_year,id',
		    'department'=>'required|exists:departments,id',
		    'group'=>'required|max:80',
		    'level'=>'required',
		];
		$this->validate($req,$valarr);
		$acyear=$req->input('acyear');
		$dep=$req->input('department');
		$group=$req->input('group');
		$level=$req->input('level');
		Groups::insert(['group_name'=>$group,'department_id'=>$dep,'academic_year'=>$acyear,'level'=>$level]);
		session()->push('m','success');
	    	    session()->push('m','New group has been added successfully!');
		return back();
  	}
  	public function addsec(Request $req){
  		$valarr=[
		    'group'=>'required|exists:groups,id',
		    'section'=>'required|max:80',
		    'capacity'=>'required|numeric|max:1000',
		];
		$this->validate($req,$valarr);
		$group=$req->input('group');
		$section=$req->input('section');
		$cap=$req->input('capacity');
		Sections::insert(['group_id'=>$group,'section_name'=>$section,'cap'=>$cap]);
		session()->push('m','success');
	    session()->push('m','New section has been added successfully!');
		return back();
  	}
  	public function editgroup(Request $req,$gid){
  		$valarr=[
		    'group'=>'required|max:80',
		    'level'=>'required'
		];
		$this->validate($req,$valarr);
		$group=$req->input('group');
		$level=$req->input('level');
		Groups::where('id',$gid)->update(['group_name'=>$group,'level'=>$level]);
		session()->push('m','success');
	    	    session()->push('m','Group has been updated successfully!');
		return back();
  	}
  	public function remgrp($gid){
  		$chk=Sections::where('group_id',$gid)->get();
  		if(count($chk)>0){
  			$error = \Illuminate\Validation\ValidationException::withMessages([
			   'Sections' => ['This Group Related with Sections'],
			]);
			throw $error;
  		}else{
  			Groups::where('id',$gid)->delete();
  		}
  		return back();
  	}
  	public function editsec(Request $req,$sid){
  		$valarr=[
		    'section'=>'required|max:80',
		    'capacity'=>'required|numeric|max:1000',
		];
		$this->validate($req,$valarr);
		$section=$req->input('section');
		$cap=$req->input('capacity');
		Sections::where('id',$sid)->update(['section_name'=>$section,'cap'=>$cap]);
		session()->push('m','success');
	    session()->push('m','Section has been updated successfully!');
		return back();
  	}
  	public function remsec($sid){
  		$chk=Stucou::where('section_id',$sid)->get();
  		if(count($chk)>0){
  			$error = \Illuminate\Validation\ValidationException::withMessages([
			   'Sections' => ['This Section Related with Sections'],
			]);
			throw $error;
  		}else{
  			Sections::where('id',$sid)->delete();
  		}
  		return back();
  	}
  	public function addcourse(Request $req){
  		$valarr=[
		    'name'=>'required|max:60|unique:courses,course_name',
		    'code'=>'required|max:10|unique:courses,code',
		    'credit'=>'required|max:7|integer',
		    'dep'=>'required|exists:departments,id',
		    'level'=>'required',
		    'lec'=>'required|max:9',
		    'sec'=>'required|max:9',
		    'lab'=>'required|max:9',
		    'lecp'=>'required|max:9',
		    'secp'=>'required|max:9',
		    'labp'=>'required|max:9',
		];
		$this->validate($req,$valarr);
		$name=$req->input('name');
		$code=$req->input('code');
		$credit=$req->input('credit');
		$dep=$req->input('dep');
		$level=$req->input('level');
		$lec=$req->input('lec');
		$sec=$req->input('sec');
		$lab=$req->input('lab');
		$lecp=$req->input('lecp');
		$secp=$req->input('secp');
		$labp=$req->input('labp');
		$prereq=explode(",", $req->input('prereq'));
		$st=0;
		if($req->input('status')){
			$st=1;
		}
		Courses::insert(['course_name'=>$name,'code'=>$code,'credit'=>$credit,'state'=>$st,'dep_id'=>$dep,'level'=>$level,'lec'=>$lec,'sec'=>$sec,'lab'=>$lab,'lec_periods'=>$lecp,'sec_periods'=>$secp,'lab_periods'=>$labp]);
		$getid=Courses::orderBy('id','desc')->first();
		foreach ($prereq as $value){
			if(!empty($value)){
				Prerequest::insert(['course_id'=>$getid->id,'prereq'=>$value]);
			}
		}
		session()->push('m','success');
	    session()->push('m','Course has been Added successfully!');
	    return back();
  	}
  	public function editcourse($couid,Request $req){
  		$valarr=[
		    'name'=>'required|max:60',
		    'code'=>'required|max:10|unique:courses,code',
		    'credit'=>'required|max:7|integer',
		    'dep'=>'required|exists:departments,id',
		    'level'=>'required',
		    'lec'=>'required|max:9',
		    'sec'=>'required|max:9',
		    'lab'=>'required|max:9',
		    'lecp'=>'required|max:9',
		    'secp'=>'required|max:9',
		    'labp'=>'required|max:9',
		];
		$this->validate($req,$valarr);
		$name=$req->input('name');
		$code=$req->input('code');
		$credit=$req->input('credit');
		$dep=$req->input('dep');
		$level=$req->input('level');
		$lec=$req->input('lec');
		$sec=$req->input('sec');
		$lab=$req->input('lab');
		$lecp=$req->input('lecp');
		$secp=$req->input('secp');
		$labp=$req->input('labp');
		$prereq=explode(",", $req->input('prereq'));
		$st=0;
		if($req->input('status')){
			$st=1;
		}
		Courses::where('id',$couid)->update(['course_name'=>$name,'code'=>$code,'credit'=>$credit,'state'=>$st,'dep_id'=>$dep,'level'=>$level,'lec'=>$lec,'sec'=>$sec,'lab'=>$lab,'lec_periods'=>$lecp,'sec_periods'=>$secp,'lab_periods'=>$labp]);
		Prerequest::where('course_id',$couid)->delete();
		foreach ($prereq as $value){
			if(!empty($value)){
				Prerequest::insert(['course_id'=>$couid,'prereq'=>$value]);
			}
		}
		session()->push('m','success');
	    session()->push('m','Course has been Updated successfully!');
	    return back();
  	}
  	public function editstu(Request $req,$sid){
  		$getdata=Studata::where('st_id',$sid)->first();
  		if(empty($getdata)){
  			return redirect('/admin/editstu');
  		}
  		$valarr=[
		    'dep'=>'required|exists:departments,id',
		    'level'=>'required',
		    'done'=>'required|integer|max:180',
		    'gpa'=>'required|numeric|max:5',
		    'cgpa'=>'required|numeric|max:5'
		];
		$this->validate($req,$valarr);
		$dep=$req->input('dep');
		$level=$req->input('level');
		$done=$req->input('done');
		$rem=180-$done;
		$gpa=$req->input('gpa');
		$cgpa=$req->input('cgpa');
		Studata::where('st_id',$sid)->update(['level'=>$level,'department'=>$dep,'GPA'=>$gpa,'CGPA'=>$cgpa,'done_hrs'=>$done,'rem_hrs'=>$rem]);
		session()->push('m','success');
	    session()->push('m','Student Data Updated successfully!');
		return back();
  	}
  	public function sturegs(Request $req,$sid){
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
	    session()->push('m','Student Registered Successfully!');
	    return back();
  	}
  	public function edsturegs(Request $req,$sid){
  		//Remove old register then insert new
  		Stucou::where('st_id',$sid)->delete();
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
	  			if($hrs<14||$hrs>18){
	  				$error = \Illuminate\Validation\ValidationException::withMessages([
				      'hours' => ["You Can't Exceed 18 Hours or Less 14 Hours"]
				   ]);
				   throw $error;
	  			}
	  		}else{
	  			if($hrs<14||$hrs>21){
	  				$error = \Illuminate\Validation\ValidationException::withMessages([
				      'hours' => ["You Can't Exceed 21 Hours or Less 14 Hours"]
				   ]);
				   throw $error;
	  			}
	  		}
	  	}else{
	  		if($hrs<14||$hrs>18){
  				$error = \Illuminate\Validation\ValidationException::withMessages([
			      'hours' => ["You Can't Exceed 18 Hours or Less 14 Hours"]
			   ]);
			   throw $error;
  			}
	  	}
  		foreach ($cou as $v) {
  			Stucou::insert(['st_id'=>$sid,'course_id'=>$v,'course_state'=>0,'section'=>$sec[$v],'grade'=>'']);
  		}
  		session()->push('m','success');
	    session()->push('m','Student Edit Register Successfully!');
	    return back();
  	}
  	public function sysst(Request $req){
  		$sysst=$req->input('sysst');
		$acyear=$req->input('acyear');
		$chk=Syssta::where('id',1)->first();
		$chk2=Acyear::where('id',$acyear)->first();
		if($chk->ac_year!=$acyear){
			$sysst=0;
			$stu=Studata::all();
			Absence::truncate();
			foreach ($stu as $st) {
				if($st->CGPA>2&&$chk2->level_up==1){
					if($st->level<5){
						Studata::where('st_id',$st->st_id)->update(['level'=>$st->level+1]);
					}
				}
				Studata::where('st_id',$st->id)->update(['ac_year'=>$acyear]);
				$getdata=Stucou::where('st_id',$st->st_id)->get();
				foreach ($getdata as $d) {
					$cstate=1;
					if($d->grade=="F"){
						$cstate=2;
					}
					Stuhis::insert(['st_id'=>$st->st_id,'course_id'=>$d->course_id,'course_state'=>$cstate,'annual_evaluation'=>$d->annual_evaluation,'mid_term'=>$d->mid_term,'final'=>$d->final_degree,'grade'=>$d->grade,'ac_year'=>$chk->ac_year]);
					Stucou::where('id',$d->id)->delete();
				}
			}
		}
		//Create All Tables
		if($sysst==1){
			Cousch::truncate(); // Clear old tables
			for ($levels=0; $levels <5 ; $levels++) {
				$reqper=0;
				$reqperc=Courses::where('level',$levels)->get();
				$avcou=[];
				foreach ($reqperc as $v) {
					$registerd=Stucou::where('course_id',$v->id)->first();
					if(!empty($registerd)){
						$reqper+=$v->lec_periods+$v->sec_periods+$v->lab_periods;
						$avcou[]=$v;
					}
				}
				$percount=Periods::count();
				while($reqper>0){
					for ($days=0; $days <5 ; $days++) {
						for ($periods=0; $periods <$percount ; $periods++) {
							foreach ($avcou as $v) {
								//P1-Course Requirements
								$stat=Syssta::where('id',1)->first();
								$sections=Sections::join('groups','groups.id','=','sections.group_id')
								->where('groups.level',$levels)->where('groups.year',$stat->ac_year)->select('sections.*')->get();
								$needlec=$needsec=$needlab=false;
								if($v->lec!=0){
									$needlec=true;
								}
								if($v->sec!=0){
									$needsec=true;
								}
								if($v->lab!=0){
									$needlab=true;
								}
								//P2-Check Students Requirments
								if($needlec){
									$groups=Groups::where('level',$levels)->where('year',$stat->ac_year)->get();
									$grpnedlec=$groups;
									foreach ($groups as $k=> $vx) {
										$chklec=Cousch::where('course_id',$v->id)
										->where('section_id',$vx->id)->where('type','lec')->get();
										if(count($chklec)==$v->lec_periods){
											unset($grpnedlec[$k]);
										}
										$secofgroup=Sections::where('group_id',$vx->id)->get();
										$stillneed=false;
										foreach ($secofgroup as $sog) {
											$chksec=Stucou::where('course_id',$v->id)->where('section',$sog->id)->first();
											if(!empty($chksec)){
												$stillneed=true;
											}
										}
										if(!$stillneed){
											unset($grpnedlec[$k]);
										}
									}
								}
								if($needsec){
									$secnedsec=$sections;
									foreach ($sections as $k=> $vx) {
										$chksec=Cousch::where('course_id',$v->id)
										->where('section_id',$vx->id)->where('type','sec')->get();
										if(count($chksec)==$v->sec_periods){
											unset($secnedsec[$k]);
										}
										$chksec=Stucou::where('course_id',$v->id)->where('section',$vx->id)->first();
										if(empty($chksec)){
											unset($secnedsec[$k]);
										}
									}
								}
								if($needlab){
									$secnedlab=$sections;
									foreach ($sections as $kk=> $vx) {
										$chklab=Cousch::where('course_id',$v->id)
										->where('section_id',$vx->id)->where('type','lab')->get();
										if(count($chklab)>=$v->lab_periods){
											unset($secnedlab[$kk]);
										}
										$chksec=Stucou::where('course_id',$v->id)->where('section',$vx->id)->first();
										if(empty($chksec)){
											unset($secnedlab[$k]);
										}
									}
								}
								if($needlec){
									if(count($grpnedlec)==0){
										$needlec=false;
										$reqper-=$v->lec_periods;
									}
								}
								if($needsec){
									if(count($secnedsec)==0){
										$needsec=false;
										$reqper-=$v->sec_periods;
									}
								}
								if($needlab){
									if(count($secnedlab)==0){
										$needlab=false;
										$reqper-=$v->lab_periods;
									}
								}
								//P3-Check Student Availabilty
								$readygroups=[];
								$readysections=[];
								$readylabs=[];
								if($needlec){
									$thereconf=false;
									foreach ($grpnedlec as $k=>$vx) {
										$getsec=Sections::where('group_id',$vx->id)->get();
										foreach ($getsec as $vv) {
											$getstudents=Stucou::where('section',$vv->id)->get();
											foreach ($getstudents as $vvv) {
												$getsturegcou=Stucou::where('st_id',$vvv->st_id)->get();
												foreach ($getsturegcou as $vvvv) {
													$conflict=Cousch::where('course_id',$vvvv->course_id)
													->where('day',$days)->where('period_id',$periods)->first();
													if(!empty($conflict)){
														$thereconf=true;
													}
												}
											}
										}
									if(!$thereconf)
									$readygroups[]=$vx;
									}
								}
								if($needsec){
									foreach ($secnedsec as $vv) {
										$thereconf=false;
										$getstudents=Stucou::where('section',$vv->id)->get();
										foreach ($getstudents as $vvv) {
											$getsturegcou=Stucou::where('st_id',$vvv->st_id)->get();
											foreach ($getsturegcou as $vvvv) {
												$conflict=Cousch::where('course_id',$vvvv->course_id)
												->where('day',$days)->where('period_id',$periods)->first();
												if(!empty($conflict)){
													$thereconf=true;
												}
											}
										}
										if(!$thereconf)
											$readysections[]=$vv;
									}
								}
								if($needlab){
									foreach ($secnedlab as $vv) {
										$thereconf=false;
										$getstudents=Stucou::where('section',$vv->id)->get();
										foreach ($getstudents as $vvv) {
											$getsturegcou=Stucou::where('st_id',$vvv->st_id)->get();
											foreach ($getsturegcou as $vvvv) {
												$conflict=Cousch::where('course_id',$vvvv->course_id)
												->where('day',$days)->where('period_id',$periods)->first();
												if(!empty($conflict)){
													$thereconf=true;
												}
											}
										}
										if(!$thereconf)
											$readylabs[]=$vv;
									}
								}
								if($needlab){
									if (count($readylabs)>0) {
										$chklabemp=Cousch::where('course_id',$v->id)->where('period_id',$periods)
										->where('day',$days)->where('type','lab')->first();
										if(empty($chklabemp)){
											Cousch::insert(['course_id'=>$v->id,'period_id'=>$periods,'section_id'=>$readylabs[0]->id,'day'=>$days,'type'=>'lab']);
										}
									}
								}elseif($needsec){
									$instructors=Assisdata::all();
									$assistforcou=[];
									foreach ($instructors as $inst) {
										$icourses=explode('|', $inst->courses);
										foreach ($icourses as $ic) {
											if($ic==$v->id){
												$assistforcou[]=$inst;
												break;
											}
										}
									}
									$avassis=[];
									foreach ($assistforcou as $assico) {
										$chk=Cousch::where('period_id',$periods)->where('day',$days)
										->where('instructor_id',$assico->assis_id)->first();
										if(empty($chk)){
											$avassis[]=$assico;
											break;
										}
									}
									$places=Places::where('type',2)->get();
									$avplace=[];
									foreach ($places as $pla) {
										$chk=Cousch::where('period_id',$periods)->where('day',$days)
										->where('place_id',$pla->id)->first();
										if(empty($chk)){
											$avplace[]=$pla;
										}
									}
									if(count($readysections)>0&&count($avassis)>0&&count($avplace)>0){
										Cousch::insert(['course_id'=>$v->id,'period_id'=>$periods,'section_id'=>$readysections[0]->id,'place_id'=>$avplace[0]->id,'instructor_id'=>$avassis[0]->assis_id,'day'=>$days,'type'=>'sec']);
									}
								}elseif($needlec){
									$instructors=Docdata::all();
									$assistforcou=[];
									foreach ($instructors as $inst) {
										$icourses=explode('|', $inst->courses);
										foreach ($icourses as $ic) {
											if($ic==$v->id){
												$assistforcou[]=$inst;
												break;
											}
										}
									}
									$avassis=[];
									foreach ($assistforcou as $assico) {
										$chk=Cousch::where('period_id',$periods)->where('day',$days)
										->where('instructor_id',$assico->assis_id)->first();
										if(empty($chk)){
											$avassis[]=$assico;
											break;
										}
									}
									$places=Places::where('type',1)->get();
									$avplace=[];
									foreach ($places as $pla) {
										$chk=Cousch::where('period_id',$periods)->where('day',$days)
										->where('place_id',$pla->id)->first();
										if(empty($chk)){
											$avplace[]=$pla;
										}
									}
									if(count($readygroups)>0&&count($avassis)>0&&count($avplace)>0){
										Cousch::insert(['course_id'=>$v->id,'period_id'=>$periods,'section_id'=>$readygroups[0]->id,'place_id'=>$avplace[0]->id,'instructor_id'=>$avassis[0]->dr_id,'day'=>$days,'type'=>'lec']);
									}
								}
							}
						}
					}
				}
			}
		}
		//Calculate GPA
		if($sysst==3){
			$stucou=Stucou::join('courses','courses.id','=','student_course.course_id')
			->select('student_course.*','courses.credit')->get();
			foreach ($stucou as $s) {
				$score=$s->annual_evaluation+$s->mid_term+$s->final_degree;
				if($score>=95){
					Stucou::where('id',$s->id)->update(['grade'=>'A+']);
				}elseif($score>=90){
					Stucou::where('id',$s->id)->update(['grade'=>'A']);
				}elseif($score>=85){
					Stucou::where('id',$s->id)->update(['grade'=>'A-']);
				}elseif($score>=80){
					Stucou::where('id',$s->id)->update(['grade'=>'B+']);
				}elseif($score>=75){
					Stucou::where('id',$s->id)->update(['grade'=>'B']);
				}elseif($score>=70){
					Stucou::where('id',$s->id)->update(['grade'=>'C+']);
				}elseif($score>=65){
					Stucou::where('id',$s->id)->update(['grade'=>'C']);
				}elseif($score>=60){
					Stucou::where('id',$s->id)->update(['grade'=>'D+']);
				}elseif($score>=55){
					Stucou::where('id',$s->id)->update(['grade'=>'D']);
				}elseif($score>=50){
					Stucou::where('id',$s->id)->update(['grade'=>'D-']);
				}else{
					Stucou::where('id',$s->id)->update(['grade'=>'F']);
				}
			}
			$students=Studata::all();
			foreach ($students as $st) {
				$cscore=$st->CGPA*$st->done_hrs;
				$ccredits=$st->done_hrs;
				$score=0;
				$credits=0;
				$stucou=Stucou::join('courses','courses.id','=','student_course.course_id')
					->where('student_course.st_id',$st->st_id)
					->select('student_course.*','courses.credit')->get();
					$evcr=0;
				foreach ($stucou as $s) {
					if($s->grade=="A+"){
						$points=4;
					}elseif($s->grade=="A"){
						$points=3.7;
					}elseif($s->grade=="A-"){
						$points=3.3;
					}elseif($s->grade=="B+"){
						$points=3.0;
					}elseif($s->grade=="B"){
						$points=2.7;
					}elseif($s->grade=="C+"){
						$points=2.3;
					}elseif($s->grade=="C"){
						$points=2.0;
					}elseif($s->grade=="D+"){
						$points=1.7;
					}elseif($s->grade=="D"){
						$points=1.3;
					}elseif($s->grade=="D-"){
						$points=1.0;
					}else{
						$points=0;
						$evcr+=$s->credit;
					}
					$score+=$points*$s->credit;
					$cscore+=$points*$s->credit;
					$credits+=$s->credit;
					$ccredits+=$s->credit;
				}
				if($credits!=0){
					$gpa=$score/$credits;
				}else{
					$gpa=$st->GPA;
				}
				if($ccredits!=0){
					$cgpa=$cscore/$ccredits;
				}else{
					$cgpa=$st->CGPA;
				}
				Studata::where('st_id',$st->st_id)->update(['GPA'=>$gpa,'CGPA'=>$cgpa,'done_hrs'=>($ccredits-$evcr),'rem_hrs'=>(180-($ccredits-$evcr))]);
			}
		}
		Syssta::where('id',1)->update(['state'=>$sysst,'ac_year'=>$acyear]);
		session()->push('m','success');
	    session()->push('m','System Status Updated Successfully!');
		return back();
  	}
  	public function editui(Request $req){
  		$valarr=[
		    'tap'=>'required|max:400|min:20',
		    'about'=>'required',
		    'departments'=>'required',
		];
		$this->validate($req,$valarr);
  		$tap=$req->input('tap');
  		$about=$req->input('about');
  		$departments=$req->input('departments');
		Uidata::where('id',1)->update(['data'=>$tap]);
		Uidata::where('id',2)->update(['data'=>$about]);
		Uidata::where('id',3)->update(['data'=>$departments]);
		session()->push('m','success');
	    session()->push('m','System UI Updated Successfully!');
		return back();
  	}
  	public function upload(Request $req){
    	$valarr=[
			'img'=>'required|image|max:8192'
    	];
    	$this->validate($req,$valarr);
    	$image =$req->file('img');
	    $photoPath = public_path('/tempimg');
    	$photoName=str_random(32);
        $photoName.='.'.$image->getClientOriginalExtension();
        $image->move($photoPath,$photoName);
        return view('/admin/upload')->withUrl(asset('/tempimg').'/'.$photoName);
    }
    public function addperiod(Request $req){
  		$valarr=[
		    'name'=>'required|max:20',
		    'from'=>'required',
		    'to'=>'required',
		];
		$this->validate($req,$valarr);
  		$name=$req->input('name');
  		$from=$req->input('from');
  		$to=$req->input('to');
		Periods::insert(['name'=>$name,'start_time'=>$from,'end_time'=>$to]);
		session()->push('m','success');
	    session()->push('m','Period Added Successfully!');
		return back();
  	}
  	public function editperiod($pid,Request $req){
  		$valarr=[
		    'name'=>'required|max:20',
		    'from'=>'required',
		    'to'=>'required',
		];
		$this->validate($req,$valarr);
  		$name=$req->input('name');
  		$from=$req->input('from');
  		$to=$req->input('to');
		Periods::where('id',$pid)->update(['name'=>$name,'start_time'=>$from,'end_time'=>$to]);
		session()->push('m','success');
	    session()->push('m','Period Updated Successfully!');
		return back();
  	}
  	public function addwarning(Request $req){
  		$valarr=[
		    'name'=>'required|max:20',
		    'count'=>'required|numeric',
		];
		$this->validate($req,$valarr);
  		$name=$req->input('name');
  		$count=$req->input('count');
  		$withdraw=$req->input('withdraw');
  		$wd=0;
  		if($withdraw){
  			$wd=1;
  		}
		Warnings::insert(['name'=>$name,'count'=>$count,'withdraw'=>$wd]);
		session()->push('m','success');
	    session()->push('m','Warning Added Successfully!');
		return back();
  	}
  	public function editwarning($wid,Request $req){
  		$valarr=[
		    'name'=>'required|max:20',
		    'count'=>'required|numeric',
		];
		$this->validate($req,$valarr);
  		$name=$req->input('name');
  		$count=$req->input('count');
  		$withdraw=$req->input('withdraw');
  		$wd=0;
  		if($withdraw){
  			$wd=1;
  		}
		Warnings::where('id',$wid)->update(['name'=>$name,'count'=>$count,'withdraw'=>$wd]);
		session()->push('m','success');
	    session()->push('m','Warning Updated Successfully!');
		return back();
  	}
  	public function editdoc(Request $req,$did){
  		$department=$req->input('dep');
  		$courses=substr($req->input('courses'),0,-1);
  		$chkdoc=Docdata::where('dr_id',$did)->first();
  		if(empty($chkdoc)){
  			Docdata::insert(['courses'=>$courses,'dr_id'=>$did,'department'=>$department]);
  		}else{
  			Docdata::where('dr_id',$did)->update(['courses'=>$courses,'department'=>$department]);
  		}
		session()->push('m','success');
	    session()->push('m','Doctor Data Updated Successfully!');
		return back();
  	}
  	public function editassis($aid,Request $req){
  		$department=$req->input('dep');
  		$courses=substr($req->input('courses'),0,-1);
  		$chkasi=Assisdata::where('assis_id',$aid)->first();
  		if(empty($chkasi)){
  			Assisdata::insert(['courses'=>$courses,'assis_id'=>$aid,'department'=>$department]);
  		}else{
  			Assisdata::where('assis_id',$aid)->update(['courses'=>$courses,'department'=>$department]);
  		}
		session()->push('m','success');
	    session()->push('m','Assistant Data Updated Successfully!');
		return back();
  	}
  	public function addexperiod(Request $req){
  		$valarr=[
		    'name'=>'required|max:20',
		    'from'=>'required',
		    'to'=>'required',
		];
		$this->validate($req,$valarr);
  		$name=$req->input('name');
  		$from=$req->input('from');
  		$to=$req->input('to');
		Experiod::insert(['name'=>$name,'start_time'=>$from,'end_time'=>$to]);
		session()->push('m','success');
	    session()->push('m','Period Added Successfully!');
		return back();
  	}
  	public function editexperiod($pid,Request $req){
  		$valarr=[
		    'name'=>'required|max:20',
		    'from'=>'required',
		    'to'=>'required',
		];
		$this->validate($req,$valarr);
  		$name=$req->input('name');
  		$from=$req->input('from');
  		$to=$req->input('to');
		Experiod::where('id',$pid)->update(['name'=>$name,'start_time'=>$from,'end_time'=>$to]);
		session()->push('m','success');
	    session()->push('m','Period Updated Successfully!');
		return back();
  	}
  	public function addexam($lvl,Request $req){
  		$valarr=[
		    'course'=>'required',
		    'period'=>'required',
		    'date'=>'required|max:20',
		    'place'=>'required',
		    'level'=>'required',
		];
		$this->validate($req,$valarr);
  		$course=$req->input('course');
  		$period=$req->input('period');
  		$date=$req->input('date');
  		$place=$req->input('place');
  		$level=$req->input('level');
		Extable::insert(['course_id'=>$course,'exam_period'=>$period,'day'=>$date,'place'=>$place,'level'=>$level]);
		session()->push('m','success');
	    session()->push('m','Course Inserted Successfully!');
		return back();
  	}
  	public function remex($tid){
  		Extable::where('id',$tid)->delete();
  		session()->push('m','success');
	    session()->push('m','Course Removed Successfully!');
  		return back();
  	}
}
