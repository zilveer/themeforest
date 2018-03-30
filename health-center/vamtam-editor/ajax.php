<?php

class WPV_Editor_AJAX {
	public function __construct() {
		$actions = array('markup', 'config', 'get_slide_html', 'init_html');
		foreach ($actions as $name) {
			add_action("wp_ajax_wpv_editor_$name", array(&$this, $name));
		}

		$this->special_markup_list = apply_filters('wpv_editor_special_markup_list', array('accordion', 'tabs', 'services_expandable'));
	}

	public function markup() {
		$id = (isset($_POST['element'])) ? $_POST['element'] : '';

		if(!empty($id))
			echo $this->markup_handler($id);

		exit;
	}

	private function get_uniqid_suffix() {
		return str_replace('.', '-', uniqid('', true)).'-'.mt_rand();
	}

	private function get_uniqid($id) {
		return 'wpved-'.$id.'-'.$this->get_uniqid_suffix();
	}

	private function markup_handler($id, $attributes=null, $content='') {
		global $wpv_sc;

		$accepted = '';

		if(!is_null($attributes)) {
			if($id == 'column') {
				$accepted = $content;
				$id .= '-'.str_replace('/', '', $attributes['width']);
			} else {
				if(isset($wpv_sc[$id]["accepting"]) && $wpv_sc[$id]["accepting"]) {
					$accepted = $content;
				} else {
					if(in_array($id, $this->special_markup_list)) {
						$accepted = $this->get_special_markup($id, $content);
					} else {
						$attributes['html-content'] = $content;
					}
				}
			}
		}

		ob_start();

		if(strpos($id, 'column') === 0):
		?>
			<div id="<?php echo esc_attr($this->get_uniqid($id)) ?>" class="wpv_ed_column wpv_sortable inner-sortable column column-<?php echo preg_replace('/column-(\d)(\d)/', '$1-$2', $id) ?> expandable" data-basename="column">
				<?php echo $this->getControls('size name add edit clone delete handle', preg_replace('/column-(\d)(\d)/', '$1/$2', $id), __('Column', 'health-center'), $attributes) ?>
				<?php echo $this->loopShortcodeParameters('column', $attributes) ?>
				<?php echo $accepted ?>
			</div>
		<?php else: ?>

			<?php
				$controls = isset($wpv_sc[$id]['controls']) ? $wpv_sc[$id]['controls'] : 'name delete';
				$class = isset($wpv_sc[$id]["class"]) ? $wpv_sc[$id]["class"] : '';

				$accepting = isset($wpv_sc[$id]["accepting"]) && $wpv_sc[$id]["accepting"] ? 'inner-sortable' : '';
				$size = isset($attributes['column_width']) ? $attributes['column_width'] : '1/1';
				$size_class = 'column-'.str_replace('/', '-', $size);

				$expandable = strpos($controls, 'handle') !== false ? 'expandable' : 'non-expandable';

				if(strpos($controls, 'always-expanded'))
					$expandable = 'expandable expanded';
			?>

			<div id="<?php echo esc_attr($this->get_uniqid($id)) ?>" class="wpved-<?php echo "$id $accepting $class"; ?> wpv_sortable column <?php echo "$size_class $expandable"?>" <?php echo $this->getCallbacks($id) ?> data-basename="<?php echo $id ?>">
				<?php echo $this->getControls($controls, $size, $wpv_sc[$id]['name'], $attributes) ?>
				<?php echo $this->loopShortcodeParameters($id, $attributes) ?>
				<?php echo $accepted ?>
			</div>
		<?php
		endif;

		return ob_get_clean();
	}

	private function getControls($controls, $size_str, $name='', $atts = array()) {
		$output = '<div class="controls">';

		$orig_name = $name;
		if ( isset( $atts['column_title'] ) ) {
			if ( !empty( $atts['column_title'] ) && $atts['column_title'] !== 'undefined' ) {
				$name = $atts['column_title'];
			}
		} elseif ( isset( $atts['title'] ) && ! empty( $atts['title'] ) && $atts['title'] !== 'undefined' ) {
			$name = $atts['title'];
		}  elseif ( isset( $atts['name'] ) && ! empty( $atts['name'] ) && $atts['name'] !== 'undefined' ) {
			$name = $atts['name'];
		}
		$name = strip_tags( $name );

		$controls_html = array(
			'name' => "<span class='column-name' data-orig-title='".esc_attr($orig_name)."'>$name</span>",
			'size' => "<div class='column-size-wrapper'>
							<div class='column-increase-decrease'><a class='column-increase icon-plus' href='#' title='".__('Increase width', 'health-center')."'></a> <a class='column-decrease icon-minus' href='#' title='".__('Decrease width', 'health-center')."'></a></div>
							<span class='column-size'>$size_str</span>
						</div>",
			// 'add' => " <a class='column-add icon-plus' href='#' title='".__('Insert element', 'health-center')."'></a> ",
			'clone' => " <a class='column-clone icon-copy' href='#' title='".__('Clone', 'health-center')."'></a> ",
			'edit' => ' <a class="column-edit icon-edit" href="#" title="'.__('Edit shortcode properties', 'health-center').'"></a>',
			'delete' => ' <a class="column-remove icon-remove" href="#" title="'.__('Remove shortcode', 'health-center').'"></a>',
			'handle' => '<div class="handlediv" title="'.__('Click to toggle', 'health-center').'"><br /></div>',
		);

		if($controls == 'full')
			$controls = 'size edit delete';

		$controls = explode(' ', $controls);
		foreach ($controls as $c) {
			if(isset($controls_html[$c]))
				$output .= $controls_html[$c];
		}

		$output .= '</div>';

		return $output;
	}

