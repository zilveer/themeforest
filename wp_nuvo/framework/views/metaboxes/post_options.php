<div id="cs-blog-loading" class="cs_loading" style="display: block;">
	<div id="followingBallsG">
	<div id="followingBallsG_1" class="followingBallsG">
	</div>
	<div id="followingBallsG_2" class="followingBallsG">
	</div>
	<div id="followingBallsG_3" class="followingBallsG">
	</div>
	<div id="followingBallsG_4" class="followingBallsG">
	</div>
	</div>
</div>
<div id="cs-blog-metabox" class='cs_metabox' style="display: none;">
	<div id="cs-tab-blog" class='categorydiv'>
	<ul class='category-tabs'>
	   <li class='cs-tab'><a href="#tabs-general"><i class="dashicons dashicons-admin-settings"></i> <?php echo esc_html_e('GENERAL','wp_nuvo');?></a></li>
 	</ul>
 	<div class='cs-tabs-panel'>
 		<div id="tabs-general">
 			<?php
 			cs_options(array(
     			'id' => 'sub_title',
     			'label' => esc_html__('Sub Title', 'wp_nuvo'),
     			'type' => 'text'
 			));
 			cs_options(array(
     			'id' => 'post_icon',
     			'label' => esc_html__('Post icon', 'wp_nuvo'),
     			'type' => 'icon'
 			));
			?>
 		</div>
	</div>
	</div>
</div>
<div id="field_icon" style="display: none;"></div>