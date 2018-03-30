<?php
get_header();
$settings = crazyblog_opt();
$single_setting = $settings;
$post_meta = get_post_meta( get_the_ID(), 'crazyblog_recipe_meta', true );
$meta = crazyblog_set( crazyblog_set( $post_meta, 'crazyblog_recipe_options' ), '0' );

if ( crazyblog_set( $post_meta, 'post_title_section' ) == '1' ) {
	$show_banner = crazyblog_set( $settings, 'single_title_section' );
	$bg = (crazyblog_set( $settings, 'single_title_section_bg' )) ? 'background:url(' . crazyblog_set( $settings, 'single_title_section_bg' ) . ')' : "";
} else {
	$show_banner = crazyblog_set( $post_meta, 'post_title_section' );
	$bg = (crazyblog_set( $post_meta, 'title_section_bg' )) ? 'background:url(' . crazyblog_set( $post_meta, 'title_section_bg' ) . ')' : "";
}

if ( crazyblog_set( $post_meta, 'layout' ) == '' ) {
	$sidebar = (crazyblog_set( $settings, 'single_page_sidebar' )) ? crazyblog_set( $settings, 'single_page_sidebar' ) : "";
	$layout = ($sidebar && crazyblog_set( $settings, 'single_sidebar_layout' )) ? crazyblog_set( $settings, 'single_sidebar_layout' ) : "";
	$cols = ($layout != "full" && $sidebar ) ? "col-md-8" : 'col-md-12';
} else {

	$sidebar = (crazyblog_set( $post_meta, 'sidebar' )) ? crazyblog_set( $post_meta, 'sidebar' ) : "";
	$layout = ($sidebar && crazyblog_set( $post_meta, 'layout' )) ? crazyblog_set( $post_meta, 'layout' ) : "";
	$cols = ($layout != "full" && $sidebar ) ? "col-md-8" : 'col-md-12';
}

$no_image = "";
$year = get_the_time( 'Y' );
$month = get_the_time( 'm' );
$day = get_the_time( 'd' );
crazyblog_set_posts_views( get_the_ID() );
crazyblog_View::get_instance()->crazyblog_enqueue_scripts( array( 'df-magnific' ) );

if ( $show_banner ) :
	?>
	<div class="pagetop" style="<?php echo esc_attr( $bg ); ?>">
		<div class="page-name">
			<div class="container">
				<span><?php the_title(); ?></span>
				<?php echo crazyblog_get_breadcrumbs(); ?>
			</div>
		</div>
	</div><!-- Page Top -->
<?php endif; ?>

