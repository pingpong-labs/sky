<?php

use Illuminate\Support\MessageBag;
use Mockery as m;
use Pingpong\Validator\Validator;

class ValidatorTest extends PHPUnit_Framework_TestCase {

    protected $factory;

    protected $request;

    protected $validator;

    public function setUp()
    {
        $this->factory = m::mock('Illuminate\Validation\Factory');
        $this->request = m::mock('Illuminate\Http\Request');
        $this->validator = new FooValidator($this->factory, $this->request);
    }

    public function test_initialize()
    {
        $this->assertInstanceOf('Pingpong\Validator\Validator', $this->validator);
    }

    public function test_validation_failed()
    {
        $this->factory->shouldReceive('make')->once()->andReturn($this->factory);
        $this->factory->shouldReceive('fails')->once()->andReturn(true);

        $this->request->shouldReceive('all')->once()->andReturn([]);

        $this->factory->shouldReceive('errors')->once()->andReturn(new MessageBag([
            'username' => 'Username is required',
            'passsword' => 'Password is required'
        ]));

        $this->setExpectedException("Pingpong\\Validator\\Exceptions\\ValidationException");

        $isValid = $this->validator->validate();

        $this->assertFalse($isValid);
    }

    public function test_validation_passes()
    {
        $this->factory->shouldReceive('make')->once()->andReturn($this->factory);
        $this->factory->shouldReceive('fails')->once()->andReturn(false);

        $isValid = $this->validator->validate([
            'username' => 'foo',
            'password' => 'bar'
        ]);

        $this->assertTrue($isValid);
    }
}

class FooValidator extends Validator {

    public function rules()
    {
        return [
            'username' => 'required',
            'password' => 'required'
        ];
    }

}