<?php
$vid_url = get_field('video_url',$post->ID); 
$embed = wp_oembed_get($vid_url);

if(!empty($_POST)) {
	die($embed);
}

get_header();
?>

<?php
$archive_page = get_iron_option('page_for_videos');
$archive_page = ( empty($archive_page) ? false : post_permalink($archive_page) );





/**
 * Setup Dynamic Sidebar
 */

list( $has_sidebar, $sidebar_position, $sidebar_area ) = setup_dynamic_sidebar( $post->ID );

?>

		<!-- container -->
		<div class="container">
		<div class="boxed">

		<?php
		$single_title = get_iron_option('single_video_page_title');
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
		if ( $has_sidebar ) :
?>
			<div id="twocolumns" class="content__wrapper<?php if ( 'left' === $sidebar_position ) echo ' content--rev'; ?>">
				<div id="content" class="content__main">
<?php
		endif;

if ( have_posts() ) :
	while ( have_posts() ) : the_post();
?>
					<!-- single-post video-post -->
					<div id="post-<?php the_ID(); ?>" <?php post_class('single-post video-post'); ?>>
					
						<?php if(!empty($vid_url)): ?>
						<!-- video-block -->
						<div class="video-block">
							<?php 
								echo $embed;
							?>
						</div>
						<?php endif; ?>
						
						<h4><?php the_title(); ?></h4>

						<div class="entry">
							<?php the_content(); ?>
							<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', IRON_TEXT_DOMAIN ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
						</div>

<?php	get_template_part('parts/share'); ?>

<?php	comments_template(); ?>
					</div>
<?php
	endwhile;
endif;

if ( $has_sidebar ) :
?>
				</div>

				<aside id="sidebar" class="content__side widget-area widget-area--<?php echo esc_attr( $sidebar_area ); ?>">
<?php
	do_action('before_ironband_sidebar_dynamic_sidebar', 'single-video.php');

	dynamic_sidebar( $sidebar_area );

	do_action('after_ironband_sidebar_dynamic_sidebar', 'single-video.php');
?>
				</aside>
			</div>
<?php
endif;
?>
			</div>
		</div>
	
<?php get_footer(); ?>