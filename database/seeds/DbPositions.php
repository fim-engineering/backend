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
        array('position_name' => 'Pendiri'),
        array('position_name' => 'Ketua'),
        array('position_name' => 'Ketua Divisi/BPH lainnya'),
        array('position_name' => 'Anggota Divisi'),
        array('position_name' => 'Peserta'),
      ));
    }
}
