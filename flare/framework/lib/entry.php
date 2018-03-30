<?php
/**
 * This file is part of the BTP_Framework package.
 *
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 * 
 * Table of contents: 
 *
 * 1. class BTP_Entry_Option_Holder
 * 2. Public API for the global Entry Option Holder
 * 3. Entry renderers
 * 4. Add standard entry options
 * 
 * @author 			bringthepixel <bringthepixel@gmail.com>
 * @package			BTP_FRAMEWORK
 * @subpackage		BTP_ENTRY 
 */



/* Prevent direct script access */
if ( !defined( 'BTP_FRAMEWORK_VERSION' ) ) exit( 'No direct script access allowed' );



/* ------------------------------------------------------------------------- */
/* ---------->>> ENTRY OPTION HOLDER <<<------------------------------------ */
/* ------------------------------------------------------------------------- */



/**
* Entry option holder
* 
* Organizes entry options using a two-levels hierarchy ( subgroups inside groups ).
* Each group represents individual metabox.
*/
class BTP_Entry_Option_Holder extends BTP_Option_Holder {
	
	/**
	 * Contructor
	 */	
	public function __construct() {
		parent::__construct();
		
		/* Set default configuration of an option */
		$this->set_base_item( array(	
			'apply'				=> array(),
			'apply_callback'	=> null,
			'view'				=> 'String',
			'model'				=> 'Array',
			'prefix'			=> '_btp'
		));
	}
	
	
	
	/**
	 * Gets the scope of this option holder
	 */
	public function get_scope() { return 'entry'; }

	
	
	/**
	 * Inits the holder, adds hooks
	 */
	public function init(){
		$this->sort();		
		
		/* For every option group create a metabox */
		foreach( $this->hierarchy as $group_id => $group ) {			
			/* Watch for dynamic function names - these will be resolved with the magical function __call() */
			add_action( 'admin_menu', array( $this, 'add_meta_box_' . $group_id  ) );
	 		add_action( 'save_post', array( $this, 'update_group_wrapper_' . $group_id ) );
 		}
	}

	
	
	/**
	 * Adds meta box for every option group
	 * 
	 * @param 			string $group_id
	 */
	public function add_meta_box( $group_id ) {
		/* Get appliable post types */
		$apply = $this->get_apply_set( $group_id );
		
		/* For every post type create a metabox */
		foreach ( $apply as $k => $v ) {
	    	add_meta_box(
		    	'btp_meta_box_'.$group_id, 									//id
		    	$this->hierarchy[ $group_id ][ 'args' ][ 'label' ],			//title
		    	array( $this, 'render_group_wrapper'),					 	//callback function 
		    	$k, 														//page
		       	'normal', 													//context 
		    	'high', 													//priority
		    	array( 'group_id' => $group_id)								//callback arguments
	    	);
		}	
	}		
	
	
	
	/**
	 * Captures group as a metabox
	 * 
	 * @param 			object $post
	 * @param 			array $metabox
	 * @return			string
	 */
	public function capture_group_wrapper( $post, $metabox ) {
		$out = '';
		
		/* Sort before capturing */
		$this->sort();
		
		$group_id = $metabox[ 'args' ][ 'group_id' ];
		$group =& $this->hierarchy[ $group_id ];		
		
		$out .= '<div class="btp-option-group">';
			$out .= '<div class="btp-option-group-content">';
				/* Secure the form with nonce field */
				$out .= wp_nonce_field( 'btp_' . $group_id, 'btp_' . $group_id . '_nonce', false );
				
				/* An array of used option models */
				$models = array();
				
				foreach( $group[ 'subgroups' ] as $subgroup_id => &$subgroup ) {
 					$out .= '<div class="btp-option-subgroup">';
 					
 					/* Capture subgroup labels only if there are more than 2 subgroups */
	           		if ( count( $group[ 'subgroups' ] ) > 1 ) {
						$out .= '<div class="btp-option-subgroup-title">';		            
	            			$out .= '<h3>' . $subgroup[ 'args'][ 'label' ] . '</h3>';
	        			$out .= '</div>';
	           		}
           		
	           			$out .= '<div class="btp-option-subgroup-content">';
							foreach( $subgroup['items'] as $item_id => $item ) {
								/* Get the option object from the holder */
								$option = $this->get_item( $item_id );
								
								/* Ommit the process if the model isn't defined */
								if ( !strlen( $option[ 'view' ] ) ) {					
									continue;
								}	
								
								/* Ommit the process if the option isn't appliable */
								if ( !array_key_exists( $post->post_type, array_filter( $option[ 'apply' ] ) ) ) {
									continue;
								}
																
					        	$value = null;

					        	if ( strlen( $option['model'] ) ) {
						        	/* Use default values for a new post */
									global $submenu_file;								
									if ( strlen( $submenu_file ) && 0 === strpos( $submenu_file, 'post-new.php' ) ) {
										$value = isset ( $option[ 'default' ] ) ? $option[ 'default' ] : $value;								
									}							
								
									$model_class = 'BTP_Option_Model_' . $option[ 'model' ];													
									/* Create each option model once */ 
									if( !isset( $models[ $model_class ] ) ) {
										$models[ $model_class ] = new $model_class( $this->get_scope(), $post->ID );
									}									
									
									$value = $models[ $model_class ]->select( $option );
					        	}								
					        	
								/* Render value by using the View Layer */
        						$view_class = 'BTP_Option_View_' . $option[ 'view' ];
						    	$view = new $view_class(
						           $option->id,
						           $option->config,							
						           $value 		
						        );
						            
						        $out .= $view->capture();
					    	}	           			
						$out .= '</div>';
					$out .= '</div><!-- .btp-option-subgroup -->';
				}
				/* Break the reference with the last element. */
				/* See http://php.net/manual/en/control-structures.foreach.php */
				unset( $subgroup );
            		
        	$out .= '</div>';
        $out .= '</div><!-- .btp-option-group -->';
         
        unset( $group );
        
        return $out;
	}
	public function render_group_wrapper( $post, $metabox ) {
		echo $this->capture_group_wrapper( $post, $metabox );
	}	
	

	
	
