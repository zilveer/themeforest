<?php get_header(); ?>
		<!-- container -->
		<div class="container">
		<div class="boxed">
		
		<?php
		if ( have_posts() ) :
			while ( have_posts() ) : the_post();
		?>
		
		<?php
		$single_title = get_iron_option('single_event_page_title');
		if(!empty($single_title)): 
		?>
		<?php
			if(is_page_title_uppercase() == true){
				echo '<div class="page-title uppercase">';
			} else {
				echo '<div class="page-title">';
			};
		?>
			<span class="heading-t"></span>
				<h1><?php echo esc_html($single_title); ?></h1>
			<?php
				iron_page_title_divider();
			?>
		</div>
		<?php else: ?>
			
			<div class="heading-space"></div>
			
		<?php endif; ?>
	
		<?php
		list( $has_sidebar, $sidebar_position, $sidebar_area ) = setup_dynamic_sidebar( $post->ID );

		if ( $has_sidebar ) :
?>
			<div id="twocolumns" class="content__wrapper<?php if ( 'left' === $sidebar_position ) echo ' content--rev'; ?>">
				<div id="content" class="content__main">
<?php
		endif;
?>


			<!-- single-post -->
			<article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>
				<div class="entry">
					<div class="event-wrapper">
					<?php
					if ( has_post_thumbnail() ) {
					?>
						<div class="lefthalf">
							<?php the_post_thumbnail('full'); ?> 
						</div>
					<?php
					};
					?>
						<div class="righthalf">
							<div class="event-boldtitle"><?php the_title(); ?><br></div>
							<table>
								<?php
								$showtime = (bool)get_field('event_show_time');
								$city = get_field('event_city');
								?>
								
								<tr>
									<td class="event-icon"><i class="fa fa-calendar"></i></td>
									<td><?php echo get_the_date(); ?></td>
								</tr>
								
								<?php if( !empty($showtime) ) { ?>
								<tr>
									<td class="event-icon"><i class="fa fa-clock-o"></i></td>
									<td><?php echo get_the_time(); ?></td>
								</tr>
								<?php } ?>
								
								<?php				
								if ( !empty($city) ) { 
								?>
								<tr>
									<td class="event-icon"><i class="fa fa-globe"></i></td>
									<td><?php the_field('event_city'); ?></td>
								</tr>
								<?php } ?>
								
								<?php $venue = get_field('event_venue');?>
								<?php if(!empty($venue)): ?>
								<tr>
									<td class="event-icon"><i class="fa fa-arrow-down"></i></td>
									<td><?php the_field('event_venue'); ?></td>
								</tr>
								<?php endif; ?>
								<?php $gmap = get_field('event_map');?>
								<?php if(!empty($gmap)): ?>
								<tr>
									<td class="event-icon"><i class="fa fa-map-marker"></i></td>
									<td><a class="event-map-link" href="<?php echo esc_url($gmap); ?>" target="_blank"><?php the_field('event_map_label'); ?></a></td>
								</tr>
								<?php endif; ?>
							</table>
							<?php $iftickets = get_field('event_link');?>
							<?php if(!empty($iftickets)): ?>
							<a class="button" target="_blank" href="<?php the_field('event_link'); ?>"><?php the_field('event_action_label'); ?></a>
							<?php endif; ?>
							<?php the_content(); ?>
						</div>
						<div class="clear"></div>
					</div>
					
					<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', IRON_TEXT_DOMAIN ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
				</div>
			</article>
			
			<?php	get_template_part('parts/share'); ?>
			<?php	comments_template(); ?>
		
<?php
		if ( $has_sidebar ) :
?>
				</div>

				<aside id="sidebar" class="content__side widget-area widget-area--<?php echo esc_attr( $sidebar_area ); ?>">
<?php
	do_action('before_ironband_sidebar_dynamic_sidebar', 'single-event.php');

	dynamic_sidebar( $sidebar_area );

	do_action('after_ironband_sidebar_dynamic_sidebar', 'single-event.php');
?>
				</aside>
			</div>
<?php
		endif;
?>		

<?php
			endwhile;
		endif;
		?>
		
		</div>
		</div>
		
<?php get_footer(); ?>