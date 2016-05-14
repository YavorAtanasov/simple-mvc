
SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for comments
-- ----------------------------
DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `comment` text,
  `picture_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of comments
-- ----------------------------
INSERT INTO `comments` VALUES ('14', 'asdasdasdd', '1', '3', '2015-02-11 12:33:19', '2015-02-11 12:33:19', '0');
INSERT INTO `comments` VALUES ('2', 'sadasdsadsds', '1', '1', '2015-02-11 07:09:01', '2015-02-11 07:09:01', '0');
INSERT INTO `comments` VALUES ('3', 'sadasdsadsds', '1', '1', '2015-02-11 07:20:03', '2015-02-11 07:20:03', '0');
INSERT INTO `comments` VALUES ('4', null, '1', '1', '2015-02-11 07:20:05', '2015-02-11 07:20:05', '1');
INSERT INTO `comments` VALUES ('5', null, '1', '1', '2015-02-11 07:22:43', '2015-02-11 07:22:43', '1');
INSERT INTO `comments` VALUES ('6', null, '1', '1', '2015-02-11 07:22:49', '2015-02-11 07:22:49', '1');
INSERT INTO `comments` VALUES ('7', 'dsadasdas', '1', '1', '2015-02-11 07:35:08', '2015-02-11 07:35:08', '0');
INSERT INTO `comments` VALUES ('8', 'dsadasdas', '1', '1', '2015-02-11 07:35:18', '2015-02-11 07:35:18', '0');
INSERT INTO `comments` VALUES ('9', 'sadsadsa', '1', '1', '2015-02-11 07:36:07', '2015-02-11 07:36:07', '0');
INSERT INTO `comments` VALUES ('10', 'sadsadsa', '1', '1', '2015-02-11 07:36:56', '2015-02-11 07:36:56', '0');
INSERT INTO `comments` VALUES ('11', 'sadsadsa', '1', '1', '2015-02-11 07:37:41', '2015-02-11 07:37:41', '0');
INSERT INTO `comments` VALUES ('12', 'sadsadsa', '1', '1', '2015-02-11 07:39:17', '2015-02-11 07:39:17', '0');
INSERT INTO `comments` VALUES ('13', 'sadsadsa', '1', '1', '2015-02-11 07:39:36', '2015-02-11 07:39:36', '0');

-- ----------------------------
-- Table structure for messages
-- ----------------------------
DROP TABLE IF EXISTS `messages`;
CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` text,
  `email` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of messages
-- ----------------------------
INSERT INTO `messages` VALUES ('1', 'sadsadassda', 'sdsds@dsadas.com', 'sdasd', '2015-02-11 08:37:27');
INSERT INTO `messages` VALUES ('2', 'dsadasd', 'wsd@dasds.com', 'dsadsa', '2015-02-11 08:38:00');
INSERT INTO `messages` VALUES ('3', 'asdsadasd', 'sdasdsa@dsadas.com', 'dasdsa', '2015-02-11 08:39:54');
INSERT INTO `messages` VALUES ('4', 'sdads asd asdasd asd', 'sadasd@adssad.sad', 'sadsadas', '2015-02-11 09:04:45');
INSERT INTO `messages` VALUES ('5', 'sdads asd asdasd asd', 'sadasd@adssad.sad', 'sadsadas', '2015-02-11 09:04:56');
INSERT INTO `messages` VALUES ('6', 'sadasdasdas dasd asd asd as', 'sdasdsa@dsadas.com', 'asdsad', '2015-02-11 09:18:25');
INSERT INTO `messages` VALUES ('7', 'sadasdasdas dasd asd asd as', 'sdasdsa@dsadas.com', 'asdsad', '2015-02-11 09:21:39');

