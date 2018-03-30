// /* ====== HELPER FUNCTIONS ====== */

//similar to PHP's empty function
function empty(data)
{
	if(typeof(data) == 'number' || typeof(data) == 'boolean')
	{
		return false;
	}
	if(typeof(data) == 'undefined' || data === null)
	{
		return true;
	}
	if(typeof(data.length) != 'undefined')
	{
		return data.length === 0;
	}
	var count = 0;
	for(var i in data)
	{
		// if(data.hasOwnProperty(i))
		//
		// This doesn't work in ie8/ie9 due the fact that hasOwnProperty works only on native objects.
		// http://stackoverflow.com/questions/8157700/object-has-no-hasownproperty-method-i-e-its-undefined-ie8
		//
		// for hosts objects we do this
		if(Object.prototype.hasOwnProperty.call(data,i))
		{
			count ++;
		}
	}
	return count === 0;
}

/* --- Set Query Parameter--- */
function setQueryParameter(uri, key, value) {
	var re = new RegExp("([?|&])" + key + "=.*?(&|$)", "i");
	separator = uri.indexOf('?') !== -1 ? "&" : "?";
	if (uri.match(re)) {
		return uri.replace(re, '$1' + key + "=" + value + '$2');
	}
	else {
		return uri + separator + key + "=" + value;
	}
}
