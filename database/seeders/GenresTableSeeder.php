<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class GenresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $genres_arr = ['Non-Fiction','Drama','Comedy','Fantasy','Sci-Fi','Romance','Mystery','Horror','Action','Historical Fiction','Poetry','Other'];
        if (sizeof($genres_arr)> 0){
            foreach ($genres_arr as $g => $g_row){
                DB::table('genres')->insert([
                    'uuid'=>Str::uuid(),
                    'genres'=> $g_row,
                ]);
            }
        }

    }
}
