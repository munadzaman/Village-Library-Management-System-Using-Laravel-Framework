<?php

namespace Database\Factories;

use App\Models\Member;
use Illuminate\Database\Eloquent\Factories\Factory;

class MemberFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Member::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'ic_no' => $this->faker->unique()->numerify('#########'),
            'address' => $this->faker->address,
            'mobile_number' => $this->faker->phoneNumber,
            'borrowed_status' => $this->faker->boolean,
        ];
    }
}
