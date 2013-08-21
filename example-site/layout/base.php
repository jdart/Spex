<!DOCTYPE html>
<!--[if IE 8]> <html class="no-js lt-ie9" lang="en" > <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en" > <!--<![endif]-->
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width" />

		<title><?php echo $page->get("headline|title") ?></title>

		<?php if ($page->summary): ?>
			<meta name="description" content="<?php echo $page->summary ?>" />
		<?php endif ?>

		<?php $metric->includeStyles() ?>
		
		<?php $metric->includeHeadScripts() ?>

	</head>
	<body class="<?php echo "template-$page->template section-{$page->rootParent->name} page-$page layout-{$metric->getLayout()}"; ?>">

		<?php echo $layout_body ?>

		<?php if ($page->editable()): ?>
			<a class="nav" id="editpage" href="<?php echo $config->urls->admin ?>page/edit/?id=<?php echo $page->id ?>">Edit</a>
		<?php endif ?>

		<?php $metric->includeScripts() ?>

		<?php $metric->includeDocReady() ?>

	</body>
</html>