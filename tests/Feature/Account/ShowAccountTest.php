<?php

namespace Tests\Feature\Account;

use App\Models\Account;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ShowAccountTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_fetch_a_single_account(): void
    {
        $this->withoutExceptionHandling();

        $account = Account::factory()->create();

        $response = $this->getJson(route('api.v1.accounts.show', $account));

        $response->assertExactJson([
            'data' => [
                'id' => $account->getRouteKey(),
                'account_number' => (string) $account->account_number,
                'balance' => (string) $account->balance,
                'created_at' => $account->created_at,
                'updated_at' => $account->updated_at,
            ]
        ]);
    }
}
