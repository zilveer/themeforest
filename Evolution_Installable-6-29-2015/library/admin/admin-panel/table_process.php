<?php
require_once('table_wizard.php');
class PricingWizard extends ZervWizard
{
    function PricingWizard()
    {
        // start the session and initialize the wizard
     
        parent::ZervWizard($_SESSION, __CLASS__);


        // create the steps, we're only making a simple 3 step form
        $this->addStep('step1', 'Step 1', 'Choose a style');
        $this->addStep('step2', 'Step 2', 'Table Dimensions');
        $this->addStep('step3', 'Step 3', 'Input your data');
        $this->addStep('step4', 'Step 4', 'Get Your Code');
    }

    // here we prepare the user details step. all we really need to
    // do for this step is generate the list of countries.

    function prepare_step1()
    {
        
    }

    // now we process the first step. we've simplified things, so we're
    // only collecting, name, email address and country

    function process_step1(&$form)
    {
        $style = $form['style'];
        if (strlen($style) > 0)
        {
            $this->setValue('style', $style);
        }
        else
        {
        	$this->addError('style', 'Please choose a style to continue');
        }
     

        return !$this->isError();
    }

   

    function prepare_step2()
    {
       
    }

    function process_step2(&$form)
    {
        $rows = $form['rows'];
        if (strlen($rows) > 0)
		{
		    $this->setValue('rows', $rows);
		}
		else
		{
			$this->addError('rows', 'Please enter correct row value to continue');
		}
         
        $cols = $form['columns'];
         if (strlen($cols) > 0)
		{
		    $this->setValue('columns', $cols);
		}
		else
		{
			$this->addError('columns', 'Please enter correct column value to continue');
		}
         
         return !$this->isError();
    }
    
    function prepare_step3()
    {
        $rows = $this->getValue('rows');
       
        $cols = $this->getValue('columns');
      
        $style = $this->getValue('style');
        
        $this->generateTable($style, $rows, $cols);
    }
    
   
   
    function process_step3(&$form)
    {
    	$rows = $this->getValue('rows');
       	$cols = $this->getValue('columns');
      	
       	$errCount = 0;
       	for($i=1; $i<=$rows; $i++)
		{
			$row_{$i} = $form['row_'.$i];
		
			$price_{$i} = $form['price_'.$i];
			
			$buttoncaption_{$i} = $form['buttoncaption_'.$i];
			$buttonurl_{$i} = $form['buttonurl_'.$i];
			$badge_{$i} = $form['badge_'.$i];
           
			if (strlen($row_{$i}) > 0)
			{
			    $this->setValue('row_'.$i, $row_{$i});
			}
			
			if (strlen($price_{$i}) > 0)
			{
			    $this->setValue('price_'.$i, $price_{$i});
			}
			else 
			{
				$errCount++;
			}
			
			if (strlen($buttoncaption_{$i}) > 0)
			{
			    $this->setValue('buttoncaption_'.$i, $buttoncaption_{$i});
			}
			else 
			{
				$errCount++;
			}
			
			if (strlen($buttonurl_{$i}) > 0)
			{
			    $this->setValue('buttonurl_'.$i, $buttonurl_{$i});
			}
			else 
			{
				$errCount++;
			}
			
			if (strlen($badge_{$i}) > 0)
			{
			    $this->setValue('badge_'.$i, $badge_{$i});
			}
			else 
			{
				$errCount++;
			}
			
			
			for($z=1; $z<=$cols; $z++)
			{
				$column_{$z} = $form['column_'.$z];
			
				if (strlen($column_{$z}) > 0)
				{
				    $this->setValue('column_'.$z, $column_{$z});
				}
				else 
				{
					$errCount++;
				}
			}
		}
      
        return !$this->isError();
    }
		
    function prepare_step4()
    {
    	$this->generateFullTable();
    }
    
    // the final step is the confirmation step. there's nothing to prepare here
    // as we're just asking for final acceptance from the user

    function process_confirm(&$form)
    {
        return true;
    }


    function completeCallback()
    {
       
    }

    function isValidEmail($email)
    {
        return preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*$/i', $email);
    }
    
    
    function generateTable($style = 'style1', $rows = 3, $cols = 5)
    {
		$table= '<div id="pricing-table">';
		for($i=1; $i<=$rows; $i++)
		{
			$table.= '
				<div class="column columns">
					<ul>
					<li class="table-head">
						<label for="plan'.$i.'">Plan</label>
						<input type="text" name="row_'.$i.'" value="'.$this->getValue('row_'.$i).'" id="plan'.$i.'">
						<label for="price'.$i.'">Price</label>
						<input type="text" name="price_'.$i.'"  value="'.$this->getValue('price_'.$i).'" id="price'.$i.'">
					</li>
					';
			for($z=1; $z<=$cols; $z++)
			{
				$table.= '<li><input type="text" name="column_'.$z.'" value="'.$this->getValue('column_'.$z).'"></li>';
			}
			$table.= '<li class="table-footer">
						<p>
							<label for="bcaption'.$i.'">Button Caption</label>
							<input type="text" name="buttoncaption_'.$i.'"  value="'.$this->getValue('buttoncaption_'.$i).'" id="bcaption'.$i.'" />
						</p>
						<p>
							<label for="burl'.$i.'">Button URL</label>
							<input type="text" id="burl'.$i.'" name="buttonurl_'.$i.'"  value="'.$this->getValue('buttonurl_'.$i).'" />
						</p>
						<p class="ibadge">
							<label for="ibadge">Featured</label>
							<select name="badge_'.$i.'" id="ibadge">
								<option value="0">No</option>
								<option value="1">Yes</option>
							</select>
						</p>
						</li>
					</ul>
				</div>';
		}
		$table.= '</div>';
		
		$this->generatedTable = $table;    	
    }
    
    function generateFullTable()
    {
    	$style = $this->getValue('style');
    	$rows = $this->getValue('rows');
    	$cols = $this->getValue('columns');
    	
		$table = '';
            	
		$table.= "<div class=\"row pricing-wrapper\">";
		for($i=1; $i<=$rows; $i++)
		{
			$featured = $this->getValue('badge_'.$i) == 1 ? ' pricing-active' : '';
			$table.= "\r\t<div class=\"$style columns".$featured."\">\n\t\t<ul class=\"pricing-table\">\n\t\t\t";		
			$table.="<li class=\"title\">".$this->getValue('row_'.$i)."</li>\n\t\t\t<li class=\"price\">".$this->getValue('price_'.$i)."</li>\t\t";
			for($z=1; $z<=$cols; $z++)
			{
				$table.= "\n\t\t\t<li class=\"bullet-item\">".$this->getValue('column_'.$z)."</li>";
			}
			$table.= "\n\t\t\t<li class=\"cta-button\"><a href=\"".$this->getValue('buttonurl_'.$i)."\" class=\"button\">".$this->getValue('buttoncaption_'.$i)."</a></li>";
			$table.="\n\t\t</ul>\n\t</div>";
		}
		$table.= "\t\n</div>";
		
		$this->fullTable = $table;	
    }		
}
?>