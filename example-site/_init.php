<?php

/**
 * Make the one-column layout the default.
 */

$spex->setLayout('one-column');

/**
 * The below makes the variable $homepage available in all templates.
 */

// $spex->addTemplateVar('homepage', $pages->get('/'));

/**
 * Force production/debug mode
 */

// $spex->setProductionMode(true);