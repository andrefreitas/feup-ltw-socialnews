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



	