	/**
	 * Updates group 
	 * 
	 * @param 			integer $post_id
	 * @param 			string $group_id
	 */
	function update_group_wrapper( $post_id, $group_id ) {
		/* Don't save data automatically via autosave feature */
		if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
	        return $post_id;
		}    
		
	     /* Don't save data when using Quick Edit */	
	    if ( isset( $_POST['_inline_edit'] ) ) {		    
	    	return $post_id;    
	    }	
		
		$post_type = null;
		if ( isset( $_POST[ 'post_type' ] ) ) { 
			$post_type = $_POST[ 'post_type' ];
		}

		/* Update options only if they are appliable */
		if( !array_key_exists( $post_type, $this->get_apply_set( $group_id ) ) ) {
			return $post_id;	
		}	
	    	
	    /* Check permissions */
	    if ( 'page' == $post_type ) {
	       if ( !current_user_can( 'edit_page', $post_id ) ) {
	            return $post_id;
	        }
	    } elseif ( !current_user_can( 'edit_post', $post_id ) ) {
	        return $post_id;
	    }
	    
		/* Verify nonce */
	    if ( !isset($_POST['btp_' . $group_id . '_nonce']) || !check_admin_referer( 'btp_' . $group_id, 'btp_' . $group_id . '_nonce' ) ) {
	    	return $post_id;
	    }
	    	
	    $group =& $this->hierarchy[ $group_id ];
	    
	    /* An array of used option models */
	    $models = array();	
	   
		foreach( $group['subgroups'] as $subgroup_id => &$subgroup ) {		
			foreach( $subgroup[ 'items' ] as $item_id => $item ) {
				$option = $this->get_item( $item_id );
				
				/* Ommit the process if the model isn't defined */
				if ( !strlen( $option[ 'model' ] ) ) {					
					continue;
				}	
				
				/* Ommit the process if the option isn't appliable */
				if ( !array_key_exists( $post_type, array_filter( $option[ 'apply' ] ) ) ) {
					continue;
				}							
				
				$model_class = 'BTP_Option_Model_' . $option[ 'model' ];													
				/* Create each option model once */ 
				if( !isset( $models[ $model_class ] ) ) {
					$models[ $model_class ] = new $model_class( $this->get_scope(), $post_id );
				}	
		
				/* Start update process */
				$models[ $model_class ]->update( $option );
			}					
		}
		/* Break the reference with the last element. */
		/* See http://php.net/manual/en/control-structures.foreach.php */
		unset( $subgroup );
	    
	    /* End update process */
	    foreach( $models as $model ) { 
	    	$model->after_updates();
	    }
	    
