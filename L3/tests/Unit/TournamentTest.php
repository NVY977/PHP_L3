<?php

namespace Tests\Unit;

use App\Domain\Tournaments\Models\Tournament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Testing\Fluent\AssertableJson;
use function Pest\Laravel\getJson;
use function Pest\Laravel\postJson;
use function Pest\Laravel\deleteJson;
use function Pest\Laravel\putJson;
use function Pest\Laravel\patchJson;

uses(TestCase::class, RefreshDatabase::class);

it('get list of tournament: 200', function () {
    Tournament::factory()->count(5)->create();
    $response = getJson('/api/v1/tournaments');
    $response->assertStatus(200)->assertJson(
        fn(AssertableJson $json) => $json->has('data', 5)
    );
});

it('get tournament : 200', function () {
    $tournament = Tournament::factory()->create();
    $response = getJson('/api/v1/tournaments/' . $tournament->id);
    $response->assertStatus(200)
        ->assertJson(fn(AssertableJson $json) => $json->has(
            'data',
            fn($json) => $json
                ->where('id', $tournament->id)
                ->where('title', $tournament['title'])
                ->where('prize', $tournament['prize'])
                ->where('city', $tournament['city'])
        ));
});

it('delete tournament : 200', function () {
    $tournament = Tournament::factory()->create();
    $response = deleteJson('/api/v1/tournaments/' . $tournament->id);
    $response->assertStatus(200);
    $this->assertDatabaseMissing('tournaments', $tournament->attributesToArray());
});

it('put tournament : 200', function () {
    $tournament = Tournament::factory()->create();
    $putTournament = Tournament::factory()->raw();
    $response = putJson('/api/v1/tournaments/' . $tournament->id, $putTournament);
    $response->assertStatus(200)->assertJson(fn(AssertableJson $json) => $json->has(
        'data',
        fn($json) => $json
            ->where('id', $tournament->id)
            ->where('title', $putTournament['title'])
            ->where('prize', $putTournament['prize'])
            ->where('city', $putTournament['city'])
    ));
    $this->assertDatabaseHas('tournaments', $putTournament);
});

it('patch tournament : 200', function () {
    $tournament = Tournament::factory()->create();
    $patchTournament = Tournament::factory()->raw();
    $response = patchJson('/api/v1/tournaments/' . $tournament->id, $patchTournament);
    $response->assertStatus(200)->assertJson(fn(AssertableJson $json) => $json->has(
        'data',
        fn($json) => $json->where('id', $tournament->id)
            ->where('title', $patchTournament['title'])
            ->where('prize', $patchTournament['prize'])
            ->where('city', $patchTournament['city'])
    ));
    $this->assertDatabaseHas('tournaments', $patchTournament);
});

it('post tournament : 201', function () {
    $tournament = Tournament::factory()->raw();
    $response = postJson('/api/v1/tournaments/', $tournament);
    $response->assertStatus(201)->assertJson(fn(AssertableJson $json) => $json->has(
        'data',
        fn($json) => $json
            ->whereType('id', 'integer')
            ->where('title', $tournament['title'])
            ->where('prize', $tournament['prize'])
            ->where('city', $tournament['city'])
    ));
    $this->assertDatabaseHas('tournaments', $tournament);
});

it('get list of tournaments : 404', function () {
    $response = getJson('/api/v1/f');
    $response->assertStatus(404);
});

it('get tournament : 404', function () {
    $tournament = Tournament::factory()->create();
    $response = getJson('/api/v1/tournaments/' . $tournament->id + 1);
    $response->assertStatus(404);
});

it('post tournament : 404', function () {
    $tournament = Tournament::factory()->raw();
    $response = postJson('/api/v1/f', $tournament);
    $response->assertStatus(404);
});

it('delete tournament : 404', function () {
    $tournament = Tournament::factory()->create();
    $response = deleteJson('/api/v1/f/' . $tournament->id);
    $response->assertStatus(404);
});

it('put tournament : 404', function () {
    $tournament = Tournament::factory()->create();
    $putTournament = Tournament::factory()->raw();
    $response = putJson('/api/v1/f/' . $tournament->id, $putTournament);
    $response->assertStatus(404);
});

it('patch tournament : 404', function () {
    $tournament = Tournament::factory()->create();
    $patchTournament = Tournament::factory()->raw();
    $response = putJson('/api/v1/f/' . $tournament->id, $patchTournament);
    $response->assertStatus(404);
});

it('post tournament : 422', function () {
    $tournament = Tournament::factory()->raw();
    $tournament['title'] = null;
    $response = postJson('/api/v1/tournaments', $tournament);
    $response->assertStatus(422);
});

it('put tournament : 422', function () {
    $tournament = Tournament::factory()->create();
    $putTournament = Tournament::factory()->raw();
    $putTournament['title'] = null;
    $response = putJson('/api/v1/tournaments/' . $tournament->id, $putTournament);
    $response->assertStatus(422);
});

it('patch tournament : 422', function () {
    $tournament = Tournament::factory()->create();
    $patchTournament = Tournament::factory()->raw();
    $patchTournament['title'] = null;
    $response = patchJson('/api/v1/tournaments/' . $tournament->id, $patchTournament);
    $response->assertStatus(422);
});
