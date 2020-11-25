<?php

namespace HoangPhi\GoogleAuthenticator;


use HoangPhi\GoogleAuthenticator\Console\Commands\InstallCommand;
use HoangPhi\GoogleAuthenticator\Console\Commands\MigrateCommand;
use Illuminate\Support\ServiceProvider;

class GoogleAuthenticatorServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        $this->commands([
            MigrateCommand::class,
        ]);
    }
}
