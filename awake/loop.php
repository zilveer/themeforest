<?php
/**
 * The loop that displays posts.
 *
 * @package Mysitemyway
 * @subpackage Template
 */

global $mysite;
$layout = $mysite->layout['blog'];
$post_content = ( mysite_get_setting( 'display_full' ) ? 'full' : '' );

?><?php if ( have_posts() ) :

$i=1;
?><?php echo ( $layout['blog_layout'] == 'blog_layout2' ? '<ul class="' . $layout['main_class'] . '">' : '<div class="' . $layout['main_class'] . '">');

	?><?php mysite_featured_post(); while ( have_posts() ) : the_post();
	
	if( $layout['blog_layout'] == 'blog_layout3' ) :
	?><div class="<?php echo ( $i%$layout['columns_num'] == 0 ) ? $layout['columns'] . ' last' : $layout['columns']; ?>"><?php endif;
		
	if( $layout['blog_layout'] == 'blog_layout2' ) :
	?><li id="post-<?php the_ID(); ?>" <?php post_class( $layout['post_class'] ); ?>><?php else :
	?><div id="post-<?php the_ID(); ?>" <?php post_class( $layout['post_class'] ); ?>><?php endif;
	
	?><?php mysite_before_post( array( 'post_id' => get_the_ID() ) ); ?>
	
		<div class="<?php echo $layout['content_class']; ?>">
			
			<?php mysite_before_entry(); ?>

			<div class="post_excerpt">
				<?php mysite_post_content( array( 'blog_layout' => $layout['blog_layout'], 'post_content' => $post_content ) ); ?>
			</div>
			
			<?php mysite_after_entry(); ?>
	
		</div><!-- .content_class -->
		
	<?php if( $layout['blog_layout'] == 'blog_layout2' ) :
	?></li><!-- #post-## --><?php else :
	?></div><!-- #post-## --><?php endif;
	
	if( $layout['blog_layout'] == 'blog_layout3' ) :
	?></div><?php endif;
	
	if( ( $layout['blog_layout'] == 'blog_layout3' ) && ( $i%$layout['columns_num'] == 0 ) ) :
	?><div class="clearboth"></div><?php endif; ?>
	
<?php $i++; ?>

<?php endwhile; // End the loop. ?>

<?php echo ( $layout['blog_layout'] == 'blog_layout2' ? '</ul>' : '</div>' ); ?>

<?php if( $layout['blog_layout'] == 'blog_layout3' ) remove_filter( 'post_limits', 'my_post_limit' ); ?>

<?php mysite_after_post(); ?>

<?php else : ?>
	
	<?php mysite_404( $post = true ); ?>

<?php endif; ?>