	    unset( $group );
	}
	
	
	
	/**
	 * Invokes inaccessible methods
	 * 
	 * WordPress function add_action doesn't handle callback with custom argument, 
	 * like for example group_id. So this tricky function will help us.    
	 * 
	 * @param 			string $name Function name
	 * @param 			array $args Function arguments
	 */
	public function __call($name, $args ) {
		/* Check for add_meta_box_ */
		if ( strpos( $name, 'add_meta_box_') === 0 ) {			
			$group_id = substr( $name, 13 );
			
			return $this->add_meta_box( $group_id );

		/* Check for update_meta_box */	
		} elseif ( strpos( $name, 'update_group_wrapper_') === 0 ) {
			$group_id = substr( $name, 21 );
			
			return $this->update_group_wrapper( $args[0], $group_id );
		}
    }
}



/* ------------------------------------------------------------------------- */
/* ---------->>> API FOR THE GLOBAL ENTRY OPTION HOLDER <<<----------------- */
/* ------------------------------------------------------------------------- */



/* Add the global entry option holder */
global $_BTP;
$_BTP[ 'entry_option_holder' ] 	= new BTP_Entry_Option_Holder();



/**
 * Inits global entry option holder 
 */
function btp_entry_init_global_option_holder() {
	global $_BTP;	
	
	$_BTP[ 'entry_option_holder' ]->init();
}
add_action( 'init', 'btp_entry_init_global_option_holder' );



/**
 * Adds entry option group
 *
 * @param 			string $group_id 
 * @param 			array $group_args
 * @param			int $group_position   
 */
function btp_entry_add_option_group( $group_id, $group_args, $group_position ) {
	global $_BTP;
	
	$_BTP[ 'entry_option_holder' ]->add_group( $group_id, $group_args, $group_position );
}



/**
 * Adds entry option subgroup
 * 
 * @param			string $subgroup_id
 * @param			array $subgroup_args
 * @param			string $group_id
 * @param			int $subgroup_position
 */
function btp_entry_add_option_subgroup( $subgroup_id, $subgroup_args, $group_id, $subgroup_position ) {
	global $_BTP;	
	$_BTP[ 'entry_option_holder' ]->add_subgroup( $subgroup_id, $subgroup_args, $group_id, $subgroup_position );
}



/**
 * Adds entry option
 * 
 * @param			string $option_id
 * @param			array $option_args
 */
function btp_entry_add_option( $option_id, $option_args ) {
	global $_BTP;
	$_BTP[ 'entry_option_holder' ]->add_item( 
		$option_id, 
		$option_args, 
		isset ( $option_args[ 'group' ] ) ? $option_args[ 'group' ] : null, 
		isset ( $option_args[ 'subgroup' ] ) ? $option_args[ 'subgroup' ] : null,
		isset ( $option_args[ 'position' ] ) ? $option_args[ 'position' ] : null 
	);
}



/**
 * Gets entry option
 * 
 * @param			string $option_id
 * @return			array
 */
function btp_entry_get_option( $option_id ) {
	global $_BTP;
	$option = $_BTP[ 'entry_option_holder' ]->get_item( $option_id );
	
	return $option;	
}



/**
 * Gets entry option value
 * 
 * @param 			int $post_id
 * @param			string $option_id
 * @return			mixed
 */
function btp_entry_get_option_value( $post_id, $option_id ) {
	global $_BTP;
	return $_BTP[ 'entry_option_holder' ]->get_option_value( $post_id, $option_id );
}



/* ------------------------------------------------------------------------- */
/* ---------->>> ENTRY RENDERERS <<<---------------------------------------- */
/* ------------------------------------------------------------------------- */



if ( ! function_exists( 'btp_entry_capture_title' ) ) :
/**
 * Capture the HTML code with the title based on the title linking method.
 * 
 * @param			string $before
 * @param			string $after
 * @return			string
 */
