<form class="sh-wrap">
	<br>
	<label for="sh_list">Shortcodes</label>
	<br>
	<select id="sh_list" name="sh_list" class="widefat sh-list" style="width: 50%;">
		<option value="blog">Blog</option>
        <option value="van_button">Button</option>
        <option value="column">Column</option>
        <option value="feature">Config Wrapper</option>
        <option value="feature_item">-- Config Item</option>
        <option value="center">Center</option>
        <option value="clear">Clear Float</option>
        <option value="dropcap">Dropcap</option>
       	<option value="headline">headline</option>
        <option value="list">List Styles</option>
        <option value="portfolios">Portfolios</option>
        <option value="pricing_table">Pricing Table</option>
        <option value="post_slider">Post Slider</option>
        <option value="post_list">Recent Posts List</option>
        <option value="recent_comments">Recent Comments</option>
        <option value="separator">Separator</option>
        <option value="slider">Slider Wrapper</option>
        <option value="slide">-- Slide</option>
        <option value="skills">Skills Wrapper</option>
        <option value="skill">-- Skill</option>
        <option value="social_icons">Social Icons</option>
		<option value="tabs">Tabs Wrapper</option>
		<option value="tab_item">-- Tab Item</option>
		<option value="toggle">Toggle</option>
        <option value="team">Team Wrapper</option>
        <option value="member">-- Member Info</option>
	</select>
	<!-- end shortcodes -->
	<br>
	<br>
	
	
	<!-- shortcodes fields ====================================== -->

	
	<!-- column -->
	<div class="column" style="display: none;">
		<label for="column_width">Width</label>
		<br>
		<select id="column_width" name="column_width" class="widefat" style="width: 30%;">
			<option>1/2</option>
			<option>1/3</option>
			<option>1/4</option>
			<option>2/3</option>
			<option>3/4</option>
		</select>
		<br>
		<br>
        <label for="column_last">Is it the last column in a row?</label>
        <br>
		<select id="column_last" name="column_last" class="widefat" style="width: 30%;">
			<option value="0">No</option>
			<option value="1">Yes</option>
		</select>
        <br>
		<br>
		<label for="column_content">Content</label>
		<br>
		<textarea id="column_content" name="column_content" rows="4" cols="50" class="widefat" style="width: 50%;"></textarea>
	</div>
	<!-- end column -->
    
    <!-- center -->
	<div class="center" style="display: none;">
		<label for="center_width">Total Width</label>
		<br>
		<input id="center_width" name="center_width" rows="4" cols="50" class="widefat" style="width: 50%;" />
        <br><span class="van_desc">If you want to center a container, please enter the container's total width, e.g. 500px or 40%</span>
	</div>
	<!-- center column -->
	
	
	<!-- tab_item -->
	<div class="tab_item" style="display: none;">
		<label for="tab_title">Tab Title</label>
		<br>
		<input type="text" id="tab_title" name="tab_title" class="widefat" style="width: 30%;">
		<br>
		<br>
		<label for="tab_content">Tab Content</label>
		<br>
		<textarea id="tab_content" name="tab_content" rows="4" cols="50" class="widefat" style="width: 50%;"></textarea>
	</div>
	<!-- end tab item -->
	
	<!-- toggle -->
	<div class="toggle" style="display: none;">
		<label for="toggle_active">Active</label>
		<br>
		<select id="toggle_active" name="toggle_active" class="widefat" style="width: 30%;">
			<option value="off">Disactive</option>
			<option value="on">Active</option>
		</select>
		<br>
		<br>
		<label for="toggle_title">Title</label>
		<br>
		<input type="text" id="toggle_title" name="toggle_title" class="widefat" style="width: 30%;">
		<br>
		<br>
		<label for="toggle_content">Content</label>
		<br>
		<textarea id="toggle_content" name="toggle_content" rows="4" cols="50" class="widefat" style="width: 50%;"></textarea>
	</div>
	<!-- end toggle -->
	
	
	<!-- separator -->
	<div class="separator" style="display: none;">
		<label for="separator_color">Border color</label>
		<br>
		<input type="text" id="separator_color" name="sepeator_color" value="#ddd" class="widefat" style="width: 30%;"></textarea>
		<br><span class="van_desc">Enter your color code, e.g. #000000</span>
		<br>
	</div>
	<!-- end separator -->
	
	
	<!-- list -->
	<div class="list" style="display: none;">
        <label for="list_styles">List Styles</label>
		<br>
		<select id="list_styles" name="list_styles" class="widefat" style="width: 30%;">
			<option value="correct">Correct</option>
			<option value="error">Error</option>
            <option value="download">Download</option>
            <option value="star">Star</option>
		</select>
		<br>
		<br>
		<label for="list_content">Content</label>
		<br>
		<textarea id="list_content" name="list_content" rows="4" cols="50" class="widefat" style="width: 50%;">
<ul>
  <li>You list content here</li>
  <li>You list content here</li>
  <li>You list content here</li>
