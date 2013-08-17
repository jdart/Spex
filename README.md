# MetricPW 0.0.1

## About MetricPW

MetricPW is a set of functions used by Metric Marketing for the ProcessWire CMS/CMF. The focus of the module is to provide asset (js/css/less) management and a cool way of dealing with templates.

This library was born out of a love of ProcessWire and the yucky feeling the use of a head.inc and foot.inc left in my mouth. It assumes you want to use jQuery and modernizr. The project makes use of [lessphp](http://leafo.net/lessphp/) and [Minify](https://code.google.com/p/minify/).

* [Information about the author](http://metricmarketing.ca/jonathan-dart)
* [Information about Metric Marketing](http://metricmarketing.ca)
* [The author's blog](http://metricmarketing.ca/blog/author/jonathan-dart)
* [Learn more about ProcessWire](http://processwire.com)

## Installation

These steps assume you have ProcessWire installed.

* Install the [Minify Module](http://modules.processwire.com/modules/minify/)
* Clone this repo in you're site's modules directory
* [Install the module](http://modules.processwire.com/install-uninstall/)

## Usage

### Files

MetricPW expects certain files to exist in your templates directory. You can find some boilerplate code in the example-site directory.

* layout (directory)
    + base.php
    + default.php
* _assets.php

#### layout/base.php

This file is responsible for outputting the html, head, body, link (css) and script (js) tags.

This file will have a variable $layout_body that has the output from the the layout.

#### layout/default.php

Any file in the layout directory that is not base.php is considered a layout. If your site has one column and two column layout you might want to create one-column.php and two-column.php in your layout directory.

This file will have a variable $template_output available that has the output from your template (aka page render).

#### _assets.php

This is the file where you add global css, less and javascript.

### Asset Management

MetricPW assumes you want your script tags just before the `</body>` tag. You can add javascript files one at a time like the example code below.

`$metric->addJavascript('scripts/main.js')`

Or a bunch at once

`$metric->addJavascript(array('scripts/main.js', 'scripts/another.js'))`

If the source files are outside of the template directory you'll need to pass a second parameter to addJavascript like the below:

`$metric->addJavascript('lib/main.js', $config->urls->siteModules.'Metric/'))`

The addStylesheet function works in the same way and accepts .less files and .css files.

#### Production Mode

MetricPW gives you two modes of operation, production and not production. When in production mode assets are concatenated and minified, when not in production mode they are served as is.

You can set production mode explicitly, like the below, or you can let MetricPW guess which mode to use based on whether the httpHost uses a top level domain of .dev or not.

`$metric->setProduction(true)` 

#### Deferring Inline JavaScript

If you want some JavaScript in your template that should execute after the JavaScript from _assets.php are included, then use the docReady helper.

    <?php $metric->docReady() ?>
	    <script>$('#bx-me').bxSlider()</script>
    <?php $metric->docReady() ?>

The JavaScript will be wrapped in a `$(document).ready(function(){...})` and found just before the `</body>` tag. 
