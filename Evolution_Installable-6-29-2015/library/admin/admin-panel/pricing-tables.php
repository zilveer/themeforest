<?php
function alc_pricing_tables_scripts($hook) {
	
	if (isset($_REQUEST['page']) && $_REQUEST['page'] == 'pricing_tables') {
		// Admin Stylesheet
		//wp_enqueue_style('alc-pricing-tables', get_bloginfo('stylesheet_directory') . '/library/admin/css/widgets-area.css', false, '1.0.0', 'screen');
		// JAVASCRIPT
		//wp_enqueue_script('table-copy', get_template_directory_uri . '/library/admin/js/jquery.zclip.min.js', array('jquery'), '1.0.4');
	}
}

add_action('admin_enqueue_scripts', 'alc_pricing_tables_scripts');

function pricing_tables()
{
	require_once('table_process.php');
	$wizard = new PricingWizard();
	$action = $wizard->coalesce($_GET['action']);
	$wizard->process($action, $_POST, $_SERVER['REQUEST_METHOD'] == 'POST');	
 	?>
	
	<div id="header">
        <div id="logo-container">
			<h1><img src="<?php echo get_template_directory_uri()?>/library/admin/images/main_logo.png" alt="Evolution" /></h1>		
        </div>	
        <div id="admin-panel">
            <p>Administration Panel</p>
        </div>       
        <div class="clear"></div>
	</div>
	<div class="wrap alc_wrap">
		<div class="alc_opts">   
		 	<div id="form-div">
		 		<h3 class="tg-title">Table Generator</h3>
			 	<?php if ($wizard->isComplete()) { ?>
			 
			      <p>
			        The form is now complete. Clicking the button below will clear the container and start again.
			      </p>
			 
			      <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>?action=<?php echo  $wizard->resetAction ?>">
			        <input type="submit" value="Start again" />
			      </form>
			 
			    <?php } else { ?>
		 	
		      	<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>?page=pricing_tables&amp;action=<?php echo $wizard->getStepName() ?>" id="custom" class="form">
		       
		 			<div>
			 			<ul class="stepy-titles">
				        <?php 
				    		$steps = $wizard->getSteps();
				    		foreach ($steps as $step){
				    			?><li <?php if($wizard->getStepProperty('title')==$step['title']): ?>class="current-step"<?php endif?>><?php echo $step['title']?><span><?php echo $step['desc']?></span></li><?php 
				    		}
				    	?>
			    		</ul>
			        </div>
			        <div class="clear"></div>
			        <?php if ($wizard->getStepName() == 'step1'): ?>
		        	
			        <fieldset class="step">
						<legend>Choose style</legend>
				        <div style="float:left; width:200px;  margin-left:10px">
							<p><img src="<?php echo get_template_directory_uri()  ?>/library/admin/images/pricing-tables/table1.png"  alt="Style1" /> </p>
				    		<label for="large-2" style="display:inline; width:122px; margin-top:0px">Narrow size</label> 
				    		<input type="radio" style="width:20px; padding-top:10px" name="style" value="large-2" id="large-2" <?php if ($wizard->getValue('style') == 'style1'):?>checked="checked"<?php endif?> />
						</div>
						<div style="float:left; width:200px; margin-left:70px">
							<p><img src="<?php echo get_template_directory_uri()  ?>/library/admin/images/pricing-tables/table2.png"  alt="Style2" /> </p>
				    		<label for="large-4" style="display:inline; width:122px; margin-top:0px">3 Columns/row</label> 
				    		<input type="radio" style="width:20px; padding-top:10px" name="style" value="large-4" id="large-4" <?php if ($wizard->getValue('style') == 'style2'):?>checked="checked"<?php endif?> />
						</div>
						<div style="float:left; width:200px; margin-left:70px">
							<p><img src="<?php echo get_template_directory_uri()  ?>/library/admin/images/pricing-tables/table3.png"  alt="Style3" /> </p>
				    		<label for="large-3" style="display:inline; width:122px; margin-top:0px">4 Columns/row</label> 
				    		<input type="radio" style="width:20px; padding-top:10px" name="style" value="large-3" id="large-3" <?php if ($wizard->getValue('style') == 'style3'):?>checked="checked"<?php endif?> />
						</div>
				      
				        <div class="clear"></div>  
			        </fieldset>
		        <?php elseif ($wizard->getStepName() == 'step2'): ?>
		        <fieldset class="step">
					<legend>Choose dimensions</legend>
					<div>
						<label for="rows">Columns:</label> 
						<input type="text" name="rows" id="rows" maxlength="2" value="<?php echo htmlSpecialChars($wizard->getValue('rows')) ?>" />
						<?php if ($wizard->isError('rows')) { ?><?php echo $wizard->getError('rows') ?><?php } ?>
					</div>
					<div style="clear:both; margin:10px 0px">
						<label for="cols">Rows:</label> 
						<input type="text" name="columns" id="cols" maxlength="2" value="<?php echo htmlSpecialChars($wizard->getValue('columns')) ?>" />
						<?php if ($wizard->isError('columns')) { ?><?php echo $wizard->getError('columns') ?><?php } ?>
					</div>
					<div style="width:250px; margin-left:135px">Note: 2 additional Rows will be added for title and pricing fields. The numbers above don't include these fields.</div>
				</fieldset>
				
				<?php elseif ($wizard->getStepName() == 'step3'): ?>
		        <fieldset  class="step">
					<legend>Enter Table data</legend>
					<?php echo $wizard->generatedTable; ?>
				</fieldset>
				
				<?php elseif ($wizard->getStepName() == 'step4'): ?>
				 <fieldset  class="step">
					<legend>Get Your Code</legend>
					<textarea name="code" id="copycode" style="width:100%"><?php echo $wizard->fullTable;?></textarea>
					<div style="text-align:center">
					   <!--<a href="#" id="copy-button" class="al-button">Copy to Clipboard</a>-->
					   Copy this text and paste where you want the table to appear.
					</div>
				</fieldset>
				<?php endif?>
		   		<div class="clear">
		        <div style="padding:20px 0px">
		          <input type="submit" class="button-back" name="previous" value="&lt;&lt; Previous"<?php if ($wizard->isFirstStep()) { ?> disabled="disabled"<?php } ?> />
		          <?php if(!$wizard->isLastStep()):?>
		          	<input type="submit" class="button-next" value="Next &gt;&gt;" />
		          <?php else: ?>
		          <a href="?page=pricing_tables&amp;action=<?php echo $wizard->resetAction ?>" class="al-button medium red-back" style="float:right;">Reset and start again.</a>
		          <?php endif?>
		          <div class="clear"></div>
		        </div>
			       
			    </form>
			     
	
	    	<?php } ?>
	
			</div>    
	 	</div>
	</div>
<?php } ?>