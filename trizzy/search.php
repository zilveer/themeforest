<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package Trizzy
 */

get_header(); ?>

<!-- Titlebar
	================================================== -->
	<section class="titlebar">
		<div class="container">
			<div class="sixteen columns">
				<h2><?php printf( __( 'Search Results for: %s', 'trizzy' ), '<span>' . get_search_query() . '</span>' ); ?></h2>

				<nav id="breadcrumbs">
					<?php if(ot_get_option('pp_breadcrumbs','on') == 'on') echo dimox_breadcrumbs(); ?>
				</nav>
			</div>
		</div>
	</section>
<?php $layout = ot_get_option('pp_blog_layout') ?>
<!-- Container -->
<div class="container search-container <?php echo $layout; ?>">
	<div class="twelve columns">
	    <div class="extra-padding">
		<?php
		if ( have_posts() ) :
			while ( have_posts() ) : the_post();
	            /* Include the Post-Format-specific template for the content.
	             * If you want to overload this in a child theme then include a file
	             * called content-___.php (where ___ is the Post Format name) and that will be used instead.
	             */
	            $type =  get_post_type();
	            $layout = ot_get_option('pp_blog_layout');
	            switch ($type) {
	            	case 'product' :
		            	get_template_part( 'postformats/searchproduct' );
	            	break;
	            	case 'post':
		            	$format = get_post_format();
                		if( false === $format  )  $format = 'standard';
						if($layout == 'masonry') {
							get_template_part( 'postformats/masonry', $format );
						} else {
							get_template_part( 'postformats/content', $format );
						}
	            	break;

	            	case 'page':
		            	if($layout == 'masonry') {
		            		get_template_part( 'postformats/searchpagemasonry' );
		            	} else {
		            		get_template_part( 'postformats/searchpage' );
		            	}
	            	break;

	            	case 'portfolio':
            			if($layout == 'masonry') {
		            		get_template_part( 'postformats/searchpfmasonry' );
		            	} else {
		            		get_template_part( 'postformats/searchpf' );
		            	}
	            	break;

	            	default:
	                    # code...
	            	break;
	            }

	            endwhile;
	            endif; ?>
	            <div class="clearfix"></div>
               	<!-- Pagination -->
		        <div class="pagination-container">
		            <?php if(function_exists('wp_pagenavi')) { ?>
		            <nav class="pagination">
		                 <?php wp_pagenavi(); ?>
		            </nav>
		            <?php
		            } else {
		            if ( get_next_posts_link() ||  get_previous_posts_link() ) : ?>
		            <nav class="pagination">
		                <ul>
		                    <?php if ( get_previous_posts_link() ) : ?>
		                        <li id="next"><?php previous_posts_link( ' ' ); ?></li>
		                    <?php  endif; ?>
		                    <?php if ( get_next_posts_link() ) : ?>
		                        <li id="prev"><?php next_posts_link( ' '); ?></li>
		                        <!-- <li><a href="#" class="next"></a></li> -->
		                     <?php endif; ?>
		                </ul>
		            </nav>
		           <?php endif;
		           } ?>
		        </div>
	    </div>
	</div>
<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
