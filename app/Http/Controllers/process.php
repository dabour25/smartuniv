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

class process extends Controller
{
    public function sendmes(Request $req){
        $valarr=[
           'name'=>'required|max:50|min:3',
           'email'=>'required|email|max:60',
           'subject'=>'required|max:60',
           'message'=>'required|max:1000'
        ];
        $this->validate($req,$valarr);
        $name=$req->input('name');
        $email=$req->input('email');
        $subject=$req->input('subject');
        $message=$req->input('message');
        Messages::insert(['name'=>$name,'email'=>$email,'subject'=>$subject,'message'=>$message]);
        session()->push('m','success');
        session()->push('m','Message Sent to Admin Successfully!');
        return back();
    }
}
