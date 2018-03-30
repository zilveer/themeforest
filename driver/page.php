<?php

get_header();
?>

<?php
global $post;

/**
 * Setup Dynamic Sidebar
 */

list( $has_sidebar, $sidebar_position, $sidebar_area ) = setup_dynamic_sidebar( $post->ID );

$hide_page_title = get_field('hide_page_title', $post->ID);

?>

<?php
if ( have_posts() ) :
	while ( have_posts() ) : the_post();
?>
		<!-- container -->
		<div class="container">
		<?php $content = get_the_content($post->ID);
		$boxed = false;
		if(strpos($content,'vc_row') == false){
			$boxed = true;
		}
		?>
		<?php 
		if($has_sidebar || $boxed){
			?>
			<div class="boxed">
			<?php
		}
		?>
			<!-- breadcrumbs -->
			<?php 
			
			if(empty($hide_page_title)) {
				if(is_page_title_uppercase() == true){
					echo '<div class="page-title uppercase">';
				} else {
					echo '<div class="page-title">';
				};
				echo '<span class="heading-t"></span>';
					the_title('<h1>','</h1>');
				iron_page_title_divider();
			echo '</div>';
			}  
			?>
<?php
		if ( $has_sidebar ) :
?>
			<div class="content__wrapper<?php if ( 'left' === $sidebar_position ) echo ' content--rev'; ?>">
				<article id="post-<?php the_ID(); ?>" <?php post_class('content__main single-post'); ?>>
<?php
		else:
?>
			<article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>
<?php
		endif;
?>
				<?php the_post_thumbnail( array(696, 353), array( 'class' => 'wp-featured-image' ) ); ?>

				<div class="entry">
					<?php the_content(); ?>
					<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', IRON_TEXT_DOMAIN ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
				</div>
				
				<?php comments_template(); ?>

<?php	//get_template_part('parts/share'); ?>

<?php
		//comments_template();

		if ( $has_sidebar ) :
?>
				</article>

				<aside id="sidebar" class="content__side widget-area widget-area--<?php echo esc_attr( $sidebar_area ); ?>">
<?php
			do_action('before_ironband_sidebar_dynamic_sidebar', 'page.php');

			dynamic_sidebar( $sidebar_area );

			do_action('after_ironband_sidebar_dynamic_sidebar', 'page.php');
?>
				</aside>
			</div>
<?php
		else:
?>
			</article>
<?php
		endif;
?>
	<?php 
		if($has_sidebar || $boxed){
			?>
			</div>
			<?php
		}
		?>
		</div>

<?php
	endwhile;
endif;
get_footer();