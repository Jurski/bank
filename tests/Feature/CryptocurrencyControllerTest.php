<?php

use App\Models\User;

test('cryptos page is displayed', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->get('/cryptocurrencies');

    $response->assertStatus(200);
});
