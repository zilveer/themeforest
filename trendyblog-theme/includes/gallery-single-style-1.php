<?php 
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	get_header();
	wp_reset_query();

	global $query_string;
	$query_vars = explode('&',$query_string);
									
	foreach($query_vars as $key) {
		if(strpos($key,'page=') !== false) {
			$i = substr($key,8,12);
			break;
		}
	}
	
	if(!isset($i)) {
		$i = 1;
	}

	$galleryImages = get_post_meta ( $post->ID, THEME_NAME."_gallery_images", true ); 
	$imageIDs = explode(",",$galleryImages);
	$count = DF_image_count($post->ID);

	//main image
	$file = wp_get_attachment_url($imageIDs[$i-1]);
	$image = get_post_thumb(false, 916, 0, false, $file);	

	$term_list = wp_get_post_terms($post->ID, DF_POST_GALLERY.'-cat');

	$catCount=0;
	foreach($term_list as $term){
		$catCount++;
	}
	
	$randID = rand(0,$catCount-1);	

	$galID = df_get_page("gallery-1");
	$title = get_the_title($galID[0]);
	$subTitle = get_post_meta( $galID[0], "_".THEME_NAME."_subtitle", true );
?>
<?php get_template_part(THEME_LOOP."loop-start"); ?>
	<h1 class="page_title"><?php echo esc_html__($title); ?></h1>
	<div id="gallery_single">
	    <!-- Slider -->
	    <ul>
    		<?php 
        		$c=1;
        		foreach($imageIDs as $id) { 
        			if($id) {
            			$file = wp_get_attachment_url($id);
            			$image = get_post_thumb(false, 1900, 0, false, $file);
        	?>
		        <li>
		            <img src="<?php echo esc_url($image['src']);?>" alt="<?php echo esc_attr__(get_the_title());?>">
		        </li>

                <?php $c++; ?>
           	 	<?php } ?>
            <?php } ?>
	    </ul>
	    <!-- Thumbnail pager -->
	    <div id="gallery_pager">
    		<?php 
        		$c=0;
        		foreach($imageIDs as $id) { 
        			if($id) {
            			$file = wp_get_attachment_url($id);
            			$image = get_post_thumb(false, 60, 60, false, $file);
        	?>
				<a href="javascript:;" class="<?php if($c+1==$i) { ?>active<?php } ?>" rel="<?php echo intval($c);?>"  data-slide-index="<?php echo intval($c);?>">
					<img src="<?php echo esc_url($image['src']);?>" alt="<?php echo esc_attr__(get_the_title());?>"/>
				</a>
                <?php $c++; ?>
           	 	<?php } ?>
            <?php } ?>
	    </div>
		<div class="gallery-description">
			<h3><?php the_title();?></h3>
			<?php 
				if (get_the_content() != "") { 				
					add_filter('the_content','df_remove_images');
					add_filter('the_content','df_remove_objects');
					the_content();
				} 
			?>					
		</div>
	</div>

	<?php if(df_option_compare('similar_posts_gallery','similar_posts', $post->ID)==true) { ?>
	<div class="panel_title">
	    <div>
	        <h4><?php esc_html_e("Similar Photo Gallery",THEME_NAME);?></h4>
	    </div>
	</div>

	<!-- Gallery grid -->
	<div id="gallery_grid">
	    <div class="row">
			<?php 
						$categories = get_the_terms($post->ID, DF_POST_GALLERY.'-cat');
						$categoriesNew = array();
						$i=0;
						if(!empty($categories)) {
							foreach ($categories as $category) {
								$categoriesNew[$i]['term_id'] = $category->term_id;
								$categoriesNew[$i]['name'] = $category->name;
								$i++;
							}
							$categories = $categoriesNew;
							if($i==1) {
								$randID = 0;
							} else {
								$randID = rand(0,$i-1);
							}
						} else {
							$randID = 0;
						}


						$counter=1;
						$my_query = new WP_Query( 
							array( 
								'post__not_in' => array($post->ID),
								'post_type' => DF_POST_GALLERY, 
								'showposts' => 4, 
								'tax_query' => array(
									array(
										'taxonomy' => DF_POST_GALLERY.'-cat',
										'field' => 'id',
										'terms' => $categories[$randID]['term_id'],
									)
								),
								'orderby' => 'rand'
							)
						);
						
						if ( $my_query->have_posts() ) : while ( $my_query->have_posts() ) : $my_query->the_post(); 
							$term_list = wp_get_post_terms($my_query->post->ID, DF_POST_GALLERY.'-cat');
							$catCount=0;
							foreach($term_list as $term){
								$catCount++;
							}
							
							$randID = rand(0,$catCount-1);	

							$src = get_post_thumb($my_query->post->ID,353,234);
				?>
				<?php $gallery_style = get_post_meta ( $my_query->post->ID, "_".THEME_NAME."_gallery_style", true ); ?>
			        <!-- Album -->
			        <div class="col col_3_of_12">
			            <div class="gallery_album">
			                <div class="item_thumb">
			                    <div class="thumb_icon">
			                        <a href="<?php the_permalink();?>">
			                        	<i class="fa fa-search"></i>
			                        </a>
			                    </div>
			                    <div class="thumb_hover">
			                        <a href="<?php the_permalink();?>"><img src="<?php echo esc_url($src["src"]); ?>" alt="<?php esc_attr__(get_the_title());?>" /></a>
			                    </div>
			                    <div class="thumb_meta">
			                        <span class="category"><?php echo esc_html__(DF_image_count($my_query->post->ID));?> <?php if(DF_image_count($my_query->post->ID)=="1") { esc_html_e("Photo" , THEME_NAME); } else { esc_html_e("Photos" , THEME_NAME); } ?></span>
			                    </div>
			                </div>
			                <div class="item_content">
			                    <h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
				                <?php 
									add_filter('excerpt_length', 'df_new_excerpt_length_20');
									the_excerpt();
								?>
			                </div>
			            </div>
			        </div><!-- End album -->
	        

			<?php $counter++; ?>
			<?php endwhile; ?>
			<?php else : ?>
				<h2 class="title"><?php esc_html_e( 'No galleries were found' , THEME_NAME );?></h2>
			<?php endif; ?>
	        
		    </div>
		</div>


	<?php } ?> 
<?php get_template_part(THEME_LOOP."loop-end"); ?>
<?php get_footer(); ?>