<?php

/**
 * Turn on the procedural helpers so you can use helpers without the $spex variable.
 * 
 * i.e. setLayout('one-column') instead of $spex->setLayout('one-column')
 *
 * Read more: https://github.com/jdart/Spex#procedural-helpers
 */

// $spex->enableProceduralHelpers();

/**
 * Make the one-column layout the default.
 */

$spex->setLayout('one-column');

/**
 * The below makes the variable $homepage available in all templates.
 */

$spex->addTemplateVar('homepage', $pages->get('/'));

/**
 * Add some assets from your site/templates directory, jQuery and assets 
 * hosted on other domains should be included in your _base layout.
 */

$spex->addScript('scripts/main.js');

$spex->addStyle('styles/main.css');
