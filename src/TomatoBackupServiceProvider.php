<?php

namespace TomatoPHP\TomatoBackup;

use Illuminate\Support\ServiceProvider;
use TomatoPHP\TomatoAdmin\Facade\TomatoMenu;
use TomatoPHP\TomatoBackup\Menus\BackupMenu;
use TomatoPHP\TomatoAdmin\Services\Contracts\Menu;
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
        ], 'tomato-backup-config');

        //Register Migrations
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        //Publish Migrations
        $this->publishes([
           __DIR__.'/../database/migrations' => database_path('migrations'),
        ], 'tomato-backup-migrations');

        //Register views
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'tomato-backup');

        //Publish Views
        $this->publishes([
           __DIR__.'/../resources/views' => resource_path('views/vendor/tomato-backup'),
        ], 'tomato-backup-views');

        //Register Langs
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'tomato-backup');

        //Publish Lang
        $this->publishes([
           __DIR__.'/../resources/lang' => app_path('lang/vendor/tomato-backup'),
        ], 'tomato-backup-lang');

        //Register Routes
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

        $this->registerPermissions();
    }

    public function boot(): void
    {
        TomatoMenu::register([
            Menu::make()
                ->group(trans('tomato-backup::global.group'))
                ->label(trans('tomato-backup::global.title'))
                ->icon("bx bxs-backpack")
                ->route("admin.backup.index"),
        ]);
    }

    /**
     * @return void
     */
    private function registerPermissions(): void
    {
        if(class_exists(TomatoRoles::class)){
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
    }
}
