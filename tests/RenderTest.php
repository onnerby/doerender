<?php
declare(strict_types=1);

namespace Doe\Tests
{

use PHPUnit\Framework\TestCase;

final class RenderTest extends TestCase
{

	public function testCreateRouter(): void
	{
		$renderer = \Doe\Render::createNestedView(__DIR__ . '/views/');
		$this->assertIsObject(
			$renderer
		);
	}

	public function testNestedViews(): void
	{
		$renderer = \Doe\Render::createNestedView(__DIR__ . '/views/')
			->add('layout.php', ['title' => 'title']);
		$this->assertSame(
			$renderer->render(), 
			'<title>title</title><main></main>'
		);

		$renderer->add('test1.php', ['data' => 'stuff']);
		$this->assertSame(
			$renderer->render(), 
			'<title>title</title><main><content>stuff</content></main>'
		);
	}

	public function testOverrideArguments(): void
	{
		$renderer = \Doe\Render::createNestedView(__DIR__ . '/views/')
			->add('layout.php', ['title' => 'title'])
			->add('test1.php', ['data' => 'stuff'], ['title' => 'overridetitle']);
		$this->assertSame(
			$renderer->render(), 
			'<title>overridetitle</title><main><content>stuff</content></main>'
		);
	}

}
}