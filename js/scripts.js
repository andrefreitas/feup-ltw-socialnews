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