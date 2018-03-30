<?php

/**
 * Base class for images replacements in theme demo export
 * Basic Singleton
 */
class ZN_ImageManager
{
	/**
	 * Cache all posts by type
	 * @var array
	 * @see __getAllPosts()
	 */
	private $_cachePosts = array();

	/**
	 * Holds the reference to the instance of this class
	 * @var null
	 */
	private static $_instance = null;

	private $_postClass = null;

	/**
	 * Constructor
	 */
	private function __construct(){
		$this->_postClass = ZN_ImageManagerPost::getInstance();
	}

	/**
	 * Retrieve the reference to the instance of this class
	 * @return null|ZN_ImageManager
	 */
	public static function getInstance(){
		if(empty(self::$_instance) || !(self::$_instance instanceof self)){
			self::$_instance = new self;
		}
		return self::$_instance;
	}


	/**
	 * Retrieve all posts from the database
	 * @uses set_transient
	 * @return array|mixed
	 */
	public function getPosts()
	{
		// check cache first
		if(empty($this->_cachePosts)){
			$temp = get_transient('ZN_IMAGE_MANAGER_POSTS_CACHE');
			if(! empty($temp)) {
				return $this->_cachePosts = $temp;
			}
		}

		$theQuery = new WP_Query(array(
			'post_type' => 'any',
			'post_status' => 'any',
			'posts_per_page' => -1
		));

		if( ! $theQuery->have_posts()){
			return $this->_cachePosts;
		}
		while($theQuery->have_posts()){
			$theQuery->the_post();
			array_push($this->_cachePosts, get_the_ID());
		}
		wp_reset_postdata();

		set_transient('ZN_IMAGE_MANAGER_POSTS_CACHE', $this->_cachePosts);

		return $this->_cachePosts;
	}

	/**
	 * Loop through all posts found in the database and replace the old image with the new specified image
	 *
	 * @param int $oldImageID
	 * @param int $newImageID
	 * @param string $oldURL
	 * @param string $newURL
	 *
	 * @uses ZN_ImageManagerPost::updatePost()
	 * @uses ZN_ImageManagerPost::cleanup()
	 * @return array The list of posts successfully and/or failed to update
	 */
	public function updatePosts( $oldImageID, $newImageID, $oldURL, $newURL)
	{
		$posts = $this->getPosts();
		if(empty($posts)){
			return '['.get_class().'] No posts found';
		}

		foreach( $posts as $postID )
		{
			call_user_func(
				array( $this->_postClass, 'updatePost' ),
				$postID, $oldImageID, $oldURL, $newImageID, $newURL
			);
		}

		// Replace Image in Theme Options
		call_user_func(
			array( $this->_postClass, 'replaceImageThemeOptions' ),
			$oldImageID, $oldURL, $newImageID, $newURL
		);

		// Cleanup
		call_user_func( array($this, 'cleanup') );
		call_user_func( array($this->_postClass, 'cleanup') );

		return call_user_func( array($this->_postClass, 'getStatusResult') );
	}


	/**
	 * Deletes all temporary data stored throughout the image replacement process
	 */
	public function cleanup()
	{
		delete_transient( 'ZN_IMAGE_MANAGER_POSTS_CACHE' );
	}

}
