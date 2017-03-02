<?php

namespace Tyondo\Cashflow;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;

class CashflowServiceProvider extends ServiceProvider
{

    /**
     * @var array
     */
    protected $providers = [
        'Collective\Html\HtmlServiceProvider',
        'Arcanedev\LogViewer\LogViewerServiceProvider',
        'ConsoleTVs\Charts\ChartsServiceProvider',
    ];
    /**
     * @var array
     */
    protected $aliases = [
        'Form' => 'Collective\Html\FormFacade',
        'Html' => 'Collective\Html\HtmlFacade',
        'Charts' => 'ConsoleTVs\Charts\Facades\Charts',
    ];

    /**
     * Bootstrap the application services.
     * @param mixed
     * @return void
     */
    public function boot(Router $router)
    {
        //loading routes
        $router->group(
            [
                'prefix' => 'musoni',
                'namespace' => 'Tyondo\\Cashflow\\Controllers',
            ], function(){
            $this->loadRoutesFrom(__DIR__.'/Routes/web.php');
        }
        );
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
