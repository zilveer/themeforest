<?php

if(of_get_option('banner_code')!="") {
	echo '
      <div id="bnftr">
'.of_get_option('banner_code').'
      </div>';
} else {
	echo '
      <div id="bnftr-none"></div>';
}