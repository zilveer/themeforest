<?php
function cshero_icon($params, $content = null) {
    extract(shortcode_atts(array(
        'type' => '',
        'background_color'=>'',
        'link' => '',
        'class' => '',
        'style' => '',
        'fontsize'=>''
    ), $params));
    $color = '';
    if($background_color!=''){
        $color='color:'.$background_color.';';
    }
    if($fontsize!=''){
        $fontsize=' font-size:'.$fontsize.'px;';
    }
    if($content){
    	$content = '<span class="cs_icons"> '.esc_attr($content).'</span>';
    }
    ob_start();
    ?>
    <?php if($link): ?>
    	<a class="cs_icons <?php echo $style;?>" target="_blank" href="<?php echo esc_url($link); ?>">
    		<i class=" <?php echo esc_attr($type) . ' ' . esc_attr($class);?>" style="<?php echo esc_attr($color).esc_attr($fontsize);?>">
    			<?php echo $content; ?>
    		</i>
    	</a>
    <?php else : ?>
		<i class="cs_icons <?php echo $style;?> <?php echo esc_attr($type) . ' ' . esc_attr($class);?>" style="<?php echo esc_attr($color).esc_attr($fontsize);?>">
    		<?php echo $content; ?>
    	</i>
    <?php endif; ?>
    <?php
    return ob_get_clean();
}

add_shortcode('icon', 'cshero_icon');