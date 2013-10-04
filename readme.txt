=== Gallery Slideshow ===
Contributors: jethin
Tags: slideshow, gallery
Requires at least: 3.0
Tested up to: 3.6.1
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Turn any WordPress gallery into a simple, robust, lightweight and responsive slideshow.

== Description ==

This plugin allows authors to turn a [WordPress gallery](http://codex.wordpress.org/User:Esmi/The_WordPress_Gallery) into a slideshow.

To activate slideshow mode replace the word "gallery" with "gss" in the gallery shortcode outputted by the WordPress media manager. Use "Text" mode in the visual editor to change the shortcode. For example, the default WordPress gallery shortcode:

`[gallery columns="3" ids="1,2,3"]`

becomes:

`[gss ids="1,2,3"]`

[See here](http://s89693915.onlinehome.us/wp/?page_id=4) to view an example slideshow.

To make changes to your slideshow change the shortcode back to "gallery" (in "Text" mode) and make edits using the visual editor / media manager.

The plugin supports two optional attributes:

`[gss ids="1,2,3" name="myslideshow" style="width:50%"]`

*name*: Use this attribute to give slideshow(s) unique ids (applied to container `<div>`). Give each slideshow a unique name / id when displaying multiple slideshows on a single page.

*style*: Inline CSS styles applied to the slideshow container. Display string is prefaced with "style=" and must contain standard "property:value;" syntax.

**Notes**

Slideshow captions are taken from each image's "Caption" field. Upload and use unique versions of any images that are reused elsewhere on your site with different captions.

Slideshow widths should automatically adjust to the smaller of: 1) the width of the largest image in the slideshow or 2) the width of the container it appears in.

The height / width of the image area is set according the image(s) with the largest dimensions. By default images are scaled to fit the width of the slideshow container and bottom aligned. White space will appear on top of some slides if the slideshow contains both horizontal and vertical images.

Slideshows perform best if images are sized to desired slideshow width / container.

Default CSS ids begin with "gss_", classes with "cycle-". Default slideshow id is "gslideshow". Default CSS styles were created using the Twenty Thirteen theme -- some CSS customization may be necessary for other themes.

Links aren't supported on images, but can be entered as HTML in image captions.

This plugin uses [jQuery Cycle2](http://jquery.malsup.com/cycle2/). Cycle2 may conflict with previous versions of Cycle if used on the same page.

== Installation ==

1. Download and unzip the plugin file.
1. Upload the unzipped 'gallery-slideshow' directory to your '/wp-content/plugins/' directory.
1. Activate the plugin through the 'Plugins' menu in WordPress.

== Screenshots ==

1. The "Edit Page" admin screen showing the WP editor in text mode and a sample gss shortcode.
2. A screen capture of a GSS slideshow in the Twenty Thirteen theme. [See here](http://s89693915.onlinehome.us/wp/?page_id=4) to view a working slideshow.