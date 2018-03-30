<?php
if(!class_exists('MET_Blog_List_Vertical')) {
	class MET_Blog_List_Vertical extends AQ_Block {

		function __construct() {
			$block_options = array(
				'name' => 'Blog List Vertical',
				'size' => 'span3',
			);

			parent::__construct('MET_Blog_List_Vertical', $block_options);
		}

		function form($instance) {

			$defaults = array(
				'item_limit' 			=> '6',
				'excerpt_limit'			=> '10',
				'excerpt_more'			=> '…',
				'title_sub'				=> 'News',
				'widget_title'			=> 'Company',
				'categories'			=> '',
				'ex_categories'			=> '',
				'arrow_position'		=> '0'
			);
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);

			$bool_options = array('false' => 'FALSE' , 'true' => 'TRUE');

			?>

			<p class="description">
				<label for="<?php echo $this->get_field_id('widget_title') ?>">
					Title<br/>
					<?php echo aq_field_input('widget_title', $block_id, $widget_title) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('title_sub') ?>">
					Title (Secondary)<br/>
					<?php echo aq_field_input('title_sub', $block_id, $title_sub) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('item_limit') ?>">
					Item Limit (required)<br/>
					<?php echo aq_field_input('item_limit', $block_id, $item_limit) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('excerpt_limit') ?>">
					Excerpt Word Limit<br/>
					<?php echo aq_field_input('excerpt_limit', $block_id, $excerpt_limit) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('excerpt_more') ?>">
					Excerpt More Text<br/>
					<?php echo aq_field_input('excerpt_more', $block_id, $excerpt_more) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('categories') ?>">
					Category IDs (Ex: 1,2,3)<br/>
					<?php echo aq_field_input('categories', $block_id, $categories) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('ex_categories') ?>">
					Exclude Category IDs (Ex: 1,2,3)<br/>
					<?php echo aq_field_input('ex_categories', $block_id, $ex_categories) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('arrow_position') ?>">
					Arrow Position<br/>
					<?php echo aq_field_select('arrow_position', $block_id, array('0' => 'Left', '1' => 'Right'), $arrow_position) ?>
				</label>
			</p>

		<?php

		}

		function block($instance) {
			extract($instance);
			if(empty($item_limit)){
				$item_limit = 6;
			}

			$widgetID = uniqid('met_blog_vertical_list_');

			$query_filter = array();
			$query_filter['posts_per_page'] = $item_limit;

			if(!empty($categories)){
				$query_filter['category__and'] = array($categories);
			}

			if(!empty($ex_categories)){
				$category_IDs = explode(',',$ex_categories);
				$ex_category_list = '';
				foreach($category_IDs as $category_ID){
					$ex_category_list .= '-'.$category_ID.',';
				}
				$ex_category_list = substr($ex_category_list,0,-1);

				$query_filter['cat'] = $ex_category_list;
			}

			if(empty($arrow_position) OR !isset($arrow_position)){
				$arrow_position = 0;
			}
?>

			<div class="row-fluid">
				<div class="span12">
					<div id="<?php echo $widgetID ?>" class="met_cacoon_sidebar met_color2 met_bgcolor3 clearfix <?php if($arrow_position=='1'): ?>met_right_triangle<?php endif; ?>">
						<?php if(!empty($widget_title)): ?><h2 class="met_title_stack"><?php echo $widget_title ?></h2><?php endif;?>
						<?php if(!empty($widget_title)): ?><h2 class="met_title_stack met_bold_one"><?php echo $title_sub ?></h2><?php endif;?>

						<div class="met_cacoon_sidebar_wrapper">
							<?php query_posts($query_filter); ?>
							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
							<?php
								$post_date = get_the_date('d-F');
								$post_date = explode('-',$post_date);
								$post_day = $post_date[0];
								$post_month = $post_date[1];
							?>
							<div class="met_cacoon_sidebar_item clearfix">
								<div class="met_dated_blog_posts">
									<span class="met_date met_color"><?php echo $post_day ?></span>
									<span class="met_month met_color"><?php echo $post_month ?></span>
									<article>
										<a href="<?php the_permalink() ?>"><h3 class="met_color2"><?php the_title() ?></h3></a>
										<p><?php echo wp_trim_words( get_the_excerpt(),  $excerpt_limit, $excerpt_more ); ?></p>
									</article>
								</div>
							</div>
							<?php endwhile; endif; ?>
						</div>
					</div>
				</div>
			</div>

<?php
			wp_reset_query();
		}

	}
}