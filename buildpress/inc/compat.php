<?php
/**
 * Compatibility hooks for BuildPress WP theme.
 *
 * For 3rd party plugins/features.
 *
 * @package BuildPress
 */

if ( defined( 'SITEORIGIN_PANELS_VERSION' ) ) {
	if ( version_compare( SITEORIGIN_PANELS_VERSION, '2.0', '<' ) ) { // old version
		/**
		 * Add custom row styles to the Page Builder
		 *
		 * @param  array $styles
		 * @return array
		 */
		function buildpress_panels_row_styles( $styles ) {
			$styles['wide-no-container'] = _x( 'Wide (No Container)', 'backend', 'buildpress_wp' );
			$styles['wide-color']        = _x( 'Wide Solid Background Color', 'backend', 'buildpress_wp' );
			$styles['wide-color-dark']   = _x( 'Wide Solid Background Dark Color', 'backend', 'buildpress_wp' );
			$styles['wide-pattern']      = _x( 'Wide Pattern Background', 'backend', 'buildpress_wp' );
			$styles['wide-image']        = _x( 'Wide Image Background', 'backend', 'buildpress_wp' );
			return $styles;
		}
		add_filter( 'siteorigin_panels_row_styles', 'buildpress_panels_row_styles', 10, 1 );



		/**
		 * Add custom row styles to the Page Builder
		 *
		 * @param  string $default
		 * @param  array $row_data
		 * @return string
		 */
		function buildpress_panels_before_row( $default, $row_data ) {
			if ( in_array( 'wide-no-container', $row_data[ 'style' ] ) ) {
				return '</div>';
			}
			else if ( in_array( 'wide-color', $row_data[ 'style' ] ) ) {
				return '</div>
					<div class="wide-color"><div class="container">';
			}
			else if ( in_array( 'wide-color-dark', $row_data[ 'style' ] ) ) {
				return '</div>
					<div class="wide-color-dark"><div class="container">';
			}
			else if ( in_array( 'wide-pattern', $row_data[ 'style' ] ) ) {
				return '</div>
					<div class="wide-pattern"><div class="container">';
			}
			else if ( in_array( 'wide-image', $row_data[ 'style' ] ) ) {
				return '</div>
					<div class="wide-image"><div class="container">';
			}
			else {
				return $default;
			}
		}
		add_filter( 'siteorigin_panels_before_row', 'buildpress_panels_before_row', 10, 2 );



		/**
		 * Add custom row styles to the Page Builder
		 *
		 * @param  string $default
		 * @param  array $row_data
		 * @return string
		 */
		function buildpress_panels_after_row( $default, $row_data ) {
			if ( in_array( 'wide-no-container', $row_data[ 'style' ] ) ) {
				return '<div class="container">';
			}
			else if (
				in_array( 'wide-color', $row_data[ 'style' ] ) ||
				in_array( 'wide-color-dark', $row_data[ 'style' ] ) ||
				in_array( 'wide-pattern', $row_data[ 'style' ] ) ||
				in_array( 'wide-image', $row_data[ 'style' ] )
			) {
				return '</div></div>
					<div class="container">';
			}
			else {
				return $default;
			}
		}
		add_filter( 'siteorigin_panels_after_row', 'buildpress_panels_after_row', 10, 2 );
	}
	else { // new version
		function buildpress_panels_prebuilt_layouts( $layouts ) {
			$layouts['buildpress-home'] = array (
				'name'        => _x( 'Home Page', 'backend', 'buildpress_wp' ),
				'description' => _x( 'Default home page for BuildPress', 'backend', 'buildpress_wp' ),
				'widgets' =>
				array (0 => array ('text' => 'Looking for a quality and affordable constructor for your next project?','textarea' => '[button style="primary" href="contact-us"]GET A QUOTE[/button]   [button style="default" href="projects"]CHECK OUR PROJECTS[/button]','panels_info' => array ('class' => 'PT_Banner','raw' => false,'grid' => 0,'cell' => 0,'id' => 0,),),1 => array ('page_id' => 69,'layout' => 'block','panels_info' => array ('class' => 'PT_Featured_Page','raw' => false,'grid' => 1,'cell' => 0,'id' => 1,'style' => array ('background_display' => 'tile',),),),2 => array ('page_id' => '73','layout' => 'block','panels_info' => array ('class' => 'PT_Featured_Page','raw' => false,'grid' => 1,'cell' => 1,'id' => 2,),),3 => array ('page_id' => '52','layout' => 'inline','panels_info' => array ('class' => 'PT_Featured_Page','raw' => false,'grid' => 1,'cell' => 2,'id' => 3,),),4 => array ('page_id' => '87','layout' => 'inline','panels_info' => array ('class' => 'PT_Featured_Page','raw' => false,'grid' => 1,'cell' => 2,'id' => 4,),),5 => array ('page_id' => '84','layout' => 'inline','panels_info' => array ('class' => 'PT_Featured_Page','raw' => false,'grid' => 1,'cell' => 2,'id' => 5,),),6 => array ('page_id' => '71','layout' => 'inline','panels_info' => array ('class' => 'PT_Featured_Page','raw' => false,'grid' => 1,'cell' => 2,'id' => 6,),),7 => array ('ess_grid_title' => '','ess_grid' => '33','ess_grid_pages' => '','panels_info' => array ('class' => 'Essential_Grids_Widget','raw' => false,'grid' => 2,'cell' => 0,'id' => 7,),),8 => array ('title' => '','text' => '','panels_info' => array ('class' => 'WP_Widget_Text','raw' => false,'grid' => 3,'cell' => 0,'id' => 8,),),9 => array ('type' => 'visual','title' => 'Why Choose Us','text' => '<h5><span style="color: #fcc71f">
			[fa icon="fa-check"]</span> <span style="color: #333333">WE ARE PASSIONATE</span></h5>
			We have a proven record of accomplishment and are a reputable company in the United States. We ensure that all projects are done with utmost professionalism using quality materials while offering clients the support and accessibility.
			<h5><span style="color: #fcc71f">
			[fa icon="fa-check"]</span> HONEST AND DEPENDABLE</h5>
			For us, honesty is the only policy and we strive to complete all projects with integrity, not just with our clients, but also our suppliers and contractors. With thousands of successful projects under our belt, we are one of the most trusted construction companies in US
			<h5><span style="color: #fcc71f">
			[fa icon="fa-check"]</span> <span style="color: #333333">WE ARE ALWAYS IMPROVING</span></h5>
			We commit ourselves to complete all projects within the timeline set with our clients. We use the best of technology and tools to ensure that all jobs are done quickly but also giving attention to details and ensuring everything is done correctly.','filter' => '1','panels_info' => array ('class' => 'WP_Widget_Black_Studio_TinyMCE','raw' => false,'grid' => 3,'cell' => 0,'id' => 9,),),10 => array ('title' => '','text' => '','filter' => false,'panels_info' => array ('class' => 'WP_Widget_Text','raw' => false,'grid' => 3,'cell' => 1,'id' => 10,),),11 => array ('type' => 'visual','title' => 'Who We Are?','text' => '<a href="//placehold.it/300" alt="Content Image" width="300" height="168" /></a><a href="//placehold.it/300" alt="Content Image" width="300" height="168" /></a>

			BuildPress Inc traces its roots back to 1989 in Colorado and since then have never looked back. With thousands of successful projects under our belt, we can proudly say that we are one of the most trusted construction companies in Colorado performing both domestic and international construction work. For more than 25 years, Construction has offered a wide range of construction services in Colorado, many other cities of United States and around the world.

			We strive to maintain the highest standards while exceeding client\'s expectations at all levels.
			<h5><strong><a href="about-us">READ MORE</a></strong></h5>','filter' => '1','panels_info' => array ('class' => 'WP_Widget_Black_Studio_TinyMCE','raw' => false,'grid' => 3,'cell' => 1,'id' => 11,),),12 => array ('title' => 'Testimonials','autocycle' => 'no','interval' => '5000','testimonials' => array (1 => array ('quote' => 'Our construction managment professionals organize, lead and manage the people, materials and processes of construction utilizing the latest technologies within the industry. Our construction management Our construction management.','author' => 'Bob the Builder','rating' => '5','id' => '1',),2 => array ('quote' => 'We aim to eliminate the task of dividing your project between different architecture and construction company. We are a company that offers design and build services for you from initial sketches to the final construction.','author' => 'Lennie Lazenby','rating' => '5','id' => '2',),3 => array ('quote' => 'We offer quality tiling and painting solutions for interior and exterior of residential and commercial spaces that not only looks good but also lasts longer. We offer quality tiling and painting solutions for interior and exterior.','author' => 'Sandy Beach','rating' => '4','id' => '3',),4 => array ('quote' => 'For us, honesty is the only policy and we strive to complete all projects with integrity, not just with our clients, but also our suppliers and contractors. With thousands of successful projects under our belt, we are one of the most trusted construction companies in US.','author' => 'Dizzy','rating' => '5','id' => '4',),),'panels_info' => array ('class' => 'PT_Testimonials','raw' => false,'grid' => 4,'cell' => 0,'id' => 12,),),13 => array ('title' => '','text' => '<div class="motivational-text">Our promise as a contractor is to build community value into every project while delivering professional expertise, exceptional customers service and quality construction.</div>','filter' => '','panels_info' => array ('class' => 'WP_Widget_Text','raw' => false,'grid' => 5,'cell' => 0,'id' => 13,),),14 => array ('title' => 'Clients / Partners / Certificates','text' => '<div class="logo-panel">
				<div class="row">
					<div class="col-xs-12  col-sm-2">
						<img src="//placehold.it/208x98" alt="Client">
					</div>
					<div class="col-xs-12  col-sm-2">
						<img src="//placehold.it/208x98" alt="Client">
					</div>
					<div class="col-xs-12  col-sm-2">
						<img src="//placehold.it/208x98" alt="Client">
					</div>
					<div class="col-xs-12  col-sm-2">
						<img src="//placehold.it/208x98" alt="Client">
					</div>
					<div class="col-xs-12  col-sm-2">
						<img src="//placehold.it/208x98" alt="Client">
					</div>
					<div class="col-xs-12  col-sm-2">
						<img src="//placehold.it/208x98" alt="Client">
					</div>
					<div class="col-xs-12  col-sm-2">
						<img src="//placehold.it/208x98" alt="Client">
					</div>
					<div class="col-xs-12  col-sm-2">
						<img src="//placehold.it/208x98" alt="Client">
					</div>
					<div class="col-xs-12  col-sm-2">
						<img src="//placehold.it/208x98" alt="Client">
					</div>
					<div class="col-xs-12  col-sm-2">
						<img src="//placehold.it/208x98" alt="Client">
					</div>
					<div class="col-xs-12  col-sm-2">
						<img src="//placehold.it/208x98" alt="Client">
					</div>
					<div class="col-xs-12  col-sm-2">
						<img src="//placehold.it/208x98" alt="Client">
					</div>
				</div>
			</div>','filter' => '','panels_info' => array ('class' => 'WP_Widget_Text','raw' => false,'grid' => 6,'cell' => 0,'id' => 14,),),
				),
				'grids' =>
				array (0 => array ('cells' => 1,'style' => array ('bottom_margin' => '30px','row_stretch' => 'full','background' => '#eeeeee','background_display' => 'tile',),),1 => array ('cells' => 3,'style' => array ('background_display' => 'tile',),),2 => array ('cells' => 1,'style' => array ('row_stretch' => 'full','background' => '#454545','background_display' => 'tile',),),3 => array ('cells' => 2,'style' => array ('background_display' => 'tile',),),4 => array ('cells' => 1,'style' => array ('bottom_margin' => '0px','padding' => '30px','row_stretch' => 'full','background' => '#eeeeee','background_image_attachment' => 2149,'background_display' => 'tile',),),5 => array ('cells' => 1,'style' => array ('bottom_margin' => '60px','padding' => '30px','row_stretch' => 'full','background' => '#e8b71f','background_image_attachment' => 2148,'background_display' => 'cover',),),6 => array ('cells' => 1,'style' => array ('background_display' => 'tile',),),
				),
				'grid_cells' =>
				array (0 => array ('grid' => 0,'weight' => 1,),1 => array ('grid' => 1,'weight' => 0.33333333333333331,),2 => array ('grid' => 1,'weight' => 0.33333333333333331,),3 => array ('grid' => 1,'weight' => 0.33333333333333331,),4 => array ('grid' => 2,'weight' => 1,),5 => array ('grid' => 3,'weight' => 0.5,),6 => array ('grid' => 3,'weight' => 0.5,),7 => array ('grid' => 4,'weight' => 1,),8 => array ('grid' => 5,'weight' => 1,),9 => array ('grid' => 6,'weight' => 1,),
				),
			);

			$layouts['buildpress-about-us'] = array (
				'name'        => _x( 'About Us', 'backend', 'buildpress_wp' ),
				'description' => _x( 'Default about us page for BuildPress', 'backend', 'buildpress_wp' ),
				'widgets' =>
				array (0 => array ('type' => 'visual','title' => '','text' => 'BuildPress Inc traces its roots back to 1989 in Colorado and since then have never looked back. With thousands of successful projects under our belt, we can proudly say that we are one of the most trusted construction companies in Colorado performing both domestic and international construction work.

			For more than 25 years, Construction has offered a wide range of construction services in Colorado, many other cities of United States and around the world. We strive to maintain the highest standards while exceeding client\'s expectations at all levels. We not only honor commitments, but are known for meeting tough deadlines while delivering nothing but the best. We aim to create a responsive client relationship that allows us to meet and even exceed the goals of each of our projects.

			BuildPress Inc is well known for its innovation and by collaborating successfully with our customers, designers, sub-contractors, consultants as well as suppliers; we have been able to provide more specialized level of services. We are continuously evolving and understand the different aspects of delivering high value construction and complex projects with ease.','filter' => '1','info' => array ('grid' => '0','cell' => '0','id' => '0','class' => 'WP_Widget_Black_Studio_TinyMCE',),),1 => array ('type' => 'visual','title' => '','text' => '<a href="//placehold.it/1024" alt="Project Image" width="1024" height="574" /></a>','filter' => '1','info' => array ('grid' => '0','cell' => '1','id' => '1','class' => 'WP_Widget_Black_Studio_TinyMCE',),),2 => array ('type' => 'visual','title' => '','text' => '<h4><a href="//placehold.it/526x350"><img class="alignleft size-full wp-image-291" src="//placehold.it/526x350" alt="about_us_1" width="526" height="350" /></a></h4>
			<h5>GEORGE QUICK</h5>
			<em>CEO and Board Member</em>

			Ut lobortis magna tortor, nec porttitor turpis porta in. Donec a felis sed ligula aliquet sollicitudin a in elit. Nunc at commodo erat, fringilla egestas tortor. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae.','filter' => '1','info' => array ('grid' => '1','cell' => '0','id' => '2','class' => 'WP_Widget_Black_Studio_TinyMCE',),),3 => array ('type' => 'visual','title' => '','text' => '<h4><a href="//placehold.it/526x350"><img class="alignleft size-full wp-image-297" src="//placehold.it/526x350" alt="about_us_7" width="526" height="350" /></a></h4>
			<h5>SAMANTHA FOX</h5>
			<em>Chief Accountant Manager</em>

			Ut lobortis magna tortor, nec porttitor turpis porta in. Donec a felis sed ligula aliquet sollicitudin a in elit. Nunc at commodo erat, fringilla egestas tortor. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae.','filter' => '1','info' => array ('grid' => '1','cell' => '1','id' => '3','class' => 'WP_Widget_Black_Studio_TinyMCE',),),4 => array ('type' => 'visual','title' => '','text' => '<h4><a href="//placehold.it/526x350"><img class="alignleft size-full wp-image-293" src="//placehold.it/526x350" alt="about_us_3" width="526" height="350" /></a></h4>
			<h5>JEREMY HENDRIXON</h5>
			<em>CTO and Finance Manager</em>

			Ut lobortis magna tortor, nec porttitor turpis porta in. Donec a felis sed ligula aliquet sollicitudin a in elit. Nunc at commodo erat, fringilla egestas tortor. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae.','filter' => '1','info' => array ('grid' => '1','cell' => '2','id' => '4','class' => 'WP_Widget_Black_Studio_TinyMCE',),),5 => array ('type' => 'visual','title' => '','text' => '<h4><a href="//placehold.it/526x350"><img class="alignleft size-full wp-image-298" src="//placehold.it/526x350" alt="about_us_8" width="526" height="350" /></a></h4>
			<h5>WILLIAM WASHINGTON</h5>
			<em>CEO and Board Member</em>

			Ut lobortis magna tortor, nec porttitor turpis porta in. Donec a felis sed ligula aliquet sollicitudin a in elit. Nunc at commodo erat, fringilla egestas tortor. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae.','filter' => '1','info' => array ('grid' => '1','cell' => '3','id' => '5','class' => 'WP_Widget_Black_Studio_TinyMCE',),),6 => array ('type' => 'visual','title' => '','text' => '<h4><a href="//placehold.it/526x350"><img class="alignleft size-full wp-image-295" src="//placehold.it/526x350" alt="about_us_5" width="526" height="350" /></a></h4>
			<h5>REBECCA RAMIREZ</h5>
			<em>Chief Accountant Manager</em>

			Ut lobortis magna tortor, nec porttitor turpis porta in. Donec a felis sed ligula aliquet sollicitudin a in elit. Nunc at commodo erat, fringilla egestas tortor. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae.','filter' => '1','info' => array ('grid' => '2','cell' => '0','id' => '6','class' => 'WP_Widget_Black_Studio_TinyMCE',),),7 => array ('type' => 'visual','title' => '','text' => '<h4><a href="//placehold.it/526x350"><img class="alignleft size-full wp-image-294" src="//placehold.it/526x350" alt="about_us_4" width="526" height="350" /></a></h4>
			<h5>GEORGE QUICK</h5>
			<em>CEO and Board Member</em>

			Ut lobortis magna tortor, nec porttitor turpis porta in. Donec a felis sed ligula aliquet sollicitudin a in elit. Nunc at commodo erat, fringilla egestas tortor. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae.','filter' => '1','info' => array ('grid' => '2','cell' => '1','id' => '7','class' => 'WP_Widget_Black_Studio_TinyMCE',),),8 => array ('type' => 'visual','title' => '','text' => '<h4><a href="//placehold.it/526x350"><img class="alignleft size-full wp-image-292" src="//placehold.it/526x350" alt="about_us_2" width="526" height="350" /></a></h4>
			<h5>WILLIAM WASHINGTON</h5>
			<em>CEO and Board Member</em>

			Ut lobortis magna tortor, nec porttitor turpis porta in. Donec a felis sed ligula aliquet sollicitudin a in elit. Nunc at commodo erat, fringilla egestas tortor. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae.','filter' => '1','info' => array ('grid' => '2','cell' => '2','id' => '8','class' => 'WP_Widget_Black_Studio_TinyMCE',),),9 => array ('type' => 'visual','title' => '','text' => '<h4><a href="//placehold.it/526x350"><img class="alignleft size-full wp-image-296" src="//placehold.it/526x350" alt="about_us_6" width="526" height="350" /></a></h4>
			<h5>JEREMY HENDRIXON</h5>
			<em>CTO and Finance Manager</em>

			Ut lobortis magna tortor, nec porttitor turpis porta in. Donec a felis sed ligula aliquet sollicitudin a in elit. Nunc at commodo erat, fringilla egestas tortor. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae.','filter' => '1','info' => array ('grid' => '2','cell' => '3','id' => '9','class' => 'WP_Widget_Black_Studio_TinyMCE',),),
				),
				'grids' =>
				array (0 => array ('cells' => '2','style' => array ('class' => '',),),1 => array ('cells' => '4','style' => array ('class' => '',),),2 => array ('cells' => '4','style' => array ('class' => '',),),
				),
				'grid_cells' =>
				array (0 => array ('weight' => '0.5003668378576669','grid' => '0',),1 => array ('weight' => '0.4996331621423331','grid' => '0',),2 => array ('weight' => '0.25','grid' => '1',),3 => array ('weight' => '0.25','grid' => '1',),4 => array ('weight' => '0.25','grid' => '1',),5 => array ('weight' => '0.25','grid' => '1',),6 => array ('weight' => '0.25','grid' => '2',),7 => array ('weight' => '0.25','grid' => '2',),8 => array ('weight' => '0.25','grid' => '2',),9 => array ('weight' => '0.25','grid' => '2',),
				),
			);

			$layouts['buildpress-contact-us'] = array (
				'name'        => _x( 'Contact Us', 'backend', 'buildpress_wp' ),
				'description' => _x( 'Default contact us page for BuildPress', 'backend', 'buildpress_wp' ),
				'widgets' =>
				array (0 => array ('latLng' => '51.507331,-0.127668','zoom' => '12','type' => 'roadmap','style' => 'Subtle Grayscale','height' => '380','locations' => array (1 => array ('title' => 'London','locationlatlng' => '51.507331,-0.127668','custompinimage' => get_template_directory_uri() . '/assets/images/map_pin.png','id' => '1',),11 => array ('title' => 'Second Office','locationlatlng' => '51.492742, -0.232989','custompinimage' => get_template_directory_uri() . '/assets/images/map_pin.png','id' => '11',),111 => array ('title' => 'Number of Locations is unlimited','locationlatlng' => '51.484192, 0.040065','custompinimage' => get_template_directory_uri() . '/assets/images/map_pin.png','id' => '111',),),'panels_info' => array ('class' => 'PT_Google_Map','raw' => false,'grid' => 0,'cell' => 0,'id' => 0,),),1 => array ('title' => '','text' => '','filter' => '','panels_info' => array ('class' => 'WP_Widget_Text','raw' => false,'grid' => 1,'cell' => 0,'id' => 1,),),2 => array ('title' => 'Contact Us','text' => '','filter' => '','panels_info' => array ('class' => 'WP_Widget_Text','raw' => false,'grid' => 1,'cell' => 0,'id' => 2,),),3 => array ('title' => '','text' => '[fa icon="fa-home"] <b>BuildPress, llc.</b><br>
			227 Marion Street<br>
			Columbia, SC 29201<br><br>
			[fa icon="fa-phone"] <b>1-888-123-4567</b><br>
			[fa icon="fa-fax"] <b>1-888-123-4568</b><br>
			[fa icon="fa-envelope"] <a href="mailto:example@info.com">info@buildpress.com</a><br><br>
			[fa icon="fa-clock-o"] <b>Mon - Fir 8.00 - 18.00</b><br>
			Saturday - Sunday CLOSED','filter' => '','panels_info' => array ('class' => 'WP_Widget_Text','raw' => false,'grid' => 2,'cell' => 0,'id' => 3,),),4 => array ('btn_link_0' => 'https://www.facebook.com/ProteusThemes','icon_0' => 'fa-facebook','btn_link_1' => 'https://twitter.com/ProteusNetCom','icon_1' => 'fa-twitter','btn_link_2' => 'https://www.youtube.com/user/ProteusNetCompany','icon_2' => 'fa-youtube','btn_link_3' => '','icon_3' => 'fa-facebook','btn_link_4' => '','icon_4' => 'fa-facebook','btn_link_5' => '','icon_5' => 'fa-facebook','btn_link_6' => '','icon_6' => 'fa-facebook','btn_link_7' => '','icon_7' => 'fa-facebook','new_tab' => 'on','panels_info' => array ('class' => 'PT_Social_Icons','raw' => false,'grid' => 2,'cell' => 0,'id' => 4,),),5 => array ('title' => '','text' => '[contact-form-7 id="5" title="Contact Us"]','filter' => '','panels_info' => array ('class' => 'WP_Widget_Text','raw' => false,'grid' => 2,'cell' => 1,'id' => 5,),),
				),
				'grids' =>
				array (0 => array ('cells' => 1,'style' => array ('row_stretch' => 'full-stretched','background_display' => 'tile',),),1 => array ('cells' => 1,'style' => array (),),2 => array ('cells' => 2,'style' => array ('background_image_attachment' => false,'background_display' => 'tile',),),
				),
				'grid_cells' =>
				array (0 => array ('grid' => 0,'weight' => 1,),1 => array ('grid' => 1,'weight' => 1,),2 => array ('grid' => 2,'weight' => 0.24999999812500001,),3 => array ('grid' => 2,'weight' => 0.75000000187500004,),
				),
			);

			$layouts['buildpress-home-shop'] = array (
				'name'        => _x( 'Home Page - Shop', 'backend', 'buildpress_wp' ),
				'description' => _x( 'Alternative home page for BuildPress', 'backend', 'buildpress_wp' ),
				'widgets' =>
				array (0 => array ('text' => ' [fa icon=" fa-shopping-cart "] SPECIAL ANNOUNCEMENT: Free delivery for all purchases over $39','textarea' => '[button style="primary" href="/buildpress/shop/"]OUTLET - UP TO 70% OFF[/button]   [button style="default" href="/buildpress/shop/"]SHOP ALL[/button]','panels_info' => array ('class' => 'PT_Banner','raw' => false,'grid' => 0,'cell' => 0,'id' => 0,),),1 => array ('title' => 'Featured Products','text' => '[featured_products per_page="5" columns="5"]','filter' => '','panels_info' => array ('class' => 'WP_Widget_Text','raw' => false,'grid' => 1,'cell' => 0,'id' => 1,),),2 => array ('title' => '','text' => '<div class="motivational-text">Our promise as a contractor is to build community value into every project while delivering professional expertise, exceptional customers service and quality construction.</div>','filter' => '','panels_info' => array ('class' => 'WP_Widget_Text','raw' => false,'grid' => 2,'cell' => 0,'id' => 2,),),3 => array ('title' => 'Recent Products','text' => '[recent_products per_page="5" columns="5"]','filter' => '','panels_info' => array ('class' => 'WP_Widget_Text','raw' => false,'grid' => 3,'cell' => 0,'id' => 3,),),4 => array ('type' => 'visual','title' => '','text' => '<a href="//placehold.it/360x202"><img class="alignnone size-full wp-image-575" src="//placehold.it/360x202" alt="Untitled-3_03" width="360" height="202" /></a>
			<h5>THIS IS BUILDPRESS</h5>
			Shop from over 850 of the best brands, including BuildPress\' own label. Plus, get your daily fix of the freshest construction practices, DIY tutorials and news about crafting.','filter' => '0','panels_info' => array ('class' => 'WP_Widget_Black_Studio_TinyMCE','raw' => false,'grid' => 4,'cell' => 0,'id' => 4,),),5 => array ('type' => 'visual','title' => '','text' => '<a href="//placehold.it/360x202"><img class="alignnone size-full wp-image-576" src="//placehold.it/360x202" alt="Untitled-3_05" width="360" height="202" /></a>
			<h5>PAYMENT AND DELIVERY</h5>
			We\'ve extended our Returns Policy for December 2014. Orders placed from 1 November 2014 can be returned up until 31 January 2015 and are subject to our returns policy.','filter' => '0','panels_info' => array ('class' => 'WP_Widget_Black_Studio_TinyMCE','raw' => false,'grid' => 4,'cell' => 1,'id' => 5,),),6 => array ('type' => 'visual','title' => '','text' => '<a href="//placehold.it/360x202"><img class="alignnone size-full wp-image-577" src="//placehold.it/360x202" alt="Untitled-3_07" width="360" height="202" /></a>
			<h5>DO YOU NEED HELP BEFORE PURCHASE?</h5>
			We are here to help you out. You just have to contact our support center via live chat, email or call our support agents on phone.','filter' => '0','panels_info' => array ('class' => 'WP_Widget_Black_Studio_TinyMCE','raw' => false,'grid' => 4,'cell' => 2,'id' => 6,),),7 => array ('title' => 'Testimonials','autocycle' => 'no','interval' => 5000,'testimonials' => array (1 => array ('quote' => 'Our construction managment professio nals organize, lead and manage the people, materials and processes of construction utilizing the latest techno logies within the industry. Our construct ion management Our construction management.','author' => 'Bob the Builder','rating' => '5','id' => '1',),2 => array ('quote' => 'We aim to eliminate the task of dividing your project between different architecture and construction company. We are a company that offers design and build services for you from initial sketches to the final construction.','author' => 'Lennie Lazenby','rating' => '5','id' => '2',),3 => array ('quote' => 'We offer quality tiling and painting solutions for interior and exterior of residential and commercial spaces that not only looks good but also lasts longer. We offer quality tiling and painting solutions for interior and exterior.','author' => 'Sandy Beach','rating' => '5','id' => '3',),4 => array ('quote' => 'For us, honesty is the only policy and we strive to complete all projects with integrity, not just with our clients, but also our suppliers and contractors. With thousands of successful projects under our belt, we are one of the most trusted construction companies in US.','author' => 'Dizzy','rating' => '5','id' => '4',),),'panels_info' => array ('class' => 'PT_Testimonials','grid' => 5,'cell' => 0,'id' => 7,'style' => array ('background_image_attachment' => false,'background_display' => 'tile',),),),8 => array ('title' => 'Clients / Partners / Certificates','text' => '<div class="logo-panel">
				<div class="row">
					<div class="col-xs-12  col-sm-2">
						<img src="//placehold.it/208x98" alt="Client">
					</div>
					<div class="col-xs-12  col-sm-2">
						<img src="//placehold.it/208x98" alt="Client">
					</div>
					<div class="col-xs-12  col-sm-2">
						<img src="//placehold.it/208x98" alt="Client">
					</div>
					<div class="col-xs-12  col-sm-2">
						<img src="//placehold.it/208x98" alt="Client">
					</div>
					<div class="col-xs-12  col-sm-2">
						<img src="//placehold.it/208x98" alt="Client">
					</div>
					<div class="col-xs-12  col-sm-2">
						<img src="//placehold.it/208x98" alt="Client">
					</div>
					<div class="col-xs-12  col-sm-2">
						<img src="//placehold.it/208x98" alt="Client">
					</div>
					<div class="col-xs-12  col-sm-2">
						<img src="//placehold.it/208x98" alt="Client">
					</div>
					<div class="col-xs-12  col-sm-2">
						<img src="//placehold.it/208x98" alt="Client">
					</div>
					<div class="col-xs-12  col-sm-2">
						<img src="//placehold.it/208x98" alt="Client">
					</div>
					<div class="col-xs-12  col-sm-2">
						<img src="//placehold.it/208x98" alt="Client">
					</div>
					<div class="col-xs-12  col-sm-2">
						<img src="//placehold.it/208x98" alt="Client">
					</div>
				</div>
			</div>','filter' => '','panels_info' => array ('class' => 'WP_Widget_Text','raw' => false,'grid' => 6,'cell' => 0,'id' => 8,),),
				),
				'grids' =>
				array (0 => array ('cells' => 1,'style' => array ('bottom_margin' => '60px','row_stretch' => 'full','background' => '#eeeeee','background_image_attachment' => false,'background_display' => 'tile',),),1 => array ('cells' => 1,'style' => array ('background_image_attachment' => false,'background_display' => 'tile',),),2 => array ('cells' => 1,'style' => array ('bottom_margin' => '60px','padding' => '30px','row_stretch' => 'full','background_image_attachment' => 2148,'background_display' => 'cover',),),3 => array ('cells' => 1,'style' => array ('background_image_attachment' => false,'background_display' => 'tile',),),4 => array ('cells' => 3,'style' => array ('background_image_attachment' => false,'background_display' => 'tile',),),5 => array ('cells' => 1,'style' => array ('class' => 'wide-pattern','bottom_margin' => '60px','row_stretch' => 'full','background' => '#eeeeee','background_image_attachment' => 2149,'background_display' => 'tile',),),6 => array ('cells' => 1,'style' => array ('background_image_attachment' => false,'background_display' => 'tile',),),
				),
				'grid_cells' =>
				array (0 => array ('grid' => 0,'weight' => 1,),1 => array ('grid' => 1,'weight' => 1,),2 => array ('grid' => 2,'weight' => 1,),3 => array ('grid' => 3,'weight' => 1,),4 => array ('grid' => 4,'weight' => 0.33333333333333331,),5 => array ('grid' => 4,'weight' => 0.33333333333333331,),6 => array ('grid' => 4,'weight' => 0.33333333333333331,),7 => array ('grid' => 5,'weight' => 1,),8 => array ('grid' => 6,'weight' => 1,),
				),
			);

			return $layouts;
		}
		add_filter( 'siteorigin_panels_prebuilt_layouts', 'buildpress_panels_prebuilt_layouts', 10, 1 );



		/**
		 * Add custom row styles to the Page Builder
		 *
		 * @param  string $default
		 * @param  array $row_data
		 * @return string
		 */
		if ( ! function_exists( 'buildpress_panels_before_row' ) ) {
			function buildpress_panels_before_row( $default, $row_data ) {
				if ( array_key_exists( 'class', $row_data[ 'style' ] ) && 'wide-boxed' === $row_data['style']['class'] ) {
					return '</div></div>';
				}

				return $default;
			}
			add_filter( 'siteorigin_panels_before_row', 'buildpress_panels_before_row', 10, 2 );
		}



		/**
		 * Add custom row styles to the Page Builder
		 *
		 * @param  string $default
		 * @param  array $row_data
		 * @return string
		 */
		if ( ! function_exists( 'buildpress_panels_after_row' ) ) {
			function buildpress_panels_after_row( $default, $row_data ) {
				if ( array_key_exists( 'class', $row_data[ 'style' ] ) && 'wide-boxed' === $row_data['style']['class'] ) {
					return '<div class="container"><div>';
				}

				return $default;
			}
			add_filter( 'siteorigin_panels_after_row', 'buildpress_panels_after_row', 10, 2 );
		}
	}

}


/**
 * Add custom separator as an option for the Breadcrumbs NavXT plugin when the plugin is activated
 */
if ( ! function_exists( 'buildpress_custom_hseparator' ) ) {
	function buildpress_custom_hseparator() {
		add_option( 'bcn_options', array( 'hseparator' => '' ) );
	}
	add_action( 'activate_breadcrumb-navxt/breadcrumb-navxt.php', 'buildpress_custom_hseparator', 90 );
}



/**
 * Change post type labels and arguments for Portfolio Post Type plugin.
 *
 * @param array $args Existing arguments.
 *
 * @return array Amended arguments.
 */
if ( ! function_exists( 'buildpress_change_portfolio_labels' ) ) {
	function buildpress_change_portfolio_labels( array $args ) {
		$labels = array(
			'name'               => _x( 'Projects', 'backend', 'buildpress_wp' ),
			'singular_name'      => _x( 'Project', 'backend', 'buildpress_wp' ),
			'add_new'            => _x( 'Add New Item', 'backend', 'buildpress_wp' ),
			'add_new_item'       => _x( 'Add New Project', 'backend', 'buildpress_wp' ),
			'edit_item'          => _x( 'Edit Project', 'backend', 'buildpress_wp' ),
			'new_item'           => _x( 'Add New Project', 'backend', 'buildpress_wp' ),
			'view_item'          => _x( 'View Item', 'backend', 'buildpress_wp' ),
			'search_items'       => _x( 'Search Projects', 'backend', 'buildpress_wp' ),
			'not_found'          => _x( 'No projects found', 'backend', 'buildpress_wp' ),
			'not_found_in_trash' => _x( 'No projects found in trash', 'backend', 'buildpress_wp' ),
		);
		$args['labels'] = $labels;

		// Update project single permalink format, and archive slug as well.
		$args['rewrite']     = array( 'slug' => get_theme_mod( 'projects_slug', 'project' ) );
		$args['has_archive'] = false;
		// Don't forget to visit Settings->Permalinks after changing these to flush the rewrite rules.

		return $args;
	}
	add_filter( 'portfolioposttype_args', 'buildpress_change_portfolio_labels' );
}



/**
 * Essential Grid - disable the notice for purchase code
 */
if ( ! BUILDPRESS_DEVELOPMENT && function_exists( 'set_ess_grid_as_theme' ) ) {
	define( 'ESS_GRID_AS_THEME', true );
	set_ess_grid_as_theme();
}