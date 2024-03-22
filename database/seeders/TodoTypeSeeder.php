<?php

namespace Database\Seeders;

use App\Models\TodoType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TodoTypeSeeder extends Seeder
{

    public function run(): void
    {
        TodoType::insert(
            [
                [
                    "title" => "urgent",
                ],
                [
                    "title" => "medium",
                ],
                [
                    "title" => "normal",
                ]
            ]
        );
    }
}
