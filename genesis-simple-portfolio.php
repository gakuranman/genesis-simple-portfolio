<?php

/*
 *	Plugin Name: Genesis Simple Portfolio
 *	Plugin URI: http://gakuran.com/genesis-simple-portfolio/
 *	Description: Adds a portfolio to any WordPress theme, with support for the Genesis framework.
 *	Author: Michael Gakuran
 *	Author URI: http://gakuran.com/
 *	Tags: portfolio, genesis
 *	Version: 0.4.0
 *	Text Domain: genesis-simple-portfolio
 *	License: GNU General Public License v2.0 (or later)
 *	License URI: http://www.opensource.org/licenses/gpl-license.php
 *
 *	This program is free software; you can redistribute it and/or modify it under the terms of the GNU
 *	General Public License version 2, as published by the Free Software Foundation.  You may NOT assume
 *	that you can use any other version of the GPL.
 *	This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without
 *	even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

// =================================================================
// = Translations =
// =================================================================

//* Load the translations for the plugin
add_action( 'init', 'gsp_load_translations', 1 );
function gsp_load_translations() {
	$domain = 'genesis-simple-portfolio';
	$locale = apply_filters( 'plugin_locale', get_locale(), $domain );
	load_textdomain( $domain, trailingslashit( WP_LANG_DIR ) . $domain . '/' . $domain . '-' . $locale . '.mo' );
	load_plugin_textdomain( $domain, false, basename( dirname( __FILE__ ) ) . '/languages' );
}

// =================================================================
// = Portfolio Setup =
// =================================================================

//* Create hierarchical type taxonomy before custom post type for rewrite rules to work
add_action( 'init', 'gsp_type_taxonomy' );
function gsp_type_taxonomy() {

	$labels = array(
		'name'				=> __( 'Types', 'genesis-simple-portfolio' ),
		'singular_name'			=> __( 'Type', 'genesis-simple-portfolio' ),
		'menu_name'			=> __( 'Types', 'genesis-simple-portfolio' ),
		'all_items'			=> __( 'All Types', 'genesis-simple-portfolio' ),
		'edit_item'			=> __( 'Edit Type', 'genesis-simple-portfolio' ),
		'view_item'			=> __( 'View Type', 'genesis-simple-portfolio' ),
		'update_item'			=> __( 'Update Type', 'genesis-simple-portfolio' ),
		'add_new_item'			=> __( 'Add New Type', 'genesis-simple-portfolio' ),
		'new_item_name'			=> __( 'New Type Name', 'genesis-simple-portfolio' ),
		'parent_item'			=> __( 'Parent Type', 'genesis-simple-portfolio' ),
		'parent_item_colon'		=> __( 'Parent Type:', 'genesis-simple-portfolio' ),
		'search_items'			=> __( 'Search Types', 'genesis-simple-portfolio' ),
		'popular_items'			=> __( 'Popular Types', 'genesis-simple-portfolio' ),
		'separate_items_with_commas'	=> __( 'Separate types with commas', 'genesis-simple-portfolio' ),
		'add_or_remove_items'		=> __( 'Add or remove types', 'genesis-simple-portfolio' ),
		'choose_from_most_used'		=> __( 'Choose from the most used types', 'genesis-simple-portfolio' ),
		'not_found'			=> __( 'No types found.', 'genesis-simple-portfolio' ),
	);

	$args = array(
		'labels'		=> $labels,
		'public'		=> true,
		'show_ui'		=> true,
		'show_in_menu'		=> true,
		'show_in_nav_menus'	=> true,
		'show_tagcloud'		=> false,
		'show_in_quick_edit'	=> true,
		'show_admin_column'	=> true,
		'hierarchical'		=> true, // True allows descendants/sub-levels (like categories)
		'query_var'		=> true,
		'rewrite'		=> array( 'slug' => 'portfolio/type', 'with_front' => false, 'hierarchical' => true ), // Permalink formats
	); 

	$args = apply_filters('gsp_type_taxonomy_args', $args); // Allow users to change type taxonomy arguments

	register_taxonomy( 'type', 'portfolio', $args );
}

//* Create non-hierarchical label taxonomy before custom post type for rewrite rules to work
add_action( 'init', 'gsp_label_taxonomy' );
function gsp_label_taxonomy() {

	$labels = array(
		'name'				=> __( 'Labels', 'genesis-simple-portfolio' ),
		'singular_name'			=> __( 'Label', 'genesis-simple-portfolio' ),
		'menu_name'			=> __( 'Labels', 'genesis-simple-portfolio' ),
		'all_items'			=> __( 'All Labels', 'genesis-simple-portfolio' ),
		'edit_item'			=> __( 'Edit Label', 'genesis-simple-portfolio' ),
		'view_item'			=> __( 'View Label', 'genesis-simple-portfolio' ),
		'update_item'			=> __( 'Update Label', 'genesis-simple-portfolio' ),
		'add_new_item'			=> __( 'Add New Label', 'genesis-simple-portfolio' ),
		'new_item_name'			=> __( 'New Label Name', 'genesis-simple-portfolio' ),
		'parent_item'			=> __( 'Parent Label', 'genesis-simple-portfolio' ),
		'parent_item_colon'		=> __( 'Parent Label:', 'genesis-simple-portfolio' ),
		'search_items'			=> __( 'Search Labels', 'genesis-simple-portfolio' ),
		'popular_items'			=> __( 'Popular Labels', 'genesis-simple-portfolio' ),
		'separate_items_with_commas'	=> __( 'Separate labels with commas', 'genesis-simple-portfolio' ),
		'add_or_remove_items'		=> __( 'Add or remove labels', 'genesis-simple-portfolio' ),
		'choose_from_most_used'		=> __( 'Choose from the most used labels', 'genesis-simple-portfolio' ),
		'not_found'			=> __( 'No labels found.', 'genesis-simple-portfolio' ),
	);

	$args = array(
		'labels'		=> $labels,
		'public'		=> true,
		'show_ui'		=> true,
		'show_in_menu'		=> true,
		'show_in_nav_menus'	=> true,
		'show_tagcloud'		=> false,
		'show_in_quick_edit'	=> true,
		'show_admin_column'	=> true,
		'hierarchical'		=> false, // False denies descendants/sub-levels (like tags)
		'query_var'		=> true,
		'rewrite'		=> array( 'slug' => 'portfolio/label', 'with_front' => false ), // Permalink formats
	  ); 

	$args = apply_filters('gsp_label_taxonomy_args', $args); // Allow users to change label taxonomy arguments

	register_taxonomy( 'label', 'portfolio', $args );
}

//* Create portfolio custom post type
add_action( 'init', 'gsp_portfolio_post_type' );
function gsp_portfolio_post_type() {

	$labels = array(
		'name'			=> __( 'Portfolio', 'genesis-simple-portfolio' ),
		'singular_name'		=> __( 'Portfolio Item', 'genesis-simple-portfolio' ),
		'menu_name'		=> __( 'Portfolio', 'admin menu', 'genesis-simple-portfolio' ),
		'name_admin_bar'	=> __( 'Portfolio Item', 'add new on admin bar', 'genesis-simple-portfolio' ),
		'all_items'		=> __( 'All Portfolio Items', 'genesis-simple-portfolio' ),
		'add_new'		=> __( 'Add New Item', 'genesis-simple-portfolio' ),
		'add_new_item'		=> __( 'Add New Portfolio Item', 'genesis-simple-portfolio' ),
		'edit_item'		=> __( 'Edit Portfolio Item', 'genesis-simple-portfolio' ),
		'new_item'		=> __( 'Add New Portfolio Item', 'genesis-simple-portfolio' ),
		'view_item'		=> __( 'View Item', 'genesis-simple-portfolio' ),
		'search_items'		=> __( 'Search Portfolio', 'genesis-simple-portfolio' ),
		'not_found'		=> __( 'No portfolio items found', 'genesis-simple-portfolio' ),
		'not_found_in_trash'	=> __( 'No portfolio items found in trash', 'genesis-simple-portfolio' ),
		'parent_item_colon'	=> __( 'Parent Portfolio Item:', 'genesis-simple-portfolio' ),
	);

	$supports = array(
		'title',
		'editor',
		'author',
		'thumbnail',
		'excerpt',
		'trackbacks',
		'custom-fields',
		'comments',
		'revisions',
		'page-attributes',
		'post-formats',
		'genesis-seo',
		'genesis-scripts',
		'genesis-cpt-archives-settings',
	);

	$args = array(
		'labels'		=> $labels,
		'supports'		=> $supports,
		'public'		=> true,
		'exclude_from_search'	=> false, // Must set to false to show taxonomy archives
		'show_ui'		=> true,
		'show_in_menu'		=> true,
		'show_in_nav_menus'	=> true,
		'show_in_admin_bar'	=> true,
		'menu_position'		=> 5, // Set to 5 for below Posts, 10 for below Media, 20 for below Pages
		'menu_icon'		=> 'dashicons-portfolio',
		'capability_type'	=> 'post',
		'hierarchical'		=> false, // True allows descendants/sub-levels (like Pages)
		'taxonomies'		=> array( 'type', 'label' ),
		'has_archive'		=> true,
		'query_var'		=> true,
		'can_export'		=> true,
		'rewrite'		=> array( 'slug' => 'portfolio', 'with_front' => false ), // Permalink formats
	); 

	$args = apply_filters('gsp_post_type_args', $args); // Allow users to change custom post type arguments

	register_post_type( 'portfolio', $args );
}

// =================================================================
// = Portfolio Permalink Rules =
// =================================================================

//* Flush rewrite rules after (de)activating plugin
register_deactivation_hook( __FILE__, 'flush_rewrite_rules' ); // WordPress does not yet support this action.
register_activation_hook( __FILE__, 'gsp_rewrite_flush' );
function gsp_rewrite_flush() {

	gsp_type_taxonomy();
	gsp_label_taxonomy();
	gsp_portfolio_post_type();
	flush_rewrite_rules();
}

//* Tell WordPress the slug is taken for hierarchical posts
add_filter( 'wp_unique_post_slug_is_bad_hierarchical_slug', 'gsp_is_bad_hierarchical_slug', 10, 4 );
function gsp_is_bad_hierarchical_slug( $is_bad_hierarchical_slug, $slug, $post_type, $post_parent ) {

	if ( !$post_parent && $slug == 'portfolio' || $slug == 'type' || $slug == 'label'  )
		return true;
	return $is_bad_hierarchical_slug;
}

//* Tell WordPress the slug is taken for non-hierarchical posts
add_filter( 'wp_unique_post_slug_is_bad_flat_slug', 'gsp_is_bad_flat_slug', 10, 3 );
function gsp_is_bad_flat_slug( $is_bad_flat_slug, $slug, $post_type ) {

	if ( $slug == 'portfolio' || $slug == 'type' || $slug == 'label' )
		return true;
	return $is_bad_flat_slug;
}

// =================================================================
// = Portfolio Admin =
// =================================================================

//* Add Portfolio thumbnails in admin columns
add_image_size( 'gsp_admin_thumb', 60, 60, false );
add_filter('manage_edit-portfolio_columns', 'gsp_portfolio_post_column', 2);
add_action('manage_portfolio_posts_custom_column', 'gsp_portfolio_column_thumb', 5, 2);
add_action('admin_head', 'gsp_column_width');

// Add the column
function gsp_portfolio_post_column($columns){
	$columns['thumbnail'] = __( 'Thumbnail', 'genesis-simple-portfolio' );

	// Define order of columns
	$customOrder = array('cb', 'title', 'thumbnail', 'author', 'taxonomy-type', 'taxonomy-label', 'comments', 'date');
	foreach ($customOrder as $colname)
		$new[$colname] = $columns[$colname];    
	return $new;
}

// Get the thumbnail
function gsp_portfolio_column_thumb($column_name, $id) {
	if($column_name === 'thumbnail') {
	echo the_post_thumbnail( 'gsp_admin_thumb' );
	}
}

// Adjust column width
function gsp_column_width() {
	echo '<style type="text/css">';
	echo '.column-thumbnail { width:10%; }';
	echo '</style>';
}

//* Add Portfolio filters to admin screen - set typenow and filters
add_action( 'restrict_manage_posts', 'gsp_restrict_manage_posts' );
function gsp_restrict_manage_posts() {

	// Only display taxonomy filters on desired custom post types
	global $typenow;
	if ($typenow == 'portfolio') {

		// Create an array of taxonomy slugs for filtering
		$filters = array('type', 'label');

		foreach ($filters as $tax_slug) {

			// Retrieve the taxonomy object
			$tax_obj = get_taxonomy($tax_slug);
			$tax_name = $tax_obj->labels->name;

			// Retrieve array of term objects per taxonomy
			$terms = get_terms($tax_slug);

			// Output html for taxonomy dropdown filter
			echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
			echo "<option value=''>Show All $tax_name</option>";
			foreach ($terms as $term) {

				// Output each select option line, check against the last $_GET to show the current option selected
				echo '<option value='. $term->slug, $_GET[$tax_slug] == $term->slug ? ' selected="selected"' : '','>' . $term->name .' (' . $term->count .')</option>';
			}
			echo "</select>";
		}
	}
}
