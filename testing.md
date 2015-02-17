Unit Testing For Laravel's Package
=========

- [Installation](#quick-installation-via-composer)
- [Example Usage](#example-usage)

<a name="quick-installation-via-composer"></a>
### Quick Installation Via Composer

```
composer require "pingpong/testing:2.0.*@dev"
```

<a name="example-usage"></a>
### Example Usage

Your First Test.

```php
use Pingpong\Testing\TestCase;

class LoginControllerTest extends TestCase {

    public function testGetLogin()
    {
        $this->call('GET', '/login');
        $this->assertResponseOk();
    }
}
```

Register The Package's Providers And Aliases.

```php
use Pingpong\Testing\TestCase;

class MasterTestCase extends TestCase {

    public function getPackageAliases()
    {
        return [
            'Sample' => 'Vendor\Sample\Facades\Sample'
        ];
    }

    public function getPackageProviders()
    {
        return [
            'Vendor\Sample\SampleServiceProvider'
        ];
    }
}
```

Register custom booted callback.

```php
use Pingpong\Testing\TestCase;

class MasterTestCase extends TestCase {

    protected function registerBootedCallback($app)
    {
        include __DIR__ . '/../routes.php';
    }
}
```

Setup Your Application Timezone.

```php

use Pingpong\Testing\TestCase;

class MasterTestCase extends TestCase {

    protected function getApplicationTimezone()
    {
        return 'Asia/Jakarta';
    }
}
```
