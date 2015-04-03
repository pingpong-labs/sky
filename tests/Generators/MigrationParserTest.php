<?php

use Pingpong\Generators\Migrations\SchemaParser;

class MigrationParserTest extends PHPUnit_Framework_TestCase {

	protected $parser;

	public function setUp()
	{
		$this->parser = new SchemaParser;	
	}

	public function testParseSimpleMigration()
	{
		$expected = [
			'username' => [
				'string'
			],
			'password' => [
				'string'
			]
		];

		$equal = $this->parser->parse('username:string,password:string');

		$this->assertEquals($expected, $equal);	
	}

	public function testParseMigrationThatContainSpace()
	{		
		$expected = [
			'username' => [
				'string'
			],
			'password' => [
				'string'
			],
			'email' => [
				'string'
			]
		];

		$equal = $this->parser->parse('username:string, password:string , email:string');

		$this->assertEquals($expected, $equal);	
	}

	public function testParseMigrationWithMultipleAttributes()
	{		
		$expected = [
			'title' => [
				'string'
			],
			'slug' => [
				'string',
				'unqiue'
			],
			'body' => [
				'text'
			]
		];

		$equal = $this->parser->parse('title:string, slug:string:unqiue, body:text');

		$this->assertEquals($expected, $equal);	
	}

	public function testParseAdvancedMigration()
	{		
		$expected = [
			'email' => [
				'string(100)',
				'primary'
			],
			'username' => [
				'string(20)',
				'unique'
			],
			'remember_token' => [
				'rememberToken()'
			],
			'soft_delete' => [
				'softDeletes()'
			],
		];

		$equal = $this->parser->parse('email:string(100):primary, username:string(20):unique, remember_token, soft_delete');

		$this->assertEquals($expected, $equal);	
	}

	public function testRenderSimpleMigration()
	{		
		$expected = "\t\t\t".'$table->string(\'title\');'.PHP_EOL;

		$equal = (new SchemaParser('title:string'))->render();

		$this->assertEquals($expected, $equal);	
	}

	public function testRenderAdvanceMigration()
	{		
		$expected = "\t\t\t".'$table->string(\'title\');'.PHP_EOL;
		$expected.= "\t\t\t".'$table->string(\'slug\')->unique();'.PHP_EOL;
		$expected.= "\t\t\t".'$table->text(\'body\');'.PHP_EOL;
		$expected.= "\t\t\t".'$table->rememberToken();'.PHP_EOL;
		$expected.= "\t\t\t".'$table->softDeletes();'.PHP_EOL;

		$equal = (new SchemaParser('title:string, slug:string:unique, body:text, remember_token, soft_delete'))->render();

		$this->assertEquals($expected, $equal);	
	}
}