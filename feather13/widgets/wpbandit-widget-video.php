<?php
/**
	WPBandit Video Widget

	The contents of this file are subject to the terms of the GNU General
	Public License Version 2.0. You may not use this file except in
	compliance with the license. Any of the license terms and conditions
	can be waived if you get permission from the copyright holder.

	Copyright (c) 2012 WPBandit
	Jermaine Marée

		@package WPB_Widget_Video
		@version 1.0
**/

class WPB_Widget_Video extends WP_Widget {

	public
		$id = 'wpb-video',
		$name = 'WPB Video',
		$class = 'widget_wpb_video';

	private
		$vars;

	/**
		Class constructor
			@public
	**/
	public function __construct() {
		parent::__construct($this->id,$this->name,
			// Widget Options
			array(
				'classname'		=> $this->class,
				'description'	=> __('Display a video by adding a link or embed code.','air')
			)
		);
	}

	/**
		Form
			@public
	**/
 	public function form($instance) {
		// Defaults
		$defaults = array(
			'title' 			=> __('Video','air'),
			'video-url'			=> '',
			'video-embed-code'	=> ''
		);

		// Parse $instance and merge with $defaults
		$val = wp_parse_args((array)$instance, $defaults);

		// Title field
		$form = AirForm::widget_text($this->_field_atts('title'), $val['title'], 'Title:');

		// Video URL field	
		$form .= AirForm::widget_text($this->_field_atts('video-url'), $val['video-url'],
			__('Video URL:','air'));

		// Video Embed Code field
		$form .= AirForm::widget_textarea(
			$this->_field_atts('video-embed-code', array('class'=>'widefat', 'rows'=>'5')),
			$val['video-embed-code'], __('Video Embed Code:','air')
		);

		// Print form
		echo $form;
	}

	/**
		Update
			@public
	**/
	public function update($new,$old) {
		// Get existing options
		$valid = $old;

		// Validate options
		$valid['title'] = esc_attr($new['title']);
		$valid['video-url'] = esc_url($new['video-url']);	
		$valid['video-embed-code'] = $new['video-embed-code'];

		// Return validated options
		return $valid;
	}

	/**
		Widget
			@public
	**/
	public function widget($args,$opts) {
		// Set widget title
		$title = $opts['title'];

		// Set content
		if ( !empty($opts['video-url']) ) {
			$video_url = '[embed]'.$opts['video-url'].'[/embed]';
			$content = apply_filters('wpb_widget_video_url', $video_url);
		} elseif ( !empty($opts['video-embed-code']) ) {
			$content = $opts['video-embed-code'];
		} else {
			$content = '';
		}

		// Build widget
		$widget = $this->_build_widget($args,$title,$content);

		// Print widget
		echo $widget;
	}

	/**
		Get field attributes
			@private
	**/
	private function _field_atts($name,$extra=NULL) {
		$atts = array(
			'id'	=> $this->get_field_id($name),
			'name'	=> $this->get_field_name($name)
		);

		// Merge extra attributes
		if ( $extra ) $atts = array_merge($atts, $extra);

		// Return attributes
		return $atts;
	}

	/**
		Builds widget
			@private
	**/
	private function _build_widget($args,$title,$content='') {
		extract($args);
		$title = apply_filters($this->class.'_title', $title);
		
		// Build widget
		$widget = $before_widget;
		if ( !empty($title) )
			$widget .= $before_title . $title . $after_title;
		$widget .= '<div class="video-container">'.$content.'</div>';
		$widget .= $after_widget;

		// Return widget
		return $widget;
	}

}