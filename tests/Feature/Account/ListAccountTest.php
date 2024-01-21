<?php

namespace Tests\Feature\Account;

use App\Models\Account;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ListAccountTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_list_all_accounts(): void
    {
        $this->withoutExceptionHandling();
        $accounts = Account::factory()->count(3)->create();
        $response = $this->getJson(route('api.v1.accounts.index'));

        $response->assertStatus(200)
            ->assertExactJson([
                'data' => [
                    [
                        'id' => $accounts[0]->getRouteKey(),
                        'account_number' => (string) $accounts[0]->account_number,
                        'balance' => (string) $accounts[0]->balance,
                        'created_at' => $accounts[0]->created_at,
                        'updated_at' => $accounts[0]->updated_at,
                    ],
                    [
                        'id' => $accounts[1]->getRouteKey(),
                        'account_number' => (string) $accounts[1]->account_number,
                        'balance' => (string) $accounts[1]->balance,
                        'created_at' => $accounts[1]->created_at,
                        'updated_at' => $accounts[1]->updated_at,
                    ],
                    [
                        'id' => $accounts[2]->getRouteKey(),
                        'account_number' => (string) $accounts[2]->account_number,
                        'balance' => (string) $accounts[2]->balance,
                        'created_at' => $accounts[2]->created_at,
                        'updated_at' => $accounts[2]->updated_at,
                    ],
                ]
            ]);
    }
}
