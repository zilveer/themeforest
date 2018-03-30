<?php
	get_header();
	$webnus_options = webnus_options();
	$webnus_options['webnus_blog_sidebar'] = isset( $webnus_options['webnus_blog_sidebar'] ) ? $webnus_options['webnus_blog_sidebar'] : '';
	$sidebar = $webnus_options['webnus_blog_sidebar'];
?>

<section id="headline">
	<div class="container">
		<h2>
		<?php
			printf(  '%s', single_term_title( '', false ) );
		?>
		</h2>
	</div>
</section>

<section class="container page-content" ><hr class="vertical-space2">
<?php
if ($sidebar == 'left' || $sidebar == 'both'){?>
	<aside class="col-md-3 sidebar leftside">
		<?php dynamic_sidebar( 'Left Sidebar' ); ?>
	</aside>
<?php }
if ($sidebar == 'both')
	$class='col-md-6 cntt-w sermons-grid';
elseif ($sidebar == 'right' || $sidebar == 'left')
	$class='col-md-9 cntt-w sermons-grid';
else // none sidebar
	$class='col-md-12 omega sermons-grid';	
echo '<section class="'. $class .'">';
if(have_posts()):
		$count= 1 ;
	while( have_posts() ): the_post();
		echo ($count % 2 != 0)?'<div class="row">':'';
		$image = get_the_image( array( 'meta_key' => array( 'thumbnail', 'thumbnail' ), 'size' => 'sermons-grid','echo'=>false, ) );	
?>
		<div class="col-md-6">
			<article id="post-<?php the_ID(); ?>">
			<div class="container s-area">
				<div class="col-md-9">
				<?php the_terms(get_the_id(), 'sermon_category' ,'<h6>'.esc_html__('in ','webnus_framework'),', ','</h6>'); ?>
				</div>
				<div class="col-md-3"><div class="sermon-count"><i class="fa-eye"></i><?php echo webnus_getViews(get_the_ID()); ?></div></div>
			</div>
			<?php echo ($image)?'<figure class="sermon-img">'.$image.'</figure>':''; ?>
			<div class="container s-area">
				<div class="col-md-12">
					<h4><a href="<?php the_permalink() ?>"><?php the_title()?></a></h4>
					<div class="sermon-detail">
					<?php the_terms(get_the_id(), 'sermon_speaker' ,'<span>'.esc_html__('Speaker: ','webnus_framework'),', ','</span>'); ?>
					| <?php the_time('F d, Y'); ?></div>
					<p><?php echo webnus_excerpt(36); ?></p>
				</div>
			</div>
			<hr class="vertical-space1">
			</article>
		</div>
<?php
		echo ($count % 2 == 0)?'</div>':'';
		$count++;
	endwhile;
else:
	get_template_part('blogloop-none');
endif;
?>
<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } else {
	echo '<div class="wp-pagenavi">';
	next_posts_link(esc_html__('&larr; Previous page', 'webnus_framework'));
	previous_posts_link(esc_html__('Next page &rarr;', 'webnus_framework'));
	echo '<hr class="vertical-space">';
} ?>
</section>

<?php if ($sidebar == 'right' || $sidebar == 'both'){?>
	<aside class="col-md-3 sidebar">
		<?php dynamic_sidebar( 'Right Sidebar' ); ?>
	</aside>
<?php } ?>

</section>
<?php get_footer(); ?>