</ul>
        </textarea>
		<br><span class="van_desc">You must organize the list content as "ul li"</span>
	</div>
	<!-- end list -->
	
	
	<!-- headline -->
	<div class="headline" style="display: none;">
		<label for="headline_title">Title</label>
		<br>
		<input type="text" id="headline_title" name="headline_title" value="" class="widefat" style="width: 30%;" />
		<br>
		<br>
        <label for="headline_description">Description</label>
		<br>
		<input type="text" id="headline_description" name="headline_description" value="" class="widefat" style="width: 30%;" />
		<br><span class="van_desc">It's below the title.</span>
		<br>
        <br>
         <label for="headline_top">Top</label>
		<br>
		<input type="text" id="headline_top" name="headline_top" value="" class="widefat" style="width: 30%;" />
		<br><span class="van_desc">Distance from above section, e.g. 30px</span>
		<br>
        <br>
         <label for="headline_bottom">Bottom</label>
		<br>
		<input type="text" id="headline_bottom" name="headline_bottom" value="" class="widefat" style="width: 30%;" />
		<br><span class="van_desc">Distance from next section, e.g. 30px</span>
	</div>
	<!-- end headline -->

	
	
	<!-- Button -->
	<div class="van_button" style="display: none;">
		<label for="button_text">Button Text</label>
		<br>
		<input type="text" id="button_text" name="button_text" value="button" class="widefat" style="width: 30%;" />
		<br>
		<br>
        <label for="button_link">Button Link</label>
		<br>
		<input type="text" id="button_link" name="button_link" value="" class="widefat" style="width: 30%;" />
		<br><span class="van_desc">Don't forget add "http://" in front of the link.</span>
        <br>
		<br>
        <label for="button_link_target">Open Link in a new window/tab?</label>
		<br>
		<select id="button_link_target" name="button_link_target" class="widefat" style="width: 30%;">
			<option value="_self">No</option>
            <option value="_blank">Yes</option>
		</select>
		<br>
        <br>
        <label for="button_link_anchor">Is it anchor link?</label>
		<br>
		<select id="button_link_anchor" name="button_link_anchor" class="widefat" style="width: 30%;">
			<option value="0">No</option>
            <option value="1">Yes</option>
		</select>
		<br>
        <br>
        <label for="button_aligned">Button position</label>
		<br>
		<select id="button_aligned" name="button_aligned" class="widefat" style="width: 30%;">
			<option value="left">Left</option>
            <option value="center">Center</option>
            <option value="right">Right</option>
		</select>
		<br>
        <br>
        <label for="button_size">Button size</label>
		<br>
		<select id="button_size" name="button_size" class="widefat" style="width: 30%;">
			<option value="small">Small</option>
            <option value="large">Large</option>
            <option value="large-x">Large X</option>
		</select>
		<br>
        <br>
        <label for="button_color">Button color</label>
		<br>
		<select id="button_color" name="button_color" class="widefat" style="width: 30%;">
            <option value="">Custom</option>
			<option value="black">Black</option>
            <option value="grey">Grey</option>
            <option value="white">White</option>
            <option value="blue">Blue</option>
            <option value="red">Red</option>
            <option value="orange">Orange</option>
            <option value="green">Green</option>
            <option value="pink">Pink</option>
            <option value="purple">Purple</option>
            <option value="">None</option>
		</select>
		<br>
        <br>
        <label for="button_bgcolor">Custom background color</label>
		<br>
		<input type="text" id="button_bgcolor" name="button_bgcolor" value="" class="widefat" style="width: 30%;" />
		<br><span class="van_desc">e.g. #000000</span>
        <br>
		<br>
        <label for="button_textcolor">Custom text color</label>
		<br>
		<input type="text" id="button_textcolor" name="button_textcolor" value="" class="widefat" style="width: 30%;" />
		<br><span class="van_desc">e.g. #ffffff</span>
        <br>
        <br>
        <label for="button_bordercolor">Custom border color</label>
		<br>
		<input type="text" id="button_bordercolor" name="button_bordercolor" value="" class="widefat" style="width: 30%;" />
		<br><span class="van_desc">e.g. #333333</span>

	</div>
	<!-- end Button -->
	
	
	<!-- feature_item -->
	<div class="feature_item" style="display: none;">
		<label for="feature_title">Feature Title</label>
		<br>
		<input type="text" id="feature_title" name="feature_title" value="" class="widefat" style="width: 30%;" />
		<br>
		<br>
        <label for="feature_image_url">Feature Image URL</label>
		<br>
		<input type="text" id="feature_image_url" name="feature_image_url" value="" class="widefat" style="width: 30%;" />
		<br><span class="van_desc">You should upload the image via "Media" first, then paste the image URL here.</span>
        <br>
        <br>
        <label for="feature_link">Feature Link</label>
		<br>
		<input type="text" id="feature_link" name="feature_link" value="" class="widefat" style="width: 30%;" />
		<br><span class="van_desc">Don't forget http:// in front of the link, also, if you don't wanna add the link, just leave it empty.</span>
        <br>
		<br>
        <label for="feature_link_target">Open Link in a new window/tab?</label>
		<br>
		<select id="feature_link_target" name="feature_link_target" class="widefat" style="width: 30%;">
			<option value="_self">No</option>
            <option value="_blank">Yes</option>
		</select>
		<br>
        <br>

        <label for="feature_content">Feature Content</label>
		<br>
		<textarea id="feature_content" name="feature_content" rows="4" cols="50" class="widefat" style="width: 50%;"></textarea>
	</div>
	<!-- end feature_item -->
    
    <!-- pricing_table -->
	<div class="pricing_table" style="display: none;">
		<label for="pricing_name">Pricetable Name</label>
		<br>
		<input type="text" id="pricing_name" name="pricing_name" value="" class="widefat" style="width: 30%;" />
		<br>
		<br>
        <label for="pricing_price">Price</label>
		<br>
		<input type="text" id="pricing_price" name="pricing_price" value="" class="widefat" style="width: 30%;" />
		<br><span class="van_desc">Only price number, e.g. 30</span>
        <br>
        <br>
        <label for="pricing_link">Link</label>
		<br>
		<input type="text" id="pricing_link" name="pricing_link" value="" class="widefat" style="width: 30%;" />
		<br><span class="van_desc">Don't forget http:// in front of the link.</span>
        <br>
        <br>
        <label for="pricing_link_target">Open Link in a new window/tab?</label>
		<br>
		<select id="pricing_link_target" name="pricing_link_target" class="widefat" style="width: 30%;">
			<option value="_self">No</option>
            <option value="_blank">Yes</option>
		</select>
		<br>
        <br>
        <label for="pricing_plan">Table Color</label>
		<br>
		<select id="pricing_plan" name="pricing_plan" class="widefat" style="width: 30%;">
			<option value="1">Blue</option>
            <option value="2">Green</option>
            <option value="3">Orange</option>
            <option value="4">Brown</option>
		</select>
		<br>
        <br>
        
        <label for="pricing_currency">Currency</label>
		<br>
		<input type="text" id="pricing_currency" name="pricing_currency" value="$" class="widefat" style="width: 30%;" />
        <br><span class="van_desc">E.g. "$ , ￥"</span>
		<br>
        <br>
        
         <label for="pricing_cycle">Payment cycle</label>
		<br>
		<input type="text" id="pricing_cycle" name="pricing_cycle" value="/mo" class="widefat" style="width: 30%;" />
        <br><span class="van_desc">E.g. "/Year , /mo, or you can leave it empty"</span>
		<br>
        <br>
        
        <label for="pricing_button_text">Button Text</label>
		<br>
		<input type="text" id="pricing_button_text" name="pricing_button_text" value="More" class="widefat" style="width: 30%;" />
		<br>
        <br>
        <label for="pricing_content">Pricing Content</label>
		<br>
		<textarea id="pricing_content" name="pricing_content" rows="4" cols="50" class="widefat" style="width: 50%;">
          <li>Put your details in the Li tag</li>
          <li>Put your details in the Li tag</li>
          <li>Put your details in the Li tag</li>
          <li>Put your details in the Li tag</li>
        </textarea>
	</div>
	<!-- end pricing_table -->
    
    <!-- slide -->
	<div class="slide" style="display: none;">
        <label for="slide_image">Image URL</label>
		<br>
		<input type="text" id="slide_image" name="slide_image" value="" class="widefat" style="width: 30%;" />
		<br><span class="van_desc">You should upload the image via "Media" first, then paste the image URL here.</span>
        <br>
        <br>
        <label for="slide_alt">Image Alt</label>
		<br>
		<input type="text" id="slide_alt" name="slide_alt" value="" class="widefat" style="width: 30%;" />
        <br>
        <br>
        <label for="slide_link">Image Link</label>
		<br>
		<input type="text" id="slide_link" name="slide_link" value="" class="widefat" style="width: 30%;" />
		<br><span class="van_desc">Don't forget http:// in front of the link, also, if you don't wanna add the link, just leave it empty.</span>
        <br>
		<br>
        <label for="slide_target">Open Link in a new window/tab?</label>
		<br>
		<select id="slide_target" name="slide_target" class="widefat" style="width: 30%;">
			<option value="_self">No</option>
            <option value="_blank">Yes</option>
		</select>
		<br>
        <br>
        <br><strong>If you set following video URL, the image settings above will be instead.</strong>
        <br>
        <br>
        <label for="slide_youtube">Youtube URL</label>
		<br>
		<input type="text" id="slide_youtube" name="slide_youtube" value="" class="widefat" style="width: 30%;" />
		<br><span class="van_desc">Just copy the Youtube Video page URL</span>
        <br>
        <br>
        <label for="slide_vimeo">Vimeo URL</label>
		<br>
		<input type="text" id="slide_vimeo" name="slide_vimeo" value="" class="widefat" style="width: 30%;" />
		<br><span class="van_desc">Just copy the Vimeo Video page URL</span>
        <br>
        <br>
         <label for="slide_height">Video Height</label>
		<br>
		<input type="text" id="slide_height" name="slide_height" value="450px" class="widefat" style="width: 30%;" />
		<br><span class="van_desc">Default height is 450px</span>
	</div>
	<!-- end feature_item -->
    
    <!-- Comments -->
	<div class="recent_comments" style="display: none;">
        <label for="comment_number">Numer of Recent Comments</label>
		<br>
		<select id="comment_number" name="comment_number" class="widefat" style="width: 30%;">
			<option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
		</select>
	</div>
	<!-- end Comments -->

    <!-- member -->
	<div class="member" style="display: none;">
        <label for="member_name">Member Name</label>
		<br>
		<input type="text" id="member_name" name="member_name" value="" class="widefat" style="width: 30%;" />
        <br>
        <br>
        <label for="member_job">Job</label>
		<br>
		<input type="text" id="member_job" name="member_job" value="" class="widefat" style="width: 30%;" />
        <br>
        <br>
        <label for="member_avatar">Avatar URL</label>
		<br>
		<input type="text" id="member_avatar" name="member_avatar" value="" class="widefat" style="width: 30%;" />
        <br><span class="van_desc">Don't forget http:// in front of the URL</span>
        <br>
        <br>
        <label for="member_hover">Avatar Hover Effect</label>
		<br>
		<select id="member_hover" name="member_hover" class="widefat" style="width: 30%;">
			<option value="1">Yes</option>
            <option value="0">No</option>
		</select>
        <br>
        <br>
        <label for="member_content">Member Introducation</label>
		<br>
		<textarea id="member_content" name="member_content" rows="4" cols="50" class="widefat" style="width: 50%;"></textarea>
        <br>
        <br>
        <label for="member_facebook">Facebook URL</label>
        <br/>
        <input type="text" id="member_facebook" name="member_facebook" value="" class="widefat" style="width: 30%;" />
        <br>
        <br>
        <label for="member_twitter">Twitter URL</label>
        <br/>
        <input type="text" id="member_twitter" name="member_twitter" value="" class="widefat" style="width: 30%;" />
        <br>
        <br>
        <label for="member_linkedin">LinkedIn URL</label>
        <br />
        <input type="text" id="member_linkedin" name="member_linkedin" value="" class="widefat" style="width: 30%;" />
        <br>
        <br>
        <label for="member_googleplus">Google+ URL</label>
        <br />
        <input type="text" id="member_googleplus" name="member_googleplus" value="" class="widefat" style="width: 30%;" />
        <br>
        <br>
        <label for="member_dribbble">Dribbble URL</label>
        <br />
        <input type="text" id="member_dribbble" name="member_dribbble" value="" class="widefat" style="width: 30%;" />
        <br>
        <br>
        <label for="member_flickr">Flickr URL</label>
        <br />
        <input type="text" id="member_flickr" name="member_flickr" value="" class="widefat" style="width: 30%;" />
	</div>
	<!-- end member -->


	<!-- social_icon -->
	<div class="social_icons" style="display: none;">

		<label for="facebook">Facebook URL</label>
		<br>
		<input type="text" id="facebook" name="facebook" class="widefat" style="width: 50%;">
		<br>
		<br>
        <label for="twitter">Twitter URL</label>
		<br>
		<input type="text" id="twitter" name="twitter" class="widefat" style="width: 50%;">
		<br>
		<br>
         <label for="dribble">Dribble URL</label>
		<br>
		<input type="text" id="dribble" name="dribble" class="widefat" style="width: 50%;">
		<br>
        <br>
         <label for="meetup">Instagram URL</label>
		<br>
		<input type="text" id="instagram" name="instagram" class="widefat" style="width: 50%;">
        <br>
		<br>
         <label for="flickr">Flickr URL</label>
		<br>
		<input type="text" id="flickr" name="flickr" class="widefat" style="width: 50%;">
		<br>
		<br>
         <label for="googleplus">Google+ URL</label>
		<br>
		<input type="text" id="googleplus" name="googleplus" class="widefat" style="width: 50%;">
		<br>
		<br>
         <label for="linkedin">LinkedIn URL</label>
		<br>
		<input type="text" id="linkedin" name="linkedin" class="widefat" style="width: 50%;">
		<br>
		<br>
         <label for="tumblr">Tumblr URL</label>
		<br>
		<input type="text" id="tumblr" name="tumblr" class="widefat" style="width: 50%;">
		<br>
		<br>
         <label for="deviantart">Deviantart URL</label>
		<br>
		<input type="text" id="deviantart" name="deviantart" class="widefat" style="width: 50%;">
		<br>
		<br>
         <label for="behance">Behance URL</label>
		<br>
		<input type="text" id="behance" name="behance" class="widefat" style="width: 50%;">
		<br>
		<br>
        <label for="pinterest">Pinterest URL</label>
		<br>
		<input type="text" id="pinterest" name="pinterest" class="widefat" style="width: 50%;">
		<br>
		<br>
        <label for="youtube">Youtube URL</label>
		<br>
		<input type="text" id="youtube" name="youtube" class="widefat" style="width: 50%;">
		<br>
		<br>
        <label for="vimeo">Vimeo URL</label>
		<br>
		<input type="text" id="vimeo" name="vimeo" class="widefat" style="width: 50%;">
		<br>
		<br>
        <label for="myspace">Myspace URL</label>
		<br>
		<input type="text" id="myspace" name="myspace" class="widefat" style="width: 50%;">
		<br>
		<br>
        <label for="yahooim">YahooIM URL</label>
		<br>
		<input type="text" id="yahooim" name="yahooim" class="widefat" style="width: 50%;">
		<br>
		<br>
         <label for="aim">AIM URL</label>
		<br>
		<input type="text" id="aim" name="aim" class="widefat" style="width: 50%;">
		<br>
		<br>
         <label for="meetup">Meetup URL</label>
		<br>
		<input type="text" id="meetup" name="meetup" class="widefat" style="width: 50%;">
		<br>
		<br>
		<label for="fivehundreds">500px URL</label>
		<br>
		<input type="text" id="fivehundreds" name="fivehundreds" class="widefat" style="width: 50%;">
		<br>
		<br>
          <label for="klout">Klout URL</label>
		<br>
		<input type="text" id="klout" name="klout" class="widefat" style="width: 50%;">
		<br>
		<br>
          <label for="xing">Xing URL</label>
		<br>
		<input type="text" id="xing" name="xing" class="widefat" style="width: 50%;">
		<br>
		<br>
        <label for="soundcloud">SoundCloud URL</label>
		<br>
		<input type="text" id="soundcloud" name="soundcloud" class="widefat" style="width: 50%;">
		<br>
		<br>
		<label for="hearthis">HearThis URL</label>
		<br>
		<input type="text" id="hearthis" name="hearthis" class="widefat" style="width: 50%;">
		<br>
		<br>
		<label for="blogger">Blogger URL</label>
		<br>
		<input type="text" id="blogger" name="blogger" class="widefat" style="width: 50%;">
		<br>
		<br>
         <label for="myemail">My Email</label>
		<br>
		<input type="text" id="myemail" name="myemail" class="widefat" style="width: 50%;">
		<br>
		<br>
         <label for="rss">RSS</label>
		<br>
		<input type="text" id="rss" name="rss" class="widefat" style="width: 50%;">
	</div>
	<!-- end social_icon -->

      <!-- blog -->
	<div class="blog">
        <label for="blog_number">Number of posts to show</label>
		<br>
		<input type="text" id="blog_number" name="blog_number" value="" class="widefat" style="width: 30%;" />
		<br><span class="van_desc">If you leave it empty, it will display 5 posts</span>
        <br>
           <br>
        <label for="blog_category">From categories</label>
		<br>
		<input type="text" id="blog_category" name="blog_category" value="" class="widefat" style="width: 30%;" />
		<br><span class="van_desc">Please add category slug, separate multiple category slugs with commas. If you leave it empty, it will show the posts from all categories</span>
        <br>

        <br />
        <br>
        <label for="blog_gridview">Gridview layout?</label>
		<br>
		<select id="blog_gridview" name="blog_gridview" class="widefat" style="width: 30%;">
			<option value="yes">Yes</option>
			<option value="no">No</option>
		</select>
		<br>
        <br>
         <label for="blog_thumbnail">Show the featured thumbnail?</label>
		<br>
		<select id="blog_thumbnail" name="blog_thumbnail" class="widefat" style="width: 30%;">
			<option value="yes">Yes</option>
            <option value="no">No</option>
		</select>
	</div>
	<!-- end blog -->
    
    
    <!-- post list -->
	<div class="post_list" style="display: none;">
        <label for="post_list_number">Number of posts to show</label>
		<br>
		<input type="text" id="post_list_number" name="post_list_number" value="" class="widefat" style="width: 30%;" />
		<br><span class="van_desc">If you leave it empty, it will display 5 posts</span>
        <br>
        <label for="post_list_category">From categories</label>
		<br>
		<input type="text" id="post_list_category" name="post_list_category" value="" class="widefat" style="width: 30%;" />
		<br><span class="van_desc">Please add category slug, separate multiple category slugs with commas. If you leave it empty, it will show the posts from all categories</span>
        <br>
        <br />
        <label for="post_list_thumbnail">Show the featured thumbnail?</label>
		<br>
		<select id="post_list_thumbnail" name="post_list_thumbnail" class="widefat" style="width: 30%;">
			<option value="yes">Yes</option>
            <option value="no">No</option>
		</select>
	</div>
	<!-- end post list -->
    
     <!-- portfolios -->
	<div class="portfolios" style="display: none;">
        <label for="portfolios_number">Number of Portfolios to show</label>
		<br>
		<input type="text" id="portfolios_number" name="portfolios_number" value="9" class="widefat" style="width: 30%;" />
		<br><span class="van_desc">If you leave it empty, it will display 9 portfolios</span>
        <br>
        <br />
        <label for="portfolios_category">From categories</label>
		<br>
		<input type="text" id="portfolios_category" name="portfolios_category" value="" class="widefat" style="width: 30%;" />
		<br><span class="van_desc">Please add category slug, separate multiple category slugs with commas. If you leave it empty, it will show the posts from all categories</span>
        <br>
        <br>
        <label for="portfolios_open">Open Method</label>
		<br>
		<select id="portfolios_open" name="portfolios_open" class="widefat" style="width: 30%;">
			<option value="ajax">SlideDown</option>
            <option value="lightbox">Lightbox</option>
            <option value="link">Link to Page</option>
		</select>
        <br>
        <br>
        <label for="portfolios_excerpt">Show Excerpt</label>
		<br>
		<select id="portfolios_excerpt" name="portfolios_excerpt" class="widefat" style="width: 30%;">
			<option value="1">Yes</option>
            <option value="0">No</option>
		</select>
        <br>
        <br>
        <label for="portfolios_columns">Columns</label>
		<br>
		<select id="portfolios_columns" name="portfolios_columns" class="widefat" style="width: 30%;">
			<option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
		</select>
        <br>
        <br>
         <label for="portfolios_orderby">Order By</label>
		<br>
		<select id="portfolios_orderby" name="portfolios_orderby" class="widefat" style="width: 30%;">
			<option value="date">date</option>
            <option value="rand">random</option>
		</select>
         <br>
        <br>
         <label for="portfolios_filter">Show Filter</label>
		<br>
		<select id="portfolios_filter" name="portfolios_filter" class="widefat" style="width: 30%;">
			<option value="1">Yes</option>
            <option value="0">No</option>
		</select>
         <br>
        <br>
        <label for="portfolios_inverse">Filter Inverse Color</label>
		<br>
		<select id="portfolios_inverse" name="portfolios_inverse" class="widefat" style="width: 30%;">
			<option value="0">No</option>
            <option value="1">Yes</option>
		</select>
	</div>
	<!-- end post list -->
    
     <!-- skill -->
	<div class="skill" style="display: none;">
        <label for="skill_title">Skill Title</label>
		<br>
		<input type="text" id="skill_title" name="skill_title" value="" class="widefat" style="width: 30%;" />
		<br>
        <br>
        <label for="skill_percent">Percent Value</label>
		<br>
		<input type="text" id="skill_percent" name="skill_percent" value="50%" class="widefat" style="width: 30%;" />
		<br>
        <br>
        <label for="skill_hide_percent">Hide Percent</label>
		<br>
	    <select id="skill_hide_percent" name="skill_hide_percent" class="widefat" style="width: 30%;">
			<option value="0">No</option>
            <option value="1">Yes</option>
		</select>
		<br>
        <br>
        <label for="skill_text">Instead Percent Text</label>
		<br>
		<input type="text" id="skill_text" name="skill_text" value="" class="widefat" style="width: 30%;" />
        <br><span class="van_desc">Use this text to instead of the percent number, but if you hide percent above, the text will be also hidden.</span>
        <br>
        <br>
        <label for="skill_color">Background Color</label>
		<br>
		<input type="text" id="skill_color" name="skill_color" value="#f39e3a" class="widefat" style="width: 30%;" />
		
	</div>
	<!-- end skill -->
   
	
	<!-- end shortcodes fields ====================================== -->
	
	<br/>
    <br/>
	<button type="button" id="insert-button" class="button button-primary button-large btn-sh-insert">Insert Shortcode</button>
