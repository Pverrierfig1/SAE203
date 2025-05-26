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
let link = ["https://cdn.discordapp.com/attachments/1282612270391889943/1376453330506612738/sc2.jpg?ex=6835618f&is=6834100f&hm=2f3673310cec3c23d9ccf3ad6c84ecaeb213ed8bddeea73d6f662584641efe83&","https://cdn.discordapp.com/attachments/1282612270391889943/1376453330892623983/sc1.jpg?ex=6835618f&is=6834100f&hm=7a583950d23861b9835576815482647b8ca321a6a9e22c4b25523a0b8de8a435&"];
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