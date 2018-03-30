<?php
/**
 *  Assets functions for the theme
 * 
 * @package toranj theme
 * @author owwwlab
 */


/**
 * ----------------------------------------------------------------------------------------
 * Add custom breadcrumbs 
 * ----------------------------------------------------------------------------------------
 */

if ( ! function_exists( 'the_owlab_breadcrumbs' ) ) {

	function the_owlab_breadcrumbs() {
	 
	    global $post;

	    if (!is_home()) {

	        echo "<li><a href='";
	        echo home_url();
	        echo "'>";
	        echo bloginfo('name');
	        echo "</a></li>";

	        if (is_category() || is_single()) {

	        	//@TODO : Don't we need to search for custom taxonomies of the single page?

	            $cats = get_the_category( $post->ID );

	            foreach ( $cats as $cat ){
	                echo "<li>";
	                echo $cat->cat_name;
	                echo " </li> ";
	            }
	            if (is_single()) {
	                echo "<li class='active'>";
	                the_title();
	                echo "</li>";
	            }
	        } elseif (is_page()) {

	            if($post->post_parent){
	                $anc = get_post_ancestors( $post->ID );
	                $anc_link = get_page_link( $post->post_parent );

	                foreach ( $anc as $ancestor ) {
	                    $output = "<li><a href=".$anc_link.">".get_the_title($ancestor)."</a> </li>";
	                }

	                echo $output;
	                echo "<li class='active'>";
	                the_title();
	                echo "</li>";

	            } else {
	                echo "<li class='active'>";
	                the_title();
	                echo "</li>";
	            }
	        }
	    }
	    elseif (is_tag()) {
	    	echo "<li class='active'>";
	    	single_tag_title();
	    	echo "</li>";
	    }
	    elseif (is_day()) {
	    	echo "<li class='active'>";
	    	echo "Archive: "; the_time('F jS, Y'); 
	    	echo'</li>';
	    }
	    elseif (is_month()) {
	    	echo "<li class='active'>";
	    	echo"Archive: "; the_time('F, Y'); 
	    	echo'</li>';
	    }
	    elseif (is_year()) {
	    	echo "<li class='active'>";
	    	echo"Archive: "; the_time('Y'); 
	    	echo'</li>';
	    }
	    elseif (is_author()) {
	    	echo "<li class='active'>";
	    	echo "Author's archive: "; 
	    	echo '</li>';
	    }
	    elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {
	    	echo "<li class='active'>";
	    	echo "Blogarchive: "; echo '';
	    	echo "</li>";
	    }
	    elseif (is_search()) {
	    	echo "<li class='active'>";
	    	echo "Search results: ";
	    	echo "</li>";
	    }
	}
}


/**
 * ----------------------------------------------------------------------------------------
 * Display navigation to the next/previous set of posts for blog grid
 * ----------------------------------------------------------------------------------------
 */
if ( ! function_exists( 'owlab_blog_grid_paging_nav' ) ) {
	function owlab_blog_grid_paging_nav($max=0) { 
		
		$next = get_previous_posts_link(__( 'Prev', 'toranj' ),$max);
		$prev = get_next_posts_link(__( 'Next', 'toranj' ),$max);
		
		if ($next OR $prev){
		?>
			<div id="post-nav">
				<?php 
					if ( $next ) : ?>
					<?php echo $next; ?>
					<?php endif;
				 ?>
				<?php 
					if ( $prev ) : ?>
					<?php echo $prev; ?>
					<?php endif;
				 ?>
				<div class="clearfix"></div>
			</div><!--/ post-nav --><?php
		}
	}
}

/**
 * ----------------------------------------------------------------------------------------
 * Display navigation to the next/previous post
  * ----------------------------------------------------------------------------------------
 */
if ( ! function_exists( 'owlab_blog_single_paging_nav' ) ) {
	function owlab_blog_single_paging_nav() { 
		
		$next = get_next_post();
		$prev = get_previous_post();
		
		if ($next OR $prev){
		?>
			<div id="post-nav">
				<?php 
					if ( $next ) : ?>
					<a class="next-post btn btn-lg btn-simple pull-right" href="<?php echo get_permalink( $next->ID ); ?>" title="<?php echo $next->post_title; ?>"><?php _e('Next','toranj') ?></a>
					<?php endif;
				 ?>
				<?php 
					if ( $prev ) : ?>
					<a class="prev-post btn btn-lg btn-simple pull-left" href="<?php echo get_permalink( $prev->ID ); ?>" title="<?php echo $prev->post_title; ?>"><?php _e('Prev','toranj') ?></a>
					<?php endif;
				 ?>
				<div class="clearfix"></div>
			</div><!--/ post-nav --><?php
		}
	}
}


/**
 * ----------------------------------------------------------------------------------------
 * Display meta information for a specific post.
 * ----------------------------------------------------------------------------------------
 */
if ( ! function_exists( 'owlab_post_meta' ) ) {
	function owlab_post_meta() {
		

		if ( get_post_type() === 'post' ) {
			// If the post is sticky, mark it.
			if ( is_sticky() ) {
				echo '<span class="sticky-span"><i class="fa fa-lg fa-thumb-tack"></i>' . __( 'Sticky', 'toranj' ) . '</span>';
			}

			// Get the post author.
			printf(
				'<span class="author-span"><i class="fa fa-lg fa-edit"></i><a href="%1$s">%2$s</a></span>',
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				get_the_author()
			);

			// Get the date.
			printf(
				'<span class="date-span"><i class="fa fa-lg fa-clock-o"></i>%s</span>',
				get_the_date()
			);

			// The categories.
			$category_list = get_the_category_list( ', ' );
			if ( $category_list ) {
				echo '<span class="category-span"><i class="fa fa-lg fa-folder"></i> ' . $category_list . ' </span>';
			}

			// The tags.
			if(is_single()){
				$tag_list = get_the_tag_list( '', ', ' );
				if ( $tag_list ) {
					echo '<span class="tags-span"><i class="fa fa-lg fa-tags"></i> ' . $tag_list . ' </span>';
				}
			}

			// Comments link.
			if ( comments_open() ) :
				echo '<span class="tags-span"><i class="fa fa-lg fa-comments"></i>';
				comments_popup_link( __( 'No Comments', 'toranj' ), __( 'One comment', 'toranj' ), __( '%s comments', 'toranj' ) );
				echo '</span>';
			endif;

		}//end if post type
	}//end function declaration
}//end function exists