function btp_entry_capture_title( $lightbox_group = '', $before = '<h3>', $after = '</h3>' ) {
	global $post;
	
	$linking = btp_entry_get_option_value( $post->ID, 'title_linking', true );
	$link = ( 'none' != $linking ) ? apply_filters( 'the_permalink', get_permalink() ) : '';

	
	$class = '';
	$title = '';
	$rel = '';	
	
	switch ( $linking ) {
		case 'none':
			break;
		
		case 'new_window':
		case 'new-window':
			$class = 'new-window';
			break;

		case 'lightbox';
			$title = the_title_attribute( 'echo=0' );
			$rel = 'prettyPhoto';
			$rel .= strlen( $lightbox_group ) ? '[' . $lightbox_group . ']' : '';
			break;	
			
		default:
			$title = the_title_attribute( 'echo=0' );
			 break;	
	}	
	
	if ( in_array( $linking, array( 'new_window', 'new-window', 'lightbox' ) ) ) {
		if ( has_post_thumbnail() ) {
			$thumb_id = get_post_thumbnail_id( $post->ID );		
			$alt_link = get_post_meta( $thumb_id, '_btp_alt_link', true );			
			if ( strlen( $alt_link ) ) {
				$link = $alt_link;
			} else {
				$link = wp_get_attachment_image_src( $thumb_id, 'full' );
				$link = $link[0];
			}
		}	
	}
	
	$out = '';
	$out .= $before;
	if ( !empty( $link ) ) {
		$out .= '<a href="' . esc_url( $link ) . '" ';
		$out .= strlen( $class ) ? 'class="' . esc_attr( $class ) . '" ' : '';
		$out .= strlen( $title ) ? 'title="' . esc_attr( $title ) . '" ' : '';
		$out .= strlen( $rel ) ? 'rel="' . esc_attr( $rel ) . '" ' : '';
		$out .= '>';
	}	
	$out .= the_title('', '', false);	
	$out .= !empty( $link ) ? '</a>' : '';
	$out .= $after;
	
	return $out;	
}
endif;
if ( ! function_exists( 'btp_entry_render_title' ) ) :
function btp_entry_render_title( $lightbox_group = '', $before = '<h3>', $after = '</h3>' ) {
	echo btp_entry_capture_title( $lightbox_group, $before, $after );
}
endif;



if ( ! function_exists( 'btp_entry_capture_featured_media' ) ) :
/**
 * Captures the HTML code with the featured media based on featured media linking method.
 * 
 * @param				string $size Image size name
 * @param				string $lightbox_group
 * @param				bool $force_placeholder
 * @return				string
 */
function btp_entry_capture_featured_media( $size, $lightbox_group = '', $force_placeholder = true ) {
	global $post;
	
	$link = '';
	$linking = '';
	$title = '';
	$holder = '';
	$placeholder = '';
	
	/* Try to return a placeholder when an entry is password protected */
	if ( post_password_required( $post ) ) {
		if ( !$force_placeholder ) {
			return '';	
		}
		
		$placeholder = '[placeholder type="password-required" size="' . $size . '"]';		
		
	/* Try to return a placeholder when there's no featured media */	
	} elseif ( !has_post_thumbnail() ) {
		if ( !$force_placeholder ) {
			return '';	
		}

		$placeholder = '[placeholder type="no-image" size="' . $size . '"]';
		
	/* Let's go with our featured media */	
	} else {
		$thumb_id = get_post_thumbnail_id( $post->ID );

			$linking = get_post_meta( $thumb_id, '_btp_alt_linking', true );
		
		$src = wp_get_attachment_image_src( $thumb_id, $size );
		$width = $src[1];
		$height = $src[2];
		$src = $src[0];
		
		$alt = '';
		
		switch ( $linking  ) {
			case 'new_window':
			case 'new-window':
			case 'lightbox':				
				$link = get_post_meta( $thumb_id, '_btp_alt_link', true );
								
				if ( empty( $link ) ) {
					$link = wp_get_attachment_image_src( $thumb_id, 'full' );
					$link = $link[0];
				}
				
				$att = get_post( $thumb_id );
				if ( $att ) {
					$alt = strip_tags( $att->post_excerpt );	
					$title = strip_tags( $att->post_content );
				}
				
				break;

            case 'none':
                $link = '';
                break;

			default:						
				$link = apply_filters( 'the_permalink', get_permalink() );				
				break;
		}

        /* Compose the template of the holder */
		$holder = '<img src="%src%" width="%width%" height="%height%" alt="%alt%" />';

		/* Fill in the template of the holder */
		$holder = str_replace(
			array(
				'%src%',
				'%width%',
				'%height%',
				'%alt%',
			),
			array(
				esc_url( $src ),
				absint( $width ),
				absint( $height ),
                !empty($alt) ? esc_attr( $alt ) : esc_url( $src ),
			),
			$holder
		);	
	}		
	
	/* Compose the template */
	$out = 	'<figure class="entry-featured-media">' . "\n" .
				'[frame link="%link%" linking="%linking%" lightbox_group="%lightbox_group%" title="%title%"]' .
					'%holder%' .
					'%placeholder%' .
				'[/frame]' .  "\n" .
			'</figure>';

	/* Fill in the template */
	$out = str_replace(
		array(
			'%link%',
			'%linking%',
			'%lightbox_group%',
			'%title%',
			'%holder%',
			'%placeholder%',
		),
		array(
			$link,
			$linking,
			$lightbox_group,
			$title,
			$holder,
			$placeholder,			
		),
		$out	
	);		

	/* Apply shortcodes */
	$out = do_shortcode( $out );
				
	return $out;
}	
endif;
if ( ! function_exists( 'btp_entry_render_featured_media' ) ) :
function btp_entry_render_featured_media( $size, $lightbox_group, $force_placeholder = true ) {
	echo btp_entry_capture_featured_media( $size, $lightbox_group, $force_placeholder );
}
endif;



