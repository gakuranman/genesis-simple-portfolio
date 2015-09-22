=== Genesis Simple Portfolio ===

Contributors: gakuranman
Donate link: http://gakuran.com/genesis-simple-portfolio/
Tags: genesis, genesiswp, studiopress, portfolio, photography, categories, tags, custom post type, taxonomy
Requires at least: 3.5
Tested up to: 4.3.1
Stable tag: 1.0.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Adds a portfolio custom post type to any WordPress website, with support for the Genesis framework.

== Description ==

Genesis Simple Portfolio is a lightweight plugin that adds a custom post type ('portfolio') and two clean taxonomies ('category' and 'tag') to your WordPress installation. It can be used for creating a portfolio on any WordPress website, and also includes special support for the Genesis framework and child themes.

The plugin also features a few nifty extras. You can easily update any of the settings, such as the changing the name 'portfolio' to 'project'. You will also see featured image thumbnails in the Portfolio admin menus to enhance your experience, as well as a filtering system to let you search through your items!

Please note - this plugin does not control how portfolio items are displayed on your WordPress website. For more information on how to customise your theme or change the plugin settings, please visit the Genesis Simple Portfolio plugin homepage: http://gakuran.com/genesis-simple-portfolio/

== Installation ==

= Automatic =

1. On your WordPress website, go to the Plugins > Add New screen in the admin menus.
2. Search for 'Genesis Simple Portfolio' and click 'Install Now'.
3. Go to the Plugins screen and click 'Activate Plugin'.
4. Add new portfolio items through the brand new 'Portfolio' menu.

= Manual =

1. Download the latest plugin file and unzip the plugin.
2. Copy the folder to your /wp-content/plugins/ directory.
3. On your WordPress website, go to the Plugins screen and click 'Activate Plugin'.
4. Add new portfolio items through the brand new 'Portfolio' menu.

= Optional =

1. Create an 'archive.php' template in your WordPress theme to customise general archive listings.
2. Create an 'archive-portfolio.php' template in your WordPress theme to customise the portfolio archive.
3. Create 'taxonomy-portfolio_category.php' and 'taxonomy-portfolio_tag.php' templates in your theme to customise the taxonomy archives.
4. Create a 'single-portfolio.php' template to customise the portfolio single page view.

= Deactivating & Uninstalling =

1. After deactivating the plugin, please visit the Settings > Permalinks page in the WordPress menu to update your URL structures. Just visiting this page (no need to even click 'Save Changes') will flush the rewrite rules and make sure everything is working correctly on your website.
2. Delete the plugin files.

== Frequently Asked Questions ==

Please read the plugin's tutorial page: http://gakuran.com/genesis-simple-portfolio/

== Changelog ==

= 0.5.0 =
* Changed 'type' to 'category' and 'label' to 'tag' after reading more about portfolio naming standards.
* All slugs and references through the plugin have been updated to reflect these changes.
* Code cleanup.

= 0.4.0 =
* Added filterable arguments for custom post type and taxonomies which allows users to modify the settings.
* Changed taxonomy labels to remove 'portfolio'.
* Code cleanup.

= 0.3.0 =
* Added deactivate rewrite flush rules (although WordPress does not yet support this).
* Changed taxonomy slugs to portfolio/type and portfolio/label. This is especially important for types as WordPress reserves this slug for its own post types.

= 0.2.0 =
* Added rewrite flush rules to prevent 404s after activating plugin.
* Added bad slug rules to prevent WordPress creating posts or pages using the Portfolio slug.

= 0.1.0 =
* Initial release.

== Thanks ==

A special thanks to all who have contributed.

= Financial Donations =

* Be the first!

= Code Contributions =

The following people contributed indirectly through their expert tutorials shared code online:

* Bill Erickson
* Brian Gardner
* Justin Tadlock
* Sridhar Katakam
* Carrie Dils
* Mike Schinkel
* Somatic
* Rachel Carden
* Brandon Kraft
* Devin Price

= Translations =

* Be the first!

= StudioPress =

* Special thanks to StudioPress for creating the Genesis framework and making this possible.

If you're not listed and think you should be, please drop me a line!
