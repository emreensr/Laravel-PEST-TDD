<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);


beforeEach(function () {
    $this->user = User::factory()->create();
    $this->post = \App\Models\Post::factory()->create();
});


it('has post edit page', function () {
    $response = $this->actingAs($this->user)->get('/posts/'. $this->post->id . '/edit');
    $response->assertStatus(200);
});

it('has the post details in the form', function () {
    $response = $this->actingAs($this->user)->get('/posts/'. $this->post->id . '/edit');
    $response->assertSee($this->post->title)->assertSee($this->post->body);
});

it('redirects unauthenticated user', function () {
    $response = $this->get('/posts/'. $this->post->id . '/edit');
    $response->assertStatus(302);
});

it('abort if the user does not own the post', function () {
    $newUser = User::factory()->create();
    $post = $this->user->posts()->create([
        'title' => 'Title',
        'body' => 'Body',
        'status' => 'pending'
    ]);
    $this->actingAs($newUser)->get('/posts/'. $post->id . '/edit')->assertStatus(403);
});

