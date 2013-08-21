<?php

/**
 * Make the one-column layout the default.
 */

$metric->setLayout('one-column');

/**
 * The below makes the variable $homepage available in all templates.
 */

// $metric->addTemplateVar('homepage', $pages->get('/'));

/**
 * Force production/debug mode
 */

// $metric->setProductionMode(true);