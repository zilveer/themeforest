<?php

class pricetable
{

    public function register_shortcode($shortcodeName)
    {
        if (!function_exists("shortcode_pricetable")) {
            function shortcode_pricetable($atts, $content = null)
            {

                global $gt3_pbconfig;
                $compile = '';

                extract(shortcode_atts(array(
                    'heading_size' => $gt3_pbconfig['default_heading_in_module'],
                    'heading_color' => '',
                    'heading_text' => '',
                    'price_items_number' => '1',
                ), $atts));

                #heading
                if (strlen($heading_color) > 0) {
                    $custom_color = "color:#{$heading_color};";
                }
                if (strlen($heading_text) > 0) {
                    $compile .= "<" . $heading_size . " style='" . (isset($custom_color) ? $custom_color : '') . "' class='headInModule'>{$heading_text}</" . $heading_size . ">";
                }

                $compile .= '<div class="module_price_table">' . do_shortcode($content) . '</div>';

                return $compile;

            }
        }

        add_shortcode($shortcodeName, 'shortcode_pricetable');
    }
}


#Shortcode name
$shortcodeName = "pricetable";


#Compile UI for admin panel
#Don't change this line
global $compileShortcodeUI;
$compileShortcodeUI .= "<div class='whatInsert whatInsert_" . $shortcodeName . "'>" . $defaultUI . "</div>";

#Your code
$compileShortcodeUI .= "
Title: <input style='width:223px;text-align:center;' value='' type='text' class='" . $shortcodeName . "_title' name='" . $shortcodeName . "_title'>
<br>
Price: <input style='width:223px;text-align:center;' value='' type='text' class='" . $shortcodeName . "_price' name='" . $shortcodeName . "_price'>
<br>
URL: <input style='width:223px;text-align:center;' value='' type='text' class='" . $shortcodeName . "_url' name='" . $shortcodeName . "_url'>
<br>
Type: 
<select name='" . $shortcodeName . "_type' class='" . $shortcodeName . "_type'>
	<option value='default_popular'>Default</option>
    <option value='most_popular'>Most popular</option>
</select>

<script>
	function " . $shortcodeName . "_handler() {
	
		/* YOUR CODE HERE */
		var title = jQuery('." . $shortcodeName . "_title').val();
		var price = jQuery('." . $shortcodeName . "_price').val();
		var url = jQuery('." . $shortcodeName . "_url').val();
		var type = jQuery('." . $shortcodeName . "_type').val();
		
		/* END YOUR CODE */
	
		/* COMPILE SHORTCODE LINE */
		var compileline = '[" . $shortcodeName . " type=\"'+type+'\" title=\"'+title+'\" price=\"'+price+'\" url=\"'+url+'\"]put here some ul[/" . $shortcodeName . "]';
				
		/* DO NOT CHANGE THIS LINE */
		jQuery('.whatInsert_" . $shortcodeName . "').html(compileline);
	}
</script>

";


#Register shortcode & set parameters
$shortcode_pricetable = new pricetable();
$shortcode_pricetable->register_shortcode($shortcodeName);

#add shortcode to wysiwyg 
#$shortcodesUI['pricetable'] = array("name" => $shortcodeName, "handler" => $compileShortcodeUI);

unset($compileShortcodeUI);


#for pricetable_item
class pricetable_item
{

    public function register_shortcode($name)
    {
        function shortcode_pricetable_item($atts, $content = null)
        {
            extract(shortcode_atts(array(
                'block_link' => '',
                'get_it_now_caption' => '',
                'most_popular' => '',
                'price_features' => "",
                'block_price' => "",
                'block_name' => "",
                'block_period' => "",
                'width' => "",
            ), $atts));

            $price_features = explode("||-||", $price_features);

            $compile = '';

            $compile .= '
                <div class="price_item '.($most_popular == "yes" ? 'most_popular' : '').'" style="width:' . $width . '%;">
                    <div class="price_item_wrapper">
                        <div class="price_item_title"><h2>' . $block_name . '</h2></div>
                        <div class="price_item_cost"><h1>' . $block_price . '<span>' . $block_period . '</span></h1></div>';

            if (isset($price_features) && is_array($price_features)) {
                foreach ($price_features as $value) {
                    $compile .= '<div class="price_item_text">'.$value.'</div>';
                }
            }

$compile .= '           <div class="price_item_btn"><a href="'.$block_link.'" class="shortcode_button btn_large btn_type1">'.$get_it_now_caption.'</a></div>
                    </div>
                </div>
            ';

            return $compile;

        }

        add_shortcode($name, 'shortcode_pricetable_item');
    }
}

#Register shortcode & set parameters
$pricetable_item = new pricetable_item();
$pricetable_item->register_shortcode("pricetable_item");

?>