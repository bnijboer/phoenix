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
            'username' => 'dummy',
            'first_name' => 'Dummy',
            'last_name' => 'Test',
            'email' => 'dummy@phoenix.test',
            'email_verified_at' => now(),
            'password' => Hash::make(env('MAIN_USER_PASSWORD', 'test')),
            'remember_token' => Str::random(10),
            'avatar' => asset('images/default-avatar.jpeg'),
            'is_admin' => false,
            'is_editor' => false,
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
            'username' => 'testadmin',
            'first_name' => 'Test',
            'last_name' => 'Admin',
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
            'username' => 'testeditor',
            'first_name' => 'Test',
            'last_name' => 'Editor',
            'email' => 'editor@phoenix.test',
            'is_editor' => true,
        ]);
    }
}
