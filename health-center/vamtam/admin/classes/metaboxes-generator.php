<?php

/**
 * A wrapper for config_generator that is used to generate general-purpose metaboxes
 *
 * @package wpv
 */

/**
 * class WpvMetaboxesGenerator
 */
class WpvMetaboxesGenerator extends WpvConfigGenerator {
	/**
	 * Metabox display config
	 * @var array
	 */
	private $config;

	/**
	 * Metaboxes options list
	 * @var array
	 */
	protected $options;

	/**
	 * Hook into the releavant actions
	 *
	 * @param array $config  metabox display config
	 * @param array $options metabox options list
	 */
	public function __construct( $config, $options ) {
		$this->config  = $config;
		$this->options = $options;

		if ( ! isset( $this->options['ondemand'] ) || $this->options['ondemand'] == false ) {
			switch ( current_filter() ) {
				case 'add_meta_boxes':
					$this->create();
				break;
				case 'save_post':
					$this->save( $this->config['post_id'] );
				break;
			}
		}
	}

	/**
	 * Registers the metabox
	 */
	protected function create() {
		if ( function_exists( 'add_meta_box' ) ) {
			if ( ! empty( $this->config['callback'] ) && function_exists( $this->config['callback'] ) )
				$callback = $this->config['callback'];
			else
				$callback = array( &$this, 'render' );

			foreach ( $this->config['pages'] as $page ) {
				add_meta_box( $this->config['id'], $this->config['title'], $callback, $page, $this->config['context'], $this->config['priority'] );
			}
		}
	}

	/**
	 * Saves the post metadata
	 * @param  int $post_id  current post id
	 * @return int           current post id
	 */
	protected function save( $post_id ) {
		if ( ! isset( $_POST[$this->config['id'] . '_noncename'] ) )
			return $post_id;

		if ( ! wp_verify_nonce( $_POST[$this->config['id'] . '_noncename'], plugin_basename( __FILE__ ) ) )
			return $post_id;

		if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] && ! current_user_can( 'edit_page', $post_id ) )
				return $post_id;

		elseif ( ! current_user_can( 'edit_post', $post_id ) )
				return $post_id;

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return $post_id;

		foreach ( $this->options as $option ) {
			if ( isset( $option['id'] ) && ! empty( $option['id'] ) ) {
				if ( ! isset( $option['only'] ) ||
					$option['only'] == $_POST['post_type'] ||
					in_array( $_POST['post_type'], explode( ',', $option['only'] ) ) ) {
					if ( $option['type'] == 'background' || $option['type'] == 'font' ) {
						$suboptions = array(
							'font' => array(
								'size',
								'lheight',
								'face',
								'weight',
								'color',
							),
							'background' => array(
								'image',
								'color',
								'position',
								'attachment',
								'repeat',
								'size',
							),
						);

						foreach ( $suboptions[$option['type']] as $opt ) {
							$name = $option['id'].'-'.$opt;
							if ( isset( $_POST[$name] ) ) {
								update_post_meta( $post_id, $name, $_POST[$name] );
							} else {
								delete_post_meta( $post_id, $name, get_post_meta( $post_id, $name, true ) );
							}
						}
					} else {
						if ( isset( $_POST[$option['id']] ) ) {
							if ( $option['type'] == 'multiselect' )
								$value = serialize( array_unique( $_POST[$option['id']] ) );
							else
								$value = $_POST[$option['id']];

						} elseif ( $option['type'] == 'toggle' ) {
							$value = 'false';
						} else {
							$value = false;
						}

						if ( $value != '' ) {
							update_post_meta( $post_id, $option['id'], $value );
						} else {
							delete_post_meta( $post_id, $option['id'], get_post_meta( $post_id, $option['id'], true ) );
						}
					}
				}
			} elseif ( $option['type'] == 'select-row' ) {
				foreach ( $option['selects'] as $id => $name ) {
					update_post_meta( $post_id, $id, $_POST[$id] );
				}
			}
		}
	}

	/**
	 * Renders the metabox
	 */
	public function render() {
		global $post, $wpv_in_metabox;
		$wpv_in_metabox = true;

		echo '<div class="wpv-config-group metabox">';

		echo '<input type="hidden" name="' . $this->config['id'] . '_noncename" id="' . $this->config['id'] . '_noncename" value="' . wp_create_nonce( plugin_basename( __FILE__ ) ) . '" />';

		foreach ( $this->options as $option ) {
			if ( ! isset( $option['only'] ) ||
				$option['only'] == $post->post_type ||
				in_array( $post->post_type, explode( ',', $option['only'] ) ) ) {

				if ( isset( $option['id'] ) ) {
					$default = get_post_meta( $post->ID, $option['id'], true );
					if ( $default != '' ) {
						$option['default'] = $default;
					}
				}

				if ( method_exists( $this, $option['type'] ) ) {
					$this->$option['type']( $option );
				} else {
					$this->tpl( $option['type'], $option );
				}
			}
		}

		$wpv_in_metabox = false;

		echo '</div>';
	}

}
