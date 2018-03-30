<?php
/**
 * This file is part of the BTP_FaderTheme package.
 *
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code. *
 */



/* Prevent direct script access */
if ( !defined( 'BTP_FRAMEWORK_VERSION' ) ) exit( 'No direct script access allowed' );



/**
 * Gets related records ids based on relation tags
 * 
 * @param 			int $post_id
 * @param 			string $post_type
 * @param 			int $limit
 */
function btp_relations_get_related_ids( $post_id, $post_type, $limit ) {
	global $post, $wpdb;
			
	if( !$post_id )
		$post_id = $post ? $post->ID : 0;

	/* Post ID must be positive number*/	
	$post_id = absint($post_id);
	if($post_id <= 0)
		return array();
	
	$post_type = preg_replace('/[^0-9a-zA-Z_-]*/', '', $post_type);		
		
	$limit = absint($limit);

	$relation_tags = get_the_terms($post_id, 'btp_relation_tag');
	
	if( $relation_tags && count( $relation_tags ) ) {	
		/* Prepare tag_ids for further query */
		$tag_ids = array();
		foreach($relation_tags as $pt) 
			$tag_ids[] = (int)$pt->term_taxonomy_id;

		$tag_ids = implode(',', $tag_ids);
		
		/* Custom SQL query.
	  	 * Standard query_posts function doesn't have enough power to produce results we need */
		$btp_query =	"SELECT p.ID, COUNT(t_r.object_id) AS cnt " 						// get post ids and count
		 					."FROM $wpdb->term_relationships AS t_r, $wpdb->posts AS p "			
		          			."WHERE t_r.object_id = p.id " 									// build relations
		            			."AND t_r.term_taxonomy_id IN($tag_ids) " 					// only with the same tags
		            			."AND p.post_type='$post_type' "							
		            			."AND p.id != $post_id " 										// only other posts, not the post selfe
		            			."AND p.post_status='publish' " 							// only published posts
		          			."GROUP BY t_r.object_id " 										// group by relation
		          			."ORDER BY cnt DESC, p.post_date_gmt DESC " 					// order by count best matches first, and by date within same count
		          			."LIMIT $limit "; 												// get only the top x

		
		/* Run the query */
  		$btp_posts = $wpdb->get_results( $btp_query );
  		  			  			
  		if ( count( $btp_posts ) ) {
  			$related_ids = array();
			foreach($btp_posts as $p)
				$related_ids[] = (int)$p->ID;
				
			return $related_ids;	
  		}
	}
			
	return array();
}



function btp_relations_init() {
	global $_wp_post_type_features;
 	$apply = array();

 	/* Get appliable post types */
	foreach( $_wp_post_type_features as $k => $v ) {		
		if ( isset ( $v[ 'btp-relations' ] ) ) {
			$apply[ $k ] = true;
		}	
	}	
	
	/* Register btp_relation_tag for all appliable post types  */
	foreach ( $apply as $post_type => $bool ) {
		register_taxonomy_for_object_type( 'btp_relation_tag', $post_type ); 
	}
}
add_action( 'init', 'btp_relations_init', 20 );


function btp_relations_alter_relation_tags_meta_box() {
	global $_wp_post_type_features;
	$apply = array();
	
	/* Get appliable post types */
	foreach( $_wp_post_type_features as $k => $v ) {		
		if ( isset ( $v[ 'btp-relations' ] ) ) {
			$apply[ $k ] = true;
		}	
	}	
	
	global $wp_meta_boxes;

	foreach ( $apply as $post_type => $bool ) {
		if ( 
			isset ( $wp_meta_boxes[ $post_type ] ) && 
			isset ( $wp_meta_boxes[ $post_type ][ 'side' ] ) &&
			isset ( $wp_meta_boxes[ $post_type ][ 'side' ][ 'core' ] ) &&
			isset ( $wp_meta_boxes[ $post_type ][ 'side' ][ 'core' ][ 'tagsdiv-btp_relation_tag' ] )
		) {		
			$wp_meta_boxes[$post_type]['side']['core']['tagsdiv-btp_relation_tag']['callback'] = 'btp_relations_relation_tags_meta_box';
		}
	} 	
}
add_action( 'do_meta_boxes', 'btp_relations_alter_relation_tags_meta_box' );



/**
 * Wrapper for displaying relation tags metabox
 *   
 * @param unknown_type $post
 * @param unknown_type $box
 */
function btp_relations_relation_tags_meta_box($post, $box) {
	post_tags_meta_box($post, $box);	
	?>	
	<p><strong><a id="how-to-use-relation-tags-title" href="#"><?php _e( 'How to use relation tags?', 'btp_theme'); ?></a></strong></p>
	<div id="how-to-use-relation-tags-content">
		<div style="padding: 9px 0;">
			<p>			
			<?php
				echo
					'<p>' . __( 'The relation tags are not displayed anywhere - use them to relate different content (posts, pages, etc.), so that you can benefit from special shortcodes ([related_posts], [related_pages], etc.) or widgets .', 'btp_theme' ) . '</p>' .
					'<p>' . __( 'It is strongly advised to prepend every relation tag with the <strong>r-</strong> prefix, to clearly differentiate these tags, thus keep their slugs unique.', 'btp_theme' ) . '</p>' .
					'<p><strong>' . __( 'Here is a sample usage:', 'btp_theme' ) . '</strong></p>' .
					'<ol>' .
						'<li>' . __( 'Assign the r-home tag to your home page.', 'btp_theme' ) . '</li>' .
						'<li>' . __( 'Assign the r-home tag to some blog posts.', 'btp_theme' ) . '</li>' .
						'<li>' . __( 'Insert the [related_posts] shortcode into the content editor, when editing the home page.', 'btp_theme' ) . '</li>' .
						'<li>' . __( 'Save changes and all related posts will be on your home page.', 'btp_theme'  ) . '</li>' .
					'</ol>' .
					'<p>' . __( 'The relation tags are built using custom taxonomy functionality, so they are separated from the standard WordPress tags.', 'btp_theme' ) . '</p>' ;
				?>
			</p>
		</div>	
	</div>	
	<?php
}
?>