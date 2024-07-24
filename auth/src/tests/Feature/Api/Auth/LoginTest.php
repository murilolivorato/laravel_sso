<?php
use App\Models\UserAdmin;
use Illuminate\Support\Str;
use function Pest\Laravel\postJson;
use function Pest\Laravel\post;
use function Pest\Laravel\assertDatabaseHas;


test('should authorize link', function () {

    $state = Str::random(40);

    $query = http_build_query([
        'client_id' => config('services.passport.customer_client_id'),
        'redirect_url' => config('services.supervisor_gateway.http_host'),
        'response_type' => 'code',
        'scope' => 'access-supervisor-area',
        'state' => $state,
    ]);
    // ['authorize_url' => 'http://localhost:8081/oauth/authorize?'. $query, 'state' => $state ];

});

test('should authorize user passport personal', function () {
    $user = UserAdmin::first();
    $data = [
        'email' => $user->email,
        'password' => '123456',
        'device_name' => 'e2e_test',
    ];
      postJson(route('postLoginPersonal'), $data)->assertJsonStructure(['token']);
});

test('should authorize user passport grant type', function () {
    $user = UserAdmin::first();
    $data = [
        'email' => $user->email,
        'password' => '123456',
        'device_name' => 'e2e_test',
    ];
    postJson(route('postLoginGrandType'),$data)->assertJsonStructure(['access_token', 'refresh_token']);
    assertDatabaseHas('user_admins', ['email' => $data['email'] ]);
});


/*describe('validations', function () {
    it('should require email', function () {
        postJson(route('postLoginTest'), [
            'password' => 'password',
            'device_name' => 'e2e_test',
        ]) ->assertJsonValidationErrors([
            'email' => trans('validation.required', ['attribute' => 'email'])
        ])
            ->assertStatus(422);
    });
});*/

