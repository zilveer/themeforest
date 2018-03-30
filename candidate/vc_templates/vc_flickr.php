<?php
$output = '';
extract(shortcode_atts(array(
    'el_class' => '',
    'title' => '',
    'flickr_id' => '76745153@N04',
    'count' => '6',
    'type' => 'user',
    'display' => 'latest'
), $atts));

$el_class = $this->getExtraClass( $el_class );
$css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_flickr_widget wpb_content_element'.$el_class, $this->settings['base']);

$output .= "\n\t".'<div class="sidebar-box white flickr-photos '.$css_class.'">';
$output .= '<h3>'. $title .'</h3>';
$output .= '<ul class="flickr-feed">';

$output .= "\n\t".'</ul></div>'.$this->endBlockComment('.wpb_flickr_widget')."\n";
echo $output;
?> <script type="text/javascript"> 

jQuery(document).ready(function($){
			$('.flickr-feed').jflickrfeed({
						limit: <?php echo $count; ?>,
						qstrings: {
							id: '<?php echo $flickr_id; ?>'
						},
						itemTemplate: 
						'<li>' +
							'<a href="{{link}}" target="_blank"><img src="{{image_s}}" alt="{{title}}" /></a>' +
						'</li>'
					});
});

		</script> <?php
		
		



