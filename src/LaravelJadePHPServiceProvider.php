<?php

namespace mhochm\LaravelJadePHP;

use Illuminate\Support\ServiceProvider;

class LaravelJadePHPServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('jade.compiler', function ($app) {
            $cache = $app['config']['view.compiled'];
            return new JadeCompiler($app['files'], $cache);
        });
        $this->app['view.engine.resolver']->register('jade', function () {
            return new CompilerEngine($this->app['jade.compiler'], $this->app['files']);
        });
        $this->app['view']->addExtension('jade', 'jade');
    }
}