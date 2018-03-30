<?php
//custom post type - features
function theme_features_init()
{
	$labels = array(
		'name' => _x('Features', 'post type general name', 'medicenter'),
		'singular_name' => _x('Feature', 'post type singular name', 'medicenter'),
		'add_new' => _x('Add New', 'features', 'medicenter'),
		'add_new_item' => __('Add New Feature', 'medicenter'),
		'edit_item' => __('Edit Feature', 'medicenter'),
		'new_item' => __('New Feature', 'medicenter'),
		'all_items' => __('All Features', 'medicenter'),
		'view_item' => __('View Feature', 'medicenter'),
		'search_items' => __('Search Features', 'medicenter'),
		'not_found' =>  __('No features found', 'medicenter'),
		'not_found_in_trash' => __('No features found in Trash', 'medicenter'), 
		'parent_item_colon' => '',
		'menu_name' => __("Features", 'medicenter')
	);
	$args = array(  
		"labels" => $labels, 
		"public" => true,  
		"show_ui" => true,  
		"capability_type" => "post",  
		"menu_position" => 20,
		"hierarchical" => false,  
		"rewrite" => true,  
		"supports" => array("title", "editor", "excerpt", "thumbnail", "page-attributes", "comments")  
	);
	register_post_type("features", $args);
	register_taxonomy("features_category", array("features"), array("label" => "Categories", "singular_label" => "Category", "rewrite" => true));
}  
add_action("init", "theme_features_init"); 

//Adds a box to the right column and to the main column on the Features edit screens
function theme_add_features_custom_box() 
{
	add_meta_box( 
        "features_config",
        __("Options", 'medicenter'),
        "theme_inner_features_custom_box_main",
        "features",
		"normal",
		"high"
    );
}
add_action("add_meta_boxes", "theme_add_features_custom_box");
//backwards compatible (before WP 3.0)
//add_action("admin_init", "theme_add_custom_box", 1);

