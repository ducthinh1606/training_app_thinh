<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'task_name' => 'Task name test',
            'estimate' => date_create('+1 day')->format('Y-m-d\TH:i'),
            'user_id' => 1
        ];
    }
}
