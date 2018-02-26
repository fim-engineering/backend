<?php

use Illuminate\Database\Seeder;

class DbFiminforeference extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('fim_info_references')->insert(array(
        array('references' => 'Alumni FIM'),
        array('references' => 'Keluarga'),
        array('references' => 'Teman'),
        array('references' => 'Social Media'),
        array('references' => 'Media Cetak'),
        array('references' => 'Lainnya'),        
      ));
    }
}
