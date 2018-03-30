<?php
	get_header();
	$webnus_options = webnus_options();
	$webnus_options['webnus_blog_sidebar'] = isset( $webnus_options['webnus_blog_sidebar'] ) ? $webnus_options['webnus_blog_sidebar'] : '';
	$sidebar = $webnus_options['webnus_blog_sidebar'];
	$webnus_options['webnus_blog_template'] = isset( $webnus_options['webnus_blog_template'] ) ? $webnus_options['webnus_blog_template'] : '';
	$template = $webnus_options['webnus_blog_template'];
	$last_time = get_the_time(' F Y'); $i=1; $flag = false; //timeline
	if ($template == 6 || $template == 7) // disabled sidebar in masonry or timeline
		$sidebar = 'none';
	if ($template == 4 || $template == 5) // post count in template 4,5
		$p_count = '0';
?>


<?php // start headline
	echo '<section id="headline"><div class="container"><h2>';
		if ( is_day() ) :
			printf('<small>'. esc_html__( 'Daily Archives', 'webnus_framework' ) . ':</small> %s', get_the_date() );
		elseif ( is_month() ) :
			printf('<small>'. esc_html__( 'Monthly Archives', 'webnus_framework' ) . ':</small> %s', get_the_date( _x( 'F Y', 'monthly archives date format', 'webnus_framework' ) ) );
		elseif ( is_year() ) :
			printf('<small>'. esc_html__( 'Yearly Archives', 'webnus_framework' ) .':</small> %s', get_the_date( _x( 'Y', 'yearly archives date format', 'webnus_framework' ) ) );
		elseif ( is_category() ):
			printf(  '%s', single_cat_title( '', false ) );
		elseif ( is_tag() ):
			printf('<small>'. esc_html__( 'Tag', 'webnus_framework' ) .':</small> %s', single_tag_title( '', false ) );
		else :
			$webnus_options['webnus_blog_page_title'] = isset( $webnus_options['webnus_blog_page_title'] ) ? $webnus_options['webnus_blog_page_title'] : '';
			echo esc_html($webnus_options['webnus_blog_page_title']);
		endif;
	echo '</h2></div></section>';
 // end headline ?>



<?php // start main content
	if($template == 1 || $template == 2 || $template == 3 || $template == 4 || $template == 5){
		echo '<section class="container page-content" ><hr class="vertical-space2">';
		if ($sidebar == 'left' || $sidebar == 'both'){ ?>
				<aside class="col-md-3 sidebar leftside">
					<?php dynamic_sidebar( 'Left Sidebar' ); ?>
				</aside>
			<?php }
		if ($sidebar == 'both')
				$class='col-md-6 cntt-w';
		elseif ($sidebar == 'right' || $sidebar == 'left')
				$class='col-md-9 cntt-w';
		else // none sidebar
				$class='col-md-12 omega';	
		echo '<section class="'. $class .'">';
	}else if ($template == 6){ 
		echo'<section id="main-content-pin"><div class="container"><div id="pin-content">';
	}else if ($template == 7){ 
		echo'<section id="main-timeline"><div class="container"><div id="tline-content">';
	} // end main content ?>
	
<?php
	if ($template == 3)
		echo '<div class="row">';
	if(have_posts()):
		while( have_posts() ): the_post();
			if( $sidebar == 'both')
				get_template_part('parts/blogloop','bothsidebar');
			else{
				switch($template){
					case 2:
						get_template_part('parts/blogloop','type2');
					break;
					case 3:
						get_template_part('parts/blogloop','type3');
					break;
					case 4:
						if($p_count == '0')
							get_template_part('parts/blogloop');
						else
							get_template_part('parts/blogloop','type2');
						$p_count++;
					break;
					case 5:
						if($p_count == '0'){
							get_template_part('parts/blogloop');
							echo '<div class="row">';
						}else
							get_template_part('parts/blogloop','type3');
						$p_count++;
					break;
					case 6:
						get_template_part('parts/blogloop','masonry');
					break;
					case 7:
						get_template_part('parts/blogloop','timeline');
					break;
					default:
						get_template_part('parts/blogloop'); //type 1
					break;
				}
			}
		endwhile;
	else:
		get_template_part('blogloop-none');
	endif;


	if($template == 7) // for timeline
		echo'<div class="tline-topdate enddte">'. get_the_time(' F Y') .'</div></div>';

// end query ?>


<?php if($template == 3 || $template == 5 || $template == 6 || $template == 7)
	echo '</div>'; ?>


<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } else {
	echo '<div class="wp-pagenavi">';
	next_posts_link(esc_html__('&larr; Previous page', 'webnus_framework'));
	previous_posts_link(esc_html__('Next page &rarr;', 'webnus_framework'));
	echo '</div>';
} ?> 

</section>

<?php if ($sidebar == 'right' || $sidebar == 'both'){ ?>
	<aside class="col-md-3 sidebar">
		<?php dynamic_sidebar( 'Right Sidebar' ); ?>
	</aside>
<?php } ?>
<?php if($template == 1 || $template == 2 || $template == 3 || $template == 4 || $template == 5)
	echo '</section>'; ?>


<?php get_footer(); ?>