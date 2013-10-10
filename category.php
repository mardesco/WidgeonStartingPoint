<?php
//category.php

/*
Template Name: Category page
*/

//included automatically
//delete to default to archive.php (or index.php) instead

//change the above for page-specific implmentations

//display a parent-level category page
/*
 * want to fine tune?  make category-specific pages with
 * category-{id}.php
 * or
 * category-{slug}.php
 */






get_header();
?>
<h2>Category: <?php single_cat_title(); ?></h2>
    <h4>All posts filed under <?php single_cat_title();?></h4>
	
			<div id="breadcrumbs">
			<div class="content">
				You are here: 
				<?php 
				// this one constructor does the whole thing.  
				$crumbs = new simple_breadcrumb(); 
			?>
			</div>
		</div>	
<?php
if (have_posts()) :
   while (have_posts()) :
      the_post();
	  
/* post_class is required by ThemeCheck */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class();?>>
<h3>
	<?php
	// our custom function outputs the title within a permalink, all properly escaped to prevent XSS attacks. 
	// see http://codex.wordpress.org/Theme_Development#Untrusted_Data
	the_clean_title();
	?>
</h3>
<?php
		// recommended by ThemeCheck.
		// via http://codex.wordpress.org/Function_Reference/add_theme_support
		if ( has_post_thumbnail() ) {
			the_post_thumbnail();
		}

//the_content();//full post content

the_excerpt();
//doesn't require a read more link at the bottom, 
//because I've built those into the_excerpt from functions.php
?>

</article>
<?php
   endwhile;
   
   else:
   
   _e("Sorry, no articles found in this category.", 'widgeon');
   
   
endif;

paginate(); //blog archive pagination!

get_sidebar();
get_footer(); 

?>