if ( ! function_exists( 'btp_entry_render_mediabox' ) ) :
/**
 * Renders the HTML code with the mediabox for the current entry.
 */	
function btp_entry_render_mediabox( $size, $type = 'list' ) {
    switch ($type) {
        case 'list':
            btp_part_set_vars( array( 'size' => $size ) );
            get_template_part( 'mediabox' );
            break;

        case 'featured-media':
            btp_part_set_vars( array( 'size' => $size ) );
            get_template_part( 'mediabox', 'featured_media' );
            break;

        default:
            do_action( 'btp_mediabox', $size, $type );
    }
}
endif;



if ( ! function_exists( 'btp_entry_capture_summary' ) ) :
/**
 * Captures the HTML code with the summary for the current entry.
 */	
function btp_entry_capture_summary( $words = null, $type = 'excerpt' ) {
	global $_BTP;

	$words = absint( $words );
	
	$out = '';	
	$out .= '<div class="entry-summary">';
		if ( $words ) {
			$out .= BTP_Excerpt::capture( $words );
		} else {	
			switch ( $type ) {
                case 'excerpt':
                    $out .= apply_filters( 'the_excerpt', get_the_excerpt() );
                    break;

                case 'full':
                    $content = get_the_content();
                    $content = apply_filters('the_content', $content);
                    $content = str_replace(']]>', ']]&gt;', $content);
                    $out .= $content;
                    break;

                case 'cut-off':
                    global $post;

                    $hasMoreTag = false !== strpos($post->post_content, '<!--more-->');

                    if (!$hasMoreTag) {
                        $out .= apply_filters( 'the_excerpt', get_the_excerpt() );
                    } else {
                        $content = get_the_content('');
                        $content = apply_filters('the_content', $content);
                        $content = str_replace(']]>', ']]&gt;', $content);
                        $out .= $content;
                    }
                    break;
            }
		}
	$out .= '</div>';
	
	$_BTP[ 'excerpt_length' ] = null;


	return $out;
}
endif;
if ( ! function_exists( 'btp_entry_render_summary' ) ) :
function btp_entry_render_summary( $words = null, $type = 'excerpt' ) {
	echo btp_entry_capture_summary( $words, $type );
}
endif;



if ( ! function_exists( 'btp_entry_capture_date' ) ) :
/**
 * Captures the HTML code with the date for the current entry
 */
function btp_entry_capture_date( $d = '' ) {
   	$out = '';
   	
   	$d = !strlen( $d ) ? get_option( 'date_format' ) : $d;
   	
   	$out .= '<span class="entry-date">';
   		$out .= apply_filters( 'the_time', get_the_time( $d ), $d );
   	$out .=  '</span>';
   	
   	return $out;
}
endif;
if ( ! function_exists( 'btp_entry_render_date' ) ) :
function btp_entry_render_date( $d = '' ) {
	echo btp_entry_capture_date( $d );
}
endif;



if ( ! function_exists( 'btp_entry_render_author' ) ) :
/**
 * Renders the HTML code with the author link for the current entry
 */
function btp_entry_render_author() {
   	?>
      	<span class="entry-author"><?php _e('by', 'btp_theme'); ?> <?php the_author_posts_link(); ?></span>
    <?php 
}
endif;



if ( ! function_exists( 'btp_entry_render_comments_link' ) ) :
/**
 * Renders the HTML code with the comments link for the current entry
 */
function btp_entry_render_comments_link() {
   	?>
    <span class="entry-comments-link">
    	<?php 
    		comments_popup_link(__('0 Comments', 'btp_theme'), 
    							__('1 Comment', 'btp_theme'), 
    							__('% Comments', 'btp_theme'),
    							'',
    							__('Comments are off', 'btp_theme')
    		); 
    	?>
    </span>
    <?php 
}
endif;



if ( ! function_exists( 'btp_entry_capture_categories' ) ) :
/**
 * Captures the HTML with all hierarchical categories for the current entry.
 */
