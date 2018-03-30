<?php
    global $wp_query;
    global $wp_rewrite;
    
	if( is_search() ){
        if( (int) get_query_var('page') > 0 ){
            $current = get_query_var('page');
        }else{
            if( (int) get_query_var('paged') > 0 ){
                $current = get_query_var('paged');
            }else{
                $current = 1;
            }
        }
		//$wp_query = new WP_Query('paged='. $current . '&s='.get_query_var('s') );

		$pagination = array(
			'base' => @add_query_arg( 'page' , '%#%' ),
			'format' => '',
			'total' => $wp_query -> max_num_pages,
			'current' => $current,
			'show_all' => false,
			'prev_next'=> true,
			'prev_text'=> __('&laquo; Previous','cosmotheme'),
			'next_text'=> __('Next &raquo;','cosmotheme'),
			'type' => 'array'
		);


		if( !empty($wp_query->query_vars['s'] ) ){
				$pagination['add_args'] = array( 's' => urlencode( get_query_var( 's' ) ) );
        }

		$pgn = paginate_links( $pagination );
        
		if( !empty( $pgn ) ){
			echo '<div class="pag">';
			echo '<ul class="b_pag center p_b">';
			if( $current == 1 ){
				$current--;
			}
			foreach($pgn as $k => $link){
				print '<li>' . str_replace("'",'"',$link) . '</li>';

			}
			echo '</ul>';
			echo '</div>';
		}
	}else{
		$wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;

		$pagination = array(
				'base' => @add_query_arg('page','%#%'),
				'format' => '',
				'total' => $wp_query->max_num_pages,
				'current' => $current,
				'show_all' => false,
				'type' => 'array'
				);


		if( !empty($wp_query->query_vars['s'] ) ){
				$pagination['add_args'] = array( 's' => urlencode( get_query_var( 's' ) ) );
        }

        if( !empty( $wp_query->query_vars['fp_element'] ) && !empty( $wp_query->query_vars['fp_row'] ) && !empty( $wp_query->query_vars['fp_template'] ) ){
				$pagination['add_args'] = array( 'fp_element' => get_query_var( 'fp_element' ), 'fp_row' => get_query_var( 'fp_row' ), 'fp_template' => get_query_var( 'fp_template' ) );
        }

		$pgn = paginate_links( $pagination );
		if( $current == 1 ){
			$current--;
		}

		if(!empty($pgn)){
			echo '<div class="pag">';
			echo '<ul class="b_pag center p_b">';
			foreach($pgn as $k => $link){
				print '<li>' . str_replace( "'" , '"' , $link ) . '</li>';
			}
			echo '</ul>';
			echo '</div>';
		}
	}
?>