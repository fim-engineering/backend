<?php

use Illuminate\Database\Seeder;

class DbPositions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('positions')->insert(array(
        array('position_name' => 'Anggota'),
        array('position_name' => 'Ketua'),
        array('position_name' => 'Pendiri'),
        array('position_name' => 'Superdiv'),
        array('position_name' => 'Supervisi'),
      ));
    }
}
