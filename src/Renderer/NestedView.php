<?php
declare(strict_types=1);

namespace Doe\Renderer
{
	class NestedView
	{
		private $views = [];
		private $layoutPath = null;
		private $latestArguments = [];

		public function __construct($layoutPath)
		{
			$this->layoutPath = $layoutPath;
		}

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

		public function render() : string
		{
			$allArgs = [];
			$currentView = '';
			for ($i = count($this->views) - 1; $i >= 0; $i--) {
				$view = $this->views[$i];
				$allArgs = $view['overrideArguments'] + $allArgs;
				$currentView = \Doe\Render::render($this->layoutPath . $view['view'], ['content' => $currentView] + $allArgs + $view['arguments']);
			}
			return $currentView;
		}

	}
}