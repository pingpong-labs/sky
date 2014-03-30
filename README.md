Laravel 4 - Simple Presenters
=============================

### Installation

Open your composer.json file, and add the new required package.
	
 	"pingpong/presenters": "1.0.0" 

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

```

Now, you can use presenter like this on your controller.

```php
<?php

class UsersController extends BaseController
{
	public function index()
	{
		$user = User::first();
		$presenter = new UserPresenter($user);
		return View::make('users.index', compact('user', 'presenter'));
	}
}

```

Simple access presenter property on view.
```php
<div>
	{{ $presenter->email }}
</div>
```

**How about argument on presenter method ?**
Your can all that as a method. Like this.
```php
<div>
	{{ $presenter->email(['class' => 'btn btn-primary']) }}
</div>
```

**Now, how about get all user ?**
You can use `Pingpong\Presenters\PresenterCollection` class for this case.
Like this.

```php
<?php

use Pingpong\Presenters\PresenterCollection;

class UsersController extends BaseController
{
	
	public function index()
	{
		$users = User::all();
		$presenter = new PresenterCollection('UserPresenter', $users);
		return View::make('users.index')->with('users', $presenter);
	}
}
```

On view, you can access your presenter as property or method.

```
@foreach($users as $user)
	<div>
		{{ $user->email }}
	</div>
@endforeach
```

**Now, how if i have paginated data ?**
You can your `Pingpong\Presenters\PresenterPagination` class.
Like this.

```php
<?php

use Pingpong\Presenters\PresenterPagination;

class UsersController extends BaseController
{
	
	public function index()
	{
		$users = User::paginate(10);
		$presenter = new PresenterPagination('UserPresenter', $users);
		return View::make('users.index')->with('users', $presenter);
	}
}
```

### License

This package is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)