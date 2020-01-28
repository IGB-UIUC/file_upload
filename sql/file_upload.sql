CREATE TABLE `files` (
  `file_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `filename` text NOT NULL,
  `extension` varchar(45) NOT NULL,
  `upload_date` varchar(45) NOT NULL,
  `secret_key` varchar(45) NOT NULL,
  `size` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `group_id` int(10) unsigned NOT NULL,
  `status` enum('COMPLETE','DELETED') NOT NULL,
  PRIMARY KEY (`file_id`) USING BTREE
);

CREATE TABLE `groups` (
  `group_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group_name` varchar(45) NOT NULL,
  PRIMARY KEY (`group_id`)
);

CREATE TABLE `members` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `group_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `upload_session` (
  `upload_session_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `session_key` varchar(45) NOT NULL,
  `start_time` datetime NOT NULL,
  PRIMARY KEY (`upload_session_id`) USING BTREE
);

CREATE TABLE `users` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `netid` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `user_type` enum('IGB','GUEST') NOT NULL,
  `location` varchar(45) NOT NULL,
  `created` datetime NOT NULL,
  `invite_key` varchar(45) NOT NULL,
  `user_host_id` int(10) unsigned NOT NULL,
  `full_name` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `status` enum('CREATED','DELETED') NOT NULL,
  PRIMARY KEY (`user_id`) USING BTREE
);

