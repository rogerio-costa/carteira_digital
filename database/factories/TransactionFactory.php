<?php

namespace Database\Factories;

use App\Models\Account;
use App\Models\TransactionType;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'account_id' => Account::factory(),
            'transaction_type_id' => TransactionType::factory(),
            'note' => $this->faker->text(),
            'value' => $this->faker->randomFloat(2, 0, 50),
        ];
    }

    public function deposit()
    {
        return $this->state(fn() => [
            'transaction_type_id' => TransactionType::factory(['type_of'=>0])
        ]);
    }

    public function withdraw()
    {
        return $this->state(fn() => [
            'transaction_type_id' => TransactionType::factory(['type_of'=>1]),
        ]);
    }

}
