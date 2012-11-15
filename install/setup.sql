/* Server Information */
drop table if exists serverInfo;
create table serverInfo(
	name text primary key
);


/* Users Actions */
drop table if exists userAction;
create table userAction (
	id integer primary key autoincrement,
	name text,
	description text
);

/* Privileges */
drop table if exists privilege;
create table privilege(
	id integer primary key autoincrement,
	name text
);

/* Actions * - * Privileges */
drop table if exists userActionPrivilege;
create table userActionPrivilege (
	privilegeId integer,
	userActionId integer,
	foreign key(privilegeId) references privilege(id),
	foreign key(userActionId) references userAction(id)
);

/* User */
drop table if exists user;
create table user(
	id integer primary key autoincrement,
	name text,
	email text,
	password text,
	privilegeId integer,
	picture text,
	foreign key(privilegeId) references privilege(id)
);

/* News*/
drop table if exists news;
create table news(
	id integer primary key autoincrement,
	title text,
	thumbnail text,
	datePosted date,
	content text,
	userId integer,
	foreign key(userId) references user(id)
);

/* Comment */
drop table if exists comment;
create table comment(
	id integer primary key autoincrement,
	content text,
	datePosted date,
	userId integer,
	newsId integer,
	foreign key(userId) references user(id),
	foreign key(newsId) references news(id) 
);

/* Favorites */
drop table if exists favorite;
create table favorite(
	id integer primary key autoincrement,
	userId integer,
	newsId integer,
	foreign key(newsID) references news(id)
);

/* Tags */
drop table if exists tag;
create table tag(
	id integer primary key autoincrement,
	name text
);

/* Tags * - * News */
drop table if exists newsTag;
create table newsTag(
	newsId integer,
	tagId integer,
	primary key (newsId,tagId),
	foreign key(newsId) references news(id),
	foreign key(tagId) references tag(id)
);

/* List of external server with news web services*/
drop table if exists newsServer;
create table newsServer(
	serverId integer primary key autoincrement,
	name text,
	apiurl text
);


/* Metrics*/
drop table if exists newsMetrics;
create table newsMetrics(
	id integer primary key autoincrement,
	newsId integer,
	pageviews integer,
	searchs integer,
	comments integer,
	foreign key(newsId) references news(id)
);

/* List latest news */
drop view if exists latestNews;
create view latestNews As 
	select * from news order by datePosted;

/* List news with metrics */

drop view if exists topNews;
create view topNews As
	select id , pageviews*0.3+ searchs*0.3 + comments*0.4 as Score
	from newsMetrics
	order by Score DESC;


/* List top commenters */
drop view if exists topCommenters;
create view topCommenters As
	select user.id, count(*) as total
	from user,comment
	where user.id=comment.userId
	group by user.id
	order by count(*) DESC;

/* List the top tags */
drop view if exists topTags;
create view topTags As
	select tag.id, count(*) as totalUsed
	from tag,newsTag
	where tag.id=newsTag.tagId
	group by tag.id
	order by count(*) DESC;

/* Trigger for metrics */
create trigger updateNewsMetrics 
after insert on comment 
  BEGIN
    update newsMetrics
    set comments=comments+1
    where newsId=new.newsId;
  END;

create trigger createNewsMetrics 
after insert on news
  BEGIN
    insert into newsMetrics(newsId,pageviews,searchs,comments)
    values (new.id,0,0,0);
  END;
  
/* Trigger to remove news */
create trigger removeNews
after delete on news
  BEGIN
    delete from comment
    where newsId=old.id;

    delete from newsMetrics
    where newsId=old.id;

    delete from favorite
    where newsId=old.id;
  END;

/***********************************************************
					    DEFAULT DATA
***********************************************************/

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

/* Map privileges */

