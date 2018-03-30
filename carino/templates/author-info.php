<?php  
/**
* Author info Template. 
* PLEASE DO NOT MODIFY THIS FILE
*
* @author : VanThemes ( http://www.vanthemes.com )
* 
*/
?>
<div class="author-info row clearfix">

	<div class="author-avatar-container">	
		<div class="author-avatar">
			<?php echo get_avatar( get_the_author_meta('ID'), 80 ); ?>
		</div>
	</div><!-- .author-avatar-container -->

	<div class="author-desc content">

		<h3 class="row-title"><?php printf( __( "Written by %s", "van" ),  get_the_author() ); ?></h3>

		<?php if ( get_the_author_meta('description') ): ?>
			<p><?php the_author_meta('description'); ?></p>				
		<?php endif ?>

			<p class="author-links vcard">
				<strong>
					<?php printf( __( 'View all articles by <a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a>' , 'van' ), esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ), esc_attr( sprintf( __( 'View all posts by %s', 'van' ), get_the_author() ) ), get_the_author() ); ?>
				</strong>
			</p>
		
		<?php if ( get_the_author_meta( 'url' ) ): ?>
			<p class="author-links"><strong><?php _e('Website: ', 'van') ?></strong><a  href="<?php echo esc_url( get_the_author_meta('url') ); ?>" title="<?php esc_attr( get_the_author_meta('display_name') ) . ' ' . esc_attr__( "Website", 'van' ); ?>"><?php the_author_meta('url'); ?></a></p>				
		<?php endif; ?>

		<?php van_author_social(); ?>

	</div><!-- .author-desc -->

</div><!-- .author-info -->