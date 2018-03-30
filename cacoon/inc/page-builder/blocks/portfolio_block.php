<?php
if(!class_exists('MET_Portfolio_Block')) {
	class MET_Portfolio_Block extends AQ_Block {

		function __construct() {
			$block_options = array(
				'name' => 'Portfolio Block',
				'size' => 'span3',
			);

			parent::__construct('MET_Portfolio_Block', $block_options);
		}

		function form($instance) {

			$defaults = array(
				'title'				=> 'RECENT WORKS',
				'item_limit' 		=> '10',
				'categories'		=> '',
				'ex_categories'		=> ''
			);
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);

			?>

			<p class="description">
				<label for="<?php echo $this->get_field_id('title') ?>">
					Title<br/>
					<?php echo aq_field_input('title', $block_id, $title) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('item_limit') ?>">
					Item Limit (required)<br/>
					<?php echo aq_field_input('item_limit', $block_id, $item_limit) ?>
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
		<?php

		}

		function block($instance) {
			extract($instance);
			if(empty($item_limit)){
				$item_limit = 10;
			}

			wp_enqueue_script('metcreative-caroufredsel');
			wp_enqueue_style('metcreative-caroufredsel');

			$widgetID = uniqid('met_portfolio_ticker_');

			$query_filter = array();
			$query_filter['post_type'] 			= 'portfolio';
			$query_filter['posts_per_page'] 	= $item_limit;

			if(!empty($categories)){
				$query_filter['tax_query'] = array(
					array(
						'taxonomy' => 'portfolio_category',
						'field' => 'id',
						'terms' => array($categories)
					)
				);

				//$query_filter['category__and'] = array($categories);
			}

			if(!empty($ex_categories)){
				$category_IDs = explode(',',$ex_categories);
				$ex_category_list = '';
				foreach($category_IDs as $category_ID){
					$ex_category_list .= $category_ID.',';
				}
				$ex_category_list = substr($ex_category_list,0,-1);

				$query_filter['tax_query'] = array(
					array(
						'taxonomy' => 'portfolio_category',
						'field' => 'id',
						'terms' => array($ex_category_list),
						'operator' => 'NOT IN'
					)
				);

				//$query_filter['cat'] = $ex_category_list;
			}
?>
			<div class="row-fluid">
				<div class="span12">
					<h2 class="met_bold_one met_title_with_pager met_clear_margin_top clearfix">
						<?php echo $title ?>
						<nav class="met_recent_works_pages"></nav>
					</h2>

					<div id="<?php echo $widgetID ?>" class="met_recent_works clearfix">
						<?php query_posts($query_filter);?>
						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
							<?php
							$thumb 			= get_post_thumbnail_id(get_the_ID());
							$img_url 		= wp_get_attachment_url($thumb,'full');
							$postThumbnail 	= aq_resize( $img_url, 270, 100, true );
							?>
							<div class="met_recent_work_item">
								<a href="<?php the_permalink() ?>" class="met_recent_work_image"><img src="<?php echo $postThumbnail ?>" alt="<?php echo esc_attr(get_the_title()) ?>"></a>
								<div class="met_recent_work_overbox met_bgcolor">
									<a href="<?php the_permalink() ?>">
										<span class="met_color2"><?php the_title() ?></span>
										<i class="icon-plus met_color2"></i>
									</a>
								</div>
							</div>
						<?php endwhile; endif; ?>

					</div>
				</div>
			</div>

			<script>
				jQuery(window).load(function(){
					if(jQuery('body').width() < 800){
						var leftUp = 'left';
						var minItem = 1;
					}else{
						var leftUp = 'up';
						var minItem = 3;
					}
					jQuery("#<?php echo $widgetID ?>").carouFredSel({
						responsive: true,
						pagination : {
							container		: jQuery('.met_recent_works_pages'),
							anchorBuilder	: function(nr) {
								return '<a href="#"><i class="icon-circle"></i></a>';
							}
						},
						circular: false,
						infinite: true,
						auto: {
							play : true,
							pauseDuration: 0,
							duration: 2000
						},
						scroll: {
							duration: 400,
							wipe: true,
							pauseOnHover: true
						},
						items: {
							visible: {
								min: minItem,
								max: 3},
							height: 'auto'
						},
						direction: leftUp,
						onCreate: function(){
							jQuery(window).trigger('resize');
						}
					});
				})
			</script>
<?php
wp_reset_query();
		}

	}
}