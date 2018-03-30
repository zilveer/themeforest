<?php

/*
 * BuildPress Home Page Template for Visual Composer
 */

add_action( 'vc_load_default_templates_action','buildpress_home_page_template_for_vc' );

function buildpress_home_page_template_for_vc() {
	$data               = array();
	$data['name']       = _x( 'BuildPress: Front Page', 'backend' , 'buildpress_wp' );
	$data['weight']     = 0;
	$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() . '/assets/images/pt.svg' );
	$data['custom_class'] = 'buildpress_home_page_template_for_vc_custom_template';
	$data['content']    = <<<CONTENT
		[vc_row full_width="stretch_row" css=".vc_custom_1440661125339{margin-bottom: 30px !important;background-color: #eeeeee !important;}"][vc_column width="1/1"][pt_vc_banner title="Looking for a quality and affordable constructor for your next project?"]

[button style="primary" href="contact-us"]GET A QUOTE[/button]   [button style="default" href="projects"]CHECK OUR PROJECTS[/button]

[/pt_vc_banner][/vc_column][/vc_row][vc_row css=".vc_custom_1440661458044{margin-bottom: 31px !important;}"][vc_column width="1/3"][pt_vc_featured_page page="69" layout="block"][/vc_column][vc_column width="1/3"][pt_vc_featured_page page="73" layout="block"][/vc_column][vc_column width="1/3"][pt_vc_featured_page page="52" layout="inline"][pt_vc_featured_page page="87" layout="inline"][pt_vc_featured_page page="84" layout="inline"][pt_vc_featured_page page="71" layout="inline"][/vc_column][/vc_row][vc_row full_width="stretch_row" css=".vc_custom_1440663379128{margin-bottom: 60px !important;background-color: #454545 !important;}"][vc_column width="1/1"][ess_grid alias="Projects"][/vc_column][/vc_row][vc_row css=".vc_custom_1440664269994{margin-bottom: 45px !important;}"][vc_column width="1/2"][vc_column_text]
<h3 class="widget-title">Why Choose Us</h3>
<h5><span style="color: #fcc71f;">
[fa icon="fa-check"]</span> <span style="color: #333333;">WE ARE PASSIONATE</span></h5>
We have a proven record of accomplishment and are a reputable company in the United States. We ensure that all projects are done with utmost professionalism using quality materials while offering clients the support and accessibility.
<h5><span style="color: #fcc71f;">
[fa icon="fa-check"]</span> HONEST AND DEPENDABLE</h5>
For us, honesty is the only policy and we strive to complete all projects with integrity, not just with our clients, but also our suppliers and contractors. With thousands of successful projects under our belt, we are one of the most trusted construction companies in US
<h5><span style="color: #fcc71f;">
[fa icon="fa-check"]</span> <span style="color: #333333;">WE ARE ALWAYS IMPROVING</span></h5>
We commit ourselves to complete all projects within the timeline set with our clients. We use the best of technology and tools to ensure that all jobs are done quickly but also giving attention to details and ensuring everything is done correctly.[/vc_column_text][/vc_column][vc_column width="1/2"][vc_column_text]
<h3 class="widget-title">Who We Are?</h3>
<a href="http://xml-io.proteusthemes.com/buildpress/wp-content/uploads/sites/16/2014/10/content_24.jpg"><img class="alignleft wp-image-115 size-medium" src="http://xml-io.proteusthemes.com/buildpress/wp-content/uploads/sites/16/2014/10/content_24-300x168.jpg" alt="Content Image" width="300" height="168" /></a><a href="http://xml-io.proteusthemes.com/buildpress/wp-content/uploads/sites/16/2014/10/content_23.jpg"><img class="alignleft wp-image-116 size-medium" src="http://xml-io.proteusthemes.com/buildpress/wp-content/uploads/sites/16/2014/10/content_23-300x168.jpg" alt="Content Image" width="300" height="168" /></a>

BuildPress Inc traces its roots back to 1989 in Colorado and since then have never looked back. With thousands of successful projects under our belt, we can proudly say that we are one of the most trusted construction companies in Colorado performing both domestic and international construction work. For more than 25 years, Construction has offered a wide range of construction services in Colorado, many other cities of United States and around the world.

