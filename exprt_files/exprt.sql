-- --------------------------------------------------------

-- 
-- 表的结构 `ex_client`
-- 

CREATE TABLE `ex_client` (
  `cid` tinyint(1) NOT NULL auto_increment,
  `cabbr` varchar(10) NOT NULL,
  `cname` varchar(20) NOT NULL,
  `crtime` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `ctitle` varchar(10) default NULL,
  `ccom` varchar(30) NOT NULL,
  `ctel` varchar(20) NOT NULL,
  `caddr` varchar(50) NOT NULL,
  `ccity` varchar(10) NOT NULL,
  PRIMARY KEY  (`cid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

-- 
-- 表的结构 `ex_record`
-- 

CREATE TABLE `ex_record` (
  `rid` bigint(1) NOT NULL auto_increment,
  `rnum` varchar(20) NOT NULL,
  `rexcom` varchar(30) NOT NULL,
  `rcata` varchar(30) NOT NULL,
  `rcont` varchar(30) NOT NULL,
  `rstime` datetime default NULL,
  `rptime` datetime default NULL,
  `remark` text NOT NULL,
  `rname` varchar(20) NOT NULL,
  `rtitle` varchar(10) NOT NULL,
  `rcom` varchar(30) NOT NULL,
  `rtel` varchar(20) NOT NULL,
  `raddr` varchar(50) NOT NULL,
  `rcity` varchar(10) NOT NULL,
  `sname` varchar(20) NOT NULL,
  `scom` varchar(30) NOT NULL,
  `stel` varchar(20) NOT NULL,
  `saddr` varchar(50) NOT NULL,
  `scity` varchar(10) NOT NULL,
  PRIMARY KEY  (`rid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

-- 
-- 表的结构 `ex_user`
-- 

CREATE TABLE `ex_user` (
  `uid` tinyint(1) NOT NULL auto_increment,
  `uabbr` varchar(10) NOT NULL,
  `uname` varchar(20) NOT NULL,
  `upass` varchar(64) NOT NULL,
  `urtime` datetime default NULL,
  `ultime` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `ucom` varchar(30) NOT NULL,
  `utel` varchar(20) NOT NULL,
  `uaddr` varchar(50) NOT NULL,
  `ucity` varchar(10) NOT NULL,
  `ugrade` tinyint(1) NOT NULL,
  PRIMARY KEY  (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;