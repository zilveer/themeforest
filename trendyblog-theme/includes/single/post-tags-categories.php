<?php
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	wp_reset_query();

	//post tags
	$posttags = get_the_tags();
	$tagCount = count($posttags);

	$categories = get_the_category();
	$catCount = count($categories);
?>
	<?php if (($posttags && df_option_compare('post_tag_single','post_tag',$post->ID)==true) || ($categories && df_option_compare('postCategory','postCategory',$post->ID)==true)) { ?>
        <div class="bottom_wrapper">
        	<?php if ($posttags && df_option_compare('post_tag_single','post_tag',$post->ID)==true) { ?>
	            <!-- Entry tags -->
	            <div class="entry_tags">
	                <span><i class="fa fa-tags"></i> <?php esc_html_e('Tags', THEME_NAME);?></span>
					<?php	
						$i = 1;
						foreach($posttags as $tag) {
							echo '<a href="'.esc_url(get_tag_link($tag->term_id)).'">'.$tag->name . '</a>';
							//if($tagCount!=$i) { echo ", "; }
							$i++;
						}
					?>
	            </div><!-- End Entry tags -->
            <?php } ?>
            <?php if ($categories && df_option_compare('postCategory','postCategory',$post->ID)==true) { ?>
	            <!-- Entry categories -->
	            <div class="entry_tags categories">
	                <span><i class="fa fa-folder-open"></i> <?php esc_html_e('Category', THEME_NAME);?></span>
					<?php	
						$i=1;
						foreach($categories as $cat) {
							echo '<a href="'.esc_url(get_category_link($cat->term_id)).'">'.$cat->name . '</a>'; 
							//if($catCount!=$i) { echo ", "; }
							$i++;
						}
					?>
	            </div><!-- End Entry categories -->
	        <?php } ?>
        </div>
	<?php } ?>