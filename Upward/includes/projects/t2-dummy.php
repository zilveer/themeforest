<?php if ( !defined( 'ABSPATH' ) ) exit;



/*===============================================

 	D U M M Y   P R O J E C T S
	Placeholders for future projects

===============================================*/



	// Get no. of available posts
	$st_['available_posts'] = $wp_query->post_count;

	// Rounded number of posts per page a multiple of 4
	$st_['projects_per_page'] = ceil( $st_['projects_per_page'] / 4 ) * 4 + 1;

	// Get a difference between required and available posts
	$st_['dif'] = $st_['projects_per_page'] - $st_['available_posts'];

	// Get required number of dummy posts
	for ( $i = 1; $i <= 50; $i++ ) {
		if ( $st_['dif'] >= 4 ) {
			$st_['dif'] = $st_['dif'] - 4; }
	}

	// Fix $st_['dif']
	$st_['dif'] = $st_['available_posts'] == 0 ? 0 : $st_['dif'];



	// Display dummy A
	if ( $st_['available_posts'] == 0 ) {

		echo "\n" .
			'<div class="projects-t2-a-wrapper dummy">' .
				'<div>' .
					'<div class="t2-dummy-big"><span>' . __( 'A recent project goes here', 'strictthemes' ) . '</span></div>' .
				'</div>' .
			'</div>';

	}



	// Display dummy B,C,D,E
	if ( $st_['available_posts'] == 0 || $st_['available_posts'] == 1 ) {

		for ( $i = 1; $i <= 4; $i++ ) {

			echo "\n" .
				'<div class="projects-t2-b-wrapper dummy">' .
					'<div>' .
						'<div class="t2-dummy"><span>' . __( 'In progress', 'strictthemes' ) . '</span></div>' .
					'</div>' .
				'</div>';

		}

	}



	// Display dummy posts
	if ( $st_['dif'] > 0 ) {

		for ( $i = 1; $i <= $st_['dif']; $i++ ) {

			$st_['postcount']++;
			$st_['class'] = '';

			// Post's class for dummies no.2..4
			if ( $st_['available_posts'] == 1 || $st_['available_posts'] == 2 || $st_['available_posts'] == 3 || $st_['available_posts'] == 4 ) {
				$st_['class'] = 'projects-t2-b-wrapper'; }

			// Post's class
			elseif ( $st_['postcount'] == 1 ) { $st_['class'] = 'first'; }
			elseif ( $st_['postcount'] == 4 ) { $st_['class'] = 'last'; $st_['postcount'] = 0; }

			echo "\n" .
				'<div class="' . $st_['class'] . ' dummy">' .
					'<div>' .
						'<div class="t2-dummy"><span>' . __( 'In progress', 'strictthemes' ) . '</span></div>' .
					'</div>' .
				'</div>';

		}

	}


?>