function btp_entry_capture_categories() {
	$out = '';
	
	global $post;
	
	$taxonomies = get_object_taxonomies( $post );
	
	foreach ( $taxonomies as $taxonomy ) {	
		$taxonomy = get_taxonomy( $taxonomy );	
		if ( $taxonomy->query_var && $taxonomy->hierarchical ) {
			
			$out .= '<div class="entry-categories">';
				$out .= '<h6>' . $taxonomy->labels->name . '</h6>';
				$out .= get_the_term_list( $post->ID, $taxonomy->name, '<ul><li>', '</li><li>', '</li></ul>' );
			$out .= '</div>';
		}
	}
	
	return $out;
}
endif;
if ( ! function_exists( 'btp_entry_render_categories' ) ) :
function btp_entry_render_categories() {
	echo btp_entry_capture_categories();
}
endif;



if ( ! function_exists( 'btp_entry_capture_tags' ) ) :
/**
 * Captures the HTML with all non-hierarchical taxonomies for the current entry.
 */
function btp_entry_capture_tags() {
	$out = '';
	
	global $post;
	
	$taxonomies = get_object_taxonomies( $post );
	
	foreach ( $taxonomies as $taxonomy ) {	
		$taxonomy = get_taxonomy( $taxonomy );	
		if ( $taxonomy->query_var && !$taxonomy->hierarchical && !in_array( $taxonomy->name, array( 'post_format' ) ) ) {
			
			$out .= '<div class="entry-tags">';
				$out .= '<h6>' . $taxonomy->labels->name . '</h6>';
				$out .= get_the_term_list( $post->ID, $taxonomy->name, '<ul><li>', '</li><li>', '</li></ul>' );
			$out .= '</div>';
		}
	}
	
	return $out;
}
endif;
if ( ! function_exists( 'btp_entry_render_tags' ) ) :
function btp_entry_render_tags() {
	echo btp_entry_capture_tags();
}
endif;



if ( ! function_exists( 'btp_entry_capture_button_1' ) ) :
/**
 * Captures the HTML with the primary button for the current entry
 */
function btp_entry_capture_button_1( $lightbox_group = '', $priority = 'primary', $size = 'small', $wide = false ) {	
	global $post;		
	
	$linking = btp_entry_get_option_value( $post->ID, 'button_1_linking', true );
	$link = ( 'none' != $linking ) ? apply_filters( 'the_permalink', get_permalink() ) : '';
	
	$class = '';
	$title = '';
	$rel = '';	
	
	switch ( $linking ) {
		case 'none':
			break;
		
		case 'new_window':
		case 'new-window':
			$class = 'new-window';
			break;

		case 'lightbox';
			$title = the_title_attribute( 'echo=0' );
			$rel = 'prettyPhoto';
			$rel .= strlen( $lightbox_group ) ? '[' . $lightbox_group . ']' : '';
			break;	
			
		default:
			$title = the_title_attribute( 'echo=0' );
			break;	
	}	
	
	if ( in_array( $linking, array( 'new_window', 'new-window', 'lightbox' ) ) ) {
		if ( has_post_thumbnail() ) {
			$thumb_id = get_post_thumbnail_id( $post->ID );		
			$alt_link = get_post_meta( $thumb_id, '_btp_alt_link', true );			
			if ( strlen( $alt_link ) ) {
				$link = $alt_link;
			} else {
				$link = wp_get_attachment_image_src( $thumb_id, 'full' );
				$link = $link[0];
			}
		}	
	}
		
	echo do_shortcode( '[button '. 
		'link="' . $link . '" ' .
		'linking="' . $linking . '" ' .
		'priority="' .$priority . '" ' .
		'size="' . $size . '" ' .
		'wide="' . $wide . '" ' .
		'lightbox_group="' . $lightbox_group . '" ' .
		']' . __( 'More', 'btp_theme' ) . '[/button]' 
	);
	
}
endif;
if ( ! function_exists( 'btp_entry_render_button_1' ) ) :
function btp_entry_render_button_1( $lightbox_group = '', $priority = 'primary', $size = 'small', $wide = false ) {
	echo btp_entry_capture_button_1( $lightbox_group, $priority, $size, $wide );
}
endif;



if ( ! function_exists( 'btp_entry_capture_filters' ) ) :
/**
 * Captures the HTML with the isotope filters for the current entry
 * 
 * since			1.1.0
 */
