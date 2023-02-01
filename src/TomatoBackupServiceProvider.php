<?php

namespace TomatoPHP\TomatoBackup;

use Illuminate\Support\ServiceProvider;
use TomatoPHP\TomatoBackup\Menus\BackupMenu;
use TomatoPHP\TomatoPHP\Services\Menu\TomatoMenuRegister;
use TomatoPHP\TomatoRoles\Services\Permission;
use TomatoPHP\TomatoRoles\Services\TomatoRoles;


class TomatoBackupServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //Register generate command
        $this->commands([
           \TomatoPHP\TomatoBackup\Console\TomatoBackupInstall::class,
        ]);

        //Register Config file
        $this->mergeConfigFrom(__DIR__.'/../config/tomato-backup.php', 'tomato-backup');

        //Publish Config
        $this->publishes([
           __DIR__.'/../config/tomato-backup.php' => config_path('tomato-backup.php'),
        ], 'config');

        //Register Migrations
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        //Publish Migrations
        $this->publishes([
           __DIR__.'/../database/migrations' => database_path('migrations'),
        ], 'migrations');

        //Register views
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'tomato-backup');

        //Publish Views
        $this->publishes([
           __DIR__.'/../resources/views' => resource_path('views/vendor/tomato-backup'),
        ], 'views');

        //Register Langs
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'tomato-backup');

        //Publish Lang
        $this->publishes([
           __DIR__.'/../resources/lang' => resource_path('lang/vendor/tomato-backup'),
        ], 'lang');

        //Register Routes
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

        TomatoMenuRegister::registerMenu(BackupMenu::class);

        $this->registerPermissions();
    }


    /**
     * @return void
     */
    private function registerPermissions(): void
    {
        TomatoRoles::register(Permission::make()
            ->name('admin.backup.index')
            ->guard('web')
            ->group('backup')
        );

        TomatoRoles::register(Permission::make()
            ->name('admin.backup.create')
            ->guard('web')
            ->group('backup')
        );

        TomatoRoles::register(Permission::make()
            ->name('admin.backup.store')
            ->guard('web')
            ->group('backup')
        );

        TomatoRoles::register(Permission::make()
            ->name('admin.backup.download')
            ->guard('web')
            ->group('backup')
        );

        TomatoRoles::register(Permission::make()
            ->name('admin.backup.destroy')
            ->guard('web')
            ->group('backup')
        );
    }

    public function boot(): void
    {
        //you boot methods here
    }
}
