<?php
declare(strict_types=1);

namespace Doe\Tests
{

use PHPUnit\Framework\TestCase;

final class RenderTest extends TestCase
{

	public function testCreateRenderer(): void
	{
		\Doe\Render::$basePath = __DIR__ . '/views/';
		$renderer = \Doe\Render::nestedView();
		$this->assertIsObject(
			$renderer
		);
	}

	public function testNestedViews(): void
	{
		\Doe\Render::$basePath = __DIR__ . '/views/';
		$renderer = \Doe\Render::nestedView()
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
		\Doe\Render::$basePath = __DIR__ . '/views/';
		$renderer = \Doe\Render::nestedView()
			->add('layout.php', ['title' => 'title'])
			->add('test1.php', ['data' => 'stuff'], ['title' => 'overridetitle']);
		$this->assertSame(
			$renderer->render(), 
			'<title>overridetitle</title><main><content>stuff</content></main>'
		);
	}

}
}