CREATE TABLE `xmnews_category` (
  `category_id`             smallint(5) unsigned    NOT NULL AUTO_INCREMENT,
  `category_name`           varchar(255)            NOT NULL DEFAULT '',
  `category_description`    text,
  `category_logo`           varchar(50)             NOT NULL DEFAULT '',
  `category_douser`         tinyint(1)  unsigned    NOT NULL DEFAULT '1',
  `category_dodate`         tinyint(1)  unsigned    NOT NULL DEFAULT '1',
  `category_domdate`        tinyint(1)  unsigned    NOT NULL DEFAULT '1',
  `category_dohits`         tinyint(1)  unsigned    NOT NULL DEFAULT '1',
  `category_dorating`       tinyint(1)  unsigned    NOT NULL DEFAULT '1',
  `category_docomment`      tinyint(1)  unsigned    NOT NULL DEFAULT '1',
  `category_weight`         smallint(5) unsigned    NOT NULL DEFAULT '0',
  `category_status`         tinyint(1)  unsigned    NOT NULL DEFAULT '1',
  
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM;

CREATE TABLE `xmnews_news` (
  `news_id`             mediumint(8) unsigned   NOT NULL auto_increment,
  `news_cid`            smallint(5)  unsigned   NOT NULL DEFAULT '0',
  `news_title`          varchar(255)            NOT NULL default '',
  `news_description`    text,
  `news_news`    		text,
  `news_mkeyword`   	text,
  `news_mdescription`  	text,
  `news_logo`           varchar(50)             NOT NULL DEFAULT '',
  `news_userid`         smallint(5)  unsigned   NOT NULL default '0',
  `news_date`           int(10)      unsigned   NOT NULL DEFAULT '0',
  `news_mdate`          int(10)      unsigned   NOT NULL DEFAULT '0',
  `news_rating`         double(6,4)             NOT NULL default '0.0000',
  `news_votes`          smallint(5)  unsigned   NOT NULL default '0',
  `news_counter`        smallint(5)  unsigned   NOT NULL DEFAULT '0',
  `news_douser`         tinyint(1)  unsigned    NOT NULL DEFAULT '1',
  `news_dodate`         tinyint(1)  unsigned    NOT NULL DEFAULT '1',
  `news_domdate`        tinyint(1)  unsigned    NOT NULL DEFAULT '1',
  `news_dohits`         tinyint(1)  unsigned    NOT NULL DEFAULT '1',
  `news_dorating`       tinyint(1)  unsigned    NOT NULL DEFAULT '1',
  `news_docomment`      tinyint(1)  unsigned    NOT NULL DEFAULT '1',
  `news_status`         tinyint(1)   unsigned   NOT NULL default '0',
  
  PRIMARY KEY  (`news_id`),
  KEY `news_cid` (`news_cid`)
) ENGINE=MyISAM;