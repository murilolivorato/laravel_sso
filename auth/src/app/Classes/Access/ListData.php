<?php

namespace App\Classes\Access;

use App\Models\UserAdmin;

class ListData
{
    /**
     * @var
     */
    protected $request;
    /**
     * @var
     */
    protected $user;
    /**
     * @var int
     */
    protected $paginateNumber = 20;
    /**
     * @var null
     */
    protected $page = null;


    /**
     * @param $request
     * @return array
     */
    public static function load($request, $accessArea = null){

        return   (new static)->handle($request, $accessArea);
    }

    /**
     * @param $request
     * @return array
     */
    private function handle($request, $accessArea){
        $paginateNumber =  20;
        $email = $request['email'];
        $status = $request['status'];
        $name = $request['name'];
        $cpf = $request['cpf'];
        $area_id = $request['area_id'];
        $manager_id = $request['manager_id'];
        $is_manager = $request['is_manager'];
        $page = $request['page'];

        $nameString = strtok($name, " ");
        $lastNameString = substr(strstr($name," "), 1);

        $result =  UserAdmin::select([ 'id',  'status',  'email'])
            ->with(['AdminInfo' => function ($query) {
                $query->select('name', 'cpf', 'phone', 'last_name', 'user_id');
            }])
            ->with(['AcessAreas' => function ($query) {
                $query->select('id','title', 'url');
            }])
            ->with(['Manager' => function ($query) {
                $query->select('user_id', 'area_id');
            }])
            ->with(['ManagerAreas' => function ($query) {
                $query->select('id','title', 'url');
            }])
            // WHEN EMAIL
            ->when($email, function ($query) use ($email) {
                return $query->where( 'email' ,'like',  '%' .  $email .'%'  );
            })
            // WHEN STATUS
            ->when($status, function ($query) use ($status) {
                return $query->where( 'status' , $status );
            })
            // WHEN NAME
            ->when($nameString, function ($query) use ($nameString) {
                $query->WhereHas('AdminInfo' , function($query)  use ($nameString) {
                    return $query->where('name','like',  '%' .  $nameString .'%'  );
                });
            })
            // LAST NAME
            ->when($lastNameString, function ($query) use ($lastNameString) {
                $query->WhereHas('AdminInfo' , function($query)  use ($lastNameString) {
                    return $query->where('last_name','like',  '%' .  $lastNameString .'%'  );
                });
            })
            // CPF
            ->when($cpf, function ($query) use ($cpf) {
                $query->WhereHas('AdminInfo' , function($query)  use ($cpf) {
                    return $query->where('cpf' ,'like',  '%' .  $cpf .'%'  );
                });
            })
            // AREA ID
            ->when($area_id, function ($query) use ($area_id) {
                $query->WhereHas('AcessAreas' , function($query)  use ($area_id) {
                    return $query->where('id', $area_id);
                });
            })
            // MANAGER ID
            ->when($manager_id, function ($query) use ($manager_id) {
                $query->WhereHas('Manager' , function($query)  use ($manager_id) {
                    return $query->where('id', $manager_id);
                });
            })
            // IS MANAGER
            ->when($is_manager, function ($query) use ($is_manager) {
                $query->WhereHas('Manager');
            })
            // HAS ACCESS AREA
            ->when($accessArea, function ($query) use ($accessArea) {
                $query->WhereHas('AcessAreas', function($query)  use ($accessArea) {
                    return $query->where('id' ,$accessArea->id );
                });
            })
            ->orderBy('created_at', 'DESC')
            ->paginate($paginateNumber , ['*'], 'page', $page );

        return  [
            'pagination' => [
                'total'         => $result->total(),
                'per_page'      => $result->perPage(),
                'current_page'  => $result->currentPage(),
                'last_page'     => $result->lastPage(),
                'from'          => $result->firstItem(),
                'to'            => $result->lastItem()
            ],
            'data'             => self::makeCollection($result->items())
        ];
    }


    private function makeCollection($result)
    {
        $collection =  collect($result);

        return $collection->map(function ($item, $key) {

            return ['id'                         => $item->id ,
                    'status'                     => $item->status ,
                    'email'                      => $item->email,
                    'name'                       => $item->AdminInfo()->exists() ? $item->AdminInfo->name : null,
                    'last_name'                  => $item->AdminInfo()->exists() ? $item->AdminInfo->last_name : null,
                    'cpf'                        => $item->AdminInfo()->exists() ? $item->AdminInfo->cpf : null ,
                    'access_area'                => self::areCollection($item->AcessAreas),
                    'manager'                    => self::areCollection($item->ManagerAreas)
                ];
        });

    }

    private function areCollection($result)
    {
        if(!$result) {
            return [];
        }
        if(!count($result)) {
            return [];
        }
        $collection =  collect($result);

        return $collection->map(function ($item, $key) {

            return ['id'                         => $item->id ,
                'title'                      => $item->title ,
                'url'                        => $item->url
            ];
        });
    }

}
