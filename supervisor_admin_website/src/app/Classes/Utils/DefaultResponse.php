<?php

namespace App\Classes\Utils;

use Illuminate\Http\Client\Response;

class DefaultResponse
{
    public function response(Response $response)
    {
        $body = json_decode($response->body());

        if ($response->status() !== 200) {
            return response()->json($body, $response->status());
            // throw new \Exception("Something failed: {$response}");
            //return response()->json($body, $response->status());
        }
        return response()->json($body, 200);
        /*return [
            // $body->data
            'data' => $this->data($body),
           // 'meta' => isset($body->meta) ? $this->meta($body->meta) : []
        ];*/
    }

    private function data($data)
    {
        return collect($data)->all();
    }

    private function links(array $links)
    {
        foreach ($links as $key => $link) {
            if (isset($link->url) && $link->url != null)  {
                $links[$key]->url = $this->replacePath($link->url);
            }
        }

        return $links;
    }

    private function meta($meta)
    {
        $meta->links = $this->links($meta->links);
        $meta->path = $this->replacePath($meta->path);

        return $meta;
    }

    private function replacePath(string $path)
    {
        foreach (config('services.micro_services_available') as $key => $microservice_name) {
            $path = str_replace($microservice_name, config('app.url'), $path);
        }

        return $path;
    }
}
