<?php
declare(strict_types=1);

namespace Doe
{
	class Render
	{
		private static $nestedViews = [];
		public static $basePath = '';

		/**
		 * Create a nested view
		 *
		 * @param string $basePath Base view path
		 * @param string $name Nested view name "default"
		 * @return \Doe\Renderer\NestedView
		 */
		public static function createNestedView(string $name = 'default') : Renderer\NestedView
		{
			return static::$nestedViews[$name] = new Renderer\NestedView();
		}

		/**
		 * Get nested view
		 *
		 * @param string $name Nested view name "default"
		 * @return \Doe\Renderer\NestedView
		 */
		public static function nestedView(string $name = 'default') : Renderer\NestedView
		{
			return static::$nestedViews[$name];
		}

		/**
		 * Render a view
		 *
		 * @param string $view path to view-file to include
		 * @param array $arguments Key/values with arguments to be used in view
		 * @return string Rendered view
		 */
		public static function render(string $view, array $arguments) : string
		{
			ob_start();
			extract($arguments, \EXTR_SKIP);
			include(static::$basePath . $view);
			return ob_get_clean();
		}

	}
}