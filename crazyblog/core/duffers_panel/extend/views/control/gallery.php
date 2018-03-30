<?php if ( !$is_compact ) echo VP_View::instance()->load( 'control/template_control_head', $head_info ); ?>



<div id="vp-pfui-format-gallery-preview" class="vp-pfui-elm-block vp-pfui-elm-block-image">

    <div class="vp-pfui-elm-container">

        <div class="vp-pfui-gallery-picker">

			<?php
			global $post;

			preg_match_all( "/[a-z _]+/i", crazyblog_set( $head_info, 'name' ), $output_array );

			$key = crazyblog_set( crazyblog_set( $output_array, 0 ), 0 );

			$field = crazyblog_set( crazyblog_set( $output_array, 0 ), 1 );

			$field2 = crazyblog_set( crazyblog_set( $output_array, 0 ), 2 );

			$data = get_post_meta( $post->ID, $key, true );

			$array = crazyblog_set( crazyblog_set( $data, $field ), 0 );

			$images = crazyblog_set( $array, $field2 );

			$img_array = explode( ',', $images );

			echo '<div class="gallery clearfix">';

			if ( $images ) {

				foreach ( $img_array as $image ) {

					$thumbnail = wp_get_attachment_image_src( $image, 'thumbnail' );

					echo '<span data-id="' . $image . '" title="' . 'title' . '"><img src="' . $thumbnail[0] . '" alt="" /><span class="close">x</span></span>';
				}
			}

			echo '</div>';
			?>

            <input type="hidden" name="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( $value ); ?>" />

            <p class="none"><a href="#" class="button vp-pfui-gallery-button"><?php esc_html_e( 'Pick Images', 'crazyblog' ); ?></a></p>

        </div>

    </div>

</div>



<?php
if ( !$is_compact )
	echo VP_View::instance()->load( 'control/template_control_foot' );?>