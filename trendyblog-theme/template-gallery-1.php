<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/* Template Name: Photo Gallery */
?>
<?php get_header(); ?>
<?php
	wp_reset_query();
	$paged = df_get_query_string_paged();
	$posts_per_page = df_get_option(THEME_NAME.'_gallery_items');

	if($posts_per_page == "") {
		$posts_per_page = df_get_option('posts_per_page');
	}
	
	$catSlug = $wp_query->queried_object->slug;
	if(!$catSlug) {
		$my_query = new WP_Query(
			array(
				'post_type' => DF_POST_GALLERY, 
				'posts_per_page' => $posts_per_page, 
				'paged'=>$paged
			)
		);  
	} else {
		$my_query = new WP_Query(
			array(
				'post_type' => DF_POST_GALLERY, 
				'posts_per_page' => $posts_per_page, 
				'paged'=>$paged,
				'tax_query' => array(
					array(
						'taxonomy' => DF_POST_GALLERY.'-cat',
						'field' => 'slug',
						'terms' => $catSlug
					)
				)
			)
		); 

	}
	$categories = get_terms( DF_POST_GALLERY.'-cat', 'orderby=name&hide_empty=0' );
	
	//page title
	$titleShow = get_post_meta ( $post->ID, THEME_NAME."_title_show", true );
	$subTitle = get_post_meta ( DF_page_id(), THEME_NAME."_subtitle", true ); 
?>
<?php get_template_part(THEME_LOOP."loop-start"); ?>
	<?php get_template_part(THEME_SINGLE."page-title"); ?>
	<!-- Gallery filters -->
	<div id="gallery_filter">
	    <a href="<?php echo esc_url(get_page_link(df_get_page("gallery-1", false)));?>"<?php if(!$catSlug) { ?> class="active"<?php } ?>><?php esc_html_e("All", THEME_NAME);?></a>
		<?php foreach ($categories as $category) { ?>
			<?php if(isset($category->term_id)) { ?>
				<a href="<?php echo esc_url(get_term_link((int)$category->term_id,DF_POST_GALLERY.'-cat'));?>"<?php if($catSlug==$category->slug) { ?> class="active"<?php } ?>><?php echo esc_html__($category->name);?></a>
			<?php } ?>
		<?php } ?>
	</div>


	<!-- Gallery grid -->
	<div id="gallery_grid">
	    <div class="row">
			<?php 
															
				$args = array(
					'post_type'     	=> DF_POST_GALLERY,
					'post_status'  	 	=> 'publish',
					'showposts' 		=> -1
				);

				$myposts = get_posts( $args );	
				$count_total = count($myposts);

				$counter=0;	
			?>

			<?php if ( $my_query->have_posts() ) : while ( $my_query->have_posts() ) : $my_query->the_post(); ?>
				<?php 
					$src = get_post_thumb($post->ID,263,263); 
				?>
				<?php 
					$term_list = wp_get_post_terms($post->ID, DF_POST_GALLERY.'-cat');
					$catCount=0;
					foreach($term_list as $term){
						$catCount++;
					}
					
					$randID = rand(0,$catCount-1);
				?>
				<?php $gallery_style = get_post_meta ( $post->ID, "_".THEME_NAME."_gallery_style", true ); ?>
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
			                        <span class="category"><?php echo esc_html__(DF_image_count($post->ID));?> <?php if(DF_image_count($post->ID)=="1") { esc_html_e("Photo" , THEME_NAME); } else { esc_html_e("Photos" , THEME_NAME); } ?></span>
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

			<?php if($counter%4==0 && $counter!=$my_query->post_count) { ?>
			</div>
			<div class="row">
			<?php } ?>
			<?php endwhile; ?>
			<?php else : ?>
				<h2 class="title"><?php esc_html_e( 'No galleries were found' , THEME_NAME );?></h2>
			<?php endif; ?>
	        
		    </div>
		</div>
		<div class="df-panel-block">
			<?php customized_nav_btns($paged, $my_query->max_num_pages); ?>
		</div>
<?php get_template_part(THEME_LOOP."loop-end"); ?>
<?php get_footer(); ?>