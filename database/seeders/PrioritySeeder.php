<?php

namespace Database\Seeders;

use App\Models\Priority;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrioritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $priorities = ['normal', 'medium', 'high', 'urgent'];
        foreach ($priorities as $priority) {
            Priority::factory()->create(['name' => $priority]);
        }
    }
}
