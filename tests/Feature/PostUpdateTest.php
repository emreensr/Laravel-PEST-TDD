<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);


beforeEach(function () {
    $this->user = User::factory()->create();
    $this->post = \App\Models\Post::factory()->create();
});

it('post update route exists', function () {
    $post = $this->user->posts()->create([
        'title' => 'Title',
        'body' => 'Body',
        'status' => 'pending'
    ]);
    $this->actingAs($this->user)->put('/posts/'. $post->id, [
        'title' => 'New Title',
        'body' => 'New Body',
        'status' => 'published'
    ])->assertRedirect('/posts');
});

it('redirects unauthenticated user', function (){
    $response = $this->put('/posts/'. $this->post->id);
    $response->assertStatus(302);
});

it('validates the post details', function (){
    $post = $this->user->posts()->create([
        'title' => 'Title',
        'body' => 'Body',
        'status' => 'pending'
    ]);
    $this->actingAs($this->user)->put('/posts/'. $post->id)->assertSessionHasErrors(['title', 'body', 'status']);
});

it('abort if the user does not own the post', function () {
    $newUser = User::factory()->create();
    $post = $this->user->posts()->create([
        'title' => 'Title',
        'body' => 'Body',
        'status' => 'pending'
    ]);
    $this->actingAs($newUser)->put('/posts/'. $post->id)->assertStatus(403);
});

it('can update the post', function (){
    $post = $this->user->posts()->create([
        'title' => 'Title',
        'body' => 'Body',
        'status' => 'pending'
    ]);
    $this->actingAs($this->user)->put('/posts/'. $post->id, [
        'title' => 'New Title',
        'body' => 'New Body',
        'status' => 'published'
    ])->assertRedirect('/posts');

    $this->assertDatabaseHas('posts', [
        'id' => $post->id,
        'title' => 'New Title',
        'body' => 'New Body',
        'status' => 'published'
    ]);
});