function theme_inner_features_custom_box_main($post)
{
	global $themename;
	//Use nonce for verification
	wp_nonce_field(plugin_basename( __FILE__ ), $themename . "_features_noncename");
	
	//The actual fields for data entry
	$icon = get_post_meta($post->ID, "icon", true);
	$icon_color = get_post_meta($post->ID, "icon_color", true);
	echo '
	<table>
		<tr>
			<td>
				<label for="icon">' . __('Icon', 'medicenter') . ':</label>
			</td>
			<td>
				<select style="width: 120px;" id="features_icon" name="features_icon">
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/address.png);" value="address"' . ($icon=="address" ? ' selected="selected"' : '') . '>' . __('address', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/adjust.png);" value="adjust"' . ($icon=="adjust" ? ' selected="selected"' : '') . '>' . __('adjust', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/administration.png);" value="administration"' . ($icon=="administration" ? ' selected="selected"' : '') . '>' . __('administration', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/app.png);" value="app"' . ($icon=="app" ? ' selected="selected"' : '') . '>' . __('app', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/award.png);" value="award"' . ($icon=="award" ? ' selected="selected"' : '') . '>' . __('award', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/balance.png);" value="balance"' . ($icon=="balance" ? ' selected="selected"' : '') . '>' . __('balance', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/battery.png);" value="battery"' . ($icon=="battery" ? ' selected="selected"' : '') . '>' . __('battery', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/bed.png);" value="bed"' . ($icon=="bed" ? ' selected="selected"' : '') . '>' . __('bed', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/bin.png);" value="bin"' . ($icon=="bin" ? ' selected="selected"' : '') . '>' . __('bin', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/binders.png);" value="binders"' . ($icon=="binders" ? ' selected="selected"' : '') . '>' . __('binders', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/binoculars.png);" value="binoculars"' . ($icon=="binoculars" ? ' selected="selected"' : '') . '>' . __('binoculars', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/bookmark.png);" value="bookmark"' . ($icon=="bookmark" ? ' selected="selected"' : '') . '>' . __('bookmark', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/box.png);" value="box"' . ($icon=="box" ? ' selected="selected"' : '') . '>' . __('box', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/briefcase.png);" value="briefcase"' . ($icon=="briefcase" ? ' selected="selected"' : '') . '>' . __('briefcase', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/building.png);" value="building"' . ($icon=="building" ? ' selected="selected"' : '') . '>' . __('building', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/calendar.png);" value="calendar"' . ($icon=="calendar" ? ' selected="selected"' : '') . '>' . __('calendar', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/cart.png);" value="cart"' . ($icon=="cart" ? ' selected="selected"' : '') . '>' . __('cart', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/chart.png);" value="chart"' . ($icon=="chart" ? ' selected="selected"' : '') . '>' . __('chart', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/chat.png);" value="chat"' . ($icon=="chat" ? ' selected="selected"' : '') . '>' . __('chat', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/clock.png);" value="clock"' . ($icon=="clock" ? ' selected="selected"' : '') . '>' . __('clock', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/cloud_upload.png);" value="cloud_upload"' . ($icon=="cloud_upload" ? ' selected="selected"' : '') . '>' . __('cloud upload', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/config.png);" value="config"' . ($icon=="config" ? ' selected="selected"' : '') . '>' . __('config', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/credit_card.png);" value="credit_card"' . ($icon=="credit_card" ? ' selected="selected"' : '') . '>' . __('credit card', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/cross.png);" value="cross"' . ($icon=="cross" ? ' selected="selected"' : '') . '>' . __('cross', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/database.png);" value="database"' . ($icon=="database" ? ' selected="selected"' : '') . '>' . __('database', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/diary.png);" value="diary"' . ($icon=="diary" ? ' selected="selected"' : '') . '>' . __('diary', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/document.png);" value="document"' . ($icon=="document" ? ' selected="selected"' : '') . '>' . __('document', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/download.png);" value="download"' . ($icon=="download" ? ' selected="selected"' : '') . '>' . __('download', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/dropper.png);" value="dropper"' . ($icon=="dropper" ? ' selected="selected"' : '') . '>' . __('dropper', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/fail.png);" value="fail"' . ($icon=="fail" ? ' selected="selected"' : '') . '>' . __('fail', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/fax.png);" value="fax"' . ($icon=="fax" ? ' selected="selected"' : '') . '>' . __('fax', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/first_aid.png);" value="first_aid"' . ($icon=="first_aid" ? ' selected="selected"' : '') . '>' . __('first aid', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/folder.png);" value="folder"' . ($icon=="folder" ? ' selected="selected"' : '') . '>' . __('folder', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/form.png);" value="form"' . ($icon=="form" ? ' selected="selected"' : '') . '>' . __('form', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/gallery.png);" value="gallery"' . ($icon=="gallery" ? ' selected="selected"' : '') . '>' . __('gallery', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/glasses.png);" value="glasses"' . ($icon=="glasses" ? ' selected="selected"' : '') . '>' . __('glasses', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/graph.png);" value="graph"' . ($icon=="graph" ? ' selected="selected"' : '') . '>' . __('graph', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/healthcare.png);" value="healthcare"' . ($icon=="healthcare" ? ' selected="selected"' : '') . '>' . __('healthcare', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/heart.png);" value="heart"' . ($icon=="heart" ? ' selected="selected"' : '') . '>' . __('heart', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/home.png);" value="home"' . ($icon=="home" ? ' selected="selected"' : '') . '>' . __('home', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/hourglass.png);" value="hourglass"' . ($icon=="hourglass" ? ' selected="selected"' : '') . '>' . __('hourglass', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/hyperlink.png);" value="hyperlink"' . ($icon=="hyperlink" ? ' selected="selected"' : '') . '>' . __('hyperlink', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/id.png);" value="id"' . ($icon=="id" ? ' selected="selected"' : '') . '>' . __('id', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/image.png);" value="image"' . ($icon=="image" ? ' selected="selected"' : '') . '>' . __('image', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/info.png);" value="info"' . ($icon=="info" ? ' selected="selected"' : '') . '>' . __('info', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/keyboard.png);" value="keyboard"' . ($icon=="keyboard" ? ' selected="selected"' : '') . '>' . __('keyboard', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/lab.png);" value="lab"' . ($icon=="lab" ? ' selected="selected"' : '') . '>' . __('lab', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/laptop.png);" value="laptop"' . ($icon=="laptop" ? ' selected="selected"' : '') . '>' . __('laptop', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/leaf.png);" value="leaf"' . ($icon=="leaf" ? ' selected="selected"' : '') . '>' . __('leaf', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/list.png);" value="list"' . ($icon=="list" ? ' selected="selected"' : '') . '>' . __('list', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/lock.png);" value="lock"' . ($icon=="lock" ? ' selected="selected"' : '') . '>' . __('lock', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/luggage.png);" value="luggage"' . ($icon=="luggage" ? ' selected="selected"' : '') . '>' . __('luggage', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/mail.png);" value="mail"' . ($icon=="mail" ? ' selected="selected"' : '') . '>' . __('mail', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/mic.png);" value="mic"' . ($icon=="mic" ? ' selected="selected"' : '') . '>' . __('mic', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/minus.png);" value="minus"' . ($icon=="minus" ? ' selected="selected"' : '') . '>' . __('minus', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/mobile.png);" value="mobile"' . ($icon=="mobile" ? ' selected="selected"' : '') . '>' . __('mobile', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/money.png);" value="money"' . ($icon=="money" ? ' selected="selected"' : '') . '>' . __('money', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/movie.png);" value="movie"' . ($icon=="movie" ? ' selected="selected"' : '') . '>' . __('movie', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/network.png);" value="network"' . ($icon=="network" ? ' selected="selected"' : '') . '>' . __('network', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/oscilloscope.png);" value="oscilloscope"' . ($icon=="oscilloscope" ? ' selected="selected"' : '') . '>' . __('oscilloscope', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/paintbrush.png);" value="paintbrush"' . ($icon=="paintbrush" ? ' selected="selected"' : '') . '>' . __('paintbrush', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/people.png);" value="people"' . ($icon=="people" ? ' selected="selected"' : '') . '>' . __('people', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/phone.png);" value="phone"' . ($icon=="phone" ? ' selected="selected"' : '') . '>' . __('phone', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/piano.png);" value="piano"' . ($icon=="piano" ? ' selected="selected"' : '') . '>' . __('piano', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/pill.png);" value="pill"' . ($icon=="pill" ? ' selected="selected"' : '') . '>' . __('pill', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/pin.png);" value="pin"' . ($icon=="pin" ? ' selected="selected"' : '') . '>' . __('pin', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/plus.png);" value="plus"' . ($icon=="plus" ? ' selected="selected"' : '') . '>' . __('plus', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/printer.png);" value="printer"' . ($icon=="printer" ? ' selected="selected"' : '') . '>' . __('printer', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/projector.png);" value="projector"' . ($icon=="projector" ? ' selected="selected"' : '') . '>' . __('projector', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/question_mark.png);" value="question_mark"' . ($icon=="question_mark" ? ' selected="selected"' : '') . '>' . __('question mark', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/quote.png);" value="quote"' . ($icon=="quote" ? ' selected="selected"' : '') . '>' . __('quote', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/restaurant.png);" value="restaurant"' . ($icon=="restaurant" ? ' selected="selected"' : '') . '>' . __('restaurant', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/rss.png);" value="rss"' . ($icon=="rss" ? ' selected="selected"' : '') . '>' . __('rss', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/screen.png);" value="screen"' . ($icon=="screen" ? ' selected="selected"' : '') . '>' . __('screen', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/shield.png);" value="shield"' . ($icon=="shield" ? ' selected="selected"' : '') . '>' . __('shield', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/signpost.png);" value="signpost"' . ($icon=="signpost" ? ' selected="selected"' : '') . '>' . __('signpost', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/speaker.png);" value="speaker"' . ($icon=="speaker" ? ' selected="selected"' : '') . '>' . __('speaker', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/success.png);" value="success"' . ($icon=="success" ? ' selected="selected"' : '') . '>' . __('success', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/syringe.png);" value="syringe"' . ($icon=="syringe" ? ' selected="selected"' : '') . '>' . __('syringe', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/tablet.png);" value="tablet"' . ($icon=="tablet" ? ' selected="selected"' : '') . '>' . __('tablet', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/tags.png);" value="tags"' . ($icon=="tags" ? ' selected="selected"' : '') . '>' . __('tags', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/target.png);" value="target"' . ($icon=="target" ? ' selected="selected"' : '') . '>' . __('target', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/tick.png);" value="tick"' . ($icon=="tick" ? ' selected="selected"' : '') . '>' . __('tick', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/upload.png);" value="upload"' . ($icon=="upload" ? ' selected="selected"' : '') . '>' . __('upload', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/video.png);" value="video"' . ($icon=="video" ? ' selected="selected"' : '') . '>' . __('video', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/wall.png);" value="wall"' . ($icon=="wall" ? ' selected="selected"' : '') . '>' . __('wall', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/wallet.png);" value="wallet"' . ($icon=="wallet" ? ' selected="selected"' : '') . '>' . __('wallet', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/warning.png);" value="warning"' . ($icon=="warning" ? ' selected="selected"' : '') . '>' . __('warning', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/weight.png);" value="weight"' . ($icon=="weight" ? ' selected="selected"' : '') . '>' . __('weight', 'medicenter') . '</option>
					<option style="background-image: url(' . get_template_directory_uri() . '/images/icons_small/blue_light/wheelchair.png);" value="wheelchair"' . ($icon=="wheelchair" ? ' selected="selected"' : '') . '>' . __('wheelchair', 'medicenter') . '</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>
				<label for="icon_color">' . __('Icon color', 'medicenter') . ':</label>
			</td>
			<td>
				<select style="width: 120px;" id="features_icon_color" name="features_icon_color">
					<option value="blue_light"' . ($icon_color=="blue_light" ? ' selected="selected"' : '') . '>' . __('light blue', 'medicenter') . '</option>
					<option value="blue"' . ($icon_color=="blue" ? ' selected="selected"' : '') . '>' . __('blue', 'medicenter') . '</option>
					<option value="blue_dark"' . ($icon_color=="blue_dark" ? ' selected="selected"' : '') . '>' . __('dark blue', 'medicenter') . '</option>
					<option value="black"' . ($icon_color=="black" ? ' selected="selected"' : '') . '>' . __('black', 'medicenter') . '</option>
					<option value="gray"' . ($icon_color=="gray" ? ' selected="selected"' : '') . '>' . __('gray', 'medicenter') . '</option>
					<option value="gray_dark"' . ($icon_color=="gray_dark" ? ' selected="selected"' : '') . '>' . __('dark gray', 'medicenter') . '</option>
					<option value="gray_light"' . ($icon_color=="gray_light" ? ' selected="selected"' : '') . '>' . __('light gray', 'medicenter') . '</option>
					<option value="green"' . ($icon_color=="green" ? ' selected="selected"' : '') . '>' . __('green', 'medicenter') . '</option>
					<option value="green_dark"' . ($icon_color=="green_dark" ? ' selected="selected"' : '') . '>' . __('dark green', 'medicenter') . '</option>
					<option value="green_light"' . ($icon_color=="green_light" ? ' selected="selected"' : '') . '>' . __('light green', 'medicenter') . '</option>
					<option value="orange"' . ($icon_color=="orange" ? ' selected="selected"' : '') . '>' . __('orange', 'medicenter') . '</option>
					<option value="orange_dark"' . ($icon_color=="orange_dark" ? ' selected="selected"' : '') . '>' . __('dark orange', 'medicenter') . '</option>
					<option value="orange_light"' . ($icon_color=="orange_light" ? ' selected="selected"' : '') . '>' . __('light orange', 'medicenter') . '</option>
					<option value="red"' . ($icon_color=="red" ? ' selected="selected"' : '') . '>' . __('red', 'medicenter') . '</option>
					<option value="red_dark"' . ($icon_color=="red_dark" ? ' selected="selected"' : '') . '>' . __('dark red', 'medicenter') . '</option>
					<option value="red_light"' . ($icon_color=="red_light" ? ' selected="selected"' : '') . '>' . __('light red', 'medicenter') . '</option>
					<option value="turquoise"' . ($icon_color=="turquoise" ? ' selected="selected"' : '') . '>' . __('turquoise', 'medicenter') . '</option>
					<option value="turquoise_dark"' . ($icon_color=="turquoise_dark" ? ' selected="selected"' : '') . '>' . __('dark turquoise', 'medicenter') . '</option>
					<option value="turquoise_light"' . ($icon_color=="turquoise_light" ? ' selected="selected"' : '') . '>' . __('light turquoise', 'medicenter') . '</option>
					<option value="violet"' . ($icon_color=="violet" ? ' selected="selected"' : '') . '>' . __('violet', 'medicenter') . '</option>
					<option value="violet_dark"' . ($icon_color=="violet_dark" ? ' selected="selected"' : '') . '>' . __('dark violet', 'medicenter') . '</option>
					<option value="violet_light"' . ($icon_color=="violet_light" ? ' selected="selected"' : '') . '>' . __('light violet', 'medicenter') . '</option>
					<option value="white"' . ($icon_color=="white" ? ' selected="selected"' : '') . '>' . __('white', 'medicenter') . '</option>
					<option value="yellow"' . ($icon_color=="yellow" ? ' selected="selected"' : '') . '>' . __('yellow', 'medicenter') . '</option>	
				</select>
			</td>
		</tr>
	</table>';
}