function btp_entry_capture_filters( $taxonomy ) {
	global $post;
	
	$terms = get_the_terms( $post->ID, $taxonomy );
	$filters = '';
    if ( $terms && ! is_wp_error( $terms ) ) {
    	foreach ( $terms as $term ) {  
        	$filters .= 'filter-' . $term->term_id . ' ';  
        }  
        $filters = trim($filters);
    }
    
    return $filters;
}
endif;   
if ( ! function_exists( 'btp_entry_render_filters' ) ) :
function btp_entry_render_filters( $taxonomy ) {
	echo btp_entry_capture_filters( $taxonomy );
}
endif;



/* ------------------------------------------------------------------------- */
/* ---------->>> ADD STANDARD ENTRY OPTIONS <<<----------------------------- */
/* ------------------------------------------------------------------------- */
btp_entry_add_option_group( 
	'single', 
	array( 
		'label' => __( 'Single Page Elements', 'btp_theme' ),
	), 
	20 
);
btp_entry_add_option_subgroup( 
	'main', 
	array( 
		'label' => __( 'Main', 'btp_theme' ),	
	), 
	'single', 
	10
);

btp_entry_add_option( 'elem_sidebar_1', array(
	'view'			=> 'Choice',
	'choices_cb'	=> 'btp_sidebar_get_choices',
	'null'			=> __( 'inherit', 'btp_theme' ),
	'label' 		=> __( 'Sidebar', 'btp_theme' ),
	'group'			=> 'single',
	'subgroup'		=> 'main',
	'position'		=> 30,
));
btp_entry_add_option( 'elem_title', array(
	'view'			=> 'Choice',	
	'label' 		=> __( 'Title', 'btp_theme' ),
	'null'			=> __( 'inherit', 'btp_theme' ),
	'choices'		=> array(		
		'show'	=> __( 'show', 'btp_theme' ),			
		'none'	=> __( 'hide', 'btp_theme' ),
	),
	'group'			=> 'single',
	'subgroup'		=> 'main',
	'position'		=> 40,
));
btp_entry_add_option( 'elem_breadcrumbs', array(
	'view'			=> 'Choice',
	'label' 		=> __( 'Breadcrumbs', 'btp_theme' ),
	'null'			=> __( 'inherit', 'btp_theme' ),
	'choices'		=> array(
		'standard'		=> __( 'show', 'btp_theme' ),
		'none'			=> __( 'hide', 'btp_theme' ),
	),		
	'group'			=> 'single',
	'subgroup'		=> 'main',
	'position'		=> 60,
));
btp_entry_add_option( 'elem_mediabox', array(
	'view'			=> 'Choice',
	'null'			=> __( 'inherit', 'btp_theme' ),
	'choices_cb'	=> 'btp_mediabox_get_choices',
	'label' 		=> __( 'Media box', 'btp_theme' ),
	'help_cb'		=> 'btp_mediabox_get_help',
	'group'			=> 'single',
	'subgroup'		=> 'main',
	'position'		=> 70,
));
btp_entry_add_option( 'elem_date', array(
	'view'			=> 'Choice',
	'null'			=> __( 'inherit', 'btp_theme' ),
	'choices'		=> array(
		'standard'		=> __( 'show', 'btp_theme' ),	
		'none'			=> __( 'hide', 'btp_theme' ),
	),
	'label' 		=> __( 'Date', 'btp_theme' ),
	'group'			=> 'single',
	'subgroup'		=> 'main',
	'position'		=> 80,
));
btp_entry_add_option( 'elem_author', array(
	'view'			=> 'Choice',
	'null'			=> __( 'inherit', 'btp_theme' ),
	'choices'		=> array(
		'standard'		=> __( 'show', 'btp_theme' ),	
		'none'			=> __( 'hide', 'btp_theme' ),
	),
	'label' 		=> __( 'Author', 'btp_theme' ),
	'group'			=> 'single',
	'subgroup'		=> 'main',
	'position'		=> 85,
));
btp_entry_add_option( 'elem_comments_link', array(
	'view'			=> 'Choice',
	'null'			=> __( 'inherit', 'btp_theme' ),
	'choices'		=> array(
		'standard'		=> __( 'show', 'btp_theme' ),	
		'none'			=> __( 'hide', 'btp_theme' ),
	),
	'label' 		=> __( 'Comments link', 'btp_theme' ),
	'group'			=> 'single',
	'subgroup'		=> 'main',
	'position'		=> 90,
));
btp_entry_add_option( 'elem_categories', array(
	'view'			=> 'Choice',
	'null'			=> __( 'inherit', 'btp_theme' ),
	'choices'		=> array(
		'standard'		=> __( 'show', 'btp_theme' ),	
		'none'			=> __( 'hide', 'btp_theme' ),
	),
	'label' 		=> __( 'Categories', 'btp_theme' ),
	'group'			=> 'single',
	'subgroup'		=> 'main',
	'position'		=> 100,
));
btp_entry_add_option( 'elem_tags', array(
	'view'			=> 'Choice',
	'null'			=> __( 'inherit', 'btp_theme' ),
	'choices'		=> array(
		'standard'	=> __( 'show', 'btp_theme' ),	
		'none'		=> __( 'hide', 'btp_theme' ),
	),
	'label' 		=> __( 'Tags', 'btp_theme' ),
	'group'			=> 'single',
	'subgroup'		=> 'main',
	'position'		=> 110,
));



