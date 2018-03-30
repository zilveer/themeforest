<?php

	if( empty( $url ) ) {
        return '';
    }
    
    $is_slider = ( $number > 1 ) ? true : false;
    
    $feeds = fetch_feed( $url );
    
    if( is_wp_error( $feeds ) ) {
        return '';
    }
    
    $feeds_number = $feeds->get_item_quantity( $number );
    
    if( $feeds_number != 0 ) :
        $feeds_item = $feeds->get_items( 0, $feeds_number );
    endif;
    	
?>

<div class="feeds-slider">
    <ul class="feeds group">
        <?php foreach( $feeds_item as $item ) : ?>
        <li>
            <h3><a href="<?php echo esc_url( $item->get_permalink() ) ?>" title="<?php echo esc_html( $item->get_title() ) ?>"><?php echo esc_html( $item->get_title() ) ?></a></h3>
            <p><?php echo $item->get_content() ?></p>
        </li>
        <?php endforeach; ?>
    </ul>
    <?php if( $is_slider ) : ?>
        <div class="prev"></div>
        <div class="next"></div>
    <?php endif; ?>
</div>
<?php if ( $is_slider ) : ?>                    
<script type="text/javascript">
    jQuery(function($){
        $('.feeds-slider ul').cycle({
            fx : 'scrollHorz',
            speed: <?php echo $speed ?>,
            timeout: <?php echo $timeout ?>,
            next: '.feeds-slider .next',
            prev: '.feeds-slider .prev'
        });
    });
</script>
<?php
endif;