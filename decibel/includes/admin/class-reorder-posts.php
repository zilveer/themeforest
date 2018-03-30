<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'Wolf_Reorder_Posts' ) ) {
	/**
	 * Main Wolf_Reorder_Post Class
	 *
	 * Allow user to re-order some CPT without worring about the published date
	 *
	 * @class Wolf_Reorder_Post
	 * @since 1.0.0
	 * @package Aku
	 * @author WolfThemes
	 */
	class Wolf_Reorder_Posts {

		/**
		 * @var array
		 */
		public $post_types = array();

		/**
		 * Wolf_Reorder_Post Constructor.
		 */
		public function __construct( $post_types = array() ) {

			$this->post_types = $post_types + $this->post_types;

			// Sub menus
			add_action( 'admin_menu', array( $this, 'add_sub_menu' ) );

			// add script in admin head
			add_action( 'admin_head', array( $this, 'add_script' ) );

			// save post hook
			add_action( 'save_post', array( $this, 'save_post' ) );

			$this->save_order();
		}

		/**
		 * Enqueue admin scripts
		 */
		public function add_script() {
			foreach ( $this->post_types as $post_type ) {
				if ( isset( $_GET['post_type'] ) && $post_type == $_GET['post_type'] ) {
					?>
					<style type="text/css">
						.state-highlight { height: 52px; width:414px; margin: 9px 0 0; border: 2px dashed #ccc; }
					</style>
					<script type="text/javascript">
					jQuery( function( $ ) {
						$( '#sortable' ).sortable( {
							placeholder: 'state-highlight',
							opacity : 0.6,
							accept : 'state-default',
							update: function(){
								serial = $( '#sortable' ).sortable( 'serialize' );
								$.ajax({
									url: '<?php echo admin_url("edit.php?post_type=$post_type&page=$post_type-reorder"); ?>',
									type: 'post',
									data: serial,
									complete: function( data ) {
										console.log( data );
									}
								} );
							}
						} );
						$( '#sortable' ).disableSelection();
					} );
					</script>
					<?php
				}
			}
		}

		/**
		 * Initiate an original postion for already existing post without postion meta
		 */
		public function init_position( $post_type ) {

			if ( ! get_option( '_positions_are_set_for_' . $post_type ) ) {
				$args = array(
					'post_type' => $post_type,
					'post_per_pages' => -1,
				);

				$loop = new WP_Query( $args );

				if ( $loop->have_posts() ) {

					while ( $loop->have_posts() ) {
						$loop->the_post();
						if ( ! get_post_meta( get_the_ID(), '_position', true ) ) {
							add_post_meta( get_the_ID(), '_position', 0 );
						}
					}
					add_option( '_positions_are_set_for_' . $post_type, true );
				}
				wp_reset_postdata();
			}
		}

		/**
		 * Set a default postition meta on post save
		 */
		public function save_post( $post_id ) {
			global $post;

			// check autosave
			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
				return $post_id;

			// check permissions
			if ( isset( $_POST['post_type'] ) && is_object( $post ) ) {

				$current_post_type = get_post_type( $post->ID );

				if ( 'page' == $_POST['post_type'] ) {
					if ( ! current_user_can( 'edit_page', $post_id ) ) {
						return $post_id;

					} elseif ( ! current_user_can( 'edit_post', $post_id ) ) {
						return $post_id;
					}
				}

				if ( in_array( $current_post_type, $this->post_types ) ) {
					if ( ! get_post_meta( $post_id, '_position', true ) )
						add_post_meta( $post_id, '_position', -1 );
				}
			}
		}

		/**
		 * Save order
		 */
		public function save_order() {
			// Re-order post by drag & drop (jquery-ui sortable)
			if ( isset( $_POST['sortable'] ) ) {
				$sortlist = $_POST['sortable'];
				/*
				* $k = position
				* $v = id
				*/
				$count = count( $sortlist );
				foreach ( $sortlist as $k => $v ) {
					// $position= $count - ( $k + 1 );
					$position = $k;
					$id = $v;
					update_post_meta( $id, '_position', $position );
				}
			}
		}

		/**
		 * Add sub menu items
		 */
		public function add_sub_menu() {

			foreach ( $this->post_types as $post_type ) {
				if ( post_type_exists( $post_type ) ) {
					add_submenu_page( 'edit.php?post_type=' . $post_type . '', __( 'Re-Order', 'wolf' ), __( 'Re-Order', 'wolf' ), 'edit_plugins', $post_type . '-reorder', array( $this, 'panel' ) );
				}
			}
		}

		/**
		 * Panel
		 */
		public function panel() {

			foreach ( $this->post_types as $post_type ) {
				if ( isset( $_GET['post_type'] ) && $post_type == $_GET['post_type'] ) {

					$this->init_position( $post_type );

					$args = array(
						'post_type' 		=> $post_type,
						'order'			=> 'ASC',
						'meta_key'		=> '_position',
						'orderby'		=> 'meta_value_num',
						'posts_per_page'	=> -1
					);

					$loop = new WP_Query( $args );

					if ( $loop->have_posts() ) {

						echo '<h2>';
						_e( 'Re-Order', 'wolf' );
						echo '</h2>';

						echo '<ul id="sortable" class="menu ui-sortable">';

						while ( $loop->have_posts() ) {
							$loop->the_post();
							$position = get_post_meta( get_the_ID(), '_position', true );

							echo '<li class="menu-item" id="sortable_' . get_the_ID() . '">';
							echo '<dl class="menu-item-bar"><dt class="menu-item-handle">';
							// debug( $position ) . ' ';
							echo get_the_title();
							echo '</dl></dt></li>';

						} // endwhile

						echo '</ul>';

					} // end if have posts
					wp_reset_postdata();
				}
			}
		}
	}
}

$post_types_to_reorder = array( 'work', 'video', 'gallery', 'slide', 'demo', 'plugin' );
$wolf_do_reorder_posts = new Wolf_Reorder_Posts( $post_types_to_reorder );
