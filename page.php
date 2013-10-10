<?php
//page.php

/*
Template Name: Default
*/

//change the above for page-specific implmentations

//display an individual page

//loop: query a single page, and display it.




get_header();
if (have_posts()) :
   while (have_posts()) :
      the_post();
/* post_class is required by ThemeCheck */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class();?>>
    <h1>
    <?php the_title();//title of the post 
    ?></h1>
	
    <?php
	$subtitle = widgeon_get_subtitle();
	if($subtitle){
	    echo '<p class="subtitle">' . $subtitle . '</p>';
		}
	?>	
    
	
	
    <?php
		// recommended by ThemeCheck.
		// via http://codex.wordpress.org/Function_Reference/add_theme_support
		if ( has_post_thumbnail() ) {
			the_post_thumbnail();
		}	
	
    the_content();//full post content
    
    //THERE ARE MANY OTHER TAGS AVAILABLE.
    // too many to list here!
    
    // see the documentation at http://codex.wordpress.org/Template_Tags
    
    ?>
</article>
<?php
   endwhile;
endif;
get_sidebar();//page-specific sidebars?
get_footer(); 

?>