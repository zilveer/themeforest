<?php

class TD_Food_Block extends TD_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name'              => __('Menu Preview', 'smartfood'),
			'size'              => 'span12',
			'block_icon'        => '<i class="fa fa-font fa-fw"></i>',
			'block_description' => __('Use to add a section displaying a food menu preview', 'smartfood'),
			'block_category'    => 'layout',
			'resizable'         => false
		);
		
		//create the block
		parent::__construct('td_food_block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array(
			'title' => 'Fine dining',
			'subtitle' => 'Delicious food',
			'slug1' => '',
			'slug2' => '',
			'bg_image' => '',
		);
		
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
		
		echo __('Enter the title of the section', 'smartfood');
		echo td_field_input('title', $block_id, $title, $size = 'full');

		echo "<br/><br/>";

		echo __('Enter the subtitle of the section', 'smartfood');
		echo td_field_input('subtitle', $block_id, $subtitle, $size = 'full');
		echo "<br/><br/>";

		echo __('Enter the slug of the food menu category', 'smartfood');
		echo td_field_input('slug1', $block_id, $slug1, $size = 'full');
		echo "<br/><br/>";

		echo __('Enter the slug for the second food menu category', 'smartfood');
		echo td_field_input('slug2', $block_id, $slug2, $size = 'full');
		echo "<br/><br/>";

		echo __('Upload an image that will be used as background', 'smartfood');echo "<br/>";
		echo td_field_upload('bg_image', $this->block_id, $bg_image, $media_type = 'image');

	}// end form
	
	function block($instance) {
		extract($instance);

		$category_slug = esc_attr( $slug1 );
		$category_slug2 = esc_attr( $slug2 );

		$cropped_thumb = fImg::resize( $bg_image, 430, 515, true );

		$bg_image = $cropped_thumb;

		?>

		<div class="food-preview-wrapper">

			<div class="col-md-5 col-sx-12 no-pad">
				<img src="<?php echo esc_url($bg_image);?>"/>
			</div>

			<div class="col-md-7 col-xs-12 menu-container">
				<div class="menu-box">
					<div class="menu-box-border">
						<div class="title"><?php echo esc_html($title);?></div>
						<div class="restaurant"><?php echo esc_html($subtitle);?></div>
					</div>
				</div>
				<div class="clearfix"></div>

				<div class="col-md-6">
				
				<?php

					$args = apply_filters('wprm_menu_category_args1',array(
						'post_type'   => 'wprm_menu',
						'posts_per_page'	=> apply_filters( 'wprm_menu_preview_block_per_page', 4 ),
						'tax_query' => array(
							array(
								'taxonomy' => 'menu_category',
								'field'    => 'slug',
								'terms'    => $category_slug,
							),
						),
					), $category_slug );

					$the_menu_category = get_term_by( 'slug', $category_slug, 'menu_category');

					$menu_items = new WP_Query( $args );

					if ( $menu_items->have_posts() ) : 
						while ( $menu_items->have_posts() ) : $menu_items->the_post(); ?>

							<div class="simple-menu-item">
					            <h5 class="menu_post">
					                <span class="menu_title"><?php the_title();?></span>
					                <span class="menu_dots"></span>
					                <span class="menu_price"><?php echo wprm_get_item_price(); ?></span>
					            </h5>
					            <div class="menu-item-excerpt"><?php the_excerpt();?></div>
					        </div>

						<?php endwhile; 
					endif; 

				?>

				</div>

				<div class="col-md-6">
				
					<?php

						$args2 = apply_filters('wprm_menu_category_args2',array(
							'post_type'   => 'wprm_menu',
							'posts_per_page'	=> apply_filters( 'wprm_menu_preview_block_per_page', 4 ),
							'tax_query' => array(
								array(
									'taxonomy' => 'menu_category',
									'field'    => 'slug',
									'terms'    => $category_slug2,
								),
							),
						), $category_slug );

						$the_menu_category2 = get_term_by( 'slug', $category_slug2, 'menu_category');

						$menu_items2 = new WP_Query( $args2 );

						if ( $menu_items2->have_posts() ) : 
							while ( $menu_items2->have_posts() ) : $menu_items2->the_post(); ?>

								<div class="simple-menu-item">
						            <h5 class="menu_post">
						                <span class="menu_title"><?php the_title();?></span>
						                <span class="menu_dots"></span>
						                <span class="menu_price"><?php echo wprm_get_item_price(); ?></span>
						            </h5>
						            <div class="menu-item-excerpt"><?php the_excerpt();?></div>
						        </div>

							<?php endwhile; 
						endif; 

					?>

				</div>

				<?php wp_reset_query(); ?>

			</div>

			<div class="clearfix"></div>

		</div>

		<?php

	}//end block
	
}//end class