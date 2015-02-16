## Trusty - Roles and Permissions for Laravel 4

- [Installation](#installation)
- [Creating A Role](#creating-a-role)
- [Creating A Permission](#creating-a-permission)

### Server Requirements

- PHP 5.4 or higher

### Installation

Open your composer.json file, and add the new required package.
```
"pingpong/trusty": "2.0.*@dev" 
```
Next, open a terminal and run.
```
composer update 
```

Next, Add new service provider in `app/config/app.php`.

```php
  'Pingpong\Trusty\TrustyServiceProvider',
```

Next, Add new aliases in `app/config/app.php`.

```php
'Trusty'      => 'Pingpong\Trusty\Facades\Trusty',
'Role'		  => 'Pingpong\Trusty\Entities\Role',
'Permission'  => 'Pingpong\Trusty\Entities\Permission',
```

Next, publish the package's migrations.
```
php artisan vendor:publish
```

**NOTE:** If you want to modify the `roles` and `permissions` table, you can publish the migration.

Done.

### Usage

Add `Pingpong\Trusty\Traits\TrustyTrait` trait to your `User` model. For example.

```php
<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

use Pingpong\Trusty\Traits\TrustyTrait;

class User extends \Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait, TrustyTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

}
?>
```

<a name="creating-a-role"></a>
## Creating A Role.
```php
Role::create([
	'name'			=>	'Administrator',
	'slug'			=>	Str::slug('Administrator', '_'),
	'description'	=>	'The Super Administrator'
]);

// without description
Role::create([
	'name'	=>	'Editor',
	'slug'	=>	Str::slug('Editor', '_'),
]);
```

<a name="creating-a-role"></a>
## Creating A Permission

```php
Permission::create([
	'name'			=>	'Manage Users',
 	'slug'			=>	Str::slug('Manage Users', '_'), // manage_users
 	'description'	=>	'Create, Read, Update and Delete Users'
]);

// without description
Permission::create([
	'name'			=>	'Manage Posts',
 	'slug'			=>	Str::slug('Manage Posts', '_'), // manage_posts
]);
```

<a name="set-permission-for-role"></a>
Set permission for the specified role.

```php
$permission_id = 1;
$role = Role::findOrFail(1);
$role->permissions()->attach($permission_id);
```

Set role for current user.
```php
$role_id = 1;
$user = Auth::user();
$user->roles()->attach($role_id);
```

<a name="adding-role-to-user"></a>
## Adding role to the user.
```php
// by id
Auth::user()->addRole(1);
// by name
Auth::user()->addRole('admin');
```

Check role for current user.
```php
if(Auth::user()->is('administrator'))
{
	// your code here
}
```

Or using magic method.
```php
if(Auth::user()->isAdministrator())
{
	// your code
}
```

Check permission for current user.
```php
if(Auth::user()->can('manage_users'))
{
	// your code here
}
```

Or using magic method.
```php
if(Auth::user()->canManageUsers())
{
	// your code here
}
```

Check permissions against a role.
```php
$role = Role::findOrFail(1);

if ($role->can('manage_users'))
{
	// your code here
}
```

Or using magic method.
```php
$role = Role::findOrFail(1);

if($role->canManageUsers())
{
	// your code here
}
```

Get all permission from current users.
```php
$myPermissions = Auth::user()->permissions;
dd($myPermissions);
```

Simple filtering route based on permission.
```php

// register all permission as filter
Trusty::registerPermissions();

// filter request 
Trusty::when('admin/*', 'filter_name');
 
// mutiple request 
Trusty::when(['admin/users', 'admin/users/*'], 'manage_users');
```

Abort the user if that user have not a specify permission.
```php
Trusty::forbidden();
```

Maybe you can do something like this.
```php
if( ! Auth::user()->canManageUsers())
{
	Trusty::forbidden();
}
```

When you run `forbidden` method, that's will throw an exception. You can handle this exception using Laravel error handler feature. You can do something like this.

```php
App::error(function(Pingpong\Trusty\Exceptions\ForbiddenException $e)
{
	return Response::make($e->getMessage(), 403);
});
```
