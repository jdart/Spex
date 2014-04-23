<?php 

/**
 * You might want to add some css/less for this layout only.
 */ 

// $spex->addStyle("styles/basic-page.less");

/**
 * To override the default layout change the below.
 */

// $spex->setLayout('two-column');

?>

<?php echo $spex->partial('slider', array('parent' => $page)) ?>

<?php echo $page->body ?>
