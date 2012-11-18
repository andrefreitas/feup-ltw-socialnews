// Fade in latest news
$(document).ready(function(){
	$('.latestNews ul').fadeIn(800);
});

// Update latest news time
var latestNewsTimes= new Array();

function updateLatestNewsTimes(){
	var diffTimes=new Array();
	for (i=0; i<latestNewsTimes.length; i++){
		console.log(computeDiff(latestNewsTimes[i]));
		console.log(latestNewsTimes[i]);
	}
	
}


function computeDiff(date){
	date=new Date(date);
	var today= new Date();
	if(today.getFullYear()==date.getFullYear()){
		if(today.getMonth()==date.getMonth()){
			if(today.getUTCDate()==date.getUTCDate()){
				if(today.getHours()==date.getHours()){
					if(today.getMinutes()==date.getMinutes()){
						return (today.getSeconds()-date.getSeconds())+ "s ago";
					}
					else{
						return (today.getMinutes()-date.getMinutes())+ "m ago";
					}
				}else{
					return (today.getHours()-date.getHours())+ "h ago";
				}
			}else {
				return (today.getUTCDate()-date.getUTCDate())+ "d ago";
			}
		} else {
			return (today.getMonth()-date.getMonth())+ "M ago";
		}
	}else {
		return (today.getFullYear()-date.getFullYear())+ "Y ago";
	}
}