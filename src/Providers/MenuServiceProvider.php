<?php

namespace Brediweb\Menu\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;

class MenuServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->registerFactories();
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadMenu();
    }


    public function loadMenu()
    {
        $this->app->booted(function() {

            if(config('menu.autoload_menu')) {
                if (isset($this->app['config']['bredidashboard']['menu'])) {
                    $arr = $this->app['config']['bredidashboard']['menu'];

                    $menu = [
                        [
                            'nome' => 'Menus',
                            'icone' => 'fas fa-bars',
                            'link' => route('menu::controle.menu.index'),
                            'permissao' => 'controle.menu.index',
                            'activeMenu' => 'menu::controle.menu'
                        ],
                        [
                            'nome' => 'Páginas',
                            'icone' => 'fas fa-file',
                            'link' => route('menu::controle.pagina.index'),
                            'permissao' => 'controle.pagina.index',
                            'activeMenu' => 'menu::controle.pagina'
                        ]
                    ];

                    $this->app['config']->set('bredidashboard.menu', array_merge($arr, $menu));
                }
            }
        });
    }


    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__.'/../config/config.php' => config_path('menu.php'),
        ], 'config');
        $this->publishes([
            __DIR__.'/../config/config.php' => config_path('menu.php'),
        ], 'menu-config');
        $this->mergeConfigFrom(
            __DIR__.'/../config/config.php', 'menu'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/menu');

        $sourcePath = __DIR__.'/../Resources/views';

        $this->publishes([
            $sourcePath => $viewPath
        ],'views');

        $this->publishes([
            $sourcePath => $viewPath
        ],'menu-views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/menu';
        }, \Config::get('view.paths')), [$sourcePath]), 'menu');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/menu');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'menu');
        } else {
            $this->loadTranslationsFrom(__DIR__ .'/../Resources/lang', 'menu');
        }
    }

    /**
     * Register an additional directory of factories.
     *
     * @return void
     */
    public function registerFactories()
    {
        if (! app()->environment('production')) {
            app(Factory::class)->load(__DIR__ . '/../database/factories');
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
