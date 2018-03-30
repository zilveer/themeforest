<?php

/**
 * Archive Forum Content Part
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<div id="bbpress-forums">
	
	<div id="main_content">
	
	<?php if ( bbp_allow_search() ) : ?>

		<div class="bbp-search-form">

			<?php bbp_get_template_part( 'form', 'search' ); ?>

		</div>

	<?php endif; ?>

	<?php bbp_forum_subscription_link(); ?>

	<?php do_action( 'bbp_template_before_forums_index' ); ?>
	
	<?php
	$forum_cats = wd_get_forum_categories();
	if( bbp_has_forums() ){
		if( count($forum_cats) > 0 ){ // Have category
			foreach( $forum_cats as $forum_cat ){
				global $forum_cat_name;
				$forum_cat_name = $forum_cat->name;
				$agrs['tax_query'] = array(
										array(
											'taxonomy'	=> 'forum_cat'
											,'terms'	=> $forum_cat->slug
											,'field'	=>'slug'
										)
									); 
				if ( bbp_has_forums($agrs) ){
					 bbp_get_template_part( 'loop',     'forums'    );  
				}
			}
		}
		else{ // No category
			if ( bbp_has_forums() ){
				bbp_get_template_part( 'loop',     'forums'    );  
			}
		}
		
	} else {
		bbp_get_template_part( 'feedback', 'no-forums' ); 
	}
	?>

	<?php do_action( 'bbp_template_after_forums_index' ); ?>
	</div>

</div>
