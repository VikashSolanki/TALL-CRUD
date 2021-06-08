<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subject;
use Carbon\Carbon;
use DB;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Add the default subjects
     *
     * @return void
     */
    public function run()
    {
        $timestamp = Carbon::now();
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Subject::truncate();
        Subject::insert([
            [
                'name'=>'Computer Networks',
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name'=>'Java',
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name'=>'Software Engineering',
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name'=>'E-Commerce & ERP',
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name'=>'DBMS',
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name'=>'PHP',
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name'=>'Operating Systems',
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name'=>'IOS',
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name'=>'Android',
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ]
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
