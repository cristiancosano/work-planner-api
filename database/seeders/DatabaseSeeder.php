<?php

namespace Database\Seeders;

use App\Models\Agenda;
use App\Models\Auditor;
use App\Models\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Auditor::factory(100)->create();
        Agenda::factory(20)->create();
        Task::factory(100)->create();
    }
}
