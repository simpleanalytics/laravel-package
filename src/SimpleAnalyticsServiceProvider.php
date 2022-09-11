<?php

namespace Rouuuge\SimpleAnalytics;

use Illuminate\Support\ServiceProvider;

class SimpleAnalyticsServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/config/config.php', 'simple-analytics');
        view()->share('domain', $this->getDomain());
        view()->share('auto_events', $this->getAutoEvents());
        view()->share('settings', $this->getSettings());
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/config.php' => config_path('simple-analytics.php'),
        ], 'config');

        $this->loadViewsFrom(__DIR__ . '/resources/views', 'simple-analytics');
    }

    private function getAutoEvents () {
        // Automated events
        return config('simple-analytics.automated_events') === true ? 'plus' : 'latest';
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
        if (config('simple-analytics.enabled') === false) {
            $settings['enabled'] = false;
        }
        if (config('simple-analytics.automated_events') === true) {
            $settings['automated_events'] = true;
        }
        if (config('simple-analytics.data-non-unique-hostnames')) {
            $settings['data-non-unique-hostnames'] = config('simple-analytics.data-non-unique-hostnames');
        }
        if (count(config('simple-analytics.data-collect')) > 0) {
            $settings['data-collect'] = config('simple-analytics.data-collect');
        }
        if (count(config('simple-analytics.data-extensions')) > 0) {
            $settings['data-extensions'] = config('simple-analytics.data-extensions');
        }
        if (config('simple-analytics.data-use-title') === true) {
            $settings['data-use-title'] = true;
        }
        if (config('simple-analytics.data-full-urls') === true) {
            $settings['data-full-urls'] = true;
        }
        if (config('simple-analytics.data-sa-global')) {
            $settings['data-sa-global'] = config('simple-analytics.data-sa-global');
        }
        // Custom Settings
        if (count(config('simple-analytics.custom-settings')) > 0) {
            foreach (config('simple-analytics.custom-settings') as $key => $value) {
                $settings[$key] = $value;

            }
        }


        // Setup settings for script
        $settings_str_array = array();
        foreach ($settings as $key => $value) {
            if (is_bool($value)) {
                array_push($settings_str_array, "$key = '".$value == true ? 'true' : 'false'."'");
            } else if (is_array($value)) {
               array_push($settings_str_array, "$key = '".implode(',', $value)."'");
            } else {
               array_push($settings_str_array, "$key = $value");
            }
        }
        return implode(' ', $settings_str_array);
    }
}
