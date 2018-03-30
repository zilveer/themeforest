<?php

/**
*
* Portfolio
*
*/

add_action('init', 'etheme_portfolio_init');  
if ( ! function_exists( 'etheme_portfolio_init' ) ) {
function etheme_portfolio_init(){
	$labels = array(
		'name' => _x('Projects', 'post type general name'),
		'singular_name' => _x('Project', 'post type singular name'),
		'add_new' => _x('Add New', 'project'),
		'add_new_item' => __('Add New Project'),
		'edit_item' => __('Edit Project'),
		'new_item' => __('New Project'),
		'view_item' => __('View Project'),
		'search_items' => __('Search Projects'),
		'not_found' =>  __('No projects found'),
		'not_found_in_trash' => __('No projects found in Trash'),
		'parent_item_colon' => '',
		'menu_name' => 'Portfolio'
	
	);
	
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'has_archive' => true,
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','editor','author','thumbnail','excerpt','comments')
	);
	
	register_post_type('etheme_portfolio',$args);
	
	$labels = array(
		'name' => _x( 'Tags', 'taxonomy general name' ),
		'singular_name' => _x( 'Tag', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search Types' ),
		'all_items' => __( 'All Tags' ),
		'parent_item' => __( 'Parent Tag' ),
		'parent_item_colon' => __( 'Parent Tag:' ),
		'edit_item' => __( 'Edit Tags' ),
		'update_item' => __( 'Update Tag' ),
		'add_new_item' => __( 'Add New Tag' ),
		'new_item_name' => __( 'New Tag Name' ),
	);
	
	// Custom taxonomy for Project Tags
	/*register_taxonomy('tag',array('etheme_portfolio'), array(
		'hierarchical' => false,
		'labels' => $labels,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'tag' ),
	));*/
	
	$labels2 = array(
		'name' => _x( 'Categories', 'taxonomy general name' ),
		'singular_name' => _x( 'Category', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search Types' ),
		'all_items' => __( 'All Categories' ),
		'parent_item' => __( 'Parent Category' ),
		'parent_item_colon' => __( 'Parent Category:' ),
		'edit_item' => __( 'Edit Categories' ),
		'update_item' => __( 'Update Category' ),
		'add_new_item' => __( 'Add New Category' ),
		'new_item_name' => __( 'New Category Name' ),
	);
	
	
	register_taxonomy('categories',array('etheme_portfolio'), array(
		'hierarchical' => true,
		'labels' => $labels2,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'category' ),
	));

}
}



add_shortcode('portfolio', 'etheme_portfolio_shortcode');

function etheme_portfolio_shortcode() {
	$a = shortcode_atts( array(
       'title' => 'Recent Works',
       'limit' => 12
   ), $atts );
   
   
   return etheme_get_recent_portfolio($a['limit'], $a['title']);
    
}


function etheme_get_recent_portfolio($limit, $title = 'Recent Works', $not_in = 0) {
	$args = array(
		'post_type' => 'etheme_portfolio',
		'order' => 'DESC',
		'orderby' => 'date',
		'posts_per_page' => $limit,
		'post__not_in' => array( $not_in )
	);
	
	return etheme_create_portfolio_slider($args, $title);
}

function etheme_create_portfolio_slider($args,$title = false,$enable_slider_from=4,$last_offset = 3){
	global $wpdb;
    $portfolio_columns = etheme_get_option('portfolio_columns');
    $box_id = rand(1000,10000);
	$multislides = new WP_Query( $args );
	ob_start();
	if ( $multislides->have_posts() ) :
		if ($title) {
			$title_output = '<h4 class="slider-title">'.$title.'</h4>';
		}	
          echo '<div class="product-slider works-slider  columns' . $portfolio_columns . '">';
            echo $title_output;
            echo '<div class="clear"></div>';
            echo '<div class="carousel slider-'.$box_id.'">';
                echo '<div class="slider">';
               	
                $_i=0;
                
        		while ($multislides->have_posts()) : $multislides->the_post();
                    $_i++;
                
                    echo '<div class="slide span3 portfolio-slide">';
                        get_template_part( 'portfolio', 'slide' );
                    echo '</div><!-- slide -->';
                     

        		endwhile; 
                echo '</div><!-- slider -->'; 
            echo '</div><!-- carousel -->'; 
                
            if($_i > $enable_slider_from):
                echo '<div class="prev arrow'.$box_id.'" style="cursor: pointer; ">&nbsp;</div>';
                echo '<div class="next arrow'.$box_id.'" style="cursor: pointer; ">&nbsp;</div>';
            endif; 
          echo '</div><!-- product-slider -->'; 
	endif;
	wp_reset_query();
	if ($_i>$enable_slider_from) {   
	   
	   
        echo '
            <script type="text/javascript">
                jQuery(document).ready(function(){
                    jQuery(".arrow'.$box_id.'.prev").addClass("disabled");
                    jQuery(".slider-'.$box_id.'").iosSlider({
                        desktopClickDrag: true,
                        snapToChildren: true,
                        infiniteSlider: false,
                        navNextSelector: ".arrow'.$box_id.'.next",
                        navPrevSelector: ".arrow'.$box_id.'.prev",
                        lastSlideOffset: '.$last_offset.',
                        onFirstSlideComplete: function(){
                            jQuery(".arrow'.$box_id.'.prev").addClass("disabled");
                        },
                        onLastSlideComplete: function(){
                            jQuery(".arrow'.$box_id.'.next").addClass("disabled");
                        },
                        onSlideChange: function(){
                            jQuery(".arrow'.$box_id.'.next").removeClass("disabled");
                            jQuery(".arrow'.$box_id.'.prev").removeClass("disabled");
                        }
                    });
                });
            </script>
        ';
        
	}
	
	$html = ob_get_contents();
	ob_end_clean();
	
	return $html;
	
}


