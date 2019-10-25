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

//Admin DB
Route::get('/admin','adminrouter@index');
//Admin Department
Route::get('/admin/newdeb','adminrouter@newdeb');
Route::post('/admin/adddeb','adminprocess@adddep');
Route::get('/admin/editdeb','adminrouter@editdeb');
Route::get('/admin/editdeb/{did}','adminrouter@editdebd');
Route::post('/admin/editdeb','adminprocess@editdeb');
//Admin Places
Route::get('/admin/newpla','adminrouter@newpla');
Route::post('/admin/addpla','adminprocess@addpla');
Route::get('/admin/editpla','adminrouter@editpla');
Route::get('/admin/editpla/search/{sr}','adminrouter@editplas');
Route::get('/admin/editpla/{pid}','adminrouter@editplap');
Route::post('/admin/editpla/{pid}','adminprocess@editpla');
Route::get('/admin/rempla/{pid}','adminprocess@rempla');
//Admin Users
Route::get('/admin/newuser','adminrouter@newuser');
Route::post('/admin/adduser','adminprocess@adduser');
Route::get('/admin/edituser','adminrouter@edituser');
Route::get('/admin/edituser/search/{sr}','adminrouter@editusers');
Route::get('/admin/edituser/{uid}','adminrouter@edituseru');
Route::post('/admin/edituser/{uid}','adminprocess@edituser');
Route::get('/admin/editstu','adminrouter@editstu');
Route::get('/admin/editstu/search/{s}','adminrouter@editstus');
Route::get('/admin/editstu/{sid}','adminrouter@editstusd');
Route::post('/admin/editstu/{sid}','adminprocess@editstu');
Route::get('/admin/editdoc','adminrouter@editdoc');
Route::get('/admin/editdoc/search/{s}','adminrouter@editdocs');
Route::get('/admin/editdoc/{did}','adminrouter@editdocd');
Route::post('/admin/editdoc/{did}','adminprocess@editdoc');
Route::get('/admin/editassis','adminrouter@editassis');
Route::get('/admin/editassis/search/{s}','adminrouter@editassiss');
Route::get('/admin/editassis/{aid}','adminrouter@editassisd');
Route::post('/admin/editassis/{aid}','adminprocess@editassis');
//Admin Academic Config
Route::get('/admin/acyear','adminrouter@acyear');
Route::post('/admin/addac','adminprocess@addac');
Route::post('/admin/editac','adminprocess@editac');
//Admin Group
Route::get('/admin/addgroup','adminrouter@addgroup');
Route::post('/admin/addgroup','adminprocess@addgroup');
Route::get('/admin/editgroup','adminrouter@editgroup');
Route::get('/admin/editgroup/{gid}','adminrouter@editgroupg');
Route::post('/admin/editgroup/{gid}','adminprocess@editgroup');
Route::get('/admin/remgrp/{gid}','adminprocess@remgrp');
//Admin Sections
Route::get('/admin/addsec','adminrouter@addsec');
Route::get('/admin/selsec','adminrouter@selsecerr'); //Handle Refresh
Route::post('/admin/selsec','adminrouter@selsec');
Route::post('/admin/addsec','adminprocess@addsec');
Route::get('/admin/editsec','adminrouter@editsec');
Route::get('/admin/editsec/{sid}','adminrouter@editsecs');
Route::post('/admin/editsec/{sid}','adminprocess@editsec');
Route::get('/admin/remsec/{sid}','adminprocess@remsec');
//Admin Periods
Route::get('/admin/periods','adminrouter@periods');
Route::get('/admin/editperiod/{pid}','adminrouter@editperiod');
Route::post('/admin/addperiod','adminprocess@addperiod');
Route::post('/admin/editperiod/{pid}','adminprocess@editperiod');
//Admin Warnings
Route::get('/admin/warnings','adminrouter@warnings');
Route::get('/admin/editwarning/{wid}','adminrouter@editwarning');
Route::post('/admin/addwarning','adminprocess@addwarning');
Route::post('/admin/editwarning/{wid}','adminprocess@editwarning');
//Admin Registeration
Route::get('/admin/addcourse','adminrouter@addcourse');
Route::post('/admin/addcourse','adminprocess@addcourse');
Route::get('/admin/editcourse','adminrouter@editcourse');
Route::get('/admin/editcourse/{couid}','adminrouter@editcoursec');
Route::post('/admin/editcourse/{couid}','adminprocess@editcourse');
Route::get('/admin/stureg','adminrouter@stureg');
Route::post('/admin/stureg','adminrouter@sturegs');
Route::post('/admin/sturegs/{sid}','adminprocess@sturegs');
Route::get('/admin/edstureg','adminrouter@edstureg');
Route::post('/admin/edstureg','adminrouter@edsturegs');
Route::post('/admin/edsturegs/{sid}','adminprocess@edsturegs');
//Admin Status
Route::get('/admin/sysst','adminrouter@sysst');
Route::post('/admin/sysst','adminprocess@sysst');
//Admin Messages
Route::get('/admin/messages','adminrouter@messages');
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
