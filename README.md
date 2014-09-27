Simple Validator Class for Laravel
=========

[![Build Status](https://travis-ci.org/pingpong-labs/validator.svg)](https://travis-ci.org/pingpong-labs/validator)

### Quick Installation Via Composer

```
composer require "pingpong/validator:1.*"
```

### Example

Your validator class must extends to `Pingpong\Validator\Validator` class.

```php
use Pingpong\Validator\Validator;

class RegisterValidator extends Validator {

    public function rules()
    {
        return [
            'name' => 'required',
            'username' => 'required|unique:users,username',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:6|max:20',
        ];
    }

}
```

Now, inject the validator class to your controller.

```php

class RegisterController extends BaseController {

    protected $validator;

    public function __construct(RegisterValidator $validator)
    {
        $this->validator = $validator;
    }

    public function store()
    {
        $this->validator->validate();

        $user = User::create($this->validator->getInput());

        return Redirect::to('login');
    }

}

```

### Custom Validation Messages

You can also specify the custom validation messages as you want. For example :

```php
use Pingpong\Validator\Validator;

class RegisterValidator extends Validator {

    public function rules()
    {
        return [
            'name' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please enter your name',
        ];
    }

}
```

### Handling Failed Validation

Handle one-by-one via validator class.
```php

use Pingpong\Validator\Validator;

class RegisterValidator extends Validator {

    public function rules()
    {
        return [
            'name' => 'required',
            'username' => 'required|unique:users,username',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:6|max:20',
        ];
    }

    public function failed()
    {
        return Redirect::back()->withInput()->withErrors($this->getErrors());
    }

}
```

Global handler.

```php
App::error(function(Pingpong\Validator\Exceptions\ValidationException $e)
{
    return Redirect::back()->withInput()->withErrors($e->getErrors());
});
```

### License

This package is open-sourced software licensed under [The BSD 3-Clause License](http://opensource.org/licenses/BSD-3-Clause)