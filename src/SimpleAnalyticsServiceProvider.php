<?php

namespace SimpleAnalytics\LaravelPackage;

use SimpleAnalytics\LaravelPackage\Http\Middleware\TrackApi as MiddlewareTrackApi;
use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;

class SimpleAnalyticsServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/config/config.php', 'simple-analytics');
        view()->share('domain', $this->getDomain());
        view()->share('settings', $this->getSettings());
        view()->share('settings_events', $this->getSettingsEvents());
        view()->share('enabled', config('simple-analytics.enabled'));
        view()->share('auto_events', config('simple-analytics.automated-events'));

    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/config.php' => config_path('simple-analytics.php'),
        ], 'config');

        $this->loadViewsFrom(__DIR__ . '/resources/views', 'simple-analytics');

        if (config('simple-analytics.track-api')) {
            $router = $this->app->make(Router::class);
            $router->pushMiddlewareToGroup('api', MiddlewareTrackApi::class);
        }
    }

    private function getDomain ()
    {
        // Custom Domain
        $domain = 'scripts.simpleanalyticscdn.com';
        if (config('simple-analytics.custom_domain')) {
            $domain = config('simple-analytics.custom_domain');
        }
        return $domain;
    }
    private function getSettings()
    {
        // Settings
        $settings = array();
        if (config('simple-analytics.data-mode')) {
            $settings['data-mode'] = config('simple-analytics.data-mode');
        }
        if (config('simple-analytics.data-collect-dnt') == true) {
            $settings['data-collect-dnt'] = true;
        }
        if (count(config('simple-analytics.data-ignore-pages')) > 0) {
            $settings['data-ignore-pages'] = config('simple-analytics.data-ignore-pages');
        }
        if (config('simple-analytics.data-auto-collect') === false) {
            $settings['data-auto-collect'] = false;
        }
        if (config('simple-analytics.data-onload')) {
            $settings['data-onload'] = config('simple-analytics.data-onload');
        }
        if (config('simple-analytics.data-hostname')) {
            $settings['data-hostname'] = config('simple-analytics.data-hostname');
        }
        if (config('simple-analytics.data-sa-global')) {
            $settings['data-sa-global'] = config('simple-analytics.data-sa-global');
        }
        if (config('simple-analytics.data-non-unique-hostnames')) {
            $settings['data-non-unique-hostnames'] = config('simple-analytics.data-non-unique-hostnames');
        }

        // Custom Settings
        if (count(config('simple-analytics.custom-settings')) > 0) {
            foreach (config('simple-analytics.custom-settings') as $key => $value) {
                $settings[$key] = $value;

            }
        }

        return $this->parseSettings($settings);
    }

    private function getSettingsEvents()
    {
        // Settings
        $settings = array();
        if (count(config('simple-analytics.data-collect')) > 0) {
            $settings['data-collect'] = config('simple-analytics.data-collect');
        }
        if (count(config('simple-analytics.data-extensions')) > 0) {
            $settings['data-extensions'] = config('simple-analytics.data-extensions');
        }
        $settings['data-use-title'] = config('simple-analytics.data-use-title');
        $settings['data-full-urls'] = config('simple-analytics.data-full-urls');

        return $this->parseSettings($settings);
    }

    private function parseSettings($settings)
    {
        // Setup settings for script
        $settings_str_array = array();
        foreach ($settings as $key => $value) {
            if (is_bool($value)) {
                $bool_val = $value ? 'true' : 'false';
                array_push($settings_str_array, $key.'="'.$bool_val.'"');
            } else if (is_array($value)) {
               array_push($settings_str_array, $key.'="'.implode(',', $value).'"');
            } else {
               array_push($settings_str_array, $key.'="'.$value.'"');
            }
        }
        return implode(' ', $settings_str_array);
    }
}
