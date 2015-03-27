<?php

use Pingpong\Generators\Parsers\MigrationParser;

class MigrationParserTest extends PHPUnit_Framework_TestCase {

	protected $parser;

	public function setUp()
	{
		$this->parser = new MigrationParser;	
	}

	public function testParseSimpleMigration()
	{
		$excepted = [
			'username' => [
				'string'
			],
			'password' => [
				'string'
			]
		];

		$equal = $this->parser->parse('username:string,password:string');

		$this->assertEquals($excepted, $equal);	
	}

	public function testParseMigrationThatContainSpace()
	{		
		$excepted = [
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

		$this->assertEquals($excepted, $equal);	
	}

	public function testParseMigrationWithMultipleAttributes()
	{		
		$excepted = [
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

		$this->assertEquals($excepted, $equal);	
	}

	public function testParseAdvancedMigration()
	{		
		$excepted = [
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

		$this->assertEquals($excepted, $equal);	
	}
}