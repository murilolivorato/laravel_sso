<?php

use App\Models\UserAdminInfo;
use Laravel\Passport\Client;
use Laravel\Passport\Passport;
use App\Models\UserAdmin;
use function Pest\Laravel\getJson;
use function Pest\Laravel\postJson;
use function Pest\Laravel\assertDatabaseHas;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

beforeEach(function () {
    $user = UserAdmin::whereHas('AcessAreas',  function ($query)  {
        return $query->where('url_title', 'supervisor');
    })->with('AdminInfo')->first();
    $this->user = $user;
    Passport::actingAs($user, ['access-supervisor-area']);
});

test('users', function () {
    $user = UserAdmin::get();
    $data = getJson(config('app.url').'/api/admin/users?area=supervisor')
        ->assertJsonStructure([
            'data' => [
                '*' => [
                    'id', 'status', 'email', 'name', 'last_name', 'cpf',
                    'access_area' => []
                ]
            ],
            'pagination' => [ 'total', 'per_page', 'current_page', 'last_page', 'from', 'to']
        ])->assertOk();
    expect(count($data['data']));
});

test('users-options', function () {
    $data = getJson(config('app.url').'/api/admin/users/load-form-options')->json();
    expect(count($data['area']));
});

test('store user verify errors', function () {
    postJson(config('app.url').'/api/admin/users/store', [] )->assertJson([
        'message' => [
            'password' => [
                trans('validation.required', ['attribute' => 'password'])
            ],
            'folder' => [
                trans('validation.required', ['attribute' => 'folder'])
            ],
            'email' => [
                trans('validation.required', ['attribute' => 'email'])
            ],
            'admin_info.name' => [
                trans('validation.required',[ 'attribute' => 'admin info.name'])
            ],
            'admin_info.cpf' => [
                trans('validation.required',[ 'attribute' => 'admin info.cpf'])
            ],
            'admin_info.phone' => [
                trans('validation.required',[ 'attribute' => 'admin info.phone'])
            ],
            'admin_info.last_name' => [
                trans('validation.required',[ 'attribute' => 'admin info.last name'])
            ],
            'role_id' => [
                trans('validation.required', ['attribute' => 'role id'])
            ],
            'area_id' => [
                trans('validation.required', ['attribute' => 'area id'])
            ]
        ]
    ]);

});

test('store user', function () {
    $faker = \Faker\Factory::create();
    $data = UserAdmin::factory()->make(function($user_admin) use ($faker)   {
            // CREATE USER INFO
            $userAdminInfo = UserAdminInfo::factory()->make(['name'     => $faker->firstName('male'),
                                                             'user_id'  => 1])->toArray();
            return ['status' =>$user_admin['status'],
                    'folder' =>$user_admin['folder'],
                    'password' =>123456,
                    'email' => $user_admin['email'],
                    'admin_info' => [
                        'name' => $userAdminInfo['name'],
                        'cpf' => '514.617.470-90',
                        'phone' => $userAdminInfo['phone'],
                        'last_name' => $userAdminInfo['last_name'] ],
                        'role_id' =>1,
                        'area_id' =>1,
                        'image_profile' => new \Illuminate\Http\UploadedFile(public_path('/assets/images/profile_1.jpg'), 'profile1.jpg', null, null, true),

                ];

        })->makeVisible(['password'])->toArray();
    postJson(config('app.url').'/api/admin/users/store', $data );
  /* $userAdmin = UserAdmin::where('email', $data['email'])->with('ImageProfile', function($query)   {
    return $query->select('id', 'image');
    })->first();
   dd($userAdmin);*/

    assertDatabaseHas('user_admins',[ 'email' => $data['email'] ]);
});

test('get user info', function () {
    $response = postJson(config('app.url').'/api/admin/info')->assertOk()->assertJsonStructure([
        'email', 'last_name'
    ]);

    expect($response['email'])->toBe($this->user->email);
    expect($response['last_name'])->toBe($this->user->AdminInfo->last_name);
});


