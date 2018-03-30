<?php

/**
 * Base class for changing images across posts. Do not use directly, use ZN_ImageManager instead.
 * Basic Singleton
 */
class ZN_ImageManagerPost
{
	/**
	 * Holds the reference to the instance of this class
	 * @var null
	 */
	private static $_instance = null;

	/**
	 * Constructor
	 */
	private function __construct(){}

	/**
	 * Holds the lists of updated/failed posts
	 * @var array
	 */
	private $_info = array(
		'updated' => array(),
		'failed' => array(),
	);

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

	public function getStatusResult(){
		return $this->_info;
	}

	// // $postID, $oldImageID, $oldURL, $newImageID, $newURL
	public function updatePost( $postID, $oldImageID, $oldURL, $newImageID, $newURL)
	{
		// Replace post's featured image
		$this->replacePostFeaturedImage( $postID, $oldImageID, $newImageID );

		// Replace the images found in posts
		$this->replacePostContentImage( $postID, $oldImageID, $oldURL, $newImageID, $newURL );

		// Replace the images found in the gallery of a WC product
		if( 'product' == get_post_type($postID)) {
			$this->replaceProductGalleryImage( $postID, $oldImageID, $newImageID );
		}
		// Replace the images found in a Portfolio post type
		elseif( 'portfolio' == get_post_type($postID)) {
			$this->replacePortfolioImage( $postID, $oldURL, $newURL);
		}

		// Replace all occurrences of the image in Page Builder data
		$this->replacePageBuilderImages( $postID, $oldURL, $newURL);

		return $this->_info;
	}

	/**
	 * Replace the featured image of the specified post
	 *
	 * @param int $postID
	 * @param int $oldImageID
	 * @param int $newImageID
	 *
	 * @return array
	 */
	public function replacePostFeaturedImage( $postID, $oldImageID, $newImageID )
	{
		$thumbID = get_post_thumbnail_id( $postID );
		if(empty($thumbID)){
			return $this->_info;
		}

		if($thumbID == $oldImageID)
		{
			global $wpdb;
			$result = set_post_thumbnail($postID, $newImageID);
			if($result){
				$this->_info['updated'][$postID] = get_permalink($postID);
				$this->__addImage($oldImageID);
			}
			else {
				// check wpdb errors
				if(empty($wpdb->last_error)){
					// No problem here, the post was updated using the same image, but WP will wrongly
					// return false when updating option or post_meta with the same value
					$this->_info['updated'][$postID] = get_permalink($postID);
					$this->__addImage($oldImageID);
				}
				else {
					// Problem...the post thumbnail could not be updated
					$this->_info['failed'][$postID] = get_permalink($postID);
					// remove the image so we can try again
					$this->__removeImage($oldImageID);
				}
			}
		}
		return $this->_info;
	}

	/**
	 * Replaces all occurrences of the specified image in the provided string $content
	 * @param string $content
	 * @param int $oldImageID
	 * @param int $newImageID
	 * @param string $oldImageUrlNoExt
	 * @param string $oldImageAttachmentUrl
	 * @param string $newImageUrlNoExt
	 * @param string $newImageAttachmentUrl
	 * @param string $oldImageExtension
	 * @param string $newImageExtension
	 *
	 * @return string The modified $content
	 */
	private function __replaceImagesInContent( $content, $oldImageID, $newImageID, $oldImageUrlNoExt,
		$oldImageAttachmentUrl, $newImageUrlNoExt, $newImageAttachmentUrl, $oldImageExtension, $newImageExtension)
	{
		// replace image ID & URL if used
		$content = str_replace(
			array(
				'attachment_'.$oldImageID,
				'wp-image-'.$oldImageID,
				'wp-att-'.$oldImageID,
				$oldImageUrlNoExt,
				$oldImageAttachmentUrl
			),
			array(
				'attachment_'.$newImageID,
				'wp-image-'.$newImageID,
				'wp-att-'.$newImageID,
				$newImageUrlNoExt,
				$newImageAttachmentUrl
			)
			, $content);

		// Update file extension if new image is different
		if($newImageExtension != $oldImageExtension) {
			$content = str_replace(
				$newImageUrlNoExt . $oldImageExtension,
				$newImageUrlNoExt . $newImageExtension,
				$content
			);
		}

		return $content;
	}

