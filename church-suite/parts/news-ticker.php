<?php
$webnus_options = webnus_options();
$webnus_options['webnus_nt_show'] = isset( $webnus_options['webnus_nt_show'] ) ? $webnus_options['webnus_nt_show'] : '';
if( $webnus_options['webnus_nt_show'] || ( !$webnus_options['webnus_nt_show'] && (is_home() || is_front_page() )) ):
	$webnus_options['webnus_nt_title'] = isset( $webnus_options['webnus_nt_title'] ) ? $webnus_options['webnus_nt_title'] : '';
	$webnus_options['webnus_nt_cat'] = isset( $webnus_options['webnus_nt_cat'] ) ? $webnus_options['webnus_nt_cat'] : '';
	$webnus_options['webnus_nt_count'] = isset( $webnus_options['webnus_nt_count'] ) ? $webnus_options['webnus_nt_count'] : '';
	$webnus_options['webnus_nt_effect'] = isset( $webnus_options['webnus_nt_effect'] ) ? $webnus_options['webnus_nt_effect'] : '';
	$webnus_options['webnus_nt_speed'] = isset( $webnus_options['webnus_nt_speed'] ) ? $webnus_options['webnus_nt_speed'] : '';
	$webnus_options['webnus_nt_pause'] = isset( $webnus_options['webnus_nt_pause'] ) ? $webnus_options['webnus_nt_pause'] : '';
	$title = $webnus_options['webnus_nt_title'];
	$cat = $webnus_options['webnus_nt_cat'];
	$count = $webnus_options['webnus_nt_count'];
	$effect= (!$webnus_options['webnus_nt_effect']);
	$speed = $webnus_options['webnus_nt_speed'];
	$pause = $webnus_options['webnus_nt_pause'];

	if(!$count || $count == ' ' || !is_numeric($count)) $count = 5;
	if(!$effect) $effect = 'reveal';
	if(!$speed || $speed == ' ' || !is_numeric($speed)) $speed = 1 ;
	if(!$pause || $pause == ' ' || !is_numeric($pause)) $pause = 1;
	
?>	
	<div class="news-ticker">
		<div class="container">
			<?php
			global $post;
			$args=array('category__in' => $cat, 'posts_per_page'=> $count, 'no_found_rows' => 1 );
			$breaking_query = new wp_query( $args  );
			if( $breaking_query->have_posts() ):
			?>
			<ul id="js-news">
			<?php while( $breaking_query->have_posts() ) : $breaking_query->the_post();?>
				<li><a href="<?php the_permalink()?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
			<?php endwhile; ?>
			</ul>
			<?php endif;
			wp_reset_postdata();
			?>
			<script type="text/javascript">
			jQuery(function () {
					jQuery('#js-news').ticker({
					speed: '<?php echo $speed/10 ?>',
					debugMode: false,
					controls: false,
					titleText: '<?php echo esc_html($title) ?>',
					displayType: '<?php echo $effect ?>',
					direction: '<?php echo(is_rtl())?'rtl':'ltr'; ?>',
					pauseOnItems: '<?php echo $pause*1000 ?>',
					fadeInSpeed: '<?php echo $speed*200 ?>',
					fadeOutSpeed: '<?php echo $speed*100 ?>',
				});
			});
			</script>
		</div>
	</div>
<?php endif; ?>