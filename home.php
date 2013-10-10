<?php
//home.php

/*
Template Name: Home page
*/


// this template will be overridden by front-page.php !!!

//per the wp codex:
//"The home page template, which is the front page by default. If you use a static front page this is the template for the page with the latest posts. "
//-http://codex.wordpress.org/Theme_Development


//controls what the homepage looks like.  
//THE LOOP calls the content.



get_header();

if (have_posts()) :
   while (have_posts()) :
      the_post();
?>
<article>
    <h1>
    <?php the_title();//title of the post 
    ?></h1>
	
    <?php
	$subtitle = widgeon_get_subtitle();
	if($subtitle){
	    echo '<p class="subtitle">' . $subtitle . '</p>';
		}
	?>	
    
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
    the_content();//full post content
    
    //THERE ARE MANY OTHER TAGS AVAILABLE.
    // too many to list here!
    
    // see the documentation at http://codex.wordpress.org/Template_Tags
    
    ?>
</article>
<?php
   endwhile;
endif;

// pagination
paginate();

get_sidebar();//page-specific sidebars?
get_footer(); 

?>