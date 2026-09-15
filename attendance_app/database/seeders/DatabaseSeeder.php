<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Attendance;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create a Master Admin
        User::firstOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Master Admin',
                'password' => Hash::make('password123'),
                'role' => 'admin',
            ]
        );

        // 2. Create 25 Students
        $students = User::factory(25)->create([
            'role' => 'student',
            'password' => Hash::make('password123'),
        ]);

        // 3. Generate Attendance Records for the last 7 days
        foreach ($students as $student) {
            for ($i = 0; $i < 7; $i++) {
                $date = Carbon::today()->subDays($i);
                
                // Skip weekends optionally, or just leave it
                if ($date->isWeekend()) {
                    continue;
                }

                $status = fake()->randomElement(['present', 'present', 'present', 'absent', 'leave']);
                
                $clockIn = null;
                $clockOut = null;

                if ($status === 'present') {
                    $clockIn = $date->copy()->setTime(rand(8, 9), rand(0, 59), 0);
                    $clockOut = $clockIn->copy()->addHours(rand(7, 9));
                }

                Attendance::create([
                    'user_id' => $student->id,
                    'date' => $date->toDateString(),
                    'clock_in_time' => $clockIn,
                    'clock_out_time' => $clockOut,
                    'status' => $status,
                ]);
            }
        }
    }
}
