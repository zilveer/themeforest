<?php
/**
 *  Descrioption
 * 
 * @package Toranj
 * @author owwwlab (Alireza Jahandideh & Ehsan Dalvand @owwwlab)
 */

?>




<div class="container">

	<!-- Post body -->
	<div id="post-body">
		<div class="row">

			<!-- Post sidebar -->
			<div id="post-side" class="col-md-3">

				<!-- Post meta -->
				<div class="post-meta">
					<?php owlab_post_meta_single_full(); ?>
				</div>
				<!-- /Post meta -->
				
				<?php owlab_sharing_btns_style1(); ?>

			</div>
			<!-- /Post sidebar -->

			<!-- Post main area -->
			<div class="col-md-9">
				<div class="post mb-xlarge">
					<?php if ( is_single() ) :?>
						<div class="blog-list">
						<?php endif; ?>
						<div class="post-format-quote">
							<div class="quote-wrapper set-bg rev-blur">
								<?php if ( has_post_thumbnail() ): ?>
									<?php the_post_thumbnail('full',array(
										'class' => 'rev-blur',
										'style' => 'display:none;'
									)); ?>
								<?php else: ?>
								<img src="<?php echo OWLAB_IMAGES.'/default-blog-quote.jpg'; ?>" alt="image" class="rev-blur" style="display: none;">
								<?php endif; ?>
							</div>
							<div class="quote">
								<?php if(get_post_meta(get_the_ID() , 'quote' , true) != '') : ?>
								<p><?php echo get_post_meta(get_the_ID() , 'quote' , true); ?></p>
								<div class="author">~ <?php echo get_post_meta(get_the_ID() , 'quote-author' , true); ?></div>
								<?php endif; ?>	
							</div>
						</div>
						<?php if ( is_single() ) :?>
						</div>
					<?php endif; ?>
					
					<?php include(locate_template(OWLAB_TEMPLATES . '/blog/single-full-content.php')); ?>