<?php get_header(); ?>

<section id="title" class="company-title">
	<div class="container" itemscope itemtype="http://data-vocabulary.org/Organization">

		<?php if ( get_the_company_name() ) { ?>
			<div class="image">
				<?php the_company_logo(); ?>
			</div>
			<div class="company-details">
				<?php the_company_name( '<h1 itemprop="name">', '</h1>' ); ?> <?php the_company_tagline( '<div class="company-tagline">', '</div>' ); ?>
				<?php if ( $website = get_the_company_website() ) : ?>
					<a class="company-website" href="<?php echo esc_url( $website ); ?>" itemprop="url" target="_blank" rel="nofollow"><?php esc_html_e( 'Website', 'jobseek' ); ?></a>
				<?php endif; ?>
				<?php if ( get_the_company_twitter() ) : ?>
					<a class="company-twitter" href="http://twitter.com/<?php echo get_the_company_twitter(); ?>">@<?php echo get_the_company_twitter(); ?></a>
				<?php endif; ?>
			</div>
		<?php } ?>

	</div>
</section>

<section id="content">
	<div class="container">
		<?php echo do_shortcode('[jobs categories=' . get_query_var('job_listing_category') . ' show_filters="false"]'); ?>
	</div>
</section>

<?php get_footer(); ?>