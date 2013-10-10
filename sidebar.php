<?php
//sidebar.php

/*********************************************
*
*	want to remove one or both of these sidebars?
*	it's very simple.  Here's what you do.
*
*	1. delete the sidebar's HTML and PHP from below.
*	2. delete the code in functions.php that calls register_sidebar to define the sidebar you want to eliminate.
*	3. That's it!  Your unwanted sidebar is gone.
*		(If you're at all uncertain, make a copy of functions.php before editing it, so you can restore, just in case.)
*
***********************************************/



?>

    
    </div><!-- end main -->

</div><!-- end wrapper -->



<!-- if your design includes a right hand side bar -->

<?php
//if( is_active_sidebar('sideNavRight') || has_nav_menu('right-nav')){//this does not function as expected.
?>
<nav class="rightSideNav">

<?php

//what would you like in the right-hand sidebar?

// maybe some widgets.
dynamic_sidebar('sideNavRight');
?>
<!-- if you want a menu of selected pages. -->
<nav id="rightSideNavMenu" class="rightSideNavMenu">
<h2>Selected Pages</h2>
<?php
// perhaps a navigation menu.
wp_nav_menu(array(
	'theme_location' => 'right-nav'
	));
?>
</nav>
<?php	
// or your blog archives.
_e('<h2>' . __('Blog Archives', "widgeon") . '</h2>');
wp_get_archives();//have lots of posts?  you can limit this...  see http://codex.wordpress.org/Template_Tags/wp_get_archives


// perhaps you just want to list a category menu.
_e('<h2>' . __('Categories', "widgeon") . '</h2>');
wp_list_categories( 'title_li=' );	
?>
</nav>
<?php
//}
?>
<!-- 
	if your design includes a left hand side bar 
    ... it has to go AFTER the right hand side bar
    
    Please note, the current responsive stylesheet only displays the left sidebar on the left for large screens!!!
 -->
 <?php
?>


<nav class="leftSideNav">
<?php

//what would you like in the left-hand sidebar?  (or below your content, for smaller screens?)

// maybe some widgets.
dynamic_sidebar('sideNavLeft');

// perhaps a navigation menu.
_e('<h2>' . __('Navigation', "widgeon") . '</h2>');
wp_nav_menu(array(
	'theme_location' => 'left-nav',
	'container' => 'nav',
	'container_id' => 'leftSideNavMenu',
    'container_class' => 'leftSideNavMenu'
	));
?>
</nav>
<?php
//}else{echo 'there are no widgets registered to sideNavLeft';}
?>