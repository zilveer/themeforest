<?php
$post_meta = get_post_meta( get_the_ID(), 'crazyblog_post_meta', true );
$gallery = explode( ',', crazyblog_set( crazyblog_set( crazyblog_set( $post_meta, 'crazyblog_post_format_options' ), '0' ), 'crazyblog_post_gallery' ) );
$view = (get_post_meta( get_the_ID(), 'crazyblog_post_views', true )) ? get_post_meta( get_the_ID(), 'crazyblog_post_views', true ) : '0';
?>
<div class="<?php echo esc_attr( $post_cols ); ?>">
    <div class="texty-post">
        <div class="texty-post-img">
			<?php if ( !empty( $gallery ) ): ?>
				<div class="carousel">
					<?php
					foreach ( $gallery as $g ):
						$url = crazyblog_set( wp_get_attachment_image_src( $g, $size ), '0' );
						?>
						<div class="carousel-img"><img src="<?php echo esc_url( $url ); ?>" alt="" /></div>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
            <a title="" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
				<?php echo get_avatar( get_the_author_meta( 'ID' ), 45 ); ?>
            </a>
        </div>
        <div class="texty-post-detail">
            <div class="categories">
				<?php echo crazyblog_get_post_categories( get_the_ID() ); ?>
            </div>
            <h2><a href="<?php the_permalink(); ?>" title=""><?php the_title(); ?></a></h2>
            <ul class="meta">
                <li><a title="" href="<?php echo esc_url( get_day_link( $year, $month, $day ) ); ?>"><?php echo get_the_date( get_option( 'post_format' ) ); ?></a></li>
                <li><?php esc_html_e( 'By ', 'crazyblog' ); ?><a title="" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php the_author(); ?></a></li>
            </ul>
			<?php if ( $show_conents == "true" ) : ?>
				<p><?php echo esc_html( character_limiter( get_the_excerpt(), $limit ) ); ?></p>
			<?php endif; ?>
            <div class="post-info">
                <span class="view"><i class="fa fa-comments"></i><span><?php echo crazyblog_restyle_text( get_comments_number( get_the_ID() ) ) ?></span></span>
                <span class="view"><i class="fa fa-eye"></i><span><?php echo crazyblog_restyle_text( $view ) ?></span></span>
                <span>
                    <i class="fa fa-share-alt"></i>
                    <span class="share-link">
						<?php crazyblog_social_share_output( array( 'facebook', 'twitter', 'pinterest', 'dribbble' ) ); ?>
                    </span>
                </span>
            </div>
        </div>
    </div><!-- Texty Post -->
</div>
<?php crazyblog_VIEW::get_instance()->crazyblog_enqueue_scripts( array( 'df-owl' ) ); ?>
<?php
$carousel = 'jQuery(document).ready(function ($) {
        $(".carousel").owlCarousel({
            autoplay: true,
            autoplayTimeout: 2500,
            smartSpeed: 2000,
            autoplayHoverPause: true,
            loop: true,
            dots: true,
            nav: false,
            margin: 0,
            mouseDrag: true,
            singleItem: true,
            items: 1,
            autoHeight: true
        });
    });';
wp_add_inline_script( 'crazyblog_df-owl', $carousel );
?>