We strive to maintain the highest standards while exceeding client’s expectations at all levels.
<h5><strong><a href="about-us">READ MORE</a></strong></h5>
[/vc_column_text][/vc_column][/vc_row][vc_row css=".vc_custom_1440664493968{margin-bottom: 0px !important;padding-top: 30px !important;padding-bottom: 30px !important;background: #eeeeee url(http://xml-io.proteusthemes.com/buildpress/wp-content/uploads/sites/16/2014/10/title-area-pattern.png) !important;background-position: 0 0 !important;background-repeat: repeat !important;}" full_width="stretch_row"][vc_column width="1/1"][pt_vc_container_testimonials title="Testimonials" autocycle="no" interval="5000"][pt_vc_testimonial rating="5" quote="Our construction managment professionals organize, lead and manage the people, materials and processes of construction utilizing the latest technologies within the industry. Our construction management Our construction management." author="Bob the Builder"][pt_vc_testimonial rating="5" quote="We aim to eliminate the task of dividing your project between different architecture and construction company. We are a company that offers design and build services for you from initial sketches to the final construction." author="Lennie Lazenby"][pt_vc_testimonial rating="4" quote="We offer quality tiling and painting solutions for interior and exterior of residential and commercial spaces that not only looks good but also lasts longer. We offer quality tiling and painting solutions for interior and exterior." author="Sandy Beach"][pt_vc_testimonial rating="5" quote="For us, honesty is the only policy and we strive to complete all projects with integrity, not just with our clients, but also our suppliers and contractors. With thousands of successful projects under our belt, we are one of the most trusted construction companies in US." author="Dizzy"][/pt_vc_container_testimonials][/vc_column][/vc_row][vc_row full_width="stretch_row" css=".vc_custom_1440664459687{margin-bottom: 60px !important;padding-top: 30px !important;padding-bottom: 30px !important;background: #e8b71f url(http://xml-io.proteusthemes.com/buildpress/wp-content/uploads/sites/16/2014/10/motivational-background.jpg) !important;}"][vc_column width="1/1"][vc_column_text]
<div class="motivational-text">Our promise as a contractor is to build community value into every project while delivering professional expertise, exceptional customers service and quality construction.</div>
[/vc_column_text][/vc_column][/vc_row][vc_row css=".vc_custom_1440665086250{margin-bottom: 15px !important;}"][vc_column width="1/1"][vc_column_text]
<h3 class="widget-title">Clients / Partners / Certificates</h3>
<div class="logo-panel">
<div class="row">
<div class="col-xs-12 col-sm-2"><img src="http://xml-io.proteusthemes.com/buildpress/wp-content/uploads/sites/16/2014/10/client_01.jpg" alt="Client" /></div>
<div class="col-xs-12 col-sm-2"><img src="http://xml-io.proteusthemes.com/buildpress/wp-content/uploads/sites/16/2014/10/client_02.jpg" alt="Client" /></div>
<div class="col-xs-12 col-sm-2"><img src="http://xml-io.proteusthemes.com/buildpress/wp-content/uploads/sites/16/2014/10/client_03.jpg" alt="Client" /></div>
<div class="col-xs-12 col-sm-2"><img src="http://xml-io.proteusthemes.com/buildpress/wp-content/uploads/sites/16/2014/10/client_04.jpg" alt="Client" /></div>
<div class="col-xs-12 col-sm-2"><img src="http://xml-io.proteusthemes.com/buildpress/wp-content/uploads/sites/16/2014/10/client_05.jpg" alt="Client" /></div>
<div class="col-xs-12 col-sm-2"><img src="http://xml-io.proteusthemes.com/buildpress/wp-content/uploads/sites/16/2014/10/client_06.jpg" alt="Client" /></div>
<div class="col-xs-12 col-sm-2"><img src="http://xml-io.proteusthemes.com/buildpress/wp-content/uploads/sites/16/2014/10/client_07.jpg" alt="Client" /></div>
<div class="col-xs-12 col-sm-2"><img src="http://xml-io.proteusthemes.com/buildpress/wp-content/uploads/sites/16/2014/10/client_08.jpg" alt="Client" /></div>
<div class="col-xs-12 col-sm-2"><img src="http://xml-io.proteusthemes.com/buildpress/wp-content/uploads/sites/16/2014/10/client_09.jpg" alt="Client" /></div>
<div class="col-xs-12 col-sm-2"><img src="http://xml-io.proteusthemes.com/buildpress/wp-content/uploads/sites/16/2014/10/client_10.jpg" alt="Client" /></div>
<div class="col-xs-12 col-sm-2"><img src="http://xml-io.proteusthemes.com/buildpress/wp-content/uploads/sites/16/2014/10/client_11.jpg" alt="Client" /></div>
<div class="col-xs-12 col-sm-2"><img src="http://xml-io.proteusthemes.com/buildpress/wp-content/uploads/sites/16/2014/10/client_12.jpg" alt="Client" /></div>
</div>
</div>
[/vc_column_text][/vc_column][/vc_row]
CONTENT;

	vc_add_default_templates( $data );
}