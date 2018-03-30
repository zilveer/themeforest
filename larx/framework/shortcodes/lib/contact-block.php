<?php

// Contact block

function th_contact_block($atts, $content = null) {
    extract(shortcode_atts(array(
        "type" => 'text',
        "title" => '',
        "address" => '',
        "email" => '',
        "phone" => '',
        "icon" => '',
		"addres_doubled" => 'Address',
		"addres_content_doubled" => '',
		"tel_doubled" => '',
		"tel_content_doubled" => '',
		"fax_doubled" => '',
		"fax_content_doubled" => '',
		"mail_doubled" => '',
		"mail_content_doubled" => '',
        "el_class" => '',
    ), $atts));

    $icon = str_replace('fa-','',$icon);
	$output = '';
	
    if($type == 'text') {
        $output .='<div class="f-logo '.$el_class.'">
                    <h2>'.$content.'</h2>
                  </div>';
    }elseif($type == 'data'){

        $output .='<div class="row f-inner '.$el_class.'">
                    <div class="col-sm-2">
                        <i class="fa fa-'.$icon.' fa-lg"></i>
                    </div>
                    <div class="col-sm-10">
                        <strong>'.$title.'</strong>
                        <div class="f-space"></div>
                        <address>'.$address.'<br>
                            '.$phone.'<br>
                            '.$email.'
                        </address>
                    </div>
                 </div>';

    }elseif($type == 'doubled'){
		if($addres_content_doubled !== '' || $tel_content_doubled !== '' ) {
								
			$output .='<div class="row">';
				
				if($addres_content_doubled !== ''){
						$output .= '<!-- Adress -->                       
									<div class="col-sm-3 col-md-6">
										<div class="col-sm-2 contact-icon">
											<i class="fa fa-map-marker"></i>
										</div>
										<div class="col-sm-10">
											<span><b>'.$addres_doubled.'</b></span> 
											<address>                            
												<small>
													'.$addres_content_doubled.'                                                           
												</small>                               
											</address>             
										</div>                   
									</div>';
				}
				if($tel_content_doubled !== ''){
						$output .= '<!-- Phone -->
										<div class="col-sm-3 col-md-6">
											<div class="col-sm-2 contact-icon">
												<i class="fa fa-phone"></i>
											</div>
											<div class="col-sm-10">
												<span><b>'.$tel_doubled.'</b></span>
												<address>                            
													<small>                                                           
													  '.$tel_content_doubled.'
													</small>
												</address>            
											</div>                    
										</div>';
				}
			
				$output .='</div>';	
		}
		
			if($fax_content_doubled !== '' || $mail_content_doubled !== '' ) {
			
			$output .='<div class="row">';
				
				if($fax_content_doubled !== ''){
						$output .= '<!-- Fax -->
                                    <div class="col-sm-3 col-md-6">
                                        <div class="col-sm-2 contact-icon">
                                            <i class="fa fa-fax"></i>
                                        </div>
                                        <div class="col-sm-10">
                                            <span><b>'.$fax_doubled.'</b></span>
                                            <address>                            
                                                <small>
                                                    '.$fax_content_doubled.'                          
                                                </small>
                                            </address>
                                        </div>
                                    </div>';	
									
				}
				if($mail_content_doubled !== ''){
						$output .= '<!-- Email -->
                                    <div class="col-sm-3 col-md-6">
                                        <div class="col-sm-2 contact-icon">
                                            <i class="fa fa-envelope"></i>
                                        </div>
                                        <div class="col-sm-10">
                                            <span><b>'.$mail_doubled.'</b></span>
                                            <address>                            
                                                <small>
                                                   '.$mail_content_doubled.'                    
                                                </small>
                                            </address>
                                        </div>
                                    </div>';
				}
			
				$output .='</div>';	
			
			}
    }

    return $output;

}

remove_shortcode('contact-block');
add_shortcode('contact-block', 'th_contact_block');