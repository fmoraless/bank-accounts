<?php

namespace Tests\Feature\Account;

use App\Models\Account;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class CreateAccountTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function can_create_account()
    {
        $this->withoutExceptionHandling();

        $response = $this->postJson(route('api.v1.accounts.store'), [
            'account_number' => '1234567890',
            'balance' => '1000.00'
        ])->assertCreated();

        $account = Account::first();

        $response->assertExactJson([
            'data' => [
                'id' => $account->getRouteKey(),
                'account_number' => (string) $account->account_number,
                'balance' => $account->balance,
                'created_at' => $account->created_at,
                'updated_at' => $account->updated_at,
            ]
        ]);

    }

    /** @test */
    public function account_number_is_required()
    {
        //$this->withoutExceptionHandling();

        $response = $this->postJson(route('api.v1.accounts.store'), [
            'balance' => '1000.00'
        ]);
        $response->assertJsonValidationErrors('account_number');
    }

    /** @test */
    public function account_number_must_be_unique()
    {
        //$this->withoutExceptionHandling();

        Account::factory()->create([
            'account_number' => '1234567890'
        ]);

        $response = $this->postJson(route('api.v1.accounts.store'), [
                'account_number' => '1234567890',
                'balance' => '1000.00'
        ]);
        $response->assertJsonValidationErrors('account_number');
    }
}
