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

/* Users */
drop table if exists user;
create table user(
	id integer primary key autoincrement,
	name text,
	email text,
	password text,
	privilegeId integer
);

/* News*/
drop table if exists new;
create table new(
	id integer primary key autoincrement,
	title text,
	datePosted date,
	timePosted text,
	content text,
	userId integer
);

/* Comments */
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
drop table if exists newTag;
create table newTag(
	newId integer,
	tagId integer
);