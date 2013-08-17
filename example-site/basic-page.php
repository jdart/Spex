<?php 

$metric = $modules->get('Metric');

$metric->addStylesheet("styles/basic-page.less");

$metric->setLayout('default');

?>

<?php echo $page->body ?>