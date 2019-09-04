<?php
declare(strict_types=1);

namespace Doe\Renderer
{
	/**
	 * A renderer for nested views with unlimited number of subviews
	 */
	class NestedView
	{
		private $views = [];
		private $latestArguments = [];

		/**
		 * Constructor
		 *
		 * @param string $basePath Base view path
		 */
		public function __construct()
		{
		}

		/**
		 * Add a sub-view to nested view
		 *
		 * @param string $view Path to view-file
		 * @param array $arguments key/values with arguments used in added sub-view
		 * @param array $overrideArguments key/values with arguments used in added sub-view and also inherited to all parent views
		 * @return \Doe\Renderer\NestedView for chaining
		 */
		public function add(string $view, array $arguments = [], array $overrideArguments = []) : NestedView
		{
			$this->latestArguments = $arguments + $this->latestArguments;
			$this->views[] = [
				'view' => $view,
				'arguments' => $this->latestArguments,
				'overrideArguments' => $overrideArguments,
			];
			return $this;
		}

		/**
		 * Render current nested view
		 *
		 * @return string Rendered views
		 */
		public function render() : string
		{
			$allArgs = [];
			$currentView = '';
			for ($i = count($this->views) - 1; $i >= 0; $i--) {
				$view = $this->views[$i];
				$allArgs = $view['overrideArguments'] + $allArgs;
				$currentView = \Doe\Render::render($view['view'], ['content' => $currentView] + $allArgs + $view['arguments']);
			}
			return $currentView;
		}

	}
}