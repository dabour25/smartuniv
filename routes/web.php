<?php

/*
Smart Universities - Graduation Project - Routes
This file created by Eng.Ahmed Magdy at 26/1/2019 11:22PM
This file Modified and Developed by Eng.Ahmed Magdy & Eng.Radwa Essam
Project team : Ahmed Magdy - Eslam Ali - Radwa Essam - Ashraqat Mostafa - Walaa Karam - Wessam Nabil - Fatma Mohammed -
Osama Abbas
*/

Route::get('/','router@index');
Route::get('/home','router@index');
Route::get('/contact','router@contact');
Route::post('/sendmes','process@sendmes');
Route::get('/about','router@about');
Route::get('/departments','router@departments');
Route::get('/out','Auth\LoginController@logout');

//Login
Route::get('/login/admin', 'Auth\LoginController@getAdminlogin');
Route::get('/login/doctor', 'Auth\LoginController@getDoctorlogin');
Route::get('/login/assistant', 'Auth\LoginController@getAssistantlogin');
Route::get('/login/student', 'Auth\LoginController@getStudentlogin');

Route::post('/login/admin', 'Auth\LoginController@adminLogin');
Route::post('/login/doctor', 'Auth\LoginController@doctorLogin');
Route::post('/login/assistant', 'Auth\LoginController@assistantLogin');
Route::post('/login/student', 'Auth\LoginController@studentLogin');

//Admin DB
Route::prefix('admin')->group(function () {
	Route::get('/','adminrouter@index');
	//Admin Department
	Route::get('/newdeb','adminrouter@newdeb');
	Route::post('/adddeb','adminprocess@adddep');
	Route::get('/editdeb','adminrouter@editdeb');
	Route::get('/editdeb/{did}','adminrouter@editdebd');
	Route::post('/editdeb/{did}','adminprocess@editdeb');
	//Admin Places
	Route::get('/newpla','adminrouter@newpla');
	Route::post('/addpla','adminprocess@addpla');
	Route::get('/editpla','adminrouter@editpla');
	Route::get('/editpla/search/{sr}','adminrouter@editplas');
	Route::get('/editpla/{pid}','adminrouter@editplap');
	Route::post('/editpla/{pid}','adminprocess@editpla');
	Route::get('/rempla/{pid}','adminprocess@rempla');
	//Admin Users
	Route::get('/adddoctor','adminrouter@adddoctor');
	Route::post('/adddoctor','adminprocess@adddoctor');
	Route::get('/edituser','adminrouter@edituser');
	Route::get('/edituser/search/{sr}','adminrouter@editusers');
	Route::get('/edituser/{uid}','adminrouter@edituseru');
	Route::post('/edituser/{uid}','adminprocess@edituser');
	Route::get('/editstu','adminrouter@editstu');
	Route::get('/editstu/search/{s}','adminrouter@editstus');
	Route::get('/editstu/{sid}','adminrouter@editstusd');
	Route::post('/editstu/{sid}','adminprocess@editstu');
	Route::get('/editdoc','adminrouter@editdoc');
	Route::get('/editdoc/search/{s}','adminrouter@editdocs');
	Route::get('/editdoc/{did}','adminrouter@editdocd');
	Route::post('/editdoc/{did}','adminprocess@editdoc');
	Route::get('/editassis','adminrouter@editassis');
	Route::get('/editassis/search/{s}','adminrouter@editassiss');
	Route::get('/editassis/{aid}','adminrouter@editassisd');
	Route::post('/editassis/{aid}','adminprocess@editassis');
	//Admin Academic Config
	Route::get('/acyear','adminrouter@acyear');
	Route::post('/addac','adminprocess@addac');
	Route::post('/editac/{id}','adminprocess@editac');
	//Admin Group
	Route::get('/addgroup','adminrouter@addgroup');
	Route::post('/addgroup','adminprocess@addgroup');
	Route::get('/editgroup','adminrouter@editgroup');
	Route::get('/editgroup/{gid}','adminrouter@editgroupg');
	Route::post('/editgroup/{gid}','adminprocess@editgroup');
	Route::get('/remgrp/{gid}','adminprocess@remgrp');
	//Admin Sections
	Route::get('/addsec','adminrouter@addsec');
	Route::get('/selsec','adminrouter@selsecerr'); //Handle Refresh
	Route::post('/selsec','adminrouter@selsec');
	Route::post('/addsec','adminprocess@addsec');
	Route::get('/editsec','adminrouter@editsec');
	Route::get('/editsec/{sid}','adminrouter@editsecs');
	Route::post('/editsec/{sid}','adminprocess@editsec');
	Route::get('/remsec/{sid}','adminprocess@remsec');
	//Admin Periods
	Route::get('/periods','adminrouter@periods');
	Route::get('/editperiod/{pid}','adminrouter@editperiod');
	Route::post('/addperiod','adminprocess@addperiod');
	Route::post('/editperiod/{pid}','adminprocess@editperiod');
	//Admin Warnings
	Route::get('/warnings','adminrouter@warnings');
	Route::get('/editwarning/{wid}','adminrouter@editwarning');
	Route::post('/addwarning','adminprocess@addwarning');
	Route::post('/editwarning/{wid}','adminprocess@editwarning');
	//Admin Registeration
	Route::get('/addcourse','adminrouter@addcourse');
	Route::post('/addcourse','adminprocess@addcourse');
	Route::get('/editcourse','adminrouter@editcourse');
	Route::get('/editcourse/{couid}','adminrouter@editcoursec');
	Route::post('/editcourse/{couid}','adminprocess@editcourse');
	Route::get('/stureg','adminrouter@stureg');
	Route::post('/stureg','adminrouter@sturegs');
	Route::post('/sturegs/{sid}','adminprocess@sturegs');
	Route::get('/edstureg','adminrouter@edstureg');
	Route::post('/edstureg','adminrouter@edsturegs');
	Route::post('/edsturegs/{sid}','adminprocess@edsturegs');
	//Admin Status
	Route::get('/sysst','adminrouter@sysst');
	Route::post('/sysst','adminprocess@sysst');
	//Admin Messages
	Route::get('/messages','adminrouter@messages');
});
//Admin UI
Route::get('/admin/ui','adminrouter@ui');
Route::post('/admin/editui','adminprocess@editui');
Route::get('/upload/editor','adminrouter@upload');
Route::post('/upload/editor','adminprocess@upload');
//Admin Exams
Route::get('/admin/experiod','adminrouter@experiod');
Route::get('/admin/editexperiod/{pid}','adminrouter@editexperiod');
Route::post('/admin/addexperiod','adminprocess@addexperiod');
Route::post('/admin/editexperiod/{pid}','adminprocess@editexperiod');
Route::get('/admin/extables','adminrouter@extables');
Route::get('/admin/extables/{lvl}','adminrouter@extablesl');
Route::post('/admin/addexam/{lvl}','adminprocess@addexam');
Route::get('/admin/remex/{tid}','adminprocess@remex');