/* Admin */
insert into userActionPrivilege(privilegeId,userActionId) values(1,1);
insert into userActionPrivilege(privilegeId,userActionId) values(1,2);
insert into userActionPrivilege(privilegeId,userActionId) values(1,3);
insert into userActionPrivilege(privilegeId,userActionId) values(1,4);
insert into userActionPrivilege(privilegeId,userActionId) values(1,5);
insert into userActionPrivilege(privilegeId,userActionId) values(1,6);
insert into userActionPrivilege(privilegeId,userActionId) values(1,7);
insert into userActionPrivilege(privilegeId,userActionId) values(1,8);
insert into userActionPrivilege(privilegeId,userActionId) values(1,9);
insert into userActionPrivilege(privilegeId,userActionId) values(1,10);
insert into userActionPrivilege(privilegeId,userActionId) values(1,11);
insert into userActionPrivilege(privilegeId,userActionId) values(1,12);
insert into userActionPrivilege(privilegeId,userActionId) values(1,13);
insert into userActionPrivilege(privilegeId,userActionId) values(1,14);
insert into userActionPrivilege(privilegeId,userActionId) values(1,15);
insert into userActionPrivilege(privilegeId,userActionId) values(1,16);
insert into userActionPrivilege(privilegeId,userActionId) values(1,17);
insert into userActionPrivilege(privilegeId,userActionId) values(1,18);
insert into userActionPrivilege(privilegeId,userActionId) values(1,19);
insert into userActionPrivilege(privilegeId,userActionId) values(1,20);
insert into userActionPrivilege(privilegeId,userActionId) values(1,21);
insert into userActionPrivilege(privilegeId,userActionId) values(1,22);
insert into userActionPrivilege(privilegeId,userActionId) values(1,23);
insert into userActionPrivilege(privilegeId,userActionId) values(1,24);
insert into userActionPrivilege(privilegeId,userActionId) values(1,25);
insert into userActionPrivilege(privilegeId,userActionId) values(1,26);

/* Editor */
insert into userActionPrivilege(privilegeId,userActionId) values(2,1);
insert into userActionPrivilege(privilegeId,userActionId) values(2,2);
insert into userActionPrivilege(privilegeId,userActionId) values(2,3);
insert into userActionPrivilege(privilegeId,userActionId) values(2,4);
insert into userActionPrivilege(privilegeId,userActionId) values(2,5);
insert into userActionPrivilege(privilegeId,userActionId) values(2,6);
insert into userActionPrivilege(privilegeId,userActionId) values(2,7);
insert into userActionPrivilege(privilegeId,userActionId) values(2,8);
insert into userActionPrivilege(privilegeId,userActionId) values(2,9);
insert into userActionPrivilege(privilegeId,userActionId) values(2,10);
insert into userActionPrivilege(privilegeId,userActionId) values(2,11);
insert into userActionPrivilege(privilegeId,userActionId) values(2,12);
insert into userActionPrivilege(privilegeId,userActionId) values(2,13);
insert into userActionPrivilege(privilegeId,userActionId) values(2,14);
insert into userActionPrivilege(privilegeId,userActionId) values(2,15);
insert into userActionPrivilege(privilegeId,userActionId) values(2,16);
insert into userActionPrivilege(privilegeId,userActionId) values(2,17);

/* User */
insert into userActionPrivilege(privilegeId,userActionId) values(3,1);
insert into userActionPrivilege(privilegeId,userActionId) values(3,2);
insert into userActionPrivilege(privilegeId,userActionId) values(3,3);
insert into userActionPrivilege(privilegeId,userActionId) values(3,4);
insert into userActionPrivilege(privilegeId,userActionId) values(3,5);
insert into userActionPrivilege(privilegeId,userActionId) values(3,6);
insert into userActionPrivilege(privilegeId,userActionId) values(3,7);
insert into userActionPrivilege(privilegeId,userActionId) values(3,8);
insert into userActionPrivilege(privilegeId,userActionId) values(3,9);
insert into userActionPrivilege(privilegeId,userActionId) values(3,10);
insert into userActionPrivilege(privilegeId,userActionId) values(3,11);
insert into userActionPrivilege(privilegeId,userActionId) values(3,12);
insert into userActionPrivilege(privilegeId,userActionId) values(3,13);

/* Guest */
insert into userActionPrivilege(privilegeId,userActionId) values(4,1);
insert into userActionPrivilege(privilegeId,userActionId) values(4,2);
insert into userActionPrivilege(privilegeId,userActionId) values(4,3);
insert into userActionPrivilege(privilegeId,userActionId) values(4,4);
insert into userActionPrivilege(privilegeId,userActionId) values(4,5);
insert into userActionPrivilege(privilegeId,userActionId) values(4,6);