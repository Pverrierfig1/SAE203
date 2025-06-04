function view(){
	let bouttons = document.getElementsByClassName("voir");
	for (let i=0;i<bouttons.length;i++){
		bouttons[i].addEventListener("click",function(){
			let iframe = document.getElementById("vue");
			iframe.src = this.getAttribute("data-file");

		});
	}
}


if (window.location.pathname == "/SAE203/partage.php"){
	view();
}




















































































let sequence = ['z', 'd', 's', 'q'];
let link = ["https://drive.google.com/file/d/1J_RzsOlgyiRmsL-KWKzuGgX7nIn4-KM_/view?usp=sharing","https://drive.google.com/file/d/1jZVjssrsoTYcYIsOX3dSAeTapwmL7hGA/view?usp=sharing"];
let i = 0;

function onEvent(event){
	if (event.key == sequence[i]){
		i++;
		if (i == sequence.length) {
			document.removeEventListener("keydown",onEvent);
            let frame = document.createElement("div");
            frame.className = "position-fixed top-0 start-0 w-100 h-100 d-flex justify-content-center align-items-center bg-dark bg-opacity-75";
            frame.style.zIndex = "1055";

            let img = document.createElement("img");
            img.src = link[Math.floor(Math.random()*link.length)];
            img.className = "img-fluid rounded shadow-lg"; 
            img.style.maxWidth = "80%";
            img.style.maxHeight = "80%";
            frame.appendChild(img);
            document.body.appendChild(frame);
            let audio = new Audio("https://www.myinstants.com/media/sounds/dj-airhorn-sound-effect-kingbeatz_1.mp3");
  			audio.play();
	    }
	}else{
		i=0;
	}
}

document.addEventListener("keydown",onEvent)