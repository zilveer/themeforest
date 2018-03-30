<!DOCTYPE html>
<html>
<head>
    <script type="text/javascript" src="../../includes/js/cufon-yui.js"></script>
    <script type="text/javascript" src="../../../fonts/<?php echo $_GET['font']; ?>.font.js"></script>
    <title>Example font <?php echo $_GET['font']; ?></title>
    <script type="text/javascript">
    Cufon.replace('span');
    </script>
    <style type="text/css">
        html, body {margin:0;padding:0;text-align:center;}
        #text {font-size:25px;cursor:text;}
        #input {background:none;border:0;font-size:25px;width:100%;display:none;text-align:center;}
    </style>
</head> 
<body>
<span id="text" onclick="showInput();">general text</span>
<input type="text" value="general text" id="input" onblur="showText();" />
<script type="text/javascript">
function showInput() {
    hide('text');
    show('input');
    document.getElementById("input").focus();
}    
function showText() {
    show('text');
    hide('input');                                  
    changeTheWorld( 'text', document.getElementById("input").value );
    Cufon.refresh();
}    

function hide(id) {
	//safe function to hide an element with a specified id
	if (document.getElementById) { // DOM3 = IE5, NS6
		document.getElementById(id).style.display = 'none';
	}
	else {
		if (document.layers) { // Netscape 4
			document.id.display = 'none';
		}
		else { // IE 4
			document.all.id.style.display = 'none';
		}
	}
}

function show(id) {
	//safe function to show an element with a specified id
		  
	if (document.getElementById) { // DOM3 = IE5, NS6
		document.getElementById(id).style.display = 'block';
	}
	else {
		if (document.layers) { // Netscape 4
			document.id.display = 'block';
		}
		else { // IE 4
			document.all.id.style.display = 'block';
		}
	}
}

// Assign the value to the input with the id passed in 
function changeTheWorld( idRef, val ) { 
    // Make sure browser supports getElementById  
    if(!document.getElementById ) return; 
    // Find the input by it's id 
    var inputObj = document.getElementById( idRef ); 
    if( inputObj ) { 
        // Update the value 
        inputObj.innerHTML = val; 
    } 
} 
</script>
</body>
</html>