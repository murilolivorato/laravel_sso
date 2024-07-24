<?php

namespace App\Services;

use App\Models\UserAdmin;
use Illuminate\Http\Request;
use App\Classes\Utils\DefaultResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\UploadedFile;

class AuthUserService
{
    protected $request_host;
    protected $client_id;
    protected $scope;
    protected $area = 'supervisor';
    protected $header =  [
        'Accept' => 'application/json'
    ];
    protected $defaultResponse;

    public function __construct(DefaultResponse $defaultResponse)
    {
        $this->defaultResponse = $defaultResponse;
        $this->request_host = config('services.auth.request_host');
        $this->area =  'supervisor';
        $this->http = Http::acceptJson();
    }

    public function setHeader ($token = null) {
        $this->header = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '. $token
        ];
        return $this;
    }

    public function list(array $params = [])
    {
        $name = $params['area'];
        $nameParamter = $name ? '&area='.$name : '';
        $response = Http::withHeaders($this->header)->get($this->request_host.'/api/admin/users');
        return $this->defaultResponse->response($response);
    }

    public function loadFormOptions()
    {
        $response = Http::withHeaders($this->header)->get($this->request_host.'/api/admin/users/load-form-options');
        return $this->defaultResponse->response($response);
    }

    public function store(array $params = [], UploadedFile $image_profile = null)
    {

/*
        $collection = collect($params);
        $collection = $collection->map(function($v, $k) {
            return ['name' => $k, 'contents' => $v];
    })->filter()->values();*/

        /*$collection = collect($params);

        $transformed = $collection->map(function ($value, $key) {
            // Check if the value is an array and needs recursive transformation
            if (is_array($value)) {
                // Transform each item in the array
                $contents = collect($value)->map(function ($itemValue, $itemKey) {
                    return ['name' => $itemKey, 'contents' => $itemValue];
                })->values()->all(); // Convert the collection to an array
                return ['name' => $key, 'contents' => $contents];
            } else {
                // If it's not an array, just transform it normally
                return ['name' => $key, 'contents' => $value];
            }
        })->values();*/

        $response = Http::withHeaders($this->header)
          ->attach('image_profile', file_get_contents($image_profile->getPathname()), $image_profile->getClientOriginalName() )
            ->post($this->request_host.'/api/admin/users/store', self::transformMultiFormData($params));

        return $this->defaultResponse->response($response);
    }

    private static function transformMultiFormData ($data) {
        $output = [];

        foreach($data as $key => $value){
            if(!is_array($value)){
                $output[] = ['name' => $key, 'contents' => $value];
                continue;
            }

            foreach($value as $multiKey => $multiValue){
                $multiName = $key . '[' .$multiKey . ']' . (is_array($multiValue) ? '[' . key($multiValue) . ']' : '' ) . '';
                $output[] = ['name' => $multiName, 'contents' => (is_array($multiValue) ? reset($multiValue) : $multiValue)];
            }
        }
        return $output;
    }

    public function destroy()
    {
        $response = Http::withHeaders($this->header)->withHeaders($this->header)->post($this->request_host.'/api/admin/users/destroy', ['area' => $this->area]);
        return $this->defaultResponse->response($response);
    }

}