function etheme_portfolio_pagination($wp_query, $paged, $pages = '', $range = 2) {  
     $showitems = ($range * 2)+1;  

     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   

     if(1 != $pages)
     {
	         echo "<div class='pagintaion'>";
		         echo '<ul class="page-numbers">';
			         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link(1)."' class='prev page-numbers'>&larr;</a></li>";
			
			         for ($i=1; $i <= $pages; $i++)
			         {
			             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
			             {
			                 echo ($paged == $i)? "<li><span class='page-numbers current'>".$i."</span></li>":"<li><a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a></li>";
			             }
			         }
			
			         if ($paged < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged + 1)."' class='next page-numbers'>&rarr;</a></li>";
		         echo '</ul>';
	         echo "</div>\n";
     }
}

add_action("admin_init", "etheme_add_portfolio_meta_boxes");
function etheme_add_portfolio_meta_boxes(){
    
    $post_type = 'etheme_portfolio';
    
    remove_meta_box( 'authordiv' , $post_type, 'normal' );
    remove_meta_box( 'postexcerpt' , $post_type, 'normal' );
    
	add_meta_box("etheme-post-meta-box", __( "Custom Settings", ETHEME_DOMAIN ), "etheme_portfolio_post_meta_box", $post_type, "normal", "low");
}
function etheme_portfolio_post_meta_box() {
    global $post;
?>

<input type="hidden" name="etheme_post_meta_box_nonce" value="<?php echo wp_create_nonce(plugin_basename(__FILE__)); ?>" />

<div class="post-metaboxes">	
<div class="format-settings">
	<div class="format-setting-label">
		<h3 class="label">Item Information</h3>
	</div>
	<div class="format-setting type-text no-desc">
		<div class="format-setting-inner">
			<label>Project Url</label>
			<input type="text" name="etheme_post[project_url][value]" value="<?php etheme_custom_field('project_url'); ?>" />
		</div>
		<div class="format-setting-inner">
			<label>Client</label>
			<input type="text" name="etheme_post[client][value]" value="<?php etheme_custom_field('client'); ?>" />
		</div>
		<div class="format-setting-inner">
			<label>Client Url</label>
			<input type="text" name="etheme_post[client_url][value]" value="<?php etheme_custom_field('client_url'); ?>" />
		</div>
		<div class="format-setting-inner">
			<label>Copyright</label>
			<input type="text" name="etheme_post[copyright][value]" value="<?php etheme_custom_field('copyright'); ?>" />
		</div>
		<div class="format-setting-inner">
			<label>Copyright Url</label>
			<input type="text" name="etheme_post[copyright_url][value]" value="<?php etheme_custom_field('copyright_url'); ?>" />
		</div>
	</div>
</div>



<?php
}
add_action('save_post', 'etheme_portfolio_post_meta_box_save', 1, 2);
function etheme_portfolio_post_meta_box_save($post_id, $post) {

	//	verify the nonce
	if ( !isset($_POST['etheme_post_meta_box_nonce']) || !wp_verify_nonce( $_POST['etheme_post_meta_box_nonce'], plugin_basename(__FILE__) ) )
		return $post->ID;
	//	don't try to save the data under autosave, ajax, or future post.
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return;
	if ( defined('DOING_AJAX') && DOING_AJAX ) return;
	if ( defined('DOING_CRON') && DOING_CRON ) return;
	//	is the user allowed to edit the post or page?
	if ( ('page' == $_POST['post_type'] && !current_user_can('edit_page', $post->ID)) || !current_user_can('edit_post', $post->ID ) )
		return $post->ID;
	$product_defaults = array(
        'project_layout' => '',
        'project_url' => '',
        'client' => '',
        'client_url' => '',
        'copyright' => '',
        'copyright_url' => ''
	); 
	$product = wp_parse_args($_POST['etheme_post'], $product_defaults);
	
	//	store the custom fields
	foreach ( (array)$product as $key => $value ) {
		if ( $post->post_type == 'revision' ) return; // don't try to store data during revision save
		
		if(@$value['global'] == 1) {
			update_post_meta($post->ID, $key, 'global');
		} else {
			if ( @$value['value'] )
				update_post_meta($post->ID, $key, $value['value']);
			else
				update_post_meta($post->ID, $key, '');
		}
		

	}
}