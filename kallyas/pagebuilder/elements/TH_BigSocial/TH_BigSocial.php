<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Big Social Blocks
 Description: Create and display a list of blocks containing social icons icons and links.
 Class: TH_BigSocial
 Category: content
 Level: 3
 Keywords: facebook, twitter, social, icons, snapchat
*/
/**
 * Class TH_BigSocial
 *
 * Create and display a list of blocks containing social icons icons and links.
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_BigSocial extends ZnElements
{
	public static function getName(){
		return __( "Big Social Blocks", 'zn_framework' );
	}

	/**
	 * This method is used to display the output of the element.
	 *
	 * @return void
	 */
	function element()
	{

		$options = $this->data['options'];

		$mainBgColor = '';

		$boxes = $this->opt('bs_iconblocks', null);

		$classes = array();
		$classes[] = $this->opt('bs_style', 'bigsocialblock--style1');
		$classes[] = $this->opt('bs_bgtype', 'type-colored');
		$classes[] = $this->data['uid'];
		$classes[] = 'bsb--theme-'.$this->opt('bs_themecolor', 'light');
		$classes[] = zn_get_element_classes($options);

		$attributes = zn_get_element_attributes($options);

		if(! empty($boxes)) {
			$i = 0;
			$classes[] = 'count-'.count($boxes);
		?>
		<div class="bigsocialblock <?php echo implode(' ', $classes); ?>" <?php echo $attributes; ?>>
			<?php
			foreach($boxes as $box):
				$icon = (isset($box['bs_icon']) ? $box['bs_icon'] : '');
				$link = (isset($box['bs_link']) ? $box['bs_link'] : '');
				$bgColor = (isset($box['bs_color']) ? $box['bs_color'] : '');
				$title = (isset($box['bs_title']) ? $box['bs_title'] : '');
				$count = (isset($box['bs_count']) ? $box['bs_count'] : '');
				$text = (isset($box['bs_ftext']) ? $box['bs_ftext'] : '');
			?>
			<div class="bigsocialblock__item" style="<?php echo $mainBgColor ? 'background-color:'.$mainBgColor:'';?>">
				<div class="bigsocialblock__bg" style="background-color:<?php echo $bgColor;?>">
					<a href="<?php echo $link['url'];?>" title="<?php echo $link['title'];?>" target="<?php echo $link['target'];?>" style="bigsocialblock__link"></a>
				</div>
				<?php if (! empty($title)) {?>
				<h4 class="bigsocialblock__title" <?php echo WpkPageHelper::zn_schema_markup('title'); ?>><?php echo $title;?></h4>
				<?php } ?>
				<?php if (! empty($count)) {?>
				<span class="bigsocialblock__count"><?php echo $count;?></span>
				<?php } ?>
				<?php if (! empty($text)) {?>
				<div class="bigsocialblock__follow"><?php echo $text;?></div>
				<?php } ?>
				<span class="bigsocialblock__social-icon" <?php echo zn_generate_icon( $icon );?> ></span>
			</div>
			<?php
			endforeach;
		?>
		</div><!-- /.bigsocialblock -->
<?php
		}
	}

	/**
	 * This method is used to add css code specific to this element
	 *
	 * @return void
	 */
	function css(){

		$uid = $this->data['uid'];
		$bs_bgtype = $this->opt('bs_bgtype', 'type-colored');
		$bs_maincolor = $this->opt('bs_maincolor');

		$css = '';

		if('type-chover' == $bs_bgtype && !empty( $bs_maincolor ) ){
			$css = ".$uid .bigsocialblock__item { background-color: $bs_maincolor; }";
		}

		return $css;
	}


	/**
	 * This method is used to retrieve the configurable options of the element.
	 * @return array The list of options that compose the element and then passed as the argument for the render() function
	 */
	function options()
	{
		$uid = $this->data['uid'];

		return array (
			'has_tabs'  => true,
			'general' => array(
				'title' => 'General options',
				'options' => array(
					array (
						"name"        => __( "Select style", 'zn_framework' ),
						"description" => __( "Select a style for the blocks", 'zn_framework' ),
						"id"          => "bs_style",
						"std"         => "bigsocialblock--style1",
						"type"        => "select",
						"options"     => array(
							"bigsocialblock--style1" => "Style 1 (default)",
							"bigsocialblock--style2" => "Style 2",
						),
						'live' => array(
							'type'      => 'class',
							'css_class' => '.'.$this->data['uid']
						)
					),
					array (
						"name"        => __( "Background Type", 'zn_framework' ),
						"description" => __( "Select the background type.", 'zn_framework' ),
						"id"          => "bs_bgtype",
						"std"         => "type-colored",
						"type"        => "select",
						"options"     => array(
							"type-colored" => "Colored",
							"type-chover" => "Colored on HOVER",
						),
						'live' => array(
							'type'      => 'class',
							'css_class' => '.'.$this->data['uid']
						)
					),
					array (
						"name"        => __( "Background Color", 'zn_framework' ),
						"description" => __( "Select the default background color of the blocks.", 'zn_framework' ),
						"id"          => "bs_maincolor",
						"std"         => "#989898",
						"type"        => "colorpicker",
						"dependency"  => array( 'element' => 'bs_bgtype', 'value'=> array('type-chover') ),
						'live' => array(
							'type'      => 'css',
							'css_class' => '.'.$this->data['uid'] .' .bigsocialblock__item',
							'css_rule'	=> 'background-color',
							'unit'		=> ''
						)
					),

					array (
						"name"        => __( "Elements color theme", 'zn_framework' ),
						"description" => __( "In case you have a dark backgound you might surely want a light themed color.", 'zn_framework' ),
						"id"          => "bs_themecolor",
						"std"         => "light",
						"type"        => "select",
						"options"     => array(
							"light" => "Light",
							"dark" => "Dark",
						),
					),
				),
			),
			'social_icons' => array(
				'title' => 'Icons options',
				'options' => array(
					array (
						"name"           => __( "Icon Blocks", 'zn_framework' ),
						"description"    => __( "Add Icon Block.", 'zn_framework' ),
						"id"             => "bs_iconblocks",
						"std"            => "",
						"type"           => "group",
						"max_items"		=> 5,
						"add_text"       => __( "Icon Block", 'zn_framework' ),
						"remove_text"    => __( "Icon Block", 'zn_framework' ),
						"group_sortable" => true,
						"element_title" => "bs_title",
						"subelements"    => array (
							array (
								"name"        => __( "Select Icon", 'zn_framework' ),
								"description" => __( "Add the partners/client/logo icon.", 'zn_framework' ),
								"id"          => "bs_icon",
								"std"         => "",
								"type"        => "icon_list",
								'class'       => 'zn_full'
							),
							array (
								"name"        => __( "Link", 'zn_framework' ),
								"description" => __( "Link the block?.", 'zn_framework' ),
								"id"          => "bs_link",
								"std"         => "",
								"type"        => "link",
								"options"     => array (
									'_self'  => __( "Same window", 'zn_framework' ),
									'_blank' => __( "New window", 'zn_framework' ),
								),
							),
							array (
								"name"        => __( "Block background color", 'zn_framework' ),
								"description" => __( "Select the background color of the block.", 'zn_framework' ),
								"id"          => "bs_color",
								"std"         => "",
								"type"        => "colorpicker",
							),
							array (
								"name"        => __( "Block Title", 'zn_framework' ),
								"description" => __( "Add a title.", 'zn_framework' ),
								"id"          => "bs_title",
								"std"         => "",
								"type"        => "text",
								"placeholder" => "eg: FACEBOOK",
							),
							array (
								"name"        => __( "Icon Block Count", 'zn_framework' ),
								"description" => __( "Add a follower/likes/recommendations count.", 'zn_framework' ),
								"id"          => "bs_count",
								"std"         => "",
								"type"        => "text",
								"placeholder" => "eg: 1500",
							),
							array (
								"name"        => __( "Text for followers", 'zn_framework' ),
								"description" => __( "The text to appear under the number of Followers. For example LIKES, RECOMMENDATIONS, FRIENDS etc.", 'zn_framework' ),
								"id"          => "bs_ftext",
								"std"         => "",
								"type"        => "text",
								"placeholder" => "eg: LIKES",
							),
						),
					)
				),
			),

			'help' => znpb_get_helptab( array(
				'video'   => 'http://support.hogash.com/kallyas-videos/#vY3eAPhmbcY',
				'docs'    => 'http://support.hogash.com/documentation/big-social-blocks/',
				'copy'    => $uid,
				'general' => true,
			))
		);
	}
}