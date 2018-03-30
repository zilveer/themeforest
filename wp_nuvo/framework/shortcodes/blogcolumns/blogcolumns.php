<?php
add_shortcode('cs-post-columns', 'cs_post_columns');
function cs_post_columns($params, $content = null) {
	extract(shortcode_atts(array(
        'title' => '',
        'description' =>'',
        'category'=>'',
        'colunm' => '2',
        'posts_per_page'=>'6',
        'orderby' => 'date',
       	'order' => 'DESC'
    ), $params));

	$layout = 'col-xs-12 col-sm-6 col-md-6 col-lg-6';
	switch ($colunm){
		case 1:
			$layout = 'col-xs-12 col-sm-6 col-md-12 col-lg-12';
			break;
		case 2:
			$layout = 'col-xs-12 col-sm-6 col-md-6 col-lg-6';
			break;
		case 3:
			$layout = 'col-xs-12 col-sm-6 col-md-4 col-lg-4';
			break;
		case 4:
			$layout = 'col-xs-12 col-sm-6 col-md-3 col-lg-3';
			break;
	}

	ob_start();
	?>
        	<?php $wp_query = new WP_Query(array(
        		'category__in'=> $category,
        		'posts_per_page' => $posts_per_page,
        		'post_type' => 'post',
        		'post_status' => 'publish',
        		'orderby' => 'date',
        		'order' => 'DESC',
        		'paged' => 1
        	)); ?>
        	<?php while ($wp_query->have_posts()): $wp_query->the_post(); ?>
        	<article id="post-<?php the_ID(); ?>" class="<?php echo $layout; ?> categories_list_post post">
				<header class="cs-post-header">
					<div class="date-type table">
						<div class="date-box table-cell">
							<div class="date left">
			                    <span class="day"><?php echo get_the_date('j'); ?></span>
			                    <span class="month"><?php echo get_the_date('M'); ?></span>
							</div>
							<span class="icon-type-post right"><i class="<?php echo cshero_get_icon_post_type(); ?>"></i></span>
						</div>
						<?php the_title( sprintf( '<h3 class="cs-post-title table-cell"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
					</div>
					<?php if ( 'post' == get_post_type() ) : ?>
						<?php if ( has_post_thumbnail() && ! post_password_required() && ! is_attachment() ) : ?>
						<div class="cs-post-thumbnail">
							<?php the_post_thumbnail(); ?>
						</div><!-- .entry-thumbnail -->
						<?php endif; ?>
					<?php endif; ?>
				</header><!-- .entry-header -->
			</article><!-- #post-## -->
        	<?php endwhile; ?>
        	<?php wp_reset_query();wp_reset_postdata(); ?>
        <?php
        return  ob_get_clean();
}