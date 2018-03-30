/*

CUSTOM FORM ELEMENTS

Created by Ryan Fait
www.ryanfait.com

The only things you may need to change in this file are the following
variables: checkboxHeight, radioHeight and selectWidth (lines 24, 25, 26)

The numbers you set for checkboxHeight and radioHeight should be one quarter
of the total height of the image want to use for checkboxes and radio
buttons. Both images should contain the four stages of both inputs stacked
on top of each other in this order: unchecked, unchecked-clicked, checked,
checked-clicked.

You may need to adjust your images a bit if there is a slight vertical
movement during the different stages of the button activation.

The value of selectWidth should be the width of your select list image.

Visit http://ryanfait.com/ for more information.

*/

var checkboxHeight = "18";
var radioHeight = "18";
var selectWidth = "277";


/* No need to change anything after this */


document.write('<style type="text/css">input.styled { display: none; } select.styled { position: relative; width: ' + selectWidth + 'px; opacity: 0; filter: alpha(opacity=0); z-index: 5; } .disabled { opacity: 0.5; filter: alpha(opacity=50); }</style>');

var Custom = {
	init: function() {
		var inputs = document.getElementsByTagName("input"), span = Array(), textnode, option, active;
		
		for(a = 0; a < inputs.length; a++) {
			if((inputs[a].type == "checkbox" || inputs[a].type == "radio") && inputs[a].className == "styled") {
				span[a] = document.createElement("span");
				span[a].className = inputs[a].type;

				if(inputs[a].checked == true) {
					if(inputs[a].type == "checkbox") {
						position = "0 -" + (checkboxHeight*2) + "px";
						span[a].style.backgroundPosition = position;
					} else {
						position = "0 -" + (radioHeight*2) + "px";
						span[a].style.backgroundPosition = position;
					}
				}
				
				inputs[a].parentNode.insertBefore(span[a], inputs[a]);
				inputs[a].onchange = Custom.clear;
				if(!inputs[a].getAttribute("disabled")) {
					span[a].onmousedown = Custom.pushed;
					span[a].onmouseup = Custom.check;
				} else {
					span[a].className = span[a].className += " disabled";
				}
			}
		}
		inputs = document.getElementsByTagName("select");
		for(a = 0; a < inputs.length; a++) {
			if(inputs[a].className == "styled") {
				option = inputs[a].getElementsByTagName("option");
				active = option[0].childNodes[0].nodeValue;
				textnode = document.createTextNode(active);
				for(b = 0; b < option.length; b++) {
					if(option[b].selected == true) {
						textnode = document.createTextNode(option[b].childNodes[0].nodeValue);
					}
				}
				span[a] = document.createElement("span");
				span[a].className = "select";
				span[a].id = "select" + inputs[a].name;
				span[a].appendChild(textnode);
				inputs[a].parentNode.insertBefore(span[a], inputs[a]);
				if(!inputs[a].getAttribute("disabled")) {
					inputs[a].onchange = Custom.choose;
				} else {
					inputs[a].previousSibling.className = inputs[a].previousSibling.className += " disabled";
				}
			}
		}
		document.onmouseup = Custom.clear;
	}
}
window.onload = Custom.init;


	jQuery(".item .setting").live("click", function() {
		var checkbox = jQuery(this).children(":checkbox");
		if(checkbox) {
			if(checkbox.is(":checked")) {
				checkbox.prop("checked", false);
				jQuery(this).children(".checkbox").css("background-position", "0px 0px");
			} else {
				checkbox.prop("checked", true);
				jQuery(this).children(".checkbox").css("background-position", "0px -" + (checkboxHeight*2) + "px");
			}
		}
		
		var radio = jQuery(this).children(":radio");
		if(radio) {
			var checkname = radio.attr("name");
			var lastElement = jQuery("input:radio[name=" + checkname + "]:checked");   
			lastElement.parent().children(".radio").css("background-position", "0px 0px");
			radio.prop("checked", true);
			jQuery(this).children(".radio").css("background-position", "0px -" + (radioHeight*2) + "px");
		}
    }); 
	
    jQuery(".item .setting").live("change", function() {
		var selectField = jQuery(this).children("select").children("option:selected");
		if(selectField) {
			var selectValue = selectField.text();
			jQuery(this).children(".select").text(selectValue);
		}    
    });
		
	jQuery(".item .setting").live("mousedown", function() {
		var checkbox = jQuery(this).children(":checkbox");
		if(checkbox) {
			jQuery(this).children(".checkbox").css("background-position", "0px -" + (checkboxHeight) + "px");
		}
		var radio = jQuery(this).children(":radio");
		if(radio) {
			jQuery(this).children(".radio").css("background-position", "0px -" + (radioHeight) + "px");
		}
    });
		
