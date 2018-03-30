Some changes to the redux code when updating

//framework.php -> comment line 62
require_once( dirname( __FILE__ ) . '/inc/welcome/welcome.php' ); 

//framework.php -> add line 800
do_action( "kleo-opts-saved", $value );

//framework.php
line418 && 1250 comment

//extensions/customizer -> line 334
'transport'         => isset($option['customizer_post']) ? 'postMessage' : 'refresh',

//image_select/field.php
echo '<img src="' . $v['img'] . '" alt="' . $v['alt'] . '" title="'. $v['alt'] .'" class="' . $v['class'] . '" style="' . $style . '"' . $presets . $merge . ' />';