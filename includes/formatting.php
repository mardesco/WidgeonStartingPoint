<?php
//formatting.php

/* Next: a better "Read More" link. */

//make the "read more" link in the_excerpt link to the post
//from http://codex.wordpress.org/Function_Reference/the_excerpt#Make_the_.22read_more.22_link_to_the_post
function new_excerpt_more($more) {
       global $post;
	return ' <a href="'. get_permalink($post->ID) . '">(...Read More)</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

// next: Menus!
//courtesy of http://justintadlock.com/archives/2010/06/01/goodbye-headaches-hello-menus
function widgeon_menu_registration(){
	register_nav_menus(array(
		'header-nav' => __('Navigation menu for the headerbar', 'widgeon'),
		'left-nav' => __('Left-hand sidebar navigation menu', 'widgeon'),
		'right-nav' => __('Right-hand sidebar navigation menu', 'widgeon'),
		'footer-nav' => __('Footer navigation menu', 'widgeon')
		));
	}
add_action( 'init', 'widgeon_menu_registration' );


// Enable widgetable sidebar
// You may need to tweak your theme files, more info here - http://codex.wordpress.org/Widgetizing_Themes
// and here:  http://justintadlock.com/archives/2010/11/08/sidebars-in-wordpress
function widgeon_sidebar_registration(){
	register_sidebar(array(
		'id' => 'sideNavLeft',
		'name' => __('sideNavLeft', 'widgeon'),
		'class' => 'sideNavLeftWidget',
		'before_widget' => '<aside class="widget">',
		'after_widget' => '</aside>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	));
	register_sidebar(array(
		'id' => 'sideNavRight',
		'name' => __('sideNavRight', 'widgeon'),
		'class' => 'sideNavRightWidget',
		'before_widget' => '<aside class="widget">',
		'after_widget' => '</aside>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	));
	
	}
add_action( 'widgets_init', 'widgeon_sidebar_registration' );



//this adds a css class to the body element.  via http://www.wpfunction.me/
function wpfme_has_sidebar($classes) {

        $classes[] = 'hasRightNav';

        $classes[] = 'hasLeftNav';

    // return the $classes array
    return $classes;
}
add_filter('body_class','wpfme_has_sidebar');





/* here, we add a custom css class to our sidebar widgets. */
	//courtesy of http://ednailor.com/2011/01/24/adding-custom-css-classes-to-sidebar-widgets/
	//which is based on http://kucrut.org/2010/11/add-custom-classes-to-any-widget/
function kc_widget_form_extend( $instance, $widget ) {
	if ( !isset($instance['classes']) )
		$instance['classes'] = null;
	/* Allows User to Add Custom CSS Classes */
	$row = "<p>\n";	
	$row .= "<label>Class:</label>\n\t<input type='text' name='widget-{$widget->id_base}[{$widget->number}][classes]' id='widget-{$widget->id_base}-{$widget->number}-classes' class='widefat' value='{$instance['classes']}'/>\n";
	$row .= "</p>\n";
	echo $row;
	return $instance;
	}
add_filter('widget_form_callback', 'kc_widget_form_extend', 10, 2);
function kc_widget_update( $instance, $new_instance ) {
	$instance['classes'] = $new_instance['classes'];
	return $instance;
	}
add_filter( 'widget_update_callback', 'kc_widget_update', 10, 2 );
function kc_dynamic_sidebar_params( $params ) {
	global $wp_registered_widgets;
	$widget_id    = $params[0]['widget_id'];
	$widget_obj    = $wp_registered_widgets[$widget_id];
	$widget_opt    = get_option($widget_obj['callback'][0]->option_name);
	$widget_num    = $widget_obj['params'][0]['number'];
	
	if ( isset($widget_opt[$widget_num]['classes']) && !empty($widget_opt[$widget_num]['classes']) )
		$params[0]['before_widget'] = preg_replace( '/class="/', "class=\"{$widget_opt[$widget_num]['classes']} ", $params[0]['before_widget'], 1 );
	
	return $params;
	}
add_filter( 'dynamic_sidebar_params', 'kc_dynamic_sidebar_params' );




?>