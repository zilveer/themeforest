<?php


/**
 * Column generator
 */
class ctColumnGeneratorShortcode extends ctShortcode {

	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return 'Layout generator';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'row_generator';
	}

	/**
	 * Action
	 * @return string
	 */

	public function getGeneratorAction() {
		return self::GENERATOR_ACTION_POPUP;
	}

	/**
	 * Handles shortcode
	 * @param $atts
	 * @param null $content
	 * @return string
	 */

	public function handle($atts, $content = null) {
		return do_shortcode($content);
	}

	/**
	 * Returns config
	 * @return null
	 */
	public function getAttributes() {
		return array(
			'class' => array('type' => false)
		);
	}

	/**
	 * Render data
	 * @param array $params
	 * @return string
	 */
	public function getCustomFormView($params = array()) {
		wp_enqueue_script('jquery-ui-sortable');
		wp_enqueue_script('jquery-ui-droppable');
		wp_enqueue_script('jquery-ui-draggable');

		$customJs = '
		jQuery(function () {
			var total = 0;
			var dummy = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc mi ipsum, congue non congue at, elementu.";
			var limit = 12;
			var sizes = jQuery("#sizes .size");

				jQuery("#sizes .size").draggable({
					appendTo: "body",
					helper: "clone"
				});
				jQuery("#row").droppable({
					activeClass: "ui-state-default",
					hoverClass: "ui-state-hover",
					accept: ".accept",
					drop: function (event, ui) {
						ui.draggable.clone().removeClass("ui-draggable").appendTo(this);
						total+=parseInt(ui.draggable.attr("data-size"));
						recalculate();
						jQuery("#row .placeholder").remove();
					}
				});

				function recalculate(){
					sizes.each(function(k,e){
					var t = jQuery(e);
						if(total+parseInt(t.attr("data-size"))>limit){
							t.removeClass("accept");
						} else {
							t.addClass("accept");
						}
					});

					updateShortcode();
				}

				function updateShortcode(){
					var br ="\\n\\r";
					var code = "[row]"+br;
					jQuery("#row .size").each(function(k,e){
						e = jQuery(e);
						code+="["+e.attr("data-code")+"]"+br+"Column "+e.attr("data-name")+" content "+dummy+br+"[/"+e.attr("data-code")+"]"+br;
					});
					code +="[/row]"

					jQuery("#shortcode").val(code);
				}

				jQuery("span.close").live("click",function(){
					var s = jQuery(this).parents(".size");
					total-=parseInt(s.attr("data-size"));
					s.remove();
					recalculate();
				});
			});
			';

		$sizes = array(
			array(array('name' => '1/6', 'size' => 2, 'code' => 'one_sixth_column'),
				array('name' => '1/4', 'size' => 3, 'code' => "quarter_column"),
				array('name' => '1/3', 'size' => 4, 'code' => 'third_column'),
				array('name' => '1/2', 'size' => 6, 'code' => "half_column"),
				array('name' => '2/3', 'size' => 8, 'code' => 'two_thirds_column'),
			),
			array(
				array('name' => '3/4', 'size' => 9, 'code' => 'three_quarters_column'),
				array('name' => '5/6', 'size' => 10, 'code' => 'five_sixth_column'),
			),
			array(
				array('name' => 'Full', 'size' => 12, 'code' => 'full_column'),
			)
		);

		$sizesHtml = '';

		foreach ($sizes as $container => $sz) {
			$sizesHtml .= '<div class="clearfix">';
			foreach ($sz as $data) {
				$sizesHtml .= '<div data-name="' . $data['name'] . '" data-code="' . $data['code'] . '" class="accept mbox size' . $data['size'] . ' size" data-size="' . $data['size'] . '" style="width:' . ((int)$data['size'] * 20) . 'px"><span>' . $data['name'] . '</span><span class="close"></span></div>';
			}
			$sizesHtml .= '</div>';
		}

		$placeholder = __('Drag columns here', 'ct_theme');

		$title = __("Drag column to arrange layout", 'ct_theme');

		$contentPre = '
		<style>
	body {
				background: #fff;
			}

			.clearfix {
			  *zoom: 1;
			}

			.clearfix:before,
			.clearfix:after {
			  display: table;
			  line-height: 0;
			  content: "";
			}

			.clearfix:after {
			  clear: both;
			}

			.mbox {
				background: #fdfdfd; /* Old browsers */
				background: -moz-linear-gradient(top,  #fdfdfd 0%, #fbfbfb 100%); /* FF3.6+ */
				background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#fdfdfd), color-stop(100%,#fbfbfb)); /* Chrome,Safari4+ */
				background: -webkit-linear-gradient(top,  #fdfdfd 0%,#fbfbfb 100%); /* Chrome10+,Safari5.1+ */
				background: -o-linear-gradient(top,  #fdfdfd 0%,#fbfbfb 100%); /* Opera 11.10+ */
				background: -ms-linear-gradient(top,  #fdfdfd 0%,#fbfbfb 100%); /* IE10+ */
				background: linear-gradient(to bottom,  #fdfdfd 0%,#fbfbfb 100%); /* W3C */
				filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="#fdfdfd", endColorstr="#fbfbfb",GradientType=0 ); /* IE6-9 */

				border: 1px solid #f2f2f2;

				color: #adadad;

				cursor: default;

				height: 33px;
				width: 172px;
				padding: 0 7px 0 7px;
				float:left;

				font-family: "Arial", "Helvetica", sans-serif;
				font-size: 12px;
				font-style: normal;
				line-height: 33px;
				text-align: center;
				text-decoration: none;

				margin: 10px;

			}

			.mbox.accept {
				background: #f9f9f9; /* Old browsers */
				background: -moz-linear-gradient(top,  #f9f9f9 0%, #f5f5f5 100%); /* FF3.6+ */
				background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#f9f9f9), color-stop(100%,#f5f5f5)); /* Chrome,Safari4+ */
				background: -webkit-linear-gradient(top,  #f9f9f9 0%,#f5f5f5 100%); /* Chrome10+,Safari5.1+ */
				background: -o-linear-gradient(top,  #f9f9f9 0%,#f5f5f5 100%); /* Opera 11.10+ */
				background: -ms-linear-gradient(top,  #f9f9f9 0%,#f5f5f5 100%); /* IE10+ */
				background: linear-gradient(to bottom,  #f9f9f9 0%,#f5f5f5 100%); /* W3C */
				filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="#f9f9f9", endColorstr="#f5f5f5",GradientType=0 ); /* IE6-9 */

				-webkit-box-shadow: inset 0px 1px 0px 0px #fff;
				box-shadow: inset 0px 1px 0px 0px #fff;

				border: 1px solid #dfdfdf;
				-webkit-border-radius: 3px;
				border-radius: 3px;

				color: #333;
				cursor: move;
			}

			.mbox.row {
				min-height:52px;
				width:375px;
				cursor:default;
				margin-top:50px;
				padding-top:10px;
				float:none;
			}
			.placeholder {
				font-size:20px;
				color:#aaaaaa;
				margin-top:3px;
			}


			.close {
				display:none;
				float:right;

				width:9px;
				height:21px;
				cursor:pointer;
				background: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAkAAAAJCAYAAADgkQYQAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAEVJREFUeNp0TYEJADAIMv//p/O2GGNUyyBKUzN3R9SKNvx1eN4FaaLhxZYwGU4ShPDx7MSEKRIKpnqReQpBEVIcimELMABcUBE3zxJptwAAAABJRU5ErkJggg==") no-repeat bottom center;

			}
			.row .close {display:inline-block;}
			.close:hover {
				background-image: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAkAAAAJCAYAAADgkQYQAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAEVJREFUeNp0TYEJADAIMn/s/1O2GGNUyyBKUzN3R9SKNvx1eN4FaaLhxZYwGU4ShPDx7MSEKRIKpnqReQpBEVIcimELMADgEBARXjTDjQAAAABJRU5ErkJggg==");
			}

			.row .mbox {margin: 3px; cursor:default}
		</style>
	<h3>'.$title.'</h3>
		<div id="sizes">
			'.$sizesHtml.'
		</div>

		<div id="row" class="row accept clearfix mbox">
			<div class="placeholder">'.$placeholder.'</div>
		</div>

	<input type="hidden" id="shortcode" name="shortcode" value=""/>
';

		$decorator = false;
		$child = null;
		$shortcode = $this;
		ob_end_flush();
		ob_start();
		require_once $params['template'];
		$s = ob_get_contents();
		ob_end_clean();
		return $s;
	}
}

new ctColumnGeneratorShortcode();