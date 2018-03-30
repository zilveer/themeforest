<?php
/**
 *  Single template page for gallery
 * 
 * @package Toranj
 * @author owwwlab
 */

$owlabgal_meta = get_post_meta( get_the_ID() ); 

get_header(); 

//this is just on post so the loop can be here
if ( have_posts() ) : while( have_posts() ) : the_post();
?>

<!--Page main wrapper-->
<div id="main-content"> 
	<div class="page-wrapper regular-page">
		<div class="container">

			<!-- page title -->
			<h2 class="section-title double-title">
				<?php the_title(); ?>
			</h2>
			<!--/ page title -->

			
			<div class="row mb-xlarge">
				<div class="col-md-12">
					<?php $img_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) , 'large' ); ?>
					<img src="<?php echo $img_url; ?>" alt="<?php the_title(); ?>" class="img-responsive">
				</div>
			</div>
			

			<?php if (array_key_exists('owlabgal_des', $owlabgal_meta)): ?>
			<div class="row mb-xlarge">
				<div class="col-md-12">
					<?php echo $owlabgal_meta['owlabgal_des'][0]; ?>
				</div>
			</div>
			<?php endif; ?>		

			<hr />
			<div class="row mb-xlarge">
				<div class="col-md-12">
					<!-- Post Navigation -->
					
					<?php owlab_blog_single_paging_nav(); ?>
					
					<!-- Post Comments -->
					<?php comments_template(); ?>
					<!-- /Post Comments -->
				</div>
			</div>


			<hr/>
			<a class="back-to-top" href="#"></a>
		</div>
	</div>
</div>
<!--/Page main wrapper-->




<?php 
endwhile; endif; 

get_footer(); ?>
