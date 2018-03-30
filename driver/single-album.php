<?php get_header(); ?>

		<!-- container -->
		<div class="container">
		<div class="boxed">
		
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<?php
		$single_title = get_iron_option('single_album_page_title');
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


			<!-- info-section -->
			<div id="post-<?php the_ID(); ?>" <?php post_class('info-section'); ?>>
			<?php the_title('<h2>','</h2>'); ?>
				<!-- aside -->
				<div class="aside">
					<!-- image -->
					<div class="image"><?php the_post_thumbnail( array(330, 330) ); ?></div>
					<!-- buttons-block -->
<?php	if ( get_field('alb_store_list') ) : ?>
					<div class="buttons-block">
						<div class="release-date"><?php echo __("Release Date", IRON_TEXT_DOMAIN); ?>: <span><?php the_field('alb_release_date') ?></span></div>
						
						
						<div class="available-now"><?php echo __("Available now on", IRON_TEXT_DOMAIN); ?>:</div>
						<ul class="store-list">
							<?php while(has_sub_field('alb_store_list')): ?>
							<li><a class="button" href="<?php echo esc_url( get_sub_field('store_link') ); ?>"><?php the_sub_field('store_name'); ?></a></li>
							<?php endwhile; ?>
						</ul>
						
					</div>
<?php	endif; ?>
				</div>
				<!-- description-column -->
				<div class="description-column">
<?php	if ( get_field('alb_tracklist') ) : ?>

			<?php
				$atts = array(
					'albums' => array($post->ID),
					'show_playlist' => true
				);
				$uniqid = uniqid();
				$widget_id = 'arbitrary-instance-'.$uniqid;
				$jplayer_selector = '#'.$widget_id.' .jp-jplayer';
			    the_widget('Iron_Widget_Radio', $atts, array('widget_id'=>$widget_id, 'before_widget'=>'<div class="iron_widget_radio">', 'after_widget'=>'</div>'));


				$tracks = get_field('alb_tracklist');
				$store_buttons = array();
				$i = 0;
				foreach($tracks as $track) {
					
					if(!empty($track["track_store"])) {
						$store_buttons["$i"] = '<a style="display:none;" class="button" target="_blank" href="'.esc_url( $track['track_store'] ).'">'.esc_html(__($track['track_buy_label'], IRON_TEXT_DOMAIN)).'</a>';
					}
					$i++;
				}
				
				$store_buttons = json_encode($store_buttons);
			
			?>
			
			<script>
			jQuery(document).ready(function() {
				setTimeout(function() {
					IRON.setTracksBuyButtons(<?php echo esc_js($store_buttons); ?>);
				},3000);
			});
			</script>
			
<?php	endif; ?>

<?php	if ( get_the_content() ) : ?>
					<!-- content-box -->
					<section class="content-box">
						<div class="entry">
							<?php the_content(); ?>
							<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', IRON_TEXT_DOMAIN ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
						</div>
					</section>
<?php	endif; ?>

<?php	if ( get_field('alb_review') ) : ?>
					<!-- content-box -->
					<section class="content-box">
						<h4><?php _e('Album Review', IRON_TEXT_DOMAIN); ?></h4>
<?php		if ( get_field('alb_review') || get_field('alb_review_author') ) : ?>
			<!-- blockquote-box -->
						<figure class="blockquote-block">
<?php			if ( get_field('alb_review') ) : ?>
							<blockquote><?php the_field('alb_review'); ?></blockquote>
<?php
				endif;

				if ( get_field('alb_review_author') ) :
?>
							<figcaption>- <?php the_field('alb_review_author'); ?></figcaption>
<?php
			endif;
?>
						</figure>
<?php		endif; ?>
					</section>
<?php	endif; ?>

<?php	get_template_part('parts/share'); ?>

<?php	comments_template(); ?>
				</div>
			</div>
<?php
		if ( $has_sidebar ) :
?>
				</div>

				<aside id="sidebar" class="content__side widget-area widget-area--<?php echo esc_attr( $sidebar_area ); ?>">
<?php
	do_action('before_ironband_sidebar_dynamic_sidebar', 'single-album.php');

	dynamic_sidebar( $sidebar_area );

	do_action('after_ironband_sidebar_dynamic_sidebar', 'single-album.php');
?>
				</aside>
			</div>
<?php
		endif;
?>
		
<?php endwhile; endif; ?>

		</div>
		</div>

<?php get_footer(); ?>