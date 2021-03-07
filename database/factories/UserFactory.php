<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => 'Dummy',
            'email' => 'dummy@dummy.test',
            'email_verified_at' => now(),
            'is_admin' => false,
            'is_editor' => false,
            'password' => Hash::make('test'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * The test administrator.
     *
     * @return UserFactory
     */
    public function admin(): UserFactory
    {
        return $this->state([
            'name' => 'Brendan',
            'email' => 'admin@phoenix.test',
            'is_admin' => true,
        ]);
    }

    /**
     * The test editor.
     *
     * @return UserFactory
     */
    public function editor(): UserFactory
    {
        return $this->state([
            'name' => 'Hermine',
            'email' => 'editor@phoenix.test',
            'is_editor' => true,
        ]);
    }
}