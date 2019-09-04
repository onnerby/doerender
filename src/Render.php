<?php
declare(strict_types=1);

namespace Doe
{
	class Render
	{
		private static $nestedViews = [];

		public static function createNestedView(string $viewPath, string $name = 'default') : Renderer\NestedView
		{
			return static::$nestedViews[$name] = new Renderer\NestedView($viewPath);
		}

		public static function nestedView(string $name = 'default') : Renderer\NestedView
		{
			return static::$nestedViews[$name];
		}

		public static function render(string $view, array $arguments) : string
		{
			ob_start();
			extract($arguments, \EXTR_SKIP);
			include($view);
			return ob_get_clean();
		}

	}
}