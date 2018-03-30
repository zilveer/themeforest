<?php
/**
 * Add placeholders to comments form fields.
 *
 * @param array Existing form fields.
 * @return array Filtered default form fields.
 */
function flow_comment_fields_placeholders( $fields ) {
	$req = get_option( 'require_name_email' );
    $fields['author'] = str_replace( 'name="author"', 'placeholder="' . __( 'Name', 'flowthemes' ) . ( $req ? ' *' : '' ) . '" name="author"', $fields['author'] );
    $fields['email'] = str_replace( 'name="email"', 'placeholder="' . __( 'Email', 'flowthemes' ) . ( $req ? ' *' : '' ) . '" name="email"', $fields['email'] );
    $fields['url'] = str_replace( 'name="url"', 'placeholder="' . __( 'Website', 'flowthemes' ) . '" name="url"', $fields['url'] );

    return $fields;
}
add_filter( 'comment_form_default_fields', 'flow_comment_fields_placeholders' );

/**
 * Add placeholders to comments form textarea.
 *
 * @param array Comment textarea.
 * @return array Filtered comment textarea.
 */
function flow_comment_textarea_placeholder( $fields ) {
	$fields['comment_field'] = str_replace( 'name="comment"', 'placeholder="' . __( 'Comment', 'flowthemes' ) . '" name="comment"', $fields['comment_field'] );

	return $fields;
}
add_filter( 'comment_form_defaults', 'flow_comment_textarea_placeholder' );