/**
 * ----------------------------------------------------------------------------------------
 * shorten the excerpt for blog minimal or any other purpose
 * ----------------------------------------------------------------------------------------
 */
if ( ! function_exists( 'owl_shorten_excerpt' ) ) {
	function owl_shorten_excerpt($text,$chars=200) {
		
		//check if we need to do do the truncate or not
		if (strlen(utf8_decode($text)) > $chars){
			$text = $text." ";
		    $text = substr($text,0,$chars);
		    $text = substr($text,0,strrpos($text,' '));
		    $text = $text."...";
		}

		echo $text;
		
	}
}



/**
 * ----------------------------------------------------------------------------------------
 * get and maka available the options for blog
 * ----------------------------------------------------------------------------------------
 */

if ( ! function_exists( 'owlab_get_blog_options' ) ) {
	function owlab_get_blog_options() {
		
		$options = array(
			'blog_index_layout' => ot_get_option('blog_index_layout','grid')
		);
		
		return $options;
	}
}



/**
 * ----------------------------------------------------------------------------------------
 * comments list layout
 * ----------------------------------------------------------------------------------------
 */
if ( ! function_exists( 'owlab_shape_comment' ) ) {
	function owlab_shape_comment( $comment, $args, $depth ) {
	    $GLOBALS['comment'] = $comment;
	    switch ( $comment->comment_type ) :
	        case 'pingback' :
	        case 'trackback' :
	    ?>
	    <li class="post pingback">
	        <p><?php _e( 'Pingback:', 'toranj' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'toranj' ), ' ' ); ?></p>
	    </li>
	    <?php
	            break;
	        default :
	    ?>
	    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
	        
	    	<div class="author-image">
				<?php echo get_avatar( $comment, 80 ); ?>
			</div>

			<div class="comment-body" id="comment-<?php comment_ID(); ?>">
				<div class="comment-meta">
					<ul>
					    <li class="author-name">
					    	<?php comment_author_link(); ?><span>-</span>
					    </li>
					    <li><?php printf( __( '%1$s at %2$s', 'toranj' ), get_comment_date(), get_comment_time() ); ?><span>-</span></li>
					    <li><?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?></li>
					   
					</ul>
				</div>
				<div class="comment-content">
					<?php comment_text(); ?>
				</div>

				<div class="reply">
					
				</div>
			</div>

	        
	 	</li>
	    <?php
	            break;
	    endswitch;
	}
}


/**
 * ----------------------------------------------------------------------------------------
 * Sharing buttons for full cover layout
 * ----------------------------------------------------------------------------------------
 */

if ( ! function_exists( 'owlab_sharing_btns_style1' ) ) {
	function owlab_sharing_btns_style1() {
	    
	    if (ot_get_option('show_sharings') == 'on'): ?>
		<!-- Post Social sharing -->
		<div id="post-share" class="box-social">
			<h4 class="u-heading"><?php echo ot_get_option('sharing_title'); ?></h4>
			<ul>
			<?php foreach (ot_get_option('sharings') as $btn): ?>
			
                <?php if ( $btn == 'sharing_facebook' ): ?>

                	<li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink();?>&amp;t=<?php the_title(); ?>" target="_blank" target="_blank"><i class="fa fa-facebook"></i></a></li>

            	<?php elseif ( $btn == 'sharing_twitter' ): ?>

                	<li><a href="https://twitter.com/intent/tweet?original_referer=<?php echo site_url(); ?>&amp;text=<?php the_title(); ?>&amp;url=<?php the_permalink();?>" target="_blank"><i class="fa fa-twitter"></i></a></li>

                <?php elseif ( $btn == "sharing_google_plus" ): ?>

                	<li><a href="https://plus.google.com/share?url=<?php the_permalink();?>" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                	
                <?php endif; ?>
            <?php endforeach; ?>
            </ul>
		</div>
		<!-- /Post Social sharing -->
		<?php endif;
	}
}



/**
 * ----------------------------------------------------------------------------------------
 * Post meta at the single full cover layout
 * ----------------------------------------------------------------------------------------
 */

if ( ! function_exists( 'owlab_post_meta_single_full' ) ) {
	function owlab_post_meta_single_full() {
	    
	    echo '<div class="post-author-image">';
			echo get_avatar( get_the_author_meta( 'ID' ), 100 ); 
		echo '</div>';
		echo '<div class="post-meta-inner">';
			printf(
				'<div class="post-author-name"><i class="fa fa-pencil-square-o list-icon"></i><a href="%1$s">%2$s</a></div>',
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				get_the_author()
			); 
		    echo '<div class="post-date"><i class="fa fa-calendar-o list-icon"></i>'.get_the_date().'</div>';
		    
		    $category_list = get_the_category_list( ', ' );
		    if ( $category_list ) : 
		    echo '<div class="post-categories">
		    		<i class="fa fa-folder-o list-icon"></i>';
		    	echo $category_list;
		    echo '</div>';
			endif; 
		    
		    $tag_list = get_the_tag_list( '', ', ' );
		    if ( $tag_list ) : 
		    echo '<div class="post-tags">
		    		<i class="fa fa-tags list-icon"></i>'; 
		    		echo $tag_list;
		    echo '</div>';
			endif;
		echo '</div>';
	}
}


/**
 * ----------------------------------------------------------------------------------------
 * List of related posts for single blog posts
 * ----------------------------------------------------------------------------------------
 */