//Student Index
Route::get('/student','studentrouter@index');
Route::get('/student/warnings','studentrouter@warnings');
Route::get('/student/register','studentrouter@register');
Route::post('/student/register','studentprocess@register');
Route::get('/student/results','studentrouter@results');
Route::get('/student/question','studentrouter@question');
Route::post('/student/question','studentprocess@question');
Route::get('/student/table','studentrouter@table');
Route::get('/student/showques','studentrouter@showques');
Route::get('/student/quiz','studentrouter@quiz');
Route::get('/student/quiz/{qid}','studentrouter@quizs');
Route::post('/student/quizans/{qid}','studentprocess@quiz');
Route::get('/student/ftable','studentrouter@ftable');
Route::get('/student/evaluation','studentrouter@evaluation');
Route::post('/student/evaluate','studentprocess@evaluate');
Route::get('/student/history','studentrouter@history');
Route::get('/student/drive','studentrouter@drive');

//Doctors Index
Route::get('/doctor','doctorrouter@index');
Route::get('/doctor/question','doctorrouter@question');
Route::post('/doctor/question','doctorprocess@question');
Route::get('/doctor/ansques','doctorrouter@ansques');
Route::get('/doctor/ansques/{qid}','doctorrouter@ansquesq');
Route::post('/doctor/ansques/{qid}','doctorprocess@ansques');
Route::get('/doctor/table','doctorrouter@table');
Route::get('/doctor/results','doctorrouter@results');
Route::get('/doctor/results/{cid}','doctorrouter@resultsc');
Route::post('/doctor/results/{cid}','doctorprocess@results');
Route::get('/doctor/quiz','doctorrouter@quiz');
Route::get('/doctor/createquiz','doctorrouter@createquiz');
Route::post('/doctor/createquiz','doctorprocess@createquiz');
Route::get('/doctor/quiztog/{qid}','doctorprocess@quiztog');
Route::get('/doctor/quiz/{qid}','doctorrouter@quizq');
Route::get('/doctor/quiz/{qid}/{sid}','doctorrouter@quizs');
Route::get('/doctor/drive','doctorrouter@drive');
Route::post('/doctor/drive','doctorprocess@drive');
Route::get('/doctor/remdrive/{did}','doctorprocess@remdrive');
Route::get('/doctor/attend','doctorrouter@attend');
Route::get('/doctor/remabs/{aid}','doctorprocess@remabs');

Route::get('/apitest','router@apitest');
Route::get('/getusersapi','router@getusersapi');

Auth::routes();
