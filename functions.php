<?php
//functions.php

//essential theme customization
//e.g. specify multiple sidebars, change the # of characters in the_excerpt(), or...
//add custom admin panel options for wp-admin!!!
//see http://www.wpfunction.me/ for a couple of convenient options



// first, a litle security.

// prevent direct script access
if(__FILE__ == $_SERVER['SCRIPT_FILENAME']){
    die("This file cannot be executed directly");
}


// remove the wordpress version number from the generator meta tag.
// from http://wordpress.org/support/topic/remove-ltmeta-namegenerator-contentwordpress-25-gt
remove_action('wp_head', 'wp_generator');
// Remove Windows Live Writer link in header (unless you use it... ) 
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link'); 

//remove the version number of your WordPress installation from the "generator" tag in the source code.
//makes it harder for an attacker to guess which security vulnerabilities your installation may have.
//but please note, you should always keep your installation updated anyway!!!
function remove_generator() {
	return '';
}
add_filter('the_generator', 'remove_generator');

// Obscure login screen error messages
// you may not require this function if your installation is using a robust security plugin.  But it doesn't seem to hurt anything.
// courtesy of wpfunction.me
function wpfme_login_obscure(){ 
	return '<strong>Sorry</strong>: The supplied credentials are incorrect.';
	}
add_filter( 'login_errors', 'wpfme_login_obscure' );

// per http://codex.wordpress.org/Theme_Development#Untrusted_Data
// define a custom function for cleaning titles, when they are output within an html attribute.
function the_clean_title(){
	//http://codex.wordpress.org/Function_Reference/the_title_attribute
	printf(	'<a href="%s" title="%s">%s</a>', get_permalink(), the_title_attribute( 'echo=0' ), get_the_title() );
}


/* default value for $content_width, required by ThemeCheck. */
if ( ! isset( $content_width ) ) $content_width = 1024;

/* Editor styles, recommended by ThemeCheck. */
// http://codex.wordpress.org/Function_Reference/add_editor_style
function widgeon_add_editor_styles() {
    add_editor_style( 'css/admin.css' );
}
add_action( 'init', 'widgeon_add_editor_styles' );// the smurf naming convention?  or noconflict?  You decide.


/* theme support, as recommended by ThemeCheck: */
add_theme_support('post-thumbnails');
add_theme_support('custom-header');
add_theme_support('custom-background');


/* theme support, as REQUIRED by ThemeCheck */
add_theme_support('automatic-feed-links');/* does this really help real humans? */





// how do you like to serve jQuery?  
// I believe it belongs in the FOOTER.
function widgeon_serve_jq(){//I'm not so convinced that Google's CDN is always faster.  For me, it hangs sometimes.  But you're welcome to use that URL instead.

	if ( !is_admin() ) {
		$path = get_template_directory_uri() . '/js/jquery-1.8.1.min.js';//get_bloginfo('template_directory') 
		wp_deregister_script('jquery');
		
		// and now, call wp_enqueue_scripts() :: 
		//the all-important fifth argument (when set to true) 
		//places your script in the footer for faster page loads.
		wp_enqueue_script('jquery', $path, array(), '1.8.1',true);
	   }
	}
add_action('wp_enqueue_scripts', 'widgeon_serve_jq');






/*
*
* It's happened to me, and I never thought that it would.
* My functions.php file got bloated.  
* I'm moving much of the bottom portion of this file into included files. 
*
*/



// next, we include formatting.php
// the theme's included layout, styles and formatting.  
// this is the file to edit if you want to remove sidebars:
require_once('includes/formatting.php');





// custom meta boxes.
// the default settings create a subtitle field on the page editor.  
// the default subtitle is retrieved within the theme templates by calling widgeon_get_subtitle()
// to create additional meta boxes for your theme, edit and add them to this included file:
require_once('includes/metaboxes.php');





// pagination.
// to use, call paginate() after the loop on most theme templates, 
// or call paginate_blogroll after the inner loop of a blogroll page.
require_once('includes/pagination.php');





// new!  breadcrumbs by Christian "Kriesi" Budschedl
// http://www.kriesi.at/archives/wordpress-plugin-simple-breadcrumb-navigation
// to use: simply instantiate a simple_breadcrumb object in the place where you want your crumbs to appear
// don't forget to style with css. 
require_once('includes/breadcrumbs.php');




// wp_link_pages required by ThemeCheck.
// container function by c. bavota at http://bavotasan.com/2012/a-better-wp_link_pages-for-wordpress/
// included here.
require_once('includes/link_pages.php');




?>