<?php

namespace Database\Seeders;

use App\Models\jobType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class jobTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json= File::get('database/json/jobType.json');
        $jobtypes= collect(json_decode($json));

        $jobtypes->each(function($jobtpe){
          jobType::create([
             'name'=> $jobtpe->name
          ]);
        });
    }
}
