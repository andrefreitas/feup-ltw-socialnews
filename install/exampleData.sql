

/* Server info */
insert into serverInfo(name) values("T6G1");

/* Create users */

/* Admin - Password: "Jk1L93221" */ 
insert into user(name, email, password,privilegeId,about) 
	values("André Freitas","p.andrefreitas@gmail.com","62761b7bce5cfa40e2280a02edf185f119aaaf54",1,"I am from Madeira and I like sports");

/* Admin - Password: "mlaikem21" */ 
insert into user(name, email, password,privilegeId,about)
	values("Arkadiusz Gorgolewski","arkadiuszgorgolewski@gmail.com","9a7fce5daa7fb717e0c96604d85ff8924c5b339a",1,"I am Poland and I like Mayo");

/* User - Password: "j3j2of2f23g" */ 
insert into user(name, email, password,privilegeId,about)
	values("Peter Griffin","peter@fakemail.com","675ef05929a74c4f45a9912fdebdd5ee5da8585a",3,"Hello I am a fictional person");

/* User - Password: "k5hab4hckuy" */ 
insert into user(name, email, password,privilegeId,about)
	values("Sebastian Loeb","sebastian@fakemail.com","ac155a353b17958f9222559819ca216df88fb49f",3,"Usually I drive cars and stuff");

/* User - Password: "pybec321d" */ 
insert into user(name, email, password,privilegeId,about)
	values("Carl Lemon","carl@fakemail.com","a99fbf53e841abb0be1bfad2bed949d9780e65b6",3,"I like lemons, is just that.");

/* User - Password: "mbHg523hh1" */ 
insert into user(name, email, password,privilegeId,about)
	values("Tom Adams","tom@fakemail.com","b6fcf77bc898cd55dd425b8a17c6b94463730f9c",3,"I am a computer hacker and I hack a lot of websites");

/* Editor - Password: "Jn2ghp3hJ2f" */ 
insert into user(name, email, password,privilegeId,about)
	values("Sara Lee","sara@fakemail.com","df09c9a4cdd82877f44a7ab14f86afd0b9d0f135",2,"Mixed of China and Britain, I love to write");

/* Editor - Password: "Uug2u42gsd" */ 
insert into user(name, email, password,privilegeId,about)
	values("Steve Jacob","steve@fakemail.com","5b19f18fe57040b2f6cb8011f1f23b34d47d7d54",2,"I invented the iStuff and I hate Windows");

/* Editor - Password: "Jjh23kg22d" */ 
insert into user(name, email, password,privilegeId,about)
	values("Alexander Mason","alexander@fakemail.com","398d07bd476b017cc62b2e1758c2887d7b72f7ed",2,"I don't want to describe myself. ");

/* Categories */

insert into category(name) values ('World');
insert into category(name) values ('Sport');
insert into category(name) values ('Economy');
insert into category(name) values ('Health');

/* News (copyright from BBC) */

