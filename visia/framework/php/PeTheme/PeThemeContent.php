<?php

class PeThemeContent {

	protected $master;
	protected $loops = array();
	protected $current = false;
	protected $blogLoop = false;
	protected $cols = 0;

	public function __construct(&$master) {
		$this->master = &$master;
		add_filter("pe_post_thumbnail",array(&$this,"post_thumbnail_filter"));	
		add_filter("wp_tag_cloud",array(&$this,"wp_tag_cloud_filter"));
		add_filter("widget_tag_cloud_args",array(&$this,"widget_tag_cloud_args_filter"));
		add_filter("previous_post_link",array(&$this,"strip_rel_filter"));
		add_filter("next_post_link",array(&$this,"strip_rel_filter"));
		add_filter("the_category",array(&$this,"strip_rel_filter"));
		add_filter("excerpt_more",array(&$this,"excerpt_more_filter"));
		add_filter("the_content_more_link",array(&$this,"the_content_more_link_filter"));
		add_filter("edit_post_link",array(&$this,"edit_post_link_filter"));
	}

	public function instantiate() {
	}

	public function loop($name = "") {
		$view = new PeThemeViewBlog;
		$conf = (object) array("settings" => (object) array("layout" => $name));
		$conf->settings->pager = "yes";
		$conf->settings->media = "yes";
		$view->output($conf);
	}

	public function have_posts() {
		if ($this->current) {
			//print_r($this->current);
			$res = $this->current->have_posts();
		} else {
			$res = have_posts();
		}
		return $res;
	}

	public function idx() {
		return $this->wpq->current_post;
	}

	public function last() {
		return $this->wpq->post_count-1;
	}

	public function is_single() {
		return $this->current ? false : is_single();
	}


	public function the_post() {
		if ($this->current) {
			$res = $this->current->the_post();
			$GLOBALS["more"] = false;
		} else {
			$res = the_post();
		}
		return $res;
	}

	public function beginRow($markup) {
		$cols = $this->cols;
		$idx = $this->wpq->current_post;
		if ($cols > 0 && ($idx % $cols) == 0) {
			echo $markup;
		}
	}

	public function endRow($markup = "</div>") {
		$cols = $this->cols;
		$idx = $this->wpq->current_post;
		$last = $this->wpq->post_count-1;
		if ($cols > 0 && (($idx == $last) || ($idx % $cols) == ($cols-1))) {
			echo $markup;
		}
	}


	public function looping($cols = 0) {
		if ($this->have_posts()) {
			$this->cols = $cols;
			$this->the_post();
			return true;
		}
		return false;
	}

	public function &wpq() {
		global $wp_query;
		return $wp_query;
	}

	public function &__get($what) {
		switch ($what) {
		case "wpq":
			if ($this->current) {
				return $this->current;
			}
			return $this->wpq();
		case "qv":
			return $this->wpq()->query_vars;
		case "page":
			$which = (is_front_page() && !is_home()) ? "page" : "paged";
			$page = isset($this->qv[$which]) ? intval($this->qv[$which]) : 0;
			return $page;
		}
	}

	public function title() {
		the_title();
	}

	public function titleAttribute() {
		the_title_attribute();
	}

	public function getLink() {
		$link = get_permalink();

		global $post;
		if (isset($post) && $post->post_type === "attachment") {
			$link = $this->get_origImage();
		}
		return $link;
	}

	public function link() {
		echo $this->get_link();
	}

	public function twitterShareLink() {
		$link = "http://twitter.com/home?status=";
		$link .= urlencode(get_the_title()." - ");
		$link .= get_permalink();
		echo esc_attr($link);
	}

	public function facebookShareLink() {
		$link = "http://www.facebook.com/sharer/sharer.php?u=";
		$link .= get_permalink();
		echo esc_attr($link);
	}

