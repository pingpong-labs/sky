<?php namespace Pingpong\Presenters;

use Illuminate\Database\Eloquent\Model;

class Model extends Model implements PresentableInterface {

	use PresentableTrait;

}