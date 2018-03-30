<?php
/**
 * The Template Part for displaying page navigation.
 *
 * @package BTP_Flare_Theme
 */
?>
<nav class="side-nav">											
	<?php 
		global $post;	

		if ( $post->post_parent ) {
			$ancestors = get_post_ancestors( $post->ID );			
			$parent = array_pop( $ancestors );
		} else {
			$parent = $post->ID;
		}
	?>
	<ul class="menu">
		<?php wp_list_pages( 'title_li=&link_before=<span>&link_after=</span>&include=' . $parent ); ?>	
		<?php wp_list_pages( 'title_li=&link_before=<span>&link_after=</span>&child_of='. $parent ); ?>
	</ul>				
</nav>	