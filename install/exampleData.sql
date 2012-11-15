/* Create Privileges  */
insert into privilege(name) values("admin");
insert into privilege(name) values("editor");
insert into privilege(name) values("user");
insert into privilege(name) values("guest");

/* Create Possible Actions 
	Syntax: (action)(objects)
*/
insert into userAction(name,description) values("seeNews","Can view all the news");
insert into userAction(name,description) values("searchNews","Can search news");
insert into userAction(name,description) values("seeNewsDetails","Can see news details such as comments");
insert into userAction(name,description) values("seeProfile","Can see users profiles");	
insert into userAction(name,description) values("register","Can register in the website");
insert into userAction(name,description) values("login","Can login in the website");
insert into userAction(name,description) values("createComment","Can post comments");
insert into userAction(name,description) values("editOwnComment","Can edit own comments");
insert into userAction(name,description) values("deleteOwnComment","Can delete own comments");
insert into userAction(name,description) values("editOwnProfile","Can edit own profile");
insert into userAction(name,description) values("favoriteNews","Can mark or unmark news as favorites");
insert into userAction(name,description) values("seeFavoriteNews","Can see favorite news");
insert into userAction(name,description) values("logout","Can logout from the website");
insert into userAction(name,description) values("createNews","Can create news");
insert into userAction(name,description) values("editOwnNews","Can edit own news");
insert into userAction(name,description) values("deleteOwnNews","Can delete own news");
insert into userAction(name,description) values("deleteOwnNewsComments","Can delete own news");
insert into userAction(name,description) values("editPrivileges","Can change users privileges");
insert into userAction(name,description) values("deleteNews","Can delete all news");
insert into userAction(name,description) values("editNews","Can edit all news");
insert into userAction(name,description) values("createUsers","Can create users");
insert into userAction(name,description) values("editUsers","Can edit users");
insert into userAction(name,description) values("deleteUsers","Can delete users");
insert into userAction(name,description) values("doallNewsServers","Can do all in the news remote servers");
insert into userAction(name,description) values("searchRemoteNews","Can search remote news");
insert into userAction(name,description) values("importRemoteNews","Can import remote news");