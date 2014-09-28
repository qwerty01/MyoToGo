<?php
 
class QueueTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('funcqueue')->delete();
 
        FuncQueue::create(array(
            'user_id' => 1,
            'function' => 1
        ));
 
        FuncQueue::create(array(
            'user_id' => 2,
            'function' => 2
        ));
    }
}
