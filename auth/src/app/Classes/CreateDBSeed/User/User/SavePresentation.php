<?php
/**
 * Created by PhpStorm.
 * UserPub: murilo
 * Date: 09/03/2019
 * Time: 09:47
 */

namespace App\Classes\CreateDBSeed\User\User;
use App\Models\UserBrokerInfo;
use App\Models\UserConstructorInfo;
use App\Models\UserRealEstateInfo;
use App\Models\UserPresentation;
use App\Models\UserPub;


class SavePresentation
{
    public function  handle(UserPub $user){

        $titles = self::makeTitle($user);

        //   PRESENTATION
        $user->Presentation()->save(
            factory(UserPresentation::class)->create($titles)
        );

    }

    public static function makeTitle(UserPub $user){
        switch ($user) {
            case $user->isBroker:
                return self::brokerList($user);
            case $user->isRealEstate:
                return self::realEstateTitles($user);
            case $user->isConstructor:
                return self::constructorTitles($user);
              }
    }

    public static function brokerList(UserPub $user){
                $title = self::makeBrokerTitle($user->BrokerInfo);
                return ['title'     => $title,
                        'url_title' => url_title($title ."-". $user->code ) ,
                        'user_id'   => $user->id ];
    }

    public static function realEstateTitles(UserPub $user){
        $title = self::makeRealEstateTitle($user->RealEstateInfo);
        return  ['title'     => $title ,
                 'url_title' => url_title($title ."-". $user->code) ,
                 'user_id'   => $user->id   ];
    }

    public static function constructorTitles(UserPub $user){
        $title = self::makeConstructorTitle($user->ConstructorInfo);

        return ['title'     => $title ,
                'url_title' => url_title($title ."-". $user->code) ,
                'user_id'   => $user->id];
    }



    public static function makeBrokerTitle(UserBrokerInfo $constructor )
    {
        $nick_name     = $constructor->nick_name ? " ( ". $constructor->nick_name." ) " : "";
        $full_name     = $constructor->name . " ".  $constructor->last_name;

        return $full_name .$nick_name;
    }

    public static function makeConstructorTitle(UserConstructorInfo $constructor )
    {
        $name                     = $constructor->company_name;
        $complement_name          = $constructor->complement_name;
        $complement_name_position = $constructor->complement_name_position;

        // DOES NOT HAS COMPLEMENT
        if(! $complement_name){
            return $name;
        }

        // HAS COMPLEMENT / LEFT
        if($complement_name_position == 'left'){
            return $complement_name . ' ' . $name;
        }

        // HAS COMPLEMENT / RIGHT
        return $name . ' ' .$complement_name;
    }

    public static function makeRealEstateTitle(UserRealEstateInfo $realEstateInfo )
    {
        $name                     = $realEstateInfo->company_name;
        $complement_name          = $realEstateInfo->complement_name;
        $complement_name_position = $realEstateInfo->complement_name_position;
        $filiated                 = $realEstateInfo->filiated_complement_name;
        $filiated_field           = $filiated ? ' ' . $filiated : '';

        // DOES NOT HAS COMPLEMENT
        if(! $complement_name){
            return $name . $filiated_field;
        }

        // HAS COMPLEMENT / LEFT
        if($complement_name_position == 'left'){
            return $complement_name . ' ' . $name . $filiated_field;
        }

        // HAS COMPLEMENT / RIGHT
        return $name . ' ' .$complement_name . $filiated_field;
    }
}
