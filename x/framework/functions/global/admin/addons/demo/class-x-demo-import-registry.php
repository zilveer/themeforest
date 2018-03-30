<?php

/**
 * This class exists to manage a persistent index
 * of which items have been imported already.
 *
 * This ensures items are not duplicated, and that if a
 * user modifies demo content it will not be overwritten.
 */
class X_Demo_Import_Registry {

  public $namespace;
  public $registry;

  /**
   * Provision this instance with a namespace and populate
   * registry with any existing values.
   * @param string $namespace Unique namespace
   * @return none
   */
  public function setNameSpace( $namespace ) {
    $this->namespace = $namespace;
    $option = get_option('x_demo_importer_registry', array() );
    $this->registry = isset($option[$namespace]) ? $option[$namespace] : array();
  }

  /**
   * Persist data in our namespace to a WP option.
   * @return none
   */
  public function save() {
    $option = get_option('x_demo_importer_registry', array() );
    $option[$this->namespace] = $this->registry;
    update_option( 'x_demo_importer_registry', $option );
  }

  /**
   * Get an existing value if available
   * @param  string $group Group to check for ID
   * @param  string $key    Hash based ID provided by XDE
   * @return mixed         null if it doesn't exist.
   */
  public function get( $group, $key ) {
    return ( isset( $this->registry[$group] ) &&  isset( $this->registry[$group][$key] ) )
          ? $this->registry[$group][$key] : null;
  }

  /**
   * Returns everything stored in this registry.
   * @return array
   */
  public function all() {
    return $this->registry;
  }

  /**
   * Test if a value exists
   * @param  string $group Group to check for key
   * @param  string $key    Hash based ID provided by XDE
   * @return bool         true/false based on existence
   */
  public function exists( $group, $key ) {
    return (!is_null( $this->get( $group, $key ) ) );
  }

  /**
   * Add a value to our registry
   * @param  string  $group     Group to place the ID in the registry
   * @param  string  $key       unique ID string
   * @param  mixed   $value     Store a reference to an ID or entity on this install
   * @param  boolean $overwrite should existing values be allowed to be overwritten
   * @return boolean            true, otherwise false if id exists
   */
  public function set( $group, $key, $value, $overwrite = true ) {

    if ( !$overwrite && $this->exists( $group, $key ) )
      return false;

    if (!isset($this->registry[$group]))
      $this->registry[$group] = array();

    $this->registry[$group][$key] = $value;
    $this->save();

    return true;
  }

  /**
   * Delete a value from the registry
   * @param  string $group Group to delete a key from.
   * @param  string $key    Hash based ID provided by XDE
   * @return none
   */
  public function delete( $group, $key ) {

    if ( $this->exists( $group, $key ) )
      unset( $this->registry[$group][$key] );

    $this->save();

  }
  /**
   * Deletes a key from a group in all namespaces
   * @param  string $group Group to delete a key from.
   * @param  string $key    Hash based ID provided by XDE
   * @return none
   */
  public static function deleteAll( $group, $key ) {
    $option = get_option('x_demo_importer_registry', array() );
    $namespaces = array_keys( $option );
    foreach ( $namespaces as $namespace ) {
      $registry = new X_Demo_Import_Registry;
      $registry->setNameSpace( $namespace );
      $registry->delete( $group, $key );
    }
  }

}