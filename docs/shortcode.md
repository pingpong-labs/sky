Laravel Shortcode
=========

- [Installation](#installation)
- [Registering Shorcode](#registering-shortcode)
- [Compiling Shorcode](#compiling-shortcode)
- [Unregistering Shorcode](#unregistering-shortcode)
- [Destroying All Shorcodes](#destroying-all-shortcode)

<a name="installation"></a>
## Installation
Open your composer.json file, and add the new required package.

```
  "pingpong/shortcode": "2.0.*@dev" 
```

Next, open a terminal and run.

```
  composer update 
```

After the composer updated. Add new service provider in app/config/app.php.

```
  'Pingpong\Shortcode\ShortcodeServiceProvider'
```

Add new Facade alias.
```php
'Shortcode'       => 'Pingpong\Shortcode\ShortcodeFacade',
```

Done.

<a name="registering-shortcode"></a>
## Registering Shorcode

Using closure:
```php
Shortcode::register('a', function($attr, $content = null, $name = null)
{
	$text = Shortcode::compile($content);
	return '<a'.HTML::attributes($attr).'>'. $text .'</a>';
});
```

Using class name.
```php

class DivShortcode
{
  public function register($attr, $content = null, $name = null)
  {
  	$text = Shortcode::compile($content);
  	return '<div'.HTML::attributes($attr).'>'. $text .'</div>';
  }
}

Shortcode::register('div', 'DivShortcode');
```

Using class name with the specified method.
```php

class HTMLShortcode
{
  public function img($attr, $content = null, $name = null)
  {
    $src = array_get($attr, 'src');
  	$text = Shortcode::compile($content);
  	return '<img src="'.$src.'" '.HTML::attributes($attr).'/>';
  }
}


Shortcode::register('img', 'HTMLShortcode@img');
```

Using callback array.
```php

class SpanShortcode
{
  
  public function div($attr, $content = null, $name = null)
  {
  	$text = Shortcode::compile($content);
  	return '<span'.HTML::attributes($attr).'>'. $text .'</span>';
  }
}

Shortcode::register('span', array('SpanShortcode', 'span'));
```

Using function name.
```php
function smallTag($attr, $content = null, $name = null)
{
	$text = Shortcode::compile($content);
	return '<small'.HTML::attributes($attr).'>'. $text .'</small>';
}

Shortcode::register('small', 'smallTag');
```

<a name="compiling-shortcode"></a>
## Compiling Shortcode

```php
$text = '[a href="#"]Click here[/a]';
echo Shortcode::compile($text);

$text = '
[a href="#"]
 [img src="http://placehold.it/140x140"]
 [small]This is small text[/small]
[/a]
';
echo Shortcode::compile($text);
```

<a name="unregistering-shortcode"></a>
## Unregistering Shortcode

```php
Shortcode::unregister('img');
```

<a name="destroying-all-shortcode"></a>
## Destroying All Shortcodes

```php
Shortcode::destroy();
```