<?php

namespace Edwin\Edwinpermisos;

use Illuminate\Support\ServiceProvider;

class edwinPermisosServiceProvider extends ServiceProvider
{
    public function register(){

        $this->mergeConfigFrom(
            __DIR__.'/../config/Edwinpermisos.php','Edwinpermisos'
        );
    }

    public function boot(){

        //CARAGAR MIGRACIONES
        $this->loadMigrationsFrom([
            __DIR__.'/../database/migrations'
        ]);

        //Publicar MIgraciones
        $this->publishes([
            __DIR__.'/../database/migrations' => database_path('migrations')
        ],'Edwinpermisos-migrations');

        //Publicar Seeds luego realizar composer dump
        $this->publishes([
            __DIR__.'/../database/seeders' => database_path('seeders')
        ],'Edwinpermisos-seeds');

        //Publicar policies y gates
        $this->publishes([
            __DIR__.'/../Policies' => app_path('Policies')
        ],'Edwinpermisos-policies');

         //Publicar vistas
         $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/Edwinpermisos')
        ],'Edwinpermisos-views');

         //Publicar configuracion
         $this->publishes([
            __DIR__.'/../config/Edwinpermisos.php' => config_path('Edwinpermisos.php')
        ],'Edwinpermisos-config');


         //carga de rutas
         $this->loadRoutesFrom(
            __DIR__.'/../routes/web.php'
         );

          //carga de vistas
          $this->loadViewsFrom(
            __DIR__.'/../resources/views', 'Edwinpermisos'
         );
            
      
    }
}
