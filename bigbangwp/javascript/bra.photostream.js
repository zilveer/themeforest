/*
Flickr API key: http://www.flickr.com/services/apps/create/noncommercial/
*/
var flickr_api_key = "40877bb0e10edad168a2ccee1f176fb7";
/*
Instagam token: http://www.brankic1979.com/instagram/
*/
var instagram_token = "338517687.1912c81.b47c05c499c1401d90d7afcfc2bb7def";

(function($){
    $.fn.extend({
        bra_photostream: function(options) {
 
            var defaults = {
                user: 'brankic1979',
                limit: 10,
				social_network: 'dribbble',
				api_token: ''
				
            };
            
			
			function create_html(data, container) {
				var feeds = data.feed;
				if (!feeds) {
					return false;
				}
				var html = '';		
				html += '<ul>';
					
				for (var i = 0; i < feeds.entries.length; i++) {
					var entry = feeds.entries[i];
					var content = entry.content;
					html += '<li>'+ content +'</li>'		
				}
					
				html += '</ul>';
					
				$(container).html(html);
			
				$(container).find("li").each(function(){
					pin_img_src = $(this).find("img").attr("src");
					pin_url = "http://www.pinterest.com" + $(this).find("a").attr("href");
					pin_desc = $(this).find("p:nth-child(2)").html();
					pin_desc = pin_desc.replace("'", "`");
					$(this).empty();
					$(this).append("<a target='_blank' href='" + pin_url + "' title='" + pin_desc + "'><img src='" + pin_img_src + "' alt=''></a>");
					var img_w = $(this).find("img").width();
					var img_h = $(this).find("img").height();
					if (img_w < img_h){
						$(this).find("img").addClass("portrait")
					}
					else {
						$(this).find("img").addClass("landscape")
					}
				});
			};

            var options = $.extend(defaults, options);
         
            return this.each(function() {
                  var o = options;
                  var obj = $(this); 
				  
				  if (o.social_network == "dribbble") {
					  obj.append("<ul></ul>")
					  $.getJSON("http://dribbble.com/" + o.user + "/shots.json?callback=?", function(data){
							$.each(data.shots, function(i,shot){
								if (i < o.limit) {
								  var img_title = shot.title;
								  img_title = img_title.replace("'", "`")
								  var image = $('<img/>').attr({src: shot.image_teaser_url, alt: img_title});
								  var url = $('<a/>').attr({href: shot.url, target: '_blank', title: img_title});
								  var url2 = $(url).append(image);
								  var li = $('<li/>').append(url2);
								  $("ul", obj).append(li);
								}
							});
							$("li img", obj).each(function(){
								var img_w = $(this).width();
								var img_h = $(this).height();
								if (img_w < img_h){
									$(this).addClass("portrait")
								}
								else {
									$(this).addClass("landscape")
								}
							});	
					   });		  
				  }
				  if (o.social_network == "pinterest") {  
					var url = 'http://pinterest.com/' + o.user + '/feed.rss'
					var api = "http://ajax.googleapis.com/ajax/services/feed/load?v=1.0&callback=?&q=" + encodeURIComponent(url);
					api += "&num=" + o.limit;
					api += "&output=json_xml"
					
					//alert(api);
				
					// Send request
					$.getJSON(api, function(data){	
						// Check for error
						if (data.responseStatus == 200) {
							// Process the feeds
							create_html(data.responseData, obj);
				
							// Optional user callback function
							if ($.isFunction(fn)) fn.call(this,$e);
							
						} else {
							alert("wrong user for pinterest");
				
						};
					});	
				  }
				  if (o.social_network == "flickr") {

						if (o.api_token == "") o.api_token = flickr_api_key;
						obj.append("<ul></ul>")
						$.getJSON("https://api.flickr.com/services/rest/?method=flickr.people.findByUsername&username=" + o.user + "&format=json&api_key=" + o.api_token + "&jsoncallback=?", function(data){
						var flickr_status = data.stat; 
						if (flickr_status == "ok") {  						
								var nsid = data.user.nsid;
								$.getJSON("https://api.flickr.com/services/rest/?method=flickr.photos.search&user_id=" + nsid + "&format=json&api_key=" + o.api_token + "&per_page=" + o.limit + "&page=1&extras=url_sq&jsoncallback=?", function(data){
									$.each(data.photos.photo, function(i,img){
										var img_owner = img.owner;
										var img_title = img.title;
										var img_src = img.url_sq;
										var img_id = img.id;
										var img_url = "http://www.flickr.com/photos/" + img_owner + "/" + img_id;
										var image = $('<img/>').attr({src: img_src, alt: img_title});
										var url = $('<a/>').attr({href: img_url, target: '_blank', title: img_title});
										var url2 = $(url).append(image);
										var li = $('<li/>').append(url2);
										$("ul", obj).append(li);
									})
							   })
						}
						

						if (flickr_status == "fail") {
							$.getJSON("https://api.flickr.com/services/rest/?method=flickr.people.findByEmail&find_email=" + o.user+ "&format=json&api_key=" + o.api_token + "&jsoncallback=?", function(data){
							var nsid = data.user.nsid;
								$.getJSON("https://api.flickr.com/services/rest/?method=flickr.photos.search&user_id=" + nsid + "&format=json&api_key=" + o.api_token + "&per_page=" + o.limit + "&page=1&extras=url_sq&jsoncallback=?", function(data){
									$.each(data.photos.photo, function(i,img){
										var img_owner = img.owner;
										var img_title = img.title;
										var img_src = img.url_sq;
										var img_id = img.id;
										var img_url = "http://www.flickr.com/photos/" + img_owner + "/" + img_id;
										var image = $('<img/>').attr({src: img_src, alt: img_title});
										var url = $('<a/>').attr({href: img_url, target: '_blank', title: img_title});
										var url2 = $(url).append(image);
										var li = $('<li/>').append(url2);
										$("ul", obj).append(li);
									})
							   })
							})	
							
						}
						
								;
						
						
						});
						 	


					   	

				  }
				  
				  if (o.social_network == "instagram") {
					    if (o.api_token == "") o.api_token = instagram_token; 
						obj.append("<ul></ul>")						
						url =  "https://api.instagram.com/v1/users/search?q=" + o.user + "&access_token=" + o.api_token + "&count=10&callback=?";
						$.getJSON(url, function(data){
							$.each(data.data, function(i,shot){
								  var instagram_username = shot.username;

								  if (instagram_username == o.user){

									  var user_id = shot.id;

									if (user_id != ""){	
										url =  "https://api.instagram.com/v1/users/" + user_id + "/media/recent/?access_token=" + o.api_token + "&count=" + o.limit + "&callback=?";
										$.getJSON(url, function(data){

											$.each(data.data, function(i,shot){
																   
											  var img_src = shot.images.thumbnail.url;
											  
											  var img_url = shot.link;
											  var img_title = "";
											  if (shot.caption != null){
											  img_title = shot.caption.text;
											  }
											  var image = $('<img/>').attr({src: img_src, alt: img_title});
											  var url = $('<a/>').attr({href: img_url, target: '_blank', title: img_title});
											  var url2 = $(url).append(image);
											  var li = $('<li/>').append(url2);
											  $("ul", obj).append(li);
						
											});
										});
									}   
								  }
							});
						});						
						
						
						
						

					
				  }
				  
				  
            }); // return this.each
        }
    });
})(jQuery);
//////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
(function($){
    $.fn.extend({
        bra_photostream_large: function(options) {
 
            var defaults = {
                user: 'brankic1979',
                limit: 12,
				social_network: 'dribbble',
				columns: 4, // 4, 3, 2 columns
				shape: 'none',
				api_token: ''
				
            };
            
			
			function create_html(data, container, columns, shape) {
				var feeds = data.feed;
				if (!feeds) {
					return false;
				}
				var html = '';
				
				if (shape == "none") {
					html += '<div class="portfolio-grid"><ul id="thumbs">'
				} else {
					html += '<div class="portfolio-grid"><ul id="thumbs" class="shaped ' + shape + '">'
				}
					
				for (var i = 0; i < feeds.entries.length; i++) {
					var entry = feeds.entries[i];
					var content = entry.content;
					if (shape == "none") {
						html += '<li class="item col' + columns + '">'+ content +'</li>'
					} else {
						html += '<li class="item">'+ content +'</li>'
					}
							
				}
					
				html += '</ul></div>';
				container.removeClass("photostream");	
				container.html(html);
			
				container.find("li").each(function(){
					pin_img_src = $(this).find("img").attr("src");
					pin_img_src = pin_img_src.replace("_b.jpg", "_c.jpg")
					pin_url = "http://www.pinterest.com" + $(this).find("a").attr("href");
					pin_desc = $(this).find("p:nth-child(2)").html();
														
					pin_desc = pin_desc.replace("'", "`");
					$(this).empty();
					if (shape == "none") {
					$(this).append("<img src='" + pin_img_src + "' alt=''><div class='item-info col" + columns + "'><h3 class='title'><a target='_blank' href='" + pin_url + "' title='" + pin_desc + "'>"+ pin_desc + "</a></h3></div>");
					$(this).append('<div class="item-info-overlay"><div><a href="' + pin_url + '" class="view">details</a><a href="' + pin_img_src + '" class="preview" data-rel="prettyPhoto[]">preview</a></div>	</div><!--END ITEM-INFO-OVERLAY-->');
					} else {
					$(this).append("<div class='item-container'><img src='" + pin_img_src + "' alt='' style='width:100%; height:auto'></div>");
					$(this).append('<div class="item-info-overlay"><div><h3 class="title"><a target="_blank" href="' + pin_url + '" title="' + pin_desc + '">'+ pin_desc + '</a></h3><a href="' + pin_url + '" class="view">details</a><a href="' + pin_img_src + '" class="preview" data-rel="prettyPhoto[]">preview</a></div>	</div><!--END ITEM-INFO-OVERLAY-->');												
					}

				});
			};

            var options = $.extend(defaults, options);
         
            return this.each(function() {
                  var o = options;
                  var obj = $(this); 
				  
				  if (o.social_network == "dribbble") {
					  html = "";
					  if (o.shape == "none") {
							html += '<div class="portfolio-grid"><ul id="thumbs">'
						} else {
							html += '<div class="portfolio-grid"><ul id="thumbs" class="shaped ' + o.shape + '">'
						}
					  
					  $.getJSON("http://dribbble.com/" + o.user + "/shots.json?callback=?", function(data){
							$.each(data.shots, function(i,shot){

								if (i < o.limit) {
									
								if (o.shape == "none") {
									html += '<li class="item col' + o.columns + '">';
								} else {
									html += '<li class="item">';
								}
								  var img_title = shot.title;
								  img_title = img_title.replace("'", "`")
								  
								  if (o.shape == "none") {
									html += "<img width='100%' src='" + shot.image_url + "' alt=''><div class='item-info col" + o.columns + "'><h3 class='title'><a target='_blank' href='" + shot.url + "' title='" + img_title + "'>"+ img_title + "</a></h3></div>";
									html += '<div class="item-info-overlay"><div><a href="' + shot.url + '" class="view">details</a><a title="' + img_title + '" href="' + shot.image_url + '" class="preview" data-rel="prettyPhoto[]">preview</a></div>	</div><!--END ITEM-INFO-OVERLAY-->';
									} else {
									html +=  "<div class='item-container'><img src='" + shot.image_url + "' alt='' style=''></div>";
									html += '<div class="item-info-overlay"><div><h3 class="title"><a target="_blank" href="' + shot.url + '" title="' + img_title + '">'+ img_title + '</a></h3><a href="' + shot.url + '" class="view">details</a><a title="' + img_title + '" href="' + shot.image_url + '" class="preview" data-rel="prettyPhoto[]">preview</a></div>	</div><!--END ITEM-INFO-OVERLAY-->';												
									}
									html += "</li>";
								  
								}
							});
							
							html += "</ul></div>";
							
							obj.append(html);
							obj.removeClass("photostream");
							$("li img", obj).each(function(){
								var img_w = $(this).width();
								var img_h = $(this).height();
								if (img_w < img_h){
									$(this).addClass("portrait")
								}
								else {
									$(this).addClass("landscape")
								}
							});	
					   });		  
				  }
				  if (o.social_network == "pinterest") {  
					var url = 'http://pinterest.com/' + o.user + '/feed.rss'
					var api = "http://ajax.googleapis.com/ajax/services/feed/load?v=1.0&callback=?&q=" + encodeURIComponent(url);
					api += "&num=" + o.limit;
					api += "&output=json_xml"
					
					//alert(api);
				
					// Send request
					$.getJSON(api, function(data){	
						// Check for error
						if (data.responseStatus == 200) {
							// Process the feeds
							create_html(data.responseData, obj, o.columns, o.shape);
				
							// Optional user callback function
							if ($.isFunction(fn)) fn.call(this,$e);
							
						} else {
							alert("wrong user for pinterest");
				
						};
					});	
				  }
				  if (o.social_network == "flickr") {
					    if (o.api_token == "") o.api_token = flickr_api_key;  
						html = "";
					    if (o.shape == "none") {
							html += '<div class="portfolio-grid"><ul id="thumbs">'
						} else {
							html += '<div class="portfolio-grid"><ul id="thumbs" class="shaped ' + o.shape + '">'
						}
						
						
						$.getJSON("https://api.flickr.com/services/rest/?method=flickr.people.findByUsername&username=" + o.user + "&format=json&api_key=" + o.api_token + "&jsoncallback=?", function(data){
						var flickr_status = data.stat; 
						if (flickr_status == "ok") {  						
								var nsid = data.user.nsid;
								$.getJSON("https://api.flickr.com/services/rest/?method=flickr.photos.search&user_id=" + nsid + "&format=json&api_key=" + o.api_token + "&per_page=" + o.limit + "&page=1&extras=url_z,url_o,url_m&jsoncallback=?", function(data){
									$.each(data.photos.photo, function(i,img){
									var img_owner = img.owner;
									var img_title = img.title;
									var img_src = img.url_z;
									var img_src_o = img.url_o;
									var img_src_m = img.url_m;
									
									if (img_src_o == undefined) img_src_o = img_src_m;
									var img_id = img.id;
									var img_url = "http://www.flickr.com/photos/" + img_owner + "/" + img_id;
									if (img_src == undefined) img_src = img_src_o;
									//if (img_src == undefined) img_src = img_src_b;
									if (o.shape == "none") {
										html += '<li class="item col' + o.columns + '">';
									} else {
										html += '<li class="item">';
									}
									//alert(img_title)
									
									if (o.shape == "none") {
									html += "<img width='100%' src='" + img_src + "' alt=''><div class='item-info col" + o.columns + "'><h3 class='title'><a target='_blank' href='" + img_url + "' title='" + img_title + "'>"+ img_title + "</a></h3></div>";
									html += '<div class="item-info-overlay"><div><a href="' + img_url + '" class="view">details</a><a title="' + img_title + '" href="' + img_src_o + '" class="preview" data-rel="prettyPhoto[]">preview</a></div>	</div><!--END ITEM-INFO-OVERLAY-->';
									} else {
									html +=  "<div class='item-container'><img src='" + img_src + "' alt='' style='height:auto'></div>";
									html += '<div class="item-info-overlay"><div><h3 class="title"><a target="_blank" href="' + img_url + '" title="' + img_title + '">'+ img_title + '</a></h3><a href="' + img_url + '" class="view">details</a><a title="' + img_title + '" href="' + img_src_o + '" class="preview" data-rel="prettyPhoto[]">preview</a></div>	</div><!--END ITEM-INFO-OVERLAY-->';												
									}
									html += "</li>";
									//alert(html)
								})
								html += "</ul></div>";
								obj.append(html);
								obj.removeClass("photostream");
							   })
							   
						}
						

						if (flickr_status == "fail") {
							$.getJSON("https://api.flickr.com/services/rest/?method=flickr.people.findByEmail&find_email=" + o.user+ "&format=json&api_key=" + o.api_token + "&jsoncallback=?", function(data){
							var nsid = data.user.nsid;
								$.getJSON("https://api.flickr.com/services/rest/?method=flickr.photos.search&user_id=" + nsid + "&format=json&api_key=" + o.api_token + "&per_page=" + o.limit + "&page=1&extras=url_z,url_o,url_m&jsoncallback=?", function(data){
									$.each(data.photos.photo, function(i,img){
									var img_owner = img.owner;
									var img_title = img.title;
									var img_src = img.url_z;
									var img_src_o = img.url_o;
									var img_src_m = img.url_m;
									if (img_src_o == undefined) img_src_o = img_src_m;
									var img_id = img.id;
									var img_url = "http://www.flickr.com/photos/" + img_owner + "/" + img_id;
									if (img_src == undefined) img_src = img_src_o;
									//if (img_src == undefined) img_src = img_src_b;
									if (o.shape == "none") {
										html += '<li class="item col' + o.columns + '">';
									} else {
										html += '<li class="item">';
									}
									
									if (o.shape == "none") {
									html += "<img width='100%' src='" + img_src + "' alt=''><div class='item-info col" + o.columns + "'><h3 class='title'><a target='_blank' href='" + img_url + "' title='" + img_title + "'>"+ img_title + "</a></h3></div>";
									html += '<div class="item-info-overlay"><div><a href="' + img_url + '" class="view">details</a><a title="' + img_title + '" href="' + img_src_o + '" class="preview" data-rel="prettyPhoto[]">preview</a></div>	</div><!--END ITEM-INFO-OVERLAY-->';
									} else {
									html +=  "<div class='item-container'><img src='" + img_src + "' alt='' style='height:auto'></div>";
									html += '<div class="item-info-overlay"><div><h3 class="title"><a target="_blank" href="' + img_url + '" title="' + img_title + '">'+ img_title + '</a></h3><a href="' + img_url + '" class="view">details</a><a title="' + img_title + '" href="' + img_src_o + '" class="preview" data-rel="prettyPhoto[]">preview</a></div>	</div><!--END ITEM-INFO-OVERLAY-->';												
									}
									html += "</li>";
								})
								obj.append(html);
								obj.removeClass("photostream");
							   })
							})	
							
						};
						
						//obj.append(html);

						
						
						});						
						
	

				  }
				  
				  if (o.social_network == "instagram") { 
				        if (o.api_token == "") o.api_token = instagram_token; 
						html = "";
					    if (o.shape == "none") {
							html += '<div class="portfolio-grid"><ul id="thumbs">'
						} else {
							html += '<div class="portfolio-grid"><ul id="thumbs" class="shaped ' + o.shape + '">'
						}
											
						url =  "https://api.instagram.com/v1/users/search?q=" + o.user + "&access_token=" + o.api_token + "&count=10&callback=?";
						$.getJSON(url, function(data){
							$.each(data.data, function(i,shot){
								  var instagram_username = shot.username;

								  if (instagram_username == o.user){

									  var user_id = shot.id;

									if (user_id != ""){	
										url =  "https://api.instagram.com/v1/users/" + user_id + "/media/recent/?access_token=" + o.api_token + "&count=" + o.limit + "&callback=?";
										$.getJSON(url, function(data){

											$.each(data.data, function(i,shot){
											    if (o.shape == "none") {
													html += '<li class="item col' + o.columns + '">';
												} else {
													html += '<li class="item">';
												}
												
											  var img_src = shot.images.standard_resolution.url;
											  var img_src_o = shot.images.standard_resolution.url;
											  var img_url = shot.link;
											  var img_title = "";
											  if (shot.caption != null){
											  img_title = shot.caption.text;
											  }
											  
												if (o.shape == "none") {
												html += "<img width='100%' src='" + img_src + "' alt=''><div class='item-info col" + o.columns + "'><h3 class='title'><a target='_blank' href='" + img_url + "' title='" + img_title + "'>"+ img_title + "</a></h3></div>";
												html += '<div class="item-info-overlay"><div><a href="' + img_url + '" class="view">details</a><a title="' + img_title + '" href="' + img_src_o + '" class="preview" data-rel="prettyPhoto[]">preview</a></div>	</div><!--END ITEM-INFO-OVERLAY-->';
												} else {
												html +=  "<div class='item-container'><img src='" + img_src + "' alt='' style='height:auto'></div>";
												html += '<div class="item-info-overlay"><div><h3 class="title"><a target="_blank" href="' + img_url + '" title="' + img_title + '">'+ img_title + '</a></h3><a href="' + img_url + '" class="view">details</a><a title="' + img_title + '" href="' + img_src_o + '" class="preview" data-rel="prettyPhoto[]">preview</a></div>	</div><!--END ITEM-INFO-OVERLAY-->';												
												}
												html += "</li>";
						
											});
											html += "</ul></div>";
											obj.append(html);
											obj.removeClass("photostream");
										});
									}   
								  }
							});
						});						
						
						
						
						

					
				  }
				  
				  
            }); // return this.each
        }
    });
})(jQuery);