<?php
if(!class_exists('MET_Portfolio_2')) {
	class MET_Portfolio_2 extends AQ_Block {

		function __construct() {
			$block_options = array(
				'name' => 'Portfolio Listing 2',
				'size' => 'span12'
			);

			parent::__construct('MET_Portfolio_2', $block_options);
		}

		function form($instance) {

			$defaults = array(
				'item_per_page' 		=> '9',
				'effect_type'			=> '1',
				'show_pagination'		=> 'true',
				'show_categories'		=> 'true',
				'layout_type'			=> '3'
			);

			$instance = wp_parse_args($instance, $defaults);
			extract($instance);

			$effect_types		= array('1'=>'Effect 1','2'=>'Effect 2','3'=>'Effect 3','4'=>'Effect 4','5'=>'Effect 5','r'=>'Random');
			$layout_types		= array('1' => 'Layout 1', '2' => 'Layout 2');
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
				<label for="<?php echo $this->get_field_id('effect_type') ?>">
					Effect Type<br/>
					<?php echo aq_field_select('effect_type', $block_id, $effect_types, $effect_type) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('show_pagination') ?>">
					Show Pagination<br/>
					<?php echo aq_field_select('show_pagination', $block_id, $bool_options, $show_pagination) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('show_categories') ?>">
					Category Filter Bar<br/>
					<?php echo aq_field_select('show_categories', $block_id, $bool_options, $show_categories) ?>
				</label>
			</p>
		<?php
		}

		function block($instance) {
			extract($instance);

			wp_enqueue_script('metcreative-isotope');

			$gallery_id = uniqid('gal_');

			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

			$the_query = new WP_Query( 'post_type=portfolio&posts_per_page='.$item_per_page.'&paged='.$paged );

			$portfolioFilters = '';
			?>

			<?php if($show_categories):
				$portfolioFilters = '
						<div class="clearfix"><ul id="'.$gallery_id.'_filters" class="met_filters met_bgcolor2 pull-right">';

							$args = array( 'orderby' => 'name', 'order' => 'ASC', 'taxonomy' => 'portfolio_category' );
							$categories = get_categories($args);
							foreach($categories as $category) {
								$portfolioFilters .= '<li><a href="#" data-filter=".'.$category->slug.'">'.$category->name.'</a></li>';
							}

				$portfolioFilters .= '<li><a href="#" data-filter="*" class="met_color3">show all</a></li>

				</ul></div>';
			endif; ?>


			<?php if($layout_type == '1'): ?>
			<div class="row-fluid">
				<div class="span12">
					<?php echo $portfolioFilters; ?>
					<div id="<?php echo $gallery_id ?>" class="met_portfolio_list_4_columns">
						<?php if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); ?>
						<?php
							$terms = get_the_terms( get_the_ID(), 'portfolio_category' );
							if ( $terms && ! is_wp_error( $terms ) ){
								$portfolioCats = array();
								$portfolioCatSlugs = array();

								foreach ( $terms as $term ) {
									$portfolioCats[] = $term->name;
									$portfolioCatSlugs[] = $term->slug;
								}

								$portfolioCatList = join(", ", $portfolioCats );
								$portfolioSlugList = join(" ", $portfolioCatSlugs );
							}

							$thumbnail_id = get_post_thumbnail_id();
							$image_url = wp_get_attachment_url( $thumbnail_id,'full');
							$image_url	= aq_resize($image_url,275,275,true);

							$ga = $vi = false;
							$content_media_option = rwmb_meta( 'met_content_media', array(), get_the_ID() );
							if($content_media_option == 'gallery'){
								$gallery_images = rwmb_meta( 'met_gallery_images', $args = array('type'=>'plupload_image','size'=>'thumbnail'), get_the_ID() );
								if(count($gallery_images) > 0){
									$ga = true;

									$gallery_first = array_shift(array_values($gallery_images));
									$gallery_keys = array_keys($gallery_images);

									wp_enqueue_style('metcreative-magnific-popup');
									wp_enqueue_script('metcreative-magnific-popup');
								}
							}

							if($content_media_option == 'video'){
								$vi = true;
								$video_url = rwmb_meta( 'met_video_link', array(), get_the_ID() );
								wp_enqueue_style('metcreative-magnific-popup');
								wp_enqueue_script('metcreative-magnific-popup');
							}

							if($effect_type == 'r'){
								$effect_type_result = mt_rand(1,5);
							}else{
								$effect_type_result = $effect_type;
							}

						?>

						<div class="met_portfolio_item met_portfolio_effect_<?php echo $effect_type_result ?> <?php echo $portfolioSlugList ?>">

							<div class="met_portfolio_item_image_wrap">
								<a href="<?php the_permalink() ?>" class="met_portfolio_item_image_container"><img src="<?php echo $image_url ?>" alt="<?php esc_attr(get_the_title()) ?>"></a>

								<div class="met_portfolio_item_mask met_bgcolor">
									<span class="met_portfolio_item_mask_first_title met_color2"><?php the_title() ?></span>
									<span class="met_portfolio_item_mask_second_title met_color2"><?php the_excerpt() ?></span>

									<span class="met_portfolio_item_mask_link">
										<a href="<?php the_permalink() ?>" class="icon-link icon-large met_tipsy_west" title="Details"></a>

										<?php if( $ga ): ?>
										<a href="<?php echo $gallery_first['full_url'] ?>" rel="prettyPhoto[<?php the_ID()?>]" class="icon-picture icon-large met_tipsy_west" title=""></a>
										<?php endif; ?>

										<?php if( $vi ): ?>
										<a href="<?php echo $video_url ?>" rel="videoPretty" class="icon-play-circle icon-large met_tipsy_west" title="Watch the Video"></a>
										<?php endif; ?>
									</span>
								</div>
							</div>

							<a href="<?php the_permalink() ?>" class="met_recent_work_double_title">
								<h3 class="met_color_transition"><?php the_title() ?></h3>
							</a>

							<?php if( $ga ): ?>
								<div class="met_portfolio_item_gallery">
								<?php unset($gallery_images[$gallery_keys[0]]); foreach($gallery_images as $gallery_image): ?>
									<a href="<?php echo $gallery_image['full_url'] ?>" rel="prettyPhoto[<?php the_ID()?>]"></a>
								<?php endforeach; ?>
								</div>
							<?php endif; ?>
						</div>

						<?php endwhile; endif; ?>
					</div>
				</div>
			</div>
			<?php endif; ?>

			<?php if($layout_type == '2'): ?>
			<div class="row-fluid">
				<div class="span12">
					<?php echo $portfolioFilters; ?>
					<div class="met_mason_portfolio_wrap clearfix">
						<div class="met_mason_portfolio clearfix">
					<?php $item_count = 1; if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); ?>
					<?php
						$terms = get_the_terms( get_the_ID(), 'portfolio_category' );
						if ( $terms && ! is_wp_error( $terms ) ){
							$portfolioCats = array();
							$portfolioCatSlugs = array();

							foreach ( $terms as $term ) {
								$portfolioCats[] = $term->name;
								$portfolioCatSlugs[] = $term->slug;
							}

							$portfolioCatList = join(", ", $portfolioCats );
							$portfolioSlugList = join(" ", $portfolioCatSlugs );
						}

						$thumbnail_id = get_post_thumbnail_id();
						$image_url = wp_get_attachment_url( $thumbnail_id,'full');

						if( $item_count == 5 ){
							$image_url	= aq_resize($image_url,560,310,true);
						}elseif( $item_count == 6 ){
							$image_url	= aq_resize($image_url,260,310,true);
						}elseif( $item_count == 7 OR $item_count == 8 ){
							$image_url	= aq_resize($image_url,260,135,true);
						}else{
							$image_url	= aq_resize($image_url,260,260,true);
						}



						$ga = $vi = false;
						$content_media_option = rwmb_meta( 'met_content_media', array(), get_the_ID() );
						if($content_media_option == 'gallery'){
							$gallery_images = rwmb_meta( 'met_gallery_images', $args = array('type'=>'plupload_image','size'=>'thumbnail'), get_the_ID() );
							if(count($gallery_images) > 0){
								$ga = true;

								$gallery_first = array_shift(array_values($gallery_images));
								$gallery_keys = array_keys($gallery_images);

								wp_enqueue_style('metcreative-magnific-popup');
								wp_enqueue_script('metcreative-magnific-popup');
							}
						}

						if($content_media_option == 'video'){
							$vi = true;
							$video_url = rwmb_meta( 'met_video_link', array(), get_the_ID() );
							wp_enqueue_style('metcreative-magnific-popup');
							wp_enqueue_script('metcreative-magnific-popup');
						}

						$item_icon = '';
						$item_icon = rwmb_meta( 'met_portfolio_icon', array(), get_the_ID() );
						$portfolio_sub_title = rwmb_meta( 'met_portfolio_sub_title', array(), get_the_ID() );

						$item_count++;
					?>

						<div class="met_mason_portfolio_item <?php echo $portfolioSlugList ?>">

							<a href="<?php the_permalink() ?>" class="met_mason_portfolio_item_pic"><img src="<?php echo $image_url ?>" alt="<?php esc_attr(get_the_title()) ?>" /></a>
							<div class="met_mason_portfolio_item_overlap">
								<a href="<?php the_permalink() ?>"><h4><?php the_title() ?></h4></a>

								<div class="met_mason_portfolio_miscs clearfix">
									<?php if( $ga ): ?>
									<a href="<?php echo $gallery_first['full_url'] ?>" rel="lb[<?php the_ID()?>]"><i class="icon-search"></i></a>
									<?php endif; ?>

									<?php if( $vi ): ?>
									<a href="<?php echo $video_url ?>" rel="mpv[<?php the_ID()?>]"><i class="icon-facetime-video"></i></a>
									<?php endif; ?>

									<a href="<?php the_permalink() ?>"><i class="icon-link"></i></a>
								</div>
							</div>

							<?php if( $ga ): ?>
							<div class="met_portfolio_item_gallery">
								<?php unset($gallery_images[$gallery_keys[0]]); foreach($gallery_images as $gallery_image): ?>
									<a href="<?php echo $gallery_image['full_url'] ?>" rel="lb[<?php the_ID()?>]"></a>
								<?php endforeach; ?>
							</div>
							<?php endif; ?>
						</div>

					<?php endwhile; endif; ?>
					</div>
					</div>
				</div>
			</div>
			<?php endif; ?>

			<?php if($the_query->max_num_pages > 1 AND $show_pagination == 'true'): ?>
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