if ( ! function_exists( 'owlab_get_related_posts' ) ) {
	function owlab_get_related_posts($echo = true) {
	    // post types
        $type = ot_get_option('related_posts_gather_data_based_on')!= null ? ot_get_option('related_posts_gather_data_based_on') : 'category';
        $limit = ot_get_option('related_post_limit')!= null ? ot_get_option('related_post_limit') : 4;
        $q_args = '';

        // category
        if($type == '' || $type == 'category')
        { 
         
            $getPostCat = get_the_category();
            $postCat = '';
            if(!empty($getPostCat)) 
            {
                $postCats = '';
                foreach ($getPostCat as $cat) {
                    $postCats .= $cat->term_id . ',';
                }
                $postCat  = rtrim($postCats , ',');
            }

            if($postCats != ''){

                $q_args = array(
                    'posts_per_page' => $limit,
                    'post_type' => 'post' ,
                    'cat' => $postCats,
                    'post__not_in' => array(get_the_ID())
                );
            }
        }else{
            // related posts by tags
            $tags = get_the_tags();
            $post_tags = '';
            if(!empty($tags))
            {
                foreach ($tags as $tag) {
                    $post_tags .= $tag->name . ',';
                }
                $post_tags = rtrim($post_tags , ',');
            }

            if($post_tags != '')
            {
	            $q_args = array(
	                'posts_per_page' => $limit , 
	                'post_type' => 'post' ,
	                'tag' => $post_tags,
	                'post__not_in' => array(get_the_ID())
	            );
            }
        }

        //make teh query
		$related_query = new WP_Query($q_args);


		//waht should we do now?
		if ( $echo ){ // so you want theme as a piece of cake? allready buddy..
			
			echo "<ul class='list-related-posts list-border list-hover'>";
			if($related_query->have_posts() ) : while( $related_query->have_posts() ) : $related_query->the_post();
            
          		echo '<li><a href="' . get_permalink(). '">' . get_the_title() . '</a></li>';

            endwhile; endif; wp_reset_query();
            echo "</ul>";
		}else{ // take them and do whatevere you want
			/**
	         * DONT FORGET TO wp_reset_query() AFTER YOU USED THE DATA
	         */
			return $related_query;
		}

	}
}


/**
 * ----------------------------------------------------------------------------------------
 * get links of custom taxonomy
 * ----------------------------------------------------------------------------------------
 */
function custom_taxonomies_terms_links($taxonomy_slug=''){
	// get post by post id
	//$post = get_post( $post->ID );
	global $post;
	
	$terms = get_the_terms( $post->ID, $taxonomy_slug );

	$out = '';
	if ( !empty( $terms ) ) {
		
		foreach ( $terms as $term ) {
			$out .=
			'<span><a href="'
			. get_term_link( $term->slug, $taxonomy_slug ) .'">'
			. $term->name
			. "</a></span> ";
		}
	}

	return $out;
}


/**
 * ----------------------------------------------------------------------------------------
 * Display navigation to the next/previous post
  * ----------------------------------------------------------------------------------------
 */
if ( ! function_exists( 'owlab_portfolio_single_nav' ) ) {
	function owlab_portfolio_single_nav() { 
		
		$next = get_next_post();
		$prev = get_previous_post();
		
		$prev_class = "fa-angle-left";
		$next_class = "fa-angle-right";
		if ( is_rtl() ){
			$next_class = "fa-angle-left";
			$prev_class = "fa-angle-right";
		}

		if ($next OR $prev){
		?>
			<ul class="portfolio-nav">
				
				<?php if ( $prev ) : ?>
				<li>
					<a class="portfolio-prev" href="<?php echo get_permalink( $prev->ID ); ?>">
						<i class="fa <?php echo $prev_class; ?>"></i>
						<span><?php _e('Prev','toranj') ?></span>
					</a>
				</li>
				<?php endif; ?>

				<li class="portfolio-close-li">
					<a class="portfolio-close" href="#">
						<i class="fa fa-times"></i>
						<span><?php _e('Close','toranj') ?></span>
					</a>
				</li>

				<?php if ( $next ) : ?>
				<li>
					<a class="portfolio-next" href="<?php echo get_permalink( $next->ID ); ?>">
						<i class="fa <?php echo $next_class; ?>"></i>
						<span><?php _e('Next','toranj') ?></span>
					</a>
				</li>
				<?php endif; ?>

			</ul><?php
		}
	}
}

/**
 * ----------------------------------------------------------------------------------------
 * Display navigation to the next/previous post
  * ----------------------------------------------------------------------------------------
 */
if ( ! function_exists( 'owlab_portfolio_regular_nav' ) ) {
	function owlab_portfolio_regular_nav($class="") { 
		
		$next = get_next_post();
		$prev = get_previous_post();
		
		

		if ($next OR $prev){
		?>
			<hr>
			<div id="post-nav" class="portfolio-regular-nav <?php echo $class; ?>">
				<?php if ( $prev ) : ?>
				<a class="portfolio-prev prev-post btn btn-lg btn-simple pull-left" href="<?php echo get_permalink( $prev->ID ); ?>"><?php _e('Prev','toranj') ?></a>
				<?php endif; ?>
				
				<a class="portfolio-close close-post btn btn-lg btn-simple" href="#"><i class="fa fa-bars"></i></a>
				
				<?php if ( $next ) : ?>
				<a class="portfolio-next next-post btn btn-lg btn-simple pull-right" href="<?php echo get_permalink( $next->ID ); ?>"><?php _e('Next','toranj') ?></a>
				<?php endif; ?>
				<div class="clearfix"></div>
			</div>
		<?php
		}
	}
}

/**
 * ----------------------------------------------------------------------------------------
 * Display portfolio meta
  * ----------------------------------------------------------------------------------------
 */
