<?php

function menu_taxonomy() {
	$redux = get_option('redux');
	if(isset($redux['theme_permalink_berg_menu_category'])) {
		$slug = $redux['theme_permalink_berg_menu_category'];
	} else {
		$slug = 'menu-category';
	}

	register_taxonomy(
		'berg_menu_categories',  //The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces).
		'berg_menu',   		 //post type name
		array(
			'hierarchical' 		=> true,
			'label' 			=> 'Categories',  //Display name
			'query_var' 		=> true,
			'rewrite'			=> array(
				'slug' 			=> $slug,
			),
			'supports' => array('title', 'editor', 'thumbnail', 'custom-fields'),
		)
	);
}

add_action('init', 'menu_taxonomy');
add_action('init', 'menu_post_type');

function menu_post_type() {
	$redux = get_option('redux');
	if(isset($redux['theme_permalink_berg_menu'])) {
		$slug = $redux['theme_permalink_berg_menu'];
	} else {
		$slug = 'menu';
	}

	register_post_type( 'berg_menu',
		array(
			'labels' => array(
				'name' => __( 'Food Menu', 'BERG'),
				'singular_name' => __( 'Food Menu', 'BERG'),
				'all_items' => __('Food Menu Items', 'BERG'),
				'add_new' => __('Add Food Menu Item', 'BERG'),
				'add_new_item' => __('Add Food Menu Item', 'BERG'),
				'edit_item' => __('Edit Food Menu Item', 'BERG')
			),
			'exclude_from_search' => false,
			'can_export' => true,
			'capability_type' => 'post',
			'public' => true,
			'has_archive' => false,
			'supports' => array('title','editor', 'thumbnail', 'excerpt' ),
			'taxonomies' => array('berg_menu_categories'),
			'rewrite' => array(
				'slug' => $slug,
			),
		)
	);
};

function food_menu_sort() {
	add_submenu_page('edit.php?post_type=berg_menu', 'Custom Post Type Admin', __('Reorder Food Menu Items', 'BERG'), 'edit_posts', basename(__FILE__), 'reorder_food_menu');
}

function reorder_food_menu() {
	wp_enqueue_script('jquery-ui-sortable');
	global $post;
	// var_dump(get_option('berg_menu_categories_order'));
	$order = get_option('berg_menu_categories_order');
	if($order != false && $order != '') {
		$order = explode(',', $order);
		$terms = get_terms('berg_menu_categories', array('hide_empty'=>true, 'include'=>$order, 'orderby'=>'include'));
		$termsExclude = get_terms('berg_menu_categories', array('hide_empty'=>true, 'exclude'=>$order));
	} else {
		$terms = get_terms('berg_menu_categories', array('hide_empty'=>true));
	}

	$termsArray = array();

	echo '<div id="reorder_food_menu">';

	foreach ($terms as $term) {
		$termsArray[$term->term_id] = array('id'=>$term->term_id, 'name'=>$term->name, 'slug'=>$term->slug);
	}
	if(isset($termsExclude) && is_array($termsExclude)) {
		foreach ($termsExclude as $term) {
			$termsArray[$term->term_id] = array('id'=>$term->term_id, 'name'=>$term->name, 'slug'=>$term->slug);
		}
	}

	echo '<br/>';

	foreach($termsArray as $cat) {
		$option = get_option('taxonomy_'.$cat['id']);

		echo '<div class="reorder-category" data-category="'.$cat['id'].'"><hr/><h2>'.$cat['name'].'</h2><hr/>' . "\r\n";
		
		if (isset($option['order'])) {
			$the_query = new WP_Query(array('posts_per_page'=>-1, 'post_type'=>'berg_menu', 'orderby'=>'post__in', 'post__in'=>maybe_unserialize($option['order']), 'tax_query'=>array(array('taxonomy'=>'berg_menu_categories', 'terms'=>$cat['id'], 'field' => 'term_id'))));
			$the_query2 = new WP_Query(array('posts_per_page'=>-1, 'post_type'=>'berg_menu', 'orderby'=>'post__in', 'post__not_in'=>maybe_unserialize($option['order']), 'tax_query'=>array(array('taxonomy'=>'berg_menu_categories', 'terms'=>$cat['id'], 'field' => 'term_id'))));
		} else {
			$the_query = new WP_Query(array('posts_per_page'=>-1, 'post_type'=>'berg_menu', 'tax_query'=>array(array('taxonomy'=>'berg_menu_categories', 'terms'=>$cat['id'], 'field' => 'term_id'))));
		}

		if ($the_query->have_posts()) {
			while ($the_query->have_posts()) {
				$the_query->the_post();
				echo '<div class="ui-state-default" id="element-'.$post->ID.'" data-id="'.$post->ID.'" style="height: 30px; line-height: 30px; padding: 0 10px; margin: 2px 0; ">'.$post->post_title.'<br/></div>' . "\r\n";
			}

			wp_reset_postdata();
		}
		
		if (isset($option['order'])) {
			if ($the_query2->have_posts()) {
				while ($the_query2->have_posts()) {
					$the_query2->the_post();
					echo '<div class="ui-state-default" id="element-'.$post->ID.'" data-id="'.$post->ID.'" style="height: 30px; line-height: 30px; padding: 0 10px; margin: 2px 0; ">'.$post->post_title.'<br/></div>' . "\r\n";
				}

				wp_reset_postdata();
			}
		}

		echo "</div>\r\n";
	}

	echo "</div>\r\n";
	echo '<button class="button button-primary button-large update-order">'.__( 'Update', 'BERG').'</button>'
	?>
	<script type="text/javascript">
	jQuery(document).ready(function() {

		function reorderMenu() {
			var sortCategories = {};
			jQuery.each(jQuery('.reorder-category'), function(i, el) {
				var category = jQuery(el).data('category');
				sortCategories[category] = [];
				jQuery.each(jQuery(el).find('.ui-state-default'), function(i, el) {
					sortCategories[category].push(jQuery(el).data('id'));
				});
			});
			// console.log(sortCategories);
			return sortCategories;
		}
		function categoriesOrder() {
			var categories = ''
			jQuery.each(jQuery('.reorder-category'), function(i, el) {
				var category = jQuery(el).data('category');
				categories += category+',';
			});
			return categories;
		}
		jQuery('#reorder_food_menu').sortable({
			items: '.reorder-category'
		});

		jQuery('.reorder-category').sortable({
			items: 'div'
		});

		jQuery('.update-order').click(function(e) {
			e.preventDefault();
			reorderMenu();
			categoriesOrder();
			jQuery.post(ajaxurl, { action : 'food_menu_order', order : reorderMenu(), categories : categoriesOrder() }, function(data) {
				jQuery('.update-order').data('old', jQuery('.update-order').html()).html(data.message);
				setTimeout(function() {
					jQuery('.update-order').html(jQuery('.update-order').data('old'));
				},3000);
			}, 'JSON');
		});
	});
	</script>
	<?php
}

function berg_saveFoodMenuOrder() {
	if (isset($_POST['action']) && $_POST['action'] == 'food_menu_order') {
		if (isset($_POST['order'])) {
			$terms = get_terms('berg_menu_categories', array('hide_empty'=>true));

			foreach($_POST['order'] as $id => $category) {
				$t_id = $id;
				$term_meta = get_option("taxonomy_$t_id");
				$term_meta['order'] = serialize($category); 
				update_option("taxonomy_$t_id", $term_meta);
			}

			echo json_encode(array('message'=>__('Changes saved', 'BERG')));
		}

		if(isset($_POST['categories'])) {
			update_option('berg_menu_categories_order', $_POST['categories']);
		}
	}

	die();
}