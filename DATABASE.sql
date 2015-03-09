CREATE DATABASE `scapesbook` /*!40100 DEFAULT CHARACTER SET utf8 */;

CREATE USER 'scapesbook'@'%' IDENTIFIED BY 'Sc@pesB00k';
GRANT ALL ON scapesbook.* TO 'scapesbook'@'%'

CREATE TABLE IF NOT EXISTS `scapesbook`.`messages` (
  `mid` INT(11) NOT NULL AUTO_INCREMENT,
  `sender_id` VARCHAR(45) NULL DEFAULT NULL,
  `receiver_id` VARCHAR(45) NULL DEFAULT NULL,
  `time_sent` DATETIME NULL DEFAULT NULL,
  `msg` TEXT NULL DEFAULT NULL,
  `unread_flag` INT(11) NULL DEFAULT '1',
  PRIMARY KEY (`mid`))
ENGINE = InnoDB
AUTO_INCREMENT = 353
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `scapesbook`.`friends` (
  `user1_id` VARCHAR(45) NOT NULL,
  `user2_id` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`user1_id`, `user2_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `scapesbook`.`posts` (
  `pid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` INT(11) NULL DEFAULT NULL,
  `receiver_id` VARCHAR(45) NULL DEFAULT NULL,
  `postTxt` TEXT NOT NULL,
  `timestamp` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`pid`))
ENGINE = InnoDB
AUTO_INCREMENT = 45
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `scapesbook`.`friend_requests` (
  `sender_id` INT(11) NOT NULL,
  `receiver_id` INT(11) NOT NULL,
  PRIMARY KEY (`sender_id`, `receiver_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `scapesbook`.`users` (
  `uid` INT(11) NOT NULL AUTO_INCREMENT,
  `fname` VARCHAR(45) NULL DEFAULT NULL,
  `lname` VARCHAR(45) NULL DEFAULT NULL,
  `username` VARCHAR(45) NOT NULL,
  `pass` VARCHAR(45) NULL DEFAULT NULL,
  `profile` TEXT NULL DEFAULT NULL,
  PRIMARY KEY (`uid`, `username`),
  UNIQUE INDEX `username_UNIQUE` (`username` ASC))
ENGINE = InnoDB
AUTO_INCREMENT = 57
DEFAULT CHARACTER SET = utf8;

INSERT INTO `scapesbook`.`friends` (`user1_id`, `user2_id`) VALUES ('33', '54');
INSERT INTO `scapesbook`.`friends` (`user1_id`, `user2_id`) VALUES ('33', '56');

INSERT INTO `scapesbook`.`messages` (`mid`, `sender_id`, `receiver_id`, `time_sent`, `msg`, `unread_flag`) VALUES ('314', '33', '54', '2013-05-14 19:07:31', 'test', '0');
INSERT INTO `scapesbook`.`messages` (`mid`, `sender_id`, `receiver_id`, `time_sent`, `msg`, `unread_flag`) VALUES ('315', '33', '54', '2013-05-14 19:07:32', 'test', '0');
INSERT INTO `scapesbook`.`messages` (`mid`, `sender_id`, `receiver_id`, `time_sent`, `msg`, `unread_flag`) VALUES ('316', '33', '56', '2013-05-14 19:07:34', 'test', '1');
INSERT INTO `scapesbook`.`messages` (`mid`, `sender_id`, `receiver_id`, `time_sent`, `msg`, `unread_flag`) VALUES ('317', '33', '56', '2013-05-14 19:07:35', 'test', '1');
INSERT INTO `scapesbook`.`messages` (`mid`, `sender_id`, `receiver_id`, `time_sent`, `msg`, `unread_flag`) VALUES ('318', '33', '56', '2013-05-14 19:07:50', 'asdgasdg', '1');
INSERT INTO `scapesbook`.`messages` (`mid`, `sender_id`, `receiver_id`, `time_sent`, `msg`, `unread_flag`) VALUES ('319', '33', '56', '2013-05-14 19:07:51', 'asgdasd', '1');
INSERT INTO `scapesbook`.`messages` (`mid`, `sender_id`, `receiver_id`, `time_sent`, `msg`, `unread_flag`) VALUES ('320', '33', '56', '2013-05-14 19:07:52', 'aggsda', '1');
INSERT INTO `scapesbook`.`messages` (`mid`, `sender_id`, `receiver_id`, `time_sent`, `msg`, `unread_flag`) VALUES ('321', '33', '54', '2013-05-14 19:08:08', 'gagdas', '0');
INSERT INTO `scapesbook`.`messages` (`mid`, `sender_id`, `receiver_id`, `time_sent`, `msg`, `unread_flag`) VALUES ('322', '54', '33', '2013-05-14 19:08:45', 'agsdsaga', '0');
INSERT INTO `scapesbook`.`messages` (`mid`, `sender_id`, `receiver_id`, `time_sent`, `msg`, `unread_flag`) VALUES ('323', '54', '33', '2013-05-14 19:18:31', 'het', '0');
INSERT INTO `scapesbook`.`messages` (`mid`, `sender_id`, `receiver_id`, `time_sent`, `msg`, `unread_flag`) VALUES ('324', '54', '33', '2013-05-14 19:18:44', 'het', '0');
INSERT INTO `scapesbook`.`messages` (`mid`, `sender_id`, `receiver_id`, `time_sent`, `msg`, `unread_flag`) VALUES ('325', '54', '33', '2013-05-14 19:19:50', 'test', '0');
INSERT INTO `scapesbook`.`messages` (`mid`, `sender_id`, `receiver_id`, `time_sent`, `msg`, `unread_flag`) VALUES ('326', '54', '33', '2013-05-14 19:20:01', 'test', '0');
INSERT INTO `scapesbook`.`messages` (`mid`, `sender_id`, `receiver_id`, `time_sent`, `msg`, `unread_flag`) VALUES ('327', '54', '33', '2013-05-14 19:20:59', 'test', '0');
INSERT INTO `scapesbook`.`messages` (`mid`, `sender_id`, `receiver_id`, `time_sent`, `msg`, `unread_flag`) VALUES ('328', '54', '33', '2013-05-14 19:22:02', 'test', '0');
INSERT INTO `scapesbook`.`messages` (`mid`, `sender_id`, `receiver_id`, `time_sent`, `msg`, `unread_flag`) VALUES ('329', '54', '33', '2013-05-14 19:23:09', 'test', '0');
INSERT INTO `scapesbook`.`messages` (`mid`, `sender_id`, `receiver_id`, `time_sent`, `msg`, `unread_flag`) VALUES ('330', '54', '33', '2013-05-14 19:23:14', 'gasgsadgsad', '0');
INSERT INTO `scapesbook`.`messages` (`mid`, `sender_id`, `receiver_id`, `time_sent`, `msg`, `unread_flag`) VALUES ('331', '54', '33', '2013-05-14 19:23:57', 'agsdagasdgasdgsa', '0');
INSERT INTO `scapesbook`.`messages` (`mid`, `sender_id`, `receiver_id`, `time_sent`, `msg`, `unread_flag`) VALUES ('332', '54', '33', '2013-05-14 19:24:31', 'gsadgasgdasdhsadhas', '0');
INSERT INTO `scapesbook`.`messages` (`mid`, `sender_id`, `receiver_id`, `time_sent`, `msg`, `unread_flag`) VALUES ('333', '54', '33', '2013-05-14 19:24:43', 't2t2tt23t23t23t23', '0');
INSERT INTO `scapesbook`.`messages` (`mid`, `sender_id`, `receiver_id`, `time_sent`, `msg`, `unread_flag`) VALUES ('334', '54', '33', '2013-05-14 19:24:51', 'hahsdgsadga', '0');
INSERT INTO `scapesbook`.`messages` (`mid`, `sender_id`, `receiver_id`, `time_sent`, `msg`, `unread_flag`) VALUES ('335', '54', '33', '2013-05-14 19:25:00', 'gsadgasgd', '0');
INSERT INTO `scapesbook`.`messages` (`mid`, `sender_id`, `receiver_id`, `time_sent`, `msg`, `unread_flag`) VALUES ('336', '54', '33', '2013-05-14 19:26:01', 'gasdgdsagsad', '0');
INSERT INTO `scapesbook`.`messages` (`mid`, `sender_id`, `receiver_id`, `time_sent`, `msg`, `unread_flag`) VALUES ('337', '54', '33', '2013-05-14 19:26:08', 'yw34ty2343', '0');
INSERT INTO `scapesbook`.`messages` (`mid`, `sender_id`, `receiver_id`, `time_sent`, `msg`, `unread_flag`) VALUES ('338', '54', '33', '2013-05-14 19:26:53', 'saggsadhda', '0');
INSERT INTO `scapesbook`.`messages` (`mid`, `sender_id`, `receiver_id`, `time_sent`, `msg`, `unread_flag`) VALUES ('339', '54', '33', '2013-05-14 19:26:59', '23t223y1y', '0');
INSERT INTO `scapesbook`.`messages` (`mid`, `sender_id`, `receiver_id`, `time_sent`, `msg`, `unread_flag`) VALUES ('340', '54', '33', '2013-05-14 19:27:07', 'y1y134y', '0');
INSERT INTO `scapesbook`.`messages` (`mid`, `sender_id`, `receiver_id`, `time_sent`, `msg`, `unread_flag`) VALUES ('341', '54', '33', '2013-05-14 19:27:16', 'gsdasdg', '0');
INSERT INTO `scapesbook`.`messages` (`mid`, `sender_id`, `receiver_id`, `time_sent`, `msg`, `unread_flag`) VALUES ('342', '54', '33', '2013-05-14 19:27:20', '4hehafh', '0');
INSERT INTO `scapesbook`.`messages` (`mid`, `sender_id`, `receiver_id`, `time_sent`, `msg`, `unread_flag`) VALUES ('343', '54', '33', '2013-05-14 19:27:45', 'sdgas3y3hjwrsfd', '0');
INSERT INTO `scapesbook`.`messages` (`mid`, `sender_id`, `receiver_id`, `time_sent`, `msg`, `unread_flag`) VALUES ('344', '54', '33', '2013-05-14 19:27:51', 'hadfha4h', '0');
INSERT INTO `scapesbook`.`messages` (`mid`, `sender_id`, `receiver_id`, `time_sent`, `msg`, `unread_flag`) VALUES ('345', '54', '33', '2013-05-14 20:26:22', 'test', '0');
INSERT INTO `scapesbook`.`messages` (`mid`, `sender_id`, `receiver_id`, `time_sent`, `msg`, `unread_flag`) VALUES ('346', '33', '54', '2013-05-14 20:28:12', 'test', '0');
INSERT INTO `scapesbook`.`messages` (`mid`, `sender_id`, `receiver_id`, `time_sent`, `msg`, `unread_flag`) VALUES ('347', '33', '54', '2013-05-14 20:28:40', 'No Scrubs', '0');
INSERT INTO `scapesbook`.`messages` (`mid`, `sender_id`, `receiver_id`, `time_sent`, `msg`, `unread_flag`) VALUES ('348', '33', '54', '2014-04-06 17:37:25', 'test', '0');
INSERT INTO `scapesbook`.`messages` (`mid`, `sender_id`, `receiver_id`, `time_sent`, `msg`, `unread_flag`) VALUES ('349', '54', '33', '2014-04-06 17:37:33', 'test234', '0');
INSERT INTO `scapesbook`.`messages` (`mid`, `sender_id`, `receiver_id`, `time_sent`, `msg`, `unread_flag`) VALUES ('350', '33', '56', '2015-03-09 14:56:26', 'test', '1');
INSERT INTO `scapesbook`.`messages` (`mid`, `sender_id`, `receiver_id`, `time_sent`, `msg`, `unread_flag`) VALUES ('351', '33', '56', '2015-03-09 14:56:55', 'test', '1');
INSERT INTO `scapesbook`.`messages` (`mid`, `sender_id`, `receiver_id`, `time_sent`, `msg`, `unread_flag`) VALUES ('352', '33', '56', '2015-03-09 14:57:09', 'test', '1');

INSERT INTO `scapesbook`.`posts` (`pid`, `uid`, `receiver_id`, `postTxt`, `timestamp`) VALUES ('42', '33', '', 'This is a post', '2013-05-14 20:26:03');
INSERT INTO `scapesbook`.`posts` (`pid`, `uid`, `receiver_id`, `postTxt`, `timestamp`) VALUES ('43', '33', '', 'test', '2015-03-09 14:43:48');
INSERT INTO `scapesbook`.`posts` (`pid`, `uid`, `receiver_id`, `postTxt`, `timestamp`) VALUES ('44', '33', '54', 'test', '2015-03-09 14:49:05');

INSERT INTO `scapesbook`.`users` (`uid`, `fname`, `lname`, `username`, `pass`, `profile`) VALUES ('33', 'Matt', 'Scaperoth', 'mscapero', '098f6bcd4621d373cade4e832627b4f6', 'test');
INSERT INTO `scapesbook`.`users` (`uid`, `fname`, `lname`, `username`, `pass`) VALUES ('54', 'Test', 'Test', 'test', '098f6bcd4621d373cade4e832627b4f6');
INSERT INTO `scapesbook`.`users` (`uid`, `fname`, `lname`, `username`, `pass`) VALUES ('56', 'Test', 'Test', 'test2', '098f6bcd4621d373cade4e832627b4f6');

