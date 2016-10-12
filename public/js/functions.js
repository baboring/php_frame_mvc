/* -------------------------------------------------------------
 purpos : maintain functionallity utilities
------------------------------------------------------------- */
function isElementHidden (element) {
	return window.getComputedStyle(element, null).getPropertyValue('display') === 'none';
}

function hide(eId)
{
	var div = document.getElementById(eId);
	if(div == null)
		alert(eId + "is Null");
	if (div.style.display !== "none") {
		div.style.display = "none";
	}
}
function show(eId)
{
	var div = document.getElementById(eId);
	if(div == null)
		alert(eId + "is Null");
	if (div.style.display !== "block") {
		div.style.display = "block";
	}
}

function post(path, params, method) {
    method = method || "post"; // Set method to post by default if not specified.

    // The rest of this code assumes you are not using a library.
    // It can be made less wordy if you use one.
    var form = document.createElement("form");
    form.setAttribute("method", method);
    form.setAttribute("action", path);

    for(var key in params) {
        if(params.hasOwnProperty(key)) {
            var hiddenField = document.createElement("input");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", key);
            hiddenField.setAttribute("value", params[key]);

            form.appendChild(hiddenField);
         }
    }

    document.body.appendChild(form);
    form.submit();
}


/* -------------------------------------------------------------
 purpos : random
------------------------------------------------------------- */
function getRandomInt(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}
