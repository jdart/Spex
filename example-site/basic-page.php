<?php 

/**
 * You might want to add some css/less for this layout only.
 */ 

$spex->addStyle("styles/basic-page.less");

/**
 * You can override the default layout by calling setLayout.
 */

$spex->setLayout('two-column');

?>

<?php // The below slot will be used later in layouts/two-column.php ?>
<?php $spex->slot('sidebar_content', '<p>Some markup</p>') ?>

<?php // Include a reusable slider with the below ?>
<?php echo $spex->partial('slider', array('parent' => $page)) ?>

<?php echo $page->body ?>
