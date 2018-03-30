<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
global $houzez_local;
?>

<div class="item-wrap">
	<div id="post-<?php the_ID(); ?>" <?php post_class('post-card-item'); ?>>
		<div class="figure-block">
			<figure class="item-thumb">
				<a href="<?php the_permalink(); ?>" class="hover-effect">
					<?php the_post_thumbnail('houzez-property-thumb-image'); ?>
				</a>
				<figcaption class="thumb-caption clearfix">
					<div class="file-type pull-left"><i class="fa fa-file"></i></div>
				</figcaption>
			</figure>
		</div>
		<div class="post-card-body">

			<div class="post-card-description">
				<ul class="list-inline">
					<li><time datetime="<?php esc_attr( the_time( get_option( 'date_format' ) ));?>"><i class="fa fa-calendar"></i> <?php esc_attr( the_time( get_option( 'date_format' ) ));?></time></li>
					<li><i class="fa fa-bookmark-o"></i> <?php the_category(', '); ?></li>
				</ul>
				<h3 class="post-card-title"><?php the_title(); ?></h3>
				<p><?php echo houzez_clean_excerpt( '100', 'false' ); ?></p>
				<a href="<?php the_permalink(); ?>" class="read"><?php echo $houzez_local['continue_reading']; ?> <i class="fa fa-caret-right"></i></a>
			</div>
			<div class="post-card-author">
				<?php if( get_the_author_meta( 'fave_author_custom_picture' ) != '' ) { ?>
				<div class="author-image">
					<img width="40" height="40" src="<?php echo esc_url(get_the_author_meta( 'fave_author_custom_picture' )); ?>" alt="<?php the_author(); ?>" class="img-circle">
				</div>
				<?php } ?>
				<div class="author-name">
					<span><?php echo $houzez_local['by_text']; ?> <?php the_author(); ?></span>
				</div>
			</div>

		</div>
	</div>
</div>