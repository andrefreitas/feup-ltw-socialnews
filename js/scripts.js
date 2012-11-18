// Fade in latest news
$(document).ready(function(){
	$('.latestNews ul').fadeIn(800);
});

// Update latest news time
var latestNewsTimes= new Array();

function updateLatestNewsTimes(){
	var latestnews=document.getElementsByClassName("latestNews")[0]
	var ul=latestnews.getElementsByTagName("ul")[0]
	var times=ul.getElementsByClassName("time")
	
	var diffTimes=new Array();
	for (i=0; i<times.length; i++){
		times[i].innerHTML=computeDiff(latestNewsTimes[i])
	}
	t=setTimeout(function(){updateLatestNewsTimes()},6000);
}


function computeDiff(date){
	date=new Date(date);
	var today= new Date();
	if(today.getFullYear()==date.getFullYear()){
		if(today.getMonth()==date.getMonth()){
			if(today.getUTCDate()==date.getUTCDate()){
				if(today.getHours()==date.getHours()){
					if(today.getMinutes()==date.getMinutes()){
						return (today.getSeconds()-date.getSeconds())+ "s";
					}
					else{
						return (today.getMinutes()-date.getMinutes())+ "min";
					}
				}else{
					return (today.getHours()-date.getHours())+ "h";
				}
			}else {
				return (today.getUTCDate()-date.getUTCDate())+ "d";
			}
		} else {
	
			return (today.getMonth()-date.getMonth())+ "m";
		}
	}else {
		return (today.getFullYear()-date.getFullYear())+ "year";
	}
}