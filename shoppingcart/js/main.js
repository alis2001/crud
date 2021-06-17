
function fetch(str="") {

	var xhttp;
	if (str == "") {
		document.getElementById("last_div").innerHTML = "";

	}else{


		xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				document.getElementById("last_div").innerHTML = this.responseTest;
			}
		}


	}
	xhttp.open("POST", "index.php", true);
	xhttp.send();

}
