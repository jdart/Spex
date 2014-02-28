<?php

/**
 * Turn on the functional helpers.
 */

// $spex->enableProceduralHelpers();

/**
 * Make the one-column layout the default.
 */

$spex->setLayout('one-column');

/**
 * The below makes the variable $homepage available in all templates.
 */

// $spex->addTemplateVar('homepage', $pages->get('/'));

/**
 * Add some assets. jQuery and modernizr are already taken care of.
 */

$spex->addScript('scripts/main.js');

$spex->addStyle('styles/main.css');
