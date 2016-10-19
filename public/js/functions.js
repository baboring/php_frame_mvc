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


function generateRandPwd(digits) {

    var symbols = "~!@#$%^&*()-_=+[]{};:,.<>?";     // etc

    var pwd = "";
    for(i=0;i<digits;++i) {
        switch(getRandomInt(0,3)){
            case 0:
                pwd += String.fromCharCode(getRandomInt(48,57));    // number
                break;
            case 1:
                pwd += String.fromCharCode(getRandomInt(65,90));    // upper letter 
                break;
            case 2:
                pwd += String.fromCharCode(getRandomInt(97,122));   // lower letter
                break;
            case 3:
                pwd += symbols[getRandomInt(0,symbols.length-1)];
                break;
        }
    }
    return pwd;
}

function HistoryBack() {
    window.history.back();
}
function GoUrl(url) {
    document.location.href = url;
}

function var_dump(obj) {
    str = JSON.stringify(obj);
    str = JSON.stringify(obj, null, 4); // (Optional) beautiful indented output.
    //console.log(str); // Logs output to dev tools console.
    return str; // Displays output using window.alert()
}