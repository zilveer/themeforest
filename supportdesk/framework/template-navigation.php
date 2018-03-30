<?php

/**
 * Pagination function
 */
 if ( ! function_exists( 'st_pagination' ) ):
    function st_pagination($pages = '', $range = 2)
    {  
         $showitems = ($range * 2)+1;  

         global $paged;
         if(empty($paged)) $paged = 1;

         if($pages == '')
         {
             global $wp_query;
             $pages = $wp_query->max_num_pages;
             if(!$pages)
             {
                 $pages = 1;
             }
         }   

         if(1 != $pages)
         {
             echo "<div class='pagination'>";

             for ($i=1; $i <= $pages; $i++)
             {
                 if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
                 {
                     echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
                 }
             }

             echo "</div>\n";
         }
    }
endif;


/**
 * Display navigation to next/previous pages when applicable
 */
 
if ( ! function_exists( 'st_content_nav' ) ):
function st_content_nav( $nav_id ) {
	global $wp_query;

	$nav_class = 'site-navigation paging-navigation';
	if ( is_single() )
		$nav_class = 'site-navigation post-navigation';

	?>
    <?php if ($wp_query->max_num_pages > 1) { ?>
	<nav role="navigation" id="<?php echo $nav_id; ?>" class="<?php echo $nav_class; ?> clearfix">


	<?php if ( is_single() ) : // navigation links for single posts ?>

		<?php previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'framework' ) . '</span> %title' ); ?>
		<?php next_post_link( '<div class="nav-next">%link</div>', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'framework' ) . '</span>' ); ?>

	<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

        <?php if ( get_previous_posts_link() ) : ?>
		<div class="nav-previous"><?php previous_posts_link( __( '&lt;', 'framework' ) ); ?></div>
		<?php endif; ?>
        
        <?php st_pagination(); ?>
        
        <?php if ( get_next_posts_link() ) : ?>
		<div class="nav-next"><?php next_posts_link( __( '&gt;', 'framework' ) ); ?></div>
		<?php endif; ?>

	<?php endif; ?>

	</nav><!-- #<?php echo $nav_id; ?> -->
	<?php }
}
endif;

/**
 * Breadcrumbs
 */
