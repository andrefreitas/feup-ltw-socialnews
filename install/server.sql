/* Server Information */
drop table if exists serverInfo;
create table serverInfo(
	name text primary key,
	adminEmail text
);


/* Users Actions */
drop table if exists userAction;
create table userAction (
	id integer primary key autoincrement,
	name text
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
	timePosted text,
	content text,
	userId integer,
	metricsId integer,
	foreign key(userId) references user(id),
	foreign key(metricsId) references newsMetrics(id)
);

/* Comment */
drop table if exists comment;
create table comment(
	id integer primary key autoincrement,
	content text,
	datePosted date,
	timePosted text,
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
	newId integer
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

/* List top commenters */
drop view if exists topCommenters;
create view topCommenters As
	select user.name,user.id, count(*) as total
	from user,comment
	where user.id=comment.userId
	group by user.id
	order by count(*) DESC;

/* List the top tags */
drop view if exists topTags;
create view topTags As
	select tag.name,tag.id, count(*) as totalUsed
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

/* Tests 

insert into user(name) values('Joao');
insert into user(name) values('Carlos');
insert into user(name) values('Maria');

insert into comment(userId) values(2);
insert into comment(userId) values(3);
insert into comment(userId) values(3);

insert into tag(name) values("sport");
insert into tag(name) values("cars");

insert into newsTag(tagId) values(1);
insert into newsTag(tagId) values(2);
insert into newsTag(tagId) values(2);

insert into newsTag(tagId) values(2);
	*/