<?php

// Modal window

function th_modal($attrs,$content=false){
    extract(shortcode_atts(array(
        'title'=>'Work with us',
        "id" => '21',
    ),$attrs));

	function_exists('wpcf7_add_shortcodes') && wpcf7_add_shortcodes() || function_exists('wpcf7') && wpcf7();
	
	$rand_id = rand(1,99999); 

	$output = '';
	$output .= '<div class="f-action">
				<a href="#" class="f-cta" data-toggle="modal" data-target="#myModal'.$rand_id.'">'.$title.'</a>
			</div>';


    $output .= '<!-- Modal -->
                <div class="modal fade" id="myModal'.$rand_id.'" tabindex="-1" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content text-center">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            </div>
                            <div class="modal-body">
                                <div id="contact">';

    $output .= do_shortcode('[contact-form-7 id="'.$id.'"]');


    $output .= '<!-- End Contact Form -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';


    return $output;
}

remove_shortcode('modal');
add_shortcode('modal', 'th_modal');