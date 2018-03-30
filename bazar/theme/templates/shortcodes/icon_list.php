<?php
	$title = ( isset($var['title']) && $var['title'] != '' ) ? '<h2>' . $title . '</h2>' : '';
	unset ($var['title']);
	unset ($var['content']);
	unset ($var['other_atts']);
	
	$last = (isset($last) && strcmp($last, 'yes') == 0) ? 'last' : '';
?>
<div class="one-fourth icon_list <?php echo $last ?>">
	<?php echo $title ?>
	<ul class="the-icons">	
		<?php for( $i = 1; isset($var['item_'.$i]); $i++ ) :
			$icon = $style = '';
			$icon_url = ( !empty( $var['icon_url_'.$i] ) ) ? esc_url ( $var['icon_url_'.$i] ) : '' ; 
			if ( $icon_url ) :
				//$style = 'style="background: url(' . $icon_url . ') 0px 0px no-repeat"';
				$style = 'style="background: url(' . $icon_url . ') left 5px no-repeat; margin-left: -30px; padding-left: 30px;"';
			else: 
				$icon  = ( empty( $var['icon_'.$i] ) ) ? '' : '' . str_replace('icon-', '', $var['icon_'.$i]);				
			endif;
			$link = ( isset ( $var['item_link_'.$i] ) ) ? esc_url ( $var['item_link_'.$i] ) : '';
			$item = ( $link != '' ) ? '<a href="' . $link . '">' . $var['item_'.$i] . '</a>' : $var['item_'.$i];
			echo '<li class="icon-' . $icon . '" ' . $style . '>' . $item . '</li>';
		endfor ?>
	</ul>
</div>