btp_entry_add_option_group( 
	'general', 
	array( 
		'label' => __( 'General', 'btp_theme' ),
	), 
	10 
);
btp_entry_add_option_subgroup( 
	'main', 
	array( 
		'label' => __( 'Main', 'btp_theme' ),
	), 
	'general', 
	10
);
btp_entry_add_option( 'subtitle', array(
	'model'			=> 'Single',
	'label' 		=> __( 'subtitle', 'btp_theme' ),
	'hint'			=> __( 'This will be displayed below the title', 'btp_theme' ),
	'group'			=> 'general',
	'subgroup'		=> 'main',
	'position'		=> 50,
));
btp_entry_add_option( 'title_linking', array(
	'view'			=> 'Choice',
	'choices'		=> array(
		'standard'		=> __( 'open the entry in the same window', 'btp_theme' ),
		'new-window'	=> __( 'open the featured media in a new window', 'btp_theme' ),
		'lightbox'		=> __( 'open the featured media in a lightbox', 'btp_theme' ),
		'none'			=> __( 'don\'t link', 'btp_theme' ),
	),
	'label' 		=> __( 'title linking', 'btp_theme' ),
	'hint'			=> __( 'What to do when user clicks the title?', 'btp_theme' ),
	'help'			=>
		'<p>' . __( 'By default, when displaying a collection of entries, the title links to the single entry page. You can easily change it here:', 'btp_theme') . '</p>' . 
		'<ul>' .
			'<li>' . __( '<strong>open the entry in the same window</strong> - default', 'btp_theme' ) . '</li>' .
			'<li>' . __( '<strong>open the featured media in a new window</strong> - will try to open in a new window the featured image or the alternative link (if provided) of the featured image', 'btp_theme' ) . '</li>' .
			'<li>' . __( '<strong>open the featured media in a lightbox</strong> - will try to open in a lightbox the featured image or the alternative link (if provided) of the featured image', 'btp_theme' ) . '</li>' .
			'<li>' . __( '<strong>don\'t link</strong> - display the title without wrapping it in a link', 'btp_theme' ) . '</li>' .
		'</ul>',
	'group'			=> 'general',
	'subgroup'		=> 'main',
	'position'		=> 100,
));
btp_entry_add_option( 'button_1_linking', array(
	'view'			=> 'Choice',
	'choices'		=> array(
		'standard'		=> __( 'open the entry in the same window', 'btp_theme' ),
		'new-window'	=> __( 'open the featured media in new window', 'btp_theme' ),
		'lightbox'		=> __( 'open the featured media in lightbox', 'btp_theme' ),
		'none'			=> __( 'don\'t link', 'btp_theme' ),
	),
	'label' 		=> __( 'button_1 linking', 'btp_theme' ),
	'hint'			=> __( 'What to do when user clicks the button?', 'btp_theme' ),
	'help'			=>
		'<p>' . __( 'By default, when displaying a collection of entries, the button_1 links to the single entry page. You can easily change it here:', 'btp_theme') . '</p>' . 
		'<ul>' .
			'<li>' . __( '<strong>open the entry in the same window</strong> - default', 'btp_theme' ) . '</li>' .
			'<li>' . __( '<strong>open the featured media in a new window</strong> - will try to open in a new window the featured image or the alternative link (if provided) of the featured image', 'btp_theme' ) . '</li>' .
			'<li>' . __( '<strong>open the featured media in a lightbox</strong> - will try to open in a lightbox the featured image or the alternative link (if provided) of the featured image', 'btp_theme' ) . '</li>' .
		'</ul>',
	'group'			=> 'general',
	'subgroup'		=> 'main',
	'position'		=> 110,
));
?>