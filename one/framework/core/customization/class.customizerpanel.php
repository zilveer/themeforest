<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Theme customizer panel class.
 *
 * This class is entitled to manage the theme customizer panels.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2014, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Core
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2014, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 2.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
if( !class_exists('THB_CustomizerPanel') ) {
	class THB_CustomizerPanel {

		/**
		 * The customizer object.
		 *
		 * @var THB_Customizer
		 */
		private $customizer = null;

		/**
		 * The panel key.
		 *
		 * @var string
		 */
		private $key = '';

		/**
		 * The panel title.
		 *
		 * @var string
		 */
		private $title = '';

		/**
		 * The panel priority index.
		 *
		 * @var integer
		 */
		private $index = 0;

		/**
		 * The panel settings.
		 *
		 * @var array
		 */
		private $settings = array();

		/**
		 * The panel sections.
		 *
		 * @var array
		 */
		private $sections = array();

		/**
		 * The panel description.
		 *
		 * @var string
		 */
		private $description = '';

		/**
		 * Constructor.
		 *
		 * @param string $key The section key.
		 * @param string $title The section title.
		 * @param int $index The section priority index.
		 * @param THB_Customizer $customizer Reference to the theme customizer.
		 * @return THB_CustomizerPanel
		 */
		public function __construct( $key, $title, $customizer = null, $index = 0 )
		{
			$this->key = $key;
			$this->title = $title;
			$this->index = $index;
			$this->customizer = $customizer;

			return $this;
		}

		/**
		 * Add a section to the theme customizer.
		 *
		 * @param string $key The section key.
		 * @param string $title The section title.
		 * @return THB_CustomizerSection
		 */
		public function addSection( $key, $title )
		{
			$section = new THB_CustomizerSection( $key, $title, $this->customizer, count( $this->sections ), $this->key );
			$this->sections[] = $section;

			return $section;
		}

		/**
		 * Set a description for the panel.
		 *
		 * @param string $description
		 */
		public function setDescription( $description )
		{
			$this->description = $description;
		}

		/**
		 * Get the theme customizer sections.
		 *
		 * @return array
		 */
		public function getSections()
		{
			return $this->sections;
		}

		/**
		 * Register the section.
		 */
		public function register()
		{
			global $wp_customize;

			$wp_customize->add_panel( $this->key, array(
				'priority'       => $this->index,
				'capability'     => 'edit_theme_options',
				'theme_supports' => '',
				'title'          => $this->title,
				'description'    => $this->description,
			) );

			foreach ( $this->getSections() as $section ) {
				$section->register();
			}
		}

	}
}