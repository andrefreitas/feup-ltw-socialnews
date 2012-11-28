// Search
 $(function(){
        $(".word").keyup(function() {

        	// Get typed keyword
            var word=$(this).val();

            // Fetch news from the api
           	$.getJSON("api/searchnews.php?",
 			{
    			keywords: word,
  			},
  			// Handler
  			function(data) 
  			{
    			console.log(data.results);
    			$('.searchresults').fadeIn(800);
    			putResults(data.data);
  			}
  			);


            return false;
        });
    });

function putResults(data){
	
	var searchresults=document.getElementsByClassName ("searchresults")[0];

	var ulList=searchresults.getElementsByTagName("ul")[0];
	ulList.innerHTML="";
	for (var i in data) {
		var item=document.createElement('li');
		item.innerHTML=data[i].title;
		ulList.appendChild(item);
	}
}