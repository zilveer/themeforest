<?php
$view = (get_post_meta( get_the_ID(), 'crazyblog_post_views', true )) ? get_post_meta( get_the_ID(), 'crazyblog_post_views', true ) : '0';
?>
<div class="<?php echo esc_attr( $cols ); ?> column">
	<?php
	$detect = new crazyblog_Detect;
	if ( !$detect->isMobile() && !$detect->isTablet() ) {
		$adCode = crazyblog_set( $settings, 'ataAdCode' );
		$isDesktop = crazyblog_set( $settings, 'ataadEnableDesktop' );
		$adSize = crazyblog_set( $settings, 'ataadDesktopSize' );
		crazyblog_adCode( $isDesktop, $adCode, $adSize, '728x90', 'add' );
	}
	if ( !has_post_thumbnail() ) : $no_image = "no-image";
	endif;
	if ( has_post_thumbnail() ) {
		$schemaImage = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'crazyblog_1170x590' );
	}
	?>
    <div <?php post_class( 'default-template ' . $no_image ); ?> itemscope itemtype="http://schema.org/Article">
		<?php if ( has_post_thumbnail() ): ?>
			<div class="single-image">
				<?php the_post_thumbnail( 'crazyblog_1170x590' ); ?>
				<ul class="short-info">
					<li><i class="fa fa-comments"></i><?php echo crazyblog_restyle_text( get_comments_number( get_the_ID() ) ) ?></li>
					<li><i class="fa fa-eye"></i><?php echo crazyblog_restyle_text( $view ) ?></li>
					<li>
						<a class="like-this <?php echo crazyblog_check_post_like( get_the_ID() ) ?>" id="like_dislike"  href="javascript:void(0)" title="">
							<?php if ( crazyblog_check_post_like( get_the_ID() ) != 'liked' ): ?>
								<i class="fa fa-heart-o"></i> 
							<?php else: ?>
								<i class="fa fa-heart"></i> 
							<?php endif; ?>
							<span><?php echo crazyblog_post_counter( get_the_ID() ) ?></span> 
							<?php esc_html_e( 'likes', 'crazyblog' ) ?>
						</a>
					</li>
					<?php
					$custom_script = 'jQuery(document).ready(function () {like_dislike(' . get_the_ID() . ');});';
					wp_add_inline_script( 'crazyblog_df-script', $custom_script );
					?>
				</ul>
			</div><!-- Single Image -->
		<?php endif; ?>
        <div class="post-name">
			<span style=display:none itemscope itemtype="https://schema.org/Person">
				<meta itemprop=name content="<?php esc_attr( the_author() ); ?>">
			</span>
			<meta itemprop=datePublished content="<?php echo get_the_date( get_option( 'post_format' ) ); ?>">
			<meta itemprop=dateModified content="<?php echo get_the_date( get_option( 'post_format' ) ); ?>">
			<meta itemprop=name content="<?php echo esc_attr( get_bloginfo( 'name' ) ) ?>">
			<meta itemscope itemprop=mainEntityOfPage itemType="https://schema.org/WebPage" itemid="<?php the_permalink() ?>" />
			<meta name=author content="<?php the_author(); ?>">
			<span style=display:none itemprop=publisher itemscope itemtype="https://schema.org/Organization">
				<span style=display:none itemprop=logo itemscope itemtype="https://schema.org/ImageObject">
					<meta itemprop=url content="<?php echo esc_url( crazyblog_Header::crazyblog_logo( true ) ) ?>">
				</span>
				<meta itemprop=name content="<?php echo esc_attr( get_bloginfo( 'name' ) ) ?>">
			</span>
			<span style=display:none itemprop=image itemscope itemtype="https://schema.org/ImageObject">
				<meta itemprop=url content="<?php echo esc_url( crazyblog_set( $schemaImage, '0' ) ) ?>">
				<meta itemprop=width content=<?php echo esc_url( crazyblog_set( $schemaImage, '1' ) ) ?>>
				<meta itemprop=height content=<?php echo esc_url( crazyblog_set( $schemaImage, '2' ) ) ?>>
			</span>
            <h1><?php the_title(); ?></h1>
			<?php if ( crazyblog_set( $single_setting, 'single_post_date' ) == 'show' || crazyblog_set( $single_setting, 'single_post_author' ) == 'show' || crazyblog_set( $single_setting, 'single_post_comment_counter' ) == 'show' || crazyblog_set( $single_setting, 'single_post_category' ) == 'show' ) : ?>
				<ul class="meta">
					<?php if ( crazyblog_set( $single_setting, 'single_post_date' ) == 'show' ) : ?>
						<li><a href="<?php echo esc_url( get_day_link( $year, $month, $day ) ); ?>" title=""><?php echo get_the_date( get_option( 'post_format' ) ); ?></a></li>
					<?php endif; ?>
					<?php if ( crazyblog_set( $single_setting, 'single_post_author' ) == 'show' ) : ?>
						<li><?php esc_html_e( 'by ', 'crazyblog' ); ?><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title=""><?php the_author(); ?></a></li>
					<?php endif; ?>
					<?php if ( crazyblog_set( $single_setting, 'single_post_comment_counter' ) == 'show' ) : ?>
						<li><i class="fa fa-comments"></i><?php echo crazyblog_restyle_text( get_comments_number( get_the_ID() ) ) ?></li>
					<?php endif; ?>
					<?php if ( crazyblog_set( $single_setting, 'single_post_category' ) == 'show' ) : ?>
						<li><?php echo crazyblog_get_post_categories( get_the_ID(), ' , ' ); ?></li>
					<?php endif; ?>
				</ul>
			<?php endif; ?>
        </div><!-- Post Name -->
		<?php crazyblog_adCode( 'at_top', 'at', 'remove-gap ads-setting' ); ?>
		<div class="mfn-gallery">
			<?php
			crazyblog_getContent();
			wp_link_pages();
			?>
		</div>
		<?php crazyblog_adCode( 'at_bottom', 'ab', 'remove-gap ads-setting' ); ?>
        <div class="footer-links">
			<?php
			$fb = (crazyblog_set( $single_setting, 'show_fb_share' )) ? "facebook" : '';
			$twitter = (crazyblog_set( $single_setting, 'show_twitter_share' )) ? "twitter" : '';
			$linkedin = (crazyblog_set( $single_setting, 'show_linkedin_share' )) ? "linkedin" : '';
			$pinterest = (crazyblog_set( $single_setting, 'show_pinterest_share' )) ? "pinterest" : '';
			$gplus = (crazyblog_set( $single_setting, 'show_gplus_share' )) ? "google-plus" : '';
			$reddit = (crazyblog_set( $single_setting, 'show_reddit_share' )) ? "reddit" : '';
			$tumblr = (crazyblog_set( $single_setting, 'show_tumblr_share' )) ? "tumblr" : '';
			crazyblog_social_share_output( array( $fb, $twitter, $linkedin, $pinterest, $gplus, $reddit, $tumblr ), false, true );
			?>
        </div><!-- Social Links  -->		

		<?php if ( crazyblog_set( $single_setting, 'single_post_tags' ) == 'show' && get_the_tags() != '' ) : ?>
			<div class="single-post-tags">
				<h4 class="simple-heading"><?php esc_html_e( 'TAG', 'crazyblog' ); ?></h4>
				<div class="tags">
					<?php crazyblog_get_tags(); ?>
				</div>				
			</div><!-- Single Post Tags -->
		<?php endif; ?>

		<?php if ( crazyblog_set( $single_setting, 'single_post_navigation' ) == 'show' ) : ?>
			<div class="other-posts">
				<?php crazyblog_get_next_prev_post(); ?>
			</div><!-- Other Posts -->		
		<?php endif; ?>

		<?php if ( crazyblog_set( $single_setting, 'single_post_authorbox' ) == 'show' && get_the_author_meta( 'description' ) != '' ) : ?>
			<div class="about-the-author">
				<h4 class="simple-heading"><?php esc_html_e( 'ABOUT THE AUTHOR', 'crazyblog' ); ?></h4>
				<div class="author-info" >
					<?php echo get_avatar( get_the_author_meta( 'ID' ), 160 ); ?>
					<div class="author-detail">
						<h4><a   href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title=""><?php the_author(); ?></a></h4>
						<p><?php echo get_the_author_meta( 'description' ) ?></p>
						<div class="author-media">
							<?php
							echo wp_kses_post( (get_the_author_meta( 'crazyblog_fb' )) ? '<a title="" href="' . esc_url( get_the_author_meta( 'crazyblog_fb' ) ) . '" ><i class="fa fa-facebook"></i></a>' : ''  );
							echo wp_kses_post( (get_the_author_meta( 'crazyblog_fb' )) ? '<a title="" href="' . esc_url( get_the_author_meta( 'crazyblog_tw' ) ) . '" ><i class="fa fa-twitter"></i></a>' : ''  );
							echo wp_kses_post( (get_the_author_meta( 'crazyblog_gp' )) ? '<a title="" href="' . esc_url( get_the_author_meta( 'crazyblog_gp' ) ) . '" ><i class="fa fa-google-plus"></i></a>' : ''  );
							echo wp_kses_post( (get_the_author_meta( 'crazyblog_dr' )) ? '<a title="" href="' . esc_url( get_the_author_meta( 'crazyblog_dr' ) ) . '" ><i class="fa fa-linkedin"></i></a>' : ''  );
							echo wp_kses_post( (get_the_author_meta( 'crazyblog_pint' )) ? '<a title="" href="' . esc_url( get_the_author_meta( 'crazyblog_pint' ) ) . '" ><i class="fa fa-pinterest"></i></a>' : ''  );
							?>
						</div>
					</div>
				</div>
			</div><!-- About The Author -->
		<?php endif; ?>

		<?php if ( crazyblog_set( $single_setting, 'single_post_related' ) == 'show' ) : ?>
			<div class="related-posts">
				<h4 class="simple-heading"><?php esc_html_e( 'RELATED POSTS', 'crazyblog' ); ?></h4>
				<div class="related-carousel">
					<?php echo crazyblog_related_post( 3 ); ?>
				</div><!-- Related Carousel -->
			</div><!-- Related Posts -->
		<?php endif; ?>
		<?php comments_template(); ?>
    </div><!-- Default Template -->
</div>