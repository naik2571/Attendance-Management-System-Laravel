<?php

namespace Database\Factories;

use App\Models\Attendance;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attendance>
 */
class AttendanceFactory extends Factory
{
    protected $model = Attendance::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = $this->faker->randomElement(['present', 'present', 'present', 'absent', 'leave']);
        $date = $this->faker->dateTimeBetween('-1 month', 'now')->format('Y-m-d');
        
        $clockIn = null;
        $clockOut = null;

        if ($status === 'present') {
            $clockIn = Carbon::parse($date)->addHours(rand(8, 9))->addMinutes(rand(0, 59));
            $clockOut = clone $clockIn;
            $clockOut->addHours(rand(7, 9));
        }

        return [
            'user_id' => User::factory(),
            'date' => $date,
            'clock_in_time' => $clockIn,
            'clock_out_time' => $clockOut,
            'status' => $status,
        ];
    }
}