if ( ! function_exists( 'st_breadcrumb' ) ):
function st_breadcrumb() {
    //Variable (symbol >> encoded) and can be styled separately.
    //Use >> for different level categories (parent >> child >> grandchild)
    $delimiter = '<span class="sep">/</span>';
    //Use bullets for same level categories ( parent . parent )
    $delimiter1 = '<span class="delimiter1">&bull;</span>';
     
    //text link for the 'Home' page
    $main = __("Home", "framework"); 
    //Display only the first 30 characters of the post title.
    $maxLength = 30;
     
    //variable for archived year
    $arc_year = get_the_time('Y', true);
    //variable for archived month
    $arc_month = get_the_time('F', true);
    //variables for archived day number + full
    $arc_day = get_the_time('d', true);
    $arc_day_full = get_the_time('l', true); 
     
    //variable for the URL for the Year
    $url_year = get_year_link($arc_year);
    //variable for the URL for the Month   
    $url_month = get_month_link($arc_year,$arc_month);
	
	//Get the blog page ID
	$posts_page_id = get_option('page_for_posts');

 
    /*is_front_page(): If the front of the site is displayed, whether it is posts or a Page. This is true
    when the main blog page is being displayed and the 'Settings > Reading ->Front page displays'
    is set to "Your latest posts", or when 'Settings > Reading ->Front page displays' is set to
    "A static page" and the "Front Page" value is the current Page being displayed. In this case
    no need to add breadcrumb navigation. is_home() is a subset of is_front_page() */
     
    //Check if NOT the front page (whether your latest posts or a static page) is displayed. Then add breadcrumb trail.
    if (!is_front_page()) {        
        //If Breadcrump exists, wrap it up in a div container for styling.
        //You need to define the breadcrumb class in CSS file.
        echo '<div id="breadcrumbs">';
         
        //global WordPress variable $post. Needed to display multi-page navigations.
        global $post, $cat;        
        //A safe way of getting values for a named option from the options database table.
        $homeLink = home_url(); //same as: $homeLink = get_bloginfo('url');
        //If you don't like "You are here:", just remove it.
        echo '<a href="' . $homeLink . '">' . $main . '</a>' . $delimiter;   
		
		// Get custom post type data
		$st_kb_data = get_post_type_object('st_kb');
		
		
		if (is_home()) {
			
			echo '<a href="' . get_permalink( $posts_page_id ) . '">' . get_the_title($posts_page_id) .'</a>' . $delimiter;	
			
		} elseif (is_tax( 'st_kb_category' ) || get_post_type() == 'st_kb') {
			
			echo '<a href="' . get_post_type_archive_link( 'st_kb' ) . '">' . $st_kb_data->labels->singular_name .'</a>' . $delimiter;
			
		}
         
        //Display breadcrumb for single post
        if (is_single()) { //check if any single post is being displayed.   
		
			if( get_post_type() == 'st_kb' ) {

				$terms = get_the_terms( $post->ID , 'st_kb_category' );
				
				$term = array_pop($terms);
				
				$st_term_ancestors = get_ancestors( $term->term_id, 'st_kb_category' );
				
				$st_term_ancestors = array_reverse( $st_term_ancestors );
			
				foreach( $st_term_ancestors as $st_term_ancestor ) {
				
				// Get the taxonomy link
				$st_category_link = get_term_link( $st_term_ancestor, 'st_kb_category' );
				
				// Get the taxonomy name
				$st_category_data = get_term( $st_term_ancestor, 'st_kb_category' );
				
				echo '<a href="'. $st_category_link .'">'. $st_category_data->name .'</a>' . $delimiter;

				}
				
				echo '<a href="'.get_term_link($term->slug, 'st_kb_category').'">'.$term->name.'</a>';

			} elseif (get_post_type() == 'st_faq' ) {

                echo _e( 'FAQ', 'framework' );

			} else {
				
				echo '<a href="' . get_permalink( $posts_page_id ) . '">' . get_the_title($posts_page_id) .'</a>' . $delimiter;	

                //Put bullets between categories, since they are at the same level in the hierarchy.
				if ( !in_category( '1' )) {
                	echo the_category( $delimiter1, 'multiple');
				}
                    //Display partial post title, in order to save space.
                    //if (strlen(get_the_title()) >= $maxLength) { //If the title is long, then don't display it all.
                    //    echo $delimiter . trim(substr(get_the_title(), 0, $maxLength)) . ' ...';
                    //}                        
                    //else { //the title is short, display all post title.
                    //    echo $delimiter . get_the_title();
                    //}
			}
        
        } elseif (is_tax( 'st_kb_category' )) {
			

			// Get term data to retrive parent
			$st_term_data = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
			$st_term_parent_data = get_term($st_term_data->term_id, get_query_var('taxonomy') );
			
			$st_term_parent_id = $st_term_parent_data->term_id;
			
			$st_term_ancestors = get_ancestors( $st_term_parent_id, 'st_kb_category' );
			
			$st_term_ancestors = array_reverse( $st_term_ancestors );
			
			foreach( $st_term_ancestors as $st_term_ancestor ) {
				
				// Get the taxonomy link
				$st_category_link = get_term_link( $st_term_ancestor, 'st_kb_category' );
				
				// Get the taxonomy name
				$st_category_data = get_term( $st_term_ancestor, 'st_kb_category' );
				
				echo '<a href="'. $st_category_link .'">'. $st_category_data->name .'</a>' . $delimiter;

			}
			
			echo single_cat_title() . $delimiter;
			
		} elseif (is_tax( 'st_kb_tag' )) {	

			echo __('Tagged: ', 'framework'); single_cat_title() . $delimiter;
			
		}
        //Display breadcrumb for category and sub-category archive
        elseif (is_category()) { //Check if Category archive page is being displayed.
            //returns the category title for the current page.
            //If it is a subcategory, it will display the full path to the subcategory.
            //Returns the parent categories of the current category with links separated by '»'
           if ( is_wp_error( $cat_parents = get_category_parents($cat, TRUE, $delimiter) )) 	{ 
			echo $cat_parents; 
			} else {
			echo single_cat_title( '', false );
			}
        }      
        //Display breadcrumb for tag archive       
        elseif ( is_tag() ) { //Check if a Tag archive page is being displayed.
            //returns the current tag title for the current page.
            echo single_tag_title("", false);
        }       
        //Display breadcrumb for calendar (day, month, year) archive
        elseif ( is_day()) { //Check if the page is a date (day) based archive page.
            echo '<a href="' . $url_year . '">' . $arc_year . '</a> ' . $delimiter . ' ';
            echo '<a href="' . $url_month . '">' . $arc_month . '</a> ' . $delimiter . $arc_day . ' (' . $arc_day_full . ')';
        }
        elseif ( is_month() ) {  //Check if the page is a date (month) based archive page.
            echo '<a href="' . $url_year . '">' . $arc_year . '</a> ' . $delimiter . $arc_month;
        }
        elseif ( is_year() ) {  //Check if the page is a date (year) based archive page.
            echo $arc_year;
        }      
        //Display breadcrumb for search result page
        elseif ( is_search() ) {  //Check if search result page archive is being displayed.
		
			echo __('Search Results for: ', 'framework') . get_search_query();
        }      
        //Display breadcrumb for top-level pages (top-level menu)
        elseif ( is_page() && !$post->post_parent ) { //Check if this is a top Level page being displayed.
            echo get_the_title();
        }          
        //Display breadcrumb trail for multi-level subpages (multi-level submenus)
        elseif ( is_page() && $post->post_parent ) {  //Check if this is a subpage (submenu) being displayed.
            //get the ancestor of the current page/post_id, with the numeric ID
            //of the current post as the argument.
            //get_post_ancestors() returns an indexed array containing the list of all the parent categories.               
            $post_array = get_post_ancestors($post);
             
            //Sorts in descending order by key, since the array is from top category to bottom.
            krsort($post_array);
             
            //Loop through every post id which we pass as an argument to the get_post() function.
            //$post_ids contains a lot of info about the post, but we only need the title.
            foreach($post_array as $key=>$postid){
                //returns the object $post_ids
                $post_ids = get_post($postid);
                //returns the name of the currently created objects
                $title = $post_ids->post_title;
                //Create the permalink of $post_ids
                echo '<a href="' . get_permalink($post_ids) . '">' . $title . '</a>' . $delimiter;
            }
            the_title(); //returns the title of the current page.              
        }          
        //Display breadcrumb for author archive  
        elseif ( is_author() ) {//Check if an Author archive page is being displayed.
            global $author;
            //returns the user's data, where it can be retrieved using member variables.
            $user_info = get_userdata($author);
            echo  $user_info->display_name;
        }      
        //Display breadcrumb for 404 Error
        elseif ( is_404() ) {//checks if 404 error is being displayed

        }      
        else {
            //All other cases that I missed. No Breadcrumb trail.
        }
       echo '</div>';    
    } 
}
endif;


