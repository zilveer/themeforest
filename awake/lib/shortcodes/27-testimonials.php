<?php
/**
 *
 */
class mysiteTestimonials {
	
	/**
	 *
	 */
	function testimonials_grid( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Testimonials Grid', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'testimonials_grid',
				'options' => array(
					array(
						'name' => __( 'Number of Testimonials', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select the number of testimonials you wish to have displayed on each page.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'show',
						'options' => array_combine(range(1,40), array_values(range(1,40))),
						'type' => 'select'
					),
					array(
						'name' => __( 'Number of Columns', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select the number of columns you would like your testimonials to display in.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'column',
						'default' => '',
						'options' => array(
							'1' => __('One Column', MYSITE_ADMIN_TEXTDOMAIN ),
							'2' => __('Two Column', MYSITE_ADMIN_TEXTDOMAIN ),
							'3' => __('Three Column', MYSITE_ADMIN_TEXTDOMAIN ),
							'4' => __('Four Column', MYSITE_ADMIN_TEXTDOMAIN )
						),
						'type' => 'select',
					),
					array(
						'name' => __( 'Style', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select the style you would like your testimonials to display in.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'style',
						'default' => '',
						'options' => array(
							'pullquote1' => __('Pullquote 1', MYSITE_ADMIN_TEXTDOMAIN ),
							'pullquote2' => __('Pullquote 2', MYSITE_ADMIN_TEXTDOMAIN ),
							'pullquote3' => __('Pullquote 3', MYSITE_ADMIN_TEXTDOMAIN ),
							'pullquote4' => __('Pullquote 4', MYSITE_ADMIN_TEXTDOMAIN ),
							'blockquote' => __('Blockquotes', MYSITE_ADMIN_TEXTDOMAIN )
						),
						'type' => 'select',
					),
					array(
						'name' => __('Testimonials Categories <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'If you want testimonials from specific categories to display then you may choose them here.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'cat',
						'default' => array(),
						'target' => 'cat_testimonial',
						'type' => 'multidropdown'
					),
					array(
						'name' => __('Show Testimonials Pagination <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Checking this will show pagination at the bottom so the reader can go to the next page.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'pagination',
						'options' => array('true' => 'Show Post Pagination'),
						'type' => 'checkbox'
					),
				'shortcode_has_atts' => true
				)
			);
			
			return $option;
		}
		
		extract(shortcode_atts(array(
			'show'			=> '4',
			'column'		=> '2',
			'style'			=> 'blockquote',
			'cat'			=> '',
			'pagination'	=> '',
	    ), $atts));
	
		$out = '';
		
		# Testimonal query options
		$show = trim( $show );
		$column = trim( $column );
		$style = trim( $style );
		$pagination = trim( $pagination );
		
		$query = array( 'post_type' => 'testimonial' );
		
		if( $pagination == 'true' ) {
			$query['posts_per_page'] = $show;
			$query['paged'] = mysite_get_page_query();
			
		} else {
			$query['showposts'] = $show;
			$query['nopaging'] = 0;
		}
		
		if( !empty( $cat ) ) {
			$query['tax_query'] = array(
				'relation' => 'IN',
				array(
					'taxonomy' => 'testimonial_category',
					'field' => 'slug',
					'terms' => explode( ',', $cat ),
				)
			);
		}
			
		# Query testimonials
		$testimonials_query = new WP_Query( $query );
		
		# Check to see testimonials have be added
		if( $testimonials_query->have_posts() ) : while( $testimonials_query->have_posts() ) : $testimonials_query->the_post();
		
		# Loop through and get all testimonial custom fields
		$post_id = get_the_ID();
		$custom_fields = get_post_custom( $post_id );
		foreach( $custom_fields as $key => $value )
			$testimonial[$post_id][$key] = $value[0];		
		
		endwhile; # End testimonials_query loop
		
		# Define column classes
		switch( $column ) {
			case 1:
				$main_class = 'testimonial_grid one_column_testimonial';
				break;
			case 2:
				$main_class = 'testimonial_grid two_column_testimonial';
				$column_class = 'one_half';
				break;
			case 3:
				$main_class = 'testimonial_grid three_column_testimonial';
				$column_class = 'one_third';
				break;
			case 4:
				$main_class = 'testimonial_grid four_column_testimonial';
				$column_class = 'one_fourth';
				break;
		}
		
		$out .= '<div class="' .  $main_class . '">';
		
		# Loop through all testimonial custom fields and output testimonials
		$i=1;
		foreach( $testimonial as $key => $value ) {
			
			$out .= ( $column != 1 ? '<div class="' . ( $i%$column == 0 ? $column_class . ' last' : $column_class ) . '">' : '' );
			
			if( !empty( $value['_testimonial'] ) ) {
				
				# Pullquote1 style
				$quote = '[' . $style . ' raw="false" testimonial_sc="true"';
				if( !empty( $value['_name'] ) )
					$quote .= ' cite_sc="' . $value['_name'] . '"';
					
				if( !empty( $value['_website_url'] ) )
					$quote .= ' citelink="' . $value['_website_url'] . '"';
					
				if( !empty( $value['_website_name'] ) )
					$quote .= ' citename="' . $value['_website_name'] . '"';
					
				if( isset( $value['_image'] ) && $value['_image'] == 'upload_picture' && !empty( $value['_custom_image'] ) )
					$quote .= ' citeimgcustom="' . $value['_custom_image'] . '"';

				if( isset( $value['_image'] ) && $value['_image'] == 'use_gravatar' ) {
					$value['_email'] = ( isset( $value['_email'] ) ? $value['_email'] : 'sjm6g1LW@sjm6g1LW.com' );
					$quote .= ' citeimgavatar="' . $value['_email'] . '"';
				}
				
				$quote .= ']' . $value['_testimonial'];
				$quote .= '[/' . $style . ']';
				
				$out .= do_shortcode( $quote );
			}
			
			$out .= ( $column != 1 ? '</div>' : '' );
			
			if( ( $i % $column ) == 0 )
				$out .= '<div class="clearboth"></div>';
			
			$i++;
		}
		
		$out .= '</div>';
		
		$out .= ( $pagination == 'true' ) ? mysite_pagenavi( '', '', $testimonials_query ) : '';
		
		else :
		
			$out .= __( 'No testimonials were found', MYSITE_TEXTDOMAIN );
			
			if( current_user_can('edit_post') )
				$out .= '<p><a href="' . esc_url(admin_url( 'post-new.php?post_type=testimonial' )) . '">' . __( 'Click here to add testimonials', MYSITE_TEXTDOMAIN ) . '</a></p>';
		
		endif;
		
		wp_reset_query();
		
		return $out;
	}
	
	/**
	 *
	 */
	function testimonials_single( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Testimonials Single', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'testimonials_single',
				'options' => array(
					array(
						'name' => __( 'ID', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Enter the ID of testimonial you wish to have displayed.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'id',
						'type' => 'text'
					),
					array(
						'name' => __( 'Style', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select the style you would like your testimonial to display in.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'style',
						'default' => '',
						'options' => array(
							'pullquote1' => __('Pullquote 1', MYSITE_ADMIN_TEXTDOMAIN ),
							'pullquote2' => __('Pullquote 2', MYSITE_ADMIN_TEXTDOMAIN ),
							'pullquote3' => __('Pullquote 3', MYSITE_ADMIN_TEXTDOMAIN ),
							'pullquote4' => __('Pullquote 4', MYSITE_ADMIN_TEXTDOMAIN ),
							'blockquote' => __('Blockquotes', MYSITE_ADMIN_TEXTDOMAIN )
						),
						'type' => 'select',
					),
					array(
						'name' => __( 'Align <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Set the alignment for your testimonial here.<br /><br />Your testimonial will float along the center, left or right hand sides depending on your choice.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'align',
						'default' => '',
						'options' => array(
							'left' => __( 'left', MYSITE_ADMIN_TEXTDOMAIN ),
							'right' => __( 'right', MYSITE_ADMIN_TEXTDOMAIN ),
							'center' => __( 'center', MYSITE_ADMIN_TEXTDOMAIN ),
						),
						'type' => 'select',
					),
				'shortcode_has_atts' => true
				)
			);
			
			return $option;
		}
		
		extract(shortcode_atts(array(
			'id'	=> '',
			'style'	=> 'blockquote',
			'align'	=> '',
	    ), $atts));
	
		$out = '';
		
		# Query testimonials
		$testimonials_query = new WP_Query( "post_type=testimonial&p=$id" );
		
		if( !empty( $id ) && $testimonials_query->have_posts() ) : while( $testimonials_query->have_posts() ) : $testimonials_query->the_post();
		
		# Loop through and get all testimonial custom fields
		$post_id = get_the_ID();
		$custom_fields = get_post_custom( $post_id );
		foreach( $custom_fields as $key => $value )
			$testimonial[$post_id][$key] = $value[0];		
		
		endwhile; # End testimonials_query loop
		
		if( !empty( $testimonial[$id]['_testimonial'] ) ) {
			# Pullquote1 style
			$quote = '[' . $style . ' raw="false" testimonial_sc="true"';
			if( !empty( $align ) )
				$quote .= ' align="' . $align . '"';
				
			if( !empty( $testimonial[$id]['_name'] ) )
				$quote .= ' cite_sc="' . $testimonial[$id]['_name'] . '"';
				
			if( !empty( $testimonial[$id]['_website_url'] ) )
				$quote .= ' citelink="' . $testimonial[$id]['_website_url'] . '"';
				
			if( !empty( $testimonial[$id]['_website_name'] ) )
				$quote .= ' citename="' . $testimonial[$id]['_website_name'] . '"';
				
			if( isset( $testimonial[$id]['_image'] ) && $testimonial[$id]['_image'] == 'upload_picture' && !empty( $testimonial[$id]['_custom_image'] ) )
				$quote .= ' citeimgcustom="' . $testimonial[$id]['_custom_image'] . '"';

			if( isset( $testimonial[$id]['_image'] ) && $testimonial[$id]['_image'] == 'use_gravatar' ) {
				$testimonial[$id]['_email'] = ( isset( $testimonial[$id]['_email'] ) ? $testimonial[$id]['_email'] : 'sjm6g1LW@sjm6g1LW.com' );
				$quote .= ' citeimgavatar="' . $testimonial[$id]['_email'] . '"';
			}
			
			$quote .= ']' . $testimonial[$id]['_testimonial'];
			$quote .= '[/' . $style . ']';
			
			$out .= do_shortcode( $quote );
		}
		
		$out = '<div class="testimonial_single">' . $out . '</div>';
		
		else :
		
			$out .= __( 'No testimonials were found', MYSITE_TEXTDOMAIN );
			
			if( current_user_can('edit_post') )
				$out .= '<p><a href="' . esc_url(admin_url( 'post-new.php?post_type=testimonial' )) . '">' . __( 'Click here to add testimonials', MYSITE_TEXTDOMAIN ) . '</a></p>';
		
		endif;
		
		wp_reset_query();
		
		return $out;
	}

	
	/**
	 *
	 */
	function _options( $class ) {
		$shortcode = array();
		
		$class_methods = get_class_methods( $class );
		
		foreach( $class_methods as $method ) {
			if( $method[0] != '_' )
				$shortcode[] = call_user_func(array( &$class, $method ), $atts = 'generator' );
		}
		
		$options = array(
			'name' => __( 'Testimonials', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Choose which type of testimonials you wish to use.<br /><br />The grid will display testimonials in a column layout while the single will allow you to call a testimonials by ID.', MYSITE_ADMIN_TEXTDOMAIN ),
			'value' => 'testimonials',
			'options' => $shortcode,
			'shortcode_has_types' => true
		);
		
		return $options;
	}
	
}

?>