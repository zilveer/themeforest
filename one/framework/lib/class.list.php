<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * List class.
 *
 * This class manages an ordered list. It is an array wrapper that allows the
 * insertion and removal of items at a specific position.
 *
 * @author The Happy Bit <thehappybit@gmail.com>
 * @package Classes
 * @since 1.0.0
 * @copyright Copyright (c) 2013, The Happy Bit
 * @license http://www.gnu.org/licenses/gpl.html
 */
class THB_List implements Iterator
{

	/**
	 * @var array The collection items.
	 */
	private $_items = array();

	/**
	 * @var int The iterator position.
	 */
	private $_position = 0;

	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->rewind();
	}

	// Iterator implementation -------------------------------------------------

	/**
	 * Return the current element.
	 *
	 * @return mixed
	 */
	public function current()
	{
		return $this->get($this->_position);
	}

	/**
	 * Return the index of the current element.
	 *
	 * @return int
	 */
	public function key()
	{
		return $this->_position;
	}

	/**
	 * Move forward by one.
	 */
	public function next()
	{
		++$this->_position;
	}

	/**
	 * Rewind the list.
	 *
	 * @return mixed
	 */
	public function rewind()
	{
		$this->_position = 0;
	}

	/**
	 * Check if the current element is valid.
	 *
	 * @return bool
	 */
	public function valid()
	{
		return isset( $this->_items[$this->_position] );
	}

	// Getters -----------------------------------------------------------------

	/**
	 * Return the number of items in the collection.
	 *
	 * @return int
	 */
	public function size()
	{
		return count($this->_items);
	}

	/**
	 * Get an item from the collection.
	 *
	 * @param int $index The item index.
	 * @return mixed|bool
	 */
	public function get( $index=0 )
	{
		if( isset($this->_items[$index]) ) {
			return $this->_items[$index];
		}

		return FALSE;
	}

	/**
	 * Get the first item from the collection.
	 *
	 * @return mixed
	 */
	public function getFirst()
	{
		return $this->get(0);
	}

	/**
	 * Get the last item from the collection.
	 *
	 * @return mixed
	 */
	public function getLast()
	{
		end($this->_items);
		return $this->get(key($this->_items));
	}

	/**
	 * Get all the items in the collection.
	 *
	 * @return array
	 */
	public function getAll()
	{
		return $this->_items;
	}

	// Modifiers ---------------------------------------------------------------

	/**
	 * Add a new item at the end of the collection.
	 *
	 * @param mixed $item The item to add to the collection.
	 */
	public function insert( $item )
	{
		$this->_items[] = $item;
	}

	/**
	 * Add a new item at a specific index of the collection.
	 *
	 * @param mixed $item The item to add to the collection.
	 * @param integer $index The item expected index.
	 */
	public function insertAt( $item, $index=0 )
	{
		if ( $index < 0 ) {
			$size = $this->size();
			$index = $size + $index;
		}

		$start = array_slice($this->_items, 0, $index);
		$end = array_slice($this->_items, $index);
		$start[] = $item;
		$this->_items = array_merge($start, $end);
	}

	/**
	 * Remove an item of the collection at a specific index.
	 *
	 * @param integer $index The item expected index.
	 */
	public function removeAt( $index=0 )
	{
		if ( $index < 0 ) {
			$size = $this->size();
			$index = $size + $index - 1;
		}

		if( isset($this->_items[$index]) ) {
			array_splice($this->_items, $index, 1);
		}
	}

	/**
	 * Remove the first element of the collection.
	 */
	public function removeFirst()
	{
		$this->removeAt(0);
	}

	/**
	 * Remove the last element of the collection.
	 */
	public function removeLast()
	{
		array_pop($this->_items);
	}

	/**
	 * Remove all the elements from the collection.
	 */
	public function removeAll()
	{
		$this->_items = array();
	}

}