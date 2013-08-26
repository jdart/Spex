# Spex 0.0.1

## About Spex

Spex is an asset and template management module for the [ProcessWire CMS/CMF](http://processwire.com/). 

This library was born out of a love of ProcessWire and the yucky feeling the use of a head.inc and foot.inc left in my mouth. The project makes use of [lessphp](http://leafo.net/lessphp/), [less.js](http://lesscss.org/), [jQuery](http://jquery.com/), [modernizr](http://modernizr.com/), [Minify](https://code.google.com/p/minify/) and the ProcessWire [Minify Module](http://modules.processwire.com/modules/minify/).

* [Information about the author](http://metricmarketing.ca/jonathan-dart)
* [Information about Metric Marketing](http://metricmarketing.ca)
* [The author's blog](http://metricmarketing.ca/blog/author/jonathan-dart)
* [Learn more about ProcessWire](http://processwire.com)

## Installation

These steps assume you have ProcessWire installed.

* Install the [Minify Module](http://modules.processwire.com/modules/minify/)
* Clone this repo in your site's modules directory
* [Install the module](http://modules.processwire.com/install-uninstall/)

## Usage

### Files

Spex expects certain files to exist in your templates directory. You can find some boilerplate code in the example-site directory.

* layout (directory)
    + _base.php
    + one-column.php
    + ...
* _assets.php
* _init.php

#### layout/_base.php

This file is responsible for outputting the html, head, body, link (css) and script (js) tags.

This file will have a variable $layout_body that has the output from the layout.

#### layout/one-column.php, layout/two-column.php, etc...

Any file in the layout directory that is not base.php is considered a layout. If your site has one column and two column layout you might want to create one-column.php and two-column.php in your layout directory.

This file will have a variable $template_output available that has the output from your template (aka page render).

#### _assets.php

This is the file where you add global css, less and javascript.

#### _init.php

This file is run before the page render, this is the place to add global assets, set template variables and set a default layout.

### Asset Management

Spex assumes you want your script tags just before the `</body>` tag. You can add javascript files one at a time like the example code below.

`$spex->addScript('scripts/main.js')`

Or a bunch at once:

`$spex->addScript(array('scripts/main.js', 'scripts/another.js'))`

If the source files are outside of the template directory you'll need to pass a second parameter to addJavascript like the below:

`$spex->addScript('lib/main.js', $config->urls->siteModules.'Spex/'))`

The addStyle function works in the same way and accepts .less files and .css files.

#### Production Mode

Spex gives you two modes of operation, production and development (not production). Assets are concatenated and minified when in production mode, when not in production mode they are served as-is.

You can set production mode explicitly, like the below, or you can let Spex guess which mode to use based on whether the httpHost uses a top level domain of .dev or not.

`$spex->setProduction(true)`

#### Deferring Inline JavaScript

If you want some JavaScript in your template that should execute after the JavaScript from _assets.php are included, then use the docReady helper.

    <?php $spex->docReady() ?>
	    <script>$('#bx-me').bxSlider()</script>
    <?php $spex->docReady() ?>

The JavaScript will be wrapped in a `$(document).ready(function(){...})` and found just before the `</body>` tag. 

### Functional Helpers

Most of class methods of spex have functional equivalents. If you want to disable these for reasons of name collisions, then in template/_init.php set:

`$spex->disableHelpers()`

The list of functional helpers are below: 

* addScript
* docReady
* includeScripts
* includeHeadScripts
* includeDocReady
* addStyle
* includeStyles
* setProductionMode
* addTemplateVar
* setLayout
* partial