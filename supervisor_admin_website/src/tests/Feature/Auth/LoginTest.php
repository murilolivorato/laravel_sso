
<?php
use App\Services\AuthService;
use Illuminate\Support\Facades\Http;
use Mockery as m;


test('test connection', function ()
{
    $http = Http::acceptJson();
    dd($http);
    $response = $http->get(config('services.auth.request_host') .'/api/get-api');
    dd($response);
   /* $mock = m::mock(AuthService::class)->makePartial();
    $helloWorld = $mock->testConnection(); // should get your desired result
    dd($helloWorld);*/
});