</form>


<script type="text/javascript">
jQuery(document).ready( function($)
	{
		var sh_selected = 'blog';
		
		$( '.sh-list' ).change( function()
		{
			$( '.sh-wrap div' ).hide();
			
			sh_selected = $( '.sh-list' ).val();
			
			$( '.' + sh_selected ).show();
		});
		
		
		// insert button
		$( '.btn-sh-insert' ).click( function()
		{
			// sh_out
			var sh_out = "";

			//Column
			if ( sh_selected == 'column' )
			{
				var column_width = $( '#column_width' ).val();
				var column_last = $( '#column_last' ).val();
				var column_content = $( '#column_content' ).val();
				var last;
				
				if(column_last=='1'){last='_last';}else{last='';}
				
				if(column_width=='1/2'){
				  sh_out = '[one_half'+last+']' + column_content + '[/one_half'+last+']';
				}else if(column_width=='1/3'){
					  sh_out = '[one_third'+last+']' + column_content + '[/one_third'+last+']';
				}else if(column_width=='1/4'){
					  sh_out = '[one_fourth'+last+']' + column_content + '[/one_fourth'+last+']';
				}else if(column_width=='2/3'){
					  sh_out = '[two_third'+last+']' + column_content + '[/two_third'+last+']';
				}if(column_width=='3/4'){
					  sh_out = '[three_fourth'+last+']' + column_content + '[/three_fourth'+last+']';
				}
			}
			//Center
			else if ( sh_selected == 'center' )
			{
				var center_width = $( '#center_width' ).val();
				sh_out = '[center width="'+center_width+'"][/center]';
			}
			//Tabs
			else if ( sh_selected == 'tabs' )
			{
				sh_out = '[tabs][/tabs]';
			}
			//Tab item
			else if ( sh_selected == 'tab_item' )
			{
				var tab_content = $( '#tab_content' ).val();
				var tab_title = $( '#tab_title' ).val();
				
				sh_out = '[tab title="' + tab_title + '"]'+tab_content+'[/tab]';
			}

			// Toggle
			else if ( sh_selected == 'toggle' )
			{
				var toggle_active = $( '#toggle_active' ).val();
				var toggle_title = $( '#toggle_title' ).val();
				var toggle_content = $( '#toggle_content' ).val();
				
				sh_out = '[toggle status="' + toggle_active + '" title="' + toggle_title + '"]' + toggle_content + '[/toggle]';
			}
			
			//Dropcap
			else if ( sh_selected == 'dropcap' )
			{
				sh_out = '[dropcap][/dropcap]';
			}
			
			//Separator
			else if ( sh_selected == 'separator' )
			{
				var separator_color = $( '#separator_color' ).val();
				sh_out = '[line color="'+separator_color+'"]';
			}
			
			//clear
			else if ( sh_selected == 'clear' )
			{
				sh_out = '[clear]';
			}
			
			//List
			else if ( sh_selected == 'list' )
			{
				var list_content = $( '#list_content' ).val();
				var list_styles=$('#list_styles').val();
				
				sh_out = '[list style="'+list_styles+'"]' + list_content + '[/list]';
			}
			
			//headline
			else if ( sh_selected == 'headline' )
			{
				var headline_title = $( '#headline_title' ).val();
				var headline_description = $( '#headline_description' ).val();
				var headline_top = $( '#headline_top' ).val();
				var headline_bottom = $( '#headline_bottom' ).val();
				var headline_color = $( '#headline_color' ).val();
				
				sh_out = '[headline title="'+headline_title+'" desc="'+headline_description+'" top="'+headline_top+'" bottom="'+headline_bottom+'"]';
			}
			
			//Button
			else if ( sh_selected == 'van_button' )
			{
				var button_text = $( '#button_text' ).val();
				var button_link = $( '#button_link' ).val();
				var button_link_target = $( '#button_link_target' ).val();
				var button_link_anchor = $( '#button_link_anchor' ).val();
				var button_aligned = $( '#button_aligned' ).val();
				var button_size = $( '#button_size' ).val();
				var button_color = $( '#button_color' ).val();
				var button_bgcolor = $( '#button_bgcolor' ).val();
				var button_textcolor = $( '#button_textcolor' ).val();
				var button_bordercolor = $( '#button_bordercolor' ).val();
				
				sh_out = '[button text="'+button_text+'" href="'+button_link+'" target="'+button_link_target+'" anchor='+button_link_anchor+' align="'+button_aligned+'" size="'+button_size+'" color="'+button_color+'" bg_color="'+button_bgcolor+'" text_color="'+button_textcolor+'" border_color="'+button_bordercolor+'"]';
			}
			
			//Feature
			else if ( sh_selected == 'feature' )
			{
				sh_out = '[config][/config]';
			}
			
			//Feature item
			else if ( sh_selected == 'feature_item' )
			{
				var feature_title = $( '#feature_title' ).val();
				var feature_image_url = $( '#feature_image_url' ).val();
				var feature_link = $( '#feature_link' ).val();
				var feature_link_target = $( '#feature_link_target' ).val();
				var feature_content = $( '#feature_content' ).val();
				
				sh_out = '[config_item title="'+feature_title+'" image="'+feature_image_url+'" href="'+feature_link+'" target="'+feature_link_target+'"]' + feature_content + '[/config_item]';
			}
			
			//Pricing
			else if ( sh_selected == 'pricing_table' )
			{
				var pricing_name = $( '#pricing_name' ).val();
				var pricing_price = $( '#pricing_price' ).val();
				var pricing_link = $( '#pricing_link' ).val();
				var pricing_link_target = $( '#pricing_link_target' ).val();
				var pricing_plan = $( '#pricing_plan' ).val();
				var pricing_cycle = $( '#pricing_cycle' ).val();
				var pricing_currency = $( '#pricing_currency' ).val();
				var pricing_button_text = $( '#pricing_button_text' ).val();
				var pricing_content = $( '#pricing_content' ).val();

				sh_out = '[pricing name="'+pricing_name+'" price="'+pricing_price+'" link="'+pricing_link+'" target="'+pricing_link_target+'" plan="'+pricing_plan+'" linktext="'+pricing_button_text+'" cycle="'+pricing_cycle+'" currency="'+pricing_currency+'"]' + pricing_content + '[/pricing]';
			}
			
			//Post slider
			else if ( sh_selected == 'post_slider' )
			{
				sh_out = '[post_slider]';
			}
			
			//Skills
			else if ( sh_selected == 'skills' )
			{
				sh_out = '[skills][/skills]';
			}
			
			//Skill
			else if ( sh_selected == 'skill' )
			{
				var skill_title = $( '#skill_title' ).val();
				var skill_percent = $( '#skill_percent' ).val();
				var skill_text = $( '#skill_text' ).val();
				var skill_hide_percent = $( '#skill_hide_percent' ).val();
				var skill_color = $( '#skill_color' ).val();
				
				sh_out = '[skill title="'+skill_title+'" percent="'+skill_percent+'" text="'+skill_text+'" hide_percent='+skill_hide_percent+' color="'+skill_color+'"]';
			}
			
			//Slider
			else if ( sh_selected == 'slider' )
			{
				sh_out = '[slider][/slider]';
			}
			
			//Slide
			else if ( sh_selected == 'slide' )
			{
				var slide_image = $( '#slide_image' ).val();
				var slide_link = $( '#slide_link' ).val();
				var slide_target = $( '#slide_target' ).val();
				var slide_alt = $( '#slide_alt' ).val();
				var slide_youtube = $( '#slide_youtube' ).val();
				var slide_vimeo = $( '#slide_vimeo' ).val();
				var slide_height = $( '#slide_height' ).val();
				sh_out = '[slide src="'+slide_image+'" alt="'+slide_alt+'" href="'+slide_link+'" target="'+slide_target+'" youtube="'+slide_youtube+'" vimeo="'+slide_vimeo+'" height="'+slide_height+'"]';
			}
			
			//Social icons
			else if ( sh_selected == 'social_icons' )
			{
				var facebook = $( '#facebook' ).val();
				var twitter = $( '#twitter' ).val();
				var dribble = $( '#dribble' ).val();
				var flickr = $( '#flickr' ).val();
				var googleplus = $( '#googleplus' ).val();
				var linkedin = $( '#linkedin' ).val();
				var tumblr = $( '#tumblr' ).val();
				var deviantart = $( '#deviantart' ).val();
				var behance = $( '#behance' ).val();
				var pinterest = $( '#pinterest' ).val();
				var youtube = $( '#youtube' ).val();
				var vimeo = $( '#vimeo' ).val();
				var myspace = $( '#myspace' ).val();
				var yahooim = $( '#yahooim' ).val();
				var aim = $( '#aim' ).val();
				var meetup = $( '#meetup' ).val();
				var fivehundreds = $( '#fivehundreds' ).val();
				var xing = $( '#xing' ).val();
				var klout = $( '#klout' ).val();
				var myemail = $( '#myemail' ).val();
				var soundcloud = $( '#soundcloud' ).val();
				var hearthis = $( '#hearthis' ).val();
				var blogger = $( '#blogger' ).val();
				var rss = $( '#rss' ).val();
				var instagram = $('#instagram').val();
				
				sh_out = '[social_icon facebook="'+facebook+'" twitter="'+twitter+'" dribble="'+dribble+'" flickr="'+flickr+'" googleplus="'+googleplus+'" linkedin="'+linkedin+'" tumblr="'+tumblr+'" deviantart="'+deviantart+'" behance="'+behance+'" pinterest="'+pinterest+'" youtube="'+youtube+'" vimeo="'+vimeo+'" myspace="'+myspace+'" yahooim="'+yahooim+'" aim="'+aim+'" meetup="'+meetup+'" fivehundreds="'+fivehundreds+'" rss="'+rss+'" instagram="'+instagram+'" xing="'+xing+'" klout="'+klout+'" myemail="mailto:'+myemail+'" soundcloud="'+soundcloud+'" hearthis="'+hearthis+'"]';
			}
			

			//blog
			else if ( sh_selected == 'blog' )
			{
				var blog_number = $( '#blog_number' ).val();
				var blog_category = $( '#blog_category' ).val();
				//var blog_selector = $( '#blog_selector' ).val();
				var blog_thumbnail = $( '#blog_thumbnail' ).val();
				if(blog_thumbnail=='yes'){blog_thumbnail=1;}
				if(blog_thumbnail=='no'){blog_thumbnail=0;}
				var blog_gridview = $( '#blog_gridview' ).val();
				if(blog_gridview=='yes'){blog_gridview=1;}
				if(blog_gridview=='no'){blog_gridview=0;}
				
				sh_out = '[blog number='+blog_number+'" category="'+blog_category+'" thumbnail='+blog_thumbnail+' gridview='+blog_gridview+']';
			}
			
			//comment
			else if ( sh_selected == 'recent_comments' )
			{
				var comment_number = $( '#comment_number' ).val();
				
				sh_out = '[comments number='+comment_number+']';
			}
			
			//post list
			else if ( sh_selected == 'post_list' )
			{
				var post_list_thumbnail = $( '#post_list_thumbnail' ).val();
				if(post_list_thumbnail=="yes"){post_list_thumbnail=1;}
				if(post_list_thumbnail=="no"){post_list_thumbnail=0;}
				var post_list_number = $( '#post_list_number' ).val();
				var post_list_category = $( '#post_list_category' ).val();
				
				sh_out = '[post_list thumbnail='+post_list_thumbnail+' number='+post_list_number+' category="'+post_list_category+'"]';
			}
			
			//Team
			else if ( sh_selected == 'team' )
			{
				sh_out = '[team][/team]';
			}
			
			
			//Member
			else if ( sh_selected == 'member' )
			{
				var member_name = $( '#member_name' ).val();
				var member_job = $( '#member_job' ).val();
				var member_avatar = $( '#member_avatar' ).val();
				var member_hover = $( '#member_hover' ).val();
				var member_facebook = $( '#member_facebook' ).val();
				var member_twitter = $( '#member_twitter' ).val();
				var member_googleplus = $( '#member_googleplus' ).val();
				var member_linkedin = $( '#member_linkedin' ).val();
				var member_flickr = $( '#member_flickr' ).val();
				var member_dribbble = $( '#member_dribbble' ).val();
				var member_content = $( '#member_content' ).val();
				
				sh_out = '[member name="'+member_name+'" job="'+member_job+'" avatar="'+member_avatar+'" hover="'+member_hover+'" facebook="'+member_facebook+'" twitter="'+member_twitter+'" googleplus="'+member_googleplus+'" flickr="'+member_flickr+'" dribbble="'+member_dribbble+'" linkedin="'+member_linkedin+'"]'+member_content+'[/member]';
			}
			
			
			//Portfolios
			else if ( sh_selected == 'portfolios' )
			{
				var portfolios_number = $( '#portfolios_number' ).val();
				var portfolios_open = $( '#portfolios_open' ).val();
				var portfolios_excerpt = $( '#portfolios_excerpt' ).val();
				var portfolios_columns = $( '#portfolios_columns' ).val();
				var portfolios_orderby = $( '#portfolios_orderby' ).val();
				var portfolios_category = $( '#portfolios_category' ).val();
				var portfolios_filter = $( '#portfolios_filter' ).val();
				var portfolios_inverse = $( '#portfolios_inverse' ).val();
				
				var portfolios_ajax;
				var portfolios_lightbox;
				var display_filter;
				var filter_inverse;
				
				if(portfolios_open=='ajax'){
				  portfolios_ajax=1;
				  portfolios_lightbox=0;
				}else if(portfolios_open=='lightbox'){
				  portfolios_ajax=0;
				  portfolios_lightbox=1;
				}else if(portfolios_open=='link'){
				  portfolios_ajax=0;
				  portfolios_lightbox=0;
				}
				
				if(portfolios_filter==1){
				  display_filter='[portfolios_filter inverse='+portfolios_inverse+' category="'+portfolios_category+'"]';
				}
				
				sh_out = display_filter+'[portfolios number='+portfolios_number+' category="'+portfolios_category+'" intro='+portfolios_excerpt+' col='+portfolios_columns+' orderby="'+portfolios_orderby+'" ajax='+portfolios_ajax+' lightbox='+portfolios_lightbox+']';
			}

			
			// end sh_out
			
			
			// add to editor
			if ( window.tinyMCE )
			{
				var tmce_ver=window.tinyMCE.majorVersion;
				if (tmce_ver<"4") {
				    window.tinyMCE.execInstanceCommand( 'content', 'mceInsertContent', false, sh_out );
				}else{
					parent.tinyMCE.execCommand('mceInsertContent', false,sh_out);
				}
				tb_remove();
			}
			// end add to editor
		});
		// end insert button
	});
</script>