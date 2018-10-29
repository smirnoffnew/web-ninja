<?php

namespace App\Providers;
use Illuminate\Routing\Router;
use \App\User as User;
use SleepingOwl\Admin\Providers\AdminSectionsServiceProvider as ServiceProvider;
use SleepingOwl\Admin\Contracts\Navigation\NavigationInterface;

class AdminSectionsServiceProvider extends ServiceProvider
{

    protected $sections = [
        User::class => 'App\Admin\Http\Sections\Users',
    ];

    public function registerNavigation( NavigationInterface $navigation ) {
        require base_path( 'app/Admin/navigation.php' );
    }

    public function registerRoutes( Router $router ) {
        require base_path( 'app/Admin/routes.php' );
    }

    public function boot(\SleepingOwl\Admin\Admin $admin)
    {
        parent::boot($admin);
        $this->app->call( [ $this, 'registerRoutes' ] );
        $this->app->call( [ $this, 'registerNavigation' ] );
    }


}