	public function filter($tax,$sep = "",$aclass="label",$template = '%s') {

		if (is_array($tax) && isset($tax[1]) && is_a($tax[1],"PeThemeDataLoop")) {
			$loop = $tax[1]->main->loop;

			$ids = array();
			$n = count($loop);
			for($i=0;$i<$n;$i++) {
				$ids[] = $loop[$i]->id;
			}

			$terms = wp_get_object_terms($ids,$tax[0]);

		} else if ($this->have_posts()) {
			$posts =& $this->wpq->posts;
			$ids = array();
			$n = count($posts);
			for($i=0;$i<$n;$i++) {
				$ids[] = $posts[$i]->ID;
			}
			$terms = wp_get_object_terms($ids,$tax);
		} else {
			$terms = array();
			//global $post;
			//print_r($post);
		}

		$seen = array();
		// to get all terms
		//$terms = get_terms($tax);

		$output = "";
		$buffer = "";

		if (is_array($terms) && count($terms) > 0) {
			$buffer = apply_filters("pe_theme_filter_item",sprintf('<a class="%s active" data-category="" href="#">%s</a>%s',$aclass,__("All",'Pixelentity Theme/Plugin'),"$sep\n"),$aclass,"",__("All",'Pixelentity Theme/Plugin'));
			$output = sprintf($template,$buffer);

			foreach ($terms as $term) {
				$id = $term->term_id;
				if (isset($seen[$id])) continue;
				$seen[$id] = true;
				$buffer = apply_filters("pe_theme_filter_item",sprintf('<a class="%s" data-category="%s" href="#">%s</a>%s',$aclass,$term->slug,$term->name,"$sep\n"),$aclass,$term->slug,$term->name);
				$output .= sprintf($template,$buffer);
			}
			print $output;
		}
	}

	public function filterClasses($tax,$id = null) {
		if (empty($tax)) return;
		if (empty($id)) {
			global $post;
			$id = $post->ID;
		}
		$classes = wp_get_post_terms($id,$tax,array("fields" => "slugs"));
		if (is_array($classes) && ($count = count($classes)) > 0) {
			while($count--) {
				$classes[$count] = "filter-".$classes[$count];
			}
			echo join(" ",$classes);
		}
	}

	public function thumb($useFilters = true) {
		global $post;
		if (has_post_thumbnail()) {
			$thumb = get_the_post_thumbnail($post->ID,"thumbnail");
			if ($useFilters && has_filter("pe_post_thumbnail")) {
				echo apply_filters("pe_post_thumbnail",$thumb);
			} else {
				echo $thumb;
			}
		}
	}

	public function post_thumbnail_filter($data) {
		return $data;
	}

	public function hasFeatImage() {
		global $post;
		return @has_post_thumbnail($post->ID);		
	}

	public function get_origImage($id = null) {
		return wp_get_attachment_url(get_post_thumbnail_id($id));
	}

	public function resizedImg($w,$h,$custom = null) {
		$url = empty($custom) ? wp_get_attachment_url(get_post_thumbnail_id()) : $custom;
		return $this->master->image->resizedImg($url,$w,$h);
	}

	public function img($w,$h = null,$custom = null) {
		$img = $this->resizedImg($w,$h,$custom);
		echo apply_filters("pe_theme_content_img",$img ? $img : "",$w,$h);
	}


	public function get_thumbImage($thumb) {
		if (@has_post_thumbnail()) {
			$thumb = wp_get_attachment_image_src(get_post_thumbnail_id(),$thumb);
			return $thumb[0];
		}
		return "";
	}

	public function origImage() {
		echo $this->get_origImage();
	}

	public function excerpt() {
		the_excerpt();
	}

	public function content($text = null) {
		global $post;
		if (isset($post) && $post->post_type === "attachment") {
			echo apply_filters("wpautop",$post->post_excerpt);
		} else {
			the_content($text);
		}
	}

	public function builder() {
		if (post_password_required()) {
			$this->content();
		} else {
			$meta =& $this->meta();
			if (empty($meta->builder)) return;
		
			global $post;
			$view = new PeThemeViewLayout();
			$conf = (object) 
				array(
					  "id" => $post->ID,
					  "settings" => $meta->builder
					  );

			$view->output($conf);
		}
	}

	public function hasMedia() {
		$format = $this->format();

		$meta =& $this->meta();
		$ret = false;

		switch ($format) {
		case "gallery":
			$gallery = empty($meta->gallery) ? false : $meta->gallery;
			$ret = !empty($gallery->id) && $gallery->id > 0;
			break;
		case "video":
			$video = empty($meta->video) ? false : $meta->video;
			$ret = !empty($video->id) && $video->id > 0;
			break;
		default:
			$ret = $this->hasFeatImage();
		}

		return $ret;
	}


