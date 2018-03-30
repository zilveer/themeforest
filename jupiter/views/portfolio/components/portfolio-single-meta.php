<?php
global $mk_options;

 if ( $mk_options['single_portfolio_cats'] == 'true' ) : ?>
		<span class="portfolio-single-cat"><?php echo implode( ', ', mk_get_custom_tax(get_the_id(), 'portfolio', true) ); ?></span>
<?php endif; ?>


<?php if ( $mk_options['single_portfolio_social'] == 'true' && get_post_meta( $post->ID, '_portfolio_social', true ) != 'false' ) : ?>

		<div class="single-social-section portfolio-social-share">
		    <div class="mk-love-holder"><?php echo Mk_Love_Post::send_love(); ?></div>

		    <div class="blog-share-container">
		        <div class="blog-single-share mk-toggle-trigger"><?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, 'mk-moon-share-2'); ?></div>

		        <ul class="single-share-box mk-box-to-trigger">
		            <li><a class="facebook-share" data-title="<?php the_title_attribute(); ?>" data-url="<?php echo esc_url( get_permalink() ); ?>" href="#"><?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, 'mk-jupiter-icon-simple-facebook', 16); ?></a></li>
		            <li><a class="twitter-share" data-title="<?php the_title_attribute(); ?>" data-url="<?php echo esc_url( get_permalink() ); ?>" href="#"><?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, 'mk-moon-twitter', 16); ?></a></li>
		            <li><a class="googleplus-share" data-title="<?php the_title_attribute(); ?>" data-url="<?php echo esc_url( get_permalink() ); ?>" href="#"><?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, 'mk-jupiter-icon-simple-googleplus', 16); ?></a></li>
		            <li><a class="linkedin-share" data-title="<?php the_title_attribute(); ?>" data-url="<?php echo esc_url( get_permalink() ); ?>" href="#"><?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, 'mk-jupiter-icon-simple-linkedin', 16); ?></a></li>
		            <li><a class="pinterest-share" data-image="<?php echo esc_attr( wp_get_attachment_image_src(get_post_thumbnail_id() , 'full', true) [0] ); ?>" data-title="<?php the_title_attribute(); ?>" data-url="<?php echo esc_url( get_permalink() ); ?>" href="#"><?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, 'mk-jupiter-icon-simple-pinterest', 16); ?></a></li>
		        </ul>
		    </div>
		</div>

<?php endif; ?>
<div class="clearboth"></div>