	// $postID, $oldImageID, $oldURL, $newImageID, $newURL
	public function replacePostContentImage( $postID, $oldImageID, $oldImageUrl, $newImageID, $newImageUrl )
	{
		// remove the file extension from oldURL so we can find it in content since it might be used like this:
		// 'http://localhost/hogash/kallyas/github/wp-content/uploads/2016/07/blue-tshirt-300x300.jpg';
		$oldImageUrlNoExt = '';
		$oldImageExtension = '';
		if(false !== ($pos = strrpos($oldImageUrl, '.'))){
			$oldImageUrlNoExt = substr($oldImageUrl, 0, $pos);
			$oldImageExtension = substr($oldImageUrl, $pos, strlen($oldImageUrl));
		}
		$newImageUrlNoExt = '';
		$newImageExtension = '';
		if(false !== ($pos = strrpos($newImageUrl, '.'))){
			$newImageUrlNoExt = substr($newImageUrl, 0, $pos);
			$newImageExtension = substr($newImageUrl, $pos, strlen($newImageUrl));
		}
		// Needed if the images are linked to their pages
		$oldImageAttachmentUrl = get_attachment_link($oldImageID);
		$newImageAttachmentUrl = get_attachment_link($newImageID);

		$post = get_post($postID);
		if($post)
		{
			$content = $post->post_content;
			$excerpt = $post->post_excerpt;

			if(empty($content) && empty($excerpt)){
				return $this->_info;
			}

			// Search in content
			if ( ! empty( $content ) )
			{
				$content = $this->__replaceImagesInContent(
					$content, $oldImageID, $newImageID, $oldImageUrlNoExt,
					$oldImageAttachmentUrl, $newImageUrlNoExt, $newImageAttachmentUrl,
					$oldImageExtension, $newImageExtension
				);
			}

			// search in excerpt
			if ( ! empty( $excerpt ) ) {
				$excerpt = $this->__replaceImagesInContent(
					$excerpt, $oldImageID, $newImageID, $oldImageUrlNoExt,
					$oldImageAttachmentUrl, $newImageUrlNoExt, $newImageAttachmentUrl,
					$oldImageExtension, $newImageExtension
				);
			}

			// Update post if necessary
			if($content != $post->post_content || $excerpt != $post->post_excerpt)
			{
				$this->__addImage($oldImageID);

				$result = wp_update_post( array(
					'ID'           => $postID,
					'post_content' => $content,
					'post_excerpt' => $excerpt,
				) );

				if ( is_wp_error( $result ) ) {
					$this->__removeImage($oldImageID);
					$this->_info['failed'][$postID] = get_permalink($postID);
				}
				else {
					$this->_info['updated'][$postID] = get_permalink($postID);
				}
			}
		}
		return $this->_info;
	}

	/**
	 * Replace the old image id with the new specified one for a WC product gallery
	 * @param int $postID
	 * @param int $oldImageID
	 * @param int $newImageID
	 */
	public function replaceProductGalleryImage( $postID, $oldImageID, $newImageID )
	{
		$meta = get_post_meta( $postID, '_product_image_gallery', true);
		if( empty($meta)){
			update_post_meta( $postID, '_product_image_gallery', $newImageID );
		}
		else {
			$data = explode(',', $meta);
			if(! empty($meta)){
				$data = array_map('trim', $data);
				$changed = false;
				foreach($data as $i => &$imageID){
					if( $imageID == $oldImageID){
						$data[$i] = $newImageID;
						$this->__addImage( $oldImageID );
						$changed = true;
					}
				}
				if($changed){
					$result = update_post_meta( $postID, '_product_image_gallery', implode( ',', $data ) );
					if(false === $result){
						$this->_info['failed'][$postID] = get_permalink($postID);
						$this->__removeImage( $oldImageID );
					}
					else {
						$this->_info['updated'][$postID] = get_permalink($postID);
					}
				}
			}
		}
	}