insert into news(title, url, thumbnail, datePosted,categoryId,userId,content)
	values("Eurozone slides into recession","eurozone-slides-into-recession","bank.jpg","2012-10-03T14:32:01",1,7,"The eurozone has returned to recession as the region's debt crisis continues to hurt demand, figures show.
The economy of the 17-nation bloc contracted by 0.1% between July and September, after shrinking 0.2% in the previous three months, Eurostat said.
The eurozone was last in recession in 2009, when the economy contracted for five consecutive quarters.
The news comes a day after millions of workers in Europe held a day of action against austerity measures.
Protests in Spain, Italy and Portugal were marred by violence.
Countries such as Greece that have been bailed out by international lenders continue to see their economies shrink. Meanwhile larger economies such as Spain have imposed spending cuts in an attempt to avoid having to ask for a bailout.");

insert into news(title, url, thumbnail, datePosted,categoryId,userId,content)
	values("Breakfast, lunch and dinner: Have we always eaten them?","breakfast-lunch-dinner","breakfast.jpg","2012-11-04T08:17:05",2,7,
		"British people - and many others across the world - have been brought up on the idea of three square meals a day as a normal eating pattern, but it wasn't always that way.
		People are repeatedly told the hallowed family dinner around a table is in decline and the UK is not the only country experiencing such change.
		The case for breakfast, missed by many with deleterious effects, is that it makes us more alert, helps keep us trim and improves children's work and behaviour at school.
		But when people worry that breaking with the traditional three meals a day is harmful, are they right about the traditional part? Have people always eaten in that pattern?");

insert into news(title, url, thumbnail, datePosted,categoryId,userId,content)
	values("Is Zlatan's wonder strike the best goal ever scored?","best-goal-ever-scored","goal.jpg","2012-11-01T18:54:12",3,7,"Zlatan Ibrahimovic has dominated backpages all over the world since scoring an audacious overhead kick in 
		Sweden's 4-2 win over England on Wednesday. 
		CNN charts social media reaction as people debate whether Ibrahimovic's goal was was the greatest ever scored..");

insert into news(title, url, thumbnail, datePosted,categoryId,userId,content)
	values("Can Twitter help save Spanish soccer club Real Oviedo?","club-real-oviedo","twitter.jpg","2012-09-05T11:02:56",4,7,"In an age when Russian oligarchs and Arab Sheikhs spend billions of dollars on forging the perfect dream team, 
		fan ownership has become a novelty for many of Europe's top soccer clubs. 
		But it is a route that might just be the salvation of struggling Spanish team Real Oviedo, thanks to a social media campaign that has gone viral.");

insert into news(title, url, thumbnail, datePosted,categoryId,userId,content)
	values("Spanish banks stop evictions for the next 2 years","spanish-bank-stop","bank.jpg","2012-03-01T20:31:07",1,7,"Spaniards who are in circumstances of extreme necessity and are unable to pay their mortgages will not be evicted from their 
		homes over the next two years, the main industry group for Spanish banks said Monday.");

insert into news(title, url, thumbnail, datePosted,categoryId,userId,content)
	values("After months of mystery, China unveils new top leaders","china-unveils-news-top-leaders","china.jpg","2012-10-09T04:32:08",2,8,"China on Thursday unveiled the elite group of leaders who will set the agenda for the country for the next decade, 
		the culmination of months of secretive bargaining and a carefully choreographed performance of political pomp.");

insert into news(title, url, thumbnail, datePosted,categoryId,userId,content)
	values("Foreign policy priorities for Obama","priorities-for-obama","obama.jpg","2012-10-16T12:45:30",3,8,"Barack Obama has won reelection as America’s president. But while the economy – and avoiding the so-called fiscal cliff – 
		will inevitably take up much of his time, there are numerous foreign policy challenges facing the next administration. 
		GPS asked 10 leading foreign policy analysts to name 10 things that Obama should focus on next. The views expressed are, of course, the authors' own.");

insert into news(title, url, thumbnail, datePosted,categoryId,userId,content)
	values("Who was the best foreign policy president?","best-foreign-president","president.jpg","2012-09-19T18:12:56",4,8," Both for his leadership turning one of our country’s moments of greatest vulnerability into the triumph of World War II, 
		and for the vision to begin building the postwar peace, Franklin D. Roosevelt deserves the highest ranking. 
		Congressional isolationists had blocked most of FDR’s efforts to start mobilizing the American industrial base and preparing the American people for the war. ");

insert into news(title, url, thumbnail, datePosted,categoryId,userId,content)
	values("Time to Say Danke","time-to-say-danke","germany.jpg","2012-10-03T19:22:55",1,8,"Everyone is worried that Greece will default on its national debt. That's really not news. By one estimate, since it gained its independence from the Ottomans in 1832, 
		Greece has been in default or restructuring for half this period. The news is that this time, Germany is willing to bail it out.");

insert into news(title, url, thumbnail, datePosted,categoryId,userId,content)
	values("Reading While Eating for Nov. 15: State of the Union","reading-while-eating-state-of-the-union","reading.jpg","2012-08-14T21:00:38",2,8,"Secessionists, Unite! More than half a million people from all 50 states have signed on to the 
		White House petition site We The People in order to demand that their state be allowed to secede from the union following Obama’s reelection. 
		Of course,  others are just looking out for Alderaan. (TIME.com)
");

	insert into news(title, url, thumbnail, datePosted,categoryId,userId,content)
	values("$800 million biotech business started in a garage","business-started-in-garage","business.jpg","2012-03-03T00:11:18",3,9,"Bangalore, India (CNN) -- As one of India's richest self-made women, Kiran Mazumdar-Shaw has an impressive 
		resume. Her business Biocon, worth $800million, is one of India's leading drug companies and employs more than 6,000 people at its vast campus in Bangalore.");

insert into news(title, url, thumbnail, datePosted,categoryId,userId,content)
	values("From muse to moneymaker","from-muse-to-moneymaker","work.jpg","2012-04-23T15:38:46",4,9,"From Warhol's silkscreens of Marilyn Monroe to Picasso's nudes, it has generally been easier for women to be the 
		subject of paintings than to have their own work exhibited.");

insert into news(title, url, thumbnail, datePosted,categoryId,userId,content)
	values("Cristiano Ronaldo and Daniel Craig - A right to privacy?","a-right-to-privacy","cr7.jpg","2012-11-18T01:14:56",1,9,"Both men have their photos plastered across billboards worldwide, their pictures on television 
		commercials broadcast around the globe and their private lives played out on the internet.
So why do the likes of Craig and Ronaldo, who make millions of dollars from their public image, believe they deserve privacy?");

insert into news(title, url, thumbnail, datePosted,categoryId,userId,content)
	values("Muamba was in effect dead for 78 minutes despite 15 heart shocks","muamba-dead-for-78-minutes","muamba.jpg","2012-08-10T17:51:10",2,9,"Bolton Wanderers midfielder Fabrice Muamba did not respond to 15 defibrillator shocks and 
		was in effect dead for 78 minutes before his heart started beating again, doctors who treated him have revealed.");

insert into news(title, url, thumbnail, datePosted,categoryId,userId,content)
	values("America's black cowboys fight for their place in history","america-black-cowboys","cowboys.jpg","2012-10-08T11:26:17",3,9,"Jason Griffin straps his right arm in bandages, preparing himself to grip the reins a wildly bucking bronco. Tall, broad-shouldered, 
		with a rough beard, he steps into his cowboy boots, fits a Stetson hat and heads out to meet his mount in the rodeo arena.");

	insert into news(title, url, thumbnail, datePosted,categoryId,userId,content)
	values("Chinese sculptor Xiang Jing's painful search for truth","chinese-sculptor-xiang","sculpture.jpg","2012-09-07T08:48:45",4,8,"Her work has been exhibited in America and throughout Europe. She was the subject of a recent joint survey show at the Museum of Contemporary Art Shanghai. 
		She was one of four winners of this year's Martell Artists of the Year competition and was also recently featured in Italian Vogue.");

insert into news(title, url, thumbnail, datePosted,categoryId,userId,content)
	values("Opera singers are athletes","opera-singers-are-athletes","opera.jpg","2012-10-26T16:38:01",1,8,"Anita Hartig, 29, has just debuted at La Scala in Milan in the role of Mimi in Puccini's much-loved La Boheme. The Romanian soprano rose to fame after a critic mentioned her to Ioan Holender when 
		he was the musical director of the Vienna State Opera.");

insert into news(title, url, thumbnail, datePosted,categoryId,userId,content)
	values("Golden boxer reveals her secret","golden-boxer-reveals-her-secret","dogs.jpg","2012-10-29T12:38:35",2,9,"Nicola Adams, 29, is the first ever Olympic gold medalist in women's boxing. In front of a home crowd at the London 2012 Olympics, she fought her way past a year-long injury to knock down Chinese boxer Ren Cancan in the final. 
		Here she reveals how she fell in love with the sport and her heartache when she almost couldn't carry on");

insert into news(title, url, thumbnail, datePosted,categoryId,userId,content)
	values("Clouds on horizon for tobacco farmers","clouds-on-horizon-for-tobacco","farmer.jpg","2012-10-06T16:59:17",3,9,"Government officials and health experts from around the world are meeting this week in South Korea to discuss a series of proposals that could put 
		restrictions on tobacco growing.The fifth session of the World Health Organization Framework Convention on Tobacco Control (WHO FCTC) is taking place in Seoul, where representatives 
		from over 170 international parties will focus on reducing the demand for tobacco.");

insert into news(title, url, thumbnail, datePosted,categoryId,userId,content)
	values("Oil search fuels tension over Lake Malawi","fuels-tension-over-lake-malawi","oil.jpg","2012-07-03T18:32:07",4,7,"Lake Malawi, Malawi (CNN) -- Following recent oil finds in Uganda and Kenya, Malawi hopes to be the next East African country to strike black gold.
Malawi has awarded British oil company Surestream Petroleum the only contract to search for oil beneath Lake Malawi, the body of water that borders Malawi, Mozambiue and Tanzania.");

/* Tags */
insert into tag(name) values("ensino");
insert into tag(name) values("Cultura");
insert into tag(name) values("Politica");
insert into tag(name) values("Economia");
insert into tag(name) values("Desporto");
insert into tag(name) values("Feup");
insert into tag(name) values("Sociedade");
insert into tag(name) values("europe");
insert into tag(name) values("life");
insert into tag(name) values("health");

/* Map tags to news */
insert into newsTag(newsId, tagId) values(1,1);
insert into newsTag(newsId, tagId) values(2,1);
insert into newsTag(newsId, tagId) values(3,2);
insert into newsTag(newsId, tagId) values(4,2);
insert into newsTag(newsId, tagId) values(5,3);
insert into newsTag(newsId, tagId) values(6,3);
insert into newsTag(newsId, tagId) values(7,4);
insert into newsTag(newsId, tagId) values(8,4);
insert into newsTag(newsId, tagId) values(9,5);
insert into newsTag(newsId, tagId) values(10,5);
insert into newsTag(newsId, tagId) values(11,6);
insert into newsTag(newsId, tagId) values(12,6);
insert into newsTag(newsId, tagId) values(13,7);
insert into newsTag(newsId, tagId) values(14,7);
insert into newsTag(newsId, tagId) values(15,8);
insert into newsTag(newsId, tagId) values(16,8);
insert into newsTag(newsId, tagId) values(17,9);
insert into newsTag(newsId, tagId) values(18,9);
insert into newsTag(newsId, tagId) values(19,10);
insert into newsTag(newsId, tagId) values(20,10);

/* Comments */
insert into comment(userId,newsId,content,datePosted) 
	values(1,1,"I total agree with that","2012-12-10T15:23:03");

insert into comment(userId,newsId,content,datePosted) 
	values(1,1,"I think the editor should be more clear in this","2012-12-10T15:23:11");

insert into comment(userId,newsId,content,datePosted) 
	values(1,1,"No wonder this happens a lot","2012-12-10T15:23:46");

insert into comment(userId,newsId,content,datePosted) 
	values(2,2,"Music is for everyone","2012-12-10T15:23:39");

insert into comment(userId,newsId,content,datePosted) 
	values(2,2,"Why them don't have privacy???","2012-12-10T15:23:45");

insert into comment(userId,newsId,content,datePosted) 
	values(2,2,"Fuel is very bad, use clean energy!","2012-12-10T15:23:56");

insert into comment(userId,newsId,content,datePosted) 
	values(1,3,"I didn't like this post","2012-12-10T15:23:32");

insert into comment(userId,newsId,content,datePosted) 
	values(1,3,"Obama is a good president","2012-12-10T15:23:45");

insert into comment(userId,newsId,content,datePosted) 
	values(3,3,"People lie a lot in news","2012-12-10T15:23:23");

insert into comment(userId,newsId,content,datePosted) 
	values(4,4,"I like cookies","2012-12-10T15:23:33");

insert into comment(userId,newsId,content,datePosted) 
	values(4,4,"When this happened?","2012-12-10T15:23:05");

insert into comment(userId,newsId,content,datePosted) 
	values(4,4,"I think the problem is with the world","2012-12-10T15:23:32");

insert into comment(userId,newsId,content,datePosted) 
	values(5,5,"Money is all that matters.. whatever","2012-12-10T15:23:55");

insert into comment(userId,newsId,content,datePosted) 
	values(2,5,"I want to be famous too","2012-08-10T11:25:45");

insert into comment(userId,newsId,content,datePosted) 
	values(2,5,"Singers have good voices (captain obvious strikes again)","2012-11-20T15:23:12");

/* Remote servers */
insert into newsServer(name,apiurl) values("Tiago Server","http://gnomo.fe.up.pt/~ei10090/stopreadgo/api/news.php");
insert into newsServer(name,apiurl) values("Rui Couto","http://paginas.fe.up.pt/~ei10072/LTW/Proj1/api/news.php");
insert into newsServer(name,apiurl) values("Diogo Pinela","http://paginas.fe.up.pt/~ei10083/fishynews/api/news.php");
insert into newsServer(name,apiurl) values("Jorge","http://paginas.fe.up.pt/~ei10066/LTW/T3G3/api/news.php");