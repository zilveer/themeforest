<?php
	$page_id = thb_get_page_ID();
	$paged = get_query_var('paged');

	thb_post_query(array(
		'ignore_sticky_posts' => 1,
		'posts_per_page' => -1
	));

	if( !isset($paged) ) {
		$paged = 1;
	}

	$permalinks_on = get_option('permalink_structure') != '';
?>
	
<div id="timeline">
	<a href="#" class="prev"></a>
	<ul>
		<?php if( have_posts() ) : $i=1; while( have_posts() ) : the_post(); ?>
		<li class="<?php echo $i == $paged ? 'current' : ''; ?>">
			<?php
				$timeline_link = $permalinks_on ? get_pagenum_link($i) : add_query_arg( 'paged', $i );
			?>			
			<a href="<?php echo $timeline_link; ?>">
				<span><?php echo thb_get_post_icon( get_the_ID() ); ?></span>
			</a>
			<span class="popup title"><?php the_title(); ?></span>
			<span class="popup date"><?php echo get_the_date(); ?></span>
		</li>
		<?php $i++; endwhile; endif; ?>
	</ul>
	<a href="#" class="next"></a>
</div>