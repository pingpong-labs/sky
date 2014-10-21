View Presenter For Laravel
=============================

### Installation

Open your composer.json file, and add the new required package.
	
 	"pingpong/presenters": "1.0.*" 

Next, open a terminal and run.

  	composer update 

Done.

### Example Usage

First, create your own presenter and make sure that class is extends to `Pingpong\Presenters\Presenter` class. Like this.

```php
<?php

use Pingpong\Presenters\Presenter;

class UserPresenter extends Presenter
{
	public function email($attributes = array())
	{
		return HTML::mailto($this->resource->email, $this->resource->email, $attributes);
	}
}
?>
```

Make sure your model/eloquent to extends `Pingpong\Presenters\Model` and set the presenter property to that model/eloquent.

```php
<?php

use Pingpong\Presenters\Model;

class User extends Model
{
	protected $presenter = 'UserPresenter';
}
?>
```

That's it! You're done. Now, within your view, you can do:

```php
<h1>Your email is {{ $user->present()->email }}</h1>
```

Or, call the presenter as method.

```php
<h1>Your email is {{ $user->present()->email(['width' => 140]) }}</h1>
```

### License

This package is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)