<?php
/**
 * The Template Part for displaying work category navigation.
 *
 * @package BTP_Flare_Theme
 */
?>
<nav class="side-nav">
	<?php
		$args = array(
		  'taxonomy'     => 'btp_work_category',
		  //'orderby'      => $orderby,
		  'show_count'   => false,
		  'pad_counts'   => false,
		  'hierarchical' => true,
		  'title_li'     => '',
		  'echo'		=> false
		);
		
		$label = get_post_type_object( 'btp_work' );
		$label = $label->labels->all_items;
		$label = htmlspecialchars( strip_tags( $label ) );
	?>	
	<ul class="menu">
		<li><a href="<?php echo get_post_type_archive_link( 'btp_work' ); ?>"><?php echo $label; ?></a></li>						
		<?php echo str_replace( array('<span>', '</span>'), array('', ''), wp_list_categories( $args ) ); ?>
	</ul>
</nav>