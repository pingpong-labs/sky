<?php

namespace Pingpong\Testing;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Facade;

abstract class TestCase extends \Illuminate\Foundation\Testing\TestCase
{
    /**
     * Creates the application.
     *
     * Needs to be implemented by subclasses.
     *
     * @return \Symfony\Component\HttpKernel\HttpKernelInterface
     */
    public function createApplication()
    {
        $app = new Application($this->getBasePath());

        Facade::clearResolvedInstances();
        Facade::setFacadeApplication($app);

        $this->resolveExceptionsHandler($app);
        $this->resolveApplicationConfig($app);
        $this->resolveHttpKernel($app);
        $this->resolveConsoleKernel($app);
        $this->detectEnvironment($app);

        $this->bootstrap($app);

        $this->registerBootedCallback($app);

        return $app;
    }

    /**
     * @param Application $app
     */
    protected function resolveApplicationConfig(Application $app)
    {
        $app->make('Illuminate\Foundation\Bootstrap\LoadConfiguration')->bootstrap($app);

        date_default_timezone_set($this->getApplicationTimezone($app));

        $aliases = array_merge($this->getApplicationAliases($app), $this->getPackageAliases($app));
        $app['config']['app.aliases'] = $aliases;

        $providers = array_merge($this->getApplicationProviders($app), $this->getPackageProviders($app));
        $app['config']['app.providers'] = $providers;
    }

    /**
     * Get application providers.
     *
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function getApplicationProviders($app)
    {
        return [
            'Illuminate\Foundation\Providers\ArtisanServiceProvider',
            'Illuminate\Auth\AuthServiceProvider',
            'Illuminate\Bus\BusServiceProvider',
            'Illuminate\Cache\CacheServiceProvider',
            'Illuminate\Foundation\Providers\ConsoleSupportServiceProvider',
            'Illuminate\Routing\ControllerServiceProvider',
            'Illuminate\Cookie\CookieServiceProvider',
            'Illuminate\Database\DatabaseServiceProvider',
            'Illuminate\Encryption\EncryptionServiceProvider',
            'Illuminate\Filesystem\FilesystemServiceProvider',
            'Illuminate\Foundation\Providers\FormRequestServiceProvider',
            'Illuminate\Hashing\HashServiceProvider',
            'Illuminate\Mail\MailServiceProvider',
            'Illuminate\Database\MigrationServiceProvider',
            'Illuminate\Pagination\PaginationServiceProvider',
            'Illuminate\Pipeline\PipelineServiceProvider',
            'Illuminate\Queue\QueueServiceProvider',
            'Illuminate\Redis\RedisServiceProvider',
            'Illuminate\Auth\Passwords\PasswordResetServiceProvider',
            'Illuminate\Database\SeedServiceProvider',
            'Illuminate\Session\SessionServiceProvider',
            'Illuminate\Translation\TranslationServiceProvider',
            'Illuminate\Validation\ValidationServiceProvider',
            'Illuminate\View\ViewServiceProvider',
        ];
    }

    /**
     * Get application aliases.
     *
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function getApplicationAliases($app)
    {
        return [
            'App' => 'Illuminate\Support\Facades\App',
            'Artisan' => 'Illuminate\Support\Facades\Artisan',
            'Auth' => 'Illuminate\Support\Facades\Auth',
            'Blade' => 'Illuminate\Support\Facades\Blade',
            'Bus' => 'Illuminate\Support\Facades\Bus',
            'Cache' => 'Illuminate\Support\Facades\Cache',
            'Config' => 'Illuminate\Support\Facades\Config',
            'Cookie' => 'Illuminate\Support\Facades\Cookie',
            'Crypt' => 'Illuminate\Support\Facades\Crypt',
            'DB' => 'Illuminate\Support\Facades\DB',
            'Eloquent' => 'Illuminate\Database\Eloquent\Model',
            'Event' => 'Illuminate\Support\Facades\Event',
            'File' => 'Illuminate\Support\Facades\File',
            'Hash' => 'Illuminate\Support\Facades\Hash',
            'Input' => 'Illuminate\Support\Facades\Input',
            'Inspiring' => 'Illuminate\Foundation\Inspiring',
            'Lang' => 'Illuminate\Support\Facades\Lang',
            'Log' => 'Illuminate\Support\Facades\Log',
            'Mail' => 'Illuminate\Support\Facades\Mail',
            'Password' => 'Illuminate\Support\Facades\Password',
            'Queue' => 'Illuminate\Support\Facades\Queue',
            'Redirect' => 'Illuminate\Support\Facades\Redirect',
            'Redis' => 'Illuminate\Support\Facades\Redis',
            'Request' => 'Illuminate\Support\Facades\Request',
            'Response' => 'Illuminate\Support\Facades\Response',
            'Route' => 'Illuminate\Support\Facades\Route',
            'Schema' => 'Illuminate\Support\Facades\Schema',
            'Session' => 'Illuminate\Support\Facades\Session',
            'Storage' => 'Illuminate\Support\Facades\Storage',
            'URL' => 'Illuminate\Support\Facades\URL',
            'Validator' => 'Illuminate\Support\Facades\Validator',
            'View' => 'Illuminate\Support\Facades\View',
        ];
    }

    /**
     * @return string
     */
    abstract public function getBasePath();

    /**
     * Get package aliases.
     *
     * @return array
     */
    protected function getPackageAliases()
    {
        return [];
    }

    /**
     * Get package providers.
     *
     * @return array
     */
    protected function getPackageProviders()
    {
        return [];
    }

    /**
     * @param $app
     */
    protected function registerBootedCallback($app)
    {
        //
    }

    /**
     * @param Application $app
     */
    protected function resolveExceptionsHandler(Application $app)
    {
        $app->singleton(
            'Illuminate\Contracts\Debug\ExceptionHandler',
            'Pingpong\Testing\Exceptions\Handler'
        );
    }

    /**
     * @param Application $app
     */
    protected function resolveConsoleKernel(Application $app)
    {
        $app->singleton(
            'Illuminate\Contracts\Console\Kernel',
            'Pingpong\Testing\Console\Kernel'
        );
    }

    /**
     * @param Application $app
     */
    protected function resolveHttpKernel(Application $app)
    {
        $app->singleton(
            'Illuminate\Contracts\Http\Kernel',
            'Pingpong\Testing\Http\Kernel'
        );
    }

    /**
     * @param Application $app
     *
     * @return string
     */
    protected function getApplicationTimezone(Application $app)
    {
        return 'UTC';
    }

    /**
     * @param $app
     */
    protected function detectEnvironment(Application $app)
    {
        $app->detectEnvironment(function () {
            return 'testing';
        });
    }

    /**
     * @param Application $app
     */
    protected function bootstrap(Application $app)
    {
        $bootstrappers = [
            'Illuminate\Foundation\Bootstrap\DetectEnvironment',
            'Illuminate\Foundation\Bootstrap\LoadConfiguration',
            'Illuminate\Foundation\Bootstrap\ConfigureLogging',
            'Illuminate\Foundation\Bootstrap\HandleExceptions',
            'Illuminate\Foundation\Bootstrap\RegisterFacades',
            'Illuminate\Foundation\Bootstrap\RegisterProviders',
            'Illuminate\Foundation\Bootstrap\BootProviders',
        ];

        foreach ($bootstrappers as $class) {
            $app->make($class)->bootstrap($app);
        }
    }
}