	public function media() {
		$format = $this->format();

		$meta =& $this->meta();

		switch ($format) {
		case "gallery":
			$gallery = empty($meta->gallery) ? false : $meta->gallery;
			if (!empty($gallery->id)) {
				$conf = 
					$this->master->view->create(
												$gallery->type,
												"gallery",
												array("id" => $gallery->id),
												$gallery->width,
												$gallery->height
												);

				// use gallery caption
				$conf->caption = (object) array("title" => "ititle","description" => "caption");

				//$conf->caption->title = "ititle";
				//$conf->caption->description = "caption";

				$this->master->view->resize($conf);
			}


			break;
		case "video":
			$this->master->video->output();
			break;
		default:
			$format = $this->hasFeatImage() ? "image" : false;
		}

		return $format;
	}


	public function current($add = 0) {
		$page = $this->page;
		if ($page > 1) {
			$add += $this->qv["posts_per_page"]*($page-1);
		}
		echo $this->wpq->current_post + $add;
	}

	public function terms($tax,$sep = ",") {
		global $post;
		return join($sep,wp_get_post_terms($post->ID,$tax,array("fields" => "names")));
	}

	public function &getPostsQueryArgs($type,$count,$tax = null,$custom = null,$paged = false) {

		$args = array(
					  "post_type"=>"$type",
					  "posts_per_page"=>$count
					  );

		if ($tax) {
			$custom[$tax] = $this->terms($tax);
		}

		if (is_array($custom)) {
			$args = array_merge($args,$custom);
		}

		if ($paged) {
			$page = $this->page;
			$page = $page ? $page - 1 : 0;
			$args["offset"] = $count*$page;
		} else {
			// if pagination is not needed, avoid counting rows to boost performances
			$args['no_found_rows'] = true;
		}

		if ($args["post_type"] === "attachment") {
			$args["post_status"] = "inherit";
		}

		return $args;
	}

	public function getPostsLoop($type,$count,$tax = null,$custom = null,$paged = false) {

		$data = new StdClass();
		$args =& $this->getPostsQueryArgs($type,$count,$tax,$custom,$paged);

		$wpq = new WP_Query();
		$data->loop = $wpq->query($args);

		$loop =& $this->master->data->create($data,true);

		if ($paged) {
			$loop->pages = $wpq->max_num_pages;
		}

		return $loop;
	}

	public function customLoop($type,$count = 10,$tax = null,$custom = null,$paged = false) {
		$args =& $this->getPostsQueryArgs($type,$count,$tax,$custom,$paged);
		if ($this->current) {
			$this->loops[] = $this->current;
		}
		$this->master->data->postSave();
		$this->current = new WP_Query($args);
		return $this->current->post_count > 0;
	}

	public function related($type,$tax,$count) {
		//$settings = new StdClass();
		//$settings->post_type = "project";

		if ($loop = $this->customLoop($type,$count,$tax)) {
			get_template_part("related",$type);
			$this->resetLoop();
		}
	}


	public function resetLoop() {
		$this->master->data->postReset();
		$this->current = (count($this->loops) >0) ? array_pop($this->loops) : false;
	}

