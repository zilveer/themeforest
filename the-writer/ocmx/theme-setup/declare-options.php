<?php
function ocmx_install_options (){
	$ocmx_tabs = array(
						array(
							  "option_header" => "Install OCMX",
							  "use_function" => "ocmx_show_install" ,
							  "function_args" => array("OCMX General Options", "OCMX Social Media Widgets and Links", "Advert Management", "OCMX Like/Unlike", "Advances Comment Functionality and Storage"),
							  "ul_class" => "form-options clearfix"
						  )
					);

	$ocmx_container = new OCMX_Container();
	$ocmx_container->load_container("Welcome to OCMX", $ocmx_tabs);
};

function ocmx_general_options (){
	$ocmx_tabs = array(
					array(
						  "option_header" => "General Options",
						  "use_function" => "ocmx_fetch_options",
						  "function_args" => "general_site_options",
						  "ul_class" => "admin-block-list clearfix"
					  ),
					array(
						  "option_header" => "Footer",
						  "use_function" => "ocmx_fetch_options",
						  "function_args" => "footer_options",
						  "ul_class" => "admin-block-list clearfix"
					  ),
					array(
						  "option_header" => "Social",
						  "use_function" => "ocmx_fetch_options",
						  "function_args" => "post_social_options",
						  "ul_class" => "admin-block-list clearfix"
					  ),
					array(
						  "option_header" => "Customization",
						  "use_function" => "ocmx_fetch_options",
						  "function_args" => "custom_options",
						  "ul_class" => "admin-block-list clearfix"
					  )
				);
	$ocmx_container = new OCMX_Container();
	$ocmx_container->load_container("General Options", $ocmx_tabs);
};

?>