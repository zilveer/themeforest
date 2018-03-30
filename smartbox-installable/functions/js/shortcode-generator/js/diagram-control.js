function desDiagramMaker(h, i, f) {

    this.parentControl = h;
    var d = this;
    this.width = 250;
    this.maxTabs = i;
    this.buttonsControl = this.textControl = this.selectControl = null;
    this.init = function () {
    
        this.buildSelectControl();
        
    };
    
    this.getTotalTabs = function () {
        return Number(d.selectControl.find( "option:selected").val())
    };
    
    this.buildSelectControl = function () {
    	// .attr( "style", "width:" + this.width + "px")
        this.selectControl = jQuery( "<select></select>").attr( "id", "des-diagram-select").addClass(f ? f : "" );
        var a = jQuery( "<option></option>").attr( "value", "select").attr( "selected", "selected").text( "Number of Bars..." );
        a.appendTo(this.selectControl);
        for (var b = 1; b < this.maxTabs; b++) {
            a = jQuery( "<option></option>").attr( "value", b).text(b + " bars" );
            a.appendTo(this.selectControl)
        }
        this.selectControl.change(function (c) {
            (c = d.getTotalTabs()) && d.buildTabButtons(c)
                        
            // Update the text in the appropriate span tag.
            var newText = jQuery(this).children( 'option:selected').text();
            
            jQuery(this).parents( '.select_wrapper').find( 'span').text( newText );
            
            // jQuery( this ).parents( 'tr' ).hide();
        });
        
        this.parentControl.append(this.selectControl);
    };
    
    this.buildTextInputControl = function ( id ) {
    
    	var labelElement2 = '<label style="margin-top: -15px;" for="des_diagram_percent">Slice ' + id + ' Percent</label>';
    	var inputElement2 = '<input type="text" id="des_diagram_percent_' + id.toString() + '" class="txt input-text" name="des_diagram_percent" />';
    	
    	var labelElement3 = '<label style="margin-top: -15px;" for="des_diagram_color">Slide ' + id + ' Color</label>';
    	var inputElement3 = '<td id="des-marker-colourpicker-control_' + id.toString() + '" class="des-marker-colourpicker-control"><div class="colorSelector"><div></div></div><input type="text" id="des_diagram_color_' + id.toString() + '" name="des_diagram_color_' + id.toString() + '" class="txt input-text input-colourpicker" style="float: left;"><br><span class="des-input-help">Values: &lt;empty&gt; for default or a color (e.g. Yellow or #ffffff).</span></td>';
    
    	var startingColour = '000000';
    	
    	var checker = setInterval(function(){
			if (jQuery('#des-marker-colourpicker-control_' + id.toString()).length != 0){
				jQuery( '#des-marker-colourpicker-control_' + id.toString() + ' div.colorSelector').each ( function () {
    	
		    		var colourPicker = jQuery(this).ColorPicker({
		    	
			    	color: startingColour,
					onShow: function (colpkr) {
						jQuery(colpkr).fadeIn(500);
					},
					onHide: function (colpkr) {
						jQuery(colpkr).fadeOut(500);
					},
					onChange: function (hsb, hex, rgb) {
						jQuery(colourPicker).children( 'div').css( 'backgroundColor', '#' + hex);
						jQuery(colourPicker).next( 'input').attr( 'value','#' + hex);
					}
			    	
			    	});
			    	
		    	});
		    	   	
		    	jQuery( '.colorpicker').css( 'position', 'absolute').css( 'z-index', '9999' );
				clearInterval(checker);
			}
		}, 100);
    
        this.textInputControl = jQuery( '<tr><th>' + labelElement3 + '</th>' + inputElement3 + '</tr><tr><th>' + labelElement2 + '</th><td>' + inputElement2 + '</td></tr>' );
        this.parentControl.parents( 'tbody').append(this.textInputControl)
    };
    
    this.buildTabButtons = function (a) {
        if (this.buttonsControl) {
            this.buttonsControl.html( "" );

        } else {

			// Wipe the slate clean when the number of tabs desired changes.
			jQuery( 'label[for="des_diagram_color"], label[for="des_diagram_percent"]').parents( 'tr').remove();
            this.parentControl.append(this.buttonsControl);

        }
        
        for (var b = 1; b <= a; b++) {
        
        	this.buildTextInputControl( b );

        }
    };
    
    this.updateTabButtonsState = function () {
        var a = this.getTotalTabs();
        if (a) {
            var b = this.countCurrentTabs(),
                c = a - b;
            this.buttonsControl.find( "input").each(function (e, g) {
                e >= c ? jQuery(g).attr( "disabled", "disabled") : jQuery(g).removeAttr( "disabled")
            })
        }
    };
    
    this.countCurrentTabs = function () {
        for (var a = this.textControl.text(), b = 0, c = 0; c < a.length; c++) a.charAt(c) == "x" && b++;
        return b
    };
    
    this.init()
};