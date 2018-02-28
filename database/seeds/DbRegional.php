<?php

use Illuminate\Database\Seeder;

class DbRegional extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('regionals')->insert(array(
          array('regional_name' => 'Malang'),
          array('regional_name' => 'Surabaya'),
          array('regional_name' => 'Bogor'),
          array('regional_name' => 'Samarinda'),
          array('regional_name' => 'Bukittinggi'),
          array('regional_name' => 'Mataram'),
          array('regional_name' => 'Balikpapan'),
          array('regional_name' => 'Jayapura'),
          array('regional_name' => 'Batam'),
          array('regional_name' => 'Pangkal Pinang'),
          array('regional_name' => 'Palembang'),
          array('regional_name' => 'Kendari'),
          array('regional_name' => 'Gorontalo'),
          array('regional_name' => 'Banjarbaru'),
          array('regional_name' => 'Bandung'),
          array('regional_name' => 'Bekasi'),
          array('regional_name' => 'Tangerang Raya'),
          array('regional_name' => 'Jogja'),
          array('regional_name' => 'Jember'),
          array('regional_name' => 'Depok'),
          array('regional_name' => 'Semarang'),
          array('regional_name' => 'Sidoarjo'),
          array('regional_name' => 'Solo Raya'),
          array('regional_name' => 'Pekanbaru'),
          array('regional_name' => 'Bengkulu'),
          array('regional_name' => 'Manado'),
          array('regional_name' => 'Ambon'),
          array('regional_name' => 'Jambi'),
          array('regional_name' => 'Makassar'),
          array('regional_name' => 'Jakarta'),
          array('regional_name' => 'Palangkaraya'),
          array('regional_name' => 'Palu'),
          array('regional_name' => 'Padang'),
          array('regional_name' => 'Majene'),
          array('regional_name' => 'Bandar Lampung'),
          array('regional_name' => 'Banda Aceh *'),
          array('regional_name' => 'Lhokseumawe *'),
          array('regional_name' => 'Cilegon-Serang Pandeglang-Lebak *'),
          array('regional_name' => 'Sumut'),
          array('regional_name' => 'Pontianak *'),
          array('regional_name' => 'Banjarmasin *'),
          array('regional_name' => 'Kaltara *'),
          array('regional_name' => 'Cirebon *'),
          array('regional_name' => 'Purwokerto *'),
          array('regional_name' => 'Sumedang *'),
          array('regional_name' => 'Ciamis *'),
          array('regional_name' => 'Madura *'),
          array('regional_name' => 'Denpasar *'),
          array('regional_name' => 'Kupang *'),
          array('regional_name' => 'Rote *'),
          array('regional_name' => 'Sumba *'),
          array('regional_name' => 'Maumere *'),
          array('regional_name' => 'Labuan Bajo *'),
          array('regional_name' => 'Papua Barat *'),
          array('regional_name' => 'Maluku Utara *')
        ));
    }
}
