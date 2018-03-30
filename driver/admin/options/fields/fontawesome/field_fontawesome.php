<?php
class Redux_Options_fontawesome {

    /**
     * Field Constructor.
     *
     * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
     *
     * @since Redux_Options 1.0.0
    */
    function __construct($field = array(), $value ='', $parent = null) {
        $this->field = $field;
		$this->value = $value;
		if($parent)
			$this->args = $parent->args;
		$this->icons = array("automobile","bank","behance","behance-square","bomb","building","cab","car","child","circle-o-notch","circle-thin","codepen","cube","cubes","database","delicious","deviantart","digg","drupal","empire","envelope-square","fax","file-archive-o","file-audio-o","file-code-o","file-excel-o","file-image-o","file-movie-o","file-pdf-o","file-photo-o","file-picture-o","file-powerpoint-o","file-sound-o","file-video-o","file-word-o","file-zip-o","ge","git","git-square","google","graduation-cap","hacker-news","header","history","institution","joomla","jsfiddle","language","life-bouy","life-ring","life-saver","mortar-board","openid","paper-plane","paper-plane-o","paragraph","paw","pied-piper","pied-piper-alt","pied-piper-square","qq","ra","rebel","recycle","reddit","reddit-square","send","send-o","share-alt","share-alt-square","slack","sliders","soundcloud","space-shuttle","spoon","spotify","steam","steam-square","stumbleupon","stumbleupon-circle","support","taxi","tencent-weibo","tree","university","vine","wechat","weixin","wordpress","yahoo","glass","music","search","envelope-o","heart","star","star-o","user","film","th-large","th","th-list","check","times","search-plus","search-minus","power-off","signal","cog","trash-o","home","file-o","clock-o","road","download","arrow-circle-o-down","arrow-circle-o-up","inbox","play-circle-o","repeat","refresh","list-alt","lock","flag","headphones","volume-off","volume-down","volume-up","qrcode","barcode","tag","tags","book","bookmark","print","camera","font","bold","italic","text-height","text-width","align-left","align-center","align-right","align-justify","list","outdent","indent","video-camera","picture-o","pencil","map-marker","adjust","tint","pencil-square-o","share-square-o","check-square-o","arrows","step-backward","fast-backward","backward","play","pause","stop","forward","fast-forward","step-forward","eject","chevron-left","chevron-right","plus-circle","minus-circle","times-circle","check-circle","question-circle","info-circle","crosshairs","times-circle-o","check-circle-o","ban","arrow-left","arrow-right","arrow-up","arrow-down","share","expand","compress","plus","minus","asterisk","exclamation-circle","gift","leaf","fire","eye","eye-slash","exclamation-triangle","plane","calendar","random","comment","magnet","chevron-up","chevron-down","retweet","shopping-cart","folder","folder-open","arrows-v","arrows-h","bar-chart-o","twitter-square","facebook-square","camera-retro","key","cogs","comments","thumbs-o-up","thumbs-o-down","star-half","heart-o","sign-out","linkedin-square","thumb-tack","external-link","sign-in","trophy","github-square","upload","lemon-o","phone","square-o","bookmark-o","phone-square","twitter","facebook","github","unlock","credit-card","rss","hdd-o","bullhorn","bell","certificate","hand-o-right","hand-o-left","hand-o-up","hand-o-down","arrow-circle-left","arrow-circle-right","arrow-circle-up","arrow-circle-down","globe","wrench","tasks","filter","briefcase","arrows-alt","users","link","cloud","flask","scissors","files-o","paperclip","floppy-o","square","bars","list-ul","list-ol","strikethrough","underline","table","magic","truck","pinterest","pinterest-square","google-plus-square","google-plus","money","caret-down","caret-up","caret-left","caret-right","columns","sort","sort-asc","sort-desc","envelope","linkedin","undo","gavel","tachometer","comment-o","comments-o","bolt","sitemap","umbrella","clipboard","lightbulb-o","exchange","cloud-download","cloud-upload","user-md","stethoscope","suitcase","bell-o","coffee","cutlery","file-text-o","building-o","hospital-o","ambulance","medkit","fighter-jet","beer","h-square","plus-square","angle-double-left","angle-double-right","angle-double-up","angle-double-down","angle-left","angle-right","angle-up","angle-down","desktop","laptop","tablet","mobile","circle-o","quote-left","quote-right","spinner","circle","reply","github-alt","folder-o","folder-open-o","smile-o","frown-o","meh-o","gamepad","keyboard-o","flag-o","flag-checkered","terminal","code","reply-all","mail-reply-all","star-half-o","location-arrow","crop","code-fork","chain-broken","question","info","exclamation","superscript","subscript","eraser","puzzle-piece","microphone","microphone-slash","shield","calendar-o","fire-extinguisher","rocket","maxcdn","chevron-circle-left","chevron-circle-right","chevron-circle-up","chevron-circle-down","html5","css3","anchor","unlock-alt","bullseye","ellipsis-h","ellipsis-v","rss-square","play-circle","ticket","minus-square","minus-square-o","level-up","level-down","check-square","pencil-square","external-link-square","share-square","compass","caret-square-o-down","caret-square-o-up","caret-square-o-right","eur","gbp","usd","inr","jpy","rub","krw","btc","file","file-text","sort-alpha-asc","sort-alpha-desc","sort-amount-asc","sort-amount-desc","sort-numeric-asc","sort-numeric-desc","thumbs-up","thumbs-down","youtube-square","youtube","xing","xing-square","youtube-play","dropbox","stack-overflow","instagram","flickr","adn","bitbucket","bitbucket-square","tumblr","tumblr-square","long-arrow-down","long-arrow-up","long-arrow-left","long-arrow-right","apple","windows","android","linux","dribbble","skype","foursquare","trello","female","male","gittip","sun-o","moon-o","archive","bug","vk","weibo","renren","pagelines","stack-exchange","arrow-circle-o-right","arrow-circle-o-left","caret-square-o-left","dot-circle-o","wheelchair","vimeo-square","try","plus-square-o");

		sort($this->icons);
    }