/**
 * The formatted output of a list of pages.
 */
add_action( 'numbered_in_page_links', 'numbered_in_page_links', 10, 1 );

/**
 * Modification of wp_link_pages() with an extra element to highlight the current page.
 *
 * @param  array $args
 * @return void
 */
function numbered_in_page_links( $args = array () )
{
    $defaults = array(
        'before'      => '<p>' . __('Pages:', 'framework')
    ,   'after'       => '</p>'
    ,   'link_before' => ''
    ,   'link_after'  => ''
    ,   'pagelink'    => '%'
    ,   'echo'        => 1
        // element for the current page
    ,   'highlight'   => 'span'
    );

    $r = wp_parse_args( $args, $defaults );
    $r = apply_filters( 'wp_link_pages_args', $r );
    extract( $r, EXTR_SKIP );

    global $page, $numpages, $multipage, $more, $pagenow;

    if ( ! $multipage )
    {
        return;
    }

    $output = $before;

    for ( $i = 1; $i < ( $numpages + 1 ); $i++ )
    {
        $j       = str_replace( '%', $i, $pagelink );
        $output .= ' ';

        if ( $i != $page || ( ! $more && 1 == $page ) )
        {
            $output .= _wp_link_page( $i ) . "{$link_before}{$j}{$link_after}</a>";
        }
        else
        {   // highlight the current page
            // not sure if we need $link_before and $link_after
            $output .= "<$highlight>{$link_before}{$j}{$link_after}</$highlight>";
        }
    }

    print $output . $after;
}