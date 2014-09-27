<?php namespace Pingpong\Validator;

use Illuminate\Http\Request;
use Illuminate\Validation\Factory;
use Illuminate\Validation\Validator as IlluminateValidator;
use Pingpong\Validator\Exceptions\ValidationException;

abstract class Validator {

    /**
     * The laravel validation factory instance.
     *
     * @var Factory
     */
    protected $validator;

    /**
     * The illuminateValidator instance.
     *
     * @var IlluminateValidator
     */
    protected $validation;

    /**
     * The laravel request instance.
     *
     * @var Request
     */
    protected $request;

    /**
     * The constructor.
     *
     * @param Factory $validator
     * @param Request $request
     */
    public function __construct(Factory $validator, Request $request)
    {
        $this->validator = $validator;
        $this->request = $request;
    }

    /**
     * The validation rules.
     *
     * @return array
     */
    public function rules()
    {
        return [];
    }

    /**
     * The validation messages.
     *
     * @return array
     */
    public function messages()
    {
        return [];
    }

    /**
     * Handle failed validation.
     *
     * @throws ValidationException
     */
    public function failed()
    {
        throw new ValidationException($this->getErrors(), "Validation failed");
    }

    /**
     * Validate the given data.
     *
     * @param array $data
     * @return bool
     * @throws ValidationException
     */
    public function validate(array $data = null)
    {
        $data = $data ?: $this->getInput();

        $this->validation = $this->validator->make($data, $this->rules(), $this->messages());

        if ($this->validation->fails())
        {
            $this->failed();
        }

        return true;
    }

    /**
     * Get all input.
     *
     * @return array
     */
    public function getInput()
    {
        return $this->request->all();
    }

    /**
     * Get validation instance.
     *
     * @return mixed
     */
    public function getValidation()
    {
        return $this->validation;
    }

    /**
     * Get the laravel validation factory instance.
     *
     * @return Factory
     */
    public function getValidator()
    {
        return $this->validator;
    }

    /**
     * Get the laravel request instance.
     *
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * Get validation errors.
     *
     * @return \Illuminate\Support\MessageBag
     */
    public function getErrors()
    {
        return $this->validation->errors();
    }

    /**
     * Handle magic method __call to the class.
     *
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        if ( ! method_exists($this, $name))
        {
            return call_user_func_array([$this->request, $name], $arguments);
        }

        return call_user_func_array([$this, $name], $arguments);
    }

    /**
     * Handle magic method __get to the class.
     *
     * @param $name
     * @return string
     */
    public function __get($name)
    {
        if ( ! in_array($name, ['validator', 'request', 'validation']))
        {
            return $this->request->input($name);
        }

        return $this->{$name};
    }


}