//When the post is saved, saves our custom data
function theme_save_features_postdata($post_id) 
{
	global $themename;
	//verify if this is an auto save routine. 
	//if it is our form has not been submitted, so we dont want to do anything
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) 
		return;

	//verify this came from the our screen and with proper authorization,
	//because save_post can be triggered at other times
	if (!isset($_POST[$themename . '_features_noncename']) || !wp_verify_nonce($_POST[$themename . '_features_noncename'], plugin_basename( __FILE__ )))
		return;


	//Check permissions
	if(!current_user_can('edit_post', $post_id))
		return;

	//OK, we're authenticated: we need to find and save the data
	update_post_meta($post_id, "icon", $_POST["features_icon"]);
	update_post_meta($post_id, "icon_color", $_POST["features_icon_color"]);
}
add_action("save_post", "theme_save_features_postdata");

function features_edit_columns($columns)
{
	$columns = array(
			"cb" => "<input type=\"checkbox\" />",
			"title" => _x('Title', 'post type singular name', 'medicenter'),
			"features_category" => __('Categories', 'medicenter'),
			"features_icon" => __('Icon', 'medicenter'),
			"date" => __('Date', 'medicenter')
	);

	return $columns;
}
add_filter("manage_edit-features_columns", "features_edit_columns");

function manage_features_posts_custom_column($column)
{
	global $post;
	switch ($column)
	{
		case "features_category":
			echo get_the_term_list($post->ID, "features_category", '', ', ','');
			break;
		case "features_icon":
			echo  get_post_meta($post->ID, "icon", true);
			break;
	}
}
add_action("manage_features_posts_custom_column", "manage_features_posts_custom_column");

