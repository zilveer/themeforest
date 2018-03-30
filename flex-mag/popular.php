<div class="side-title-wrap left relative">
	<h3 class="side-list-title"><?php echo esc_html(get_option('mvp_pop_head')); ?></h3>
</div><!--side-title-wrap-->
<div class="side-pop-wrap left relative">
<?php global $do_not_duplicate; if (isset($do_not_duplicate)) { ?>
	<div class="feat-widget-cont left relative">
		<?php $pop_ad = get_option('mvp_pop_ad'); $count = 0; $pop_days = esc_html(get_option('mvp_pop_days')); $pop_num = esc_html(get_option('mvp_pop_num')); $popular_days_ago = "$pop_days days ago"; $recent = new WP_Query(array('posts_per_page' => $pop_num, 'post__not_in' => $do_not_duplicate, 'orderby' => 'meta_value_num', 'order' => 'DESC', 'meta_key' => 'post_views_count', 'date_query' => array( array( 'after' => $popular_days_ago )) )); while($recent->have_posts()) : $recent->the_post(); $count++; if ($count == 1 && $pop_ad) { ?>
			<div class="feat-widget-wrap left relative">
				<a href="<?php the_permalink(); ?>">
				<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
					<div class="feat-widget-img left relative">
						<?php the_post_thumbnail('mvp-mid-thumb', array( 'class' => 'reg-img' )); ?>
						<?php the_post_thumbnail('mvp-small-thumb', array( 'class' => 'mob-img' )); ?>
						<?php $post_views = get_post_meta($post->ID, "post_views_count", true); if ( $post_views >= 1) { ?>
							<div class="feat-info-wrap">
								<div class="feat-info-views">
									<i class="fa fa-eye fa-2"></i> <span class="feat-info-text"><?php mvp_post_views(); ?></span>
								</div><!--feat-info-views-->
								<?php if (get_comments_number()==0) { } else { ?>
									<div class="feat-info-comm">
										<i class="fa fa-comment"></i> <span class="feat-info-text"><?php comments_number( '0', '1', '%' ); ?></span>
									</div><!--feat-info-comm-->
								<?php } ?>
							</div><!--feat-info-wrap-->
						<?php } ?>
						<?php if ( has_post_format( 'video' )) { ?>
							<div class="feat-vid-but">
								<i class="fa fa-play fa-3"></i>
							</div><!--feat-vid-but-->
						<?php } ?>
					</div><!--feat-widget-img-->
				<?php } ?>
				<div class="feat-widget-text">
					<span class="side-list-cat"><?php $category = get_the_category(); echo esc_html( $category[0]->cat_name ); ?></span>
					<h2><?php the_title(); ?></h2>
				</div><!--feat-widget-text-->
				</a>
			</div><!--feat-widget-wrap-->
			<div class="widget-ad left relative pop-ad">
				<?php $pop_ad = get_option('mvp_pop_ad'); if ($pop_ad) { echo html_entity_decode($pop_ad); } ?>
			</div><!--widget-ad-->
		<?php } else { ?>
			<div class="feat-widget-wrap left relative">
				<a href="<?php the_permalink(); ?>">
				<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
					<div class="feat-widget-img left relative">
						<?php the_post_thumbnail('mvp-mid-thumb', array( 'class' => 'reg-img' )); ?>
						<?php the_post_thumbnail('mvp-small-thumb', array( 'class' => 'mob-img' )); ?>
						<?php $post_views = get_post_meta($post->ID, "post_views_count", true); if ( $post_views >= 1) { ?>
							<div class="feat-info-wrap">
								<div class="feat-info-views">
									<i class="fa fa-eye fa-2"></i> <span class="feat-info-text"><?php mvp_post_views(); ?></span>
								</div><!--feat-info-views-->
								<?php if (get_comments_number()==0) { } else { ?>
									<div class="feat-info-comm">
										<i class="fa fa-comment"></i> <span class="feat-info-text"><?php comments_number( '0', '1', '%' ); ?></span>
									</div><!--feat-info-comm-->
								<?php } ?>
							</div><!--feat-info-wrap-->
						<?php } ?>
						<?php if ( has_post_format( 'video' )) { ?>
							<div class="feat-vid-but">
								<i class="fa fa-play fa-3"></i>
							</div><!--feat-vid-but-->
						<?php } ?>
					</div><!--feat-widget-img-->
				<?php } ?>
				<div class="feat-widget-text">
					<span class="side-list-cat"><?php $category = get_the_category(); echo esc_html( $category[0]->cat_name ); ?></span>
					<h2><?php the_title(); ?></h2>
				</div><!--feat-widget-text-->
				</a>
			</div><!--feat-widget-wrap-->
		<?php } endwhile; wp_reset_postdata(); ?>
	</div><!--feat-widget-cont-->
