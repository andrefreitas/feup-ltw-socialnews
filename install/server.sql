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
	userActionId integer
);

/* User */
drop table if exists user;
create table user(
	id integer primary key autoincrement,
	name text,
	email text,
	password text,
	privilegeId integer
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
	userId integer
);

/* Comment */
drop table if exists comment;
create table comment(
	id integer primary key autoincrement,
	content text,
	datePosted date,
	timePosted text,
	userId integer,
	newId integer
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
	newId integer,
	tagId integer
);

/* List of external server with news web services*/
drop table if exists newsServer;
create table newsServer(
	serverId integer primary key autoincrement,
	name text,
	apiurl text
);