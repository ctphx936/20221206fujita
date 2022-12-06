<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Contact;
use Faker\Generator as Faker;
use Carbon\Carbon;  //この行を追加

class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $now = Carbon::now();  
        return [
        'fullname' => $this->faker->name,
        'gender' => $this->faker->numberBetween(1,2), 
        'email' => $this->faker->safeEmail,
        'postcode' => $this->faker->postcode,
        'address' =>  $this->faker->address,
        'building_name' =>  $this->faker->realText($maxNbChars = 10, $indexSize = 2),
        'opinion' =>  $this->faker->realText($maxNbChars = 120, $indexSize = 5),
        'created_at' => $this->faker->dateTimeBetween($startDate = 'now', $endDate = '+2 week'),
        'updated_at' => $now,
        ];
    }
}
