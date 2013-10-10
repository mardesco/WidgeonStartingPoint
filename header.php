<?php
//header.php


//using the wordpress language_attributes function instead of hard-coding lang="en" for i18n...
?>

<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title><?php 
	//there are a lot of ways you can do this.  many themes perform a conditional check, is this the home page?  is it a search page?  
	//whatever.  I like to keep things simple.
	
	//for easy integration with Yoast SEO plugin, simply use:
	
	//wp_title('');
	
	//if you have NOT set up the Yoast SEO plugin, you might prefer something like this:
	wp_title( ' : ', true, 'right' );
	_e( esc_attr( get_bloginfo('name').' : '.get_bloginfo('description') ) ) ;
	
	?></title>
	<meta name="author" content="YourNameHere">
	<meta name="viewport" content="width=device-width,initial-scale=1">

	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<script src="<?php echo get_template_directory_uri(); ?>/js/modernizr-2.6.1.min.js"></script>
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css">

    
    <!-- begin wp_head -->
    <?php
	//if you're using the Yoast SEO plugin then you don't need to hard-code a meta description tag.
	//instead, just call:
	
	wp_head();
	
	//and it will do the work for you.
	
	//find that the wp_head function outputs a load of garbage you don't need?  start eliminating plugins.
	?>
    <!-- end wp_head -->

</head>
<body <?php 
//wordpress likes to tag the body element with css classes.  
//Add your own as a space-separated string or php array within this function call.
body_class(); 
?>>
<a href="#contentLink" class="visuallyhidden">Skip navigation</a>
<div id="container">
	<header class="site-header">
    	<hgroup>
            <h1 class="logo">
                <a href="<?php 
                    echo home_url('/');//appends a trailing slash
                    ?>" title="<?php echo esc_attr( bloginfo( 'name', 'Display' ) ); ?> : <?php echo esc_attr( bloginfo('description', 'Display') ); ?>">
                <?php 
                //normally you'd want your logo to display here, if you have one.  otherwise:
                bloginfo('name');
                ?>
                </a>
            </h1>
            <!-- optional tagline display. -->
            <h2 class="site-slogan">
            	<?php bloginfo('description'); ?>
            </h2>
        </hgroup>
        
        <?php
		get_search_form();//you can move this to the sidebar, but you'd have to modify the CSS to prevent it from overflowing.
		?>
        
<!-- primary navigation menu. -->
<?php

//quote from the documentation:
//"The Theme's main navigation should support a custom menu with wp_nav_menu()"
//http://codex.wordpress.org/Theme_Development#Widgets_.28sidebar.php.29

wp_nav_menu(array(
	'theme_location' => 'header-nav',
	'container' => 'nav',
	'container_id' => 'headerNav'
	));
	
	//alternatively, you might like to simply use wp_page_menu();
?>

	</header>

<div id="wrapper">

    <!-- optionally remove nav-specific classes as you see fit.  -->    	
    <div id="main" role="main">
	
		<div id="breadcrumbs">
			<div class="content">
				You are here: 
				<?php 
				// this one constructor does the whole thing.  
				$crumbs = new simple_breadcrumb(); 
			?>
			</div>
		</div>	
		
		<a id="contentLink" class="visuallyhidden">&nbsp;</a>
		