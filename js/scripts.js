// Fade in latest news
$(document).ready(function(){
	$('.latestNews ul').fadeIn(800);
	if($('.alert').length != 0)
		$('.alert').fadeIn(800);


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

// Compute date diff

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

// Write tags and complete
 $(function(){
            


            //-------------------------------
            // Single field
            //-------------------------------
		    $('#singleFieldTags').tagit({
			    availableTags: sampleTags,
			    // This will make Tag-it submit a single form value, as a comma-delimited field.
			    singleField: true,
                singleFieldNode: $('#mySingleField')
		    });

            // singleFieldTags2 is an INPUT element, rather than a UL as in the other 
            // examples, so it automatically defaults to singleField.
		    $('#singleFieldTags2').tagit({
			    availableTags: sampleTags
		    });


            //-------------------------------
            // Preloading data in markup
            //-------------------------------
            $('#myULTags').tagit({
			    availableTags: sampleTags, // this param is of course optional. it's for autocomplete.
			    // configure the name of the input field (will be submitted with form), default: item[tags]
			    itemName: 'item',
			    fieldName: 'tags'
		    });

            //-------------------------------
            // Tag events
            //-------------------------------
            var eventTags = $('#eventTags');
            eventTags.tagit({
                availableTags: sampleTags,
                onTagRemoved: function(evt, tag) {
                    console.log(evt);
                    alert('This tag is being removed: ' + eventTags.tagit('tagLabel', tag));
                },
                onTagClicked: function(evt, tag) {
                    console.log(tag);
                    alert('This tag was clicked: ' + eventTags.tagit('tagLabel', tag));
                }
            }).tagit('option', 'onTagAdded', function(evt, tag) {
                // Add this callbackafter we initialize the widget,
                // so that onTagAdded doesn't get called on page load.
                alert('This tag is being added: ' + eventTags.tagit('tagLabel', tag));
            });

            //-------------------------------
            // Tag-it methods
            //-------------------------------
            $('#methodTags').tagit({
			    availableTags: sampleTags
		    });

            //-------------------------------
            // Allow spaces without quotes.
            //-------------------------------
            $('#allowSpacesTags').tagit({
                availableTags: sampleTags,
                allowSpaces: true
            });

            //-------------------------------
            // Remove confirmation
            //-------------------------------
            $('#removeConfirmationTags').tagit({
                availableTags: sampleTags,
                removeConfirmation: true
            });
            
	    });

// Validate New User Registration form
function validateRegistration(){
	var email=document.forms["register"]["email"].value;
	var name=document.forms["register"]["name"].value;
	var password=document.forms["register"]["password"].value;
	var passwordcheck=document.forms["register"]["passwordcheck"].value;

	// Check Email
	var emailreg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	if(emailreg.test(email) == false) {
    	alert('Invalid email!');
    	return false;
   }

   // Check Passwords
	if(password!=passwordcheck){
		alert('Passwords don\'t match!');
		return false;
	}
}


function deleteUser(id,obj){
	var answer =confirm("Do you really want to delete this user??");

	if(answer==true){
		// Remove from DOM
		var container=obj.parentNode;
		var containerParent=container.parentNode;
		var editbox=container.nextSibling.nextSibling
		containerParent.removeChild(container);
		containerParent.removeChild(editbox);

		// Remove from Database
		var xmlHttp = null;
	    xmlHttp = new XMLHttpRequest();
	    xmlHttp.open( "GET", "api/deleteuser.php?apikey=jabana123&userid="+id, false );
	    xmlHttp.send( null );
	    return xmlHttp.responseText;
	} 
}

function editUser(id,obj){
	var editbox=obj.parentNode;
	var answer =confirm("Do you really want to commit changes?");
	if(answer==false)return false;

	// Fetch values
	var name=editbox.elements["name"].value;
	var email=editbox.elements["email"].value;
	var emailreg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	if(emailreg.test(email) == false && email.length>0) {
    	alert('Invalid email!');
    	return false;
   }
	var password=editbox.elements["password"].value;
	var password2=editbox.elements["password2"].value;
	if(password!=password2){
		alert('Passwords don\'t match');
		return false;
	}
	var privilege=editbox.elements["privilege"].value;

	// Edit user console.log(name+" "+email+" "+password+ " " + password2 + " " + privilege);

	var requestURL="api/edituser.php?apikey=jabana123&userid="+id;

	if(name.length>0) requestURL=requestURL+"&name="+name;
	if(email.length>0) requestURL=requestURL+"&email="+email;
	if(privilege.length>0) requestURL=requestURL+"&privilege="+privilege;
	if(password.length>0) requestURL=requestURL+"&password="+password;

	console.log(requestURL);

	// Edit
	var xmlHttp = null;
	xmlHttp = new XMLHttpRequest();
	xmlHttp.open( "GET",requestURL, false );
	xmlHttp.send( null );
	document.location.reload(true);
	return xmlHttp.responseText;


	
}

function addServer(obj){
	var form=obj.parentNode;
	var servername=form.elements["servername"].value;
	var serverurl=form.elements["serverurl"].value;

	if(servername.length==0 || serverurl.length==0 ){
		alert("Please fill all the data");
		return false;
	} 

	// Do request
	requestURL="api/addserver.php?apikey=jabana123&servername="+servername+"&serverurl="+serverurl;

	// Edit
	var xmlHttp = null;
	xmlHttp = new XMLHttpRequest();
	xmlHttp.open( "GET",requestURL, false );
	xmlHttp.send( null );
    var answer=JSON.parse(xmlHttp.responseText); 
  

    // Clean
    form.elements["servername"].value="";
    form.elements["serverurl"].value="";

    // Add to the dom
    var serverlist=document.getElementsByClassName("serverlist")[0];
    var serveritem=document.createElement("div");
    serveritem.setAttribute("class","serveritem");
    serveritem.innerHTML="<span class=\"servname\">"+servername+ "</span> <span class=\"servurl\">" + serverurl+"</span><span class=\"deleteserver\">Delete Server</span> <span class=\"importnews\" onclick=\"importNews(this,"+answer.Serverid+")\">Import News</span>";
    
    serverlist.appendChild(serveritem);

}

var importedNews;

function importNews(obj,serverid){

	 // Request data
	var startDate=prompt("Start Date?","2012-01-01T00:00:00");
	while(startDate==null)
	startDate=prompt("Start Date?","2012-01-01T00:00:00");
	var endDate=prompt("End Date?","2012-12-01T00:00:00");
	while(endDate==null)
	endDate=prompt("End Date?","2012-12-01T00:00:00");
	var tags=prompt("Tags? (separated by space)","");
	while(endDate==null)
	endDate=prompt("Tags? (separated by space)","");

	// Fetch remote news

	requestURL="api/fetchremotenews.php?start_date="+startDate+"&end_date="+endDate+"&tags="+tags+"&serverid="+serverid; 
	//requestURL="api/fetchremotenews.php?start_date=2010-10-01T01:01:01&end_date=2012-12-01T01:01:01&tags=Feup&serverid=42";
	var xmlHttp = null;
	xmlHttp = new XMLHttpRequest();
	xmlHttp.open( "GET",requestURL, false );
	xmlHttp.send( null );
    var answer=JSON.parse(xmlHttp.responseText); 
   if(answer.result=="error"){
   		alert("No results :(");
   		return false;
   }
  	// Process Answer
  	importedNews=answer.data;


  	// Add news inside a box to allow user to select
  	var serverbox=obj.parentNode;
  	var newslist=document.createElement("form");
  	for(var i=0; i< importedNews.length; i++){
  		newslist.innerHTML=newslist.innerHTML+"<div class=\"newsresulti\"><input type=\"checkbox\" name=\""+importedNews[i].id+"\" value=\""+importedNews[i].id+"\">"+importedNews[i].title+"</div>";
  		console.log(importedNews[i].title);
  	}
    newslist.innerHTML=newslist.innerHTML+"<button type=\"button\" onclick=\"saveNewsToDatabase("+serverid+",this)\" >Import news</button>";
  	serverbox.appendChild(newslist);
}
