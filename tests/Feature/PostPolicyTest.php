<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostPolicyTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test if a guest user cannot create posts.
     */
    public function test_guests_cannot_create_posts()
    {
        $response = $this->get(route('posts.create'));
        $response->assertRedirect();

        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->get(route('posts.create'));
        $response->assertForbidden();

        $response = $this->post(route('posts.store'));
        $response->assertForbidden();
    }

    /**
     * Test if an editor user cannot update others' posts.
     */
    public function test_editors_cannot_edit_others_posts()
    {
        $user = User::factory()->create();
        $post = Post::factory(['user_id' => 998])->create();

        $this->actingAs($user);

        $response = $this->get(route('posts.edit', $post));
        $response->assertForbidden();

        $response = $this->patch(route('posts.update', $post));
        $response->assertForbidden();
    }

    /**
     * Test if an editor user cannot delete others' posts.
     */
    public function test_editors_cannot_delete_others_posts()
    {
        $user = User::factory()->create();
        $post = Post::factory(['user_id' => 999])->create();

        $this->actingAs($user);

        $response = $this->delete(route('posts.destroy', $post));
        $response->assertForbidden();
    }
}
