<?php

namespace Tests\Feature;

use App\Models\Petition;
use App\Models\Signature;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    protected bool $seed = true;

    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_the_same_ip_cannot_sign_the_same_petition_twice(): void
    {
        $petition = Petition::query()->firstOrFail();

        $this->post('/signer', [
            'petition_id' => $petition->id,
            'first_name' => 'Premier',
            'last_name' => 'Signataire',
            'email' => 'premier@example.com',
            'display_name' => '1',
            'accepted_terms' => '1',
            'accepted_data_policy' => '1',
        ], ['REMOTE_ADDR' => '203.0.113.10'])->assertRedirect('/');

        $this->post('/signer', [
            'petition_id' => $petition->id,
            'first_name' => 'Deuxieme',
            'last_name' => 'Signataire',
            'email' => 'deuxieme@example.com',
            'display_name' => '1',
            'accepted_terms' => '1',
            'accepted_data_policy' => '1',
        ], ['REMOTE_ADDR' => '203.0.113.10'])
            ->assertRedirect()
            ->assertSessionHas('error');

        $this->assertSame(1, Signature::query()->where('petition_id', $petition->id)->count());
    }
}
