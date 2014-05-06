
<?php /* See _base.php for where the html, head, body, script and style tags are generated */ ?>

<div class="wrapper">

	<div class="content">

		<h1><?php echo $page->title ?></h1>

		<?php echo $spex->slot('content') ?>

	</div>

	<div class="sidebar">

		<?php if ($spex->hasSlot('sidebar_content')): ?>

			<?php echo $spex->slot('sidebar_content') ?>

		<?php else: ?>

			<p>Default Sidebar</p>
			
		<?php endif ?>

	</div>

</div>
	