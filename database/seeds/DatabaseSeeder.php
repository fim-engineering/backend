<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(DbBestPerformance::class);
        // $this->call(DbFiminforeference::class);
        // $this->call(DbMBTI::class);
        $this->call(DbPositions::class);
        $this->call(DbRegional::class);

    }
}
