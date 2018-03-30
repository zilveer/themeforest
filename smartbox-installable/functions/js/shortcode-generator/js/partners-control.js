function desPartnersMaker(h, i, f) {

    this.parentControl = h;
    var d = this;
    this.width = 250;
    this.maxTabs = 50;
    this.buttonsControl = this.textControl = this.partnersControl = null;
    this.init = function () {
    
        this.buildPartnersControl();
        
    };
    
    this.getTotalTabs = function () {
        return Number(d.partnersControl.find("option:selected").val())
    };
    
    this.buildPartnersControl = function () {
    	// .attr( "style", "width:" + this.width + "px")
        this.partnersControl = jQuery( "<select></select>").attr( "id", "des-partners-select").addClass(f ? f : "" ).change(function(){
	        jQuery('#des-value-numPartners').val(this.value);
        });
        var a = jQuery( "<option></option>").attr( "value", "select").attr( "selected", "selected").text( "Number of Partners..." );
        a.appendTo(this.partnersControl);
        for (var b = 2; b <= this.maxTabs; b++) {
            a = jQuery( "<option></option>").attr( "value", b).text(b + " Partners" );
            a.appendTo(this.partnersControl)
        }
        this.partnersControl.change(function (c) {
            (c = d.getTotalTabs()) && d.buildTabButtons(c)
                        
            // Update the text in the appropriate span tag.
            var newText = jQuery(this).children( 'option:selected').text();
            
            jQuery(this).parents( '.select_wrapper').find( 'span').text( newText );
            
            // jQuery( this ).parents( 'tr' ).hide();
        });
        
        this.parentControl.append(this.partnersControl);
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
	
    	var labelElement = '<label for="des_partners_title">Partner ' + id + ' Name</label>';
    	var inputElement = '<input type="text" id="des_partners_title_' + id.toString() + '" class="txt input-text" name="des_partners_title" />';
    	
    	var labelElement2 = '<label for="des_partners_logo">Partners ' + id + ' Logo</label>';
    	var inputElement2 = '<input type="text" id="des_partners_logo_' + id.toString() + '" class="txt input-text" name="des_partners_title" />';
    
    	var labelElement3 = '<label for="des_partners_link">Partners ' + id + ' Link</label>';
    	var inputElement3 = '<input type="text" id="des_partners_link_' + id.toString() + '" class="txt input-text" name="des_partners_link" />';
    
        this.textInputControl = jQuery( '<tr class="remover"><td class="td-divider" colspan=2></td></tr><tr class="remover"><th>' + labelElement + '</th><td class="td-first">' + inputElement + '</td></tr><tr class="remover"><th>' + labelElement2 + '</th>'+labelElement2+'<td>' + inputElement2 +'</td></tr><tr class="remover"><th>' + labelElement3 + '</th><td>' + inputElement3 + '</td></tr><tr class="remover"><td class="td-divider" colspan=2></tr>' );
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
            this.buttonsControl.find("input").each(function (e, g) {
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