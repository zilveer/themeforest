
(function($){


	PexetoCustomizer = function(options){
		
		this.options = options;
		this.init();
	};

	PexetoCustomizer.prototype = {
		init : function(){
			var option;

			this.$styles = [];
			this.$header = $('header');

			for(var i in this.options){
				option = this.options[i];

				if(option['type']=='color'){
					this.setColorOption(option);
				}
			}
		},

		getElementsObj : function(rules){
			var elements = [];

			for(var i in rules){
				//cache the elements

				if(i=='rgba-bg'){
					for(var j in rules[i]){
						elements.push({
							sel : rules[i][j]['selector'],
							alpha : rules[i][j]['alpha'],
							key : i
						});
					}
				}else{
					elements.push({
						sel : rules[i],
						key : i
					});
				}
				
			}

			return elements;
		},

		setColorOption : function(option){

			var rules = option.rules,
				elements,
				self = this;

			if(!rules){
				return;
			}

			elements = this.getElementsObj(rules);

			wp.customize( option['id'], function( value ) {
				value.bind( function( newval ) {
					var $style = $('<style />'),
						styleVal = '',
						rgba;

					for(var i in elements){
						if(elements[i].key=='rgba-bg'){
							rgba = self.hexToRgba(newval);
							if(rgba){
								styleVal += elements[i].sel+'{background-color:rgba('+rgba['r']+','+rgba['g']+','+rgba['b']+','+elements[i].alpha+');}';
							}
						}else{
							styleVal += elements[i].sel+'{'+ elements[i].key+':'+newval+';}';
						}
						
					}

					if(self.$styles[option['id']]){
						self.$styles[option['id']].remove();
					}

					$style.append(styleVal);
					self.$header.append($style);
					self.$styles[option['id']] = $style;

				} );
			} );

		},

		hexToRgba : function( hex ) {
			var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
				return result ? {
					r: parseInt(result[1], 16),
					g: parseInt(result[2], 16),
					b: parseInt(result[3], 16)
				} : null;
		}
	};


}(jQuery));
