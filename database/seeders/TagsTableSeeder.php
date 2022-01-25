<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $tag_arr = ['Writers','Posts','Promotions','Starters','Imperial'];
        if (sizeof($tag_arr)> 0){
            foreach ($tag_arr as $t => $t_row){
                DB::table('tags')->insert([
                    'uuid'=>Str::uuid(),
                    'tags'=> $t_row,
                ]);
            }
        }
    }
}
