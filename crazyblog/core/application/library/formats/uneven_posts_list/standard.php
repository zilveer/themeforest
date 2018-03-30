<?php
$view = (get_post_meta( get_the_ID(), 'crazyblog_post_views', true )) ? get_post_meta( get_the_ID(), 'crazyblog_post_views', true ) : '0';
?>
<div class="<?php echo esc_attr( $post_cols ); ?>">
    <div class="texty-post">
		<div class="texty-post-img">
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail( $size ); ?></a>
            <a title="" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
				<?php echo get_avatar( get_the_author_meta( 'ID' ), 200 ); ?>
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
				<p><?php echo character_limiter( get_the_content(), $limit ); ?></p>
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