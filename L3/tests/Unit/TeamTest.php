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

it('get list of teams : 200', function () {
    Team::factory()->count(5)->create();
    $response = getJson('/api/v1/teams');
    $response->assertStatus(200)->assertJson(
        fn(AssertableJson $json) => $json->has('data', 5)
    );
});

it('get team : 200', function () {
    $team = Team::factory()->create();
    $response = getJson('/api/v1/teams/' . $team->id);
    $response->assertStatus(200)
        ->assertJson(fn(AssertableJson $json) => $json->has(
            'data',
            fn($json) => $json
                ->where('id', $team->id)
                ->where('tournament_id', $team['tournament_id'])
                ->where('title', $team['title'])
                ->where('color', $team['color'])
                ->where('city', $team['city'])
        ));
});

it('delete team : 200', function () {
    $team = Team::factory()->create();
    $response = deleteJson('/api/v1/teams/' . $team->id);
    $response->assertStatus(200);
    $this->assertDatabaseMissing('teams', $team->attributesToArray());
});

it('put team : 200', function () {
    $team = Team::factory()->create();
    $putTeam = Team::factory()->raw();
    $response = putJson('/api/v1/teams/' . $team->id, $putTeam);
    $response->assertStatus(200)->assertJson(fn(AssertableJson $json) => $json->has(
        'data',
        fn($json) => $json
            ->where('id', $team->id)
            ->where('tournament_id', $putTeam['tournament_id'])
            ->where('title', $putTeam['title'])
            ->where('color', $putTeam['color'])
            ->where('city', $putTeam['city'])
    ));
    $this->assertDatabaseHas('teams', $putTeam);
});

it('patch team : 200', function () {
    $team = Team::factory()->create();
    $patchTeam = Team::factory()->raw();
    $response = patchJson('/api/v1/teams/' . $team->id, $patchTeam);
    $response->assertStatus(200)->assertJson(fn(AssertableJson $json) => $json->has(
        'data',
        fn($json) => $json
            ->where('id', $team->id)
            ->where('tournament_id', $patchTeam['tournament_id'])
            ->where('title', $patchTeam['title'])
            ->where('color', $patchTeam['color'])
            ->where('city', $patchTeam['city'])
    ));
    $this->assertDatabaseHas('teams', $patchTeam);
});

it('post team : 201', function () {
    $team = Team::factory()->raw();
    $response = postJson('/api/v1/teams', $team);
    $response->assertStatus(201)->assertJson(fn(AssertableJson $json) => $json->has(
        'data',
        fn($json) => $json->whereType('id', 'integer')
            ->where('tournament_id', $team['tournament_id'])
            ->where('title', $team['title'])
            ->where('color', $team['color'])
            ->where('city', $team['city'])
    ));
    $this->assertDatabaseHas('teams', $team);
});

it('get list of teams : 404', function () {
    $response = getJson('/api/v1/f');
    $response->assertStatus(404);
});

it('get team : 404', function () {
    $team = Team::factory()->create();
    $response = getJson('/api/v1/teams/' . $team->id + 1);
    $response->assertStatus(404);
});

it('post team : 404', function () {
    $team = Team::factory()->raw();
    $response = postJson('/api/v1/f', $team);
    $response->assertStatus(404);
});

it('put team : 404', function () {
    $team = Team::factory()->create();
    $putTeam = Team::factory()->raw();
    $response = putJson('/api/v1/f/' . $team->id, $putTeam);
    $response->assertStatus(404);
});

it('delete team : 404', function () {
    $team = Team::factory()->create();
    $response = deleteJson('/api/v1/f/' . $team->id);
    $response->assertStatus(404);
});

it('patch team : 404', function () {
    $team = Team::factory()->create();
    $patchTeam = Team::factory()->raw();
    $response = putJson('/api/v1/f/' . $team->id, $patchTeam);
    $response->assertStatus(404);
});

it('post team : 422', function () {
    $team = Team::factory()->raw();
    $team['title'] = null;
    $response = postJson('/api/v1/teams', $team);
    $response->assertStatus(422);
});

it('put team : 422', function () {
    $team = Team::factory()->create();
    $putTeam = Team::factory()->raw();
    $putTeam['title'] = null;
    $response = putJson('/api/v1/teams/' . $team->id, $putTeam);
    $response->assertStatus(422);
});

it('patch team : 422', function () {
    $team = Team::factory()->create();
    $patchTeam = Team::factory()->raw();
    $patchTeam['title'] = null;
    $response = patchJson('/api/v1/teams/' . $team->id, $patchTeam);
    $response->assertStatus(422);
});