	/**
	 * Recursively replace $oldImageUrl with $newImageUrl in theme options
	 * @param int $oldImageID
	 * @param string $oldImageUrl
	 * @param int $newImageID
	 * @param string $newImageUrl
	 *
	 * @return array
	 */
	public function replaceImageThemeOptions( $oldImageID, $oldImageUrl, $newImageID, $newImageUrl )
	{
		$data = get_option( ZN()->theme_data['options_prefix'] );

		$data = $this->recursiveArrayReplace( $data, $oldImageUrl, $newImageUrl );

		update_option( ZN()->theme_data['options_prefix'], $data );

		// Update dynamic css
		generate_options_css( $data );

		return $this->_info;
	}

	public function replacePortfolioImage( $postID, $oldImageUrl, $newImageUrl )
	{
		$data = get_post_meta($postID, 'zn_port_media', true);
		if(empty($data)){
			return $this->_info;
		}

		$data = $this->recursiveArrayReplace( $data, $oldImageUrl, $newImageUrl );

		update_post_meta( $postID, 'zn_port_media', $data );

		return $this->_info;
	}

	public function replacePageBuilderImages( $postID, $oldImageUrl, $newImageUrl )
	{
		$data = get_post_meta($postID, 'zn_page_builder_els', true);
		if(empty($data)){
			return $this->_info;
		}

		$data = $this->recursiveArrayReplace( $data, $oldImageUrl, $newImageUrl );

		update_post_meta( $postID, 'zn_page_builder_els', $data );

		return $this->_info;
	}

	/**
	 * Deletes all temporary data stored throughout the image replacement process
	 */
	public function cleanup(){
		delete_transient( 'ZN_IMAGE_MANAGER_THUMBS' );
	}

	/**
	 * Recursive value search/replace in array
	 *
	 * @param array $array The target array where to search in
	 * @param mixed $find The target value to search for
	 * @param mixed $replace The value to replace $find with
	 *
	 * @return array
	 */
	public function recursiveArrayReplace($array, $find, $replace){
		if(is_array($array)){
			foreach($array as $key=>$val) {
				if(is_array($array[$key])){
					$array[$key] = $this->recursiveArrayReplace($array[$key], $find, $replace);
				}else{
					if($val == $find) {
						$array[$key] = $replace;
					}
				}
			}
		}
		return $array;
	}


//<editor-fold desc=">>> SAVE IMAGES TO BE DELETED IN TRANSIENT">
	private function __addImage( $imageID ){
		$images = $this->__getImages();
		if(empty($images)){
			return false;
		}
		if(! isset($images[$imageID])) {
			array_push( $images, $imageID );
		}
		set_transient( 'ZN_IMAGE_MANAGER_THUMBS', $images );
		return true;
	}
	private function __removeImage( $imageID ){
		$images = $this->__getImages();
		if(empty($images)){
			return false;
		}
		if(! isset($images[$imageID])){
			return false;
		}
		foreach($images as $i => &$v){
			if($v == $imageID){
				unset($images[$i]);
			}
		}
		set_transient( 'ZN_IMAGE_MANAGER_THUMBS', $images );
		return true;
	}
	private function __getImages(){
		$images = get_transient('ZN_IMAGE_MANAGER_THUMBS');
		if(empty($images)) {
			$images = array();
		}
		return $images;
	}
//</editor-fold desc=">>> SAVE IMAGES TO BE DELETED IN TRANSIENT">

}
