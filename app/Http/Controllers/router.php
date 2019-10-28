<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use Hash;
use Auth;
//DB Models
//use App\Users;
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

class router extends Controller
{
	public function __construct(){
       $uidata = Uidata::all();
       View::share('uidata', $uidata);
   }
    public function index(){
    	$page_name='HOME';
    	return view('welcome',compact('page_name'));
    }
    public function contact(){
    	$page_name='CONTACT';
    	return view('contact',compact('page_name'));
    }
    public function about(){
    	$page_name='ABOUT';
    	return view('about',compact('page_name'));
    }
    public function departments(){
    	$page_name='DEPARTMENTS';
    	return view('departments',compact('page_name'));
    }
	public function getusersapi(){
    	$users=Users::all();
		return response()->json(['users'=>$users],200, [], JSON_UNESCAPED_UNICODE);
    }
	public function apitest(){
    	return view('apitest');
    }
}