if ( ! function_exists( 'owlab_portfolio_meta' ) ) {
	function owlab_portfolio_meta($owlabpfl_meta) { 
		

		//get fields from theme options
		if ( function_exists("ot_get_option")){
			if ( ot_get_option('incr_portfolio_fields') ){
				$pp_fileds = ot_get_option('incr_portfolio_fields');
			    
			    foreach ($pp_fileds as $f) {
			    	
			    	if ( !empty($f['title']) and !empty($f["id"]) and array_key_exists("owlabpfl_".$f["id"] , $owlabpfl_meta) ){
			    		echo '
			    		<li>
							<div class="list-label">'.__($f['title'],'toranj').'</div>
							<div class="list-des">'.$owlabpfl_meta["owlabpfl_".$f["id"]][0].'</div>
						</li>
			    		';
			    	} 
			    }

			    
			}
		}
		?>
			<?php if (ot_get_option('portfolio_show_date') == 'on' && !empty($owlabpfl_meta["owlabpfl_date"]) ): ?>
			<li>
				<div class="list-label"><?php _e('Date','toranj'); ?></div>
				<div class="list-des"><?php echo date_i18n( get_option( 'date_format' ),$owlabpfl_meta['owlabpfl_date'][0]); ?></div>
			</li>
			<?php endif; ?>

			<?php $groups = custom_taxonomies_terms_links('owlabpfl_group'); ?>
			<?php if (ot_get_option('portfolio_show_groups') == 'on'  && !empty($groups) ): ?>
			<li>
				<div class="list-label"><?php _e('Group','toranj'); ?></div>
				<div class="list-des"><?php echo $groups; ?></div>
			</li>
			<?php endif; ?>

			<?php $tags = custom_taxonomies_terms_links('label'); ?>
			<?php if (ot_get_option('portfolio_show_tags') == 'on' && !empty($tags) ): ?>
			<li>
				<div class="list-label"><?php _e('Label','toranj'); ?></div>
				<div class="list-des"><?php echo $tags; ?></div>
			</li>
			<?php endif; ?>
		<?php
		
	}
}


/**
 * ----------------------------------------------------------------------------------------
 * gallery overlay type 
 * ----------------------------------------------------------------------------------------
 */
if ( ! function_exists('owlab_get_gallery_overlay')){
	function owlab_get_gallery_overlay($type='simple-icon',$icon='',$title='', $subtitle='')
	{	

		//if there is no icon passed get it from gallery options
		if ($icon == ''){
			if ( function_exists("ot_get_option")){
				$icon = ot_get_option('gallery_overlay_icon_class', 'fa-link');
			}else{
				$icon = "fa-link";
			}
		}

		switch ($type) {
			case 'simple-icon':
				$markup = '<div class="tj-overlay">
							<i class="fa '.$icon.' overlay-icon"></i>
						</div>';
				$parent_class = 'tj-hover-4';
				break;

			case 'circle':
				
				$markup = '
				<!-- Item Overlay -->	
				<div class="tj-overlay">
					<div class="content">
						<div class="circle">
							<i class="fa '.$icon.'"></i>
						</div>
					</div>
				</div>
				<!-- /Item Overlay -->
				';
				$parent_class = 'tj-circle-hover';

				break;

			case 'plus-light':
				$markup = '<div class="tj-overlay"></div>';
				$parent_class = 'tj-hover-5 reverse';
				break;

			case 'plus-dark':
				$markup = '<div class="tj-overlay"></div>';
				$parent_class = 'tj-hover-5';
				break;

			case 'plus-color':
				$markup = '<div class="tj-overlay"></div>';
				$parent_class = 'tj-hover-5 colorbg';
				break;
			
			case 'tj-hover-1':
				$markup = '<div class="tj-overlay">
							<h3 class="title">'.$title.'</h3>
							<h4 class="subtitle">'.$subtitle.'</h4>
						</div>';
				$parent_class = 'tj-hover-1';
				break;

			case 'tj-hover-2':
				
				$markup = '<div class="tj-overlay">
								<i class="fa fa-angle-right overlay-icon"></i>
								<div class="overlay-texts">
									<h3 class="title">'.$title.'</h3>
									<h4 class="subtitle">'.$subtitle.'</h4>
								</div>
							</div>';
				$parent_class = 'tj-hover-2';

				break;

			default:
				$markup = '<div class="tj-overlay"></div>';
				$parent_class = 'tj-hover-5';
				break;
		}
		

		return array ('markup' => $markup, 'parent_class'=>$parent_class);
	}
}


/**
 * ----------------------------------------------------------------------------------------
 * portfolio overlay type 
 * ----------------------------------------------------------------------------------------
 */
if ( ! function_exists('owlab_get_portfolio_overlay')){
	function owlab_get_portfolio_overlay($type='tj-hover-1', $title="", $subtitle="")
	{	


		switch ($type) {
			case 'tj-hover-1':
				$markup = '<div class="tj-overlay">
							<h3 class="title">'.$title.'</h3>
							<h4 class="subtitle">'.$subtitle.'</h4>
						</div>';
				$parent_class = 'tj-hover-1';
				break;

			case 'tj-hover-2':
				
				$markup = '<div class="tj-overlay">
								<i class="fa fa-angle-right overlay-icon"></i>
								<div class="overlay-texts">
									<h3 class="title">'.$title.'</h3>
									<h4 class="subtitle">'.$subtitle.'</h4>
								</div>
							</div>';
				$parent_class = 'tj-hover-2';

				break;
			
			default:
				$markup = '';
				$parent_class = '';
				break;
		}
		

		return array ('markup' => $markup, 'parent_class'=>$parent_class);
	}
}


/**
 * ----------------------------------------------------------------------------------------
 * decide between lazyload and not
 * ----------------------------------------------------------------------------------------
 */
