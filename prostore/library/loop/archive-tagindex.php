<?php
/**
 * Theme Name: proStore
 * Theme URI: http://themeforest.net/user/gnrocks/portfolio
 * Theme demo : http://rchour.net/prostore
 * Description: A WordPress premium theme exclusively for sale on ThemeForest
 *
 * Author: gnrocks
 * Author URI: http://themeforest.net/user/gnrocks
 * License : http://codex.wordpress.org/GPL & http://wiki.envato.com/support/legal-terms/licensing-terms/
 *
 *
 * @package 	proStore/library/loop/archive-tagindex.php
 * @file	 	1.0
 */
?>
<?php 

	$list = '';
	$lettre='';
	$tags = get_terms( array('post_tag','product_tag') );
	$groups = array();
	if( $tags && is_array( $tags ) ) {
		foreach( $tags as $tag ) {
			$first_letter = strtoupper( $tag->name[0] );
			$groups[ $first_letter ][] = $tag;
		}
		if( !empty( $groups ) ) {
			foreach( $groups as $letter => $tags ) {
				$letter_temp = apply_filters( 'the_title', $letter );
				$lettre .= "\n\t" . '<dd data-magellan-arrival="'.$letter_temp.'"><a href="#' . $letter_temp  . '">' . $letter_temp . '</a></dd>';
				$list .= "\n\t" . '<li data-magellan-destination="'.$letter_temp.'" id="'.$letter_temp.'"><h5>'.$letter_temp.'</h5>';
				$list .= "\n\t" . '<ul class="tags">';
				foreach( $tags as $tag ) {
					$url = esc_attr( get_tag_link( $tag->term_id ) );
					$count = intval( $tag->count );
					$name = apply_filters( 'the_title', $tag->name );
					$list .= "\n\t\t" . '<li><a href="' . $url . '">' . $name . '</a> (' . $count . ')</li>';
					}
				$list .= "\n\t" . '</ul></li>';
			}
		}
	} else $list .= "\n\t" . '<p>Sorry, but no tags were found</p>';					
?>		

<dl id="magellanTopNav" class="sub-nav clearfix" data-magellan-expedition="fixed" style="">
    <dt>Index</dt>
<?php echo $lettre; ?>
</dl>	

<div class="tag-index">
	<ul data-magellan-expedition>
		<?php print $list; ?>	
	</ul>
</div>