	private function getCallbacks($id) {
		global $wpv_sc;
		$output = '';

		if(isset($wpv_sc[$id]['callbacks']))
			$output = esc_attr(json_encode($wpv_sc[$id]['callbacks']));

		return "data-callbacks='$output'";
	}

	private function loopShortcodeParameters($id, $attributes) {
		global $wpv_sc;
		$output = '';

		if (isset($wpv_sc[$id]['options'])) {
			foreach ($wpv_sc[$id]['options'] as $param) {
				if($param['type'] == 'select-row') {
					foreach($param['selects'] as $sid=>$s) {
						$value = isset($attributes[$sid]) ? $attributes[$sid] : null;
						$s['type'] = 'select';
						$s['id'] = $sid;
						$output .= $this->formatParam($s, $value);
					}
				} elseif($param['type'] == 'range-row') {
					foreach($param['ranges'] as $sid=>$s) {
						$value = isset($attributes[$sid]) ? $attributes[$sid] : null;
						$s['type'] = 'range';
						$s['id'] = $sid;
						$output .= $this->formatParam($s, $value);
					}
				} elseif($param['type'] == 'color-row') {
					foreach($param['inputs'] as $sid=>$s) {
						$value = isset($attributes[$sid]) ? $attributes[$sid] : null;
						$s['type'] = 'color';
						$s['id'] = $sid;
						$output .= $this->formatParam($s, $value);
					}
				} elseif($param['type'] == 'background') {
					$opts = explode(',', $param['only']);
					$opt_types = array(
						'color' => 'color',
						'opacity' => 'range',
						'image' => 'upload',
						'repeat' => 'select',
						'attachment' => 'select',
						'position' => 'select',
						'size' => 'toggle',
					);

					foreach ($opts as $opt_name) {
						$oid = $param['id'].'_'.$opt_name;
						$value = isset($attributes[$oid]) ? $attributes[$oid] : null;
						$default = ($opt_name == 'size') ? 'auto' : '';

						$output .= $this->formatParam(array(
							'id' => $oid,
							'type' => $opt_types[$opt_name],
							'default' => $default,
						), $value);
					}
				} elseif(isset($param['id'])) {
					$value = isset($attributes[$param['id']]) ? $attributes[$param['id']] : null;
					$output .= $this->formatParam($param, $value);
				}
			}
		}
		return $output;
	}

	private function formatParam($param, $value) {
		extract($param);

		if(is_null($value))
			$value = isset($default) ? $default : '';

		$class = isset($class) ? $class : '';
		$placeholder = isset($placeholder) ? $placeholder : (isset($name) ? $name : '');

		if ( is_array( $value ) ) {
			$value = json_encode( $value );
		}

		if ( isset( $type ) ) {
			$attr = "class='wpv-ed-param-holder $id $type $class' data-name='$id'";

			if(!isset($holder) || $holder == 'hidden')
				return "<input type='hidden' $attr value='".esc_attr($value)."' />";

			if($holder == 'img')
				return "<img src='".esc_attr($value)."' $attr placeholder='$placeholder' />";

			if($holder != 'textarea') {
				$value = wpautop( $value );
			}

			return "<$holder $attr placeholder='$placeholder'>$value</$holder>";
		}
	}

