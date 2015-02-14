Laravel Themes
===============

- [Installation](#installation)
- [Usage](#usage)

<a name="installation"></a>
## Installation

Open your composer.json file, and add the new required package.
```
   "pingpong/themes": "2.0.*@dev"
```
Next, open a terminal and run.
```
composer update
```

Next, Add new service provider in `config/app.php`.

```php
  'Pingpong\Themes\ThemesServiceProvider',
```

Next, Add new aliases in `app/config/app.php`.

```php
   'Theme' => 'Pingpong\Themes\ThemeFacade',
```

Next, publish the asset. The asset is an example theme.
```
php artisan vendor:publish
```

Done.

<a name="usage"></a>
## Usage

Get all themes.
```php
Theme::all();
```

Set theme active.
```php
Theme::set('default');

Theme::setCurrent('default');
```

Get current theme active.
```php
Theme::getCurrent();
```

Check theme.
```php
Theme::has('simple')

Theme::exists('other-theme');
```

Set theme path.
```php
$path = public_path('themes');

Theme::setPath($path);
```

Get theme path.
```php
Theme::getThemePath('default');
```

Get themes path.
```php
Theme::getPath();
```

Get view from current active theme.
```php
Theme::view('index');

Theme::view('folders.view');
```

Get config from current active theme.
```php
Theme::config('group.name');
```

Get lang from current active theme.
```php
Theme::lang('group.name');
```