<?php
/* cosmetico Little Head */
if(!isset($columns))$columns='1';
if(is_page()||is_single()){
	if($columns!='1'&&$columns!='2'&&$columns!='3'&&$columns!='4') $columns='1';
	$col_v='col'.$columns;
	if(!isset($sidebar_name))$sidebar_name='';
	if(!isset($sidebar))$sidebar='';
	if($sidebar=='') $sidebar='no';
	if($sidebar_name=='') $sidebar_name='0';
	if($sidebar=='no'&&$sideb_page=='yes') $sidebar=$sideb_col;
} else {
	if($sideb_page=='yes') { $sidebar=$sideb_col; }
	$col_v='col'.$columns;
}
$fr='frame'; $frin='framein';

if($disable_rounded=='no') $roundy='round';

$con_lg='350';
$headi='<h3 class="in">'; $headi_end='</h3>';
$brs='';


$side='';
if(!isset($sidebar))$sidebar='';
if($sidebar!='none'&&$sidebar!='no') { $side='yes';
}


$div_left='<br/>'; $div_close='';

if($side=='yes') $col_v=$col_v.'s';

$si='no';
?>