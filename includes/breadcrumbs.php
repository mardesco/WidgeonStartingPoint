<?php
/*
Plugin Name: Simple Breadcrumb Navigation
Plugin URI: http://www.kriesi.at/archives/wordpress-plugin-simple-breadcrumb-navigation
Description: A simple and very lightweight breadcrumb navigation that covers nested pages and categories
Version: 1.1
Author: Christian "Kriesi" Budschedl
Author URI: http://www.kriesi.at/
Notes: As edited by Denzel on the Karma dev team, and by Jesse Smith, incorporating source code from Elegant Themes.
*/

/*
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/


class simple_breadcrumb{
	var $options;
	
function simple_breadcrumb(){
	$this->options = array( 	//change this array if you want another output scheme
	'before' => ' ',
	'after' => ' ',
	'delimiter' => '&gt;'
	);
	
	$markup = $this->options['before'].$this->options['delimiter'].$this->options['after'];
	
	global $post;
	echo '<a href="'.home_url().'">';
	
	// some theme devs like to add a custom meta box allowing the end user to specify the home text.
	// seems a bit over-thinking it for this project...
	// if you were to do it, just create the custom meta box, retrieve the value, and if it's not empty, show it instead of the home text.
	// for now:
		
		echo 'Home';

	
		echo "</a>";
		if(!is_front_page() && !is_home()){
			echo $markup;
				
			$output = $this->simple_breadcrumb_case($post);
			
			if ( is_page() || is_single()) {	
				if($output != ''){
					echo $output;
					echo $markup;
				}
				echo "<span class='current_crumb'>";
				the_title();// or wp_title????
				echo " </span>";
			}else{
				if($output != ''){
					echo "<span class='current_crumb'>";
					echo $output;
					echo " </span>";
					}
			}
		}
}

	
function simple_breadcrumb_case($der_post){

	
		
	//global $post, $blog_page;
	$markup = $this->options['before'].$this->options['delimiter'].$this->options['after'];
	if (is_page()){
		 if($der_post->post_parent) {
			 $my_query = get_post($der_post->post_parent);			 
			 $this->simple_breadcrumb_case($my_query);
			 $link = '<a href="';
			 $link .= get_permalink($my_query->ID);
			 $link .= '">';
			 $link .= ''. get_the_title($my_query->ID) . '</a>'. $markup;
			 return $link;
		  }	
	return '';			 	
	} 

	
			
	if(is_single()){
		
		$category = get_the_category();
		if (is_attachment()){
		
			$my_query = get_post($der_post->post_parent);			 
			$category = get_the_category($my_query->ID);
			$ID = $category[0]->cat_ID;

			//mod by denzel 2.7.1 dev 1
			//show url of parent post only for attached image, 
			//so that there is not error from unattached image view from WordPress admin
			if($der_post->post_parent !== 0){
			echo get_category_parents($ID, TRUE, $markup, FALSE );
			previous_post_link("%link $markup");
			return '';
			}
			
		
		}else{
			if (!empty($category)) { 
				$catlink = get_category_link( $category[0]->cat_ID );
				return '<a href="'.esc_url($catlink).'">'.esc_html($category[0]->cat_name).'</a><span class="sep"></span> '.get_the_title();
				}else{
					//there is no category.  show the "posts" blogroll page in its stead.
					
					$link = '<a href="';
					 
					 //mod by denzel to fix posts page permalink
					 //use page_for_posts option saved by WordPress admin settings/reading
					 //when user sets a blog page. Instead of using Site Option?
					 
					 $page_for_posts_id = get_option('page_for_posts'); //saved by wordpress.
					 $widgeon_blog_page = get_permalink($page_for_posts_id);
					 
					 $link .= $widgeon_blog_page;
					 $link .= '">';
					 $link .= ''. get_the_title() . '</a>'. $markup;
					 return $link;					
				}				 
						  

			
			}
		
	return '';
	}
	
	if(is_category()){
		$category = get_the_category(); 
		$i = $category[0]->cat_ID;
		$parent = $category[0]-> category_parent;
		
		if($parent > 0 && $category[0]->cat_name == single_cat_title("", false)){
			echo get_category_parents($parent, TRUE, $markup, FALSE);
		}
	return single_cat_title('',FALSE);
	}
	

	if(is_author()){
		//$curauth = get_userdatabylogin(get_query_var('author_name'));
		global $wp_query;
		$curauth = $wp_query->get_queried_object();
		
		return esc_html('Posts by ','wwd_breadcrumbs') . ' ' . $curauth->nickname;;//"Author: ".$curauth->nickname;
	}
	//if(is_tag()){ return "Tag: ".single_tag_title('',FALSE); }
	if( is_tag() ) { 
		return esc_html('Posts Tagged &quot;','wwd_breadcrumbs') . esc_html( single_tag_title(), 'wwd_breadcrumbs' ) . esc_html_e('&quot;: ', 'wwd_breadcrumbs'); 
		}
	
	
	
	
	if(is_404()){ return esc_html('404 Not Found', 'wwd_breadcrumbs'); }
	
	if(is_home()){ return esc_html(get_blog_title(), 'wwd_breadcrumbs'); }
	
	if(is_search()){ 
	//return $widgeon_searchpage_title; 
	return esc_html('Search results for','wwd_breadcrumbs') . esc_html( get_search_query(), 'wwd_breadcrumbs') ;
	}	

	
	if(is_year()){ return get_the_time('Y'); }
	
	if(is_month()){
	$current_year = get_the_time('Y');
	echo "<a href='".get_year_link($current_year)."'>".$current_year."</a>".$markup;
	return get_the_time('F'); }
	
	if(is_day() || is_time()){ 
	$current_year = get_the_time('Y');
	$current_month = get_the_time('m');
	$current_month_display = get_the_time('F');
	echo "<a href='".get_year_link($current_year)."'>".$current_year."</a>".$markup;
	echo "<a href='".get_month_link($current_year, $current_month)."'>".$current_month_display."</a>".$markup;

	return get_the_time('jS (l)'); }
	
	}

}
?>