	public function blog($settings,$showpager = true) {
		global $post;
		
		$exclude = false;

		// prevents nested blogs
		if ($this->blogLoop) return;
		$this->blogLoop = true;

		// prevents loops
		if (isset($post) && $post) {
			$exclude = $post->ID;
		}

		if (is_string($settings) && !empty($settings)) {
			$id = $settings;
			$post = get_post($id);
			if (!$post) return;
			$meta = $this->master->meta->get($id,$post->post_type);
			if (empty($meta->blog)) return true;
			$settings = $meta->blog;
		}

		$settings = (object) shortcode_atts(
											array(
												  "layout" => "",
												  "count" => get_option("posts_per_page"),
												  "media" => "yes",
												  "pager" => "yes",
												  "sticky" => "yes",
												  "category" => "",
												  "tag" => "",
												  "format" => ""
												  ),
											(array) $settings
											);

		// prevents loops
		if ($exclude) {
			$custom = array("post__not_in" => array($exclude));
		}

		$custom["ignore_sticky_posts"] = ($settings->sticky === "no") ? 1 : 0;

		if ($settings->category) {
			$custom["category_name"] = $settings->category;
		}

		if ($settings->tag) {
			$custom["tag"] = $settings->tag;
		}
		
		if ($settings->format) {
			$tax_query = array(
							   array(
									 'taxonomy' => 'post_format',
									 'field' => 'slug',
									 'terms' => array("post-format-{$settings->format}")
									 )
							   );
			$custom["tax_query"] = $tax_query;
		}

		$media = $settings->media === "yes";

		$this->customLoop("post",$settings->count,null,$custom,$settings->pager === "yes");

		$compact = compact("media");
		
		$this->master->template->get_part($compact,"loop",$this->have_posts() ? $settings->layout : "empty");

		if ($showpager && $settings->pager === "yes") {
			$this->pager();
		}

		$this->resetLoop();
		$this->blogLoop = false;
		
	}

	public function getPagerLoop($max = 5,$pages = false) {
		$pages = $pages ? $pages : $this->wpq->max_num_pages;
		if ($pages <= 1) return false;
		for ($p = 0;$p<$pages;$p++) {
			$links[] = get_pagenum_link($p+1);
		}
		return $this->master->data->createPager($this->page,$links,$max);
	}

	public function pager($class = "span12",$pages = false) {
		$loop = $this->getPagerLoop(5,$pages);
		if ($loop) $loop->main->class = $class;
		$this->master->template->paginate_links($loop);
	}


	public function comments() {
		comments_number('0','1','%');
	}

	public function body_class($class = "") {
		echo 'class="' . apply_filters("pe_theme_body_class",join( ' ', get_body_class( $class ) )) . '"';
	}


	public function total() {
		echo $this->wpq->found_posts;
	}

	public function hasNextPage() {
		$max = $this->wpq->max_num_pages;
		return ($max > 1 && $this->page < $max);
	}

	public function hasPrevPage() {
		$max = $this->wpq->max_num_pages;
		return ($max > 1 && $this->page > 1);
	}


	public function tagCloud($number,$orderby="name") {
		wp_tag_cloud(array("number"=>$number,"orderby"=>$orderby,"order"=>$orderby == "count" ? "DESC" : "ASC")); 
	}

	public function tags($sep = ", ",$tax = false) {
		if ($tax) {
			echo get_the_term_list(null, $tax, "", $sep, "");
		} else {
			the_tags("",$sep,"");
		}
	}

	public function category($prefix="") {
		if ($prefix) {
			echo "$prefix ";
		}
		the_category(", ");
	}

	public function date($prefix="") {
		if ($prefix) {
			echo "$prefix ";
		}
		the_time(get_option('date_format'));
	}

	public function author($prefix="") {
		if ($prefix) {
			echo "$prefix ";
		}
		the_author();
	}

	public function format($is_format = null) {
		global $post;
		$format = get_post_format($post->ID);
		return empty($is_format) ? $format : $format === $is_format;
	}

	public function pageTemplate($post_id = null) {
		if (function_exists("get_page_template_slug")) return get_page_template_slug($post_id);
		$post = get_post( $post_id ); 
		if ( 'page' != $post->post_type ) 
			return false; 
		$template = get_post_meta( $post->ID, '_wp_page_template', true ); 
		if ( ! $template || 'default' == $template ) 
			return ''; 
	}

	public function slug() {
		global $post; 
		echo $post->post_name;
	}


	public function type() {
		global $post;
		return $post->post_type;
	}

	public function classes($add="") {
		$c = join(" ",get_post_class());
		$c = $add ? "$c $add" : "$c";
		printf('class="%s"',$c);
	}


	public function isVideo() {
		return get_post_format() === "video";
	}

	public function includeLoopPart($prefix="looped") {
		global $post;
		$type = $post->post_type;
		get_template_part("$prefix-$type",$this->format());
	}

