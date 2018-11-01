# Light Slider

A light-weight, dead-simple WordPress slider plug-in.

## Requirements

* WordPress 4.8 or higher.
* PHP 5.6 or higher.

## Installation

1. Download the [plugin zip file](https://caspar.green/downloads/ic-light-slider/ic-light-slider.zip).
2. Go to your WordPress Dashboard > Plugins > Add New > Upload Plugin and select the downloaded plugin file.
3. Activate.

## How to Use

### Create a slider (or several).

1. Go to your WordPress Dashboard > Slides > Sliders.
2. Give your new slider a name.
3. Click "Add New Slider".

### Create some slides.

1. Go to your WordPress Dashboard > Slides > Add New Slide.
2. Enter a Slide Title (Slide title only shows up here so you can keep track of your slides.
    It won't show on your pages.)
3. IF you want the slide to link somewhere, enter the URL.
4. Select the slider you want this slide to appear in. (You can also create new sliders on the fly.)
5. Give the slide an order number for the sequence you want it to be in within a slide show.
6. Select a featured image for the slide.
7. Publish.

### Show your slider on your site.

Choose any of the following:

#### Use the Light Slider Widget.

1. Drop a slider into any widget area.
2. Give the widget a title. (Titles are just for you to keep track of slider widgets.
    They won't show on your pages.)
3. Select the slider you want to show.

#### Use the Light Slider Shortcode.

1. Go to your WordPress Dashboard > Slides > Sliders and find the "slug" for the slider you want to show from the list.
2. In any post or page, enter the following:

```[ic-slider slider="slider-name"]```

Where "slider-name" is replaced by the slug of the slider you want to appear at that point in your post or page.

#### Add a slider directly to your theme template.

Find where in your template you want the slider to appear and insert:

```<?php ICaspar\LightSlider\Slider::showSlider('sliderName'); ?>```

Where `sliderName` is the slider's slug.

## More About This Plugin

This plugin is a wrapper for Ken Wheeler's [slick](http://kenwheeler.github.io/slick/) slider/carousel. Currently it
supports only the slider functionality with *zero* configuration options. *(Zero options == "dead simple")*
If you want the whole slick package in a WordPress plugin, Ken has a 
[paid version](http://maxgalleria.com/downloads/slick-slider-for-wordpress/) for that.

Slides are set to a fade transition and change every 7.5 seconds. The slick javascript and basic slick styling is
pulled in from the jsDelivr CDN. If you are inclined, you can further style things in your theme's CSS.

## Changelog

### 1.0.1

* Update WP Version compatibility
* Add OSX hidden files to `.gitignore`
* Fix loading of asset dependencies
* Fix warnings thrown by undefined constants in config

### 1.0.0 - First Release Version