    /**
     * Field Render Function.
     *
     * Takes the vars and outputs the HTML for the field in the settings
     *
     * @since Redux_Options 1.0.0
    */
    function render() {
        echo '<p class="description" style="color:red;">' . __('The icons provided below are free to use custom icons from the <a href="http://fontawesome.io/" target="_blank">Font Awesome icons</a>', Redux_TEXT_DOMAIN) . '</p>';
        echo '<div class="fontawsome-select">';
        echo '<input type="hidden" id="' . $this->field['id'] . '" name="' . $this->args['opt_name'] . '[' . $this->field['id'] . ']" value="' . esc_attr($this->value) . '" />';
        echo '<h3><i class="fa fa-'.$this->value.'"></i> '.$this->value.'</h3>';
        echo '<ul class="fa-icons">';
        echo '	<li><a class="fontawsome-select-button" href="#">Select Icon <i class="fa fa-angle-down"></i></a>';
        echo '	<ul class="fa-icons-menu">';
        foreach($this->icons as $icon) {
	        
	        $selected = '';
	        if($icon == $this->value)
	        	$selected = ' class="selected"';
	        	
	        echo '<li'.$selected.'><a href="#" id="'.$icon.'"><i class="fa fa-'.$icon.'"></i> '.$icon.'</a></li>';
        }
        echo '	</ul>';
        echo '	</li>';
        echo '</ul>';
        echo '</div>';
        echo (isset($this->field['desc']) && !empty($this->field['desc'])) ? ' <span class="description">' . $this->field['desc'] . '</span>' : '';
    }

    /**
     * Enqueue Function.
     *
     * If this field requires any scripts, or css define this function and register/enqueue the scripts/css
     *
     * @since Redux_Options 1.0.0
    */
    function enqueue() {
        wp_enqueue_style(
            'redux-opts-fontawesome-css',
            '//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.css',
            false,
            '',
            'all'
        );
        wp_enqueue_style(
            'field_fontawsome.css',
            Redux_OPTIONS_URL . 'fields/fontawesome/field_fontawsome.css',
            false,
            '',
            'all'
        );
        wp_enqueue_script(
            'redux-opts-fontawesome-js',
            Redux_OPTIONS_URL . 'fields/fontawesome/jquery.fontawsome-select.js',
            array('jquery'),
            time(),
            true
        );
    }
}
