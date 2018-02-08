window.onload = function() {
	var form = document.getElementsByClassName("form")[0];

	function FormDataToJSON(FormElement){    
	    var formData = new FormData(FormElement);
	    var ConvertedJSON= {};
	    for (const [key, value]  of formData.entries())
	    {
	        ConvertedJSON[key] = value;
	    }

    	return ConvertedJSON;

	}

	form.onsubmit = function(event){
		event.preventDefault();
		var receivedJSON = FormDataToJSON(form);
		console.log(receivedJSON);
		var formData = new FormData();
		formData.append("data", receivedJSON);
		// var request = new XMLHttpRequest();
		// request.open("POST", "api/logic/login.php");
		// request.send(formData);
		// window.location = "api/logic/login.php";
		// form.submit(formData);
	}
}