function theme_features_shortcode($atts)
{
	extract(shortcode_atts(array(
		"category" => "",
		"ids" => "",
		"order_by" => "title menu_order",
		"order" => "ASC",
		"type" => "large",
		"columns" => 0,
		"headers" => 0,
		"headers_links" => 1,
		"read_more" => 1,
		"icon_links" => 1,
		"animation" => 0,
		"animation_duration" => "",
		"animation_delay" => "",
		"top_margin" => "page_margin_top_section" 
	), $atts));
	
	$ids = explode(",", $ids);
	if($ids[0]=="-" || $ids[0]=="")
	{
		unset($ids[0]);
		$ids = array_values($ids);
	}
	$category = explode(",", $category);
	if($category[0]=="-" || $category[0]=="")
	{
		unset($category[0]);
		$category = array_values($category);
	}
	query_posts(array(
		'post__in' => $ids,
		'post_type' => 'features',
		'posts_per_page' => '-1',
		'post_status' => 'publish',
		'features_category' => implode(",", $category),
		'orderby' => implode(" ", explode(",", $order_by)),
		'order' => $order
	));
	
	global $wp_query; 
	$post_count = $wp_query->post_count;
	
	$output = "";
	if(have_posts())
	{
		$i=0;
		if((int)$columns)
		{
			$output .= '<div class="columns clearfix ' . ($type=="large" ?  'no_width' : 'columns_3') . ($top_margin!="none" ? ' ' . $top_margin : '') . '">';
		}
		else
			$output .= '<ul class="clearfix mc_features mc_features_' . $type . ($top_margin!="none" ? ' ' . $top_margin : '') . '">';
		while(have_posts()): the_post();
		if((int)$columns && ($i==0 || ($type=="large" && $i==ceil($post_count/2)) || ($type=="small" && $i==ceil($post_count/3)) || ($type=="small" && $i==ceil($post_count/3*2))))
		{
			if(($type=="large" && $i==ceil($post_count/2)) || ($type=="small" && $i==ceil($post_count/3)) || ($type=="small" && $i==ceil($post_count/3*2)))
				$output .= '</ul>';
			$output .= '<ul class="mc_features mc_features_' . $type . ' column' . ($type=="large" ? ($i==ceil($post_count/2) ? '_right' : '_left') : '') . '">';
		}
		$output .= '<li class="item_content clearfix">
				<' . ($icon_links==1 ? 'a' : 'span') . ' class="features_image" ' . ($icon_links==1 ? 'href="' . get_permalink() . '"' : '') . ' title="' . esc_attr(get_the_title()) . '"><img src="' . get_template_directory_uri() . '/images/icons_' . $type . '/' . get_post_meta(get_the_ID(), "icon_color", true) . '/' . get_post_meta(get_the_ID(), "icon", true) . '.png"' . ($animation!='' ? 'class="animated_element animation-' . $animation . ((int)$animation_duration>0 && (int)$animation_duration!=600 ? ' duration-' . (int)$animation_duration : '') . ((int)$animation_delay>0 ? ' delay-' . (int)$animation_delay : '') . '"' : '') . '/></' . ($icon_links==1 ? 'a' : 'span') . '><div class="text">'
				. ((int)$headers==1 ? '<h3><' . ($headers_links==1 ? 'a' : 'span') . ' ' . ($headers_links==1 ? 'href="' . get_permalink() . '"' : '') . '  title="' . esc_attr(get_the_title()) . '">' . get_the_title() . '</' . ($headers_links==1 ? 'a' : 'span') . '></h3>' : '')
				. apply_filters('the_excerpt', get_the_excerpt()) . 
				((int)$read_more==1 ? '<div class="item_footer clearfix"><a title="' . __("Read more", 'medicenter') . '" href="' . get_permalink() . '" class="more">' . __("Read more &rarr;", 'medicenter') . '</a></div>' : '') .
				'</div>
			</li>';
		$i++;
		endwhile;
		$output .= '</ul>' . ((int)$columns ? '</div>' : '');
	}
	//Reset Query
	wp_reset_query();
	return $output;
}
add_shortcode("features", "theme_features_shortcode");