<?php } else { ?>
	<div class="feat-widget-cont left relative">
		<?php $pop_ad = get_option('mvp_pop_ad'); $count = 0; $pop_days = esc_html(get_option('mvp_pop_days')); $pop_num = esc_html(get_option('mvp_pop_num')); $popular_days_ago = "$pop_days days ago"; $recent = new WP_Query(array( 'post__not_in' => array( $post->ID ), 'posts_per_page' => $pop_num, 'orderby' => 'meta_value_num', 'order' => 'DESC', 'meta_key' => 'post_views_count', 'date_query' => array( array( 'after' => $popular_days_ago )) )); while($recent->have_posts()) : $recent->the_post(); $count++; if ($count == 1 && $pop_ad) { ?>
			<div class="feat-widget-wrap left relative">
				<a href="<?php the_permalink(); ?>">
				<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
					<div class="feat-widget-img left relative">
						<?php the_post_thumbnail('mvp-mid-thumb', array( 'class' => 'reg-img' )); ?>
						<?php the_post_thumbnail('mvp-small-thumb', array( 'class' => 'mob-img' )); ?>
						<?php $post_views = get_post_meta($post->ID, "post_views_count", true); if ( $post_views >= 1) { ?>
							<div class="feat-info-wrap">
								<div class="feat-info-views">
									<i class="fa fa-eye fa-2"></i> <span class="feat-info-text"><?php mvp_post_views(); ?></span>
								</div><!--feat-info-views-->
								<?php if (get_comments_number()==0) { } else { ?>
									<div class="feat-info-comm">
										<i class="fa fa-comment"></i> <span class="feat-info-text"><?php comments_number( '0', '1', '%' ); ?></span>
									</div><!--feat-info-comm-->
								<?php } ?>
							</div><!--feat-info-wrap-->
						<?php } ?>
						<?php if ( has_post_format( 'video' )) { ?>
							<div class="feat-vid-but">
								<i class="fa fa-play fa-3"></i>
							</div><!--feat-vid-but-->
						<?php } ?>
					</div><!--feat-widget-img-->
				<?php } ?>
				<div class="feat-widget-text">
					<span class="side-list-cat"><?php $category = get_the_category(); echo esc_html( $category[0]->cat_name ); ?></span>
					<h2><?php the_title(); ?></h2>
				</div><!--feat-widget-text-->
				</a>
			</div><!--feat-widget-wrap-->
			<div class="widget-ad left relative pop-ad">
				<?php $pop_ad = get_option('mvp_pop_ad'); if ($pop_ad) { echo html_entity_decode($pop_ad); } ?>
			</div><!--widget-ad-->
		<?php } else { ?>
			<div class="feat-widget-wrap left relative">
				<a href="<?php the_permalink(); ?>">
				<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
					<div class="feat-widget-img left relative">
						<?php the_post_thumbnail('mvp-mid-thumb', array( 'class' => 'reg-img' )); ?>
						<?php the_post_thumbnail('mvp-small-thumb', array( 'class' => 'mob-img' )); ?>
						<?php $post_views = get_post_meta($post->ID, "post_views_count", true); if ( $post_views >= 1) { ?>
							<div class="feat-info-wrap">
								<div class="feat-info-views">
									<i class="fa fa-eye fa-2"></i> <span class="feat-info-text"><?php mvp_post_views(); ?></span>
								</div><!--feat-info-views-->
								<?php if (get_comments_number()==0) { } else { ?>
									<div class="feat-info-comm">
										<i class="fa fa-comment"></i> <span class="feat-info-text"><?php comments_number( '0', '1', '%' ); ?></span>
									</div><!--feat-info-comm-->
								<?php } ?>
							</div><!--feat-info-wrap-->
						<?php } ?>
						<?php if ( has_post_format( 'video' )) { ?>
							<div class="feat-vid-but">
								<i class="fa fa-play fa-3"></i>
							</div><!--feat-vid-but-->
						<?php } ?>
					</div><!--feat-widget-img-->
				<?php } ?>
				<div class="feat-widget-text">
					<span class="side-list-cat"><?php $category = get_the_category(); echo esc_html( $category[0]->cat_name ); ?></span>
					<h2><?php the_title(); ?></h2>
				</div><!--feat-widget-text-->
				</a>
			</div><!--feat-widget-wrap-->
		<?php } endwhile; wp_reset_postdata(); ?>
	</div><!--feat-widget-cont-->
<?php } ?>
</div><!--side-pop-wrap-->