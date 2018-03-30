<?php 

/**
 * Ebor Framework
 * Custom date picker for customiser
 * @since version 1.0
 * @author TommusRhodus
 */
class Date_Picker_Custom_Control extends WP_Customize_Control
{
    /**
    * Enqueue the styles and scripts
    */
    public function enqueue()
    {
        wp_enqueue_style( 'jquery-ui-datepicker' );
    }

    /**
    * Render the content on the theme customizer page
    */
    public function render_content()
    {

        ?>
            <label>
              <span class="customize-date-picker-control"><?php echo esc_html( $this->label ); ?></span>
              <input type="date" id="<?php echo $this->id; ?>" name="<?php echo $this->id; ?>" value="<?php echo $this->value(); ?>" class="datepicker" />
            </label>
        <?php
    }
}

/**
 * Ebor Framework
 * Custom textarea for theme customizer
 * @since version 1.0
 * @author TommusRhodus
 */
class Ebor_Customize_Textarea_Control extends WP_Customize_Control {

	public $type = 'textarea';
	
	public function render_content() {
	?>
	
		<label>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<textarea rows="3" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
		</label>
	
	<?php
	}

}

/**
 * Ebor Framework
 * Custom HTML5 number control for theme customizer
 * @since version 1.0
 * @author TommusRhodus
 */
class Ebor_Customizer_Number_Control extends WP_Customize_Control {

	public $type = 'number';
	
	public function render_content() {
	?>
	
		<label>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<input type="number" <?php $this->link(); ?> value="<?php echo intval( $this->value() ); ?>" />
		</label>
		
	<?php
	}

}

/**
 * Google_Font Class
**/
class Google_Font
{
	private $title; // the name of the font
	private $location; // the http location of the font file
	private $cssDeclaration; // the css declaration used to reference the font
	private $cssClass; // the css class used in the theme customizer to preview the font

	/**
	 * Constructor
	**/
	public function __construct($title, $location, $cssDeclaration, $cssClass)
	{
		$this->title = $title;
		$this->location = $location;
		$this->cssDeclaration = $cssDeclaration;
		$this->cssClass = $cssClass;
	}

	/**
	 * Getters
	 * taken from: http://stackoverflow.com/questions/4478661/getter-and-setter
	**/
	public function __get($property) 
	{
		if (property_exists($this, $property)) {
			return $this->$property;
		}
	}
} // Custom_Font

/**
 * Google Font_Collection Class
**/
// this file controls all of the data for the custom fonts used in the theme customizer

// the Google_Font_Collection object is a wrapper that holds all of the individual custom fonts
class Google_Font_Collection
{
	private $fonts;

	/**
	 * Constructor
	**/
	public function __construct($fonts)
	{
		if(empty($fonts))
		{
			//we didn't get the required data
			return false;
		}

		// create fonts
		foreach ($fonts as $key => $value) 
		{
			$this->fonts[$value["title"]] = new Google_Font($value["title"], $value["location"], $value["cssDeclaration"], $value["cssClass"]);
		}
	}

	/**
	 * getFontFamilyNameArray Function
	 * this function returns an array containing all of the font family names
	**/
	function getFontFamilyNameArray()
	{
		$result;
		foreach ($this->fonts as $key => $value) 
		{
			$result[] = $value->__get("title");
		}
		return $result;
	}

	/**
	 * getTitle
	 * this function returns the font title
	**/
	function getTitle($key)
	{
		return $this->fonts[$key]->__get("title");
	}

	/**
	 * getLocation
	 * this function returns the font location
	**/
	function getLocation($key)
	{
		return $this->fonts[$key]->__get("location");
	}

	/**
	 * getCssDeclaration
	 * this function returns the font css declaration
	**/
	function getCssDeclaration($key)
	{
		return $this->fonts[$key]->__get("cssDeclaration");
	}


	/**
	 * getCssClassArray
	 * this function returns an array of css classes
	 * this function is used when displaying the fancy list of fonts in the theme customizer
	 * this function is used to send a JS file an array for the postMessage transport option in the theme customizer
	**/
	function getCssClassArray()
	{
		$result;
		foreach ($this->fonts as $key => $value) 
		{
			$result[$value->__get("title")] = $value->__get("cssClass");
		}
		return $result;
	}

	/**
	 * getTotalNumberOfFonts
	 * this function returns the total number of fonts
	**/
	function getTotalNumberOfFonts()
	{
		return count($this->fonts);
	}

	/**
	 * printThemeCustomizerCssLocations
	 * this function prints the links to the css files for the theme customizer
	**/
	function printThemeCustomizerCssLocations()
	{
		foreach ($this->fonts as $key => $value) 
		{
			?>
			<link href="http://fonts.googleapis.com/css?family=<?php echo $value->__get("location"); ?>" rel='stylesheet' type='text/css'>
			<?php
		}
	}

	/**
	 * printThemeCustomizerCssClasses
	 * this function prints the theme customizer css classes necessary to display all of the fonts
	**/
	function printThemeCustomizerCssClasses()
	{
		?>
		<style type="text/css">
			<?php
			foreach ($this->fonts as $key => $value) 
			{
				?>
				.<?php echo $value->__get("cssClass")?>{
					font-family: <?php echo $value->__get("cssDeclaration"); ?>;
				}
				<?php
			}
			?>
		</style>
		<?php 
	}

} // Font_Collection

/**
 * Google_Font_Picker_Custom_Control Class
**/
class Google_Font_Picker_Custom_Control extends WP_Customize_Control
{
	public $fonts;
	
	public function enqueue() {
		wp_enqueue_style( 'google_fonts_picker_css', get_template_directory_uri() . '/ebor_framework/css/google_font_picker_style.css' );
	}

	/**
	 * Render the content on the theme customizer page
	**/
	public function render_content()
	{
		if ( empty( $this->choices ) )
		{
			// if there are no choices then don't print anything
			return;
		}

		//print links to css files
		$this->fonts->printThemeCustomizerCssLocations();

		//print css to display individual fonts
		$this->fonts->printThemeCustomizerCssClasses();
		?>
		<label>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		</label>
		<div class="fontPickerCustomControl">
			<select <?php $this->link(); ?>>
				<?php
				foreach ( $this->choices as $value => $label )
					echo '<option value="' . esc_attr( $label ) . '"' . selected( $this->value(), $value, false ) . '>' . $label . '</option>';
				?>
			</select>
			<div class="fancyDisplay">
				<ul>
					<?php
					$cssClassArray = $this->fonts->getCssClassArray();
					foreach ($cssClassArray as $key => $value)
					{
						?>
						<li class="<?php echo $value; ?>"><?php echo $key; ?></li>
						<?php
					}
					?>
				</ul>
			</div>
		</div>
		<?php
	}
}