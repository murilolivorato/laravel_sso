<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
//use Tests\TestCase;

/*class ExampleTest extends TestCase
{

    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertOk();
    }
}*/

use function Pest\Laravel\getJson;

it('asset to be true', function () {
    expect(true)->toBe(true);
});

it('should return status 200', fn () => getJson('/', ['Content-Type' => 'application/json'])->assertOk());
