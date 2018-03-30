<?php

/**
 * This is the base class for all export classes
 */
abstract class ZN_ExportBase
{
//<editor-fold desc=">>> CLASS VARS">
	const TYPE_INFO = 'x000';
	const TYPE_WARNING = 'x001';
	const TYPE_ERROR = 'x002';

	private static $_info = array(
		'info' => array(),
		'warning' => array(),
		'error' => array(),
	);



	// the path to the uploads directory. With trailing slash
	private $_uploadsDirPath = '';
	private $_archiveName = 'kallyas-demo-data.zip';

	/**
	 * Holds the reference to the instance of the ZipArchive class
	 * @var null
	 */
	private static $_zip = null;
//</editor-fold desc=">>> CLASS CONSTANTS">

// CLASS INTERNALS
	public function __construct( $archiveName = '' )
	{
		$wp_uploadsDir = wp_upload_dir();
		if(is_array($wp_uploadsDir) && isset($wp_uploadsDir['basedir']))
		{
			$wp_uploadsDir = trailingslashit($wp_uploadsDir['basedir']);
			$this->_uploadsDirPath = trailingslashit($wp_uploadsDir);
		}

		if(! empty($archiveName)){
			// remove .zip extension if provided
			$this->_archiveName = trim(basename($archiveName, '.zip')).'.zip';
		}
	}



//<editor-fold desc=">>> SETTERS">
	public function addInfo( $message = '' ){
		$message = trim($message);
		if(! empty($message)){
			array_push(self::$_info['info'], $message);
		}
		return $this;
	}
	public function addWarning( $message = '' ){
		$message = trim($message);
		if(! empty($message)){
			array_push(self::$_info['warning'], $message);
		}
		return $this;
	}
	public function addError( $message = '' ){
		$message = trim($message);
		if(! empty($message)){
			array_push(self::$_info['error'], $message);
		}
		return $this;
	}

	public function addMessage( $type = self::TYPE_INFO, $message = '' ){
		if( $type == self::TYPE_INFO ){
			return $this->addInfo($message);
		}
		elseif( $type == self::TYPE_WARNING ){
			return $this->addWarning($message);
		}
		elseif( $type == self::TYPE_ERROR ){
			return $this->addError($message);
		}
		return $this;
	}
//</editor-fold desc=">>> SETTERS">

//<editor-fold desc=">>> GETTERS">
	function getInfoMessages(){
		if(isset(self::$_info['info']) && ! empty(self::$_info['info'])){
			return self::$_info['info'];
		}
		return array();
	}
	function getWarningMessages(){
		if(isset(self::$_info['warning']) && ! empty(self::$_info['warning'])){
			return self::$_info['warning'];
		}
		return array();
	}
	function getErrorMessages(){
		if(isset(self::$_info['error']) && ! empty(self::$_info['error'])){
			return self::$_info['error'];
		}
		return array();
	}
	function getAllMessages(){
		return self::$_info;
	}
	function getZipRef(){
		return self::$_zip;
	}
	function getArchiveSavePath()
	{
		return $this->_uploadsDirPath.$this->_archiveName;
	}
//</editor-fold desc=">>> GETTERS">

//<editor-fold desc=">>> UTILITY METHODS">
	function hasInfo(){
		return (isset(self::$_info['info']) && ! empty(self::$_info['info']));
	}
	function hasWarnings(){
		return (isset(self::$_info['warning']) && ! empty(self::$_info['warning']));
	}
	function hasErrors(){
		return (isset(self::$_info['error']) && ! empty(self::$_info['error']));
	}
	function hasMessages(){
		return ($this->hasInfo() || $this->hasWarnings() || $this->hasErrors());
	}
//</editor-fold desc=">>> UTILITY METHODS">

	protected function checkZipInstance( $zip )
	{
		if(empty($zip)){
			$this->addError(sprintf('$zip is empty.', __METHOD__));
			return false;
		}
		elseif(! $zip instanceof ZipArchive){
			$this->addError(sprintf('$zip is not an instance of ZipArchive class.', __METHOD__));
			return false;
		}
		return true;
	}

	// Template method
	// This is the only callable method from this class
	public function exportDemoData( $archiveName = '' )
	{
		// Create and open the archive
		self::$_zip = new ZipArchive();
		self::$_zip->open( $this->_uploadsDirPath.$this->_archiveName, ZipArchive::CREATE | ZipArchive::OVERWRITE);

		// These methods must be overridden by derived classes
		$this->exportDemoConfigFile( self::$_zip );

		$this->exportThemeScreenshot( self::$_zip );

		$this->exportContent( self::$_zip );

		$this->exportCustomIcons( self::$_zip );

		$this->exportThemeOptions( self::$_zip );

		$this->exportWidgets( self::$_zip );


		// Close the archive
		self::$_zip->close();
$this->addInfo('archive created and ready for download');
		return true;
	}

	// These methods must be implemented by derived classes
	abstract function exportDemoConfigFile( $zip );
	abstract function exportThemeScreenshot( $zip );
	abstract function exportContent( $zip );
	abstract function exportCustomIcons( $zip );
	abstract function exportThemeOptions( $zip );
	abstract function exportWidgets( $zip );
}
