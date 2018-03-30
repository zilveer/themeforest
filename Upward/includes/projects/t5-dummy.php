<?php if ( !defined( 'ABSPATH' ) ) exit;



/*===============================================

 	D U M M Y   P R O J E C T S
	Placeholders for future projects

===============================================*/



	// Rounded number of posts per page a multiple of 4
	$st_['projects_per_page'] = ceil( $st_['projects_per_page'] / 4 ) * 4;

	// Get a difference between required and available posts
	$st_['dif'] = $st_['projects_per_page'] - $wp_query->post_count;

	// Get required number of dummy posts
	for ( $i = 1; $i <= 50; $i++ ) {
		if ( $st_['dif'] >= 4 ) {
			$st_['dif'] = $st_['dif'] - 4; }
	}



	if ( $wp_query->post_count == 0 ) {

		echo '
			<div class="project first">
				<div>
					<div class="t5-dummy"><span>' . __( 'A recent project goes here', 'strictthemes' ) . '</span></div>
				</div>
			</div>

			<div class="project">
				<div>
					<div class="t5-dummy"><span>' . __( 'In progress', 'strictthemes' ) . '</span></div>
				</div>
			</div>

			<div class="project">
				<div>
					<div class="t5-dummy"><span>' . __( 'In progress', 'strictthemes' ) . '</span></div>
				</div>
			</div>

			<div class="project last">
				<div>
					<div class="t5-dummy"><span>' . __( 'In progress', 'strictthemes' ) . '</span></div>
				</div>
			</div>';

	}



	// Display dummy posts
	if ( $st_['dif'] > 0 ) {

		for ( $i = 1; $i <= $st_['dif']; $i++ ) {

			$st_['postcount']++;
			$st_['class'] = '';

			// Post's class
			if ( $st_['postcount'] == 1 ) { $st_['class'] = ' first'; }
			if ( $st_['postcount'] == 4 ) { $st_['class'] = ' last'; $st_['postcount'] = 0; }

			echo "\n" .
				'<div class="project' . $st_['class'] . '">' .
					'<div>' .
						'<div class="t5-dummy"><span>' . __( 'In progress', 'strictthemes' ) . '</span></div>' .
					'</div>' .
				'</div>';

		}


	}


?>