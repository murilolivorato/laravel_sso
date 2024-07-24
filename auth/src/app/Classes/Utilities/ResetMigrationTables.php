<?php


namespace App\Classes\Utilities;


class ResetMigrationTables
{
    /**
     * @var string[]
     */
    protected static $toTruncate = [
        'migrations',
        /* 'oauth_access_tokens',
        'oauth_auth_codes',
        'oauth_clients',
        'oauth_personal_access_clients',
        'oauth_refresh_tokens',*/
        'personal_access_tokens',
        'user_admins',
        'user_admin_access_areas',
        'user_admin_infos',
        'user_admin_pass_resets',
        'user_admin_roles',
        'user_admin_user_admin_access_areas',
        'user_user_admin_roles',
        'user_admin_profile_images'
    ];

    /**
     * @return string[]
     */
    public static function getAll() {
        return static::$toTruncate;
    }
}
