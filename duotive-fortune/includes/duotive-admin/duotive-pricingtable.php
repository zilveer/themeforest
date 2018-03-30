<?php

	function table_admin_menu() 
	{
		add_submenu_page( 'duotive-panel', 'Duotive Pricing', 'Pricing', 'manage_options', 'duotive-pricing-table', 'table_page');
	}

	function table_page() 
	{
	
?>  
<div class="wrap">
	<?php $warnings = dt_AdminWarnings(); ?>
    <?php if ($warnings != '' ): ?>
        <div class="page-error page-error-extra-margin">
            <?php echo $warnings; ?>
        </div>
    <?php endif; ?>
    <div id="duotive-logo"><span class="color">Duotive</span> Admin Panel <sup>v2</sup></div>
    <div id="duotive-main-menu">
        <ul>
            <li><a href="admin.php?page=duotive-panel">General settings</a></li>
            <li><a href="admin.php?page=duotive-front-page-manager">Frontpage</a></li>
            <li><a href="admin.php?page=duotive-slider">Slideshow</a></li>
            <li><a href="admin.php?page=duotive-sidebars">Sidebars</a></li>
			<li><a href="admin.php?page=duotive-portfolios">Portfolios</a></li>
			<li><a href="admin.php?page=duotive-blogs">Blogs</a></li> 
			<li class="active"><a href="admin.php?page=duotive-pricing">Pricing</a></li> 
            <li><a href="admin.php?page=duotive-contact">Contact page</a></li>
            <li><a href="admin.php?page=duotive-language">Language</a></li>                                                                                           
        </ul>
    </div>
    <div id="duotive-admin-panel">
    	<h3>Pricing</h3>
		<?php if ( !isset($_POST['pricing_table_colnr_processor']) ): ?>
			<?php if ( !isset($_POST['pricing_table_colnr']) ): ?>
                <div id="settings" class="ui-tabs-panel">
                    <form method="POST" action="" class="transform">
                        <div class="table-row clearfix">     
                            <label for="pricing_table_type">Choose template:</label>
                            <select name="pricing_table_type">
                            	<option value="table">Table</option>
                                <option value="box">Box</option>
                            </select>
                        </div>
                        <div class="table-row clearfix">     
                            <label for="pricing_table_colnr">Number of products:</label>
                            <input type="text" size="10" name="pricing_table_colnr"/>
                            <img class="hint-icon" title="How many products would you like to list. If you choose the 'Table' template do not exceed 6 products." src="<?php echo get_template_directory_uri(); ?>/includes/duotive-admin-skin/images/hint-icon.png" />
                        </div>
                        <div class="table-row table-row-last clearfix">
                            <input type="submit" name="search" value="Create table" class="button" />
                            <input id="setting-up-save" type="submit" name="search" value="Create table" class="button" />	
                        </div>	                                    
                    </form>                	   
                </div> 
            <?php else: ?>
                <?php $pricing_table_colnr = $_POST['pricing_table_colnr']; ?>
                <?php $pricing_table_type = $_POST['pricing_table_type']; ?>   
                <div id="create-table" class="ui-tabs-panel">
                    <form method="POST" action="" class="transform">
                        <input type="hidden" value="<?php echo $pricing_table_colnr; ?>" name="pricing_table_colnr_processor" />
                        <input type="hidden" value="<?php echo $pricing_table_type; ?>" name="pricing_table_type" />                        
                        <div class="table-rows">
							<?php for($i = 0; $i<$pricing_table_colnr; $i++): ?>
  							<div class="table-row-wrapper">
                                <div class="table-row clearfix table-heading-row">  
                                    <div class="pricing-table-heading">Product name:</div>
                                    <input type="text" class="fullwidth" size="50" name="product_name_<?php echo $i; ?>"/>
                                </div>                              
                                <div class="table-row clearfix">  
                                    <div class="pricing-table-heading">Featured product?</div>
                                    <select name="product_featured_<?php echo $i; ?>">
                                        <option value="no">No</option>
                                        <option value="yes">Yes</option>
                                    </select>
                                </div>                          
                                <div class="table-row clearfix">  
                                    <div class="pricing-table-heading">Product price:</div>
                                    <input type="text" size="30" name="product_price_<?php echo $i; ?>"/>
                                </div>
                                <div class="table-row clearfix">  
                                    <div class="pricing-table-heading">Product image:</div>
                                    <input type="text" class="fullwidth" size="50" name="product_image_<?php echo $i; ?>"/>
                                </div>              
                                <div class="table-row clearfix">  
                                    <div class="pricing-table-heading">Product specifications:</div>
                                    <textarea class="fullwidth" name="product_specifications_<?php echo $i; ?>" cols="50" rows="4"></textarea>
                                </div>
                                <div class="table-row clearfix">  
                                    <div class="pricing-table-heading">Product URL:</div>
                                    <input type="text" class="fullwidth" size="50" name="product_url_<?php echo $i; ?>"/>
                                </div>
                                <div class="table-row clearfix table-row-beforelast">  
                                    <div class="pricing-table-heading">Product button text:</div>
                                    <input type="text" size="30" name="product_button_<?php echo $i; ?>"/>
                                </div> 
                            </div>                                                                                  
                            <?php endfor; ?>
                        </div>
                        <div class="table-row table-row-last clearfix">
                            <input type="submit" name="search" value="Get code" class="button" />
                        </div>	                                                                                                       
                    </form>
                </div>
            <?php endif; ?>
		<?php else: ?>
            <?php 
				
				$pricing_table_type = $_POST['pricing_table_type'];
				if ( $pricing_table_type == 'table' ) :
					$pricing_table_colnr_processor = $_POST['pricing_table_colnr_processor'];
					$table = '<div class="dt-pricing clearfix">';
						for($i = 0; $i<$pricing_table_colnr_processor; $i++):
							$featured = '';
							$featured_class = '';
							$featured = $_POST['product_featured_'.$i];
							if ( $featured == 'yes' ) $featured_class = ' dt-pricing-column-featured';
							$table .= '<div class="dt-pricing-column'.$featured_class.'">';
								$table .= '<h4>'.$_POST['product_name_'.$i].'</h4>';
								$table .= '<span class="price">'.$_POST['product_price_'.$i].'</span>';							
								if ( $_POST['product_image_'.$i] != '' ) $table .= '<br /><img src="'.trim($_POST['product_image_'.$i]).'" />';	
								if ( $_POST['product_specifications_'.$i] != '' ) :
									$specs = '';							
									$specs = explode("\n", $_POST['product_specifications_'.$i]);
									$table .= '<ul>';
										foreach($specs as $spec):									
											$table .= '<li>'.trim($spec).'</li>';																					
										endforeach;					
									$table .= '</ul>';
								endif;
								if ( $_POST['product_url_'.$i] != '' ): 
									$table .= '<a href="'.$_POST['product_url_'.$i].'" class="more-link"><span><span>'.$_POST['product_button_'.$i].'</span></span></a>';
								endif;
							$table .= '</div>';						
						endfor;
					$table .= '</div>';
				endif;
				if ( $pricing_table_type == 'box' ) :
					$pricing_table_colnr_processor = $_POST['pricing_table_colnr_processor'];
					for($i = 0; $i<$pricing_table_colnr_processor; $i++):
						$featured = '';
						$featured_class = '';
						$featured = $_POST['product_featured_'.$i];
						if ( $featured == 'yes' ) $featured_class = ' dt-pricing-box-featured';						
						$table .= '<div class="dt-pricing-box'.$featured_class.' clearfix">';
							$table .= '<div class="product-image">';
								if ( $_POST['product_image_'.$i] != '' ) $table .= '<img src="'.trim($_POST['product_image_'.$i]).'" /><br />';									
								if ( $_POST['product_url_'.$i] != '' ): 
									$table .= '<a href="'.$_POST['product_url_'.$i].'" class="more-link"><span><span>'.$_POST['product_button_'.$i].'</span></span></a>';
								endif;	
							$table .= '</div>';
							$table .= '<div class="product-details">';	
								$table .= '<h4>'.$_POST['product_name_'.$i].'</h4>';													
								$table .= '<span class="price">'.$_POST['product_price_'.$i].'</span>';
								$table .= $_POST['product_specifications_'.$i];							
							$table .= '</div>';
						$table .= '</div>';						
					endfor;
				endif;						
			?>
            <textarea rows="20" cols="120"><?php echo $table; ?></textarea>
        <?php endif; ?>             
	</div>
</div>        
<?php
	}
	add_action('admin_menu', 'table_admin_menu');

?>
