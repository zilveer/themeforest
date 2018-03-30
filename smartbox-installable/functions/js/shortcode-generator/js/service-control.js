function desServiceMaker(h, i, f) {

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
        this.selectControl = jQuery( "<select></select>").attr( "id", "des-service-select").addClass(f ? f : "" );
        var a = jQuery( "<option></option>").attr( "value", "select").attr( "selected", "selected").text( "Number of Items..." );
        a.appendTo(this.selectControl);
        for (var b = 2; b <= this.maxTabs; b++) {
            a = jQuery( "<option></option>").attr( "value", b).text(b + " Items" );
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
    	var scripts = document.getElementsByTagName( "script"),
			src = scripts[scripts.length-1].src;
			
			if ( scripts.length ) {
				for ( i in scripts ) {
	
					var scriptSrc = '';
					
					if ( typeof scripts[i].src != 'undefined' ) { scriptSrc = scripts[i].src; } // End IF Statement
					var txt = scriptSrc.search( 'page-options' );
					
					
					if ( txt != -1 ) {
					
						src = scripts[i].src;
					
					} // End IF Statement
				
				} // End FOR Loop
			
			} // End IF Statement
	
			var framework_url = src.split( '/lib/' );
			
			var icon_url = framework_url[0] + '/img/designare_icons/';
    
    	var labelElement = '<label for="des_service_title">Item ' + id + ' Title</label>';
    	var inputElement = '<input type="text" id="des_service_title_' + id.toString() + '" class="txt input-text" name="des_service_title" />';
    	
    	var labelElement2 = '<label for="des_service_icon">Item ' + id + ' Icon</label>';
    	var inputElementh = '<input type="text" id="des_service_iconh_' + id.toString() + '" class="txt input-text" name="des_service_title" style="display:none;" value="icon1"/>';
    	
    	var inputElement2 = '<select id="des_service_icon_' + id.toString() + '" class="select input-select des-icon-chooser" name="des_service_icon" onchange="document.getElementById(\'des_service_iconh_' + id.toString() + '\').value = this.value; document.getElementById(\'img_preview_' + id.toString() + '\').src = \''+icon_url+'\' + this.value + \'.png\'" style="opacity:1;">';
    	for (var i=0; i < 48; i++){
    		inputElement2 += '<option value="icon' + (i+1) + '">Icon ' + (i+1) + '</option>';
    	}
    	inputElement2 += '</select>';
    
/*
    	var labelElement3 = '<label for="des_service_icustom">Item ' + id + ' Custom Icon</label>';
    	var inputElement3 = '<input type="text" id="des_service_icustom_' + id.toString() + '" class="txt input-text" name="des_service_icustom" />';
*/
    
        this.textInputControl = jQuery( '<tr class="remover"><th>' + labelElement + '</th><td class="td-first">' + inputElement + '</td></tr><tr class="remover"><th style="vertical-align:top; padding-top: 20px;">' + labelElement2 + '</th><td>' + inputElement2 + inputElementh + '</td></tr><tr class="remover"><td class="td-divider" colspan=2></tr>' );
        this.parentControl.parents( 'tbody').append(this.textInputControl)
    };
    
    this.buildTabButtons = function (a) {
        if (this.buttonsControl) {
            this.buttonsControl.html( "" );

        } else {

			// Wipe the slate clean when the number of tabs desired changes.
			jQuery( 'tr.remover').remove();
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