//visual composer
function theme_features_vc_init()
{
	//get features list
	$features_list = get_posts(array(
		'posts_per_page' => -1,
		'orderby' => 'title',
		'order' => 'ASC',
		'post_type' => 'features'
	));
	$features_array = array();
	$features_array[__("All", 'medicenter')] = "-";
	foreach($features_list as $feature)
		$features_array[$feature->post_title . " (id:" . $feature->ID . ")"] = $feature->ID;

	//get features categories list
	$features_categories = get_terms("features_category");
	$features_categories_array = array();
	$features_categories_array[__("All", 'medicenter')] = "-";
	foreach($features_categories as $features_category)
		$features_categories_array[$features_category->name] =  $features_category->slug;

	vc_map( array(
		"name" => __("Features list", 'medicenter'),
		"base" => "features",
		"class" => "",
		"controls" => "full",
		"show_settings_on_create" => true,
		"icon" => "icon-wpb-layer-features-list",
		"category" => __('MediCenter', 'medicenter'),
		"params" => array(
			array(
				"type" => "dropdownmulti",
				"class" => "",
				"heading" => __("Display selected", 'medicenter'),
				"param_name" => "ids",
				"value" => $features_array
			),
			array(
				"type" => "dropdownmulti",
				"class" => "",
				"heading" => __("Display from Category", 'medicenter'),
				"param_name" => "category",
				"value" => $features_categories_array
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Type", 'medicenter'),
				"param_name" => "type",
				"value" => array(__("Large", 'medicenter') => "large", __("Small", 'medicenter') => "small")
			),
			/*array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Column layout", 'medicenter'),
				"param_name" => "columns",
				"value" => array(__("No", 'medicenter') => 0, __("Yes", 'medicenter') => 1)
			),*/
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Order by", 'medicenter'),
				"param_name" => "order_by",
				"value" => array(__("Title, menu order", 'medicenter') => "title,menu_order", __("Menu order", 'medicenter') => "menu_order", __("Date", 'medicenter') => "date")
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Order", 'medicenter'),
				"param_name" => "order",
				"value" => array(__("ascending", 'medicenter') => "ASC", __("descending", 'medicenter') => "DESC")
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Headers", 'medicenter'),
				"param_name" => "headers",
				"value" => array(__("No", 'medicenter') => 0, __("Yes", 'medicenter') => 1)
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Headers links", 'medicenter'),
				"param_name" => "headers_links",
				"value" => array(__("Yes", 'medicenter') => 1, __("No", 'medicenter') => 0)
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Read more button", 'medicenter'),
				"param_name" => "read_more",
				"value" => array(__("No", 'medicenter') => 0, __("Yes", 'medicenter') => 1)
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Icon links", 'medicenter'),
				"param_name" => "icon_links",
				"value" => array(__("Yes", 'medicenter') => 1, __("No", 'medicenter') => 0)
			),
			array(
				"type" => "dropdown",
				"heading" => __("Icon animation", "js_composer"),
				"param_name" => "animation",
				"value" => array(
					__("none", "medicenter") => "",
					__("fade in", "medicenter") => "fadeIn",
					__("scale", "medicenter") => "scale",
					__("slide right", "medicenter") => "slideRight",
					__("slide right 200%", "medicenter") => "slideRight200",
					__("slide left", "medicenter") => "slideLeft",
					__("slide left 50%", "medicenter") => "slideLeft50",
					__("slide down", "medicenter") => "slideDown",
					__("slide down 200%", "medicenter") => "slideDown200",
					__("slide up", "medicenter") => "slideUp"
				)
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Icon animation duration", 'medicenter'),
				"param_name" => "animation_duration",
				"value" => "600"
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Icon animation delay", 'medicenter'),
				"param_name" => "animation_delay",
				"value" => "0"
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Top margin", 'medicenter'),
				"param_name" => "top_margin",
				"value" => array(__("Section (large)", 'medicenter') => "page_margin_top_section", __("Page (small)", 'medicenter') => "page_margin_top", __("None", 'medicenter') => "none")
			)
		)
	));
}
add_action("init", "theme_features_vc_init"); 
?>