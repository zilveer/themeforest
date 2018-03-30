<?php 

/*
Template Name: Gallery without text
*/

get_header(); 

//Extracting the values that user defined in OptionTree Plugin 
$galleryPostNumber = ot_get_option('gallery_post_number');

?>
	<!-- BEGIN MAIN CONTENT -->
	<div id="page-title-wrap">
		<div class="container">
			<div id="breadcrumb"><?php if (function_exists('heal_breadcrumbs') && ( get_post_meta($post->ID,"breadcrumb",true) == "Yes" ) ) heal_breadcrumbs(); ?></div>
			<div id="page-title"><?php the_title(); ?></div>
			<div id="page-subtitle"><?php echo get_post_meta($post->ID, "page_description",true); ?></div>
		</div>
	</div>
	<div class="container gallery-page">
		<div class="twelve columns left-content content-fullwidth">
			<div id="gallery-wrap" class="gallery-without-text">
				<?php 
					$post = get_page($post->ID); echo $post->post_content;
					query_posts(array( 'post_type' => 'gallery', 'paged' => get_query_var('paged'), 'posts_per_page' => $galleryPostNumber ));	
					$i=1;
					if (have_posts()) : while (have_posts()) : the_post(); 
				?>
				<div class="gallery-img-wrap <?php if ( ($i % 3) == 0 ) echo 'last-gallery-img';?>">
					<div class="gallery-image">
						<a href="<?php if ( has_post_thumbnail() ) { $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'gallery-full' ); echo $large_image_url[0]; } ?>">
							<?php 
								if ( has_post_thumbnail() ) {
									$image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'gallery' );
							?>
							
							<img src="<?php echo $image_url[0]; ?>" alt="<?php the_title(); ?>" />
							
							<?php
								}
							?>
							<div class="magnifier-icon icon-without-text"></div>
						</a>
					</div>
				</div>
				<?php
					$i++;
					endwhile; endif;
				?>
				<div class="clear"></div>
			</div>
			<div class="pagenavi gallery-pagenavi">
			<?php 
				heal_pagination('',2);
			?>
			</div>
		</div>
	</div>
	<!-- END MAIN CONTENT -->
<?php get_footer(); ?>