-- ----------------------------
-- Table structure for pictures
-- ----------------------------
DROP TABLE IF EXISTS `pictures`;
CREATE TABLE `pictures` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `file_name` varchar(255) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `owner_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `file_name` (`file_name`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pictures
-- ----------------------------
INSERT INTO `pictures` VALUES ('1', 'Koala.jpg', '2015-02-10 22:12:37', '2015-02-10 22:12:37', '0', '1');
INSERT INTO `pictures` VALUES ('2', 'Koala1.jpg', '2015-02-10 22:12:37', '2015-02-10 22:12:37', '0', '1');
INSERT INTO `pictures` VALUES ('3', 'Koala2.jpg', '2015-02-10 22:12:37', '2015-02-10 22:12:37', '0', '1');
INSERT INTO `pictures` VALUES ('4', 'Koala3.jpg', '2015-02-10 22:12:37', '2015-02-10 22:12:37', '0', '1');
INSERT INTO `pictures` VALUES ('5', 'Koala4.jpg', '2015-02-10 22:12:37', '2015-02-10 22:12:37', '0', '1');
INSERT INTO `pictures` VALUES ('6', 'Koala5.jpg', '2015-02-10 22:12:37', '2015-02-10 22:12:37', '1', '1');
INSERT INTO `pictures` VALUES ('7', 'Koala6.jpg', '2015-02-10 22:12:37', '2015-02-10 22:12:37', '0', '1');
INSERT INTO `pictures` VALUES ('8', 'Koala7.jpg', '2015-02-10 22:12:37', '2015-02-10 22:12:37', '0', '1');
INSERT INTO `pictures` VALUES ('9', 'Koala8.jpg', '2015-02-10 22:12:37', '2015-02-10 22:12:37', '0', '1');
INSERT INTO `pictures` VALUES ('10', 'Koala9.jpg', '2015-02-10 22:12:37', '2015-02-10 22:12:37', '0', '1');
INSERT INTO `pictures` VALUES ('11', 'Koala10.jpg', '2015-02-10 22:12:37', '2015-02-10 22:12:37', '0', '1');
INSERT INTO `pictures` VALUES ('12', 'Koala11.jpg', '2015-02-10 22:12:37', '2015-02-10 22:12:37', '1', '1');
INSERT INTO `pictures` VALUES ('13', 'Tulips.jpg', '2015-02-11 13:36:51', '2015-02-11 13:36:51', '0', '3');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `admin` tinyint(1) DEFAULT '0',
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `number_of_posts` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'admin', '21232f297a57a5a743894a0e4a801fc3', '2015-02-10 16:38:42', '2015-02-10 16:38:44', '0', '1', 'admin', null, null, null, null, null, null, '1');
INSERT INTO `users` VALUES ('2', 'user', 'ee11cbb19052e40b07aac0ca060c23ee', '2015-02-10 16:39:20', '2015-02-10 16:39:21', '0', '0', 'user', null, null, null, null, null, null, '0');
INSERT INTO `users` VALUES ('3', 'user1', '24c9e15e52afc47c225b757e7bee1f9d', null, null, '0', '0', '3', null, '123', 'aa@aa.com', 'adsdas', 'wqdsad', null, '2');
INSERT INTO `users` VALUES ('4', 'user2', '7e58d63b60197ceb55a1c487989a3720', null, null, '0', '0', '4', 'sadasd', 'asdas', 'email@mai.com', 'sdas', 'dsadas', 'asdasd', '0');
INSERT INTO `users` VALUES ('5', 'user3', '8ca39209498cc55df0c7a39c6737bacc', '2015-02-11 00:29:00', '2015-02-11 00:29:00', '0', '0', '5', 'sadasd', 'sdas', 'wsd@dasds.com', 'asdas', 'dasd', 'dsaas', '0');
INSERT INTO `users` VALUES ('13', 'asdsad', '6512bd43d9caa6e02c990b0a82652dca', '2015-02-11 12:54:31', '2015-02-11 12:54:31', '0', '0', 'sadasd', 'sadsad', '', '', '', '', null, '0');
INSERT INTO `users` VALUES ('14', 'sad', 'c4ca4238a0b923820dcc509a6f75849b', '2015-02-11 12:55:03', '2015-02-11 12:55:03', '0', '0', 'sadsad', 'asdsad', '', '', '', '', '', '0');
INSERT INTO `users` VALUES ('15', '123', '65ded5353c5ee48d0b7d48c591b8f430', '2015-02-11 12:56:28', '2015-02-11 12:56:28', '0', '0', 'dsada', 'dsada', '', '', '', '', '', '0');
INSERT INTO `users` VALUES ('16', 'asd', '0cc175b9c0f1b6a831c399e269772661', '2015-02-11 13:32:18', '2015-02-11 13:32:18', '0', '0', 'd', 'd', '', '', '', '', '', '0');