	private function get_special_markup($id, $content) {
		$result = apply_filters('wpv_editor_get_special_markup', $content, $id);

		if($result !== $content)
			return $result;

		ob_start();

		switch($id) {
			case 'accordion':
				if(!wpv_sub_shortcode('pane', $content, $params, $sub_contents))
					return $content;

				echo '<div class="wpv_accordion">';

				foreach($sub_contents as $i=>$text): ?>

					<div>
						<h3 class="title-wrapper clearfix">
							<a class="accordion-title"><?php echo $params[$i]['title'] ?></a>
							<a class="accordion-remove icon-remove" title="<?php _e('Remove', 'health-center') ?>"></a>
							<a class="accordion-clone icon-copy" title="<?php _e('Clone', 'health-center') ?>"></a>
							<a class="accordion-background-selector" data-background-image="<?php if ( isset( $params[$i]['background_image'] ) ) echo esc_attr($params[$i]['background_image']) ?>" title="<?php esc_attr_e('Change Pane Background', 'health-center') ?>"><?php wpv_icon('image') ?></a>
						</h3>
						<div class="pane clearfix inner-sortable"><?php echo $this->do_parse($text) ?></div>
					</div>

				<?php endforeach;

				echo '<div><h3><a class="accordion-add icon-plus"></a></h3></div>';
				echo '</div>';
			break;

			case 'tabs':
				if(!wpv_sub_shortcode('tab', $content, $params, $sub_contents))
					return $content;

				$suffix = 'tabs-' . $this->get_uniqid_suffix();

				echo '<div class="wpv_tabs"><ul>';

				foreach($params as $i=>$pi):
					$p = shortcode_atts(array(
						'title' => '',
						'icon' => '',
					), $pi);
				?>
					<li>
						<a href="#tabs-<?php echo $suffix.$i ?>" class="tab-title"><?php echo $p['title'] ?></a>
						<a class="tab-remove icon-remove" title="<?php esc_attr_e('Remove', 'health-center') ?>"></a>
						<a class="tab-clone icon-copy" title="<?php esc_attr_e('Clone', 'health-center') ?>"></a>
						<a class="tab-icon-selector <?php echo wpv_get_icon_type($p['icon']) ?> <?php if(empty($p['icon'])) echo 'no-icon' ?>" data-icon-name="<?php echo $p['icon'] ?>" title="<?php esc_attr_e('Change Icon', 'health-center') ?>"><?php wpv_icon($p['icon']) ?></a>
					</li>
				<?php endforeach;
				echo '<li class="ui-state-default"><a class="tab-add icon-plus"></a></li>';
				echo '</ul>';

				foreach($sub_contents as $i=>$text): ?>
					<div id="tabs-<?php echo $suffix.$i ?>" class="clearfix inner-sortable"><?php echo $this->do_parse($text) ?></div>
				<?php endforeach;

				echo '</div>';
			break;

			case 'services_expandable':
				echo "<textarea class='inner-content'>$content</textarea>";
			break;

			default:
				echo $content;
		}

		return ob_get_clean();
	}

	public function config() {
		global $wpv_sc;

		include_once 'config-generator.php';

		$id = (isset($_POST['element'])) ? $_POST['element'] : '';

		WPV_Editor_Shortcode_Config::setConfig($wpv_sc[$id])->render();

		exit;
	}

	public function get_slide_html() {
		$id = $this->get_uniqid_suffix();
		$value = array('static' => false);

		include WPV_ADMIN_HELPERS . 'config_generator/slide.php';

		exit;
	}

	public function init_html() {
		echo $this->do_parse($_POST['content']);

		exit;
	}

	private function do_parse($content) {
		global $wpv_sc;

		require_once 'parser.php';

		$content = stripslashes($content);

		$content = wpv_fix_shortcodes($content);

		try {
			$parser = new WPV_Editor_Parser($content, $wpv_sc);
			$tree = $parser->parse();

			return $this->html_from_tree_node($tree);
		} catch (Exception $e) {
			return '<span style="font: 14px / 18px sans-serif;">'.$e->getMessage().'</span>';
		}
	}

	private function html_from_tree_node($tree) {
		global $wpv_sc;

		$result = '';

		$column_atts = array('width', 'title', 'divider', 'title_type', 'animation');

		foreach($tree->children as $node) {
			$content = $node->content;
			$implicit_column = ($node->type === 'column' &&
								(isset($node->atts['implicit']) && $node->atts['implicit'] === 'true') &&
								count($node->children) <= 1);

			if( $node->type == 'ROOT' ||
				$node->type === 'column' ||
				( isset($wpv_sc[$node->type]['accepting']) && $wpv_sc[$node->type]['accepting'] )
			  ) {

				if($implicit_column) {
					foreach($node->children as $inner_node) {
						foreach($column_atts as $catt) {
							if(isset($node->atts[$catt]))
								$inner_node->atts['column_'.$catt] = $node->atts[$catt];
						}
					}
				}

				$content = $this->html_from_tree_node($node);
			}

			$result .= $implicit_column ? $content : $this->markup_handler($node->type, $node->atts, $content);
		}

		return $result;
	}
};

new WPV_Editor_AJAX();
