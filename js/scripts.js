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
    serveritem.innerHTML="<span class=\"servname\">"+servername+ "</span> <span class=\"servurl\">" + serverurl+"</span><span class=\"deleteserver\" onclick=\"deleteServer(this,"+answer.Serverid+")\"><a href=\"#\">Delete Server</a></span> <span class=\"importnews\" onclick=\"importNews(this,"+answer.Serverid+")\"><a href=\"#\">Import News</a></span>";
    
    serverlist.appendChild(serveritem);

}

var importedNewsAr=Array();

function importNews(obj,serverid){

	//Clean previous search
	var serverbox=obj.parentNode;
  	if(serverbox.getElementsByTagName("form").length>0){
  		serverbox.removeChild(serverbox.getElementsByTagName("form")[0]);
  	}

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
   if(answer.result=="error" || answer.data.length==0 ){
   		alert("No results :(");
   		return false;
   }
  	
  	// Process Answer
  	importedNewsAr[serverid.toString()]=answer.data;

  	importedNews=answer.data;
  	// Add news inside a box to allow user to select
  	var newslist=document.createElement("form");
  	for(var i=0; i< importedNews.length; i++){
  		newslist.innerHTML=newslist.innerHTML+"<div class=\"newsresulti\"><input type=\"checkbox\" name=\""+importedNews[i].id+"\" value=\""+importedNews[i].id+"\">"+importedNews[i].title+"</div>";
  		//console.log(importedNews[i].title);
  	}
    newslist.innerHTML=newslist.innerHTML+"<button type=\"button\" class=\"saveimportednews\" onclick=\"saveNewsToDatabase("+serverid+",this)\" >Import news</button>";
  	serverbox.appendChild(newslist);
}

function inArray(array, value) {
    for (var i = 0; i < array.length; i++) {
        if (array[i] == value) return true;
    }
    return false;
}

function saveNewsToDatabase(serverid,obj){

	// Fetch checked ids
	var newsForm=obj.parentNode;
	var allchecks=newsForm.getElementsByTagName("input");
	var checkedIds=Array();
	for(var i=0; i<allchecks.length; i++){
		if(allchecks[i].checked){
			checkedIds.push(allchecks[i].value);
		}
	}

	// Save selected news titles and urls in database
	var thisservernews=importedNewsAr[serverid.toString()];
	var selectednews=Array();
	for(var i=0; i<thisservernews.length; i++){
		if( inArray(checkedIds,thisservernews[i].id)){
			var news=Array();
			news["title"]=thisservernews[i].title;
			news["url"]=thisservernews[i].url;
			news["id"]=thisservernews[i].id;
			//console.log(news);
			selectednews.push(news);
		}
	}
	if(selectednews.length==0) return false;
	newsForm.parentNode.removeChild(newsForm);

	// Use api to save each imported news
	var success=true;
	for(var i=0; i<selectednews.length; i++){
			var title=selectednews[i]['title'];
			var url=selectednews[i]['url'];
			// Send request to save news
			var requestURL="api/saveremotenews.php?apikey=jabana123&serverid="+serverid+"&title="+title+"&url="+url;
			var xmlHttp = null;
			xmlHttp = new XMLHttpRequest();
			xmlHttp.open( "GET",requestURL, false );
			xmlHttp.send( null );
			 var answer=JSON.parse(xmlHttp.responseText); 
   			if(answer.result=="error") success=false;
   			
	}
	if(success) alert("News saved sucessfully :)");
	else alert("News could not be saved :(");

}

function deleteServer(obj,serverid){
	alert(serverid);
	var answer =confirm("Are you sure you want to delete this server?");
	if(answer==false)return false;

	var serveritem=obj.parentNode;
	serveritem.parentNode.removeChild(serveritem);
}

function favoriteNews(obj,userid,newsid){
	// First check state
	var isfavorite=true;
	var requestURL="api/newsisfavorite.php?apikey=jabana123&userid="+userid+"&newsid="+newsid;
	var xmlHttp = null;
	xmlHttp = new XMLHttpRequest();
    xmlHttp.open( "GET",requestURL, false );
    xmlHttp.send( null );
	var answer=JSON.parse(xmlHttp.responseText); 
   	if(answer.Answer=="no") isfavorite=false;

   // Favorite or unfavorite
   var action="1";
   if(isfavorite) var action="0";
   var requestURL="api/dofavoritenews.php?apikey=jabana123&userid="+userid+"&newsid="+newsid+"&action="+action;
   var xmlHttp = null;
   xmlHttp = new XMLHttpRequest();
   xmlHttp.open( "GET",requestURL, false );
   xmlHttp.send( null );

   // Update image
   if(action=="1"){
   	obj.setAttribute("src","imgs/favoriteyes.png");
   }else {
   	obj.setAttribute("src","imgs/favoriteno.png");
   }

   // Remove if is in myfavorites.php
   if(window.location.href.toString().search("myfavorites.php")>0 && action=="0"){
   	var line=obj.parentNode;
   	line.parentNode.removeChild(line);
   	console.log("Removeu");
   }

}

function addComment(obj,newsid,userid,author){
	var form=obj.parentNode;
	var content=form.elements["content"].value;
	console.log(content);


	// Process request
	var requestURL="api/addcomment.php?apikey=jabana123&newsid="+newsid+"&userid="+userid+"&content="+content;
	var xmlHttp = null;
	xmlHttp = new XMLHttpRequest();
	xmlHttp.open( "GET",requestURL, false );
	xmlHttp.send( null );
	var answer=JSON.parse(xmlHttp.responseText); 
	var commentid=-1;
   	if(answer.Answer=="Ok"){
   		commentid=answer.id;
   	} else{
   		return false;
   	}


	// Add to the commentlist
	var commentslist=document.getElementsByClassName("commentslist")[0];
	var comment=document.createElement("div");
	console.log(commentslist.innerHTML);
	comment.setAttribute("class","commenti");
	var insidehtml="<span class=\"commentauthor\">"+author+"</span>";
	insidehtml=insidehtml+"<span class=\"commentdate\"> just now</span>";
	insidehtml=insidehtml+"<span class=\"editcomment\">Edit</span>";
	insidehtml=insidehtml+"<span class=\"deletecomment\" onclick=\"deleteComment(this,"+commentid+")\">Delete</span><br/>";
	insidehtml=insidehtml+"<div class=\"commentcont\">"+content+"</div>";
	comment.innerHTML=insidehtml;

	commentslist.insertBefore(comment,commentslist.firstChild);

}

function deleteComment(obj,id){
	var answer =confirm("Do you really want to delete this comment??");
	if(answer==false) return false;

	// Process request
	var requestURL="api/deletecomment.php?apikey=jabana123&id="+id;
	xmlHttp = new XMLHttpRequest();
	xmlHttp.open( "GET",requestURL, false );
	xmlHttp.send( null );
	var answer=JSON.parse(xmlHttp.responseText); 
	if(answer.Answer!="Ok") return false;
   	
   	// Delete from dom
   	var comment=obj.parentNode;
   	comment.parentNode.removeChild(comment);

}