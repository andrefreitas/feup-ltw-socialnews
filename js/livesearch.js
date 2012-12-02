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
    			
    	
    			if(data==null || data.results==0) $('.searchresults').fadeOut(200);
    			else {
            console.log(data.results);
            putResults(data.data);
            $('.searchresults').fadeIn(800);
          }
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
		item.innerHTML="<a href=\""+data[i].url+"\">"+data[i].title+"</a><br>";
		item.innerHTML=item.innerHTML+"<span class=\"excerpt\">..."+data[i].excerpt+"...</span>";
		ulList.appendChild(item);
	}
}
// Collapsable edit user
$('.redit').click(function(){
   alert("Teste");

});