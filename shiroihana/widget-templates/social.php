<?php if( ! empty( $items ) ):

?><ul class="plain-list"><?php

	foreach( $items as $item ):

		$item = wp_parse_args( $item, array(
			'url'    => '', 
			'title'  => '', 
			'icon'   => '', 
			'newtab' => false
		));

	?><li class="social-<?php echo esc_attr( $item['icon'] ) ?>">
		<a href="<?php echo esc_url( $item['url'] ) ?>"<?php 

			if( $item['newtab'] ) echo ' target="_blank"';
			if( $item['title'] ) echo ' title="' . esc_attr( $item['title'] ) . '"';

		?>><i class="socicon socicon-<?php echo esc_attr( $item['icon'] ) ?>"></i></a>
	</li><?php 

	endforeach; 
?></ul>
<?php endif;
