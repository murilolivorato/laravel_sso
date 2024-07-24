<?php

namespace Tests;

use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

abstract class TestCase extends BaseTestCase
{
    //use CreatesApplication, RefreshDatabase;
    use CreatesApplication, DatabaseTransactions;
    protected $seeder = DatabaseSeeder::class;

}
