<?php
if(!class_exists('MET_Portfolio')) {
	class MET_Portfolio extends AQ_Block {

		function __construct() {
			$block_options = array(
				'name' => 'Portfolio Listing',
				'size' => 'span12'
			);

			parent::__construct('MET_Portfolio', $block_options);
		}

		function form($instance) {

			$defaults = array(
				'item_per_page' 		=> '8',
				'show_pagination'		=> 'true',
				'layout_type'			=> '3',
				'categories'			=> '',
				'ex_categories'			=> ''
			);

			$instance = wp_parse_args($instance, $defaults);
			extract($instance);

			$layout_types		= array('span6' => '2 Column', 'span4' => '3 Column');
			$bool_options		= array('true'=>'True','false'=>'False');

			?>


			<p class="description">
				<label for="<?php echo $this->get_field_id('item_per_page') ?>">
					Item Per Page<br/>
					<?php echo aq_field_input('item_per_page', $block_id, $item_per_page) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('layout_type') ?>">
					Layout Type<br/>
					<?php echo aq_field_select('layout_type', $block_id, $layout_types, $layout_type) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('show_pagination') ?>">
					Show Pagination<br/>
					<?php echo aq_field_select('show_pagination', $block_id, $bool_options, $show_pagination) ?>
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

			$widgetID = uniqid('met_portfolio_list_');

			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

			$query_filter = array();
			$query_filter['post_type'] 			= 'portfolio';
			$query_filter['posts_per_page'] 	= $item_per_page;
			$query_filter['paged'] 				= $paged;

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


			$the_query = new WP_Query( $query_filter );
?>


		<div class="row-fluid met_portfolio_row">
			<?php if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); ?>
			<?php
				$thumbnail_id 		= get_post_thumbnail_id();
				$image_url 			= wp_get_attachment_url( $thumbnail_id,'full');

				if($layout_type == 'span4'){
					$thumbnail_url		= aq_resize($image_url,570,300,true);
				}elseif($layout_type == 'span6'){
					$thumbnail_url		= aq_resize($image_url,370,195,true);
				}


				$ga = $vi = $fi = false;
				$content_media_option = rwmb_meta( 'met_content_media', array(), get_the_ID() );

				if($content_media_option == 'gallery'){
					$gallery_images = rwmb_meta( 'met_gallery_images', $args = array('type'=>'plupload_image','size'=>'thumbnail'), get_the_ID() );
					if(count($gallery_images) > 0){
						$ga = true;

						$gallery_first = array_shift(array_values($gallery_images));
						$gallery_keys = array_keys($gallery_images);

						wp_enqueue_style('metcreative-caroufredsel');
						wp_enqueue_script('metcreative-caroufredsel');

						wp_enqueue_style('metcreative-magnific-popup');
						wp_enqueue_script('metcreative-magnific-popup');

						$slider_option['auto_play'] = rwmb_meta( 'met_slider_auto_play', array(), get_the_ID() );
						$slider_option['duration'] = rwmb_meta( 'met_slider_auto_play_duration', array(), get_the_ID() );
						$slider_option['circular'] = rwmb_meta( 'met_slider_circular', array(), get_the_ID() );
						$slider_option['infinite'] = rwmb_meta( 'met_slider_infinite', array(), get_the_ID() );
					}
				}

				if($content_media_option == 'video'){
					$vi = true;
					$video_url = rwmb_meta( 'met_video_link', array(), get_the_ID() );
				}

				if( !$vi AND !$ga AND !empty($image_url) ){
					$fi = true;

					wp_enqueue_style('metcreative-magnific-popup');
					wp_enqueue_script('metcreative-magnific-popup');
				}

				if(!$fi){
					$thumbnail_url 	= 'http://placehold.it/570x300';
					$image_url 		= 'http://placehold.it/800x600';
				}
			?>
			<div class="<?php echo $layout_type ?> clearfix">

				<?php if($fi): ?>
				<div class="met_portfolio_item_preview_wrap clearfix">
					<a href="<?php the_permalink() ?>" class="met_portfolio_item_preview"><img src="<?php echo $thumbnail_url ?>" alt=""/></a>
					<div class="met_portfolio_item_overlay met_bgcolor6_trans">
						<a href="<?php echo $image_url ?>" rel="lb_<?php the_ID() ?>" class="met_bgcolor met_color2 met_bgcolor_transition2"><i class="icon-camera"></i></a>
						<a href="<?php the_permalink() ?>" class="met_bgcolor met_color2 met_bgcolor_transition2"><i class="icon-link"></i></a>
					</div>
				</div>
				<?php endif; ?>

				<?php if($vi): ?>
					<iframe class="met_portfolio_item_preview" src="<?php echo video_url_to_embed($video_url) ?>" width="570" height="300" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
				<?php endif; ?>

				<?php if($ga): ?>
					<div class="met_portfolio_item_preview">
						<div class="met_portfolio_item_slider_wrap clearfix">
							<div id="met_portfolio_item_slider_<?php the_ID() ?>" class="met_portfolio_item_slider">
								<?php foreach($gallery_images as $gallery_image): ?>
								<a href="<?php echo $gallery_image['full_url'] ?>" rel="lb_<?php the_ID() ?>"><img src="<?php echo aq_resize($gallery_image['full_url'],570,300,true) ?>" alt="<?php echo esc_attr(get_the_title()) ?>"/></a>
								<?php endforeach; ?>
							</div>
							<a href="#" class="met_portfolio_item_slider_nav_prev"><i class="icon-chevron-left"></i></a>
							<a href="#" class="met_portfolio_item_slider_nav_next"><i class="icon-chevron-right"></i></a>
						</div>
					</div>
					<script>
						jQuery(window).load(function(){
							jQuery("#met_portfolio_item_slider_<?php the_ID() ?>").carouFredSel({
								responsive: true,
								prev: { button : function(){ return jQuery(this).parents('.met_portfolio_item_slider_wrap').find('.met_portfolio_item_slider_nav_prev') } },
								next:{ button : function(){ return jQuery(this).parents('.met_portfolio_item_slider_wrap').find('.met_portfolio_item_slider_nav_next') } },
								circular: <?php echo $slider_option['circular'] ?>,
								infinite: <?php echo $slider_option['infinite'] ?>,
								auto: { play : <?php echo $slider_option['auto_play'] ?>, pauseDuration: 0, duration: <?php echo $slider_option['duration'] ?> },
								scroll: { items: 1, duration: 400, wipe: true },
								items: { visible: { min: 1, max: 1 }, width: 691, height: 'variable' },
								width: 691, height: 'variable'
							});
						});
					</script>
				<?php endif; ?>

				<div class="met_portfolio_item_details clearfix">
					<div class="met_portfolio_item_descr met_bgcolor3">
						<div class="met_color2">
							<a href="<?php the_permalink() ?>"><h3 class="met_color2 met_bold_one met_color_transition"><?php the_title() ?></h3></a>
							<p><?php the_excerpt() ?></p>
						</div>
					</div>
					<div class="met_portfolio_item_share met_color2 met_bgcolor">
						<span><?php echo _e('SHARE','metcreative') ?></span>
						<div class="met_portfolio_item_socials">
							<div>
								<a class="met_color2" title="<?php echo _e('Share This on Facebook','metcreative') ?>" target="_blank" href="http://www.facebook.com/sharer.php?u=<?php the_permalink() ?>"><i class="icon-facebook"></i></a>
								<a class="met_color2" title="<?php echo _e('Tweet This on Twitter','metcreative') ?>" target="_blank" href="http://twitter.com/home?status=<?php echo esc_attr(get_the_title()) ?> - <?php the_permalink() ?>"><i class="icon-twitter"></i></a>
								<a class="met_color2" title="<?php echo _e('Share This on Google+','metcreative') ?>" target="_blank" href="https://plus.google.com/share?url=<?php the_permalink() ?>"><i class="icon-google-plus"></i></a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php endwhile; endif; ?>
		</div>

		<?php if($show_pagination == 'true' && $the_query->max_num_pages > 1): ?>
		<div class="pagination n_pagination">
			<ul>
				<li><?php next_posts_link(_('Older'),$the_query->max_num_pages); ?></li>
				<li><?php previous_posts_link(_('Newest'),$the_query->max_num_pages); ?></li>
			</ul>
		</div>
		<?php endif; ?>

<?php
			wp_reset_postdata();
		}
	}
}