if ( ! function_exists( 'owlab_lazy_image' ) ) {
	function owlab_lazy_image($img='', $title='', $echo=true, $class="img-responsive" , $force_nolazy=false) {
		
		$blank = get_template_directory_uri().'/assets/img/blank.jpg';
		
		$img_src = $blank;
		$img_width = 1000;
		$img_height = 750;

		if( !empty($img) ){
			
			if ( is_array($img) ){
				$img_src = $img[0];
				$img_width = $img[1];
				$img_height = $img[2];
			}
			else
			{
				$img_src = $img;
				
				if (ot_get_option('enable_lazyloud') == "on" && (ini_get('allow_url_fopen')==1)){
					//d($img,1);
					$image_size = getimagesize($img);
					if ( $image_size ){
						$img_width = $image_size[0];
						$img_height = $image_size[1];
					}
				}				
					

			}
		}
			

		$data = '';
		if ( isset( $img_width) )
			$data .= 'data-width='.$img_width;
		if ( isset( $img_height ) )
			$data .= ' data-height='.$img_height;

		if (ot_get_option('enable_lazyloud') == "on" && !$force_nolazy)
		{ 
			$out =  '<img data-original="'.$img_src.'" src="'.generate_blank_image($img_width,$img_height).'" width="'.$img_width.'" height="'.$img_height.'" alt="'.$title.'" class="'.$class.' lazy" '.$data.'>';
		}
		else
		{
			$out = '<img src="'.$img_src.'" alt="'.$title.'" class="'.$class.'" '.$data.'>';
		}


		if ( $echo ){
			echo $out;
		}else{
			return $out;
		} 
	}
}

/**
 * ----------------------------------------------------------------------------------------
 * echo video background markup
 * ----------------------------------------------------------------------------------------
 */
if ( ! function_exists( 'owlab_video_background' ) ) {
	function owlab_video_background($owlabpfl_meta, $img, $echo=true) {
		
		if ( is_array($img) ){
			$img = $img[0];
		}
		$data = 'data-poster="'.$img.'"';
		$data .=' data-src="'.$owlabpfl_meta['owlabpfl_video_mp4'][0].'"';
		if ( array_key_exists("owlabpfl_video_webm", $owlabpfl_meta) ){
			$data.= ' data-src-webm="'.$owlabpfl_meta['owlabpfl_video_webm'][0].'"';
		}
		if ( array_key_exists("owlabpfl_video_ogg", $owlabpfl_meta) ){
			$data.= ' data-src-ogg="'.$owlabpfl_meta['owlabpfl_video_ogg'][0].'"';
		}
		$out = '<div class="owl-videobg hoverPlay"'.$data.'></div>';
		
		if ( $echo ){
			echo $out;
		}else{
			return $out;
		}
		
	}
}


/**
 * ----------------------------------------------------------------------------------------
 * horizontal scroll markup
 * ----------------------------------------------------------------------------------------
 */
if ( ! function_exists('owlab_horizontalscroll_gallery')){
	function owlab_horizontalscroll_gallery($data,$type="loop"){

		//extract the data
		extract(shortcode_atts(array(
            'loop'          => '',
            'hide_sidebar'  => '',
            'title2'        => '',
            'title'         => '',
            'content'       => '',
            'width_mode'    => 'fixed_width',
            'default_width' => 350,
            'overlay_type'  => '',
            'fill_mode'     => 'fill_cover',
            'sub_albums_title' => '',
            'the_album_childs' => array()
        ), $data));

		// do we want to have a sidebar 
		$nosideClass='';
        if($hide_sidebar=="yes"){
            $nosideClass = " no-side";
        }

        $output='';
		if ( $hide_sidebar != "yes" ){
            $output .= '<!-- Page sidebar -->
            <div class="page-side">
                <div class="inner-wrapper vcenter-wrapper">
                    <div class="side-content vcenter">

                        <!-- Page title -->
                        <h1 class="title">
                            <span class="second-part">'.esc_html( $title2 ).'</span>
                            <span>'.esc_html( $title ).'</span>
                        </h1>
                        <!-- /Page title -->
            ';
            if ( isset($content) ){
                $output .='
                        <div class="hidden-sm hidden-xs">
                            '.$content.'
                        </div>
                ';
            }

           if (count($the_album_childs) >0 ):
					
				$output .= '<div class="hidden-sm hidden-xs"><h5 class="lined">'.$sub_albums_title.'</h5>';
				$output .='<ul class="list list-unstyled">';
					foreach ($the_album_childs as $child):
						$output .='<li><a href="'.get_term_link( $child->term_id, $child->taxonomy ).'">'.$child->name.'</a></li>';
					endforeach;
				$output .='</ul></div>';	
					
			endif;

            $output .= '
                    </div>
                </div>
            </div>
            <!-- /Page sidebar -->
            ';
        }

        

        $output .='
        <!-- Page main content -->
        <div class="page-main horizontal-folio-wrapper set-height-mobile tj-lightbox-gallery'. $nosideClass .'" data-mode="'.$width_mode.'" data-default-width="'.$default_width.'">

            <!-- Portfolio wrapper -->  
            <div class="horizontal-folio">';
        
        if ( $type == 'loop'){

	        if ( $loop->have_posts() ) {
	        	while( $loop->have_posts() ) 
	    		{ 
	    			$loop->the_post(); 
	        
		            $owlabgal_meta = get_post_meta( $loop->post->ID ); 
		            $item_overlay = owlab_get_gallery_overlay($overlay_type);
		            

		            $img_full=wp_get_attachment_image_src( get_post_thumbnail_id($loop->post->ID), 'full' );

		            $img_url=$img_full[0];

		            //Ratio of original image 
		            $img_ratio=($img_full[2]>0)?round($img_full[1]/$img_full[2],2):0;

		            //Generate the image markup based on lazy load option
		            $img_markup=owlab_lazy_image($img_url, get_the_title(), false);


		            $output .='
		                    <!-- Portfolio Item -->     
		                    <div class="gp-item '.$item_overlay['parent_class'].'" data-ratio="'.$img_ratio.'">
		                        <a href="'.$img_url.'" class="lightbox-gallery-item set-bg '.$fill_mode.'" title="'. get_the_title().'">

		                           	'.$img_markup.'

		                            '.$item_overlay['markup'].'  
		                        </a>
		                    </div>
		                    <!-- /Portfolio Item -->
		            ';
	    		} 
		    } else{
		    	$output.= __('No items found.','toranj');
		    }

		} elseif ( $type == 'array' ) {


			if ( !empty($loop) ) {

				foreach( $loop as $group ) { 

					$group = (Array) $group;
					$term_link = get_term_link( $group['slug'],'owlabgal_album' );

		            $output .='
		                    <!-- Portfolio Item -->     
		                    <div class="gp-item tj-circle-hover">
		                        <a href="'.$term_link.'" class="set-bg">';
		                    $output.=owlab_lazy_image(isset($group['owlabgal_album_image'])?$group['owlabgal_album_image']:false,$group['name'],false);
		                    $output .='<div class="tj-overlay">
		                                <div class="content">
		                                    <div class="circle">
		                                        <i class="fa fa-link"></i>
		                                    </div>
		                                    <div class="details">
		                                        <h4 class="title">'.$group['name'].'</h4>
		                                    </div>  
		                                </div>
		                            </div>  
		                        </a>
		                    </div>
		                    <!-- /Portfolio Item -->
		            ';
	        	}

	        }else{ 
	            $output.= __('No items found.','toranj');
	        }

		} elseif ( $type =='bulk_gal') {
			if ( $loop->have_posts() ) {
	        	while( $loop->have_posts() ) 
	    		{ 
	    			$loop->the_post(); 
	        
		            $owlabgal_meta = get_post_meta( $loop->post->ID ); 
		            $item_overlay = owlab_get_gallery_overlay($overlay_type);
		            $thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id($loop->post->ID), 'blog-thumb' );
		            // [0] => url
		            // [1] => width
		            // [2] => height
		            // [3] => boolean: true if $url is a resized image, false if it is the original.

		            $img_full=wp_get_attachment_image_src( get_post_thumbnail_id($loop->post->ID), 'full' );

		            $img_url=$img_full[0];

		            //Ratio of original image 
		            $img_ratio=($img_full[2]>0)?round($img_full[1]/$img_full[2],2):0;

		            //Generate the image markup based on lazy load option
		            $img_markup=owlab_lazy_image($img_url, get_the_title() ,false, 'img-responsive');

		            $output .='
		                    <!-- Portfolio Item -->     
		                    <div class="gp-item tj-circle-hover">
		                        <a href="'.get_the_permalink().'" class="set-bg">
		                            '.$img_markup.'

		                            <div class="tj-overlay">
		                                <div class="content">
		                                    <div class="circle">
		                                        <i class="fa fa-link"></i>
		                                    </div>
		                                    <div class="details">
		                                        <h4 class="title">'.get_the_title().'</h4>
		                                    </div>  
		                                </div>
		                            </div>  
		                        </a>
		                    </div>
		                    <!-- /Portfolio Item -->
		            ';
	    		} 
		    } else{
		    	$output.= __('No items found.','toranj');
		    }
		}
            
                           
                    
        $output .='</div><!-- /Portfolio wrapper --> 
        	</div><!-- Page main content -->';

        return $output;
        
	}
}




