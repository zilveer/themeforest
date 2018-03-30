<?php /* Template Name: Questions Categories */
get_header();
	$vbegy_sidebar_all = rwmb_meta('vbegy_sidebar','radio',$post->ID);?>
	<div class="page-content page-content-user-profile">
		<div class="user-profile-widget">
			<h2><?php the_title();?></h2>
			<div class="ul_list ul_list-icon-ok">
				<ul>
					<?php $args = array(
					'child_of'                 => 0,
					'parent'                   => '',
					'orderby'                  => 'name',
					'order'                    => 'ASC',
					'hide_empty'               => 0,
					'hierarchical'             => 1,
					'exclude'                  => '',
					'include'                  => '',
					'number'                   => '',
					'taxonomy'                 => 'question-category',
					'pad_counts'               => false );
					$options_categories = get_categories($args);
					foreach ($options_categories as $category) {
						$get_question_category = get_option("questions_category_".$category->term_id);?>
						<li><i class="icon-question-sign"></i><?php echo (isset($get_question_category['private']) && $get_question_category['private'] == "on"?'<i class="icon-lock"></i>':'')?><a href="<?php echo get_term_link($category->slug,'question-category')?>"><?php echo $category->name?><span> ( <span><?php echo $category->count." ".__("Questions","vbegy")?></span> ) </span></a></li>
					<?php }?>
				</ul>
			</div>
		</div><!-- End user-profile-widget -->
	</div><!-- End page-content -->
	<?php
get_footer();?>