<?php

namespace App\Classes\Access;

use App\Exceptions\StoreDataException;
use App\Models\UserAdminAccessArea;
use Illuminate\Support\Facades\DB;

class ProcessDestroy
{
    /**
     * @var
     */
    protected $request;
    /**
     * @var array
     */
    protected $list_index = [];

    public static function process($request, UserAdminAccessArea $accessArea){
        try {
            return  (new static)->handle($request,$accessArea);
        }
        catch (StoreDataException $exeption) {
            throw $exeption->validationExeption();
        }
    }

    private function handle($request, $accessArea){
        return   $this->setRequest($request)
                      ->destroyArea($accessArea)
                      ->result();
    }

    private function setRequest($request){
        $this->request = $request;
        return $this;
    }


    private function destroyArea($accessArea){

        // START TRANSACTION
        DB::beginTransaction();
        foreach($this->request['delete'] as $deleteItem) {
            $accessArea->Users()->detach($deleteItem['id']);

            // PUSH INDEX INTO INDEX , TO MAKE VUE EFFECT TO DELETE
            array_push($this->list_index , $deleteItem['index']);
        }

        // IF IS EMPTY LIST, NOTHING WAS DEETED
        throw_if(empty($this->list_index) , new StoreDataException("Nenhuma Área Foi Removida, Comunique o Suporte"));
        // END TRANSACTION
        DB::commit();

        return $this;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    private function result(){
        // success
        return response()->json(['index'   => $this->list_index  ] , 200);
    }
}
