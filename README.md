# doerender
A simple nested view pattern

## Doe\Render

## Installation
```
composer require onnerby/doerender
```

### Basic example
```php
\Doe\Render::$basePath = __DIR__ . '/views/';
$renderer = \Doe\Render::createNestedView()
	->add('layout.php', ['title' => 'Default title']);

$renderer->add('embed_view.php', ['viewdata' => 'Stuff']);

echo $renderer->render(); 
```
layout.php
```php
<html>
<head>
	<title><?= $title ?></title>
</head>
<body>
	<?= $content /* $content is always the embedded next view */ ?>
</body>
</html>
```
embeded_view.php
```php
<h1><?= $viewdata ?></h1>
```
will produce
```php
<html>
<head>
	<title>Default title</title>
</head>
<body>
	<h1>Stuff</h1>
</body>
</html>
```


### Advanced example
```php
\Doe\Render::$basePath = __DIR__ . '/views/';
$renderer = \Doe\Render::createNestedView()
	->add('layout.php', ['title' => 'Default title']);

// If you can't access the renderer, we have a helper
\Doe\Render::nestedView()->add('embed_view.php', ['viewdata' => 'Stuff']);

// Arguments in higher view can be overwritten by a third argument
\Doe\Render::nestedView()->add('final_view.php', ['finaldata' => 'Other Stuff'], ['title' => 'Special final_view title']);

echo \Doe\Render::nestedView()->render(); 
```
