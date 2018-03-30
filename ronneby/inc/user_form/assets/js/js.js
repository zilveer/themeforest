var Dfd_Contact_form_field = {};
(function($, dfd){

    dfd.classMain = '.dfd_contact_form_select';
    dfd.selectedElm = '';
    dfd.curChacngedElem = '';
    dfd.cur_name = '';
    dfd.typeOption = '';
    dfd.cur_name_field = '';
    dfd.base = '';
    dfd.isSetids = false;
    dfd.init = function(){
        dfd.bindEvent();
    };
    dfd.atr = '';
    dfd.obj = {};

    dfd.id = '';

    dfd.bindEvent = function(){
        $(dfd.classMain).live("change", function(){
            dfd.selectedElm = $(this);
            dfd.findBaseField();
            dfd.clear();
            if(!dfd.selectedElm.val()){
                dfd.removeFormElm();
                dfd.update();
                dfd.updateAvaliableFields();
                return;
            }

            atr = dfd.selectedElm.find(":selected").attr("data-value");
            atr = JSON.parse(atr);
            dfd.id = dfd.selectedElm.attr("data-id");
            dfd.values = "";
            dfd.atr = atr;
            dfd.createForm();
            dfd.update();
            ////
            dfd.typeOption = dfd.selectedElm.attr("value");
            dfd.AddToBaseFieldValue("", "");
            //////
            dfd.updateAvaliableFields();
        });

        $(".form_elem input, .form_elem textarea").live("change", function(){
            dfd.initUpdate($(this));
        });
        $("select[name='preset']").live("change", function(){
            val = $(this).val();
            callFunc = "Dfd_Contact_form_field." + val + "()";
            try {
                eval(callFunc);
            } catch(e) {
                console.log(" not calleble" + e);
            }

        });

    };
    dfd.initUpdate = function($this){
        var val = $this.val();
        var name = $this.attr("name");
        dfd.selectedElm = $this.parents(".form_elem").parent().children(dfd.classMain);
        dfd.typeOption = dfd.selectedElm.attr("value");
        dfd.curChacngedElem = $this;
        dfd.findBaseField();
        dfd.AddToBaseFieldValue(name, val);
        dfd.update();
        dfd.updateAvaliableFields();
    };
    dfd.AddToBaseFieldValue = function(name, val){
        base_val = dfd.base.val();
        id = dfd.selectedElm.attr("data-id");

        var delChexboxValue = false;
        if(dfd.curChacngedElem){
            if(dfd.curChacngedElem.attr("type") == "checkbox"){
                if(!dfd.curChacngedElem.attr("checked")){
                    delChexboxValue = true;
                }
            }
        }

        if(base_val){
            base_val_parse = JSON.parse(base_val);

            if(!base_val_parse[id]){
                base_val_parse[id] = {};
            }
            if(!base_val_parse[id][dfd.typeOption]){
                base_val_parse[id][dfd.typeOption] = {};
            }
            base_val_parse[id][dfd.typeOption][name] = val;
            if(delChexboxValue){
                delete base_val_parse[id][dfd.typeOption][name];
            }
            if(!val){
                delete base_val_parse[id][dfd.typeOption][name];
            }
            val = JSON.stringify(base_val_parse);
            dfd.base.val(val);
        } else {
            dfd.obj = {};
            dfd.obj[id] = {};
            dfd.obj[id][dfd.typeOption] = {};
            dfd.obj[id][dfd.typeOption][name] = val;

            val = JSON.stringify(dfd.obj);
            dfd.base.val(val);
        }
    };
    dfd.findBaseField = function(){
        dfd.base = dfd.selectedElm.parentsUntil(".dfd_template_layout").parent().prev();
    };
    dfd.clear = function(){
        base_val = dfd.base.val();
        id = dfd.selectedElm.attr("data-id");
        if(base_val){
            var base_val_parse = JSON.parse(base_val);
            delete base_val_parse[id];
            val = JSON.stringify(base_val_parse);
            dfd.base.val(val);
        }

    };
    dfd.updateById = function(inputElm){
        $this = inputElm;
        value = $this.val();
        dfd.base = $this;
        if(value){
            var value = JSON.parse(value);
            dfd.values = value;
            block = $this.next();
            block.find(".dfd_contact_form_select").each(function(index){

                dfd.id = $(this).attr("data-id");
                id = dfd.id;
                if(value[id]){
                    dfd.selectedElm = $(this);
                    for(type in value[id]) {
                        dfd.type = type;
                        dfd.selectedElm.find("option").each(function(){
                            if($(this).attr("value") == type){
                                $(this).attr("selected", true);
                                atr = $(this).attr("data-value");
                                atr = JSON.parse(atr);
                                dfd.atr = atr;
                                dfd.createForm();
                            };
                        })
                    }
                }
            });
        }
        else {
            dfd.values = "";
        }
        dfd.updateAvaliableFields();
    }
    dfd.update = function(){

        var prevSelected = dfd.selectedElm;
        var prevSelBase = dfd.base;
        $(".dfd_form_template").each(function(index){
            value = $(this).val();
            if(value){
                dfd.base = $(this);
                var value = JSON.parse(value);
                dfd.values = value;
                block = $(this).next();
                block.find(".dfd_contact_form_select").each(function(index){

                    dfd.id = $(this).attr("data-id");
                    id = dfd.id;
                    if(value[id]){
                        dfd.selectedElm = $(this);
                        for(type in value[id]) {
                            dfd.type = type;
                            dfd.selectedElm.find("option").each(function(){
                                if($(this).attr("value") == type){
                                    $(this).attr("selected", true);
                                    atr = $(this).attr("data-value");
                                    atr = JSON.parse(atr);
                                    dfd.atr = atr;
                                    dfd.createForm();

                                };
                            })
                        }
                    }
                });
            }

        });
        dfd.selectedElm = prevSelected;
        dfd.base = prevSelBase;
    }
    dfd.createForm = function(){
        dfd.removeFormElm();
        /// get all property selected value
        for(atr_name in  dfd.atr) {
            /// Type current property
            type = dfd.atr[atr_name].type;
            /// Object current property
            dfd.cur_name = dfd.atr[atr_name];
            //name curent property
            dfd.cur_name_field = atr_name;
            callFunc = "dfd." + type + "()";
            eval(callFunc);
        }
    };
    dfd.insert = function(str){
        dfd.selectedElm.parent().append(str);
    };
    dfd.createFormElement = function(content){
        var str = "";
        str += '<div class="form_elem">';
        str += content;
        str += '</div>';
        return str;
    };
    ///////////////////////////////
    dfd.checkbox = function(){
        var str = "";
        name = "";

        for(var option in dfd.cur_name.options) {
            if(dfd.values){
                name = dfd.values[dfd.id][dfd.type][dfd.cur_name_field + "-" + dfd.cur_name.options[option]];
            }
            var checked = "";
            if(name == "undefined" || name == ""){
                checked = "";
            } else {
                checked = "checked";
            }
            str += '<label class="checkbox"><input type="checkbox" ' + checked + ' name="' + dfd.cur_name_field + "-" + dfd.cur_name.options[option] + '" value="' + dfd.cur_name.options[option] + '">' + option + '</label>';
        }
        str = dfd.createFormElement(str);
        dfd.insert(str);
    };
    dfd.textarea = function(){
        var str = "";
        value = "";
        if(dfd.values){
            value = dfd.values[dfd.id][dfd.type][dfd.cur_name_field];
        }
        value = value ? value : "";
        str += '<label>' + dfd.cur_name.name + '</label><textarea name="' + dfd.cur_name_field + '">' + value + '</textarea>';
        str = dfd.createFormElement(str);
        dfd.insert(str);
    };
    dfd.text = function(){
        var str = "";
        value = "";
        if(dfd.values){
            value = dfd.values[dfd.id][dfd.type][dfd.cur_name_field];
        }
        value = value ? value : "";
        str += '<label>' + dfd.cur_name.name + '</label><input type="text" name="' + dfd.cur_name_field + '" value="' + value + '">';
        str = dfd.createFormElement(str);
        dfd.insert(str);
    };
    dfd.daterange = function(){
        var str = "";
        value = "";
        if(dfd.values){
            value = dfd.values[dfd.id][dfd.type];
        }
        daterange_from_1 = value["daterange_from_1"] ? value["daterange_from_1"] : "";
        daterange_to_2 = value["daterange_to_2"] ? value["daterange_to_2"] : "";
        str += '<label>' + dfd.cur_name.name + '</label><br>' +
                'min <input class="daterange from" data-id="' + dfd.id + '" id="daterange_from_' + dfd.id + '" type="text" name="daterange_from_1" value="' + daterange_from_1 + '">' +
                'max <input class="daterange to" data-id="' + dfd.id + '" id="daterange_to_' + dfd.id + '" type="text" name="daterange_to_2" value="' + daterange_to_2 + '">';
        str = dfd.createFormElement(str);
        dfd.insert(str);
        $("#daterange_from_" + dfd.id).datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 3,
//            altField: "#daterange_to_2",
//            altFormat: "DD, d MM, yy",
            onSelect: function(selectedDate){
                dfd.initUpdate($(this));
            },
            onClose: function(selectedDate){
                id = $(this).attr("data-id");
                $("#daterange_to_" + id).datepicker("option", "minDate", selectedDate);
            }
        });
        $("#daterange_to_" + dfd.id).datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 3,
            onSelect: function(selectedDate){
                dfd.initUpdate($(this));
            },
            onClose: function(selectedDate){
                id = $(this).attr("data-id");
                $("#daterange_from_" + id).datepicker("option", "maxDate", selectedDate);
            }
        });
    };
    ///////////////////////////////
    dfd.removeFormElm = function(){
        dfd.selectedElm.parent().find(".form_elem").remove();
    };

    dfd.setIds = function(){
        var i = 1;
        $(".dfd_template_layout").each(function(index){
            var j = 1;
            $(this).find(".dfd_contact_form_select").each(function(){
                $(this).attr("id", "sel-" + i + "-" + j);
                $(this).attr("data-id", j);
                j++;
            });
            i++;
        });

    }
    dfd.AddDefaultValueToForm = function(form){
        switch (form) {
            case "forms_00" :
                jsonPresetVal = {"1":{"text_name":{"required-1":"1","name":"Name","akismet_comment_author-1":"1"}},"2":{"email":{"name":"Email","required-1":"1","akismet_comment_author_email-1":"1"}},"3":{"text_name":{"name":"Subject"}},"4":{"telephone":{"name":"Telephone"}},"5":{"textarea_name":{"name":"Message"}}};
                break;
            case "forms_01" :
                jsonPresetVal = {"1": {"text_name": {"required-1": "1", "name": "Name", "akismet_comment_author-1": "1"}}, "2": {"email": {"name": "Email", "required-1": "1", "akismet_comment_author_email-1": "1"}}, "3": {"text_name": {"name": "Subject"}}, "4": {"textarea_name": {"name": "Message"}}};
                break;
            case "forms_02" :
                jsonPresetVal = {"1":{"text_name":{"required-1":"1","name": "Name","akismet_comment_author-1":"1"}},"2":{"email":{"name": "Email", "required-1":"1","akismet_comment_author_email-1":"1"}},"3":{"textarea_name":{"name": "Message"}}};
                break;
            case "forms_03" :
                jsonPresetVal = {"1":{"email":{"name":"Email","required-1":"1","akismet_comment_author_email-1":"1"}},"2":{"textarea_name":{"required-1":"1","name":"Message"}}};
                break;
            case "forms_04" :
                jsonPresetVal = {"1":{"text_name":{"name":"Name","akismet_comment_author-1":"1","required-1":"1"}},"2":{"email":{"required-1":"1","akismet_comment_author_email-1":"1","name":"Email"}},"3":{"text_name":{"name":"Subject"}},"4":{"telephone":{"name":"Telephone"}},"5":{"textarea_name":{"name":"Message"}}};
                break;
            case "forms_05" :
                jsonPresetVal = {"1":{"text_name":{"name":"Name","required-1":"1","akismet_comment_author-1":"1"}},"2":{"email":{"required-1":"1","name":"Email","akismet_comment_author_email-1":"1"}},"3":{"text_name":{"required-1":"1","name":"Subject"}},"4":{"textarea_name":{"name":"Message"}}};
                break;
            case "forms_06" :
                jsonPresetVal = {"1":{"text_name":{"required-1":"1","name":"Name","akismet_comment_author-1":"1"}},"2":{"email":{"required-1":"1","name":"Email","akismet_comment_author_email-1":"1"}},"3":{"text_name":{"name":"Subject"}},"4":{"text_name":{"name":"Subject"}},"5":{"textarea_name":{"name":"Message"}}};
                break;
            case "forms_07" :
                jsonPresetVal = {"1":{"text_name":{"required-1":"1","name":"Name","akismet_comment_author-1":"1"}},"2":{"email":{"required-1":"1","name":"Email","akismet_comment_author_email-1":"1"}},"3":{"text_name":{"required-1":"1","name":"Subject"}},"4":{"telephone":{"name":"Telephone"}},"5":{"text_name":{"name":"Some else"}},"6":{"text_name":{"name":"Some else"}},"7":{"text_name":{"name":"Some else"}},"8":{"text_name":{"name":"Some else"}}};
                break;
            case "forms_08" :
                jsonPresetVal = {"1":{"text_name":{"name":"Name","required-1":"1","akismet_comment_author-1":"1"}},"2":{"email":{"required-1":"1","name":"Email","akismet_comment_author_email-1":"1"}},"3":{"text_name":{"name":"Subject"}},"4":{"telephone":{"name":"Telephone"}},"5":{"text_name":{"name":"Some else"}},"6":{"textarea_name":{"name":"Message"}}};
                break;
            default:
                jsonPresetVal = {"1": {"text_name": {"required-1": "1", "name": "Name", "akismet_comment_author-1": "1"}}, "2": {"email": {"name": "Email", "required-1": "1", "akismet_comment_author_email-1": "1"}}, "3": {"text_name": {"name": "Subject"}}, "4": {"textarea_name": {"name": "Message"}}};
                ;
        }
        valueStr = JSON.stringify(jsonPresetVal);
        base = $(".check_layout_" + form);
        base.val(valueStr);
    };
    dfd.updateAvaliableFields = function(){

        var fields = [
        ];
        for(elm in dfd.values) {
            for(name in dfd.values[elm]) {
                fields.push(name + "-" + elm);
            }
        }
        $("#available_fields").text("");
        for(field in fields) {
            $("#available_fields").append("{{" + fields[field] + "}}<br>");
        }
    };
    dfd.preset1 = function(){
        /*Show label to text field*/
        dfd.triggerSwitchOn("show_label_text");
        /*Show placeholder*/
        dfd.triggerSwitchOff("placeholder");
        /*Border Style*/
        dfd.SetSelectValue("border_style", "solid");
        dfd.setInputVal("borderwidth", 1);
        dfd.setInputVal("border_radius", 2);
        dfd.setColor("header_color", "#0a0a0a");
        dfd.setColor("text_color", "#565656");
        dfd.setColor("border_color", "#e8e8e8");
        dfd.setColor("input_background", "#f5f5f5");
        dfd.setInputVal("vert_margin_btw_inputs", 15);
        dfd.setInputVal("horiz_margin_btw_inputs", 10);
        dfd.setInputVal("text_area_height", 10);
        /* Button */
        dfd.SetSelectValue("btn_text_transform", "inherit");
        dfd.setInputVal("font_size", 13);
        dfd.setInputVal("letter_spacing", 0);
        dfd.setInputVal("button_border_width", 1);
        dfd.setColor("button_border_color", "#bc9b72");
        dfd.setColor("button_border_color_on_hover", "#9f8465");
        dfd.SetSelectValue("button_border_style", "solid");
        dfd.setInputVal("button_border_radius", 2);
        dfd.setColor("button_backgrond", "#bc9b72");
        dfd.setColor("hover_button_backgrond", "#9f8465");
        dfd.setColor("button_color_text", "#ffffff");
        dfd.setColor("button_hover_color_text", "#ffffff");
        dfd.SetSelectValue("text_align", "center");
        dfd.SetSelectValue("btn_width", "dfd-third-size");
        dfd.SetSelectValue("btn_align", "left");
        /********/

    }
    dfd.preset2 = function(){
        /*Show label to text field*/
        dfd.triggerSwitchOff("show_label_text");
        /*Show placeholder*/
        dfd.triggerSwitchOn("placeholder");
        /*Border Style*/
        dfd.SetSelectValue("border_style", "solid");
        dfd.setInputVal("borderwidth", 2);
        dfd.setInputVal("border_radius", 0);
        dfd.setColor("header_color", "#0a0a0a");
        dfd.setColor("text_color", "#565656");
        dfd.setColor("border_color", "#e8e8e8");
        dfd.setColor("input_background", "#ffffff");
        dfd.setInputVal("vert_margin_btw_inputs", 0);
        dfd.setInputVal("horiz_margin_btw_inputs", 0);
        dfd.setInputVal("text_area_height", 10);
        dfd.SetSelectValue("btn_align", "center");
        
        /* Button */
        dfd.SetSelectValue("btn_text_transform", "inherit");
        dfd.setInputVal("font_size", 13);
        dfd.setInputVal("letter_spacing", 0);
        dfd.setInputVal("button_border_width", 0);
        dfd.setColor("button_border_color", "inherit");
        dfd.setColor("button_border_color_on_hover", "inherit");
        dfd.SetSelectValue("button_border_style", "solid");
        dfd.setInputVal("button_border_radius", 0);
        dfd.setColor("button_backgrond", "transparent");
        dfd.setColor("hover_button_backgrond", "#000000");
        dfd.setColor("button_color_text", "#0a0a0a");
        dfd.setColor("button_hover_color_text", "#ffffff");
        dfd.SetSelectValue("text_align", "center");
        dfd.SetSelectValue("btn_width", "");
        dfd.SetSelectValue("btn_align", "center");
        /********/
    };
    dfd.preset3 = function(){
        /*Show label to text field*/
        dfd.triggerSwitchOff("show_label_text");
        /*Show placeholder*/
        dfd.triggerSwitchOn("placeholder");
        /*Border Style*/
        dfd.SetSelectValue("border_style", "solid");
        dfd.setInputVal("borderwidth", 1);
        dfd.setInputVal("border_radius", 0);
        dfd.setColor("header_color", "#0a0a0a");
        dfd.setColor("text_color", "#565656");
        dfd.setColor("border_color", "#e8e8e8");
        dfd.setColor("input_background", "#ffffff");
        dfd.setInputVal("vert_margin_btw_inputs", 10);
        dfd.setInputVal("horiz_margin_btw_inputs", 10);
        dfd.setInputVal("text_area_height", 10);

       /* Button */
        dfd.SetSelectValue("btn_text_transform", "inherit");
        dfd.setInputVal("font_size", 13);
        dfd.setInputVal("letter_spacing", 0);
        dfd.setInputVal("button_border_width", 1);
        dfd.setColor("button_border_color", "#bc9b72");
        dfd.setColor("button_border_color_on_hover", "#9f8465");
        dfd.SetSelectValue("button_border_style", "solid");
        dfd.setInputVal("button_border_radius", 2);
        dfd.setColor("button_backgrond", "#bc9b72");
        dfd.setColor("hover_button_backgrond", "#9f8465");
        dfd.setColor("button_color_text", "#ffffff");
        dfd.setColor("button_hover_color_text", "#ffffff");
        dfd.SetSelectValue("text_align", "center");
        dfd.SetSelectValue("btn_width", "dfd-third-size");
        dfd.SetSelectValue("btn_align", "left");
        /********/

    };
    dfd.triggerSwitchOn = function(name){
        $("[name='" + name + "']").attr("value", "on");
        $("[name='" + name + "']").attr("checked", "checked");
    };
    dfd.triggerSwitchOff = function(name){
        $("[name='" + name + "']").attr("value", "off");
        $("[name='" + name + "']").removeAttr("checked");
    };
    dfd.SetSelectValue = function(name, value){
        $("select[name='" + name + "']").val(value);
    };
    dfd.setInputVal = function(name, value){
        $("[name='" + name + "']").val(value);
    };
    dfd.setColor = function(name, value){
        dfd.setInputVal(name, value);
        $("[name='" + name + "']").parent().prev().css("background-color", value);
    };

})(jQuery, Dfd_Contact_form_field);
Dfd_Contact_form_field.init();


