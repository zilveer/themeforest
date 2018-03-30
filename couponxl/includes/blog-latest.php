<div class="white-block offer-box blog-box">
	<div class="white-block-media">

		<?php if( has_post_thumbnail() ): ?>
			<div class="embed-responsive embed-responsive-16by9">
				<?php the_post_thumbnail( 'offer-box', array( 'class' => 'embed-responsive-item' ) ) ?>
			</div>
		<?php endif; ?>

		<?php get_template_part( 'includes/share' ); ?>
		<a href="<?php the_permalink() ?>" class="btn">
			<i class=""></i>
			<?php _e( 'FULL ARTICLE', 'couponxl' ) ?>
		</a>
	</div>

	<div class="white-block-content">
		<ul class="list-unstyled list-inline top-meta clearfix">
			<li>
				<?php echo couponxl_categories_list() ?>
			</li>
		</ul>

		<a href="<?php the_permalink() ?>">
			<h3><?php the_title(); ?></h3>
		</a>
		<?php the_excerpt(); ?>

		<ul class="list-unstyled list-inline bottom-meta">
			<li>
				<i class="fa fa-calendar-o"></i> <?php the_time( get_option( 'date_format' ) ); ?>
			</li>
			<li>
				<i class="fa fa-comments"></i> <?php echo comments_number( '0', '1', '%' ); ?>
			</li>			
		</ul>
	</div>
</div>