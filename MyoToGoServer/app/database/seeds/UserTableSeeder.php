<?php
 
class UserTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->delete();
 
        User::create(array(
            'username' => 'testuser',
            'password' => Hash::make('testpass')
        ));
 
        User::create(array(
            'username' => 'testuser2',
            'password' => Hash::make('testpass2')
        ));
    }
}
