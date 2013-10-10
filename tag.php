<?php
//tag.php

/*
Template Name: Tag page
*/

//included automatically
//delete this page to default to archive.php (or index.php) instead

//display a page for a tag.
//see http://codex.wordpress.org/Tag_Templates







get_header();
?><h2>Items tagged: <?php
single_tag_title();//title of the post 
?></h2>
<?php
if (have_posts()) :
   while (have_posts()) :
      the_post();
?>
<article>
<h3>
<?php
// our custom function outputs the title within a permalink, all properly escaped to prevent XSS attacks. 
// see http://codex.wordpress.org/Theme_Development#Untrusted_Data
the_clean_title();
?>
</h3>
<?php
//the_content();//full post content is commented out here, because it would be excessive.

//you probably want to show an excerpt of every post that has this tag.
//for that you can use:

the_excerpt();
//doesn't require a read more link at the bottom, 
//because I've built those into the_excerpt from functions.php

?>

</article>
<?php
   endwhile;
   
   else:
   
   _e("Sorry, no articles found with this tag.", 'widgeon');
   
endif;

paginate(); //blog archive pagination!

get_sidebar();//page-specific sidebars?
get_footer(); 

?>