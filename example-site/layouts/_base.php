<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width" />

		<title><?php echo $page->get("headline|title") ?></title>

		<?php if ($page->summary): ?>
			<meta name="description" content="<?php echo $page->summary ?>" />
		<?php endif ?>
		
		<link href="<?php echo AllInOneMinify::CSS($spex->getStyles()) ?>" rel="stylesheet" type="text/css" />
		
	</head>
	<body class="<?php echo "template-$page->template section-{$page->rootParent->name} page-$page layout-{$spex->getLayout()}" ?>">

		<?php echo $spex->slot('content') ?>

		<?php if ($page->editable()): ?>
			<a class="editpage" href="<?php echo $config->urls->admin ?>page/edit/?id=<?php echo $page->id ?>">Edit</a>
		<?php endif ?>

		<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
		<script src="<?php echo AllInOneMinify::JS($spex->getScripts()) ?>"></script>
		<?php $spex->includeDocReady() ?>

	</body>
</html>