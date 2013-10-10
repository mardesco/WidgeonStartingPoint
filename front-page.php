<?php
//front-page.php

/*
Template Name: Front page
*/

// Trying to use a custom homepage?  Cant get it to change or update?  
// then the first thing you should do is...    DELETE THIS FILE!!!

//this page is called instead of index.php when you have set up a static front page under wp-admin->settings->reading
//It's meant for a homepage blogroll, but its presence will override all other settings!

//use this page to display most recent posts.


//controls what the custom homepage looks like.  
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

paginate();

get_sidebar();//page-specific sidebars?
get_footer(); 


?>

