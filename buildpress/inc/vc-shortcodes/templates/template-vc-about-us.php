<?php

/*
 * BuildPress About Us Template for Visual Composer
 */

add_action( 'vc_load_default_templates_action','buildpress_about_us_template_for_vc' );

function buildpress_about_us_template_for_vc() {
	$data               = array();
	$data['name']       = _x( 'BuildPress: About Us', 'backend' , 'buildpress_wp' );
	$data['weight']     = 0;
	$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() . '/assets/images/pt.svg' );
	$data['custom_class'] = 'buildpress_about_us_template_for_vc_custom_template';
	$data['content']    = <<<CONTENT
		[vc_row css=".vc_custom_1459339886546{margin-bottom: 60px !important;}"][vc_column width="1/2"][vc_column_text]BuildPress Inc traces its roots back to 1989 in Colorado and since then have never looked back. With thousands of successful projects under our belt, we can proudly say that we are one of the most trusted construction companies in Colorado performing both domestic and international construction work.

		For more than 25 years, Construction has offered a wide range of construction services in Colorado, many other cities of United States and around the world. We strive to maintain the highest standards while exceeding client’s expectations at all levels. We not only honor commitments, but are known for meeting tough deadlines while delivering nothing but the best. We aim to create a responsive client relationship that allows us to meet and even exceed the goals of each of our projects.

		BuildPress Inc is well known for its innovation and by collaborating successfully with our customers, designers, sub-contractors, consultants as well as suppliers; we have been able to provide more specialized level of services. We are continuously evolving and understand the different aspects of delivering high value construction and complex projects with ease.[/vc_column_text][/vc_column][vc_column width="1/2"][vc_column_text]<a href="http://xml-io.proteusthemes.com/buildpress/wp-content/uploads/sites/16/2014/10/project_14.jpg"><img class="alignnone size-large" src="http://xml-io.proteusthemes.com/buildpress/wp-content/uploads/sites/16/2014/10/project_14-1024x574.jpg" alt="Project Image" width="1024" height="574" /></a>[/vc_column_text][/vc_column][/vc_row][vc_row][vc_column width="1/4"][vc_column_text]<img class="size-full alignnone" src="http://xml-io.proteusthemes.com/buildpress/wp-content/uploads/sites/16/2014/11/about_us_1.jpg" alt="about_us_1" width="526" height="350" />
		<h5>GEORGE QUICK</h5>
		<em>CEO and Board Member</em>

		Ut lobortis magna tortor, nec porttitor turpis porta in. Donec a felis sed ligula aliquet sollicitudin a in elit. Nunc at commodo erat, fringilla egestas tortor. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae.[/vc_column_text][/vc_column][vc_column width="1/4"][vc_column_text]<img class="size-full alignnone" src="http://xml-io.proteusthemes.com/buildpress/wp-content/uploads/sites/16/2014/11/about_us_7.jpg" alt="about_us_7" width="526" height="350" />
		<h5>SAMANTHA FOX</h5>
		<em>Chief Accountant Manager</em>

		Ut lobortis magna tortor, nec porttitor turpis porta in. Donec a felis sed ligula aliquet sollicitudin a in elit. Nunc at commodo erat, fringilla egestas tortor. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae.[/vc_column_text][/vc_column][vc_column width="1/4"][vc_column_text]<img class="size-full alignnone" src="http://xml-io.proteusthemes.com/buildpress/wp-content/uploads/sites/16/2014/11/about_us_3.jpg" alt="about_us_3" width="526" height="350" />
		<h5>JEREMY HENDRIXON</h5>
		<em>CTO and Finance Manager</em>

		Ut lobortis magna tortor, nec porttitor turpis porta in. Donec a felis sed ligula aliquet sollicitudin a in elit. Nunc at commodo erat, fringilla egestas tortor. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae.[/vc_column_text][/vc_column][vc_column width="1/4"][vc_column_text]<img class="size-full alignnone" src="http://xml-io.proteusthemes.com/buildpress/wp-content/uploads/sites/16/2014/11/about_us_8.jpg" alt="about_us_8" width="526" height="350" />
		<h5>WILLIAM WASHINGTON</h5>
		<em>CEO and Board Member</em>

		Ut lobortis magna tortor, nec porttitor turpis porta in. Donec a felis sed ligula aliquet sollicitudin a in elit. Nunc at commodo erat, fringilla egestas tortor. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae.[/vc_column_text][/vc_column][/vc_row][vc_row css=".vc_custom_1459340014099{margin-bottom: 0px !important;}"][vc_column width="1/4"][vc_column_text]<img class="size-full alignnone" src="http://xml-io.proteusthemes.com/buildpress/wp-content/uploads/sites/16/2014/11/about_us_7.jpg" alt="about_us_7" width="526" height="350" />
		<h5>SAMANTHA FOX</h5>
		<em>Chief Accountant Manager</em>

		Ut lobortis magna tortor, nec porttitor turpis porta in. Donec a felis sed ligula aliquet sollicitudin a in elit. Nunc at commodo erat, fringilla egestas tortor. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae.[/vc_column_text][/vc_column][vc_column width="1/4"][vc_column_text]<img class="size-full alignnone" src="http://xml-io.proteusthemes.com/buildpress/wp-content/uploads/sites/16/2014/11/about_us_3.jpg" alt="about_us_3" width="526" height="350" />
		<h5>JEREMY HENDRIXON</h5>
		<em>CTO and Finance Manager</em>

		Ut lobortis magna tortor, nec porttitor turpis porta in. Donec a felis sed ligula aliquet sollicitudin a in elit. Nunc at commodo erat, fringilla egestas tortor. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae.[/vc_column_text][/vc_column][vc_column width="1/4"][vc_column_text]<img class="size-full alignnone" src="http://xml-io.proteusthemes.com/buildpress/wp-content/uploads/sites/16/2014/11/about_us_8.jpg" alt="about_us_8" width="526" height="350" />
		<h5>WILLIAM WASHINGTON</h5>
		<em>CEO and Board Member</em>

		Ut lobortis magna tortor, nec porttitor turpis porta in. Donec a felis sed ligula aliquet sollicitudin a in elit. Nunc at commodo erat, fringilla egestas tortor. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae.[/vc_column_text][/vc_column][vc_column width="1/4"][vc_column_text]<img class="size-full alignnone" src="http://xml-io.proteusthemes.com/buildpress/wp-content/uploads/sites/16/2014/11/about_us_1.jpg" alt="about_us_1" width="526" height="350" />
		<h5>GEORGE QUICK</h5>
		<em>CEO and Board Member</em>

		Ut lobortis magna tortor, nec porttitor turpis porta in. Donec a felis sed ligula aliquet sollicitudin a in elit. Nunc at commodo erat, fringilla egestas tortor. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae.[/vc_column_text][/vc_column][/vc_row]
CONTENT;

	vc_add_default_templates( $data );
}