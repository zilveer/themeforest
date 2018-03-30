/**
 * Shortcode Generator
 *
 * WARNING: This file is part of the PrimaShop parent theme.
 * Please do all modifications in the form of a child theme.
 *
 * category   PrimaShop
 * package    Javascript
 * author     PrimaThemes
 * link       http://www.primathemes.com
 */

(function() {
	tinymce.PluginManager.add('PrimaShortcodes', function( editor, url ) {
		editor.addButton( 'PrimaShortcodes', {
			title: "Insert Shortcodes",
			type: 'menubutton',
			menu: [
				{
					text: 'Homepage (Dummy)',
					onclick: function() {
						editor.insertContent('[prima_product_categories title="" numbers="3" columns="3" show_count="no" parent="0" image_width="300" image_height="175" style="boxed"]<br/><br/>[hr top="14" bottom="40"]<br/><br/>[prima_featured_products numbers="5" columns="5"]<br/><br/>[hr top="3" bottom="40"]<br/><br/>[column]<br/>[threecol_one]<br/><p style="text-align: center;">[icon name="shopping-cart" size="3" color="#0088CC"]</p><br/><br/><h2 style="text-align: center;">Easy To Use</h2><br/>Building your online store is really easy using this WordPress theme. You can install Wordpress, WooCommerce, and PrimaShop in less than one hour and you can start selling your products. You can enable/disable any elements of your shop and product page, without technical knowlegde.<br/><br/>[/threecol_one]<br/>[threecol_one]<br/><p style="text-align: center;">[icon name="thumbs-up" size="3" color="#0088CC"]</p><br/><br/><h2 style="text-align: center;">Totally Unbranded</h2><br/>Branding your online store is really easy using this WordPress theme. Our design settings uses built-in WordPress Customizer where you can change colors and backgrounds on all sections of your site with live preview. You can also upload your custom logo, login logo, admin logo, and favicon.<br/><br/>[/threecol_one]<br/>[threecol_one_last]<br/><p style="text-align: center;">[icon name="wrench" size="3" color="#0088CC"]</p><br/><br/><h2 style="text-align: center;">Highly Customizable</h2><br/>Customizing your online store is really easy using this WordPress theme. Our theme settings uses WordPress core style and easily extendable. The source code is solid, properly written, and well commented. The customization level of this theme is totally endless and is only limited to your imagination.<br/><br/>[/threecol_one_last]<br/>[/column]<br/><br/>[hr top="12" bottom="30"]<br/><br/>[prima_bestsellers_products title="Best Sellers" numbers="5" columns="5" product_button="yes" link_to_shop="yes"]<br/><br/>' );
					}
				},
				{
					text: 'Post/Product Grid',
					menu: [
						{
							text: 'Recent Posts',
							onclick: function() {
								editor.insertContent('[prima_grid_posts numbers="6" columns="3" orderby="date" order="desc" image_width="250" image_height="150" post_title="yes" limit_content="120" read_more=""]<br/><br/>');
							}
						},
						{
							text: 'Recent Posts From A Category',
							onclick: function() {
								editor.insertContent('[prima_grid_posts category="Category Name" numbers="6" orderby="date" order="desc" columns="3" image_width="250" image_height="150" post_title="yes" limit_content="120" read_more=""]<br/><br/>');
							}
						},
						{
							text: 'Recent Products',
							onclick: function() {
								editor.insertContent('[prima_products title="Recent Products" numbers="4" columns="4"]<br/><br/>');
							}
						},
						{
							text: 'Random Products',
							onclick: function() {
								editor.insertContent('[prima_products title="Random Products" numbers="4" columns="4" orderby="rand"]<br/><br/>');
							}
						},
						{
							text: 'Products In A Category',
							onclick: function() {
								editor.insertContent('[prima_products_in_category title="Products In A Category" category="Category Name" numbers="4" columns="4"]<br/><br/>');
							}
						},
						{
							text: 'Products In A Tag',
							onclick: function() {
								editor.insertContent('[prima_products_in_tag title="Products In A Tag" tag="Tag Name" numbers="4" columns="4"]<br/><br/>');
							}
						},
						{
							text: 'Featured Products',
							onclick: function() {
								editor.insertContent('[prima_featured_products title="Featured Products" numbers="4" columns="4"]<br/><br/>');
							}
						},
						{
							text: 'Onsale Products',
							onclick: function() {
								editor.insertContent('[prima_onsale_products title="On Sale Products" numbers="4" columns="4"]<br/><br/>');
							}
						},
						{
							text: 'Best Sellers Products',
							onclick: function() {
								editor.insertContent('[prima_bestsellers_products title="Best Sellers Products" numbers="4" columns="4"]<br/><br/>');
							}
						},
						{
							text: 'Top Rated Products',
							onclick: function() {
								editor.insertContent('[prima_toprated_products title="Best Sellers Products" numbers="4" columns="4"]<br/><br/>');
							}
						},
						{
							text: 'Products By IDs',
							onclick: function() {
								editor.insertContent('[prima_products_with_ids title="Products With IDs" ids="1,2,3,4" columns="4"]<br/><br/>');
							}
						},
						{
							text: 'Products With SKUs',
							onclick: function() {
								editor.insertContent('[prima_products_with_skus title="Products With SKUs" skus="SKU01,SKU02,SKU03,SKU04" numbers="4" columns="4"]<br/><br/>');
							}
						}
					]
				},
				{
					text: 'Product Grid (Custom)',
					menu: [
						{
							text: 'Recent Products',
							onclick: function() {
								editor.insertContent('[prima_products title="Recent Products" numbers="4" columns="4" orderby="date" order="desc" image_width="150" image_height="150" image_crop="yes" product_saleflash="yes" product_title="yes" product_price="yes" product_button="no"]<br/><br/>');
							}
						},
						{
							text: 'Random Products',
							onclick: function() {
								editor.insertContent('[prima_products title="Random Products" numbers="4" columns="4" orderby="rand" image_width="150" image_height="150" image_crop="yes" product_saleflash="yes" product_title="yes" product_price="yes" product_button="no"]<br/><br/>');
							}
						},
						{
							text: 'Products In A Category',
							onclick: function() {
								editor.insertContent('[prima_products_in_category title="Products In A Category" category="Category Name" numbers="4" columns="4" image_width="150" image_height="150" image_crop="yes" product_saleflash="yes" product_title="yes" product_price="yes" product_button="no"]<br/><br/>');
							}
						},
						{
							text: 'Products In A Tag',
							onclick: function() {
								editor.insertContent('[prima_products_in_tag title="Products In A Tag" tag="Tag Name" numbers="4" columns="4" image_width="150" image_height="150" image_crop="yes" product_saleflash="yes" product_title="yes" product_price="yes" product_button="no"]<br/><br/>');
							}
						},
						{
							text: 'Featured Products',
							onclick: function() {
								editor.insertContent('[prima_featured_products title="Featured Products" numbers="4" columns="4" image_width="150" image_height="150" image_crop="yes" product_saleflash="yes" product_title="yes" product_price="yes" product_button="no"]<br/><br/>');
							}
						},
						{
							text: 'Onsale Products',
							onclick: function() {
								editor.insertContent('[prima_onsale_products title="On Sale Products" numbers="4" columns="4" image_width="150" image_height="150" image_crop="yes" product_saleflash="yes" product_title="yes" product_price="yes" product_button="no"]<br/><br/>');
							}
						},
						{
							text: 'Best Sellers Products',
							onclick: function() {
								editor.insertContent('[prima_bestsellers_products title="Best Sellers Products" numbers="4" columns="4" image_width="150" image_height="150" image_crop="yes" product_saleflash="yes" product_title="yes" product_price="yes" product_button="no"]<br/><br/>');
							}
						},
						{
							text: 'Top Rated Products',
							onclick: function() {
								editor.insertContent('[prima_toprated_products title="Best Sellers Products" numbers="4" columns="4" image_width="150" image_height="150" image_crop="yes" product_saleflash="yes" product_title="yes" product_price="yes" product_button="no"]<br/><br/>');
							}
						},
						{
							text: 'Products By IDs',
							onclick: function() {
								editor.insertContent('[prima_products_with_ids title="Products With IDs" ids="1,2,3,4" columns="4" image_width="150" image_height="150" image_crop="yes" product_saleflash="yes" product_title="yes" product_price="yes" product_button="no"]<br/><br/>');
							}
						},
						{
							text: 'Products With SKUs',
							onclick: function() {
								editor.insertContent('[prima_products_with_skus title="Products With SKUs" skus="SKU01,SKU02,SKU03,SKU04" numbers="4" columns="4" image_width="150" image_height="150" image_crop="yes" product_saleflash="yes" product_title="yes" product_price="yes" product_button="no"]<br/><br/>');
							}
						}
					]
				},
				{
					text: 'Product Categories/Attributes',
					menu: [
						{
							text: 'Product Categories',
							onclick: function() {
								editor.insertContent('[prima_product_categories title="Product Categories" numbers="" columns="4"]<br/><br/>');
							}
						},
						{
							text: 'Product Categories (show 4 only)',
							onclick: function() {
								editor.insertContent('[prima_product_categories title="Product Categories" numbers="4" columns="4"]<br/><br/>');
							}
						},
						{
							text: 'Product Categories (Complete Options)',
							onclick: function() {
								editor.insertContent('[prima_product_categories title="Product Categories" numbers="" columns="4" image_width="150" image_height="150" image_crop="yes" show_title="yes" show_count="yes"]<br/><br/>');
							}
						},
						{
							text: 'Top Level Product Categories',
							onclick: function() {
								editor.insertContent('[prima_product_categories title="Top Product Categories" parent="0" numbers="" columns="4"]<br/><br/>');
							}
						},
						{
							text: 'Child Product Categories (Parent ID=1)',
							onclick: function() {
								editor.insertContent('[prima_product_categories title="Child Product Categories (Parent ID=1)" parent="1" numbers="" columns="4"]<br/><br/>');
							}
						},
						{
							text: 'Product Attributes',
							onclick: function() {
								editor.insertContent('[prima_product_attributes title="Product Attributes" attribute="replace_with_attribute_slug" numbers="" columns="4"]<br/><br/>');
							}
						},
						{
							text: 'Product Attributes (show 4 only)',
							onclick: function() {
								editor.insertContent('[prima_product_attributes title="Product Attributes" attribute="replace_with_attribute_slug" numbers="4" columns="4"]<br/><br/>');
							}
						},
						{
							text: 'Product Attributes (Custom Image Size)',
							onclick: function() {
								editor.insertContent('[prima_product_attributes title="Product Attributes" attribute="replace_with_attribute_slug" numbers="" columns="4" image_width="150" image_height="150" image_crop="yes"]<br/><br/>');
							}
						},
						{
							text: 'Product Attributes (Complete Options)',
							onclick: function() {
								editor.insertContent('[prima_product_attributes title="Product Attributes" attribute="replace_with_attribute_slug" numbers="" columns="4" image_width="150" image_height="150" image_crop="yes" show_title="yes" show_count="yes"]<br/><br/>');
							}
						}
					]
				},
				{
					text: 'Post/Product Slider',
					menu: [
						{
							text: 'Recent Posts',
							onclick: function() {
								editor.insertContent('[prima_slider_posts numbers="5" orderby="date" order="desc" image_width="600" image_height="300" post_title="yes" animation="slide" speed="4000" duration="600" nav_direction="yes" nav_control="yes"]<br/><br/>');
							}
						},
						{
							text: 'Recent Posts (Thumbnail Navigation)',
							onclick: function() {
								editor.insertContent('[prima_slider_posts numbers="5" orderby="date" order="desc" image_width="600" image_height="300" post_title="yes" animation="slide" speed="4000" duration="600" nav_direction="yes" nav_control="thumbnails"]<br/><br/>');
							}
						},
						{
							text: 'Recent Posts From A Category',
							onclick: function() {
								editor.insertContent('[prima_slider_posts category="Category Name" numbers="5" orderby="date" order="desc" image_width="600" image_height="300" post_title="yes" animation="slide" speed="4000" duration="600" nav_direction="yes" nav_control="yes"]<br/><br/>');
							}
						},
						{
							text: 'Posts By IDs',
							onclick: function() {
								editor.insertContent('[prima_slider_posts ids="1,2,3" image_width="600" image_height="300" post_title="yes" animation="slide" speed="4000" duration="600" nav_direction="yes" nav_control="yes"]<br/><br/>');
							}
						},
						{
							text: 'Recent Products',
							onclick: function() {
								editor.insertContent('[prima_slider_products numbers="5" orderby="date" order="desc" image_width="400" image_height="300" product_saleflash="yes" product_price="yes" product_summary="yes" product_button="yes" button_text="" animation="slide" speed="4000" duration="600" nav_direction="yes" nav_control="yes"]<br/><br/>');
							}
						},
						{
							text: 'Recent Products In A Category',
							onclick: function() {
								editor.insertContent('[prima_slider_products mode="category" orderby="date" order="desc" name="Category Name" numbers="5" image_width="400" image_height="300" product_saleflash="yes" product_price="yes" product_summary="yes" product_button="yes" button_text="" animation="slide" speed="4000" duration="600" nav_direction="yes" nav_control="yes"]<br/><br/>');
							}
						},
						{
							text: 'Recent Products In A Tag',
							onclick: function() {
								editor.insertContent('[prima_slider_products mode="tag" name="Tag Name" numbers="5" orderby="date" order="desc" image_width="400" image_height="300" product_saleflash="yes" product_price="yes" product_summary="yes" product_button="yes" button_text="" animation="slide" speed="4000" duration="600" nav_direction="yes" nav_control="yes"]<br/><br/>');
							}
						},
						{
							text: 'Featured Products',
							onclick: function() {
								editor.insertContent('[prima_slider_products mode="featured" numbers="5" image_width="400" image_height="300" product_saleflash="yes" product_price="yes" product_summary="yes" product_button="yes" button_text="" animation="slide" speed="4000" duration="600" nav_direction="yes" nav_control="yes"]<br/><br/>');
							}
						},
						{
							text: 'Onsale Products',
							onclick: function() {
								editor.insertContent('[prima_slider_products mode="onsale" numbers="5" image_width="400" image_height="300" product_saleflash="yes" product_price="yes" product_summary="yes" product_button="yes" button_text="" animation="slide" speed="4000" duration="600" nav_direction="yes" nav_control="yes"]<br/><br/>');
							}
						},
						{
							text: 'Best Sellers Products',
							onclick: function() {
								editor.insertContent('[prima_slider_products mode="bestsellers" numbers="5" image_width="400" image_height="300" product_saleflash="yes" product_price="yes" product_summary="yes" product_button="yes" button_text="" animation="slide" speed="4000" duration="600" nav_direction="yes" nav_control="yes"]<br/><br/>');
							}
						},
						{
							text: 'Top Rated Products',
							onclick: function() {
								editor.insertContent('[prima_slider_products mode="toprated" numbers="5" image_width="400" image_height="300" product_saleflash="yes" product_price="yes" product_summary="yes" product_button="yes" button_text="" animation="slide" speed="4000" duration="600" nav_direction="yes" nav_control="yes"]<br/><br/>');
							}
						},
						{
							text: 'Products By IDs',
							onclick: function() {
								editor.insertContent('[prima_slider_products mode="ids" ids="1,2,3" image_width="400" image_height="300" product_saleflash="yes" product_price="yes" product_summary="yes" product_button="yes" button_text="" animation="slide" speed="4000" duration="600" nav_direction="yes" nav_control="yes"]<br/><br/>');
							}
						}
					]
				},
				{
					text: 'Post/Product Carousel',
					menu: [
						{
							text: 'Recent Posts',
							onclick: function() {
								editor.insertContent('[prima_carousel_posts numbers="10" orderby="date" order="desc" image_width="150" image_height="150" post_title="yes" limit_content="120" min_items="2" max_items="4" move="1" animation="slide" speed="4000" duration="600" nav_direction="yes" ]<br/><br/>');
							}
						},
						{
							text: 'Recent Posts From A Category',
							onclick: function() {
								editor.insertContent('[prima_carousel_posts category="Category Name" numbers="10" orderby="date" order="desc" image_width="150" image_height="150" post_title="yes" limit_content="120" min_items="2" max_items="4" move="1" animation="slide" speed="4000" duration="600" nav_direction="yes" ]<br/><br/>');
							}
						},
						{
							text: 'Posts By IDs',
							onclick: function() {
								editor.insertContent('[prima_carousel_posts ids="1,2,3" image_width="150" image_height="150" post_title="yes" limit_content="120" min_items="2" max_items="4" move="1" animation="slide" speed="4000" duration="600" nav_direction="yes" ]<br/><br/>');
							}
						},
						{
							text: 'Recent Products',
							onclick: function() {
								editor.insertContent('[prima_carousel_products numbers="10" image_width="150" image_height="150"  min_items="2" max_items="4" move="1" product_saleflash="yes" product_title="yes" product_price="yes" product_button="yes" button_text="" animation="slide" speed="4000" duration="600" nav_direction="yes"]<br/><br/>');
							}
						},
						{
							text: 'Recent Products In A Category',
							onclick: function() {
								editor.insertContent('[prima_carousel_products mode="category" name="Category Name" numbers="10" image_width="150" image_height="150"  min_items="2" max_items="4" move="1" product_saleflash="yes" product_title="yes" product_price="yes" product_button="yes" button_text="" animation="slide" speed="4000" duration="600" nav_direction="yes"]<br/><br/>');
							}
						},
						{
							text: 'Recent Products In A Tag',
							onclick: function() {
								editor.insertContent('[prima_carousel_products mode="tag" name="Tag Name" numbers="10" image_width="150" image_height="150"  min_items="2" max_items="4" move="1" product_saleflash="yes" product_title="yes" product_price="yes" product_button="yes" button_text="" animation="slide" speed="4000" duration="600" nav_direction="yes"]<br/><br/>');
							}
						},
						{
							text: 'Featured Products',
							onclick: function() {
								editor.insertContent('[prima_carousel_products mode="featured" numbers="10" image_width="150" image_height="150"  min_items="2" max_items="4" move="1" product_saleflash="yes" product_title="yes" product_price="yes" product_button="yes" button_text="" animation="slide" speed="4000" duration="600" nav_direction="yes"]<br/><br/>');
							}
						},
						{
							text: 'Onsale Products',
							onclick: function() {
								editor.insertContent('[prima_carousel_products mode="onsale" numbers="10" image_width="150" image_height="150"  min_items="2" max_items="4" move="1" product_saleflash="yes" product_title="yes" product_price="yes" product_button="yes" button_text="" animation="slide" speed="4000" duration="600" nav_direction="yes"]<br/><br/>');
							}
						},
						{
							text: 'Best Sellers Products',
							onclick: function() {
								editor.insertContent('[prima_carousel_products mode="bestsellers" numbers="10" image_width="150" image_height="150"  min_items="2" max_items="4" move="1" product_saleflash="yes" product_title="yes" product_price="yes" product_button="yes" button_text="" animation="slide" speed="4000" duration="600" nav_direction="yes"]<br/><br/>');
							}
						},
						{
							text: 'Top Rated Products',
							onclick: function() {
								editor.insertContent('[prima_carousel_products mode="toprated" numbers="10" image_width="150" image_height="150"  min_items="2" max_items="4" move="1" product_saleflash="yes" product_title="yes" product_price="yes" product_button="yes" button_text="" animation="slide" speed="4000" duration="600" nav_direction="yes"]<br/><br/>');
							}
						},
						{
							text: 'Products By IDs',
							onclick: function() {
								editor.insertContent('[prima_carousel_products mode="ids" ids="1,2,3" image_width="150" image_height="150"  min_items="2" max_items="4" move="1" product_saleflash="yes" product_title="yes" product_price="yes" product_button="yes" button_text="" animation="slide" speed="4000" duration="600" nav_direction="yes"]<br/><br/>');
							}
						}
					]
				},
				{
					text: 'Columns',
					menu: [
						{
							text: '2 Columns (1:1)',
							onclick: function() {
								editor.insertContent("[column]<br/>[twocol_one] <br/><br/>First column content<br/><br/> [/twocol_one]<br/>[twocol_one_last]<br/><br/> Second column content<br/><br/> [/twocol_one_last]<br/>[/column]");
							}
						},
						{
							text: '2 Columns (1:1)',
							onclick: function() {
								editor.insertContent("2 Columns (1:1)","[column]<br/>[threecol_two] <br/><br/>First column content<br/><br/> [/threecol_two]<br/>[threecol_one_last] <br/><br/>Second column content<br/><br/> [/threecol_one_last]<br/>[/column]");
							}
						},
						{
							text: '2 Columns (1:2)',
							onclick: function() {
								editor.insertContent("[column]<br/>[threecol_one] <br/><br/>First column content<br/><br/> [/threecol_one]<br/>[threecol_two_last] <br/><br/>Second column content<br/><br/> [/threecol_two_last]<br/>[/column]");
							}
						},
						{
							text: '3 Columns (1:1:1)',
							onclick: function() {
								editor.insertContent("[column]<br/>[threecol_one] <br/><br/>First column content<br/><br/> [/threecol_one]<br/>[threecol_one] <br/><br/>Second column content<br/><br/> [/threecol_one]<br/>[threecol_one_last] <br/><br/>Third column content<br/><br/> [/threecol_one_last]<br/>[/column]");
							}
						},
						{
							text: '3 Columns (2:1:1)',
							onclick: function() {
								editor.insertContent("[column]<br/>[fourcol_two] <br/><br/>First column content<br/><br/> [/fourcol_two]<br/>[fourcol_one] <br/><br/>Second column content<br/><br/> [/fourcol_one]<br/>[fourcol_one_last] <br/><br/>Third column content<br/><br/> [/fourcol_one_last]<br/>[/column]");
							}
						},
						{
							text: '3 Columns (1:2:1)',
							onclick: function() {
								editor.insertContent("[column]<br/>[fourcol_one] <br/><br/>First column content<br/><br/> [/fourcol_one]<br/>[fourcol_two] <br/><br/>Second column content<br/><br/> [/fourcol_two]<br/>[fourcol_one_last] <br/><br/>Third column content<br/><br/> [/fourcol_one_last]<br/>[/column]");
							}
						},
						{
							text: '3 Columns (1:1:2)',
							onclick: function() {
								editor.insertContent("[column]<br/>[fourcol_one] <br/><br/>First column content<br/><br/> [/fourcol_one]<br/>[fourcol_one] <br/><br/>Second column content<br/><br/> [/fourcol_one]<br/>[fourcol_two_last] <br/><br/>Third column content<br/><br/> [/fourcol_two_last]<br/>[/column]");
							}
						},
						{
							text: '4 Columns',
							onclick: function() {
								editor.insertContent("[column]<br/>[fourcol_one] <br/><br/>First column content<br/><br/> [/fourcol_one]<br/>[fourcol_one] <br/><br/>Second column content<br/><br/> [/fourcol_one]<br/>[fourcol_one] <br/><br/>Third column content<br/><br/> [/fourcol_one]<br/>[fourcol_one_last] <br/><br/>Fourth column content<br/><br/> [/fourcol_one_last]<br/>[/column]");
							}
						},
						{
							text: '5 Columns',
							onclick: function() {
								editor.insertContent("[column]<br/>[fivecol_one] <br/><br/>First column content<br/><br/> [/fivecol_one]<br/>[fivecol_one] <br/><br/>Second column content<br/><br/> [/fivecol_one]<br/>[fivecol_one] <br/><br/>Third column content<br/><br/> [/fivecol_one]<br/>[fivecol_one] <br/><br/>Fourth column content<br/><br/> [/fivecol_one]<br/>[fivecol_one_last] <br/><br/>Fifth column content<br/><br/> [/fivecol_one_last]<br/>[/column]");
							}
						},
						{
							text: '6 Columns',
							onclick: function() {
								editor.insertContent("[column]<br/>[sixcol_one] <br/><br/>First column content<br/><br/> [/sixcol_one]<br/>[sixcol_one] <br/><br/>Second column content<br/><br/> [/sixcol_one]<br/>[sixcol_one] <br/><br/>Third column content<br/><br/> [/sixcol_one]<br/>[sixcol_one] <br/><br/>Fourth column content<br/><br/> [/sixcol_one]<br/>[sixcol_one] <br/><br/>Fifth column content<br/><br/> [/sixcol_one]<br/>[sixcol_one_last] <br/><br/>Sixth column content<br/><br/> [/sixcol_one_last]<br/>[/column]");
							}
						}
					]
				},
				{
					text: 'Typography',
					menu: [
						{
							text: 'Quote',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Insert Quote Shortcode',
									body: [
										{
											type: 'textbox',
											name: 'quoteText',
											label: 'Text',
											value: 'Please insert your content here',
											multiline: true,
											minWidth: 300,
											minHeight: 100
										},
										{
											type: 'listbox',
											name: 'quoteStyle',
											label: 'Style',
											'values': [
												{text: 'default', value: 'default'},
												{text: 'boxed', value: 'boxed'}
											]
										},
										{
											type: 'listbox',
											name: 'quoteFloat',
											label: 'Float',
											'values': [
												{text: 'none', value: 'none'},
												{text: 'left', value: 'left'},
												{text: 'right', value: 'right'}
											]
										}
									],
									onsubmit: function( e ) {
										editor.insertContent( '[quote style="' + e.data.quoteStyle + '" float="' + e.data.quoteFloat + '"] ' + e.data.quoteText + ' [/quote]<br/><br/><br/>');
									}
								});
							}
						},
						{
							text: 'Box',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Insert Box Shortcode',
									body: [
										{
											type: 'textbox',
											name: 'boxText',
											label: 'Text',
											value: 'Please insert your content here',
											multiline: true,
											minWidth: 300,
											minHeight: 100
										},
										{
											type: 'listbox',
											name: 'boxColor',
											label: 'Color',
											'values': [
												{text: 'default', value: 'default'},
												{text: 'blue', value: 'blue'},
												{text: 'red', value: 'red'},
												{text: 'green', value: 'green'},
												{text: 'yellow', value: 'yellow'}
											]
										},
										{
											type: 'listbox',
											name: 'boxFloat',
											label: 'Float',
											'values': [
												{text: 'none', value: 'none'},
												{text: 'left', value: 'left'},
												{text: 'right', value: 'right'}
											]
										}
									],
									onsubmit: function( e ) {
										editor.insertContent( '[box color="' + e.data.boxColor + '" float="' + e.data.boxFloat + '"] ' + e.data.boxText + ' [/box]<br/><br/><br/>');
									}
								});
							}
						},
						{
							text: 'Button',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Insert Button Shortcode',
									body: [
										{
											type: 'textbox',
											name: 'buttonText',
											label: 'Text',
											value: 'Button Text'
										},
										{
											type: 'textbox',
											name: 'buttonLink',
											label: 'Link',
											value: '#'
										},
										{
											type: 'listbox',
											name: 'buttonColor',
											label: 'Color',
											'values': [
												{text: 'default', value: 'default'},
												{text: 'blue', value: 'blue'},
												{text: 'red', value: 'red'},
												{text: 'green', value: 'green'},
												{text: 'yellow', value: 'yellow'},
												{text: 'black', value: 'black'}
											]
										},
										{
											type: 'listbox',
											name: 'buttonSize',
											label: 'Size',
											'values': [
												{text: 'default', value: 'normal'},
												{text: 'large', value: 'large'},
												{text: 'extra large', value: 'xl'}
											]
										}
									],
									onsubmit: function( e ) {
										editor.insertContent( '[button link="' + e.data.buttonLink + '" color="' + e.data.buttonColor + '" size="' + e.data.buttonSize + '"] ' + e.data.buttonText + ' [/button]<br/><br/><br/>');
									}
								});
							}
						},
						{
							text: 'Toogle',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Insert Toogle Shortcode',
									body: [
										{
											type: 'textbox',
											name: 'toggleTitle',
											label: 'Text',
											value: 'Click here to show/hide the content',
										},
										{
											type: 'textbox',
											name: 'toggleText',
											label: 'Text',
											value: 'Please insert your content here',
											multiline: true,
											minWidth: 300,
											minHeight: 100
										},
										{
											type: 'listbox',
											name: 'toggleStatus',
											label: 'Status',
											'values': [
												{text: 'close', value: 'close'},
												{text: 'open', value: 'open'}
											]
										},
										{
											type: 'listbox',
											name: 'toggleAccordion',
											label: 'Accordion',
											'values': [
												{text: 'no', value: 'no'},
												{text: 'yes', value: 'yes'},
											]
										}
									],
									onsubmit: function( e ) {
										editor.insertContent( '[toggle title="' + e.data.toggleTitle + '" status="' + e.data.toggleStatus + '" accordion="' + e.data.toggleAccordion + '"] ' + e.data.toggleText + ' [/toggle]<br/><br/><br/>');
									}
								});
							}
						},
						{
							text: "Tabs (2)",
							onclick: function() {
								editor.insertContent("[tabs]<br/>[tab title=\"First Tab\"]<br/><br/>First Tab content goes here.<br/><br/>[/tab]<br/>[tab title=\"Second Tab\"]<br/><br/>Second Tab content goes here.<br/><br/>[/tab]<br/>[/tabs]<br/><br/><br/>");
							}
						},
						{
							text: "Tabs (3)",
							onclick: function() {
								editor.insertContent("[tabs]<br/>[tab title=\"First Tab\"]<br/><br/>First Tab content goes here.<br/><br/>[/tab]<br/>[tab title=\"Second Tab\"]<br/><br/>Second Tab content goes here.<br/><br/>[/tab]<br/>[tab title=\"Third Tab\"]<br/><br/>Third Tab content goes here.<br/><br/>[/tab]<br/>[/tabs]<br/><br/><br/>");
							}
						},
						{
							text: "Tabs (4)",
							onclick: function() {
								editor.insertContent("4 Tabs Content","[tabs]<br/>[tab title=\"First Tab\"]<br/><br/>First Tab content goes here.<br/><br/>[/tab]<br/>[tab title=\"Second Tab\"]<br/><br/>Second Tab content goes here.<br/><br/>[/tab]<br/>[tab title=\"Third Tab\"]<br/><br/>Third Tab content goes here.<br/><br/>[/tab]<br/>[tab title=\"Fourth Tab\"]<br/><br/>Fourth Tab content goes here.<br/><br/>[/tab]<br/>[/tabs]<br/><br/><br/>");
							}
						},
						{
							text: 'Heading',
							onclick: function() {
								editor.insertContent("[heading]Your heading text[/heading]<br/><br/><br/>");
							}
						},
						{
							text: 'Highlight',
							onclick: function() {
								editor.insertContent("You could edit this to put [highlight]important information[/highlight] on this page.");
							}
						},
						{
							text: "Dropcap",
							onclick: function() {
								editor.insertContent("[dropcap]T[/dropcap]his is an example of a dropcap text.");
							}
						}
					]
				},
				{
					text: 'Contact Form',
					onclick: function() {
						editor.windowManager.open( {
							title: 'Insert Contact Form Shortcode',
							body: [
								{
									type: 'textbox',
									name: 'contactEmail',
									label: 'Email Adress',
									value: 'yourname@yourdomain.com'
								},
								{
									type: 'textbox',
									name: 'contactSubject',
									label: 'Email Subject',
									value: 'Message via the contact form'
								},
								{
									type: 'listbox',
									name: 'contactSendcopy',
									label: 'Send Copy Option',
									'values': [
										{text: 'yes', value: 'yes'},
										{text: 'no', value: 'no'}
									]
								},
								{
									type: 'textbox',
									name: 'contactButton',
									label: 'Button Text',
									value: 'Submit'
								},
								{
									type: 'textbox',
									name: 'contactQuestion',
									label: 'Simple Quiz - Question',
									value: ''
								},
								{
									type: 'textbox',
									name: 'contactAnswer',
									label: 'Simple Quiz - Answer',
									value: ''
								}
							],
							onsubmit: function( e ) {
								var contactOutput = '[prima_contact_form email="' + e.data.contactEmail + '" subject="' + e.data.contactSubject + '" sendcopy="' + e.data.contactSendcopy + '" button_text="' + e.data.contactButton + '"';
								if ( e.data.contactQuestion && e.data.contactAnswer ) {
									contactOutput = contactOutput + ' question="' + e.data.contactQuestion + '" answer="' + e.data.contactAnswer + '"';
								}
								contactOutput = contactOutput + ']<br/><br/><br/>';
								editor.insertContent( contactOutput );
							}
						});
					}
				},
				{
					text: 'Google Map',
					onclick: function() {
						editor.windowManager.open( {
							title: 'Insert Google Map Shortcode',
							body: [
								{
									type: 'textbox',
									name: 'gmapLatitude',
									label: 'Latitude',
									value: '-37.82'
								},
								{
									type: 'textbox',
									name: 'gmapLongitude',
									label: 'Longitude',
									value: '144.97'
								},
								{
									type: 'textbox',
									name: 'gmapWidth',
									label: 'Width (leave it empty for 100% width)',
									value: ''
								},
								{
									type: 'textbox',
									name: 'gmapHeight',
									label: 'Height',
									value: '300'
								},
								{
									type: 'textbox',
									name: 'gmapZoom',
									label: 'Zoom',
									value: '15'
								},
								{
									type: 'listbox',
									name: 'gmapMarker',
									label: 'Marker',
									'values': [
										{text: 'yes', value: 'yes'},
										{text: 'no', value: 'no'}
									]
								},
								{
									type: 'listbox',
									name: 'gmapType',
									label: 'Map Type',
									'values': [
										{text: 'roadmap', value: 'roadmap'},
										{text: 'satellite', value: 'satellite'},
										{text: 'hybrid', value: 'hybrid'},
										{text: 'terrain', value: 'terrain'}
									]
								},
								{
									type: 'listbox',
									name: 'gmapScrollwheel',
									label: 'Scroll Wheel',
									'values': [
										{text: 'no', value: 'no'},
										{text: 'yes', value: 'yes'}
									]
								}
							],
							onsubmit: function( e ) {
								editor.insertContent( '[prima_googlemaps latitude="' + e.data.gmapLatitude + '" longitude="' + e.data.gmapLongitude + '" width="' + e.data.gmapWidth + '" height="' + e.data.gmapHeight + '" zoom="' + e.data.gmapZoom + '" marker="' + e.data.gmapMarker + '" type="' + e.data.gmapType + '" scrollwheel="' + e.data.gmapScrollwheel + '"]<br/><br/><br/>' );
							}
						});
					}
				},
				{
					text: 'Vimeo',
					onclick: function() {
						editor.windowManager.open( {
							title: 'Insert Vimeo Shortcode',
							body: [
								{
									type: 'textbox',
									name: 'vimeoID',
									label: 'Video ID',
									value: '30153918'
								},
								{
									type: 'textbox',
									name: 'vimeoWidth',
									label: 'Width',
									value: '700'
								},
								{
									type: 'textbox',
									name: 'vimeoHeight',
									label: 'Height',
									value: '394'
								}
							],
							onsubmit: function( e ) {
								editor.insertContent( '[prima_vimeo id="' + e.data.vimeoID + '" width="' + e.data.vimeoWidth + '" height="' + e.data.vimeoHeight + '"]<br/><br/><br/>' );
							}
						});
					}
				},
				{
					text: 'Youtube',
					onclick: function() {
						editor.windowManager.open( {
							title: 'Insert Youtube Shortcode',
							body: [
								{
									type: 'textbox',
									name: 'youtubeID',
									label: 'Video ID',
									value: 'chTkQgQKotA'
								},
								{
									type: 'textbox',
									name: 'youtubeWidth',
									label: 'Width',
									value: '700'
								},
								{
									type: 'textbox',
									name: 'youtubeHeight',
									label: 'Height',
									value: '386'
								}
							],
							onsubmit: function( e ) {
								editor.insertContent( '[prima_youtube id="' + e.data.youtubeID + '" width="' + e.data.youtubeWidth + '" height="' + e.data.youtubeHeight + '"]<br/><br/><br/>' );
							}
						});
					}
				},
				{
					text: 'FontAwesome Icon',
					onclick: function() {
						editor.windowManager.open( {
							title: 'Insert FontAwesome Icon Shortcode',
							body: [
								{
									type: 'textbox',
									name: 'iconName',
									label: 'Icon Name',
									value: 'thumbs-up'
								},
								{
									type: 'listbox',
									name: 'iconSize',
									label: 'Icon Size',
									'values': [
										{text: '1', value: '1'},
										{text: '2', value: '2'},
										{text: '3', value: '3'},
										{text: '4', value: '4'},
										{text: '5', value: '5'}
									]
								},
								{
									type: 'textbox',
									name: 'iconColor',
									label: 'Icon Color',
									value: ''
								}
							],
							onsubmit: function( e ) {
								editor.insertContent( '[icon name="' + e.data.iconName + '" size="' + e.data.iconSize + '" color="' + e.data.iconColor + '" ]<br/>' );
							}
						});
					}
				}
			]
		});
	});
})();