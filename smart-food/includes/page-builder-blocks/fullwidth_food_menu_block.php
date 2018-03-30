<?php

class TD_Fullwidth_Food_Menu_Block extends TD_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name'              => __('Fullwidth Food Menu', 'smartfood'),
			'size'              => 'span12',
			'block_icon'        => '<i class="fa fa-cutlery fa-fw"></i>',
			'block_description' => __('Use to display a fullwidth food menu', 'smartfood'),
			'block_category'    => 'layout',
			'resizable'         => false,
		);
	
		//create the block
		parent::__construct('td_fullwidth_food_menu_block', $block_options);

	}
	
	function form($instance) {
		
		$defaults = array(
			'column_1' => '',
			'column_2' => '',
			'column_3' => '',
			'image' => ''
		);
		
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
		
		echo __('Enter the food categories slugs you wish to display in the first column. Separate each category with a comma.', 'smartfood');
		echo td_field_input('column_1', $block_id, $column_1, $size = 'full');
		echo "<br/><br/>";

		echo __('Enter the food categories slugs you wish to display in the second column. Separate each category with a comma.', 'smartfood');
		echo td_field_input('column_2', $block_id, $column_2, $size = 'full');
		echo "<br/><br/>";

		echo __('Enter the food categories slugs you wish to display in the third column. Separate each category with a comma.', 'smartfood');
		echo td_field_input('column_3', $block_id, $column_3, $size = 'full');
		echo "<br/><br/>";

		echo __('Upload an image that will be used as background', 'smartfood');echo "<br/>";
		echo td_field_upload('image', $this->block_id, $image, $media_type = 'image');
		
	}// end form
	
	function block($instance) {
		extract($instance);

		// Prepare the categories
		$first_column_slugs  = esc_attr($column_1);
		$column_1_slugs = explode(',', $first_column_slugs);
		$second_column_slugs  = esc_attr($column_2);
		$column_2_slugs = explode(',', $second_column_slugs);
		$third_column_slugs  = esc_attr($column_3);
		$column_3_slugs = explode(',', $third_column_slugs);

		//set the class of the container if the image has been uploaded
		$container_class = null;
		$style = null;
		if($image) {
			$container_class = 'has-image';
			$style = 'background-image:url('.esc_url( $image ).');';
		} else {
			$container_class = 'no-image';
		}

		echo '<style>';
		echo '.menu-section:before{
                        background-image: url('.$image.');
                }';
		echo '</style>';

		echo '<section class="menu-section '.$container_class.'" id="menu" >
            <div class="content">
            
                <div class="column">';
                   	// Display the category name
                   	foreach ($column_1_slugs as $category) { 
                   		$term = get_term_by('slug', $category, 'menu_category'); 
                   		$name = $term->name;
                   		// Prepare the query
                   		$args = array(
							'post_type'   => 'wprm_menu',
							'posts_per_page'	=> -1,
							'tax_query' => array(
								array(
									'taxonomy' => 'menu_category',
									'field'    => 'slug',
									'terms'    => $category,
								),
							),
						);
						$menu_items = new WP_Query( $args );
                   	?>
                   		<div class="menu">
                        	<h2><?php echo $name; ?></h2>
                        	<?php if ( $menu_items->have_posts() ) : ?>
                        		<?php while ( $menu_items->have_posts() ) : $menu_items->the_post(); ?>
                        			<div class="item">
			                            <h3><?php the_title();?></h3>
			                            <p><?php the_excerpt(); ?></p>
			                            <span><?php echo wprm_get_item_price(); ?></span>
			                        </div>
                        		<?php endwhile; ?>
                        	<?php endif; ?>
	                    </div>
                   	<?php }
                echo '</div>
                <div class="column">';
                    // Display the category name
                   	foreach ($column_2_slugs as $category) { 
                   		$term = get_term_by('slug', $category, 'menu_category'); 
                   		$name = $term->name;
                   		// Prepare the query
                   		$args = array(
							'post_type'   => 'wprm_menu',
							'posts_per_page'	=> -1,
							'tax_query' => array(
								array(
									'taxonomy' => 'menu_category',
									'field'    => 'slug',
									'terms'    => $category,
								),
							),
						);
						$menu_items = new WP_Query( $args );
                   	?>
                   		<div class="menu">
                        	<h2><?php echo $name; ?></h2>
                        	<?php if ( $menu_items->have_posts() ) : ?>
                        		<?php while ( $menu_items->have_posts() ) : $menu_items->the_post(); ?>
                        			<div class="item">
			                            <h3><?php the_title();?></h3>
			                            <p><?php the_excerpt(); ?></p>
			                            <span><?php echo wprm_get_item_price(); ?></span>
			                        </div>
                        		<?php endwhile; ?>
                        	<?php endif; ?>
	                    </div>
                   	<?php }
                echo '</div>
                <div class="column">';
                    // Display the category name
                   	foreach ($column_3_slugs as $category) { 
                   		$term = get_term_by('slug', $category, 'menu_category'); 
                   		$name = $term->name;
                   		// Prepare the query
                   		$args = array(
							'post_type'   => 'wprm_menu',
							'posts_per_page'	=> -1,
							'tax_query' => array(
								array(
									'taxonomy' => 'menu_category',
									'field'    => 'slug',
									'terms'    => $category,
								),
							),
						);
						$menu_items = new WP_Query( $args );
                   	?>
                   		<div class="menu">
                        	<h2><?php echo $name; ?></h2>
                        	<?php if ( $menu_items->have_posts() ) : ?>
                        		<?php while ( $menu_items->have_posts() ) : $menu_items->the_post(); ?>
                        			<div class="item">
			                            <h3><?php the_title();?></h3>
			                            <p><?php the_excerpt(); ?></p>
			                            <span><?php echo wprm_get_item_price(); ?></span>
			                        </div>
                        		<?php endwhile; ?>
                        	<?php endif; ?>
	                    </div>
                   	<?php }
                echo '</div>
            </div>
        </section>';

	}//end block
	
}//end class