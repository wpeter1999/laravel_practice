<?php

namespace Database\Seeders;

use App\Models\Mvim;
use Illuminate\Database\Seeder;

class MvimSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Mvim::create(['img' =>'giphy.gif','sh' =>'1']);
    }
}