	public function getBlogLink() {
		$pfp = get_option("page_for_posts"); 
		$pfp  = $pfp ? get_page_link($pfp) : "";

		return get_option('show_on_front') == 'page' ? $pfp : home_url();
	}

	public function wp_tag_cloud_filter($data) {
		if (is_tag()) {
			global $wp_query;
			$currentTagID = $wp_query->get_queried_object()->term_id;
			$data = str_replace("tag-link-$currentTagID","tag-link-$currentTagID current-tag",$data);
		}
		return preg_replace('/style=.[^"|\']+./i','',$data);
	}

	public function widget_tag_cloud_args_filter($args) {
		$options =& $this->master->options;
		$orderby = $options->get("tagCloudOrder");
		$args = array_merge($args,array("number"=>$options->get("tagCloudCount"),"orderby"=>$orderby,"order"=>$orderby == "count" ? "DESC" : "ASC"));
		return $args;
	}

	public function &meta($postID = FALSE) {
		global $post;
		//print_r($post);
		return $this->master->meta->get($postID ? $postID : ($post ? $post->ID : NULL),$post ? $post->post_type : "post");
	}

	public function strip_rel_filter($content) {
		return preg_replace('/rel="/','data-rel="',$content);
	}

	public function excerpt_more_filter($more) {
		return "";
	}

	public function the_content_more_link_filter($link) {
		$link = sprintf('&nbsp;<a href="%s#more-%s" class="read-more">%s</a>',get_permalink(),$GLOBALS["post"]->ID,__("more",'Pixelentity Theme/Plugin'));
		return $link;
	}

	public function edit_post_link_filter($link) {
		return str_replace("post-edit-link","label",$link);
	}

	
	public function getSocialLinks($links,$position = "top") {
		$html = "";
		if (is_array($links)) {
			foreach ($links as $link) {
				if (empty($link)) continue;
				list($icon,$tooltip) = explode("|",$link["icon"]);
				$html .= apply_filters("pe_theme_content_get_social_link",sprintf('<a href="%s" data-rel="tooltip" data-position="%s" data-original-title="%s"><i class="%s"></i></a>',$link["url"],$position,$tooltip,$icon),$link["url"],$tooltip,$icon);
			}
		}
	    return $html;
	}

	public function socialLinks($links,$position = "top") {
		$html = apply_filters("pe_theme_social_links",$this->getSocialLinks($links,$position),$position);
		echo $html ? $html : "";
	}

	public function getPagesByTemplate($template) {

		$args = array();

		if ($template) {
			$args = 
				array(
					  'meta_key' => '_wp_page_template',
					  'meta_value' => "page-$template.php"
					  );				
		} 

		$pages = get_pages($args);
		return $pages;
	}

	public function getPagesLinkByTemplate($template) {
		$pages = $this->getPagesByTemplate($template);
		if (!is_array($pages)) return false;
		$links = false;
		foreach ($pages as $page) {
			$links[] = get_page_link($page->ID);
		}
		return $links;
	}

	public function getPagesOptionsByTemplate($template) {
		$pages = $this->getPagesByTemplate($template);
		if (!is_array($pages)) return false;
		$links = false;
		foreach ($pages as $page) {
			$links[$page->post_title] = $page->ID;
		}
		return $links;
	}

	public function getPageLinkByTemplate($template) {
		$pages = $this->getPagesLinkByTemplate($template);
		return $pages ? $pages[0] : "";
	}


	public function adjPost($previous = false) {
		$post = get_adjacent_post(false,"", $previous);
		$ret = "";
		if ($post) {
			$ret = new StdClass;
			$ret->title = get_the_title($post);
			$ret->link = get_permalink($post);
			$ret->date = get_the_time(get_option('date_format'), $post);
		}
		return $ret; 
	}


	public function adjPostLink($previous = false) {
		$post = get_adjacent_post(false,"", $previous);
		return $post ? get_permalink($post) : "";	
	}

	public function prevPostLink() {
		return $this->adjPostLink(true);
	}

	public function nextPostLink() {
		return $this->adjPostLink(false);
	}

	public function linkPages() {
		wp_link_pages(array('before' => '<div class="page-links">' . __('Pages:','Pixelentity Theme/Plugin'), 'after' => '</div>'));
	}


}

?>
