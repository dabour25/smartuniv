<?php

use Illuminate\Database\Seeder;
use App\Admins;
use App\Uidata;
use App\Acyear;
use App\Syssta;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        Admins::insert(['email'=>'admin@smartuniv.com','password'=>Hash::make('Admin2019')]); //First Admin
        Uidata::insert(['data'=>'News tap']);
        Uidata::insert(['data'=>'']);
        Uidata::insert(['data'=>'']);
        Acyear::insert(['year'=>'2019/2020','semister'=>'1']);
        Syssta::insert(['state'=>0,'academic_year'=>1]);
    }
}
