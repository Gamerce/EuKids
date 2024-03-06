//take all arrows
const arrows = document.querySelectorAll(".arrow");
const arrowsLeft = document.querySelectorAll(".arrowLeft");
//take all game list
const gamelist = document.querySelectorAll(".game-list");
let clickCounter = 0;


arrows.forEach((arrow,i)=>{
	const itemNumber = gamelist[i].querySelectorAll("img").length;
	

	
	arrow.addEventListener("click",()=>{
		clickCounter++;
			console.log('click');
		if(itemNumber - (3+clickCounter) > 0){
		gamelist[i].style.transform = `translateX(${
        gamelist[i].computedStyleMap().get("transform")[0].x.value - 300
      }px)`;
      
	}else{
		gamelist[i].style.transform = "translateX(0)";
		clickCounter = 0;
	}
		
	});
	
	
	
}); 

arrowsLeft.forEach((arrow,i)=>{
	const itemNumber = gamelist[i].querySelectorAll("img").length;
	
	
	
	arrow.addEventListener("click",()=>{
		
		console.log("left");
		if(clickCounter != 0){
			clickCounter--;
		gamelist[i].style.transform = `translateX(${
        gamelist[i].computedStyleMap().get("transform")[0].x.value + 300
      }px)`;
      
	}else{
		gamelist[i].style.transform = "translateX(0)";
		clickCounter = 0;
	}
		
	});
	
	
}); 


//Audio sliders

const arrowsAudio = document.querySelectorAll(".arrowAudio");
const arrowsLeftAudio = document.querySelectorAll(".arrowLeftAudio");
//take all game list
const audiolist = document.querySelectorAll(".audio-list");
let clickCounterAudio = 0;


arrowsAudio.forEach((arrow,i)=>{
	const itemNumber = audiolist[i].querySelectorAll("img").length;
	

	
	arrow.addEventListener("click",()=>{
		clickCounterAudio++;
			console.log('click');
		if(itemNumber - (4+clickCounterAudio) > 0){
		audiolist[i].style.transform = `translateX(${
        audiolist[i].computedStyleMap().get("transform")[0].x.value - 300
      }px)`;
      
	}else{
		audiolist[i].style.transform = "translateX(0)";
		clickCounterAudio = 0;
	}
		
	});
	
	
	
}); 

arrowsLeftAudio.forEach((arrow,i)=>{
	const itemNumber = audiolist[i].querySelectorAll("img").length;
	
	
	
	arrow.addEventListener("click",()=>{
		
		console.log("left");
		if(clickCounterAudio != 0){
			clickCounterAudio--;
		audiolist[i].style.transform = `translateX(${
        audiolist[i].computedStyleMap().get("transform")[0].x.value + 300
      }px)`;
      
	}else{
		audiolist[i].style.transform = "translateX(0)";
		clickCounterAudio = 0;
	}
		
	});
	
	
}); 


//Video sliders


const arrowsVideo = document.querySelectorAll(".arrowVideo");
const arrowsLeftVideo = document.querySelectorAll(".arrowLeftVideo");
//take all game list
const videolist = document.querySelectorAll(".video-list");
let clickCounterVideo = 0;


arrowsVideo.forEach((arrow,i)=>{
	const itemNumber = videolist[i].querySelectorAll("video").length;
	

	arrow.addEventListener("click",()=>{
		clickCounterVideo++;
			console.log('click v');
		if(itemNumber - (4+clickCounterVideo) > 0){
		videolist[i].style.transform = `translateX(${
        videolist[i].computedStyleMap().get("transform")[0].x.value - 300
      }px)`;
      
	}else{
		videolist[i].style.transform = "translateX(0)";
		clickCounterVideo = 0;
	}
		
	});
	
}); 

arrowsLeftVideo.forEach((arrow,i)=>{
	const itemNumber = videolist[i].querySelectorAll("video").length;
	
	
	
	arrow.addEventListener("click",()=>{
		
		console.log("left");
		if(clickCounterVideo != 0){
			clickCounterVideo--;
		videolist[i].style.transform = `translateX(${
        videolist[i].computedStyleMap().get("transform")[0].x.value + 300
      }px)`;
      
	}else{
		videolist[i].style.transform = "translateX(0)";
		clickCounterVideo = 0;
	}
		
	});
	
	
}); 

const ball = document.querySelector(".toggle-ball");
const items = document.querySelectorAll(".container, .game-list-tittle, .navbar-container, .sidebar, a, a:link, a:visited, a:hover, .toggle");

ball.addEventListener("click",()=>{
	items.forEach(item=>{
		item.classList.toggle("active");
	})
	ball.classList.toggle("active");
})

const hearts = document.querySelectorAll(".game-list-item-heart");
hearts.forEach((heart,i)=>{
	heart.addEventListener("click",()=>{
	heart.classList.toggle("active");
})
}); 
