<?php
// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'RWMB_Uploader_Field' ) )
{
	class RWMB_Uploader_Field extends RWMB_Field
	{
		/**
		 * Enqueue scripts and styles
		 *
		 * @return void
		 */
		static function admin_enqueue_scripts()
		{

			wp_enqueue_script( 'rwmb-image-uploader', RWMB_JS_URL . 'uploader.js', array( 'jquery' ), RWMB_VER, true );

		}

		/**
		 * Get field HTML
		 *
		 * @param mixed  $meta
		 * @param array  $field
		 *
		 * @return string
		 */
		static function html( $meta, $field )
		{
		global $post;
        $output = '';
        if ( $meta != '' ) {
          $thumb = explode( ',', $meta );
          foreach ( $thumb as $thumb_image ) {
            $output .= '<div class="uploader-image"><img src="' . $thumb_image . '" alt="" /></div>';
          }
        }
		return sprintf('<input type="text" name="%s" id="%s" value="%s" class="file" /><input data-id="%s"  type="button" class="uploader-image-button button" name="%s_button" id="%s_upload" value="Select Background Image(s)" /><div class="meta-box-img-thumb-wrap">%s</div>',
		 $field['field_name'],  
		 $field['id'],
		 ( $meta ? $meta : $field['std'] ), 
		 get_the_ID(),
		 $field['field_name'], 
		 $field['id'], 
		 $output ) ;		 

		}

	}
}
