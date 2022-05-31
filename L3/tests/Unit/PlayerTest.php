<?php

namespace Tests\Unit;

use App\Domain\Players\Models\Player;
use App\Domain\Teams\Models\Team;
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

it('get list of players : 200', function () {
    Player::factory()->count(5)->create();
    $response = getJson('/api/v1/players');
    $response->assertStatus(200)->assertJson(
        fn(AssertableJson $json) => $json->has('data', 5)
    );
});

it('get player : 200', function () {
    $player = Player::factory()->create();
    $response = getJson('/api/v1/players/' . $player->id);
    $response->assertStatus(200)
        ->assertJson(fn(AssertableJson $json) => $json->has(
            'data',
            fn($json) => $json
                ->where('id', $player->id)
                ->where('team_id', $player->team_id)
                ->where('name', $player->name)
                ->where('lastname', $player->lastname)
                ->where('age', $player->age)
                ->where('city', $player->city)
        ));
});

it('delete player : 200', function () {
    $player = Player::factory()->create();
    $response = deleteJson('/api/v1/players/' . $player->id);
    $response->assertStatus(200);
    $this->assertDatabaseMissing('players', $player->attributesToArray());
});

it('put player : 200', function () {
    $player = Player::factory()->create();
    $putPlayer = Player::factory()->raw();
    $response = putJson('/api/v1/players/' . $player->id, $putPlayer);
    $response->assertStatus(200)->assertJson(fn(AssertableJson $json) => $json->has(
        'data',
        fn($json) => $json
            ->where('id', $player->id)
            ->where('team_id', $putPlayer['team_id'])
            ->where('name', $putPlayer['name'])
            ->where('lastname', $putPlayer['lastname'])
            ->where('age', $putPlayer['age'])
            ->where('city', $putPlayer['city'])
    ));
    $this->assertDatabaseHas('players', $putPlayer);
});

it('patch player : 200', function () {
    $player = Player::factory()->create();
    $patchPlayer = Player::factory()->raw();
    $response = patchJson('/api/v1/players/' . $player->id, $patchPlayer);
    $response->assertStatus(200)->assertJson(fn(AssertableJson $json) => $json->has(
        'data',
        fn($json) => $json
            ->where('id', $player->id)
            ->where('team_id', $patchPlayer['team_id'])
            ->where('name', $patchPlayer['name'])
            ->where('lastname', $patchPlayer['lastname'])
            ->where('age', $patchPlayer['age'])
            ->where('city', $patchPlayer['city'])
    ));
    $this->assertDatabaseHas('players', $patchPlayer);
});

it('post player : 201', function () {
    $player = Player::factory()->raw();
    $response = postJson('/api/v1/players/', $player);
    $response->assertStatus(201)
        ->assertJson(fn(AssertableJson $json) => $json->has(
            'data',
            fn($json) => $json->whereType('id', 'integer')
                ->where('team_id', $player['team_id'])
                ->where('name', $player['name'])
                ->where('lastname', $player['lastname'])
                ->where('age', $player['age'])
                ->where('city', $player['city'])
        ));
    $this->assertDatabaseHas('players', $player);
});

it('get list of players : 404', function () {
    $response = getJson('/api/v1/playersGG');
    $response->assertStatus(404);
});

it('get player : 404', function () {
    $player = Player::factory()->create();
    $response = getJson('/api/v1/players/' . $player->id + 1);
    $response->assertStatus(404);
});

it('post player : 404', function () {
    $player = Player::factory()->raw();
    $response = postJson('/api/v1/p', $player);
    $response->assertStatus(404);
});

it('delete player : 404', function () {
    $player = Player::factory()->create();
    $response = deleteJson('/api/v1/f/' . $player->id);
    $response->assertStatus(404);
});

it('put player : 404', function () {
    $player = Player::factory()->create();
    $putPlayer = Player::factory()->raw();
    $response = putJson('/api/v1/f/' . $player->id, $putPlayer);
    $response->assertStatus(404);
});

it('patch player : 404', function () {
    $player = Player::factory()->create();
    $patchPlayer = Player::factory()->raw();
    $response = putJson('/api/v1/f/' . $player->id, $patchPlayer);
    $response->assertStatus(404);
});

it('post player : 422', function () {
    $player = Player::factory()->raw();
    $player['name'] = null;
    $response = postJson('/api/v1/players', $player);
    $response->assertStatus(422);
});

it('put player : 422', function () {
    $player = Player::factory()->create();
    $putPlayer = Player::factory()->raw();
    $putPlayer['name'] = null;
    $response = putJson('/api/v1/players/' . $player->id, $putPlayer);
    $response->assertStatus(422);
});

it('patch player : 422', function () {
    $player = Player::factory()->create();
    $patchPlayer = Player::factory()->raw();
    $patchPlayer['name'] = null;
    $response = patchJson('/api/v1/players/' . $player->id, $patchPlayer);
    $response->assertStatus(422);
});
