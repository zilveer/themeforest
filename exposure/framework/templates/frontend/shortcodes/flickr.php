<?php

/**
 * Remote URL
 */
$url = 'http://www.flickr.com/badge_code_v2.gne?';
$url .= 'count=' . $num;
$url .= '&amp;display=latest&amp;size=s&amp;layout=x&amp;source=user&amp;user=' . $id;

?>

<div class="thb-shortcode thb-flickr <?php echo implode(' ', $class); ?>">

	<?php if( $title != '' ) : ?>
		<h1 class="thb-shortcode-title"><?php echo thb_text_format($title); ?></h1>
	<?php endif; ?>
    <script type="text/javascript" src="<?php echo $url; ?>"></script>
    
</div>