let bouttons = document.getElementsByClassName("voir");
for (let i=0;i<bouttons.length;i++){
	bouttons[i].addEventListener("click",function(){
		let iframe = document.getElementById("vue");
		iframe.src = this.getAttribute("data-file");

	});
}