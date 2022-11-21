var contadorM = 19, contadorS = 59;
setInterval(() => {
	if(contadorS == 0){
		contadorS = 59;
		contadorM--;
	}
	
	if(contadorS < 9) {
		document.getElementById("h2Timer").innerHTML = contadorM+":0"+contadorS;
	}

	else {
		document.getElementById("h2Timer").innerHTML = contadorM+":"+contadorS;
	}
	contadorS--;
}, 1000)