<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            'Jakob Crowder' => 'jcrowder@corus360.com',
            'Liz Czuper' => 'lczuper@corus360.com',
            'Karly Coile' => 'kcoile@corus360.com',
            'Kelly Lester' => 'Klester@corus360.com',
            'Hailey MacLaren' => 'hmaclaren@corus360.com',
            'Michelle Martin' => 'mmartin@corus360.com',
            'Michael Kramer' => 'mkramer@corus360.com',
            'Meghan Fernandez' => 'mfernandez@corus360.com',
            'Kaylie Barwig' => 'kbarwig@corus360.com',
            'Michelle Casto' => 'mcasto@corus360.com',
            'Christie White' => 'cwhite@corus360.com',
            'Beth Smith' => 'bsmith@corus360.com',
            'Steve Riescher' => 'sriescher@corus360.com',
            'Kristin Miller' => 'kmiller@corus360.com',
            'Brandy Busby' => 'bbusby@corus360.com',
            'Doug Lobdell' => 'dlobdell@corus360.com',
            'Sharon Steingruber' => 'ssteingruber@corus360.com',
            'April Holland' => 'aholland@corus360.com',
            'Dara Merlin' => 'dmerlin@corus360.com',
            'mbiscan' => 'mbiscan@corus360.com',
            'Sammy Kite' => 'skite@corus360.com',
            'Kori Losack' => 'klosack@corus360.com',
            'Tina Rhoads' => 'trhoads@corus360.com',
            'Christina Brickers' => 'cbrickers@corus360.com',
            'Jon Bostocky' => 'jbostocky@corus360.com',
            'Sarah Mathews' => 'smathews@corus360.com',
            'Jessica Sample' => 'jsample@corus360.com',
            'Taylor Seyfer' => 'tseyfer@corus360.com',
            'Kellen Kuglar' => 'kkuglar@corus360.com',
            'Heather Roan' => 'hroan@corus360.com',
            'Adnan Naufaldi' => 'anaufaldi@corus360.com',
            'Amanda Sanders' => 'asanders@corus360.com',
            'Jeremy Vielmas' => 'jvielmas@corus360.com',
            'Ivan Bickett' => 'ibickett@corus360.com',
            'Daniel Adam' => 'dadam@corus360.com',
            'Louisa Yang' => 'lyang@corus360.com',
            'Sammy-Kite' => 'samantha.kite1@gmail.com',
        ];

        foreach($users as $name => $email)
        {
            $user = User::create([
                'name' => $name,
                'email' => $email,
                'email_verified_at' => Carbon::now(),
                'password' => bcrypt(env('DEFAULT_USER_PW')),
            ]);
        }
    }
}