/**
 * ----------------------------------------------------------------------------------------
 * grid gallery layout
 * ----------------------------------------------------------------------------------------
 */
if ( ! function_exists('owlab_grid_gallery')){
	function owlab_grid_gallery($data,$type="loop"){

		//extract the data
		extract(shortcode_atts(array(
            'loop'          => '',
            'type'			=> '',
            'origin'		=> '',
            'hide_sidebar'  => 'no', // yes / no
            'title2'        => '',
            'title'         => '',
            'side_content'  => '',
            'show_filter'   => 'off', // on / off
            'filter_data'	=> array(),
            'filter_title'	=> 'filter',
            'taxonomy'      => '',
            'taxonomy_data'	=> '',
            'same_ratio'	=> '', // on / off
            'remove_space'  => 'on', // om / off
            'lg_cols'       => 4,
		    'md_cols'       => 3,
		    'sm_cols'       => 2,
		    'xs_cols'       => 1,
 			'overlay_type'  => '',
 			'thumbnail_size'=> 'blog-thumb'
        ), $data));


		$output = '';

		$nosideClass=' no-side';

        if($hide_sidebar!="yes"){

            $nosideClass = "";

            $output.='
            <!-- Page sidebar from function-->
			<div class="page-side">
				<div class="inner-wrapper vcenter-wrapper">
					<div class="side-content vcenter">

						<!-- Page title -->
						<div class="title">
							<span class="second-part">'.$title2.'</span>
							<span>'.$title.'</span>
						</div>
						<!-- /Page title -->
						<p>'.wpautop($side_content).'</p>
						';

				if (count($filter_data) >0 && $show_filter=='on'):
					$output .='
						<div class="grid-filters-wrapper">
							<a href="#" class="select-filter"><i class="fa fa-filter"></i> '.$filter_title.'</a>
							<ul class="grid-filters">
							  	<li class="active"><a href="#" data-filter="*">'.__('All','toranj').'</a></li>
							  	';
						foreach ($filter_data as $filter):
							$output .= '<li><a href="#" data-filter=".'.$filter->slug.'">'.$filter->name.' - '.$filter->count.'</a></li>';
						endforeach;

						$output.='
							</ul>
						</div>';
				endif;

				$output .= '

					</div>
				</div>
			</div>
			<!-- /Page sidebar -->
            ';
        }

        $same_ration_class = $same_ratio =="on" ? ' same-ratio-items' : '';
        $no_padding_class = $remove_space=='on' ? ' no-padding' : '';
        

        $output .='
        <!-- Page main content -->
		<div class="page-main '.$nosideClass.'">

			<!-- Gallery wrapper -->	
			<div class="grid-portfolio tj-lightbox-gallery'.$same_ration_class.$no_padding_class.'" lg-cols="'.$lg_cols.'" md-cols="'.$md_cols.'" sm-cols="'.$sm_cols.'" xs-cols="'.$xs_cols.'">';
				

			$output .= owlab_get_grid_loop_layout($origin,$type,$loop,$taxonomy,$overlay_type,$thumbnail_size);	
			

			if( $show_filter == 'on' && $hide_sidebar=="yes" ):
			$output .= '
			<!-- Grid filter -->
			<div class="fixed-filter">
				<a href="#" class="select-filter"><i class="fa fa-filter"></i> '.$filter_title.'</a>
				<ul class="grid-filters">
				  	<li class="active"><a href="#" data-filter="*">'.__('All','toranj').'</a></li>';
				  	
				  	foreach ($filter_data as $filter):
				  		$output .= '<li><a href="#" data-filter=".'.$filter->slug.'">'.$filter->name.' - '.$filter->count.'</a></li>';
					endforeach;

				$output .= '
				</ul>
			</div>
			<!-- /Grid filter -->
			';
			endif;


			$output .='
			</div>
			<!-- /Gallery wrapper -->	
			
		</div>
		<!-- /Page main content -->
	    ';

        return $output;

	}
}

