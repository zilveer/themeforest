<?php
/**
 * Source loader
 *
 * Manage things that can contain multiple sources of data. This includes
 * things like fonts, icons, etc. 
 *
 * @since 1.5.0
 */
interface Listify_Customizer_SourceLoaderInterface {
	public function includes();
	public function add_source( $source_id, $source );
	public function get_source( $source_id );
	public function has_source( $source_id );
	public function get_sources();
	public function has_item( $item, $source_id = null );
	public function get_item_source( $item, $return = 'object' );
	public function get_item_data( $item, $source_id = null );
}
