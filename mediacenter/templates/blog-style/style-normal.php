<?php 

global $custom_query, $wp_query;

// Check for a custom query, typically sent by a shortcode
$the_query = (!$custom_query) ? $wp_query : $custom_query;

$_wp_query = $wp_query ;
$wp_query = $the_query ;

?>
<div class="classic-blog">
	<div class="posts <?php if ( have_posts() && !is_single() ) : ?>sidemeta<?php endif;?>">
	<?php 
		if ( $the_query->have_posts() ) :
			 /* Start the Loop */ 
			while ( $the_query->have_posts() ) : $the_query->the_post();
				get_template_part( 'content', get_post_format() );
			endwhile;
		else : 
			get_template_part( 'content', 'none' );
		endif; // end have_posts() check
	?>
	</div><!-- /.posts -->
</div>

<?php $wp_query = $_wp_query ;