<a href="https://simpleanalytics.com/?ref=github.com/simpleanalytics/django-plugin">
  <img src="https://assets.simpleanalytics.com/images/logos/logo-github-readme.png" alt="Simple Analytics logo" align="right" height="62" />
</a>

# Laravel Package

## Installing it

Install the plugin:

1. Run
```console
composer require simpleanalytics/laravel-package
```

Or add repositories in composer.json

```
"repositories": [
   {
     "url": "https://github.com/simpleanalytics/laravel-package",
      "type": "git"
    }
 ],
 ```

and add the package name in require with the branch name after the dev:

`"simpleanalytics/laravel-package": "dev-main"`

`"simpleanalytics/laravel-package": "^1.0"`


## Using it

Include the scripts before your end body tag in your .blade template:
```php
    ...
    @include('LaravelPackage::scripts')
</body>
```
## Configuration
The defaults are set in config/cors.php. Publish the config to copy the file to your own config:
```console
php artisan vendor:publish --provider="SimpleAnalytics\LaravelPackage\SimpleAnalyticsServiceProvider" --tag="config"
```

## Track Api Request
To activate serverside tracking of the api activate track-api in your config file:
```php
'track-api' => true
```

## Hints
With version 5.4 or below, you must register your service providers manually in the providers section of the config/app.php configuration file in your laravel project.
