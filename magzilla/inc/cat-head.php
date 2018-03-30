<?php global $fave_cat_id; global $fave_show_child_cat; ?>

<div class="archive-section-title cat-section-head-<?php echo intval( $fave_cat_id );?>">
	<h1 class="page-title"><?php echo get_category( $fave_cat_id )->name; ?></h1>
</div><!-- module-category -->

	
	<?php 
	
	$fave_sub_cats = get_categories(array('child_of' => $fave_cat_id)); 
	
	if( !empty($fave_sub_cats) ) {

		if ($fave_show_child_cat != 'all') {
            $fave_sub_cats = array_slice($fave_sub_cats, 0, $fave_show_child_cat);
        }
		
		echo '<ul class="module-top-topics list-inline pull-right hidden-sm hidden-xs">';

		echo '<li>'.__( 'Related Topics:', 'magzilla' ).'</li>';

		foreach ($fave_sub_cats as $cat ) {
                    
            echo '<li><a href="' . esc_url( get_category_link($cat->cat_ID) ) . '" >' . esc_attr( $cat->name ) . '</a></li><!-- <li>|</li> -->';
            
        }
        echo '</ul>';
	}


	// Dropdown menu for smartphones
	if( !empty($fave_sub_cats) ) {
		?>

		<script>
		    jQuery(function($){
		      // bind change event to select
		      $('#dynamic_select').on('change', function () {
		          var url = $(this).val(); // get selected value
		          if (url) { // require a URL
		              window.location = url; // redirect
		          }
		          return false;
		      });
		    });
		</script>


		<?php
		if ($fave_show_child_cat != 'all') {
            $fave_sub_cats = array_slice($fave_sub_cats, 0, $fave_show_child_cat);
        }
		
		echo '<select id="dynamic_select" class="module-top-topics list-inline pull-right hidden-lg hidden-md">';

		echo '<option>'.__( 'Related Topics:', 'magzilla' ).'</option>';

		foreach ($fave_sub_cats as $cat ) {
                    
            echo '<option value="' . esc_attr( get_category_link($cat->cat_ID) ) . '" >' . esc_attr( $cat->name ) . '</option>';
            
        }
        echo '</select>';
	}

	?>