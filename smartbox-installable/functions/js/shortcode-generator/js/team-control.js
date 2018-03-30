function desTeamMaker(h, i, f) {

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
        this.selectControl = jQuery( "<select></select>").attr( "id", "des-team-select").addClass(f ? f : "" );
        var a = jQuery( "<option></option>").attr( "value", "select").attr( "selected", "selected").text( "Number of Persons..." );
        a.appendTo(this.selectControl);
        for (var b = 2; b <= this.maxTabs; b++) {
            a = jQuery( "<option></option>").attr( "value", b).text(b + " Persons" );
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
    
    	var labelElement = '<label for="des_team_name">Person ' + id + ' Name</label>';
    	var inputElement = '<input type="text" id="des_team_name_' + id.toString() + '" class="txt input-text" name="des_team_name" />';
    	
    	var labelElement2 = '<label for="des_team_role">Person ' + id + ' Role</label>';
    	var inputElement2 = '<input type="text" id="des_team_role_' + id.toString() + '" class="txt input-text" name="des_team_role" />';
    	
    	var labelElement3 = '<label for="des_team_image">Person ' + id + ' Image URL</label>';
    	var inputElement3 = '<input type="text" id="des_team_image_' + id.toString() + '" class="txt input-text" name="des_team_image" /><br><span class="des-input-help">Image Recommended Size: 120px X 120px</span>';
    	
    	var labelElement4 = '<label for="des_team_facebook">Person ' + id + ' Facebook</label>';
    	var inputElement4 = '<input type="text" id="des_team_facebook_' + id.toString() + '" class="txt input-text" name="des_team_facebook" />';
    	
    	var labelElement5 = '<label for="des_team_twitter">Person ' + id + ' Twitter</label>';
    	var inputElement5 = '<input type="text" id="des_team_twitter_' + id.toString() + '" class="txt input-text" name="des_team_twitter" />';
    
        this.textInputControl = jQuery( '<tr><th>' + labelElement + '</th><td class="td-first">' + inputElement + '</td></tr><tr><th>' + labelElement2 + '</th><td>' + inputElement2 + '</td></tr><tr><th>' + labelElement3 + '</th><td>' + inputElement3 + '</td></tr><tr><th>' + labelElement4 + '</th><td>' + inputElement4 + '</td></tr><tr><th>' + labelElement5 + '</th><td>' + inputElement5 + '</td></tr><tr><td class="td-divider" colspan=2></tr>' );
        this.parentControl.parents( 'tbody').append(this.textInputControl)
    };
    
    this.buildTabButtons = function (a) {
        if (this.buttonsControl) {
            this.buttonsControl.html( "" );

        } else {

			// Wipe the slate clean when the number of tabs desired changes.
			jQuery( 'label[for="des_team_name"]').parents( 'tr').remove();
			jQuery( 'label[for="des_team_role"]').parents( 'tr').remove();
			jQuery( 'label[for="des_team_image"]').parents( 'tr').remove();
			jQuery( 'label[for="des_team_facebook"]').parents( 'tr').remove();
			jQuery( 'label[for="des_team_twitter"]').parents( 'tr').remove();
			jQuery( '.td-divider').parents( 'tr').remove();
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