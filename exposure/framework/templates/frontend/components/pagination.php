<?php
	if( empty($type) ) $type = 'numbers';
	$type = is_single() ? 'links' : $type;

	$navPreviousOpen = '<span class="nav-previous">';
	$navNextOpen = '<span class="nav-next">';
	$navPreviousClose = $navNextClose = '</span>';

	$navNumbersOpen = '<ul>';
	$navNumbersClose = '</ul>';

?>

<nav role="navigation" class="thb-navigation <?php echo $class; ?>" id="<?php echo $id; ?>">
	<?php
		switch( $type ) {
			case 'numbers':

				echo $navNumbersOpen;
				thb_numeric_pagination();
				echo $navNumbersClose;

				break;

			default:

				if( is_single() ) {
					if( $alwaysShowLinks || thb_post_has_previous() ) {
						echo $navPreviousOpen;
							if( $previousPostTitle != '' ) {
								previous_post_link($previousText, $previousPostTitle);
							}
							else {
								previous_post_link($previousText);
							}
						echo $navPreviousClose;
					}

					if( $alwaysShowLinks || thb_post_has_next() ) {
						echo $navNextOpen;
							if( $nextPostTitle != '' ) {
								next_post_link($nextText, $nextPostTitle);
							}
							else {
								next_post_link($nextText);
							}
						echo $navNextClose;
					}
				}
				else {
					if( thb_page_has_previous() ) {
						echo $navPreviousOpen;
							previous_posts_link($previousText);
						echo $navPreviousClose;
					}

					if( thb_page_has_next() ) {
						echo $navNextOpen;
							next_posts_link($nextText);
						echo $navNextClose;
					}
				}

				break;
		}
	?>
</nav>