<section>
    <div class="block">
        <div class="container">
            <div class="row">
				<?php if ( is_active_sidebar( $sidebar ) && $layout == "left" ) : ?>
					<aside class="col-md-4 column sidebar left-sidebar">
						<?php dynamic_sidebar( $sidebar ); ?>
					</aside>
				<?php endif; ?>
				<?php
				if ( have_posts() ) : while ( have_posts() ) : the_post();
						$view = (get_post_meta( get_the_ID(), 'crazyblog_post_views', true )) ? get_post_meta( get_the_ID(), 'crazyblog_post_views', true ) : '0';
						?>
						<div <?php post_class( $cols . ' ' . "column" ) ?> itemscope itemtype="http://schema.org/Recipe">
							<div class="default-template recipe-single">
								<?php if ( has_post_thumbnail() ): ?>
									<div class="single-image">
										<?php the_post_thumbnail( 'full' ); ?>
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
												</a>
												<?php
												$custom_script = 'jQuery(document).ready(function () {like_dislike(' . get_the_ID() . ');});';
												wp_add_inline_script( 'crazyblog_df-script', $custom_script );
												?>
											</li>
										</ul>
									</div>
								<?php endif; ?>
								<div class="post-name">
									<ul class="meta">
										<li itemprop=datePublished" content="<?php echo get_the_date( 'Y-m-d' ); ?>"><?php echo get_the_date( get_option( 'post_format' ) ); ?></li>
										<li><?php echo esc_html_e( 'BY ', 'crazyblog' ) ?><a  itemprop="author" href="javascript:void(0)" title=""><?php echo esc_html( crazyblog_set( $meta, 'crazyblog_chief_name' ) ) ?></a></li>
										<li><?php echo esc_html_e( 'In ', 'crazyblog' ) ?><?php crazyblog_get_terms( 'recipe_category', 5, 'a', true, '|' ) ?></li>
									</ul>
									<h1 itemprop="name"><?php the_title() ?></h1>
								</div><!-- Post Name -->
								<div class="serves-sec">
									<?php if ( crazyblog_set( $meta, 'crazyblog_recipe_serve' ) != '' ): ?>
										<strong><?php esc_html_e( 'Serves ', 'crazyblog' ) ?> <?php echo esc_html( crazyblog_set( $meta, 'crazyblog_recipe_serve' ) ) ?></strong>
									<?php endif; ?>
									<?php if ( crazyblog_set( $meta, 'crazyblog_recipe_prep_time' ) != '' || crazyblog_set( $meta, 'crazyblog_recipe_cook_time' ) != '' || crazyblog_set( $meta, 'crazyblog_recipe_total_time' ) != '' || crazyblog_set( $meta, 'crazyblog_recipe_heat' ) != '' ): ?>
										<ul>
											<?php if ( crazyblog_set( $meta, 'crazyblog_recipe_prep_time' ) != '' ): ?><li  itemprop="prepTime" content="<?php echo esc_attr( crazyblog_set( $meta, 'crazyblog_recipe_prep_time' ) ) ?>"><i class="fa fa-clock-o"></i> <?php esc_html_e( 'Prep Time', 'crazyblog' ) ?>: <?php echo esc_html( crazyblog_set( $meta, 'crazyblog_recipe_prep_time' ) ) ?></li><?php endif; ?>
											<?php if ( crazyblog_set( $meta, 'crazyblog_recipe_cook_time' ) != '' ): ?><li itemprop="cookTime" content="<?php echo esc_attr( crazyblog_set( $meta, 'crazyblog_recipe_cook_time' ) ) ?>"><i class="fa fa-clock-o"></i> <?php esc_html_e( 'Cook Time', 'crazyblog' ) ?>: <?php echo esc_html( crazyblog_set( $meta, 'crazyblog_recipe_cook_time' ) ) ?></li><?php endif; ?>
											<?php if ( crazyblog_set( $meta, 'crazyblog_recipe_total_time' ) != '' ): ?><li itemprop="recipeYield"><i class="fa fa-clock-o"></i> <?php esc_html_e( 'Total Time', 'crazyblog' ) ?>: <?php echo esc_html( crazyblog_set( $meta, 'crazyblog_recipe_total_time' ) ) ?></li><?php endif; ?>
											<?php if ( crazyblog_set( $meta, 'crazyblog_recipe_heat' ) != '' ): ?><li class="degree"><?php esc_html_e( 'Preheat the oven to ', 'crazyblog' ) ?><?php echo esc_html( crazyblog_set( $meta, 'crazyblog_recipe_heat' ) ) ?></li><?php endif; ?>
										</ul>
									<?php endif; ?>
									<div class="ingredients">
										<img src="<?php echo esc_url( crazyblog_set( $meta, 'crazyblog_recipe_info_img' ) ) ?>" alt="" />
										<div class="ingredients-list">
											<span><?php esc_html_e( 'Ingredients', 'crazyblog' ) ?></span>
											<?php
											$info = crazyblog_set( $meta, 'crazyblog_instruction' );
											if ( !empty( $info ) && count( $info ) > 0 ) {
												echo '<ul>';
												foreach ( $info as $i ) {
													echo '<li itemprop="ingredients">' . crazyblog_set( $i, 'crazyblog_recipe_ins' ) . '</li>';
												}
												echo '</ul>';
											}
											?>
										</div>
									</div>
									<?php
									$ins = crazyblog_set( $meta, 'crazyblog_instruction' );
									if ( !empty( $ins ) && count( $ins ) > 0 ):
										$counter = 1;
										?>
										<div itemprop="recipeInstructions" class="recipe-instructions" style="background:ur('<?php echo esc_url( crazyblog_URI . 'assets/imagesrecipe-instructions-bg.jpg' ) ?>')">
											<h3><?php esc_html_e( 'Instructions', 'crazyblog' ) ?></h3>
											<ul>
												<?php foreach ( $ins as $i ): ?>
													<li><span><?php echo esc_html( $counter ) ?></span><?php echo esc_html( crazyblog_set( $i, 'crazyblog_recipe_ins' ) ) ?></li>
													<?php
													$counter++;
												endforeach;
												?>
											</ul>
										</div>
									<?php endif; ?>
								</div>
								<div class="mfn-gallery" itemprop="description">
									<?php the_content() ?>
								</div>
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
													echo wp_kses_post( (get_the_author_meta( 'crazyblog_dr' )) ? '<a title="" href="' . esc_url( get_the_author_meta( 'crazyblog_dr' ) ) . '" ><i class="fa fa-dribbble"></i></a>' : ''  );
													echo wp_kses_post( (get_the_author_meta( 'crazyblog_pint' )) ? '<a title="" href="' . esc_url( get_the_author_meta( 'crazyblog_pint' ) ) . '" ><i class="fa fa-linkedin"></i></a>' : ''  );
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
						<?php
					endwhile;
					wp_reset_postdata();
				endif;
				?>
				<?php if ( is_active_sidebar( $sidebar ) && $layout == "right" ) : ?>
					<aside class="col-md-4 column sidebar right-sidebar">
						<?php dynamic_sidebar( $sidebar ); ?>
					</aside>
				<?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php crazyblog_View::get_instance()->crazyblog_enqueue_scripts( array( 'df-owl' ) ); ?>
<?php
$custom_script = 'jQuery(document).ready(function ($) {
        jQuery(".related-carousel").owlCarousel({
            autoplay: true,
            autoplayTimeout: 2500,
            smartSpeed: 2000,
            autoplayHoverPause: true,
            loop: false,
            dots: false,
            nav: true,
            margin: 30,
            mouseDrag: true,
            autoHeight: true,
            items: 2,
            responsive: {
                1200: {items: 2},
                980: {items: 2},
                768: {items: 2},
                480: {items: 2},
                0: {items: 1}
            }
        });
        $(".mfn-gallery").magnificPopup({
            gallery: {
                enabled: false,
                preload: [0, 2],
                navigateByImgClick: true,
                arrowMarkup: "<button title=\"%title%\" type=\"button\" class=\"mfp-arrow mfp-arrow-%dir%\"></button>",
                tPrev: "Previous (Left arrow key)",
                tNext: "Next (Right arrow key)",
                tCounter: "<span class=\"mfp-counter\">%curr% of %total%</span>"
            },
            delegate: "a",
            type: "image",
            removalDelay: 300,
            mainClass: "mfp-fade mfp-with-zoom",
            zoom: {
                enabled: true,
                duration: 300,
                easing: "ease-in-out",
                opener: function (openerElement) {
                    return openerElement.is("img") ? openerElement : openerElement.find("img");
                }
            },
            gallery:{
                enabled: true
            },
        });
    });';
wp_add_inline_script( 'crazyblog_df-owl', $custom_script );
?>
<?php get_footer(); ?>