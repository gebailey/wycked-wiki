CREATE TABLE `pages` (
  `page_id` int(11) NOT NULL,
  `visible` int(11) DEFAULT '14',
  `title` varchar(30) NOT NULL,
  `file` varchar(50) DEFAULT NULL,
  `page` text,
  PRIMARY KEY (`page_id`)
);

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `date` datetime DEFAULT NULL,
  `visible` int(11) DEFAULT '14',
  `title` varchar(30) DEFAULT NULL,
  `post` text,
  PRIMARY KEY (`post_id`)
);

CREATE TABLE `users` (
  `username` varchar(20) NOT NULL DEFAULT '',
  `password` varchar(50) DEFAULT NULL,
  `fullname` varchar(50) DEFAULT NULL,
  `access` int(11) DEFAULT NULL,
  PRIMARY KEY (`username`)
);

