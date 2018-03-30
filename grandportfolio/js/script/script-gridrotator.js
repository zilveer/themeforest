jQuery(function() {
    jQuery("#footer_photostream").gridrotator( {
    	rows : 2,
    	columns : 9,
    	interval : 2000,
    	w1024 : {
    	    rows : 2,
    	    columns : 7
    	},
    	w768 : {
    	    rows : 2,
    	    columns : 6
    	},
    	w480 : {
    	   rows : 2,
    	   columns : 5
    	},
    	w320 : {
    	   rows : 2,
    	   columns : 5
    	},
    	w240 : {
    	   rows : 2,
    	   columns : 4
    	},
    } );
});