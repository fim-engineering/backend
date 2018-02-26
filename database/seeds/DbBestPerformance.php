<?php

use Illuminate\Database\Seeder;

class DbBestPerformance extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('best_performances')->insert(array(
        array('type' => 'Kepengurusan'),
        array('type' => 'Kepanitiaan'),
        array('type' => 'Keduanya'),        
      ));
    }
}
