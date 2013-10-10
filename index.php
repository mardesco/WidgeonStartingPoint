<?php
//index.php

//index.php controls what the homepage looks like.  

//per the documentation:
//"The main template. If your Theme provides its own templates, index.php must be present. "


//typical default: THE LOOP to display the most recent posts.
//custom option: select homepage under wp-admin->settings->reading




//from http://codex.wordpress.org/The_Loop_in_Action and http://codex.wordpress.org/Template_Tags



get_header();

//this is "The Loop"

if (have_posts()) :
   while (have_posts()) :
      the_post();	//makes the current item available for use...
	  ?>

<?php
/* post_class is required by ThemeCheck */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class();?>>
		
	<h1><?php the_title(); ?></h1>	
		<div id="breadcrumbs">
			<div class="content">
				You are here: 
				<?php 
				// this one constructor does the whole thing.  
				$crumbs = new simple_breadcrumb(); 
			?>
			</div>
		</div>			
	
	<section class="content">
	<?php
		// recommended by ThemeCheck.
		// via http://codex.wordpress.org/Function_Reference/add_theme_support
		if ( has_post_thumbnail() ) {
			the_post_thumbnail();
		}
		
		
      the_content();
	 ?>

	</section>  
	  
</article>  

<?php

   endwhile;
endif;

//end of "The Loop"

// pagination
paginate();


get_sidebar();
get_footer(); 

?>