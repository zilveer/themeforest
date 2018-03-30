// JavaScript Document

var $searchbx = jQuery.noConflict();
        $searchbx(function() { 
        $searchbx('#s').focus(
			function() {
                // Set it to an empty string
                $searchbx('#s').attr("value","");
				$searchbx('#s').css("color","#333333");
			});
		$searchbx('#s').blur(
			function() {
				if ($searchbx('#s').attr("value")==null || $searchbx('#s').attr("value")=="") {
                // Set it to an empty string
                $searchbx('#s').attr("value",searchfind);
				$searchbx('#s').css("color","#cccccc");
				}
        });
  });