//helper function for grid gallery
function owlab_get_grid_loop_layout($origin,$type,$loop,$taxonomy,$overlay_type,$thumbnail_size){

	$output = '';

	$sizer_defined = 0;
	if ( $loop->have_posts() ) : while( $loop->have_posts() ) : $loop->the_post();


		if( get_post_status()=='private' ) continue;
		
		$owlabgal_meta = get_post_meta( $loop->post->ID );
		
		//thumnail 
		$thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id($loop->post->ID), $thumbnail_size );

		//default valus
		$taxonomy_terms = $sizer_class = $data_width_ratio = '';

		//more data based on origin
		if ($origin =='bulk_gallery_tax') //comes from taxonomy page of bulk gallery
		{	
				//taxonomy terms
				$taxonomy_terms = owlab_get_taxonomy_terms($loop,$taxonomy);
				
				$gallery_data = unserialize($owlabgal_meta['_owlabbulkg_slider_data'][0]);
				
				//short des
				$short_des = $gallery_data['config']['short_des'];

				//sizer - no need
				//ratio - no need
		
		} elseif ( $origin == 'bulk_gallery_archive') { //comes from archive page of bulk gallery

				//taxonomy terms 
				$taxonomy_terms = owlab_get_taxonomy_terms($loop,$taxonomy);

				$owlabbulk_meta = unserialize($owlabgal_meta['_owlabbulkg_slider_data'][0]);
				//short des
				$short_des = isset($owlabbulk_meta['config']['short_des']) ? $owlabbulk_meta['config']['short_des'] : '';

				//sizer
				if ( isset($owlabbulk_meta['config']['grid_sizer']) ){
					$sizer_defined = 1;
					$sizer_class = ' grid-sizer';
				}

				//ratio
				if ( isset($owlabbulk_meta['config']['ratio']) ){
					$data_width_ratio = 'data-width-ratio= "'.intval($owlabbulk_meta['config']['ratio']).'"';
				} 

		} elseif ( $origin == 'gallery_tax' ) { //comes from taxonomy page of gallery

				//taxonomy terms
				$taxonomy_terms = owlab_get_taxonomy_terms($loop,$taxonomy);

				//short des - no need

				//sizer
				if ( array_key_exists('owlabgal_grid_sizer', $owlabgal_meta) && $sizer_defined !=1 ){
					$sizer_defined = 1;
					$sizer_class = ' grid-sizer';
				}

				//ratio
				if (!empty($owlabgal_meta['owlabgal_grid_ratio'][0])){
					$data_width_ratio = 'data-width-ratio= '.intval($owlabgal_meta['owlabgal_grid_ratio'][0]).'"';
				}

		} elseif( $origin == 'gallery_archive' ){

				//taxonomy terms 
				$taxonomy_terms = owlab_get_taxonomy_terms($loop,$taxonomy);

				//short des - no need

				//sizer
				if ( array_key_exists('owlabgal_grid_sizer', $owlabgal_meta) && $sizer_defined !=1 ){
					$sizer_defined = 1;
					$sizer_class = ' grid-sizer';
				}

				//ratio
				if ( !empty($owlabgal_meta['owlabgal_grid_ratio'][0]) ){
					$data_width_ratio = 'data-width-ratio= '.intval($owlabgal_meta['owlabgal_grid_ratio'][0]).'"';
				}

		}
		




		// based on the type we need to change the layout function and the link href and class	
		if ($type == 'linkable'){
			
				$item_overlay = owlab_get_gallery_overlay($overlay_type,'',get_the_title(),$short_des);
				$link_open_tag = '<a href="'.get_the_permalink().'">';

		} elseif ($type == 'lightbox'){
			
				//we need img_url only for lightbox
				$img_url = wp_get_attachment_url( get_post_thumbnail_id($loop->post->ID) );

				$item_overlay = owlab_get_gallery_overlay($overlay_type);
				$link_open_tag = '<a href="'.$img_url.'"  class="lightbox-gallery-item" title="'.get_the_title().'">';
		}

		$output .='
		<!-- Gallery Item -->		
		<div class="gp-item '.$item_overlay['parent_class'].' '.$taxonomy_terms.$sizer_class.'" '.$data_width_ratio.'> 
			'.$link_open_tag.'
				'.owlab_lazy_image( $thumb_url, get_the_title(),false ).'
				<!-- Item Overlay -->	
				'.$item_overlay['markup'].'
				<!-- /Item Overlay -->	
			</a>
		</div>
		<!-- /Gallery Item -->';

	endwhile; else:
		$output .= __('No items found.','toranj');
	endif;

	return $output;
}


//helper for grid
function owlab_get_taxonomy_terms($loop,$taxonomy){

	$the_terms = wp_get_post_terms( $loop->post->ID, $taxonomy, array('fileds' => 'all') ); 
		 	
 	$this_terms =array();
 	if (is_array($the_terms)){
	 	foreach($the_terms as $term){
	 		$this_terms[]= $term->slug;
	 	}
 	}
 	$album_terms = implode(' ', $this_terms);

 	return $album_terms;
}
		



/**
 * ----------------------------------------------------------------------------------------
 * extera class prepare for vc
 * ----------------------------------------------------------------------------------------
 */
function owlab_getExtraClass( $el_class ) {
	$output = '';
	if ( $el_class != '' ) {
		$output = " " . str_replace( ".", "", $el_class );
	}
	return $output;
}


/**
 * ----------------------------------------------------------------------------------------
 * 500px font-face 
 * @since 1.3.2
 * ----------------------------------------------------------------------------------------
 */
if ( !function_exists("owlab_include_500px_css")){
	function owlab_include_500px_css(){
		// register the 500px css file , make sure you have included the font-faces 
		wp_register_style( '500px-font-faces' , OWLAB_CSS . '/vendors/fontello-500px.css',array(),THEME_VERSION);
		wp_enqueue_style( '500px-font-faces');
	}
	add_action("wp_enqueue_scripts", "owlab_include_500px_css");
}




/**
 * ----------------------------------------------------------------------------------------
 * Generate blank image
 * ----------------------------------------------------------------------------------------
 */
function generate_blank_image($w,$h) {
		
	global $blank_images;

	$size = "{$w}x{$h}";
	if ( isset($blank_images[$size]) ) {
		return $blank_images[$size];
	}

	// create blank img
	$image = imagecreate($w, $h);
	imagesavealpha($image, true);
	imagecolortransparent($image, imagecolorallocatealpha($image, 0, 0, 0, 0));
	ob_start();
	imagegif($image);
	$blank_images[$size] = "data:image/gif;base64,".base64_encode(ob_get_clean());
	imagedestroy($image);
	

	return $blank_images[$size];
}


/**
 * ----------------------------------------------------------------------------------------
 * social icons 
 * @since 1.4.2
 * ----------------------------------------------------------------------------------------
 */
if ( !function_exists('toranj_social_icons')){
	function toranj_social_icons(){
		$socials = ot_get_option('social_icons');
		if (isset($socials[0])){
			foreach (ot_get_option('social_icons') as $social) {
				if ($social['si_icon']=='500px'){
					owlab_include_500px_css();
					echo '<li><a href="'.$social['si_url'].'" target="_blank"><i class="icon-'.$social['si_icon'].'"></i></a></li>';
				}else{
					echo '<li><a href="'.$social['si_url'].'" target="_blank"><i class="fa fa-'.$social['si_icon'].'"></i></a></li>';
				}
			}
		}
	}
}


/**
 * ----------------------------------------------------------------------------------------
 * infinit scroll for bulk gallery
 * @since 1.6
 * ----------------------------------------------------------------------------------------
 */
if ( !function_exists('tj_infinitepaginate_bulkgallery')){
	function tj_infinitepaginate_bulkgallery(){ 
   
   
	   $paged = 0;
	   if (!empty($_POST['page_no'])){
	   	$paged = absint( $_POST['page_no'] );
	   }
	   
	   $post_id = '';
	   if (!empty($_POST['post_id'])){
	   	$post_id = absint( $_POST['post_id'] );
	   }

	   if ( empty ($post_id) )
	   	return false;

	   $initial_count = ot_get_option('bulk_gallery_grid___initial_count',20);
	   $posts_per_page  = ot_get_option('bulk_gallery_grid___per_page_count',10);

	   $start_from = $initial_count + $posts_per_page * ($paged-1);



   		# Load the Images

		$owlabgal_meta = get_post_meta( $post_id );
		$owlabbulk_meta = unserialize($owlabgal_meta['_owlabbulkg_slider_data'][0]);
		$config = $owlabbulk_meta['config'];
		$item_overlay = owlab_get_gallery_overlay($config['hover'],$config['icon']);
		$imgs = $owlabbulk_meta['slider'];
   
	    if ( !is_array($imgs)){
			$imgs = array();
		}
   
		$this_images = array_slice($imgs, $start_from, $posts_per_page, true);
   

   		foreach ($this_images as $img_id=>$img_data): 

   
    		$thumb_url = wp_get_attachment_image_src( $img_id, 'blog-thumb' );
            $img_url = $img_data['src'];
            
            $ratio ='';
            if ( isset($img_data['ratio']) ){
	            if ( intval($img_data['ratio'])>0 ){
		   			$ratio.= ' data-width-ratio="'. intval($img_data['ratio']).'"';
				}
            }


			$sizer='';
			if ( isset($img_data['grid_sizer']) ){
				if ( $img_data['grid_sizer']=='on' && $sizer_defined !=1 ){
				   $sizer_defined == 1;
				   $sizer=" grid-sizer";
				}
			}
    		?>
   			<!-- Gallery Item -->       
            <div class="gp-item <?php echo $item_overlay['parent_class'] ?> <?php echo $sizer ?>" <?php echo $ratio ?>> 
                <a href="<?php echo $img_url; ?>"  class="lightbox-gallery-item" title="<?php echo $img_data['title'] ?>">
                    
                    <?php echo owlab_lazy_image($thumb_url, get_the_title(), false,'', true); ?>
                    
                    <!-- Item Overlay -->   
                    <?php echo $item_overlay['markup']  ?>
                    <!-- /Item Overlay -->  
                </a>
            </div>
            <!-- /Gallery Item -->

   		<?php endforeach; 
   
 
		exit;
	}
}

add_action('wp_ajax_infinite_scroll', 'tj_infinitepaginate_bulkgallery');           // for logged in user
add_action('wp_ajax_nopriv_infinite_scroll', 'tj_infinitepaginate_bulkgallery');    // if user not logged in

/**
 * ----------------------------------------------------------------------------------------
 * Debug
 * ----------------------------------------------------------------------------------------
 */
if ( ! function_exists( 'd' ) ) {
	function d($p,$die=false) {
		
		echo "<pre style='margin:150px;'>";var_dump($p);echo "</pre>";
		if ($die)
			die();
	}
}
