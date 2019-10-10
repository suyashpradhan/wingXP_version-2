-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2019 at 08:50 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.1.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `testune`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_themes` ()  NO SQL
SELECT topic_desc from topic where end_date > CURRENT_DATE() order by end_date asc limit 2$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `latest_articles` (IN `id` VARCHAR(20), IN `ins_id` VARCHAR(20))  NO SQL
select name,description, date_added,author,icon from school__article where club_id= id and inst_id = ins_id and status = '1' order by date_posted DESC LIMIT 4$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `latest_videos` (IN `id` VARCHAR(20))  NO SQL
select link,video_file,title,date_added from video order by date_added DESC LIMIT 5$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sample` (IN `id` VARCHAR(20), IN `ins_id` VARCHAR(20))  NO SQL
SELECT course_id, description_line, no_of_classes, mrp_price, duration,vendor_id from school__live_course where club_id = id and inst_id= ins_id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `show_articles` (IN `id` VARCHAR(20), IN `ins_id` VARCHAR(20))  NO SQL
SELECT article_id,name, description, date_posted, icon, publish_state, duration, mrp_price,vendor_id,article_id from school__article where club_id = id and inst_id = ins_id and status='1'$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `show_courses` (IN `id` VARCHAR(20))  NO SQL
SELECT course_id, description_line, no_of_classes, mrp_price, duration,vendor_id from live_course where club_id = id and status='1'$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `show_det` (IN `ids` DATE)  NO SQL
SELECT name,photo,detail,institute_id from inst_club_coordinator where club_coordinator_id IN (ids)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `show_ebooks` (IN `id` VARCHAR(20))  NO SQL
SELECT book_id, name, author, description, mrp_price, duration,vendor_id from ebook where club_id = id and status = '1'$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `show_my_activities` (IN `id` VARCHAR(20))  NO SQL
select deploy_id,activity_id,class,from_date, to_date, mrp_price,school_price,student_price from deployment_control where club_coordinator_id = id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `show_online_tests` (IN `id` VARCHAR(20))  NO SQL
select  test_id, test_name, test_type, test_creator, publish_state,
test_data, duration , mrp_price,vendor_id,status from online_test where club_id = id AND status='1'$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `show_quiz` (IN `id` VARCHAR(20))  NO SQL
SELECT quiz_id, quiz_title,quiz_creator,no_of_questions,mrp_price, school_price,vendor_id from quiz where club_id = id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `show_sample_work` (IN `id` VARCHAR(20), IN `ins_id` VARCHAR(20))  NO SQL
select sample_work_id, title, date_added, last_date, media_type from school__sample_work where club_id = id and inst_id = ins_id and status ='1'$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `show_summary` (IN `id` VARCHAR(20))  NO SQL
SELECT
  (SELECT COUNT(*) FROM webinar WHERE club_id= id) as webinar , 
  (SELECT COUNT(*) FROM online_test WHERE club_id=id) as online_test ,
  (SELECT COUNT(*) FROM video WHERE club_id=id)  as video,
  (SELECT COUNT(*) FROM ebook WHERE club_id=id) as ebook ,
  (SELECT COUNT(*) FROM article WHERE club_id=id) as article,
  (SELECT COUNT(*) FROM workshop WHERE club_id=id)  as workshop,
  (SELECT COUNT(*) FROM live_course WHERE club_id=id) as live_course$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `show_topic_download` (IN `tp_id` VARCHAR(20))  NO SQL
select sno,title,link from topic_download where topic_id = tp_id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `show_uploads` (IN `sid` VARCHAR(20), IN `cid` VARCHAR(20))  NO SQL
select sample_work.title,date_time,file,submission_feedback.remark from sample_work_submission INNER JOIN sample_work ON 
sample_work_submission.sample_work_id = sample_work.sample_work_id left outer join submission_feedback ON 
sample_work_submission.submission_id = submission_feedback.submission_id where sample_work_submission.student_id = sid and sample_work_submission.club_id=cid$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `show_uploads_school` (IN `ins_id` VARCHAR(20), IN `cid` VARCHAR(20))  NO SQL
select sample_work.title,file,inst_user.name as st_name,inst_club_coordinator.name as cc_name,submission_feedback.remark,featured,sample_work_submission.submission_id from sample_work_submission 
INNER JOIN sample_work ON sample_work_submission.sample_work_id = sample_work.sample_work_id left join inst_user on sample_work_submission.student_id = inst_user.user_id left join submission_feedback on submission_feedback.submission_id = sample_work_submission.submission_id left join inst_club_coordinator on inst_club_coordinator.club_coordinator_id = submission_feedback.cc_id where 
inst_user.institute_id = ins_id and sample_work_submission.club_id=cid order by sample_work.sample_work_id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `show_videos` (IN `id` VARCHAR(20))  NO SQL
SELECT video_id, title,description_line, mrp_price, duration,learning,vendor_id from learning_video where club_id = id and status ='1'$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `show_webinars` (IN `id` VARCHAR(20))  NO SQL
SELECT webinar_id,title,description, speaker, date, time,duration, vendor_id,mrp_price from webinar where club_id = id AND status='1'$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `show_workshops` (IN `id` VARCHAR(20))  NO SQL
SELECT workshop_id,title, description_line, class_applicable_for,mrp_price, vendor_id,status from workshop where club_id = id and status='1'$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `sno` int(11) NOT NULL,
  `activity_id` varchar(20) NOT NULL,
  `page_name` varchar(100) NOT NULL,
  `activities_description` text NOT NULL,
  `icon` varchar(20) NOT NULL,
  `activity_name` varchar(100) NOT NULL,
  `deploy_id` varchar(20) NOT NULL,
  `institute_id` varchar(20) NOT NULL,
  `class` text NOT NULL,
  `gender` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`sno`, `activity_id`, `page_name`, `activities_description`, `icon`, `activity_name`, `deploy_id`, `institute_id`, `class`, `gender`) VALUES
(1, 'act1', 'webinar.php', 'Webinar', 'webinar.png', 'webinar', '', '', '', '0'),
(2, 'act2', 'article.php', 'articles', 'article.png', 'article', '', '', '', '0'),
(3, 'act3', 'course.php', 'sdf', 'article.png', 'live_course', '', '', '', '0'),
(4, 'act4', 'online_test.php', 'sdf', 'webinar.png', 'online_test', '', '', '', '0'),
(5, 'act5', 'ebook.php', 'upload ebooks for each  activity', 'ebook.png', 'ebook', '', '', '', '0'),
(6, 'act6', 'video.php', 'upload ebooks for each  activity', 'ebook.png', 'video', '', '', '', '0'),
(7, 'act7', 'workshop.php', 'upload ebooks for each  activity', 'ebook.png', 'workshop', '', '', '', '0'),
(8, 'act8', 'quiz.php', 'Apester Quiz', 'quiz.png', 'quiz', '', '', '', '0'),
(9, 'act9', 'learning_video.php', 'Learning Video', 'quiz.png', 'Learning Video', '', '', '', '0'),
(10, 'act10', 'sample_work.php', 'Sample Work ', 's_work.png', 'Sample Work', '', '', '', '0');

-- --------------------------------------------------------

--
-- Table structure for table `activity_restrict`
--

CREATE TABLE `activity_restrict` (
  `sno` int(11) NOT NULL,
  `institute_id` varchar(20) NOT NULL,
  `cc_id` varchar(20) NOT NULL,
  `activity_id` varchar(20) NOT NULL,
  `reason` text NOT NULL,
  `club_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `activity_restrict`
--

INSERT INTO `activity_restrict` (`sno`, `institute_id`, `cc_id`, `activity_id`, `reason`, `club_id`) VALUES
(2, 'INST_258', 'cc_1', 'art_6', 'bkjll', 'club_web'),
(3, 'INST_258', 'cc_1', 'art_7', 'bkjll', 'club_web');

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `sno` int(11) NOT NULL,
  `club_id` varchar(20) DEFAULT NULL,
  `article_id` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `author` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `date_posted` date NOT NULL,
  `publish_state` tinyint(1) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `time_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `vendor_id` varchar(20) DEFAULT NULL,
  `duration` time NOT NULL,
  `link` text NOT NULL,
  `mrp_price` int(11) NOT NULL,
  `class_applicable_for` text NOT NULL,
  `subscription_level` varchar(20) NOT NULL,
  `school_price` int(11) NOT NULL,
  `icon` varchar(20) NOT NULL,
  `status` int(11) NOT NULL,
  `topic_id` varchar(20) NOT NULL,
  `featured` int(11) NOT NULL,
  `article_file` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`sno`, `club_id`, `article_id`, `name`, `author`, `description`, `date_posted`, `publish_state`, `date_added`, `time_added`, `vendor_id`, `duration`, `link`, `mrp_price`, `class_applicable_for`, `subscription_level`, `school_price`, `icon`, `status`, `topic_id`, `featured`, `article_file`) VALUES
(1, 'club_web', 'art_1', 'Lorem', 'Lorem', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec dapibus ligula in dictum molestie. Sed vulputate massa risus, non consequat mi suscipit eget. Sed non quam et est auctor volutpat sed ac dolor. Vivamus vitae venenatis sem. Nulla sed tincidunt metus. Proin vel nulla ut nunc posuere maximus. Sed luctus aliquam sem, eget aliquam nulla varius eget. Sed neque ex, iaculis in gravida in, venenatis ut tellus. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus a consectetur eros.</p>\r\n', '0000-00-00', 0, '2018-09-03 12:50:13', '2018-09-03 12:50:13', 'inst_1', '00:00:00', 'https://www.lipsum.com/feed/html', 100, '9', 'gold', 100, 'hqdefault.jpg', 1, 'tp_2', 0, ''),
(2, 'club_web', 'art_2', 'Article TITLE 1', 'test', 'lorem', '0000-00-00', 0, '2018-10-12 15:20:32', '2018-10-12 00:00:00', 'inst_1', '01:00:00', 'a.pdf', 123, '6,8,10,12', 'silver', 0, 'hqdefault.jpg', 1, 'tp_2', 0, ''),
(4, 'club_web', 'art_4', 'ARTICLE TITLE 2', 'lorem', 'lnlkfnlkwenfklewf', '0000-00-00', 0, '2018-10-13 00:00:00', '2018-09-11 15:40:56', 'inst_1', '01:00:00', 'https://medium.com/sololearn/warning-your-programming-career-b9579b3a878b', 1000, '6,7,8,9,10,11,12', 'platinum', 200, 'hqdefault.jpg', 1, 'tp_2', 0, ''),
(5, 'club_web', 'art_5', 'ARTICLE TITLE 3', 'kjnsd', 'kjfkjwnfkjwenf', '0000-00-00', 0, '2018-10-14 00:00:00', '2018-09-11 15:40:56', 'inst_1', '01:00:00', '015751pm12.pdf', 1000, '6,7,8,9,10,11,12', 'platinum', 200, 'hqdefault.jpg', 1, 'tp_2', 0, ''),
(6, 'club_web', 'art_62', 'ARTICLE TITLE 4', 'kjbf', 'kjhwdwkjnjkwen', '0000-00-00', 0, '2018-10-15 00:00:00', '2018-09-11 15:40:56', 'inst_1', '01:00:00', '015751pm12.pdf', 1000, '6,7,8,9,10,11,12', 'platinum', 200, 'hqdefault.jpg', 1, 'tp_2', 0, ''),
(7, 'club_app', 'art_6', 'article app 1', 'article updated', 'sdfsdfsdf', '0000-00-00', 0, '2018-09-03 12:50:13', '2018-09-03 12:50:13', 'inst_1', '01:30:00', 'a.pdf', 1234, '', '', 0, 'hqdefault.jpg', 1, 'tp_2', 0, ''),
(8, 'club_app', 'art_7', 'article app 2', 'orem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore e', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore ', '0000-00-00', 0, '2018-09-03 12:50:13', '2018-09-03 12:50:13', 'inst_1', '01:30:00', 'a.pdf', 1234, '', '', 0, 'hqdefault.jpg', 1, 'tp_2', 0, ''),
(9, 'club_app', 'art_8', 'article app 4', 'article updated', '<p>article updated</p>\r\n', '0000-00-00', 0, '2018-09-03 12:50:13', '2018-09-03 12:50:13', 'inst_1', '01:30:00', 'a.pdf', 1234, '', '', 0, 'hqdefault.jpg', 1, 'tp_2', 0, ''),
(10, 'club_web', 'art_10', 'Article Name', 'udpated', '<p>udpated</p>\r\n', '0000-00-00', 0, '2018-09-26 11:15:54', '2018-09-26 11:15:54', 'inst_2', '10:00:00', '', 10000, '6,7,8,9,10,11,12', 'gold', 1000, '', 1, 'tp_2', 0, ''),
(11, 'asdasd', 'asdasd', '', '', '', '0000-00-00', 0, '2018-10-10 17:50:27', '2018-10-10 17:50:27', NULL, '00:00:00', '', 0, '', '', 0, '', 1, '', 0, ''),
(12, 'dwdwd', 'dwedwd', '', '', '', '0000-00-00', 0, '2018-10-10 17:51:13', '2018-10-10 17:51:13', NULL, '00:00:00', '', 0, '', '', 0, '', 1, '', 0, ''),
(13, 'club_web', 'art_13', 'Testingarticleoct11', 'kjnkwjf', '<p>Testingarticleoct11desc</p>\r\n', '0000-00-00', 0, '2018-10-11 10:52:35', '2018-10-11 10:52:35', 'inst_1', '12:00:00', '072235am21.pdf', 123, '6,7,8,9,10', 'gold', 456, '072235am58.png', 1, 'tp_2', 0, ''),
(14, 'club_web', 'art_14', 'asdasdwqefds', 'wfweqfwdf', '<p>asdfweafwef</p>\r\n', '0000-00-00', 0, '2018-10-17 09:48:22', '2018-10-17 09:48:22', 'inst_1', '01:30:00', '', 1000, '7,8,9', 'gold', 200, '', 1, 'tp_2', 0, ''),
(15, 'club_web', 'art_15', 'Your programming career IOT', '', '<p>IOT is a major field that comprioses of electronics, computer sciences and infotech</p>\r\n', '0000-00-00', 0, '2018-10-24 14:42:47', '2018-10-24 14:42:47', 'inst_4', '00:00:00', 'https://medium.com/sololearn/warning-your-programming-career-b9579b3a878b', 2000, '8,9', 'gold', 1000, 'a.jpg', 1, 'tp_2', 0, ''),
(16, 'club_web', 'art_16', 'Demofeatured', 'Demofeatured', '<p>Demofeatureddfasdasddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd</p>\r\n', '0000-00-00', 0, '2018-10-25 15:54:47', '2018-10-25 15:54:47', 'inst_1', '00:00:00', 'https://medium.com/sololearn/warning-your-programming-career-b9579b3a878b', 123, '7', 'gold', 123, '123321pm68.jpeg', 1, 'tp_2', 1, ''),
(17, 'club_web', 'art_17', 'Demofeatured2', 'Demofeatured', '<p>Demofeatureddfasdasddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd</p>\r\n', '0000-00-00', 0, '2018-10-25 15:55:14', '2018-10-25 15:55:14', 'inst_1', '00:00:00', 'google.com', 123, '7', 'gold', 123, '', 0, 'tp_2', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `cc_club_assign`
--

CREATE TABLE `cc_club_assign` (
  `sno` int(11) NOT NULL,
  `club_coordinator_id` varchar(20) NOT NULL,
  `club_id` varchar(20) NOT NULL,
  `inst_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cc_club_assign`
--

INSERT INTO `cc_club_assign` (`sno`, `club_coordinator_id`, `club_id`, `inst_id`) VALUES
(13, 'cc_1', 'club_app', 'INST_258'),
(14, 'cc_1', 'club_web', 'INST_258'),
(15, 'cc_1', 'school_club_30', 'INST_258'),
(16, 'cc_3', 'club_design', 'INST_258'),
(17, 'cc_4', 'club_app', 'INST_258'),
(18, 'cc_5', 'club_design', 'INST_258'),
(19, 'cc_6', 'club_design', 'INST_258'),
(20, 'cc_1', 'school_club_32', 'INST_258');

-- --------------------------------------------------------

--
-- Table structure for table `clubs`
--

CREATE TABLE `clubs` (
  `sno` int(11) NOT NULL,
  `club_id` varchar(20) NOT NULL,
  `club_name` varchar(100) NOT NULL,
  `club_description` text NOT NULL,
  `club_category_id` varchar(20) NOT NULL,
  `image` varchar(20) NOT NULL,
  `features` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  `launch_date` date NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clubs`
--

INSERT INTO `clubs` (`sno`, `club_id`, `club_name`, `club_description`, `club_category_id`, `image`, `features`, `status`, `launch_date`, `message`) VALUES
(1, 'club_21', 'DIGITAL DESIGN\r\n', 'App developement club', 'CCI_8', 'design.png', 'feature 1, feature 2, feature 3', 1, '0000-00-00', 'Hello friends,  We hear the word design and use it in many ways in different situations, but do we really understand what design, actually, means? What is the purpose of design? If you look around, design is everywhere. Take a look at your T-shirt, or the computer screen you are looking into right now, or the curtains in your room and whole entire room itself. These are all built through design. Design has many types – an architect designs building, a scientist designs rockets, a fashion stylist designs clothes, an illustrator designs your favourite cartoon characters, game designer designs our favourite phone / computer game, and so on.  Have you noticed that the daily objects around us use design to communicate with us without using any words? You can instantly tell what they mean.'),
(3, 'club_18', 'TECH TALK', 'Web developement club', 'CCI_8', 'tech-min.png', 'feature1, feature 2, Feature 3, Featuire 4, feature5', 1, '1996-07-09', 'Dear students,  Tech-Talk clubs aims at educating you with latest Technology trends and skills, and will add a new dimension to you exposure level. You will be also be introduced to different tools, technologies and software which are prevalent and are futuristic.   Club activities not only help to shape your personal interests and hobbies but also improve your leadership and social skills.'),
(4, 'club_design', 'SMARTER MINDS', 'UI UX Design', 'club_nonacademic', 'creative-min.png', 'feature1, feature 2, Feature 3, Featuire 4, feature5', 1, '0000-00-00', 'Dear students,  Tech-Talk clubs aims at educating you with latest Technology trends and skills, and will add a new dimension to you exposure level. You will be also be introduced to different tools, technologies and software which are prevalent and are futuristic.   Club activities not only help to shape your personal interests and hobbies but also improve your leadership and social skills.'),
(5, 'club_maths', 'ENVIRONMENT\r\n', 'Environment Description', 'club_nonacademic', 'environment-min.jpg', 'feature1, feature 2, Feature 3, Featuire 4, feature5', 1, '0000-00-00', ''),
(6, 'club_science', 'CODING\r\n', 'Coding Description', 'club_nonacademic', 'coding-min.png', 'feature1, feature 2, Feature 3, Featuire 4, feature5', 0, '0000-00-00', ''),
(12, 'inst_12', 'ASTRONOMY', 'Astronomy Description', 'club_nonacademic', 'astro-min.png', 'feature1, feature 2, Feature 3, Featuire 4, feature5', 0, '2018-08-01', ''),
(13, 'inst_13', 'ENGLISH EXPRESSION\r\n', 'English Description', 'club_nonacademic', 'english-min.png', 'feature1, feature 2, Feature 3, Featuire 4, feature5', 0, '2018-08-01', ''),
(14, 'inst_14', 'UNDERSTANDING NEWS\r\n', 'News Decription', 'club_nonacademic', 'news-min.png', 'feature1, feature 2, Feature 3, Featuire 4, feature5', 0, '2018-08-01', ''),
(15, 'inst_15', 'Science', 'science desc', 'club_academic', 'science-min.png', 'feature1, feature 2, Feature 3, Featuire 4, feature5', 0, '2018-08-01', ''),
(17, 'inst_16', 'Mathematics', 'maths dsc', 'club_academic', 'maths-min.png', 'feature1, feature 2, Feature 3, Featuire 4, feature5', 0, '2018-08-01', ''),
(18, 'inst_17', 'History', 'history desc', 'club_academic', 'history-min.png', 'feature1, feature 2, Feature 3, Featuire 4, feature5', 0, '2018-08-01', ''),
(19, 'inst_18', 'Geography', 'geography desc', 'club_academic', 'geography-min.png', 'feature1, feature 2, Feature 3, Featuire 4, feature5', 0, '2018-08-01', '');

-- --------------------------------------------------------

--
-- Table structure for table `club_category`
--

CREATE TABLE `club_category` (
  `sno` int(11) NOT NULL,
  `club_category_id` varchar(20) NOT NULL,
  `club_category_name` varchar(100) NOT NULL,
  `club_category_description` text NOT NULL,
  `date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `club_category`
--

INSERT INTO `club_category` (`sno`, `club_category_id`, `club_category_name`, `club_category_description`, `date_time`) VALUES
(1, 'club_18', 'Tech Talk', 'Technology related clubs', '2018-08-22 12:00:27'),
(2, 'club_academic', 'Academics1', 'Academic related clubs', '2018-08-23 00:00:00'),
(3, 'CCI_8', 'School clubs', '', '2018-09-21 10:54:01'),
(4, 'club_21', 'Digital Design', 'Technology related clubs', '2018-08-22 12:00:27');

-- --------------------------------------------------------

--
-- Table structure for table `content_manager`
--

CREATE TABLE `content_manager` (
  `sno` int(11) NOT NULL,
  `content_manager_id` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `address` text NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `email_id` varchar(100) NOT NULL,
  `nationality` varchar(100) NOT NULL,
  `qualification` varchar(100) NOT NULL,
  `experience` text NOT NULL,
  `photo` varchar(100) NOT NULL,
  `phone_no2` varchar(15) NOT NULL,
  `sec_email_id` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `content_manager`
--

INSERT INTO `content_manager` (`sno`, `content_manager_id`, `name`, `dob`, `address`, `phone_number`, `email_id`, `nationality`, `qualification`, `experience`, `photo`, `phone_no2`, `sec_email_id`, `username`, `date_time`, `role`) VALUES
(1, 'inst_1', 'Kiran Nambiar', '2018-08-02', 'asdasd', '123asd', 'a@a.com', 'in', 'ae', 'asdasd', 'Kiran Nambiar_2018-08-02_17.jpg', '123', 'abhi@a.com', 'a@a.com', '2018-08-20 16:19:50', 1),
(3, 'CMI_3', 'name', '2018-08-01', 'address', '123', 'emailid', 'in', 'ae', 'experience', 'name_2018-08-01_22.jpg', '456', 'sec email id', 'emailid', '2018-08-24 16:58:55', 0);

-- --------------------------------------------------------

--
-- Table structure for table `demo_user`
--

CREATE TABLE `demo_user` (
  `sno` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `school_name` text NOT NULL,
  `otp` varchar(6) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `type` varchar(10) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `demo_user`
--

INSERT INTO `demo_user` (`sno`, `name`, `designation`, `phone`, `email`, `school_name`, `otp`, `datetime`, `type`, `message`) VALUES
(84, 'aaaabbbb', '', '9137245036', 'aabbb', '', '8550', '2019-01-01 14:03:25', 'demo', ''),
(85, 'Kiran Nambiar', '', 'asas', 'asas', '', '', '2019-01-01 14:32:07', 'contact', 'asas'),
(86, 'Kiran Nambiar', '', 'asas', 'asas', '', '', '2019-01-01 14:32:43', 'contact', 'asas'),
(87, 'Kiran Nambiar', '', 'asas', 'asas', '', '', '2019-01-01 14:33:04', 'contact', 'asas'),
(88, 'asasas', '', '1111111111', 'asa@a.com', '', '', '2019-01-01 14:35:37', 'contact', 'asas'),
(89, 'asasas', '', '1111111111', 'asa@a.com', '', '', '2019-01-01 14:35:58', 'contact', 'asas'),
(90, 'Kiran 54', '', '9137245036', 'Kiran 54', '', '4289', '2019-01-01 17:04:36', 'demo', ''),
(91, 'Kiran 56', '', '9137245036', 'Kiran 56', '', '3828', '2019-01-01 17:07:43', 'demo', ''),
(92, 'Kiran 56', '', '9167164221', 'Kiran 56', '', '3162', '2019-01-01 17:08:17', 'demo', '');

-- --------------------------------------------------------

--
-- Table structure for table `deployment_control`
--

CREATE TABLE `deployment_control` (
  `sno` int(11) NOT NULL,
  `deploy_id` varchar(20) NOT NULL,
  `activity_id` varchar(20) NOT NULL,
  `class` text,
  `gender` char(1) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `institute_id` varchar(20) DEFAULT NULL,
  `student_price` int(11) NOT NULL,
  `club_coordinator_id` varchar(20) NOT NULL,
  `mrp_price` int(11) NOT NULL,
  `school_price` int(11) NOT NULL,
  `club_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `deployment_control`
--

INSERT INTO `deployment_control` (`sno`, `deploy_id`, `activity_id`, `class`, `gender`, `from_date`, `to_date`, `institute_id`, `student_price`, `club_coordinator_id`, `mrp_price`, `school_price`, `club_id`) VALUES
(1, 'dep_1', 'sc_ebk_2', '1', 'm', '2018-09-06', '2018-09-06', 'INST_258', 0, '', 0, 0, 'school_club_32'),
(2, '', 'art_2', '1', 'f', '2018-09-06', '2018-09-06', 'INST_258', 0, '', 0, 0, 'club_web'),
(3, 'article', '', '1', 'f', '2018-09-26', '2018-09-23', 'inst_1', 0, '', 0, 0, ''),
(4, 'article', '', '1', 'f', '2018-09-26', '2018-09-23', 'inst_2', 0, '', 0, 0, ''),
(5, 'article', '', '1', '', '2018-09-18', '2018-09-24', 'inst_2', 0, '', 0, 0, ''),
(6, 'article', '', '1', 'm', '2018-09-10', '2018-09-10', 'inst_2', 0, '', 0, 0, ''),
(7, 'article', '', '1', 'f', '2018-09-10', '2018-09-10', 'inst_2', 0, '', 0, 0, ''),
(8, 'dep_8', 'art_2', '1,2,3,4,5', 'm', '0000-00-00', '0000-00-00', NULL, 5364, 'cc_1', 0, 0, ''),
(9, 'dep_9', 'art_2', '1,2,3,4,5', 'm', '0000-00-00', '0000-00-00', NULL, 5364, 'cc_1', 0, 0, ''),
(10, 'dep_10', 'art_2', '1,2,3,4,5', '', '0000-00-00', '0000-00-00', NULL, 1000, 'cc_1', 0, 0, ''),
(11, 'dep_11', 'art_2', '1,2,3,4,5', '', '0000-00-00', '0000-00-00', NULL, 1000, 'cc_1', 0, 0, ''),
(12, 'dep_12', 'art_2', '1,2,3,4,5', '', '0000-00-00', '0000-00-00', NULL, 1000, 'cc_1', 0, 0, ''),
(13, 'dep_13', 'art_2', '1,2,3,4,5', '', '0000-00-00', '0000-00-00', NULL, 1000, 'cc_1', 0, 0, ''),
(14, '', 'art_2', '1,2,3,4,5', '', '0000-00-00', '0000-00-00', NULL, 1000, 'cc_1', 0, 0, ''),
(15, 'dep_15', 'art_2', '1,2,3,4,5', '', '2018-09-11', '2018-09-10', NULL, 1000, 'cc_1', 0, 0, ''),
(20, 'dep_20', 'art_2', '1,2,3,4,5', '', '2018-09-11', '2018-09-10', NULL, 1000, 'cc_1', 0, 0, ''),
(21, 'dep_21', 'art_2', '1,2,3,4,5', '', '2018-09-11', '2018-09-10', 'inst_1', 1000, 'cc_1', 0, 0, ''),
(22, 'dep_22', 'art_2', '1,2,3,4,5', '', '2018-09-11', '2018-09-10', 'inst_1', 1000, 'cc_1', 0, 0, ''),
(23, 'dep_23', 'art_2', '1,2,3,4,5,6,7,8,9,10,11,12', 'm', '2018-09-12', '2018-09-13', 'inst_1', 1000, 'cc_1', 0, 0, ''),
(24, 'dep_24', 'ebk_7', '1,2,3,4,5,6,7,8', 'm', '2018-09-14', '2018-09-21', 'inst_1', 300, 'cc_1', 1000, 500, ''),
(25, 'dep_25', 'ebk_7', '1,2,3,4,5,6,7,8', 'm', '2018-09-14', '2018-09-21', 'inst_1', 300, 'cc_1', 1000, 500, ''),
(26, 'dep_26', 'ebk_7', '1,2,3,4,5,6,7,8', 'm', '2018-09-14', '2018-09-21', 'inst_1', 300, 'cc_1', 1000, 500, ''),
(27, 'dep_27', 'vid_1', '', '', '2018-09-12', '2018-09-11', '', 123, '', 1000, 500, ''),
(28, 'dep_28', 'vid_1', '', '', '2018-09-12', '2018-09-11', '', 123, '', 1000, 500, ''),
(29, 'dep_29', 'vid_1', '', '', '2018-09-04', '2018-09-20', '', 123, '', 1000, 500, ''),
(30, 'dep_30', 'vid_1', '', '', '2018-09-04', '2018-09-20', 'inst_1', 123, 'cc_1', 1000, 500, ''),
(31, 'dep_31', 'vid_1', '', '', '2018-09-04', '2018-09-20', 'inst_1', 123, 'cc_1', 1000, 500, ''),
(32, 'dep_32', 'vid_1', '', '', '2018-09-04', '2018-09-20', 'inst_1', 123, 'cc_1', 1000, 500, ''),
(33, 'dep_33', 'vid_1', '', '', '2018-09-04', '2018-09-20', 'inst_1', 123, 'cc_1', 1000, 500, ''),
(34, 'dep_34', 'vid_1', '', '', '2018-09-04', '2018-09-20', 'inst_1', 123, 'cc_1', 1000, 500, ''),
(35, 'dep_35', 'work_19', '1,2,3,4,5,6,7,8,9,10,11,12', 'f', '2018-09-26', '2018-09-26', 'inst_1', 1000000, 'cc_1', 10, 0, ''),
(36, 'dep_36', 'web_14', '1,2,3,4,5,6,7,8,9,10,11,12', 'f', '2018-09-26', '2018-09-26', 'inst_1', 1000, 'cc_1', 1234, 0, ''),
(37, 'dep_37', 'web_14', '1,2,3,4,5,6,7,8,9,10,11,12', '', '2018-09-26', '2018-09-27', 'inst_1', 1000, 'cc_1', 1234, 0, ''),
(38, 'dep_38', 'web_14', '1,2,3,4,5,6,7,8,9,10,11,12', '', '2018-09-26', '2018-09-27', 'inst_1', 1000, 'cc_1', 1234, 0, ''),
(39, 'dep_39', 'web_14', '1,2,3,4,5,6,7,8,9,10,11,12', '', '2018-09-26', '2018-09-27', 'inst_1', 1000, 'cc_1', 1234, 0, ''),
(40, 'dep_40', 'web_14', '1,2,3,4,5,6,7,8,9,10,11,12', '', '2018-09-26', '2018-09-26', 'inst_1', 123, 'cc_1', 1234, 0, ''),
(41, '', 'web_14', '1,2,3,4,5,6,7,8,9,10,11,12', '', '2018-09-26', '2018-09-26', 'inst_1', 123, 'cc_1', 1234, 0, ''),
(42, 'dep_42', 'web_1', '', '', '2018-10-09', '2018-10-10', 'inst_1', 1000, 'cc_1', 1000, 500, ''),
(43, 'dep_43', 'web_1', '', '', '2018-10-09', '2018-10-10', 'inst_1', 1000, 'cc_1', 1000, 500, ''),
(44, 'dep_44', 'course_10', '', '', '2018-10-09', '2018-10-18', 'inst_1', 1000, 'cc_1', 123, 0, ''),
(45, 'dep_45', 'ebk_1', '11,12', '', '2018-10-03', '2018-10-25', 'inst_1', 200, 'cc_1', 123, 100, ''),
(46, 'dep_46', 'work_19', '9,10,11,12', 'f', '2018-10-26', '2018-10-25', 'inst_1', 500, 'cc_1', 1000, 800, ''),
(47, 'dep_47', 'art_1', '1,2,3,4,5', 'm', '2018-09-30', '2018-09-30', 'inst_1', 500, 'cc_1', 1234, 0, ''),
(48, 'dep_48', 'quiz_1', '6,7,8,9,10,11,12', 'f', '2018-10-26', '2018-10-30', 'inst_1', 1000, 'cc_1', 1500, 600, ''),
(49, 'dep_49', 'quiz_1', '6,7,8,9,10,11,12', 'f', '2018-10-27', '2018-10-31', 'inst_1', 500, 'cc_1', 1500, 600, '');

-- --------------------------------------------------------

--
-- Table structure for table `ebook`
--

CREATE TABLE `ebook` (
  `sno` int(11) NOT NULL,
  `club_id` varchar(20) NOT NULL,
  `book_id` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `author` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `time_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `vendor_id` varchar(20) DEFAULT NULL,
  `mrp_price` int(11) NOT NULL,
  `duration` time NOT NULL,
  `ebook_file` varchar(50) NOT NULL,
  `subscription_level` varchar(20) NOT NULL,
  `class_applicable_for` text NOT NULL,
  `school_price` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `topic_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ebook`
--

INSERT INTO `ebook` (`sno`, `club_id`, `book_id`, `name`, `author`, `description`, `date_added`, `time_added`, `vendor_id`, `mrp_price`, `duration`, `ebook_file`, `subscription_level`, `class_applicable_for`, `school_price`, `status`, `topic_id`) VALUES
(1, 'club_web', 'ebk_1', 'ebook create', 'ebook create', '<p>ebook create</p>\r\n', '2018-09-04 10:19:12', '2018-09-04 10:19:12', 'inst_1', 123, '01:00:00', '075701am98.pdf', 'silver', '6,7,8,9', 100, 1, 'tp_2'),
(2, 'club_web', 'ebk_2', 'updated', 'updated', '<p>updated</p>\r\n', '2018-09-04 12:08:44', '2018-09-04 12:08:44', 'inst_5', 2000, '03:25:00', 'A_64.pdf', 'gold', '6,7,8,9,10,11,12', 200, 0, 'tp_5'),
(3, 'club_app', 'ebk_3', 'testing', 'testing', '<p>testing</p>\r\n', '2018-09-04 13:00:04', '2018-09-04 13:00:04', NULL, 123, '01:00:00', 'testing_56.pdf', '', '', 0, 0, ''),
(4, 'club_web', 'ebk_4', 'demo ', 'demo ', '<h1>demo&nbsp;</h1>\r\n', '2018-09-05 11:56:38', '2018-09-05 11:56:38', NULL, 123, '01:00:00', 'demo _42.pdf', '', '', 0, 0, ''),
(5, 'club_web', 'ebk_5', 'demo 1', 'demo ', '<h1>demo&nbsp;</h1>\r\n', '2018-09-05 12:05:15', '2018-09-05 12:05:15', NULL, 123, '01:00:00', 'demo 1_29.pdf', '', '', 0, 0, ''),
(6, 'club_web', 'ebk_6', 'ebook title update', 'ebook author update', '<h1>ebook description update</h1>\r\n', '2018-09-05 12:12:09', '2018-09-05 12:12:09', 'inst_2', 1000, '02:45:00', 'ebook title update_3', '', '', 0, 0, ''),
(7, 'club_web', 'ebk_7', 'demoebook', 'demoebook', '<p>demoebook</p>\r\n', '2018-09-11 17:42:38', '2018-09-11 17:42:38', 'inst_2', 1000, '01:00:00', '021238pm01.pdf', 'gold', '6,7,8,9,10', 500, 0, ''),
(11, 'club_web', 'ebk_11', 'testsept17', 'testsept17', '<p>testsept17</p>\r\n', '2018-09-17 11:17:30', '2018-09-17 11:17:30', 'inst_1', 1000, '01:45:00', '074730am61.pdf', 'gold', '11,12', 800, 0, ''),
(12, 'club_web', 'ebk_12', 'asd', 'asd', '<p>asd</p>\r\n', '2018-09-26 11:22:48', '2018-09-26 11:22:48', 'inst_1', 234, '22:22:00', '', 'gold', '11', 1111, 0, ''),
(13, 'club_web', 'ebk_13', 'testingoct11.', 'Kiran.', '<p>testingoct11desc.</p>\r\n', '2018-10-11 11:38:46', '2018-10-11 11:38:46', 'inst_1', 1000, '01:20:00', '080925am99.pdf', 'silver', '6,7,8,9', 800, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `gen_course`
--

CREATE TABLE `gen_course` (
  `sno` int(11) NOT NULL,
  `course_id` varchar(20) NOT NULL,
  `course_name` varchar(100) NOT NULL,
  `course_code` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gen_course`
--

INSERT INTO `gen_course` (`sno`, `course_id`, `course_name`, `course_code`) VALUES
(1, 'technology', 'technology', 'technology'),
(2, 'creativity', 'creativity', 'creativity');

-- --------------------------------------------------------

--
-- Table structure for table `gen_course_class`
--

CREATE TABLE `gen_course_class` (
  `sno` int(11) NOT NULL,
  `class_id` varchar(20) NOT NULL,
  `course_id` varchar(20) NOT NULL,
  `class_name` varchar(100) NOT NULL,
  `class_details` text NOT NULL,
  `institute_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gen_course_class`
--

INSERT INTO `gen_course_class` (`sno`, `class_id`, `course_id`, `class_name`, `class_details`, `institute_id`) VALUES
(2, 'class_2', 'creativity', 'creativity', 'lalala', 'inst_1'),
(30, 'class_webdesign', 'technology', 'webdesign 3', 'web design and developement ', 'inst_1'),
(31, 'class_app dev', 'technology', 'app dev 3', 'app dev class\r\n', 'inst_1');

-- --------------------------------------------------------

--
-- Table structure for table `gen_section`
--

CREATE TABLE `gen_section` (
  `sno` int(11) NOT NULL,
  `section_id` varchar(20) NOT NULL,
  `subject_id` varchar(20) NOT NULL,
  `section_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gen_subject`
--

CREATE TABLE `gen_subject` (
  `sno` int(11) NOT NULL,
  `subject_id` varchar(20) NOT NULL,
  `class_id` varchar(20) NOT NULL,
  `subject_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gen_subject`
--

INSERT INTO `gen_subject` (`sno`, `subject_id`, `class_id`, `subject_name`) VALUES
(1, 'app_ui', 'class_app dev', 'App UIs'),
(2, 'app_code', 'class_app dev', 'App Programming'),
(4, 'web_ui', 'class_webdesign', 'Web Uis');

-- --------------------------------------------------------

--
-- Table structure for table `gen_subtopic`
--

CREATE TABLE `gen_subtopic` (
  `sno` int(11) NOT NULL,
  `subtopic_id` varchar(20) NOT NULL,
  `topic_id` varchar(20) NOT NULL,
  `subtopic_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gen_topic`
--

CREATE TABLE `gen_topic` (
  `sno` int(11) NOT NULL,
  `topic_id` varchar(20) NOT NULL,
  `subject_id` varchar(20) NOT NULL,
  `topic_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `institution`
--

CREATE TABLE `institution` (
  `sno` int(11) NOT NULL,
  `institute_id` varchar(20) NOT NULL,
  `institute_name` varchar(100) NOT NULL,
  `details` text NOT NULL,
  `promoters` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `email_id` varchar(100) NOT NULL,
  `batch_structure` varchar(120) NOT NULL,
  `phone_no` varchar(15) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `code` varchar(20) NOT NULL,
  `status` varchar(10) NOT NULL,
  `datetime` datetime NOT NULL,
  `call_at` time NOT NULL,
  `principal_email` varchar(100) NOT NULL,
  `principal_phone` varchar(15) NOT NULL,
  `principal_name` varchar(100) NOT NULL,
  `owner_name` varchar(100) DEFAULT NULL,
  `owner_email` varchar(100) DEFAULT NULL,
  `owner_phone` varchar(15) DEFAULT NULL,
  `coordinator_name` varchar(100) DEFAULT NULL,
  `coordinator_email` varchar(100) DEFAULT NULL,
  `coordinator_phone` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `institution`
--

INSERT INTO `institution` (`sno`, `institute_id`, `institute_name`, `details`, `promoters`, `address`, `email_id`, `batch_structure`, `phone_no`, `username`, `password`, `code`, `status`, `datetime`, `call_at`, `principal_email`, `principal_phone`, `principal_name`, `owner_name`, `owner_email`, `owner_phone`, `coordinator_name`, `coordinator_email`, `coordinator_phone`) VALUES
(4, 'inst_2', 'Institute 2', 'Very very nice institute', 'wingxp 2', 'andheri 2', 'wingxp@wingxp.com', '', '12345', 'wingxp', '', '', 'true', '0000-00-00 00:00:00', '00:00:00', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'inst_5', 'sdcdscsdcc', 'Principal Name: wjhbi Principal Email: ijnmPrincipal Contact: iuno', '', 'scsdcdc', 'nkiiunind@insdc/ok', '', '9137245036', '', '9137245036', '', 'true', '0000-00-00 00:00:00', '00:00:00', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'inst_6', 'ghjk', 'Principal Name: hjkbn Principal Email: jknkjPrincipal Contact: jknkjn', '', 'uyghjk', 'nkirankjhkdrgsdfoid@gmail.com', '', 'ugyhjk', '', 'ugyhjk', '', 'hold', '0000-00-00 00:00:00', '00:00:00', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL),
(258, 'INST_258', 'Aditya Birla Public School', 'Very nice institute', 'wingxp', 'andheri', 'nkirandroid@gmail.com', '', '9137245036', 'wingxp', '', '', 'false', '2019-02-02 01:01:01', '03:00:00', 'nkirandroid@gmail.com', '9167164221', 'KIRAN MANOJ NAMBIAR', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `inst_batch`
--

CREATE TABLE `inst_batch` (
  `sno` int(11) NOT NULL,
  `batch_id` varchar(20) NOT NULL,
  `class_id` varchar(20) NOT NULL,
  `batch_name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `session` text NOT NULL,
  `coordinator` varchar(100) NOT NULL,
  `class` int(20) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `division` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inst_batch`
--

INSERT INTO `inst_batch` (`sno`, `batch_id`, `class_id`, `batch_name`, `description`, `start_date`, `end_date`, `session`, `coordinator`, `class`, `subject`, `division`) VALUES
(24, 'INST_258_7_A', 'INST_258_7', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(25, 'INST_258_7_B', 'INST_258_7', 'B', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(26, 'INST_258_7_C', 'INST_258_7', 'C', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(27, 'INST_258_8_A', 'INST_258_8', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(28, 'INST_258_8_B', 'INST_258_8', 'B', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(29, 'INST_258_8_C', 'INST_258_8', 'C', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(30, 'INST_258_9_A', 'INST_258_9', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(31, 'INST_258_9_A', 'INST_258_9', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(32, 'INST_258_9_B', 'INST_258_9', 'B', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(33, 'INST_258_10_A', 'INST_258_10', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(37, 'INST_258_10_B', 'INST_258_10', 'B', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(38, 'INST_258_10_C', 'INST_258_10', 'C', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(39, 'INST_258_11_A', 'INST_258_11', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(40, 'INST_258_11_B', 'INST_258_11', 'B', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(41, 'INST_258_12_A', 'INST_258_12', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(42, 'INST_258_12_B', 'INST_258_12', 'B', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(43, 'inst_2_6_A', 'inst_2_6', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(44, 'inst_2_7_A', 'inst_2_7', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(45, 'inst_2_8_A', 'inst_2_8', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(46, 'inst_2_9_A', 'inst_2_9', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(47, 'inst_2_10_A', 'inst_2_10', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(48, 'inst_2_11_A', 'inst_2_11', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(49, 'inst_2_12_A', 'inst_2_12', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(50, 'inst_2_6_A', 'inst_2_6', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(51, 'inst_2_7_A', 'inst_2_7', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(52, 'inst_2_8_A', 'inst_2_8', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(53, 'inst_2_9_A', 'inst_2_9', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(54, 'inst_2_10_A', 'inst_2_10', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(55, 'inst_2_11_A', 'inst_2_11', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(56, 'inst_2_12_A', 'inst_2_12', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(57, 'inst_2_6_A', 'inst_2_6', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(58, 'inst_2_7_A', 'inst_2_7', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(59, 'inst_2_8_A', 'inst_2_8', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(60, 'inst_2_9_A', 'inst_2_9', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(61, 'inst_2_10_A', 'inst_2_10', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(62, 'inst_2_11_A', 'inst_2_11', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(63, 'inst_2_12_A', 'inst_2_12', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(64, 'inst_2_6_A', 'inst_2_6', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(65, 'inst_2_7_A', 'inst_2_7', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(66, 'inst_2_8_A', 'inst_2_8', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(67, 'inst_2_9_A', 'inst_2_9', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(68, 'inst_2_10_A', 'inst_2_10', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(69, 'inst_2_11_A', 'inst_2_11', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(70, 'inst_2_12_A', 'inst_2_12', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(71, 'inst_2_6_A', 'inst_2_6', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(72, 'inst_2_7_A', 'inst_2_7', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(73, 'inst_2_8_A', 'inst_2_8', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(74, 'inst_2_9_A', 'inst_2_9', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(75, 'inst_2_10_A', 'inst_2_10', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(76, 'inst_2_11_A', 'inst_2_11', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(77, 'inst_2_12_A', 'inst_2_12', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(78, 'inst_2_6_A', 'inst_2_6', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(79, 'inst_2_7_A', 'inst_2_7', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(80, 'inst_2_8_A', 'inst_2_8', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(81, 'inst_2_9_A', 'inst_2_9', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(82, 'inst_2_10_A', 'inst_2_10', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(83, 'inst_2_11_A', 'inst_2_11', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(84, 'inst_2_12_A', 'inst_2_12', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(85, 'inst_2_6_A', 'inst_2_6', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(86, 'inst_2_7_A', 'inst_2_7', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(87, 'inst_2_8_A', 'inst_2_8', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(88, 'inst_2_9_A', 'inst_2_9', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(89, 'inst_2_10_A', 'inst_2_10', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(90, 'inst_2_11_A', 'inst_2_11', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(91, 'inst_2_12_A', 'inst_2_12', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(92, 'inst_2_6_A', 'inst_2_6', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(93, 'inst_2_7_A', 'inst_2_7', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(94, 'inst_2_8_A', 'inst_2_8', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(95, 'inst_2_9_A', 'inst_2_9', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(96, 'inst_2_10_A', 'inst_2_10', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(97, 'inst_2_11_A', 'inst_2_11', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(98, 'inst_2_12_A', 'inst_2_12', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(99, 'inst_2_6_A', 'inst_2_6', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(100, 'inst_2_7_A', 'inst_2_7', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(101, 'inst_2_8_A', 'inst_2_8', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(102, 'inst_2_9_A', 'inst_2_9', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(103, 'inst_2_10_A', 'inst_2_10', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(104, 'inst_2_11_A', 'inst_2_11', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(105, 'inst_2_12_A', 'inst_2_12', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(106, 'inst_2_6_A', 'inst_2_6', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(107, 'inst_2_7_A', 'inst_2_7', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(108, 'inst_2_8_A', 'inst_2_8', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(109, 'inst_2_9_A', 'inst_2_9', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(110, 'inst_2_10_A', 'inst_2_10', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(111, 'inst_2_11_A', 'inst_2_11', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(112, 'inst_2_12_A', 'inst_2_12', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(113, 'inst_2_6_A', 'inst_2_6', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(114, 'inst_2_7_A', 'inst_2_7', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(115, 'inst_2_8_A', 'inst_2_8', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(116, 'inst_2_9_A', 'inst_2_9', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(117, 'inst_2_10_A', 'inst_2_10', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(118, 'inst_2_11_A', 'inst_2_11', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(119, 'inst_2_12_A', 'inst_2_12', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(120, 'inst_2_6_A', 'inst_2_6', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(121, 'inst_2_7_A', 'inst_2_7', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(122, 'inst_2_8_A', 'inst_2_8', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(123, 'inst_2_9_A', 'inst_2_9', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(124, 'inst_2_10_A', 'inst_2_10', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(125, 'inst_2_11_A', 'inst_2_11', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(126, 'inst_2_12_A', 'inst_2_12', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(127, 'inst_2_6_A', 'inst_2_6', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(128, 'inst_2_7_A', 'inst_2_7', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(129, 'inst_2_8_A', 'inst_2_8', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(130, 'inst_2_9_A', 'inst_2_9', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(131, 'inst_2_10_A', 'inst_2_10', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(132, 'inst_2_11_A', 'inst_2_11', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(133, 'inst_2_12_A', 'inst_2_12', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(134, 'inst_2_6_A', 'inst_2_6', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(135, 'inst_2_7_A', 'inst_2_7', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(136, 'inst_2_8_A', 'inst_2_8', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(137, 'inst_2_9_A', 'inst_2_9', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(138, 'inst_2_10_A', 'inst_2_10', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(139, 'inst_2_11_A', 'inst_2_11', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(140, 'inst_2_12_A', 'inst_2_12', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(141, 'inst_2_6_A', 'inst_2_6', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(142, 'inst_2_7_A', 'inst_2_7', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(143, 'inst_2_8_A', 'inst_2_8', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(144, 'inst_2_9_A', 'inst_2_9', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(145, 'inst_2_10_A', 'inst_2_10', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(146, 'inst_2_11_A', 'inst_2_11', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', ''),
(147, 'inst_2_12_A', 'inst_2_12', 'A', '', '0000-00-00', '0000-00-00', '', '', 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `inst_batch_assign`
--

CREATE TABLE `inst_batch_assign` (
  `sno` int(11) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `batch_id` varchar(20) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inst_batch_assign`
--

INSERT INTO `inst_batch_assign` (`sno`, `user_id`, `batch_id`, `date_added`) VALUES
(1, 'st_258_26', 'INST_258_6_A', '2018-12-14 17:11:50'),
(2, 'st_258_27', 'INST_258_6_A', '2018-12-14 17:11:50'),
(3, 'st_258_28', 'INST_258_6_A', '2018-12-14 17:11:50'),
(4, 'st_258_29', 'INST_258_6_A', '2018-12-14 17:11:50'),
(5, 'st_258_30', 'INST_258_11_B', '2018-12-14 17:13:34'),
(6, 'st_258_31', 'INST_258_11_B', '2018-12-14 17:13:34'),
(7, 'st_258_32', 'INST_258_11_B', '2018-12-14 17:13:34'),
(8, 'st_258_33', 'INST_258_11_B', '2018-12-14 17:13:34'),
(9, 'st_259_30', 'INST_259_6_A', '2019-02-12 13:42:47'),
(10, 'st_259_31', 'INST_259_6_A', '2019-02-12 13:42:48'),
(11, 'st_259_32', 'INST_259_6_A', '2019-02-12 13:42:49'),
(12, 'st_259_33', 'INST_259_6_A', '2019-02-12 13:42:49'),
(13, 'st_259_34', 'INST_259_12_A', '2019-02-12 13:42:49'),
(14, 'st_255_35', 'INST_255_6_A', '2019-02-12 13:46:45'),
(15, 'st_255_36', 'INST_255_6_A', '2019-02-12 13:46:45'),
(16, 'st_255_37', 'INST_255_6_A', '2019-02-12 13:46:45'),
(17, 'st_255_38', 'INST_255_6_A', '2019-02-12 13:46:45'),
(18, 'st_255_39', 'INST_255_12_A', '2019-02-12 13:46:46'),
(19, 'st_255_40', 'INST_255_6_A', '2019-02-12 13:49:19'),
(20, 'st_255_41', 'INST_255_6_A', '2019-02-12 13:49:19'),
(21, 'st_255_42', 'INST_255_6_A', '2019-02-12 13:49:19'),
(22, 'st_255_43', 'INST_255_6_A', '2019-02-12 13:49:19'),
(23, 'st_255_44', 'INST_255_12_A', '2019-02-12 13:49:20'),
(24, 'st_255_45', 'INST_255_6_A', '2019-02-12 13:52:25'),
(25, 'st_255_46', 'INST_255_6_A', '2019-02-12 13:52:25'),
(26, 'st_255_47', 'INST_255_6_A', '2019-02-12 13:52:25'),
(27, 'st_255_48', 'INST_255_6_A', '2019-02-12 13:52:26'),
(28, 'st_255_49', 'INST_255_12_A', '2019-02-12 13:52:26'),
(29, 'st_255_50', 'INST_255_6_A', '2019-02-12 13:53:11'),
(30, 'st_255_51', 'INST_255_6_A', '2019-02-12 13:53:11'),
(31, 'st_255_52', 'INST_255_6_A', '2019-02-12 13:53:11'),
(32, 'st_255_53', 'INST_255_6_A', '2019-02-12 13:53:11'),
(33, 'st_255_54', 'INST_255_12_A', '2019-02-12 13:53:11'),
(34, 'st_255_55', 'INST_255_6_A', '2019-02-12 13:53:58'),
(35, 'st_255_56', 'INST_255_6_A', '2019-02-12 13:53:59'),
(36, 'st_255_57', 'INST_255_6_A', '2019-02-12 13:53:59'),
(37, 'st_255_58', 'INST_255_6_A', '2019-02-12 13:53:59'),
(38, 'st_255_59', 'INST_255_12_A', '2019-02-12 13:53:59'),
(39, 'st_255_60', 'INST_255_6_A', '2019-02-12 13:55:02'),
(40, 'st_255_61', 'INST_255_6_A', '2019-02-12 13:55:02'),
(41, 'st_255_62', 'INST_255_6_A', '2019-02-12 13:55:02'),
(42, 'st_255_63', 'INST_255_6_A', '2019-02-12 13:55:02'),
(43, 'st_255_64', 'INST_255_12_A', '2019-02-12 13:55:02'),
(44, 'st_255_1', 'INST_255_6_A', '2019-02-12 14:00:20'),
(45, 'st_255_2', 'INST_255_6_A', '2019-02-12 14:00:20'),
(46, 'st_255_3', 'INST_255_6_A', '2019-02-12 14:00:21'),
(47, 'st_255_4', 'INST_255_6_A', '2019-02-12 14:00:21'),
(48, 'st_255_5', 'INST_255_12_A', '2019-02-12 14:00:21'),
(49, 'st_255_1', 'INST_255_6_A', '2019-02-12 14:01:27'),
(50, 'st_255_2', 'INST_255_6_A', '2019-02-12 14:01:27'),
(51, 'st_255_3', 'INST_255_6_A', '2019-02-12 14:01:27'),
(52, 'st_255_4', 'INST_255_6_A', '2019-02-12 14:01:27'),
(53, 'st_255_5', 'INST_255_12_A', '2019-02-12 14:01:27'),
(54, 'st_255_1', 'INST_255_6_A', '2019-02-12 14:02:48'),
(55, 'st_255_2', 'INST_255_6_A', '2019-02-12 14:02:48'),
(56, 'st_255_3', 'INST_255_6_A', '2019-02-12 14:02:48'),
(57, 'st_255_4', 'INST_255_6_A', '2019-02-12 14:02:48'),
(58, 'st_255_5', 'INST_255_12_A', '2019-02-12 14:02:48'),
(59, 'st_255_1', 'INST_255_6_A', '2019-02-12 14:08:29'),
(60, 'st_255_2', 'INST_255_6_A', '2019-02-12 14:08:29'),
(61, 'st_255_3', 'INST_255_6_A', '2019-02-12 14:08:29'),
(62, 'st_255_4', 'INST_255_6_A', '2019-02-12 14:08:29'),
(63, 'st_255_5', 'INST_255_12_A', '2019-02-12 14:08:29'),
(64, 'st_255_1', 'INST_255_6_A', '2019-02-12 14:13:11'),
(65, 'st_255_2', 'INST_255_6_A', '2019-02-12 14:13:11'),
(66, 'st_255_3', 'INST_255_6_A', '2019-02-12 14:13:11'),
(67, 'st_255_4', 'INST_255_6_A', '2019-02-12 14:13:11'),
(68, 'st_255_5', 'INST_255_12_A', '2019-02-12 14:13:12'),
(69, 'st_255_1', 'INST_255_6_A', '2019-02-12 14:14:33'),
(70, 'st_255_2', 'INST_255_6_A', '2019-02-12 14:14:33'),
(71, 'st_255_3', 'INST_255_6_A', '2019-02-12 14:14:33'),
(72, 'st_255_4', 'INST_255_6_A', '2019-02-12 14:14:33'),
(73, 'st_255_5', 'INST_255_6_A', '2019-02-12 14:14:34'),
(74, 'st_255_6', 'INST_255_12_A', '2019-02-12 14:14:34'),
(75, 'st_255_1', 'INST_255_6_A', '2019-02-12 14:18:42'),
(76, 'st_255_2', 'INST_255_6_A', '2019-02-12 14:18:43'),
(77, 'st_255_3', 'INST_255_6_A', '2019-02-12 14:18:43'),
(78, 'st_255_4', 'INST_255_6_A', '2019-02-12 14:18:43'),
(79, 'st_255_5', 'INST_255_6_A', '2019-02-12 14:18:43'),
(80, 'st_255_6', 'INST_255_12_A', '2019-02-12 14:18:43'),
(81, 'st_255_1', 'INST_255_6_A', '2019-02-12 14:20:35'),
(82, 'st_255_2', 'INST_255_6_A', '2019-02-12 14:20:35'),
(83, 'st_255_1', 'INST_255_6_A', '2019-02-12 14:20:57'),
(84, 'st_255_2', 'INST_255_6_A', '2019-02-12 14:20:57'),
(85, 'st_255_1', 'INST_255_6_A', '2019-02-12 14:45:39'),
(86, 'st_255_2', 'INST_255_6_A', '2019-02-12 14:45:39'),
(87, 'st_255_1', 'INST_255_6_A', '2019-02-12 14:46:52'),
(88, 'st_255_2', 'INST_255_6_A', '2019-02-12 14:46:52'),
(89, 'st_255_1', 'INST_255_6_A', '2019-02-12 14:47:42'),
(90, 'st_255_2', 'INST_255_6_A', '2019-02-12 14:47:42'),
(91, 'st_255_1', 'INST_255_6_A', '2019-02-12 14:48:54'),
(92, 'st_255_2', 'INST_255_6_A', '2019-02-12 14:48:54'),
(93, 'st_255_1', 'INST_255_6_A', '2019-02-12 14:51:40'),
(94, 'st_255_2', 'INST_255_6_A', '2019-02-12 14:51:41'),
(95, 'st_255_1', 'INST_255_6_A', '2019-02-12 14:53:03'),
(96, 'st_255_2', 'INST_255_6_A', '2019-02-12 14:53:03'),
(97, 'st_255_1', 'INST_255_6_A', '2019-02-12 14:55:39'),
(98, 'st_255_2', 'INST_255_6_A', '2019-02-12 14:55:39'),
(99, 'st_255_3', 'INST_255_6_A', '2019-02-12 14:55:40'),
(100, 'st_255_4', 'INST_255_6_A', '2019-02-12 14:55:40'),
(101, 'st_255_5', 'INST_255_6_A', '2019-02-12 14:55:40'),
(102, 'st_255_6', 'INST_255_12_A', '2019-02-12 14:55:40'),
(103, 'st_255_1', 'INST_255_6_A', '2019-02-12 14:57:12'),
(104, 'st_255_2', 'INST_255_6_A', '2019-02-12 14:57:12'),
(105, 'st_255_3', 'INST_255_6_A', '2019-02-12 14:57:12'),
(106, 'st_255_4', 'INST_255_6_A', '2019-02-12 14:57:12'),
(107, 'st_255_5', 'INST_255_6_A', '2019-02-12 14:57:12'),
(108, 'st_255_6', 'INST_255_12_A', '2019-02-12 14:57:13'),
(109, 'st_255_1', 'INST_255_6_A', '2019-02-12 14:58:35'),
(110, 'st_255_2', 'INST_255_6_A', '2019-02-12 14:58:35'),
(111, 'st_255_3', 'INST_255_6_A', '2019-02-12 14:58:35'),
(112, 'st_255_4', 'INST_255_6_A', '2019-02-12 14:58:35'),
(113, 'st_255_5', 'INST_255_6_A', '2019-02-12 14:58:35'),
(114, 'st_255_6', 'INST_255_12_A', '2019-02-12 14:58:35'),
(115, 'st_255_1', 'INST_255_6_A', '2019-02-12 15:00:27'),
(116, 'st_255_2', 'INST_255_6_A', '2019-02-12 15:00:27'),
(117, 'st_255_3', 'INST_255_6_A', '2019-02-12 15:00:28'),
(118, 'st_255_4', 'INST_255_6_A', '2019-02-12 15:00:28'),
(119, 'st_255_5', 'INST_255_6_A', '2019-02-12 15:00:28'),
(120, 'st_255_6', 'INST_255_12_A', '2019-02-12 15:00:28'),
(121, 'st_255_1', 'INST_255_6_A', '2019-02-12 17:29:09'),
(122, 'st_255_2', 'INST_255_6_A', '2019-02-12 17:29:09'),
(123, 'st_255_1', 'INST_255_6_A', '2019-02-12 17:39:33'),
(124, 'st_255_2', 'INST_255_6_A', '2019-02-12 17:39:33'),
(125, 'st_255_3', 'INST_255_6_A', '2019-02-12 17:39:33'),
(126, 'st_255_4', 'INST_255_6_A', '2019-02-12 17:39:34'),
(127, 'st_255_5', 'INST_255_6_A', '2019-02-12 17:39:34'),
(128, 'st_255_6', 'INST_255_12_A', '2019-02-12 17:39:34'),
(129, 'st_255_1', 'INST_255_6_A', '2019-02-12 17:43:07'),
(130, 'st_255_2', 'INST_255_6_A', '2019-02-12 17:43:07'),
(131, 'st_255_3', 'INST_255_6_A', '2019-02-12 17:43:07'),
(132, 'st_255_4', 'INST_255_6_A', '2019-02-12 17:43:07'),
(133, 'st_255_5', 'INST_255_6_A', '2019-02-12 17:43:08'),
(134, 'st_255_6', 'INST_255_12_A', '2019-02-12 17:43:08'),
(135, 'st_255_1', 'INST_255_6_A', '2019-02-12 17:44:53'),
(136, 'st_255_2', 'INST_255_6_A', '2019-02-12 17:44:53'),
(137, 'st_255_1', 'INST_255_6_A', '2019-02-12 18:01:57'),
(138, 'st_255_2', 'INST_255_6_A', '2019-02-12 18:01:57'),
(139, 'st_255_3', 'INST_255_6_A', '2019-02-12 18:01:57'),
(140, 'st_255_4', 'INST_255_6_A', '2019-02-12 18:01:57'),
(141, 'st_255_5', 'INST_255_6_A', '2019-02-12 18:01:57'),
(142, 'st_255_6', 'INST_255_12_A', '2019-02-12 18:01:57'),
(143, 'st_255_1', 'INST_255_6_A', '2019-02-12 18:02:55'),
(144, 'st_255_2', 'INST_255_6_A', '2019-02-12 18:02:55'),
(145, 'st_255_3', 'INST_255_6_A', '2019-02-12 18:02:55'),
(146, 'st_255_4', 'INST_255_6_A', '2019-02-12 18:02:55'),
(147, 'st_255_5', 'INST_255_6_A', '2019-02-12 18:02:55'),
(148, 'st_255_6', 'INST_255_12_A', '2019-02-12 18:02:55'),
(149, 'st_255_1', 'INST_255_6_A', '2019-02-12 18:03:55'),
(150, 'st_255_2', 'INST_255_6_A', '2019-02-12 18:03:55'),
(151, 'st_255_3', 'INST_255_6_A', '2019-02-12 18:03:55'),
(152, 'st_255_4', 'INST_255_6_A', '2019-02-12 18:03:55'),
(153, 'st_255_5', 'INST_255_6_A', '2019-02-12 18:03:55'),
(154, 'st_255_6', 'INST_255_12_A', '2019-02-12 18:03:56'),
(155, 'st_255_1', 'INST_255_6_A', '2019-02-12 18:05:57'),
(156, 'st_255_2', 'INST_255_6_A', '2019-02-12 18:05:57'),
(157, 'st_255_3', 'INST_255_6_A', '2019-02-12 18:05:57'),
(158, 'st_255_4', 'INST_255_6_A', '2019-02-12 18:05:57'),
(159, 'st_255_5', 'INST_255_6_A', '2019-02-12 18:05:58'),
(160, 'st_255_6', 'INST_255_12_A', '2019-02-12 18:05:58'),
(161, 'st_255_1', 'INST_255_6_A', '2019-02-12 18:06:29'),
(162, 'st_255_2', 'INST_255_6_A', '2019-02-12 18:06:29'),
(163, 'st_255_3', 'INST_255_6_A', '2019-02-12 18:06:29'),
(164, 'st_255_4', 'INST_255_6_A', '2019-02-12 18:06:29'),
(165, 'st_255_5', 'INST_255_6_A', '2019-02-12 18:06:29'),
(166, 'st_255_6', 'INST_255_12_A', '2019-02-12 18:06:30'),
(167, 'st_255_1', 'INST_255_6_A', '2019-02-12 18:14:30'),
(168, 'st_255_2', 'INST_255_6_A', '2019-02-12 18:14:31'),
(169, 'st_255_3', 'INST_255_6_A', '2019-02-12 18:14:31'),
(170, 'st_255_4', 'INST_255_6_A', '2019-02-12 18:14:31'),
(171, 'st_255_5', 'INST_255_6_A', '2019-02-12 18:14:31'),
(172, 'st_255_6', 'INST_255_12_A', '2019-02-12 18:14:31'),
(173, 'st_255_1', 'INST_255_6_A', '2019-02-12 18:16:33'),
(174, 'st_255_2', 'INST_255_6_A', '2019-02-12 18:16:34'),
(175, 'st_255_3', 'INST_255_6_A', '2019-02-12 18:16:34'),
(176, 'st_255_4', 'INST_255_6_A', '2019-02-12 18:16:34'),
(177, 'st_255_5', 'INST_255_6_A', '2019-02-12 18:16:34'),
(178, 'st_255_6', 'INST_255_12_A', '2019-02-12 18:16:34'),
(179, 'st_255_1', 'INST_255_6_A', '2019-02-12 18:17:30'),
(180, 'st_255_2', 'INST_255_6_A', '2019-02-12 18:17:30'),
(181, 'st_255_3', 'INST_255_6_A', '2019-02-12 18:17:30'),
(182, 'st_255_4', 'INST_255_6_A', '2019-02-12 18:17:30'),
(183, 'st_255_5', 'INST_255_6_A', '2019-02-12 18:17:30'),
(184, 'st_255_6', 'INST_255_12_A', '2019-02-12 18:17:30'),
(185, 'st_255_7', 'INST_255_6_A', '2019-02-21 17:54:31'),
(186, 'st_255_8', 'INST_255_6_A', '2019-02-21 17:54:31'),
(187, 'st_255_9', 'INST_255_6_A', '2019-02-21 17:56:24'),
(188, 'st_255_10', 'INST_255_6_A', '2019-02-21 17:56:24'),
(189, 'st_255_1', 'INST_255_6_A', '2019-02-21 17:57:29'),
(190, 'st_255_2', 'INST_255_6_A', '2019-02-21 17:57:29'),
(191, 'st_255_1', 'INST_255_6_A', '2019-02-21 17:58:50'),
(192, 'st_255_2', 'INST_255_6_A', '2019-02-21 17:58:50'),
(193, 'st_255_1', 'INST_255_6_A', '2019-02-21 18:03:22'),
(194, 'st_255_2', 'INST_255_6_A', '2019-02-21 18:03:22'),
(195, 'st_255_1', 'INST_255_6_A', '2019-02-21 18:05:02'),
(196, 'st_255_2', 'INST_255_6_A', '2019-02-21 18:05:02'),
(197, 'st_255_1', 'INST_255_6_A', '2019-02-21 18:05:54'),
(198, 'st_255_2', 'INST_255_6_A', '2019-02-21 18:05:54'),
(199, 'st_258_3', 'INST_258_6_A', '2019-03-04 12:44:47'),
(200, 'st_258_4', 'INST_258_6_A', '2019-03-04 12:44:47'),
(201, 'st_258_5', 'INST_258_6_A', '2019-03-04 12:56:29'),
(202, 'st_258_6', 'INST_258_6_A', '2019-03-04 12:56:29'),
(203, 'st_258_7', 'INST_258_6_A', '2019-03-04 13:10:15'),
(204, 'st_258_8', 'INST_258_6_A', '2019-03-04 13:10:15'),
(205, 'st_258_9', 'INST_258_6_A', '2019-03-04 13:23:19'),
(206, 'st_258_10', 'INST_258_6_A', '2019-03-04 13:23:19'),
(207, 'st_258_11', 'INST_258_6_A', '2019-03-04 13:24:10'),
(208, 'st_258_12', 'INST_258_6_A', '2019-03-04 13:24:10'),
(209, 'st_258_13', 'INST_258_6_A', '2019-03-04 13:39:54'),
(210, 'st_258_14', 'INST_258_6_A', '2019-03-04 13:39:54');

-- --------------------------------------------------------

--
-- Table structure for table `inst_class`
--

CREATE TABLE `inst_class` (
  `sno` int(11) NOT NULL,
  `class_id` varchar(20) NOT NULL,
  `course_id` varchar(20) NOT NULL,
  `institute_id` varchar(20) NOT NULL,
  `class` int(11) NOT NULL,
  `class_detail` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inst_class`
--

INSERT INTO `inst_class` (`sno`, `class_id`, `course_id`, `institute_id`, `class`, `class_detail`) VALUES
(9, 'INST_258_7', '', 'INST_258', 7, ''),
(10, 'INST_258_8', '', 'INST_258', 8, ''),
(11, 'INST_258_9', '', 'INST_258', 9, ''),
(12, 'INST_258_10', '', 'INST_258', 10, ''),
(13, 'INST_258_11', '', 'INST_258', 11, ''),
(14, 'INST_258_12', '', 'INST_258', 12, ''),
(15, 'inst_2_6', '', 'inst_2', 6, ''),
(16, 'inst_2_7', '', 'inst_2', 7, ''),
(17, 'inst_2_8', '', 'inst_2', 8, ''),
(18, 'inst_2_9', '', 'inst_2', 9, ''),
(19, 'inst_2_10', '', 'inst_2', 10, ''),
(20, 'inst_2_11', '', 'inst_2', 11, ''),
(21, 'inst_2_12', '', 'inst_2', 12, ''),
(22, 'inst_2_6', '', 'inst_2', 6, ''),
(23, 'inst_2_7', '', 'inst_2', 7, ''),
(24, 'inst_2_8', '', 'inst_2', 8, ''),
(25, 'inst_2_9', '', 'inst_2', 9, ''),
(26, 'inst_2_10', '', 'inst_2', 10, ''),
(27, 'inst_2_11', '', 'inst_2', 11, ''),
(28, 'inst_2_12', '', 'inst_2', 12, ''),
(29, 'inst_2_6', '', 'inst_2', 6, ''),
(30, 'inst_2_7', '', 'inst_2', 7, ''),
(31, 'inst_2_8', '', 'inst_2', 8, ''),
(32, 'inst_2_9', '', 'inst_2', 9, ''),
(33, 'inst_2_10', '', 'inst_2', 10, ''),
(34, 'inst_2_11', '', 'inst_2', 11, ''),
(35, 'inst_2_12', '', 'inst_2', 12, ''),
(36, 'inst_2_6', '', 'inst_2', 6, ''),
(37, 'inst_2_7', '', 'inst_2', 7, ''),
(38, 'inst_2_8', '', 'inst_2', 8, ''),
(39, 'inst_2_9', '', 'inst_2', 9, ''),
(40, 'inst_2_10', '', 'inst_2', 10, ''),
(41, 'inst_2_11', '', 'inst_2', 11, ''),
(42, 'inst_2_12', '', 'inst_2', 12, ''),
(43, 'inst_2_6', '', 'inst_2', 6, ''),
(44, 'inst_2_7', '', 'inst_2', 7, ''),
(45, 'inst_2_8', '', 'inst_2', 8, ''),
(46, 'inst_2_9', '', 'inst_2', 9, ''),
(47, 'inst_2_10', '', 'inst_2', 10, ''),
(48, 'inst_2_11', '', 'inst_2', 11, ''),
(49, 'inst_2_12', '', 'inst_2', 12, ''),
(50, 'inst_2_6', '', 'inst_2', 6, ''),
(51, 'inst_2_7', '', 'inst_2', 7, ''),
(52, 'inst_2_8', '', 'inst_2', 8, ''),
(53, 'inst_2_9', '', 'inst_2', 9, ''),
(54, 'inst_2_10', '', 'inst_2', 10, ''),
(55, 'inst_2_11', '', 'inst_2', 11, ''),
(56, 'inst_2_12', '', 'inst_2', 12, ''),
(57, 'inst_2_6', '', 'inst_2', 6, ''),
(58, 'inst_2_7', '', 'inst_2', 7, ''),
(59, 'inst_2_8', '', 'inst_2', 8, ''),
(60, 'inst_2_9', '', 'inst_2', 9, ''),
(61, 'inst_2_10', '', 'inst_2', 10, ''),
(62, 'inst_2_11', '', 'inst_2', 11, ''),
(63, 'inst_2_12', '', 'inst_2', 12, ''),
(64, 'inst_2_6', '', 'inst_2', 6, ''),
(65, 'inst_2_7', '', 'inst_2', 7, ''),
(66, 'inst_2_8', '', 'inst_2', 8, ''),
(67, 'inst_2_9', '', 'inst_2', 9, ''),
(68, 'inst_2_10', '', 'inst_2', 10, ''),
(69, 'inst_2_11', '', 'inst_2', 11, ''),
(70, 'inst_2_12', '', 'inst_2', 12, ''),
(71, 'inst_2_6', '', 'inst_2', 6, ''),
(72, 'inst_2_7', '', 'inst_2', 7, ''),
(73, 'inst_2_8', '', 'inst_2', 8, ''),
(74, 'inst_2_9', '', 'inst_2', 9, ''),
(75, 'inst_2_10', '', 'inst_2', 10, ''),
(76, 'inst_2_11', '', 'inst_2', 11, ''),
(77, 'inst_2_12', '', 'inst_2', 12, ''),
(78, 'inst_2_6', '', 'inst_2', 6, ''),
(79, 'inst_2_7', '', 'inst_2', 7, ''),
(80, 'inst_2_8', '', 'inst_2', 8, ''),
(81, 'inst_2_9', '', 'inst_2', 9, ''),
(82, 'inst_2_10', '', 'inst_2', 10, ''),
(83, 'inst_2_11', '', 'inst_2', 11, ''),
(84, 'inst_2_12', '', 'inst_2', 12, ''),
(85, 'inst_2_6', '', 'inst_2', 6, ''),
(86, 'inst_2_7', '', 'inst_2', 7, ''),
(87, 'inst_2_8', '', 'inst_2', 8, ''),
(88, 'inst_2_9', '', 'inst_2', 9, ''),
(89, 'inst_2_10', '', 'inst_2', 10, ''),
(90, 'inst_2_11', '', 'inst_2', 11, ''),
(91, 'inst_2_12', '', 'inst_2', 12, ''),
(92, 'inst_2_6', '', 'inst_2', 6, ''),
(93, 'inst_2_7', '', 'inst_2', 7, ''),
(94, 'inst_2_8', '', 'inst_2', 8, ''),
(95, 'inst_2_9', '', 'inst_2', 9, ''),
(96, 'inst_2_10', '', 'inst_2', 10, ''),
(97, 'inst_2_11', '', 'inst_2', 11, ''),
(98, 'inst_2_12', '', 'inst_2', 12, ''),
(99, 'inst_2_6', '', 'inst_2', 6, ''),
(100, 'inst_2_7', '', 'inst_2', 7, ''),
(101, 'inst_2_8', '', 'inst_2', 8, ''),
(102, 'inst_2_9', '', 'inst_2', 9, ''),
(103, 'inst_2_10', '', 'inst_2', 10, ''),
(104, 'inst_2_11', '', 'inst_2', 11, ''),
(105, 'inst_2_12', '', 'inst_2', 12, ''),
(106, 'inst_2_6', '', 'inst_2', 6, ''),
(107, 'inst_2_7', '', 'inst_2', 7, ''),
(108, 'inst_2_8', '', 'inst_2', 8, ''),
(109, 'inst_2_9', '', 'inst_2', 9, ''),
(110, 'inst_2_10', '', 'inst_2', 10, ''),
(111, 'inst_2_11', '', 'inst_2', 11, ''),
(112, 'inst_2_12', '', 'inst_2', 12, ''),
(113, 'inst_2_6', '', 'inst_2', 6, ''),
(114, 'inst_2_7', '', 'inst_2', 7, ''),
(115, 'inst_2_8', '', 'inst_2', 8, ''),
(116, 'inst_2_9', '', 'inst_2', 9, ''),
(117, 'inst_2_10', '', 'inst_2', 10, ''),
(118, 'inst_2_11', '', 'inst_2', 11, ''),
(119, 'inst_2_12', '', 'inst_2', 12, '');

-- --------------------------------------------------------

--
-- Table structure for table `inst_club_assign`
--

CREATE TABLE `inst_club_assign` (
  `sno` int(11) NOT NULL,
  `club_id` varchar(20) NOT NULL,
  `institute_id` varchar(20) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inst_club_assign`
--

INSERT INTO `inst_club_assign` (`sno`, `club_id`, `institute_id`, `status`) VALUES
(70, 'club_18', 'inst_2', 0),
(71, 'club_21', 'inst_2', 0),
(72, 'club_22', 'inst_2', 0),
(73, 'club_23', 'inst_2', 0),
(74, 'club_24', 'inst_2', 0),
(75, 'club_25', 'inst_2', 0),
(76, 'club_26', 'inst_2', 0),
(77, 'club_27', 'inst_2', 0),
(78, 'club_18', 'inst_2', 0),
(79, 'club_21', 'inst_2', 0),
(80, 'club_22', 'inst_2', 0),
(81, 'club_23', 'inst_2', 0),
(82, 'club_24', 'inst_2', 0),
(83, 'club_25', 'inst_2', 0),
(84, 'club_26', 'inst_2', 0),
(85, 'club_27', 'inst_2', 0),
(86, 'club_18', 'inst_2', 0),
(87, 'club_21', 'inst_2', 0),
(88, 'club_22', 'inst_2', 0),
(89, 'club_23', 'inst_2', 0),
(90, 'club_24', 'inst_2', 0),
(91, 'club_25', 'inst_2', 0),
(92, 'club_26', 'inst_2', 0),
(93, 'club_27', 'inst_2', 0),
(94, 'club_18', 'inst_2', 0),
(95, 'club_21', 'inst_2', 0),
(96, 'club_22', 'inst_2', 0),
(97, 'club_23', 'inst_2', 0),
(98, 'club_24', 'inst_2', 0),
(99, 'club_25', 'inst_2', 0),
(100, 'club_26', 'inst_2', 0),
(101, 'club_27', 'inst_2', 0),
(102, 'club_18', 'inst_2', 0),
(103, 'club_21', 'inst_2', 0),
(104, 'club_22', 'inst_2', 0),
(105, 'club_23', 'inst_2', 0),
(106, 'club_24', 'inst_2', 0),
(107, 'club_25', 'inst_2', 0),
(108, 'club_26', 'inst_2', 0),
(109, 'club_27', 'inst_2', 0),
(110, 'club_18', 'inst_2', 0),
(111, 'club_21', 'inst_2', 0),
(112, 'club_22', 'inst_2', 0),
(113, 'club_23', 'inst_2', 0),
(114, 'club_24', 'inst_2', 0),
(115, 'club_25', 'inst_2', 0),
(116, 'club_26', 'inst_2', 0),
(117, 'club_27', 'inst_2', 0),
(118, 'club_18', 'inst_2', 0),
(119, 'club_21', 'inst_2', 0),
(120, 'club_22', 'inst_2', 0),
(121, 'club_23', 'inst_2', 0),
(122, 'club_24', 'inst_2', 0),
(123, 'club_25', 'inst_2', 0),
(124, 'club_26', 'inst_2', 0),
(125, 'club_27', 'inst_2', 0);

-- --------------------------------------------------------

--
-- Table structure for table `inst_club_coordinator`
--

CREATE TABLE `inst_club_coordinator` (
  `sno` int(11) NOT NULL,
  `club_coordinator_id` varchar(20) NOT NULL,
  `institute_id` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email_id` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `phone_no` varchar(15) NOT NULL,
  `address` text NOT NULL,
  `photo` varchar(20) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL,
  `date_time` datetime NOT NULL,
  `detail` text NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inst_club_coordinator`
--

INSERT INTO `inst_club_coordinator` (`sno`, `club_coordinator_id`, `institute_id`, `name`, `email_id`, `dob`, `phone_no`, `address`, `photo`, `username`, `password`, `status`, `date_time`, `detail`, `role`) VALUES
(1, 'cc_1', 'INST_258', 'Kiran Nambiar', '', '0000-00-00', '123', '', 'dp.png', '', '', '', '0000-00-00 00:00:00', 'HAHAHAHHAA', 'president'),
(2, 'cc_2', 'INST_258', 'Kishor Nambiar', '', '0000-00-00', '456', '', 'dp.png', '', '', '', '0000-00-00 00:00:00', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut laboLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut laboLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut laboLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut laboLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut laboLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut laboLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut laboLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labo', 'coordinator'),
(3, 'cc_3', 'INST_258', 'Suraj', '', '0000-00-00', '789', '', 'dp.png', '', '', '', '0000-00-00 00:00:00', 'HAHAH', 'coordinator'),
(4, 'cc_4', 'INST_258', 'Ruhcita Phalak', '', '0000-00-00', '111', '', 'dp.png', '', '', '', '0000-00-00 00:00:00', 'HAHAH', 'bearer'),
(5, 'cc_5', 'INST_258', 'Mogambo', '', '0000-00-00', '222', '', 'dp.png', '', '', '', '0000-00-00 00:00:00', 'HAHAH', 'bearer'),
(6, 'cc_6', 'INST_258', 'KIshi Bhau', '', '0000-00-00', '333', '', 'dp.png', '', '', '', '0000-00-00 00:00:00', 'HAHAH', 'bearer');

-- --------------------------------------------------------

--
-- Table structure for table `inst_course_assign`
--

CREATE TABLE `inst_course_assign` (
  `sno` int(11) NOT NULL,
  `course_name` varchar(100) NOT NULL,
  `course_code` varchar(20) NOT NULL,
  `institute_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inst_course_assign`
--

INSERT INTO `inst_course_assign` (`sno`, `course_name`, `course_code`, `institute_id`) VALUES
(1, 'technology', 'technology', 'inst_1'),
(2, 'creativity', 'creativity', 'inst_1');

-- --------------------------------------------------------

--
-- Table structure for table `inst_user`
--

CREATE TABLE `inst_user` (
  `sno` int(11) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `institute_id` varchar(20) NOT NULL,
  `roll_no` varchar(15) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `phone_number` int(15) NOT NULL,
  `email_id` varchar(100) NOT NULL,
  `activated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deactivated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `photo` varchar(100) NOT NULL,
  `p_name` varchar(100) NOT NULL,
  `p_phone` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inst_user`
--

INSERT INTO `inst_user` (`sno`, `user_id`, `name`, `institute_id`, `roll_no`, `username`, `password`, `phone_number`, `email_id`, `activated_on`, `deactivated_on`, `photo`, `p_name`, `p_phone`) VALUES
(1, 'st_255_1', 'Kiran', 'INST_255', '', 'A8411976170', 'A84176', 0, '', '2019-02-21 12:35:54', '2019-02-21 12:35:54', '', 'Manoj', '8411976170'),
(2, 'st_255_2', 'Kishor', 'INST_255', '', 'B8411976170', 'B84120', 0, '', '2019-02-21 12:35:54', '2019-02-21 12:35:54', '', 'Manoj', '8411976170');

-- --------------------------------------------------------

--
-- Table structure for table `learning_video`
--

CREATE TABLE `learning_video` (
  `sno` int(11) NOT NULL,
  `club_id` varchar(20) NOT NULL,
  `video_id` varchar(20) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description_line` text NOT NULL,
  `description_detail` text NOT NULL,
  `duration` time NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `time_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `mrp_price` int(11) NOT NULL,
  `learning` text NOT NULL,
  `vendor_id` varchar(20) NOT NULL,
  `video_file` varchar(20) NOT NULL,
  `class_applicable_for` text NOT NULL,
  `subscription_level` varchar(20) NOT NULL,
  `school_price` int(11) NOT NULL,
  `link` varchar(100) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `topic_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `learning_video`
--

INSERT INTO `learning_video` (`sno`, `club_id`, `video_id`, `title`, `description_line`, `description_detail`, `duration`, `date_added`, `time_added`, `mrp_price`, `learning`, `vendor_id`, `video_file`, `class_applicable_for`, `subscription_level`, `school_price`, `link`, `status`, `topic_id`) VALUES
(1, 'club_web', 'vid_1', 'udpated', '<p>udpated</p>\r\n', '', '02:00:00', '2018-08-27 13:05:09', '2018-08-27 13:05:09', 5000, '<p>udpated</p>\r\n', 'inst_2', '', '6,7,8,9,10,11,12', 'platinum', 2000, 'asdad', 1, 'tp_4'),
(2, 'club_app', 'vid_2', 'abasd', '<p>asdasd</p>\r\n', '', '01:00:00', '2018-08-27 13:05:54', '2018-08-27 13:05:54', 234234, '<p>234asd</p>\r\n', 'inst_1', 'small.mp4', '', '', 0, '', 1, ''),
(3, 'club_maths', 'vid_3', 'a', '<p>a</p>\r\n', '', '00:00:01', '2018-08-27 13:06:57', '2018-08-27 13:06:57', 2344, '<p>a</p>\r\n', 'inst_1', 'a_56.mp4', '', '', 0, '', 1, ''),
(4, 'club_science', 'vid_4', 'ad', '<p>a</p>\r\n', '', '01:00:00', '2018-08-30 18:31:12', '2018-08-30 18:31:12', 234, '<p>a</p>\r\n', 'inst_1', '', '', '', 0, '', 1, ''),
(5, 'club_app', 'vid_5', 'q', '<p>q</p>\r\n', '', '01:00:00', '2018-08-30 18:36:17', '2018-08-30 18:36:17', 123, '<p>q</p>\r\n', 'inst_1', 'small.mp4', '', '', 0, '', 1, ''),
(6, 'club_web', 'vid_6', 'sd', '<p>sd</p>\r\n', '', '01:12:00', '2018-08-30 18:36:30', '2018-08-30 18:36:30', 1000, '<p>sd</p>\r\n', 'inst_1', 'small.mp4', '11,12', 'silver', 500, '', 1, ''),
(7, 'club_app', 'vid_7', 'video title updated', '<p>video description updated</p>\r\n', '', '01:00:00', '2018-09-03 12:51:22', '2018-09-03 12:51:22', 1234, '<p>video updated</p>\r\n', 'inst_1', '', '', '', 0, 'https://www.youtube.com/embed/YE7VzlLtp-4', 1, ''),
(8, 'club_app', 'vid_8', 'demo 1', '<p>demo 1</p>\r\n', '', '02:45:00', '2018-09-05 11:33:28', '2018-09-05 11:33:28', 100, '<p>demo 1</p>\r\n', 'inst_1', '', '', '', 0, 'https://www.youtube.com/embed/YE7VzlLtp-4', 1, ''),
(9, 'club_app', 'vid_9', 'demo 2', '<p>demo</p>\r\n', '', '01:00:00', '2018-09-05 11:34:02', '2018-09-05 11:34:02', 123, '<p>demo</p>\r\n', 'inst_2', 'small.mp4', '', '', 0, '', 1, ''),
(10, 'club_web', 'vid_10', 'testvideo', '<p>testvideo</p>\r\n', '', '01:00:00', '2018-09-11 17:58:09', '2018-09-11 17:58:09', 123, '<p>testvideo</p>\r\n', 'inst_3', '', '6,7,8,9,10,11,12', 'platinum', 0, 'https://www.youtube.com/embed/YE7VzlLtp-4', 0, ''),
(25, 'club_web', 'vid_25', 'DEMO1', '<p>DEMO1</p>\r\n', '', '02:30:00', '2018-09-24 12:34:16', '2018-09-24 12:34:16', 123, '<p>DEMO1</p>\r\n', 'inst_1', '', '11,12', 'gold', 456, 'https://www.youtube.com/embed/YE7VzlLtp-4', 0, ''),
(26, 'club_web', 'vid_26', 'DEMO2', '<p>DEMO1</p>\r\n', '', '02:30:00', '2018-09-24 12:35:07', '2018-09-24 12:35:07', 123, '<p>DEMO1</p>\r\n', 'inst_1', 'small.mp4', '11,12', 'gold', 456, '', 0, ''),
(27, 'club_web', 'vid_27', 'asd', '<p>asd</p>\r\n', '', '01:00:00', '2018-09-26 11:33:09', '2018-09-26 11:33:09', 123, '<p>asd</p>\r\n', 'inst_1', '', '12', 'gold', 12, 'asd', 0, ''),
(28, 'club_web', 'vid_28', 'asda12', '<p>asd</p>\r\n', '', '01:00:00', '2018-09-26 11:33:46', '2018-09-26 11:33:46', 2134, '<p>asd</p>\r\n', 'inst_1', '', '11,12', 'gold', 234, 'asd', 0, ''),
(29, 'club_web', 'vid_29', 'asda12asd', '<p>asd</p>\r\n', '', '01:00:00', '2018-09-26 11:33:57', '2018-09-26 11:33:57', 2134, '<p>asd</p>\r\n', 'inst_1', '', '11,12', 'gold', 234, 'asd', 0, ''),
(30, 'club_web', 'vid_30', 'asd123123', '<p>asd</p>\r\n', '', '01:00:00', '2018-09-26 12:30:46', '2018-09-26 12:30:46', 234, '<p>asd</p>\r\n', 'inst_1', '', '11', 'gold', 234, 'asd', 0, ''),
(31, 'club_web', 'vid_31', 'asd123123asd', '<p>asd</p>\r\n', '', '01:00:00', '2018-09-26 12:31:15', '2018-09-26 12:31:15', 234, '<p>asd</p>\r\n', 'inst_1', '', '11', 'gold', 234, 'asd', 0, ''),
(32, 'club_web', 'vid_32', 'asd65', '<p>asd</p>\r\n', '', '01:00:00', '2018-09-26 12:32:54', '2018-09-26 12:32:54', 123, '<p>asd</p>\r\n', 'inst_1', '', '11', 'gold', 123, 'asd', 0, ''),
(33, 'club_web', 'vid_33', 'asd6523', '<p>asd</p>\r\n', '', '01:00:00', '2018-09-26 12:35:47', '2018-09-26 12:35:47', 123, '<p>asd</p>\r\n', 'inst_1', '', '11', 'gold', 123, 'asd', 0, ''),
(34, 'club_web', 'vid_34', 'asd476675', '<p>asdasd</p>\r\n', '', '22:22:33', '2018-09-26 12:36:14', '2018-09-26 12:36:14', 234, '<p>asd</p>\r\n', 'inst_1', '', '12', 'gold', 234, 'asd', 0, ''),
(35, 'club_web', 'vid_35', 'asda3242', '<p>asd</p>\r\n', '', '01:00:00', '2018-09-26 12:36:41', '2018-09-26 12:36:41', 234, '<p>asd</p>\r\n', 'inst_1', '', '11', 'platinum', 234, 'asd', 0, ''),
(36, 'club_web', 'vid_36', 'asdasdasddd', '<p>asdasdasd</p>\r\n', '', '01:00:00', '2018-09-26 12:37:45', '2018-09-26 12:37:45', 123, '<p>asd</p>\r\n', 'inst_1', '', '11', 'gold', 123, 'asd', 0, ''),
(37, 'club_web', 'vid_37', 'asd23rfwe', '<p>sdf</p>\r\n', '', '01:00:00', '2018-09-26 12:40:57', '2018-09-26 12:40:57', 43, '<p>asd</p>\r\n', 'inst_1', '', '11', 'platinum', 234, 'asd', 0, ''),
(38, 'club_web', 'vid_38', 'asd23ed3', '<p>asd</p>\r\n', '', '01:00:00', '2018-09-26 12:43:28', '2018-09-26 12:43:28', 234, '<p>asd</p>\r\n', 'inst_1', '', '11', 'platinum', 234, 'asd', 0, ''),
(39, 'club_web', 'vid_39', 'asdasdasd32', '<p>asd</p>\r\n', '', '01:00:00', '2018-09-26 12:45:11', '2018-09-26 12:45:11', 234, '<p>asd</p>\r\n', 'inst_1', '', '11', 'platinum', 234, 'asda', 0, ''),
(40, 'club_web', 'vid_40', 'asdasdasd32asd', '<p>asd</p>\r\n', '', '01:00:00', '2018-08-14 12:45:58', '2018-09-26 12:45:58', 234, '<p>asd</p>\r\n', 'inst_1', '', '11', 'platinum', 234, 'asda', 1, ''),
(41, 'club_web', 'vid_41', 'IOT video 6', 'Tech Channel India', '', '01:00:00', '2018-09-20 12:46:18', '2018-09-26 12:46:18', 234, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis fermentum vel justo id faucibus. Praesent congue est odio, et vestibulum ex mollis et. Sed eu augue tempor, iaculis dolor ut, lobortis odio. Suspendisse consectetur tristique mi at aliquet. Etiam auctor suscipit sapien, sed sodales mi accumsan dignissim. Duis dapibus vehicula lacus quis volutpat. Nulla consectetur ut mi sit amet feugiat. In hac habitasse platea dictumst. In venenatis, quam sed pretium rutrum, odio est efficitur purus, et ornare massa nulla quis enim. Suspendisse eget venenatis nunc, ac dapibus lectus. Duis quis ligula nulla. Duis malesuada metus et accumsan venenatis. Sed porttitor diam sed eros fermentum, a dignissim purus porta. Morbi ullamcorper magna in ipsum volutpat suscipit. In laoreet sapien sem, ac condimentum diam tempus nec. Cras consectetur arcu vitae magna placerat maximus.</p>', 'inst_1', '', '11', 'platinum', 234, 'asda', 1, 'tp_2'),
(42, 'club_web', 'vid_42', 'IOT video 5', 'Tech Guy', '', '01:01:11', '2018-09-23 00:00:00', '2018-09-26 12:47:18', 234, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis fermentum vel justo id faucibus. Praesent congue est odio, et vestibulum ex mollis et. Sed eu augue tempor, iaculis dolor ut, lobortis odio. Suspendisse consectetur tristique mi at aliquet. Etiam auctor suscipit sapien, sed sodales mi accumsan dignissim. Duis dapibus vehicula lacus quis volutpat. Nulla consectetur ut mi sit amet feugiat. In hac habitasse platea dictumst. In venenatis, quam sed pretium rutrum, odio est efficitur purus, et ornare massa nulla quis enim. Suspendisse eget venenatis nunc, ac dapibus lectus. Duis quis ligula nulla. Duis malesuada metus et accumsan venenatis. Sed porttitor diam sed eros fermentum, a dignissim purus porta. Morbi ullamcorper magna in ipsum volutpat suscipit. In laoreet sapien sem, ac condimentum diam tempus nec. Cras consectetur arcu vitae magna placerat maximus.</p>', 'inst_1', '', '11', 'platinum', 234, 'https://www.youtube.com/embed/KhzGSHNhnbI', 1, 'tp_2'),
(43, 'club_web', 'vid_43', 'IOT video 4', 'Traversy Media', '', '00:09:56', '2018-09-24 00:00:00', '2018-09-26 12:47:54', 234, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis fermentum vel justo id faucibus. Praesent congue est odio, et vestibulum ex mollis et. Sed eu augue tempor, iaculis dolor ut, lobortis odio. Suspendisse consectetur tristique mi at aliquet. Etiam auctor suscipit sapien, sed sodales mi accumsan dignissim. Duis dapibus vehicula lacus quis volutpat. Nulla consectetur ut mi sit amet feugiat. In hac habitasse platea dictumst. In venenatis, quam sed pretium rutrum, odio est efficitur purus, et ornare massa nulla quis enim. Suspendisse eget venenatis nunc, ac dapibus lectus. Duis quis ligula nulla. Duis malesuada metus et accumsan venenatis. Sed porttitor diam sed eros fermentum, a dignissim purus porta. Morbi ullamcorper magna in ipsum volutpat suscipit. In laoreet sapien sem, ac condimentum diam tempus nec. Cras consectetur arcu vitae magna placerat maximus.</p>', 'inst_1', '', '11', 'platinum', 123, 'https://www.youtube.com/embed/YE7VzlLtp-4', 1, 'tp_2'),
(44, 'club_web', 'vid_44', 'IOT video 3', 'Marques Brownlee', '', '00:00:05', '2018-09-25 00:00:00', '2018-09-26 12:49:09', 234, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis fermentum vel justo id faucibus. Praesent congue est odio, et vestibulum ex mollis et. Sed eu augue tempor, iaculis dolor ut, lobortis odio. Suspendisse consectetur tristique mi at aliquet. Etiam auctor suscipit sapien, sed sodales mi accumsan dignissim. Duis dapibus vehicula lacus quis volutpat. Nulla consectetur ut mi sit amet feugiat. In hac habitasse platea dictumst. In venenatis, quam sed pretium rutrum, odio est efficitur purus, et ornare massa nulla quis enim. Suspendisse eget venenatis nunc, ac dapibus lectus. Duis quis ligula nulla. Duis malesuada metus et accumsan venenatis. Sed porttitor diam sed eros fermentum, a dignissim purus porta. Morbi ullamcorper magna in ipsum volutpat suscipit. In laoreet sapien sem, ac condimentum diam tempus nec. Cras consectetur arcu vitae magna placerat maximus.</p>', 'inst_1', 'small.mp4', '12', 'gold', 234, '', 1, 'tp_2'),
(45, 'club_web', 'vid_45', 'IOT video 2', '<p>Casey Neistat</p>\r\n', '', '00:09:56', '2018-09-26 12:49:31', '2018-09-26 12:49:31', 123, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis fermentum vel justo id faucibus. Praesent congue est odio, et vestibulum ex mollis et. Sed eu augue tempor, iaculis dolor ut, lobortis odio. Suspendisse consectetur tristique mi at aliquet. Etiam auctor suscipit sapien, sed sodales mi accumsan dignissim. Duis dapibus vehicula lacus quis volutpat. Nulla consectetur ut mi sit amet feugiat. In hac habitasse platea dictumst. In venenatis, quam sed pretium rutrum, odio est efficitur purus, et ornare massa nulla quis enim. Suspendisse eget venenatis nunc, ac dapibus lectus. Duis quis ligula nulla. Duis malesuada metus et accumsan venenatis. Sed porttitor diam sed eros fermentum, a dignissim purus porta. Morbi ullamcorper magna in ipsum volutpat suscipit. In laoreet sapien sem, ac condimentum diam tempus nec. Cras consectetur arcu vitae magna placerat maximus.</p>\r\n', 'inst_1', '', '10', 'gold', 123, 'https://www.youtube.com/embed/YE7VzlLtp-4', 1, 'tp_2'),
(46, 'club_web', 'vid_46', 'IOT video 1', 'Linus tech Tips', '', '00:00:05', '2018-10-11 11:53:57', '2018-10-11 11:53:57', 1500, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis fermentum vel justo id faucibus. Praesent congue est odio, et vestibulum ex mollis et. Sed eu augue tempor, iaculis dolor ut, lobortis odio. Suspendisse consectetur tristique mi at aliquet. Etiam auctor suscipit sapien, sed sodales mi accumsan dignissim. Duis dapibus vehicula lacus quis volutpat. Nulla consectetur ut mi sit amet feugiat. In hac habitasse platea dictumst. In venenatis, quam sed pretium rutrum, odio est efficitur purus, et ornare massa nulla quis enim. Suspendisse eget venenatis nunc, ac dapibus lectus. Duis quis ligula nulla. Duis malesuada metus et accumsan venenatis. Sed porttitor diam sed eros fermentum, a dignissim purus porta. Morbi ullamcorper magna in ipsum volutpat suscipit. In laoreet sapien sem, ac condimentum diam tempus nec. Cras consectetur arcu vitae magna placerat maximus.</p>', 'inst_1', '', '7,8,9,10', 'gold', 1000, 'https://www.youtube.com/embed/KhzGSHNhnbI', 1, 'tp_2'),
(47, 'club_web', 'vid_47', 'testingoct23', '<p>testingoct23</p>\r\n', '', '01:30:00', '2018-10-23 16:17:07', '2018-10-23 16:17:07', 100, '<p>testingoct23</p>\r\n', 'inst_2', 'linkk', '6,7', 'gold', 200, 'linked', 5, 'tp_4'),
(48, 'club_web', '', 'demo learning viodeo', '<p>demo learning viodeo</p>\r\n', '', '01:00:00', '2018-10-26 12:47:10', '2018-10-26 12:47:10', 100, '<p>demo learning viodeo</p>\r\n', 'inst_1', '091710am28.mp4', '10', 'silver', 100, NULL, 0, 'tp_4'),
(49, 'club_web', 'vid_49', 'learning vide 2', '<p>demo learning viodeo</p>\r\n', '', '01:00:00', '2018-10-26 12:49:27', '2018-10-26 12:49:27', 10, '<p>demo learning viodeo</p>\r\n', 'inst_4', '', '6', 'silver', 10, 'asdasd', 0, 'tp_4');

-- --------------------------------------------------------

--
-- Table structure for table `live_course`
--

CREATE TABLE `live_course` (
  `sno` int(11) NOT NULL,
  `club_id` varchar(20) NOT NULL,
  `course_id` varchar(20) NOT NULL,
  `description_line` text NOT NULL,
  `no_of_classes` int(11) NOT NULL,
  `mrp_price` int(11) NOT NULL,
  `class_applicable_for` text NOT NULL,
  `subscription_level` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `primary_image` varchar(100) NOT NULL,
  `secondary_image` varchar(100) NOT NULL,
  `course_icon` varchar(100) NOT NULL,
  `time_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `learning` text NOT NULL,
  `prerequisites` text NOT NULL,
  `vendor_id` varchar(20) NOT NULL,
  `duration` int(11) NOT NULL,
  `school_price` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `topic_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `live_course`
--

INSERT INTO `live_course` (`sno`, `club_id`, `course_id`, `description_line`, `no_of_classes`, `mrp_price`, `class_applicable_for`, `subscription_level`, `description`, `primary_image`, `secondary_image`, `course_icon`, `time_added`, `date_added`, `learning`, `prerequisites`, `vendor_id`, `duration`, `school_price`, `status`, `topic_id`) VALUES
(2, 'club_web', 'course_1', 'asd', 23, 2323, 'sdaa', '12', 'dfasd', '', '', '', '2018-08-31 10:50:00', '2018-08-31 10:50:00', '', '', 'inst_6', 0, 0, 0, 'tp_2'),
(3, 'club_web', 'asd', 'asdas', 23, 2323, 'sdaaas', '12', 'dfasd', '', '', '', '2018-08-31 10:50:00', '2018-08-31 10:50:00', '', '', 'inst_6', 0, 0, 0, 'tp_2'),
(4, 'club_web', 'asd', 'asd', 23, 2323, 'sdaa', '12', 'dfasd', '', '', '', '2018-08-31 10:50:00', '2018-08-31 10:50:00', '', '', 'inst_6', 0, 0, 0, ''),
(5, 'club_web', 'course_5', 'udpated', 0, 5000, '6,7,8,9,10,11,12', 'platinum', '<p>udpated</p>\r\n', 'a.png', 'b.png', 'c.png', '2018-09-03 19:07:19', '2018-09-03 19:07:19', '<p>udpated</p>\r\n', '', 'inst_2', 1, 2000, 1, 'tp_5'),
(6, 'club_app', 'course_6', 'demo', 0, 123, '', '', '<p>demo</p>\r\n', '113320am75.jpg', '113320am48.jpg', '113320am710.jpg', '2018-09-06 15:03:20', '2018-09-06 15:03:20', '<p>demo</p>\r\n', '', 'inst_1', 0, 0, 0, ''),
(7, 'club_app', 'course_7', 'demoa', 0, 123, '', '', '<p>demo</p>\r\n', '113837am102.jpg', '113837am102.jpg', '113837am38.jpg', '2018-09-06 15:08:37', '2018-09-06 15:08:37', '<p>demo</p>\r\n', '', 'inst_1', 0, 0, 0, ''),
(8, 'club_app', 'course_8', 'asas', 0, 123, '', '', '<p>asas</p>\r\n', '', '', '', '2018-09-06 15:10:13', '2018-09-06 15:10:13', '<p>asas</p>\r\n', '', 'inst_1', 0, 0, 0, ''),
(9, 'club_app', 'course_9', 'asassd', 0, 123, '', '', '<p>asas</p>\r\n', '114030am38.jpg', '114030am02.jpg', '114030am63.jpg', '2018-09-06 15:10:30', '2018-09-06 15:10:30', '<p>asas</p>\r\n', '', 'inst_1', 0, 0, 0, ''),
(10, 'club_app', 'course_10', 'asassdas', 0, 123, '6,7,8,9,10,11,12', 'platinum', '<p>asas</p>\r\n', 'a.jpg', 'b.jpg', 'c.jpg', '2018-09-06 15:11:19', '2018-09-06 15:11:19', '<p>asas</p>\r\n', '', 'inst_1', 3, 0, 0, ''),
(11, 'club_app', 'course_11', 'asassdasa', 0, 123, '', '', '<p>asas</p>\r\n', '', '114131am1010.jpg', '114131am57.jpg', '2018-09-06 15:11:31', '2018-09-06 15:11:31', '<p>asas</p>\r\n', '', 'inst_1', 0, 0, 0, ''),
(12, 'club_web', 'course_12', 'asd123', 0, 12, '11', 'gold', '<p>asd</p>\r\n', '', '', '', '2018-09-26 11:20:34', '2018-09-26 11:20:34', '<p>asd</p>\r\n', '', 'inst_1', 22, 12, 0, ''),
(13, 'club_web', 'course_13', 'asdqwd34ed', 0, 123, '11', 'gold', '<p>asd</p>\r\n', '', '', '', '2018-09-26 14:53:52', '2018-09-26 14:53:52', '<p>asd</p>\r\n', '', 'inst_1', 22, 123, 0, ''),
(14, 'club_web', 'course_14', 'testingoct11', 0, 1234, '6,7,8', 'gold', '<p>testingoct11desc</p>\r\n', '074829am06.png', '074829am66.png', '074829am51.png', '2018-10-11 11:17:20', '2018-10-11 11:17:20', '<ul>\r\n	<li><strong>testingoct11what will I</strong></li>\r\n</ul>\r\n', '', 'inst_1', 10, 4567, 1, ''),
(15, 'club_web', 'course_15', 'testingoct1112', 0, 1000, '8,9', 'gold', '<p>testingoct11</p>\r\n', '081450am08.png', '081450am210.png', '081450am106.png', '2018-10-11 11:44:25', '2018-10-11 11:44:25', '<p>testingoct11</p>\r\n', '', 'inst_1', 2, 800, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `online_test`
--

CREATE TABLE `online_test` (
  `sno` int(11) NOT NULL,
  `club_id` varchar(20) NOT NULL,
  `test_id` varchar(20) NOT NULL,
  `institute_id` varchar(20) NOT NULL,
  `test_type` varchar(20) NOT NULL,
  `test_name` varchar(100) NOT NULL,
  `test_creator` varchar(100) NOT NULL,
  `publish_state` tinyint(1) NOT NULL,
  `time_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `display_type` varchar(20) NOT NULL,
  `duration` time NOT NULL,
  `no_of_ques` int(11) NOT NULL,
  `total_marks` int(11) NOT NULL,
  `feedback_ranges` text NOT NULL,
  `vendor_id` varchar(20) DEFAULT NULL,
  `test_data` text NOT NULL,
  `mrp_price` int(11) NOT NULL,
  `class_applicable_for` text NOT NULL,
  `subscription_level` varchar(20) NOT NULL,
  `school_price` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `topic_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `online_test`
--

INSERT INTO `online_test` (`sno`, `club_id`, `test_id`, `institute_id`, `test_type`, `test_name`, `test_creator`, `publish_state`, `time_added`, `date_added`, `display_type`, `duration`, `no_of_ques`, `total_marks`, `feedback_ranges`, `vendor_id`, `test_data`, `mrp_price`, `class_applicable_for`, `subscription_level`, `school_price`, `status`, `topic_id`) VALUES
(17, 'club_app', 'asd', 'asd', 'asd', 'asd', '', 0, '2018-08-30 17:04:12', '2018-08-30 17:04:12', '', '00:00:00', 0, 0, '', NULL, '', 0, '', '', 0, 1, ''),
(18, 'club_app', 'test_3', '', '', 'test title update 1', 'test creator update 1', 0, '2018-08-30 18:27:19', '2018-08-30 18:27:19', '', '02:45:00', 0, 0, '', 'inst_1', 'test description update 1', 1500, '', '', 200, 0, ''),
(19, 'club_app', 'test_19', '', '', 'udpated', 'udpated', 0, '2018-09-03 12:47:23', '2018-09-03 12:47:23', '', '02:00:00', 0, 0, '', 'inst_3', '<p>udpated</p>\r\n', 5000, '6,7,8,9,10,11,12', 'platinum', 2000, 1, 'tp_5'),
(20, 'club_app', 'test_20', '', '', 'testtest', 'testtest', 0, '2018-09-11 17:49:29', '2018-09-11 17:49:29', '', '22:22:00', 0, 0, '', 'inst_2', '<p>testtest</p>\r\n', 123, '6,7,8,9,10,11', 'platinum', 0, 0, ''),
(21, 'club_app', 'test_21', '', '', 'asd123', 'demo', 0, '2018-09-26 11:24:50', '2018-09-26 11:24:50', '', '01:00:00', 0, 0, '', 'inst_1', '<p>asd</p>\r\n', 234, '11', 'gold', 234, 0, ''),
(23, 'club_app', 'test_23', '', '', 'testingoct11', 'kiran', 0, '2018-10-11 11:46:26', '2018-10-11 11:46:26', '', '01:20:00', 0, 0, '', 'inst_1', '<p>testingoct11desc</p>\r\n', 1000, '9,10', 'platinum', 500, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE `quiz` (
  `sno` int(11) NOT NULL,
  `quiz_title` varchar(100) NOT NULL,
  `quiz_id` varchar(20) NOT NULL,
  `club_id` varchar(20) NOT NULL,
  `institute_id` varchar(20) NOT NULL,
  `vendor_id` varchar(20) NOT NULL,
  `quiz_creator` varchar(100) NOT NULL,
  `time_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `no_of_questions` int(11) NOT NULL,
  `mrp_price` int(11) NOT NULL,
  `school_price` int(11) NOT NULL,
  `class_applicable_for` text NOT NULL,
  `subscription_level` varchar(20) NOT NULL,
  `status` int(11) NOT NULL,
  `link` text NOT NULL,
  `quiz_details` text NOT NULL,
  `topic_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quiz`
--

INSERT INTO `quiz` (`sno`, `quiz_title`, `quiz_id`, `club_id`, `institute_id`, `vendor_id`, `quiz_creator`, `time_added`, `date_added`, `no_of_questions`, `mrp_price`, `school_price`, `class_applicable_for`, `subscription_level`, `status`, `link`, `quiz_details`, `topic_id`) VALUES
(1, 'Quiz One Updated', 'quiz_1', 'club_21', 'INST_258', 'inst_3', 'Kiran Nambiar 2', '2018-10-12 12:40:59', '2018-10-12 12:40:59', 12, 1500, 600, '6,7,8,9,10,11,12', 'silver', 1, '<div class=\"apester-media\" data-media-id=\"5bc6f8d0c17e5d5ac32b4753\" height=\"720\"></div><script async src=\"https://static.apester.com/js/sdk/latest/apester-sdk.js\"></script>', '<p>blah blah blah .... BLAAAHH&nbsp; sasd</p>\r\n', 'tp_92'),
(2, 'Quiz Two', 'quiz_2', 'club_web', 'inst_1', 'inst_2', 'Kishor Nmabiar', '2018-10-12 12:57:55', '2018-10-12 12:57:55', 15, 1500, 700, '6,7,8,9', 'gold', 1, '<div class=\"apester-media\" data-media-id=\"5bc6ef89c17e5d58fc2b4741\" height=\"388\"></div><script async src=\"https://static.apester.com/js/sdk/latest/apester-sdk.js\"></script>', '<p><em><strong>B:LEH BLEH</strong></em></p>\r\n', 'tp_2');

-- --------------------------------------------------------

--
-- Table structure for table `sales_comments`
--

CREATE TABLE `sales_comments` (
  `sno` int(11) NOT NULL,
  `id` varchar(10) NOT NULL,
  `type` varchar(10) NOT NULL,
  `comment` text NOT NULL,
  `datetime` datetime NOT NULL,
  `action` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales_comments`
--

INSERT INTO `sales_comments` (`sno`, `id`, `type`, `comment`, `datetime`, `action`) VALUES
(8, '3', 'inc_school', 'Call Remark: no_connect<br> Comment: HELLO', '2019-02-12 12:37:15', 'call_now'),
(9, '3', 'webinar', 'WHAT', '2019-02-12 12:37:21', 'comment'),
(10, '3', 'inc_school', 'hjbjh', '2019-02-12 12:37:25', 'comment'),
(11, '3', 'webinar', 'Call Remark: no_connect<br> Comment: sd', '2019-02-12 12:41:10', 'call_now'),
(12, '2', 'webinar', 'Call Remark: no_connect<br> Comment: adad', '2019-02-12 12:41:21', 'call_now'),
(13, '2', 'webinar', 'Call Scheduled On: 2019-02-07<br>Comment: HELLO', '2019-02-12 12:41:31', 'call_later'),
(14, '2', 'webinar', 'Call Remark: no_connect<br> Comment: fvygh', '2019-02-12 12:43:21', 'call_now'),
(15, '2', 'webinar', 'Call Scheduled On: 2019-02-08<br>Comment: Call in the evening', '2019-02-12 12:43:38', 'call_later'),
(16, '2', 'webinar', 'Call Remark: no_connect<br> Comment: ghbjnkm', '2019-02-12 12:44:20', 'call_now'),
(17, '2', 'webinar', 'gvbhjnkm', '2019-02-12 12:44:23', 'comment'),
(18, '4', 'inc_school', 'Call Scheduled On: 2019-02-12<br>Comment: I will call', '2019-02-12 12:45:21', 'call_later'),
(19, '4', 'webinar', 'Call Remark: no_connect<br> Comment: Maybe Wrong No', '2019-02-12 12:45:43', 'call_now'),
(20, '4', 'inc_school', 'Deal CLosed', '2019-02-12 12:45:54', 'comment'),
(21, '5', 'webinar', 'Call Remark: Positive<br> Comment: All Good', '2019-02-12 12:49:01', 'call_now'),
(22, '5', 'inc_school', 'Call Scheduled On: 2019-02-13<br>Comment: Need to Call Again', '2019-02-12 12:49:12', 'call_later'),
(23, '5', 'inc_school', 'All Good Deal CLosed', '2019-02-12 12:49:25', 'comment'),
(24, '1', 'webinar', 'Call Scheduled On: 2019-02-01<br>Comment: Something', '2019-02-12 12:52:23', 'call_later'),
(25, '1', 'webinar', 'Call Remark: Positive<br> Comment: Deal Going Good', '2019-02-12 12:54:20', 'call_now'),
(26, '1', 'webinar', 'Call Scheduled On: 2019-02-13<br>Comment: Something', '2019-02-12 12:54:28', 'call_later'),
(27, '1', 'webinar', 'LALAL', '2019-02-12 12:54:41', 'comment'),
(28, '2', 'comp', 'Call Remark: Positive<br> Comment: DONE', '2019-02-19 10:35:22', 'call_now'),
(29, '2', 'comp', 'Call Remark: Positive<br> Comment: ', '2019-02-19 10:58:07', 'call_now'),
(30, '2', 'comp', 'Call Scheduled On: 2019-02-20<br>Comment: WIll call soon', '2019-02-19 11:55:07', 'call_later'),
(31, 'INST_285', 'comp', 'Call Scheduled On: 2019-02-20<br>Comment: ', '2019-03-14 12:02:20', 'call_later'),
(32, 'INST_285', 'comp', 'Call Scheduled On: 2019-02-20<br>Comment: ', '2019-03-15 12:02:20', 'call_now'),
(33, '4', 'comp', 'Call Remark: Positive<br> Comment: as', '2019-02-21 09:54:42', 'call_now'),
(34, '4', 'comp', 'Call Scheduled On: 2019-02-01<br>Comment: as', '2019-02-21 09:55:11', 'call_later');

-- --------------------------------------------------------

--
-- Table structure for table `sample_work`
--

CREATE TABLE `sample_work` (
  `sno` int(11) NOT NULL,
  `club_id` varchar(20) NOT NULL,
  `sample_work_id` varchar(20) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description_line` text NOT NULL,
  `description_detail` text NOT NULL,
  `duration` time NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `time_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `mrp_price` int(11) NOT NULL,
  `learning` text NOT NULL,
  `vendor_id` varchar(20) NOT NULL,
  `video_file` varchar(20) NOT NULL,
  `class_applicable_for` text NOT NULL,
  `subscription_level` varchar(20) NOT NULL,
  `school_price` int(11) NOT NULL,
  `link` varchar(100) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `topic_id` varchar(20) NOT NULL,
  `image` varchar(20) NOT NULL,
  `media_type` varchar(20) NOT NULL,
  `last_date` date NOT NULL,
  `pdf` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sample_work`
--

INSERT INTO `sample_work` (`sno`, `club_id`, `sample_work_id`, `title`, `description_line`, `description_detail`, `duration`, `date_added`, `time_added`, `mrp_price`, `learning`, `vendor_id`, `video_file`, `class_applicable_for`, `subscription_level`, `school_price`, `link`, `status`, `topic_id`, `image`, `media_type`, `last_date`, `pdf`) VALUES
(1, 'club_app', 's_work_1', 'Sample Work 2', '<p>This activity will need skill1, skill2, skill4 and commitment and lots of enthusiasm lorem ipsum dolor comet asteriod kuiper belt mars saturn jupiter neptune uranus and oh please pluto too !</p>\r\n', '', '00:09:56', '2018-10-27 16:27:34', '2018-10-27 16:27:34', 1, '<p>test</p>\r\n', 'inst_1', '', '6', 'silver', 1, 'https://www.youtube.com/embed/YE7VzlLtp-4', 1, 'tp_2', '', 'link', '2018-10-30', ''),
(2, 'club_app', 's_work_2', 'Sample Work 1', '<p>This activity will need skill1, skill2, skill4 and commitment and lots of enthusiasm lorem ipsum dolor comet asteriod kuiper belt mars saturn jupiter neptune uranus and oh please pluto too !</p>\r\n', '', '00:09:56', '2018-10-27 16:30:29', '2018-10-27 16:30:29', 1, '<p>test</p>\r\n', 'inst_1', '', '6', 'silver', 1, 'https://www.youtube.com/embed/YE7VzlLtp-4', 1, 'tp_2', '015239pm210.jpg', 'pdf', '2018-10-31', '012549pm00.pdf'),
(3, 'club_web', 's_work_3', 'Make an awesome Origami !', '<p>cjuh&nbsp; hih ihi hiuhouhoiujo uh iluh iuh iulh ioulh iul h;uoh liuh liukh uyjg bukyhg bukhjg bhkjb hjb hjlh nikj hnjlkh nlkj h</p>\r\n', '', '01:30:00', '2018-10-29 18:00:42', '2018-10-29 18:00:42', 1000, '<p>h hhhghhg</p>\r\n', 'inst_1', '014920pm14.jpg', '8', 'gold', 1000, 'lnlnlk', 1, 'tp_3', '015239pm210.jpg', 'image', '2018-10-31', ''),
(4, 'club_web', 's_work_4', 'PDF SAmple Work', '<p>PDF SAmple Work</p>\r\n', '', '00:30:00', '2018-10-31 17:55:49', '2018-10-31 17:55:49', 1000, '<p>PDF SAmple Work</p>\r\n', 'inst_1', '', '8', 'gold', 1000, NULL, 1, 'tp_3', '', 'pdf', '2018-11-28', '012549pm00.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `sample_work_submission`
--

CREATE TABLE `sample_work_submission` (
  `sno` int(11) NOT NULL,
  `submission_id` varchar(20) NOT NULL,
  `club_id` varchar(20) NOT NULL,
  `student_id` varchar(20) NOT NULL,
  `inst_id` varchar(20) NOT NULL,
  `sample_work_id` varchar(20) NOT NULL,
  `file` varchar(20) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `featured` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sample_work_submission`
--

INSERT INTO `sample_work_submission` (`sno`, `submission_id`, `club_id`, `student_id`, `inst_id`, `sample_work_id`, `file`, `date_time`, `featured`) VALUES
(1, 'sub_1', 'club_app', 'st_258_2', 'INST_258', 's_work_1', 'www.google.com', '2018-12-12 08:12:57', 1),
(3, 'sub_2', 'club_app', 'student_2', 'INST_258', 's_work_1', 'www.google.com', '2018-11-20 05:53:43', 1),
(4, 'subm_4', 'club_web', 'st_258_2', 'INST_258', 's_work_3', '103951am57.jpeg', '2018-11-20 05:53:30', 1),
(5, 'subm_5', 'club_web', 'st_258_2', 'INST_258', 's_work_2', '121827pm99.jpeg', '2018-11-19 11:50:51', 0),
(6, 'sub_5', 'club_app', 'st_258_2', 'INST_258', 's_work_1', 'www.google.com', '2018-11-20 05:53:26', 0),
(7, 'subm_7', 'club_app', 'student_2', 'INST_258', 's_work_1', '090509am67.png', '2018-12-12 08:05:09', 0);

-- --------------------------------------------------------

--
-- Table structure for table `school__activities`
--

CREATE TABLE `school__activities` (
  `sno` int(11) NOT NULL,
  `activity_id` varchar(20) NOT NULL,
  `page_name` varchar(100) NOT NULL,
  `activities_description` text NOT NULL,
  `icon` varchar(20) NOT NULL,
  `activity_name` varchar(100) NOT NULL,
  `deploy_id` varchar(20) NOT NULL,
  `institute_id` varchar(20) NOT NULL,
  `class` text NOT NULL,
  `gender` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `school__activities`
--

INSERT INTO `school__activities` (`sno`, `activity_id`, `page_name`, `activities_description`, `icon`, `activity_name`, `deploy_id`, `institute_id`, `class`, `gender`) VALUES
(1, 'act1', 'webinar.php', 'Webinar', 'webinar.png', 'webinar', '', '', '', '0'),
(2, 'act2', 'article.php', 'articles', 'article.png', 'article', '', '', '', '0'),
(3, 'act3', 'course.php', 'sdf', 'article.png', 'live_course', '', '', '', '0'),
(4, 'act4', 'online_test.php', 'sdf', 'webinar.png', 'online_test', '', '', '', '0'),
(5, 'act5', 'ebook.php', 'upload ebooks for each  activity', 'ebook.png', 'ebook', '', '', '', '0'),
(6, 'act6', 'video.php', 'upload ebooks for each  activity', 'ebook.png', 'video', '', '', '', '0'),
(7, 'act7', 'workshop.php', 'upload ebooks for each  activity', 'ebook.png', 'workshop', '', '', '', '0'),
(8, 'act8', 'quiz.php', 'Apester Quiz', 'quiz.png', 'quiz', '', '', '', '0'),
(9, 'act9', 'learning_video.php', 'Learning Video', 'quiz.png', 'Learning Video', '', '', '', '0'),
(10, 'act10', 'sample_work.php', 'Sample Work ', 's_work.png', 'Sample Work', '', '', '', '0');

-- --------------------------------------------------------

--
-- Table structure for table `school__article`
--

CREATE TABLE `school__article` (
  `sno` int(11) NOT NULL,
  `club_id` varchar(20) DEFAULT NULL,
  `article_id` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `author` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `date_posted` date NOT NULL,
  `publish_state` tinyint(1) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `time_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `vendor_id` varchar(20) DEFAULT NULL,
  `duration` time NOT NULL,
  `link` text NOT NULL,
  `mrp_price` int(11) NOT NULL,
  `class_applicable_for` text NOT NULL,
  `subscription_level` varchar(20) NOT NULL,
  `school_price` int(11) NOT NULL,
  `icon` varchar(20) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `topic_id` varchar(20) NOT NULL,
  `featured` int(11) NOT NULL,
  `inst_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `school__article`
--

INSERT INTO `school__article` (`sno`, `club_id`, `article_id`, `name`, `author`, `description`, `date_posted`, `publish_state`, `date_added`, `time_added`, `vendor_id`, `duration`, `link`, `mrp_price`, `class_applicable_for`, `subscription_level`, `school_price`, `icon`, `status`, `topic_id`, `featured`, `inst_id`) VALUES
(1, 'school_club_32', 'sc_art_1', 'Lorem update', 'Lorem update', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec dapibus ligula in dictum molestie. Sed vulputate massa risus, non consequat mi suscipit eget. Sed non quam et est auctor volutpat sed ac dolor. Vivamus vitae venenatis sem. Nulla sed tincidunt metus. Proin vel nulla ut nunc posuere maximus. Sed luctus aliquam sem, eget aliquam nulla varius eget. Sed neque ex, iaculis in gravida in, venenatis ut tellus. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus a consectetur eros.&nbsp;update</p>\r\n', '0000-00-00', 0, '2018-11-07 00:25:15', '2018-11-07 00:25:15', 'inst_4', '00:00:00', 'https://www.lipsum.com/feed/html', 1000, '9,10,11,12', 'platinum', 1000, '075515pm43.jpeg', 1, 'tp_2', 0, 'INST_258');

-- --------------------------------------------------------

--
-- Table structure for table `school__clubs`
--

CREATE TABLE `school__clubs` (
  `sno` int(11) NOT NULL,
  `club_id` varchar(20) NOT NULL,
  `club_name` varchar(100) NOT NULL,
  `club_description` text NOT NULL,
  `club_category_id` varchar(20) NOT NULL,
  `image` varchar(20) NOT NULL,
  `features` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  `launch_date` date NOT NULL,
  `coord_post` varchar(100) NOT NULL,
  `coord_name` varchar(100) NOT NULL,
  `pres_post` varchar(100) NOT NULL,
  `pres_name` varchar(100) NOT NULL,
  `bearer_post` varchar(100) NOT NULL,
  `bearer_name` varchar(100) NOT NULL,
  `class` text NOT NULL,
  `gender` char(1) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `inst_id` varchar(20) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `school__clubs`
--

INSERT INTO `school__clubs` (`sno`, `club_id`, `club_name`, `club_description`, `club_category_id`, `image`, `features`, `status`, `launch_date`, `coord_post`, `coord_name`, `pres_post`, `pres_name`, `bearer_post`, `bearer_name`, `class`, `gender`, `from_date`, `to_date`, `inst_id`, `message`) VALUES
(30, 'school_club_30', 'Mathematrix', 'asdasd\r\nasd\r\nasd', 'CCI_8', '', '', 1, '0000-00-00', 'asd jk', 'jkjk', 'jkjjkjk', 'jjkj', 'jjj', 'jkjk', '1,2,3,4,5,9,10,12', 'f', '2018-11-11', '2018-11-29', 'INST_258', 'Mathematrix club description is lorem Mathematrix club description is lorem Mathematrix club description is lorem Mathematrix club description is lorem Mathematrix club description is lorem Mathematrix club description is lorem Mathematrix club description is lorem Mathematrix club description is lorem Mathematrix club description is lorem Mathematrix club description is lorem Mathematrix club description is lorem Mathematrix club description is lorem Mathematrix club description is lorem Mathematrix club description is lorem Mathematrix club description is lorem Mathematrix club description is lorem Mathematrix club description is lorem Mathematrix club description is lorem Mathematrix club description is lorem Mathematrix club description is lorem Mathematrix club description is lorem Mathematrix club description is lorem Mathematrix club description is lorem Mathematrix club description is lorem Mathematrix club description is lorem Mathematrix club description is lorem Mathematrix club description is lorem Mathematrix club description is lorem Mathematrix club description is lorem Mathematrix club description is lorem Mathematrix club description is lorem Mathematrix club description is lorem '),
(32, 'school_club_32', 'SciFi', 'test', 'CCI_8', '', '', 1, '0000-00-00', 'test', 'test', 'test', 'test', 'test', 'test', '1,2,3,4,5,5,6,7,8,9,10,11,12', 'm', '2018-11-01', '2019-02-15', 'INST_258', 'SciFI club desc is Lorem SciFI club desc is Lorem SciFI club desc is Lorem SciFI club desc is Lorem SciFI club desc is Lorem SciFI club desc is Lorem SciFI club desc is Lorem SciFI club desc is Lorem SciFI club desc is Lorem SciFI club desc is Lorem SciFI club desc is Lorem SciFI club desc is Lorem SciFI club desc is Lorem SciFI club desc is Lorem SciFI club desc is Lorem SciFI club desc is Lorem SciFI club desc is Lorem SciFI club desc is Lorem SciFI club desc is Lorem SciFI club desc is Lorem SciFI club desc is Lorem SciFI club desc is Lorem SciFI club desc is Lorem SciFI club desc is Lorem SciFI club desc is Lorem SciFI club desc is Lorem SciFI club desc is Lorem SciFI club desc is Lorem SciFI club desc is Lorem ');

-- --------------------------------------------------------

--
-- Table structure for table `school__club_category`
--

CREATE TABLE `school__club_category` (
  `sno` int(11) NOT NULL,
  `club_category_id` varchar(20) NOT NULL,
  `club_category_name` varchar(100) NOT NULL,
  `club_category_description` text NOT NULL,
  `date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `inst_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `school__ebook`
--

CREATE TABLE `school__ebook` (
  `sno` int(11) NOT NULL,
  `club_id` varchar(20) NOT NULL,
  `book_id` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `author` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `time_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `vendor_id` varchar(20) DEFAULT NULL,
  `mrp_price` int(11) NOT NULL,
  `duration` time NOT NULL,
  `ebook_file` varchar(50) NOT NULL,
  `subscription_level` varchar(20) NOT NULL,
  `class_applicable_for` text NOT NULL,
  `school_price` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `topic_id` varchar(20) NOT NULL,
  `inst_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `school__ebook`
--

INSERT INTO `school__ebook` (`sno`, `club_id`, `book_id`, `name`, `author`, `description`, `date_added`, `time_added`, `vendor_id`, `mrp_price`, `duration`, `ebook_file`, `subscription_level`, `class_applicable_for`, `school_price`, `status`, `topic_id`, `inst_id`) VALUES
(1, 'school_club_32', 'sc_ebk_1', 'Ebook Lorem update', 'Lorem Autohr', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec dapibus ligula in dictum molestie. Sed vulputate massa risus, non consequat mi suscipit eget. Sed non quam et est auctor volutpat sed ac dolor. Vivamus vitae venenatis sem. Nulla sed tincidunt metus. Proin vel nulla ut nunc posuere maximus. Sed luctus aliquam sem, eget aliquam nulla varius eget. Sed neque ex, iaculis in gravida in, venenatis ut tellus. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus a consectetur eros. Update</p>\r\n', '2018-11-07 00:52:51', '2018-11-07 00:52:51', 'inst_3', 100, '10:30:00', '091401am75.pdf', 'platinum', '7,8,9,11', 100, 1, 'tp_2', 'INST_258'),
(2, 'school_club_32', 'sc_ebk_2', 'Ebook Lorem update', 'Lorem Autohr', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec dapibus ligula in dictum molestie. Sed vulputate massa risus, non consequat mi suscipit eget. Sed non quam et est auctor volutpat sed ac dolor. Vivamus vitae venenatis sem. Nulla sed tincidunt metus. Proin vel nulla ut nunc posuere maximus. Sed luctus aliquam sem, eget aliquam nulla varius eget. Sed neque ex, iaculis in gravida in, venenatis ut tellus. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus a consectetur eros. Update</p>\r\n', '2018-11-07 00:52:51', '2018-11-07 00:52:51', 'inst_3', 100, '10:30:00', '091401am75.pdf', 'platinum', '7,8,9,11', 100, 1, 'tp_2', 'INST_258');

-- --------------------------------------------------------

--
-- Table structure for table `school__enquiry`
--

CREATE TABLE `school__enquiry` (
  `sno` int(11) NOT NULL,
  `enquiry_id` varchar(20) NOT NULL,
  `school_name` varchar(100) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `principal_name` varchar(100) NOT NULL,
  `principal_phone` int(11) NOT NULL,
  `principal_email` varchar(100) NOT NULL,
  `otp` int(11) NOT NULL,
  `otp_email` int(11) NOT NULL,
  `status` varchar(15) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `school__enquiry`
--

INSERT INTO `school__enquiry` (`sno`, `enquiry_id`, `school_name`, `phone`, `email`, `address`, `principal_name`, `principal_phone`, `principal_email`, `otp`, `otp_email`, `status`, `datetime`) VALUES
(19, 'enq_19', 'gvbhj', '9137245036', 'nkirandroid1@gmail.com', '', '', 0, '', 7135, 9195, '', '2019-02-19 14:47:36'),
(20, 'enq_20', 'hvbjnj', '9137245036', 'nkiranjhbd@gmail.com', '', '', 0, '', 9940, 9587, '', '2019-02-19 14:47:36'),
(21, 'enq_21', 'ghbjnk', '9137245036', 'nkirandroid1@gmail.com', '', '', 0, '', 6326, 1626, '', '2019-02-19 14:47:36'),
(22, 'enq_22', 'hjnk', '9137245036', 'nkirajndroid@gmail.com', '', '', 0, '', 9327, 6057, '', '2019-02-19 14:47:36'),
(24, 'enq_24', 'bhjnk', '9137245036', 'nkirandroid1@gmail.com', 'hbjnkm', '', 0, '', 9971, 3230, '', '2019-02-19 14:47:36'),
(25, 'enq_25', 'bhjnk', '9137245036', 'nkirandroid1@gmail.com', 'hbjnkm', '', 0, '', 3219, 2150, '', '2019-02-19 14:47:36'),
(26, 'enq_26', 'jhbnm', 'hbjkm', 'nkirandrhoid@gmail.com', 'jnkm', '', 0, '', 5407, 8942, '', '2019-02-19 14:47:36'),
(27, 'enq_27', 'ghjk', 'ugyhjk', 'nkirandrgsdfoid@gmail.com', 'uyghjk', '', 0, '', 2487, 3705, '', '2019-02-19 14:47:36'),
(28, 'enq_28', 'ghjk', 'ugyhjk', 'nkirankjhkdrgsdfoid@gmail.com', 'uyghjk', '', 0, '', 7205, 4759, '', '2019-02-19 14:47:36'),
(29, 'enq_29', 'ghjk', 'ugyhjk', 'nkirankjhkdrgsdfoid@gmail.com', 'uyghjk', 'hjkbn', 0, 'jknkj', 4011, 3510, '', '2019-02-19 14:47:36'),
(30, 'enq_30', 'ghjk', 'ugyhjk', 'nkirankjhkdrgsdfoid@gmail.com', 'uyghjk', 'hjkbn', 0, 'jknkj', 1907, 9748, '', '2019-02-19 14:47:36'),
(31, 'enq_31', 'ghjbn', '789789789', 'hjbn@bh.com', 'jhb', '', 0, '', 4312, 2816, '', '2019-02-19 14:47:36'),
(32, 'enq_32', 'hbjkl', 'jhbk', 'hjbkml', 'hubjnkl', 'hjbk', 0, 'hjbkml', 1701, 4754, '', '2019-02-19 14:47:36'),
(33, 'enq_33', 'hbjkl', 'jhbk', 'hjbkml', 'hubjnkl', 'hjbk', 0, 'hjbkml', 8656, 6858, '', '2019-02-19 14:47:36'),
(34, 'enq_34', 'hjbn', '9137245036', 'nmk', 'jhbn', '', 0, '', 3154, 4750, '', '2019-02-19 14:47:36'),
(35, 'enq_35', 'hjb', '9137245036', 'gvbhjnkm', 'hgbjklm', '', 0, '', 9379, 7628, '', '2019-02-19 14:47:36'),
(36, 'enq_36', 'hjbk', '9137245036', 'hjbklm', 'hjbknl', 'kjlm', 0, 'jhklm;,', 6528, 4978, '', '2019-02-19 14:47:36'),
(37, 'enq_37', 'guhi', '9137245036', 'jhbknm', 'hbjnl', 'jhbnkml', 0, 'hjbklm', 1036, 8438, '', '2019-02-19 14:47:36'),
(38, 'enq_38', 'uhyij', '9137245036', 'hjbkl', 'hbj', 'hjui', 0, 'jhkl', 1799, 9837, '', '2019-02-19 14:47:36'),
(39, 'enq_39', 'hiuj', '9137245036', 'hbjnkl', 'hinjk', '', 0, '', 3212, 3956, '', '2019-02-19 14:47:36'),
(40, 'enq_40', 'hbj', '9137245036', 'jihiu', 'hjbnk', 'gbh', 0, 'bhunj', 2781, 7841, '', '2019-02-19 14:47:36'),
(41, 'enq_41', 'kjnl', '9137245036', 'hjbj', 'klm', 'bghji', 0, 'jhkl', 6741, 1220, '', '2019-02-19 14:47:36'),
(42, 'enq_42', 'knjl', '9137245036', 'jh', 'kjnlm', 'jhbjoi', 0, 'kji', 4835, 5144, '', '2019-02-19 14:47:36'),
(43, 'enq_43', 'hjbkl', '9137245036', 'jhiuj', 'bhjkl', '', 0, '', 2177, 6039, '', '2019-02-19 14:47:36'),
(44, 'enq_44', 'bjhkl', '9137245036', 'hvjbio', 'hjbkl', '', 0, '', 4958, 3706, '', '2019-02-19 14:47:36'),
(45, 'enq_45', 'bhkj', '9137245036', 'kjiho', 'jhbkl', '', 0, '', 5291, 8753, '', '2019-02-19 14:47:36'),
(46, 'enq_46', 'bhj', '9137245036', 'hjb', 'jki', 'jn', 0, 'kjlo', 5432, 1315, '', '2019-02-19 14:47:36'),
(47, 'enq_47', 'gvhbjnk', '9137245036', 'gh', 'ghbjnk', '', 0, '', 5061, 2081, '', '2019-02-19 14:47:36'),
(48, 'enq_48', 'gvhbjnk', '9137245036', 'gh', 'ghbjnk', 'gvjh', 0, 'jhbk', 7630, 7798, '', '2019-02-19 14:47:36'),
(49, 'enq_49', 'q', '9137245036', 'g', 'q', '', 0, '', 7919, 8905, '', '2019-02-19 14:47:36'),
(50, 'enq_50', 'asaf', '9137245036', 'sdfsdf@gmail.com', 'dsfsdf', '', 0, '', 7880, 2439, '', '2019-02-22 13:38:53'),
(51, 'enq_51', 'ABPS', '9137245036', 'nkirandrosdfsfid@gmail.com', 'Plot No 1, Sector 48, A-201, Rudranah Chs', '', 0, '', 9389, 4073, '', '2019-02-22 13:40:55'),
(52, 'enq_52', 'ABPS', '9137245036', 'nkirandrosdfsfid@gmail.com', 'Plot No 1, Sector 48, A-201, Rudranah Chs', '', 0, '', 5550, 1009, '', '2019-02-22 13:41:35'),
(53, 'enq_53', 'ABPS', '9137245036', 'nkirandr24234oid@gmail.com', 'Sector 14,, C 604 Radhekrishna Plot no 16', '', 0, '', 4905, 6432, '', '2019-02-22 13:43:48'),
(54, 'enq_54', 'sd', '2134567', 'asdasd@asd.com', 'sd', '', 0, '', 4468, 9617, '', '2019-02-22 13:47:00'),
(55, 'enq_55', 'nnnn', '2345678909', 'wertyu@rtyui.com', 'nnnn', 'dtfvgybhnj', 1234567890, 'fcgvhbjnkm@ftgybhnj.com', 7445, 3282, '', '2019-02-22 13:48:12');

-- --------------------------------------------------------

--
-- Table structure for table `school__iclub_assign`
--

CREATE TABLE `school__iclub_assign` (
  `sno` int(11) NOT NULL,
  `inst_id` varchar(20) NOT NULL,
  `club_id` varchar(20) NOT NULL,
  `coord_post` varchar(100) NOT NULL,
  `coord_name` varchar(100) NOT NULL,
  `pres_post` varchar(100) NOT NULL,
  `pres_name` varchar(100) NOT NULL,
  `bearer_post` varchar(100) DEFAULT NULL,
  `bearer_name` varchar(100) DEFAULT NULL,
  `class` text,
  `gender` char(1) DEFAULT NULL,
  `auto_deploy` int(11) DEFAULT NULL,
  `club_assign_id` varchar(20) NOT NULL,
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `club_coordinator_id` varchar(20) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `school__iclub_assign`
--

INSERT INTO `school__iclub_assign` (`sno`, `inst_id`, `club_id`, `coord_post`, `coord_name`, `pres_post`, `pres_name`, `bearer_post`, `bearer_name`, `class`, `gender`, `auto_deploy`, `club_assign_id`, `from_date`, `to_date`, `club_coordinator_id`, `status`) VALUES
(40, 'INST_2565', 'club_app', 'gbhnjmk', 'hbnjkml', 'hbjnkml', 'hbjnk', 'hbjnkml', 'hbjnkml', '-', '-', NULL, '', '0000-00-00', '0000-00-00', '', 1),
(41, 'INST_258', 'club_design', '', '', '', '', NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', 1),
(42, 'INST_258', 'club_app', '', '', '', '', NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', 0),
(43, 'INST_258', 'club_maths', '', '', '', '', NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `school__learning_video`
--

CREATE TABLE `school__learning_video` (
  `sno` int(11) NOT NULL,
  `club_id` varchar(20) NOT NULL,
  `video_id` varchar(20) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description_line` text NOT NULL,
  `description_detail` text NOT NULL,
  `duration` time NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `time_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `mrp_price` int(11) NOT NULL,
  `learning` text NOT NULL,
  `vendor_id` varchar(20) NOT NULL,
  `video_file` varchar(20) NOT NULL,
  `class_applicable_for` text NOT NULL,
  `subscription_level` varchar(20) NOT NULL,
  `school_price` int(11) NOT NULL,
  `link` varchar(100) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `topic_id` varchar(20) NOT NULL,
  `inst_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `school__learning_video`
--

INSERT INTO `school__learning_video` (`sno`, `club_id`, `video_id`, `title`, `description_line`, `description_detail`, `duration`, `date_added`, `time_added`, `mrp_price`, `learning`, `vendor_id`, `video_file`, `class_applicable_for`, `subscription_level`, `school_price`, `link`, `status`, `topic_id`, `inst_id`) VALUES
(1, 'school_club_32', 'sc_l_vid_1', 'Learning Video 1 updatye', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In aliquam suscipit rutrum. Duis hendrerit dictum felis, et efficitur risus vulputate non. Cras ac odio suscipit, gravida nunc in, luctus diam. Maecenas id magna felis. Vivamus feugiat tincidunt scelerisque. Nunc et justo tortor. Cras fringilla risus facilisis turpis vestibulum, in posuere tellus laoreet. Donec et libero sit amet nulla egestas mattis quis quis nunc. Quisque maximus dolor a consequat mattis. Curabitur ac urna massa. Suspendisse non ipsum pharetra, pretium neque ac, viverra nulla. Maecenas eu sem luctus, pretium ligula id, lacinia dui. Cras ac turpis ligula. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nullam et consequat quam.updatye</p>\r\n', '', '01:30:00', '2018-11-07 09:51:50', '2018-11-07 09:51:50', 1000, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In aliquam suscipit rutrum. Duis hendrerit dictum felis, et efficitur risus vulputate non. Cras ac odio suscipit, gravida nunc in, luctus diam. Maecenas id magna felis. Vivamus feugiat tincidunt scelerisque. Nunc et justo tortor. Cras fringilla risus facilisis turpis vestibulum, in posuere tellus laoreet. Donec et libero sit amet nulla egestas mattis quis quis nunc. Quisque maximus dolor a consequat mattis. Curabitur ac urna massa. Suspendisse non ipsum pharetra, pretium neque ac, viverra nulla. Maecenas eu sem luctus, pretium ligula id, lacinia dui. Cras ac turpis ligula. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nullam et consequat quam.updatye</p>\r\n', 'inst_3', '', '8,9,10', 'silver', 1000, 'https://www.youtube.com/embed/TUj0otkJEBo', 1, 'tp_2', 'inst_1');

-- --------------------------------------------------------

--
-- Table structure for table `school__live_course`
--

CREATE TABLE `school__live_course` (
  `sno` int(11) NOT NULL,
  `club_id` varchar(20) NOT NULL,
  `course_id` varchar(20) NOT NULL,
  `description_line` text NOT NULL,
  `no_of_classes` int(11) NOT NULL,
  `mrp_price` int(11) NOT NULL,
  `class_applicable_for` text NOT NULL,
  `subscription_level` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `primary_image` varchar(100) NOT NULL,
  `secondary_image` varchar(100) NOT NULL,
  `course_icon` varchar(100) NOT NULL,
  `time_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `learning` text NOT NULL,
  `prerequisites` text NOT NULL,
  `vendor_id` varchar(20) NOT NULL,
  `duration` int(11) NOT NULL,
  `school_price` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `topic_id` varchar(20) NOT NULL,
  `inst_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `school__live_course`
--

INSERT INTO `school__live_course` (`sno`, `club_id`, `course_id`, `description_line`, `no_of_classes`, `mrp_price`, `class_applicable_for`, `subscription_level`, `description`, `primary_image`, `secondary_image`, `course_icon`, `time_added`, `date_added`, `learning`, `prerequisites`, `vendor_id`, `duration`, `school_price`, `status`, `topic_id`, `inst_id`) VALUES
(1, 'club_web', 'course_1', 'Lorem updater', 0, 100, '9', 'silver', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec dapibus ligula in dictum molestie. Sed vulputate massa risus, non consequat mi suscipit eget. Sed non quam et est auctor volutpat sed ac dolor. Vivamus vitae venenatis sem. Nulla sed tincidunt metus. Proin vel nulla ut nunc posuere maximus. Sed luctus aliquam sem, eget aliquam nulla varius eget. Sed neque ex, iaculis in gravida in, venenatis ut tellus. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus a consectetur eros.</p>\r\n', '081540pm17.png', '080244pm85.jpeg', '081547pm74.png', '2018-11-07 00:32:44', '2018-11-07 00:32:44', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec dapibus ligula in dictum molestie. Sed vulputate massa risus, non consequat mi suscipit eget. Sed non quam et est auctor volutpat sed ac dolor. Vivamus vitae venenatis sem. Nulla sed tincidunt metus. Proin vel nulla ut nunc posuere maximus. Sed luctus aliquam sem, eget aliquam nulla varius eget. Sed neque ex, iaculis in gravida in, venenatis ut tellus. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus a consectetur eros. updater</p>\r\n', '', 'inst_1', 1015, 100, 5, 'tp_7', 'inst_1');

-- --------------------------------------------------------

--
-- Table structure for table `school__log_detail`
--

CREATE TABLE `school__log_detail` (
  `sno` int(11) NOT NULL,
  `type` varchar(15) NOT NULL,
  `id` varchar(20) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `school__log_detail`
--

INSERT INTO `school__log_detail` (`sno`, `type`, `id`, `datetime`) VALUES
(1, 'school', 'INST_258', '2019-02-19 12:16:32'),
(2, 'school', 'INST_258', '2019-02-20 12:16:32');

-- --------------------------------------------------------

--
-- Table structure for table `school__online_test`
--

CREATE TABLE `school__online_test` (
  `sno` int(11) NOT NULL,
  `club_id` varchar(20) NOT NULL,
  `test_id` varchar(20) NOT NULL,
  `institute_id` varchar(20) NOT NULL,
  `test_type` varchar(20) NOT NULL,
  `test_name` varchar(100) NOT NULL,
  `test_creator` varchar(100) NOT NULL,
  `publish_state` tinyint(1) NOT NULL,
  `time_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `display_type` varchar(20) NOT NULL,
  `duration` time NOT NULL,
  `no_of_ques` int(11) NOT NULL,
  `total_marks` int(11) NOT NULL,
  `feedback_ranges` text NOT NULL,
  `vendor_id` varchar(20) DEFAULT NULL,
  `test_data` text NOT NULL,
  `mrp_price` int(11) NOT NULL,
  `class_applicable_for` text NOT NULL,
  `subscription_level` varchar(20) NOT NULL,
  `school_price` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `topic_id` varchar(20) NOT NULL,
  `inst_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `school__online_test`
--

INSERT INTO `school__online_test` (`sno`, `club_id`, `test_id`, `institute_id`, `test_type`, `test_name`, `test_creator`, `publish_state`, `time_added`, `date_added`, `display_type`, `duration`, `no_of_ques`, `total_marks`, `feedback_ranges`, `vendor_id`, `test_data`, `mrp_price`, `class_applicable_for`, `subscription_level`, `school_price`, `status`, `topic_id`, `inst_id`) VALUES
(1, 'club_web', 'test_1', '', '', 'Online test upadte', 'Kiran upate', 0, '2018-11-07 10:54:25', '2018-11-07 10:54:25', '', '01:45:00', 0, 0, '', 'inst_7', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In aliquam suscipit rutrum. Duis hendrerit dictum felis, et efficitur risus vulputate non. Cras ac odio suscipit, gravida nunc in, luctus diam. Maecenas id magna felis. Vivamus feugiat tincidunt scelerisque. Nunc et justo tortor. Cras fringilla risus facilisis turpis vestibulum, in posuere tellus laoreet. Donec et libero sit amet nulla egestas mattis quis quis nunc. Quisque maximus dolor a consequat mattis. Curabitur ac urna massa. Suspendisse non ipsum pharetra, pretium neque ac, viverra nulla. Maecenas eu sem luctus, pretium ligula id, lacinia dui. Cras ac turpis ligula. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nullam et consequat quam. upadte</p>\r\n', 10000, '9,10,11,12', 'platinum', 1010101, 5, 'tp_6', 'inst_1');

-- --------------------------------------------------------

--
-- Table structure for table `school__quiz`
--

CREATE TABLE `school__quiz` (
  `sno` int(11) NOT NULL,
  `quiz_title` varchar(100) NOT NULL,
  `quiz_id` varchar(20) NOT NULL,
  `club_id` varchar(20) NOT NULL,
  `institute_id` varchar(20) NOT NULL,
  `vendor_id` varchar(20) NOT NULL,
  `quiz_creator` varchar(100) NOT NULL,
  `time_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `no_of_questions` int(11) NOT NULL,
  `mrp_price` int(11) NOT NULL,
  `school_price` int(11) NOT NULL,
  `class_applicable_for` text NOT NULL,
  `subscription_level` varchar(20) NOT NULL,
  `status` int(11) NOT NULL,
  `link` text NOT NULL,
  `quiz_details` text NOT NULL,
  `topic_id` varchar(20) NOT NULL,
  `inst_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `school__quiz`
--

INSERT INTO `school__quiz` (`sno`, `quiz_title`, `quiz_id`, `club_id`, `institute_id`, `vendor_id`, `quiz_creator`, `time_added`, `date_added`, `no_of_questions`, `mrp_price`, `school_price`, `class_applicable_for`, `subscription_level`, `status`, `link`, `quiz_details`, `topic_id`, `inst_id`) VALUES
(1, 'Quiz Create', 'sc_quiz_2', 'school_club_32', '', 'inst_1', 'Kiran', '2018-11-07 11:01:53', '2018-11-07 11:01:53', 6, 100, 100, '9,10,11', 'gold', 1, 'link', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In aliquam suscipit rutrum. Duis hendrerit dictum felis, et efficitur risus vulputate non. Cras ac odio suscipit, gravida nunc in, luctus diam. Maecenas id magna felis. Vivamus feugiat tincidunt scelerisque. Nunc et justo tortor. Cras fringilla risus facilisis turpis vestibulum, in posuere tellus laoreet. Donec et libero sit amet nulla egestas mattis quis quis nunc. Quisque maximus dolor a consequat mattis. Curabitur ac urna massa. Suspendisse non ipsum pharetra, pretium neque ac, viverra nulla. Maecenas eu sem luctus, pretium ligula id, lacinia dui. Cras ac turpis ligula. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nullam et consequat quam.</p>\r\n', 'tp_2', 'inst_1');

-- --------------------------------------------------------

--
-- Table structure for table `school__sample_work`
--

CREATE TABLE `school__sample_work` (
  `sno` int(11) NOT NULL,
  `club_id` varchar(20) NOT NULL,
  `sample_work_id` varchar(20) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description_line` text NOT NULL,
  `description_detail` text NOT NULL,
  `duration` time NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `time_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `mrp_price` int(11) NOT NULL,
  `learning` text NOT NULL,
  `vendor_id` varchar(20) NOT NULL,
  `video_file` varchar(20) NOT NULL,
  `class_applicable_for` text NOT NULL,
  `subscription_level` varchar(20) NOT NULL,
  `school_price` int(11) NOT NULL,
  `link` varchar(100) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `topic_id` varchar(20) NOT NULL,
  `image` varchar(20) NOT NULL,
  `media_type` varchar(20) NOT NULL,
  `last_date` date NOT NULL,
  `pdf` varchar(20) NOT NULL,
  `inst_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `school__sample_work`
--

INSERT INTO `school__sample_work` (`sno`, `club_id`, `sample_work_id`, `title`, `description_line`, `description_detail`, `duration`, `date_added`, `time_added`, `mrp_price`, `learning`, `vendor_id`, `video_file`, `class_applicable_for`, `subscription_level`, `school_price`, `link`, `status`, `topic_id`, `image`, `media_type`, `last_date`, `pdf`, `inst_id`) VALUES
(1, 'club_web', 's_work_1', 'Sample Work 2', '<p>This activity will need skill1, skill2, skill4 and commitment and lots of enthusiasm lorem ipsum dolor comet asteriod kuiper belt mars saturn jupiter neptune uranus and oh please pluto too !</p>\r\n', '', '00:09:56', '2018-11-07 11:37:39', '2018-11-07 11:37:39', 1000, '<p>test</p>\r\n', 'inst_1', '082746am07.mp4', '6', 'gold', 1000, 'https://www.youtube.com/embed/YE7VzlLtp-4', 1, 'tp_2', '071244am79.jpg', 'video', '2018-11-10', '', 'inst_1');

-- --------------------------------------------------------

--
-- Table structure for table `school__stage`
--

CREATE TABLE `school__stage` (
  `sno` int(11) NOT NULL,
  `id` varchar(15) NOT NULL,
  `stage` varchar(10) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `school__stage`
--

INSERT INTO `school__stage` (`sno`, `id`, `stage`, `datetime`) VALUES
(1, '258', 's0', '2019-02-27 11:32:06');

-- --------------------------------------------------------

--
-- Table structure for table `school__topic`
--

CREATE TABLE `school__topic` (
  `sno` int(11) NOT NULL,
  `club_id` varchar(20) NOT NULL,
  `topic_id` varchar(20) NOT NULL,
  `topic_name` varchar(100) NOT NULL,
  `topic_desc` text NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL,
  `inst_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `school__topic`
--

INSERT INTO `school__topic` (`sno`, `club_id`, `topic_id`, `topic_name`, `topic_desc`, `start_date`, `end_date`, `date`, `status`, `inst_id`) VALUES
(1, 'school_club_32', 'tp_2', 'topic 1', 'topicform', '0000-00-00', '0000-00-00', '2018-11-15 18:12:08', 1, 'INST_258'),
(2, 'school_club_30', 'INST_258_school_club', 'topic 2', 'asas', '0000-00-00', '0000-00-00', '2018-11-15 18:16:29', 1, 'INST_258');

-- --------------------------------------------------------

--
-- Table structure for table `school__topic_download`
--

CREATE TABLE `school__topic_download` (
  `sno` int(11) NOT NULL,
  `topic_id` varchar(20) NOT NULL,
  `title` varchar(100) NOT NULL,
  `link` text NOT NULL,
  `inst_id` varchar(20) NOT NULL,
  `cc_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `school__video`
--

CREATE TABLE `school__video` (
  `sno` int(11) NOT NULL,
  `club_id` varchar(20) NOT NULL,
  `video_id` varchar(20) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description_line` text NOT NULL,
  `description_detail` text NOT NULL,
  `duration` time NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `time_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `mrp_price` int(11) NOT NULL,
  `learning` text NOT NULL,
  `vendor_id` varchar(20) NOT NULL,
  `video_file` varchar(20) NOT NULL,
  `class_applicable_for` text NOT NULL,
  `subscription_level` varchar(20) NOT NULL,
  `school_price` int(11) NOT NULL,
  `link` varchar(100) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `topic_id` varchar(20) NOT NULL,
  `inst_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `school__video`
--

INSERT INTO `school__video` (`sno`, `club_id`, `video_id`, `title`, `description_line`, `description_detail`, `duration`, `date_added`, `time_added`, `mrp_price`, `learning`, `vendor_id`, `video_file`, `class_applicable_for`, `subscription_level`, `school_price`, `link`, `status`, `topic_id`, `inst_id`) VALUES
(1, 'school_club_32', 'vid_1', 'Video Create', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In aliquam suscipit rutrum. Duis hendrerit dictum felis, et efficitur risus vulputate non. Cras ac odio suscipit, gravida nunc in, luctus diam. Maecenas id magna felis. Vivamus feugiat tincidunt scelerisque. Nunc et justo tortor. Cras fringilla risus facilisis turpis vestibulum, in posuere tellus laoreet. Donec et libero sit amet nulla egestas mattis quis quis nunc. Quisque maximus dolor a consequat mattis. Curabitur ac urna massa. Suspendisse non ipsum pharetra, pretium neque ac, viverra nulla. Maecenas eu sem luctus, pretium ligula id, lacinia dui. Cras ac turpis ligula. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nullam et consequat quam.</p>\r\n', '', '00:10:30', '2018-11-07 11:57:38', '2018-11-07 11:57:38', 1000, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In aliquam suscipit rutrum. Duis hendrerit dictum felis, et efficitur risus vulputate non. Cras ac odio suscipit, gravida nunc in, luctus diam. Maecenas id magna felis. Vivamus feugiat tincidunt scelerisque. Nunc et justo tortor. Cras fringilla risus facilisis turpis vestibulum, in posuere tellus laoreet. Donec et libero sit amet nulla egestas mattis quis quis nunc. Quisque maximus dolor a consequat mattis. Curabitur ac urna massa. Suspendisse non ipsum pharetra, pretium neque ac, viverra nulla. Maecenas eu sem luctus, pretium ligula id, lacinia dui. Cras ac turpis ligula. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nullam et consequat quam.</p>\r\n', 'inst_5', '081916am101.mp4', '10,11', 'gold', 100, '', 0, 'tp_2', 'INST_258');

-- --------------------------------------------------------

--
-- Table structure for table `school__webinar`
--

CREATE TABLE `school__webinar` (
  `sno` int(11) NOT NULL,
  `club_id` varchar(20) NOT NULL,
  `webinar_id` varchar(20) NOT NULL,
  `title` varchar(100) NOT NULL,
  `speaker` varchar(100) NOT NULL,
  `speaker_desc` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `duration` time NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `mrp_price` int(11) NOT NULL,
  `time_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `vendor_id` varchar(20) DEFAULT NULL,
  `learning` text NOT NULL,
  `class_applicable_for` text NOT NULL,
  `subscription_level` varchar(20) NOT NULL,
  `school_price` int(11) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `status` int(11) NOT NULL,
  `topic_id` varchar(20) NOT NULL,
  `image` varchar(20) NOT NULL,
  `speaker_img` varchar(20) NOT NULL,
  `link` text NOT NULL,
  `inst_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `school__webinar`
--

INSERT INTO `school__webinar` (`sno`, `club_id`, `webinar_id`, `title`, `speaker`, `speaker_desc`, `description`, `duration`, `date`, `time`, `mrp_price`, `time_added`, `date_added`, `vendor_id`, `learning`, `class_applicable_for`, `subscription_level`, `school_price`, `start_time`, `end_time`, `status`, `topic_id`, `image`, `speaker_img`, `link`, `inst_id`) VALUES
(1, 'school_club_32', 'web_1', 'Webinar Create', 'Kiran', 'CEO @ sudopower', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In aliquam suscipit rutrum. Duis hendrerit dictum felis, et efficitur risus vulputate non. Cras ac odio suscipit, gravida nunc in, luctus diam. Maecenas id magna felis. Vivamus feugiat tincidunt scelerisque. Nunc et justo tortor. Cras fringilla risus facilisis turpis vestibulum, in posuere tellus laoreet. Donec et libero sit amet nulla egestas mattis quis quis nunc. Quisque maximus dolor a consequat mattis. Curabitur ac urna massa. Suspendisse non ipsum pharetra, pretium neque ac, viverra nulla. Maecenas eu sem luctus, pretium ligula id, lacinia dui. Cras ac turpis ligula. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nullam et consequat quam.</p>\r\n', '01:30:00', '2018-11-30', '00:00:00', 1500, '2018-11-07 12:05:14', '2018-11-07 12:05:14', 'inst_3', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In aliquam suscipit rutrum. Duis hendrerit dictum felis, et efficitur risus vulputate non. Cras ac odio suscipit, gravida nunc in, luctus diam. Maecenas id magna felis. Vivamus feugiat tincidunt scelerisque. Nunc et justo tortor. Cras fringilla risus facilisis turpis vestibulum, in posuere tellus laoreet. Donec et libero sit amet nulla egestas mattis quis quis nunc. Quisque maximus dolor a consequat mattis. Curabitur ac urna massa. Suspendisse non ipsum pharetra, pretium neque ac, viverra nulla. Maecenas eu sem luctus, pretium ligula id, lacinia dui. Cras ac turpis ligula. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nullam et consequat quam.</p>\r\n', '10,11,12', 'gold', 1000, '00:03:00', '12:30:00', 5, 'tp_2', '080824am11.jpg', '080824am29.jpg', 'https://www.lipsum.com/feed/html', 'INST_258');

-- --------------------------------------------------------

--
-- Table structure for table `school__web_reg`
--

CREATE TABLE `school__web_reg` (
  `sno` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `school_name` text NOT NULL,
  `otp` int(11) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `school__web_reg`
--

INSERT INTO `school__web_reg` (`sno`, `name`, `designation`, `phone`, `email`, `school_name`, `otp`, `datetime`) VALUES
(1, 'jnkl', 'bhj', '9137245036', '', 'kjnl', 7443, '2019-02-18 01:00:00'),
(2, 'vghuij', 'ijhbi', '91372450364', '', 'jhu', 1750, '2018-12-17 15:08:27'),
(3, 'gwerf`', 'jh', '91372450365489', '', 'hgv', 5116, '2018-12-17 15:12:25'),
(4, 'fygbhnjmk', '', '23456789', '', 'tyghujiko', 0, '2018-12-19 18:25:11'),
(5, 'Kirannn', '', '9137245036', '', 'ABPS', 0, '2018-12-19 18:25:49'),
(6, 'vhbjnkml', '', 'hbjnkml', '', 'hbjnkml', 0, '2018-12-19 18:57:52'),
(7, 'vghbjnk', '', 'hgbjnkml', '', 'gvhbjnkm', 0, '2018-12-19 18:59:17'),
(8, 'fvgbhjn', '', 'hgbjnkm', '', 'hbjnk', 0, '2018-12-19 19:02:00');

-- --------------------------------------------------------

--
-- Table structure for table `school__workshop`
--

CREATE TABLE `school__workshop` (
  `sno` int(11) NOT NULL,
  `club_id` varchar(20) NOT NULL,
  `workshop_id` varchar(20) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description_line` text NOT NULL,
  `no_of_classes` int(11) NOT NULL,
  `mrp_price` int(11) NOT NULL,
  `class_applicable_for` text NOT NULL,
  `subscription_level` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `primary_image` varchar(100) DEFAULT NULL,
  `secondary_image` varchar(100) DEFAULT NULL,
  `course_icon` varchar(100) DEFAULT NULL,
  `time_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `learning` text NOT NULL,
  `prerequisites` text NOT NULL,
  `vendor_id` varchar(20) DEFAULT NULL,
  `school_price` int(11) NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `duration` int(11) NOT NULL,
  `speaker` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `topic_id` varchar(20) NOT NULL,
  `inst_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `school__workshop`
--

INSERT INTO `school__workshop` (`sno`, `club_id`, `workshop_id`, `title`, `description_line`, `no_of_classes`, `mrp_price`, `class_applicable_for`, `subscription_level`, `description`, `primary_image`, `secondary_image`, `course_icon`, `time_added`, `date_added`, `learning`, `prerequisites`, `vendor_id`, `school_price`, `date`, `start_time`, `end_time`, `duration`, `speaker`, `status`, `topic_id`, `inst_id`) VALUES
(1, 'school_club_32', 'work_1', 'Workshop Create upadte', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In aliquam suscipit rutrum. Duis hendrerit dictum felis, et efficitur risus vulputate non. Cras ac odio suscipit, gravida nunc in, luctus diam. Maecenas id magna felis. Vivamus feugiat tincidunt scelerisque. Nunc et justo tortor. Cras fringilla risus facilisis turpis vestibulum, in posuere tellus laoreet. Donec et libero sit amet nulla egestas mattis quis quis nunc. Quisque maximus dolor a consequat mattis. Curabitur ac urna massa. Suspendisse non ipsum pharetra, pretium neque ac, viverra nulla. Maecenas eu sem luctus, pretium ligula id, lacinia dui. Cras ac turpis ligula. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nullam et consequat quam. updae</p>\r\n', 12, 1500, '8,9,10,11', 'platinum', '', '075320am86.jpg', '075320am105.jpg', '075320am62.jpg', '2018-11-07 12:21:56', '2018-11-07 12:21:56', '<p>Lorem ipsum dolor sit amet, consectetur a</p>\r\n\r\n<p>dipiscing elit. In aliquam suscipit rutrum. Duisas hendrerit dictum felis, et efficitur risus vulputate non. Cras ac odio suscipit, gravida nunc in, luctus diam. Maecenas id magna felis. Vivamus</p>\r\n\r\n<p>feugiat tincidunt scelerisque. Nunc et justo tortor. Crasdas fringilla risus facilisis turpis vestibulum, in posuere tellus laoreet. Donec et libero sit amet nulla egestas mattis quis quis nunc. Quisque</p>\r\n\r\n<p>maximus dolor a consequat mattis. Curabitur ac urna dasmassa. Suspendisse non ipsum pharetra, pretium neque ac, viverra nulla. Maecenas eu sem luctus, pretium ligula id, lacinia dui. Cras ac</p>\r\n\r\n<p>turpis ligula. Interdum et malesuada fames ac ante ipdassum primis in faucibus. Nullam et consequat quam.d</p>\r\n\r\n<p>&nbsp;</p>\r\n', '<p>Lorem ipsum dolor sit amet, consectetur a</p>\r\n\r\n<p>dipiscing elit. In aliquam suscipit rutrum. Duisas hendrerit dictum felis, et efficitur risus vulputate non. Cras ac odio suscipit, gravida nunc in, luctus diam. Maecenas id magna felis. Vivamus</p>\r\n\r\n<p>feugiat tincidunt scelerisque. Nunc et justo tortor. Crasdas fringilla risus facilisis turpis vestibulum, in posuere tellus laoreet. Donec et libero sit amet nulla egestas mattis quis quis nunc. Quisque</p>\r\n\r\n<p>maximus dolor a consequat mattis. Curabitur ac urna dasmassa. Suspendisse non ipsum pharetra, pretium neque ac, viverra nulla. Maecenas eu sem luctus, pretium ligula id, lacinia dui. Cras ac</p>\r\n\r\n<p>turpis ligula. Interdum et malesuada fames ac ante ipdassum primis in faucibus. Nullam et consequat quam.d</p>\r\n\r\n<p>&nbsp;</p>\r\n', 'inst_3', 1510, '2018-11-29', '10:30:00', '12:30:00', 10, '', 5, 'tp_2', 'inst_1');

-- --------------------------------------------------------

--
-- Table structure for table `send_sms_school`
--

CREATE TABLE `send_sms_school` (
  `sno` int(11) NOT NULL,
  `school_name` varchar(100) NOT NULL,
  `principal_name` varchar(100) NOT NULL,
  `mobile_number` varchar(15) NOT NULL,
  `email_id` varchar(100) NOT NULL,
  `state` varchar(30) NOT NULL,
  `city` varchar(50) NOT NULL,
  `status` varchar(10) NOT NULL,
  `date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `send_sms_school`
--

INSERT INTO `send_sms_school` (`sno`, `school_name`, `principal_name`, `mobile_number`, `email_id`, `state`, `city`, `status`, `date_time`) VALUES
(5, 'ABPS', 'Kiran Nambiar', '9137245036', 'abc', 'Maharashtra', 'Mumbai', 'Not Sent', '2018-12-18 18:39:21'),
(6, 'APPS', 'Suyash', '9167988239', 'def', 'Maharashtra', 'Mumbai', 'Not Sent', '2018-12-18 18:39:21'),
(7, 'APS', 'Urvi ', '9833798227', 'ghi', 'Maharashtra', 'Mumbai', 'Not Sent', '2018-12-18 18:39:21'),
(8, 'SSVP', 'Ankush 1', '8118878963', 'jkl', 'Rajasthan', 'Kota', 'Not Sent', '2018-12-18 18:39:21');

-- --------------------------------------------------------

--
-- Table structure for table `submission_feedback`
--

CREATE TABLE `submission_feedback` (
  `sno` int(11) NOT NULL,
  `cc_id` varchar(20) NOT NULL,
  `student_id` varchar(20) NOT NULL,
  `submission_id` varchar(20) NOT NULL,
  `remark` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `submission_feedback`
--

INSERT INTO `submission_feedback` (`sno`, `cc_id`, `student_id`, `submission_id`, `remark`) VALUES
(1, 'student_2', '', 'sub_1', 'HEY That\'s pretty gooooood'),
(3, 'cc_1', '', 'sub_2', 'HEYY GOOD JOB ! Nigga'),
(4, 'cc_1', '', 'subm_4', 'AHaaaa !'),
(8, '', '', 'subm_5', '123'),
(9, 'student_2', '', 'subm_7', 'HEY better luck next time'),
(10, 'student_2', '', 'sub_5', 'umm');

-- --------------------------------------------------------

--
-- Table structure for table `topic`
--

CREATE TABLE `topic` (
  `sno` int(11) NOT NULL,
  `club_id` varchar(20) NOT NULL,
  `topic_id` varchar(20) NOT NULL,
  `topic_name` varchar(100) NOT NULL,
  `topic_desc` text NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `topic`
--

INSERT INTO `topic` (`sno`, `club_id`, `topic_id`, `topic_name`, `topic_desc`, `start_date`, `end_date`, `date`, `status`) VALUES
(2, 'club_21', 'tp_92', 'Internet of Things', 'Internet of Things (IOT) - Explore how scientists across the world are working towards connecting every part of your house', '2018-10-01', '2019-02-28', '2018-10-16 14:48:59', 1),
(3, 'club_web', 'tp_3', 'Big Data', 'Big Data Details', '2018-11-01', '2019-01-01', '2018-10-16 14:49:27', 1),
(4, 'club_app', 'tp_4', 'Old Topic', 'asdasdasdasd', '2018-09-01', '2019-01-23', '2018-10-16 14:49:27', 1),
(5, 'club_app', 'tp_5', 'Next to Next Month Theme', 'aaaaaaaaa', '2018-12-01', '2018-12-01', '2018-10-16 16:05:06', 1),
(6, 'club_app', 'tp_6', 'NEW app topic next month', 'NEW app topic next month', '2018-12-01', '2018-12-01', '2018-10-16 14:49:27', 1),
(7, 'club_web', 'tp_7', 'Big Data 2', 'Big Data Details 2', '2018-12-01', '2018-11-07', '2018-10-16 14:49:27', 1);

-- --------------------------------------------------------

--
-- Table structure for table `topic_download`
--

CREATE TABLE `topic_download` (
  `sno` int(11) NOT NULL,
  `topic_id` varchar(20) NOT NULL,
  `title` varchar(100) NOT NULL,
  `link` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `topic_download`
--

INSERT INTO `topic_download` (`sno`, `topic_id`, `title`, `link`) VALUES
(4, 'tp_2', 'Downlaod A', 'https://www.youtube.com/watch?v=SnqPJv0UqKo&index=14&list=PL8CB7943AB56938F8'),
(5, 'tp_2', 'Downlaod B', 'https://www.youtube.com/watch?v=SnqPJv0UqKo&index=14&list=PL8CB7943AB56938F8'),
(8, 'tp_2', 'Downlaod C', 'https://www.youtube.com/watch?v=SnqPJv0UqKo&index=14&list=PL8CB7943AB56938F8'),
(9, 'tp_2', 'Downlaod D', 'https://www.youtube.com/watch?v=SnqPJv0UqKo&index=14&list=PL8CB7943AB56938F8');

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `sno` int(11) NOT NULL,
  `vendor_id` varchar(20) NOT NULL,
  `vendor_name` varchar(100) NOT NULL,
  `vendor_icon` varchar(100) NOT NULL,
  `vendor_description` text NOT NULL,
  `formation_year` date NOT NULL,
  `permanent_address` text NOT NULL,
  `country` varchar(100) NOT NULL,
  `vendor_added_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`sno`, `vendor_id`, `vendor_name`, `vendor_icon`, `vendor_description`, `formation_year`, `permanent_address`, `country`, `vendor_added_date`) VALUES
(1, 'inst_1', 'Kiran Nambiar', 'Kiran Nambiar_1996-07-04_11.jpg', 'Web App Gameasdasd', '1996-07-04', 'Mumbai sadsa', 'in', '2018-08-20 12:06:00'),
(2, 'inst_2', 'B', 'Kiran Nambiar 1_1996-07-04_20.jpg', 'bbbbbb', '2018-08-01', 'B', 'in', '2018-08-20 12:09:42'),
(3, 'inst_3', 'C', 'C_2018-08-01_19.jpg', 'bbbbbb', '2018-08-01', 'B', 'in', '2018-08-20 13:05:53'),
(4, 'inst_4', 'Kiran Nambiar', 'Kiran Nambiar_1996-07-09_95.jpg', 'sfsdf', '1996-07-09', 'sdf', 'in', '2018-08-20 13:24:35'),
(5, 'inst_5', 'Kiran Nambiarasdasd', 'Kiran Nambiarasdasd_1996-07-09_17.jpg', 'sfsdfasdasd', '1996-07-09', 'sdfasda', 'in', '2018-08-20 13:24:43'),
(6, 'inst_6', 'Kiran Nambiar 1', 'Kiran Nambiar 1_2018-08-02_95.jpg', 'asd', '2018-08-02', 'asd', 'in', '2018-08-20 13:48:39'),
(7, 'inst_7', 'adasds', 'adasds_2018-08-09_21.jpg', 'asdad', '2018-08-09', 'asdad', 'in', '2018-08-22 12:45:03'),
(8, 'TEST 1', 'asd', 'asd', 'asd', '2018-08-15', 'asda', 'asd', '2018-08-22 16:55:38'),
(9, 'inst_9', 'asas', 'asas_1996-07-09_22.jpg', 'asas', '1996-07-09', 'asas', 'in', '2018-09-18 13:16:31');

-- --------------------------------------------------------

--
-- Table structure for table `video`
--

CREATE TABLE `video` (
  `sno` int(11) NOT NULL,
  `club_id` varchar(20) NOT NULL,
  `video_id` varchar(20) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description_line` text NOT NULL,
  `description_detail` text NOT NULL,
  `duration` time NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `time_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `mrp_price` int(11) NOT NULL,
  `learning` text NOT NULL,
  `vendor_id` varchar(20) NOT NULL,
  `video_file` varchar(20) NOT NULL,
  `class_applicable_for` text NOT NULL,
  `subscription_level` varchar(20) NOT NULL,
  `school_price` int(11) NOT NULL,
  `link` varchar(100) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `topic_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `video`
--

INSERT INTO `video` (`sno`, `club_id`, `video_id`, `title`, `description_line`, `description_detail`, `duration`, `date_added`, `time_added`, `mrp_price`, `learning`, `vendor_id`, `video_file`, `class_applicable_for`, `subscription_level`, `school_price`, `link`, `status`, `topic_id`) VALUES
(1, 'club_web', 'vid_1', 'udpated', '<p>udpated</p>\r\n', '', '02:00:00', '2018-08-27 13:05:09', '2018-08-27 13:05:09', 5000, '<p>udpated</p>\r\n', 'inst_2', '', '6,7,8,9,10,11,12', 'platinum', 2000, 'asdasd', 1, 'tp_2'),
(2, 'club_app', 'vid_2', 'abasd', '<p>asdasd</p>\r\n', '', '01:00:00', '2018-08-27 13:05:54', '2018-08-27 13:05:54', 234234, '<p>234asd</p>\r\n', 'inst_1', 'small.mp4', '', '', 0, '', 1, ''),
(3, 'club_maths', 'vid_3', 'a', '<p>a</p>\r\n', '', '00:00:01', '2018-08-27 13:06:57', '2018-08-27 13:06:57', 2344, '<p>a</p>\r\n', 'inst_1', 'a_56.mp4', '', '', 0, '', 1, ''),
(4, 'club_science', 'vid_4', 'ad', '<p>a</p>\r\n', '', '01:00:00', '2018-08-30 18:31:12', '2018-08-30 18:31:12', 234, '<p>a</p>\r\n', 'inst_1', '', '', '', 0, '', 1, ''),
(5, 'club_app', 'vid_5', 'q', '<p>q</p>\r\n', '', '01:00:00', '2018-08-30 18:36:17', '2018-08-30 18:36:17', 123, '<p>q</p>\r\n', 'inst_1', 'small.mp4', '', '', 0, '', 1, ''),
(6, 'club_web', 'vid_6', 'sd', '<p>sd</p>\r\n', '', '01:12:00', '2018-08-30 18:36:30', '2018-08-30 18:36:30', 1000, '<p>sd</p>\r\n', 'inst_1', 'small.mp4', '11,12', 'silver', 500, '', 1, ''),
(7, 'club_app', 'vid_7', 'video title updated', '<p>video description updated</p>\r\n', '', '01:00:00', '2018-09-03 12:51:22', '2018-09-03 12:51:22', 1234, '<p>video updated</p>\r\n', 'inst_1', '', '', '', 0, 'https://www.youtube.com/embed/YE7VzlLtp-4', 1, ''),
(8, 'club_app', 'vid_8', 'demo 1', '<p>demo 1</p>\r\n', '', '02:45:00', '2018-09-05 11:33:28', '2018-09-05 11:33:28', 100, '<p>demo 1</p>\r\n', 'inst_1', '', '', '', 0, 'https://www.youtube.com/embed/YE7VzlLtp-4', 1, ''),
(9, 'club_app', 'vid_9', 'demo 2', '<p>demo</p>\r\n', '', '01:00:00', '2018-09-05 11:34:02', '2018-09-05 11:34:02', 123, '<p>demo</p>\r\n', 'inst_2', 'small.mp4', '', '', 0, '', 1, ''),
(10, 'club_web', 'vid_10', 'testvideo', '<p>testvideo</p>\r\n', '', '01:00:00', '2018-09-11 17:58:09', '2018-09-11 17:58:09', 123, '<p>testvideo</p>\r\n', 'inst_3', '', '6,7,8,9,10,11,12', 'platinum', 0, 'https://www.youtube.com/embed/YE7VzlLtp-4', 0, ''),
(25, 'club_web', 'vid_25', 'DEMO1', '<p>DEMO1</p>\r\n', '', '02:30:00', '2018-09-24 12:34:16', '2018-09-24 12:34:16', 123, '<p>DEMO1</p>\r\n', 'inst_1', '', '11,12', 'gold', 456, 'https://www.youtube.com/embed/YE7VzlLtp-4', 0, ''),
(26, 'club_web', 'vid_26', 'DEMO2', '<p>DEMO1</p>\r\n', '', '02:30:00', '2018-09-24 12:35:07', '2018-09-24 12:35:07', 123, '<p>DEMO1</p>\r\n', 'inst_1', 'small.mp4', '11,12', 'gold', 456, '', 0, ''),
(27, 'club_web', 'vid_27', 'asd', '<p>asd</p>\r\n', '', '01:00:00', '2018-09-26 11:33:09', '2018-09-26 11:33:09', 123, '<p>asd</p>\r\n', 'inst_1', '', '12', 'gold', 12, 'asd', 0, ''),
(28, 'club_web', 'vid_28', 'asda12', '<p>asd</p>\r\n', '', '01:00:00', '2018-09-26 11:33:46', '2018-09-26 11:33:46', 2134, '<p>asd</p>\r\n', 'inst_1', '', '11,12', 'gold', 234, 'asd', 0, ''),
(29, 'club_web', 'vid_29', 'asda12asd', '<p>asd</p>\r\n', '', '01:00:00', '2018-09-26 11:33:57', '2018-09-26 11:33:57', 2134, '<p>asd</p>\r\n', 'inst_1', '', '11,12', 'gold', 234, 'asd', 0, ''),
(30, 'club_web', 'vid_30', 'asd123123', '<p>asd</p>\r\n', '', '01:00:00', '2018-09-26 12:30:46', '2018-09-26 12:30:46', 234, '<p>asd</p>\r\n', 'inst_1', '', '11', 'gold', 234, 'asd', 0, ''),
(31, 'club_web', 'vid_31', 'asd123123asd', '<p>asd</p>\r\n', '', '01:00:00', '2018-09-26 12:31:15', '2018-09-26 12:31:15', 234, '<p>asd</p>\r\n', 'inst_1', '', '11', 'gold', 234, 'asd', 0, ''),
(32, 'club_web', 'vid_32', 'asd65', '<p>asd</p>\r\n', '', '01:00:00', '2018-09-26 12:32:54', '2018-09-26 12:32:54', 123, '<p>asd</p>\r\n', 'inst_1', '', '11', 'gold', 123, 'asd', 0, ''),
(33, 'club_web', 'vid_33', 'asd6523', '<p>asd</p>\r\n', '', '01:00:00', '2018-09-26 12:35:47', '2018-09-26 12:35:47', 123, '<p>asd</p>\r\n', 'inst_1', '', '11', 'gold', 123, 'asd', 0, ''),
(34, 'club_web', 'vid_34', 'asd476675', '<p>asdasd</p>\r\n', '', '22:22:33', '2018-09-26 12:36:14', '2018-09-26 12:36:14', 234, '<p>asd</p>\r\n', 'inst_1', '', '12', 'gold', 234, 'asd', 0, ''),
(35, 'club_web', 'vid_35', 'asda3242', '<p>asd</p>\r\n', '', '01:00:00', '2018-09-26 12:36:41', '2018-09-26 12:36:41', 234, '<p>asd</p>\r\n', 'inst_1', '', '11', 'platinum', 234, 'asd', 0, ''),
(36, 'club_web', 'vid_36', 'asdasdasddd', '<p>asdasdasd</p>\r\n', '', '01:00:00', '2018-09-26 12:37:45', '2018-09-26 12:37:45', 123, '<p>asd</p>\r\n', 'inst_1', '', '11', 'gold', 123, 'asd', 0, ''),
(37, 'club_web', 'vid_37', 'asd23rfwe', '<p>sdf</p>\r\n', '', '01:00:00', '2018-09-26 12:40:57', '2018-09-26 12:40:57', 43, '<p>asd</p>\r\n', 'inst_1', '', '11', 'platinum', 234, 'asd', 0, ''),
(38, 'club_web', 'vid_38', 'asd23ed3', '<p>asd</p>\r\n', '', '01:00:00', '2018-09-26 12:43:28', '2018-09-26 12:43:28', 234, '<p>asd</p>\r\n', 'inst_1', '', '11', 'platinum', 234, 'asd', 0, ''),
(39, 'club_web', 'vid_39', 'asdasdasd32', '<p>asd</p>\r\n', '', '01:00:00', '2018-09-26 12:45:11', '2018-09-26 12:45:11', 234, '<p>asd</p>\r\n', 'inst_1', '', '11', 'platinum', 234, 'asda', 0, ''),
(40, 'club_web', 'vid_40', 'asdasdasd32asd', '<p>asd</p>\r\n', '', '01:00:00', '2018-08-14 12:45:58', '2018-09-26 12:45:58', 234, '<p>asd</p>\r\n', 'inst_1', '', '11', 'platinum', 234, 'asda', 1, ''),
(41, 'club_web', 'vid_41', 'IOT video 6', 'Tech Channel India', '', '01:00:00', '2018-09-20 12:46:18', '2018-09-26 12:46:18', 234, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis fermentum vel justo id faucibus. Praesent congue est odio, et vestibulum ex mollis et. Sed eu augue tempor, iaculis dolor ut, lobortis odio. Suspendisse consectetur tristique mi at aliquet. Etiam auctor suscipit sapien, sed sodales mi accumsan dignissim. Duis dapibus vehicula lacus quis volutpat. Nulla consectetur ut mi sit amet feugiat. In hac habitasse platea dictumst. In venenatis, quam sed pretium rutrum, odio est efficitur purus, et ornare massa nulla quis enim. Suspendisse eget venenatis nunc, ac dapibus lectus. Duis quis ligula nulla. Duis malesuada metus et accumsan venenatis. Sed porttitor diam sed eros fermentum, a dignissim purus porta. Morbi ullamcorper magna in ipsum volutpat suscipit. In laoreet sapien sem, ac condimentum diam tempus nec. Cras consectetur arcu vitae magna placerat maximus.</p>', 'inst_1', '', '11', 'platinum', 234, 'asda', 1, 'tp_2'),
(42, 'club_web', 'vid_42', 'IOT video 5', 'Tech Guy', '', '01:01:11', '2018-09-23 00:00:00', '2018-09-26 12:47:18', 234, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis fermentum vel justo id faucibus. Praesent congue est odio, et vestibulum ex mollis et. Sed eu augue tempor, iaculis dolor ut, lobortis odio. Suspendisse consectetur tristique mi at aliquet. Etiam auctor suscipit sapien, sed sodales mi accumsan dignissim. Duis dapibus vehicula lacus quis volutpat. Nulla consectetur ut mi sit amet feugiat. In hac habitasse platea dictumst. In venenatis, quam sed pretium rutrum, odio est efficitur purus, et ornare massa nulla quis enim. Suspendisse eget venenatis nunc, ac dapibus lectus. Duis quis ligula nulla. Duis malesuada metus et accumsan venenatis. Sed porttitor diam sed eros fermentum, a dignissim purus porta. Morbi ullamcorper magna in ipsum volutpat suscipit. In laoreet sapien sem, ac condimentum diam tempus nec. Cras consectetur arcu vitae magna placerat maximus.</p>', 'inst_1', '', '11', 'platinum', 234, 'https://www.youtube.com/embed/KhzGSHNhnbI', 1, 'tp_2'),
(43, 'club_web', 'vid_43', 'IOT video 4', 'Traversy Media', '', '00:09:56', '2018-09-24 00:00:00', '2018-09-26 12:47:54', 234, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis fermentum vel justo id faucibus. Praesent congue est odio, et vestibulum ex mollis et. Sed eu augue tempor, iaculis dolor ut, lobortis odio. Suspendisse consectetur tristique mi at aliquet. Etiam auctor suscipit sapien, sed sodales mi accumsan dignissim. Duis dapibus vehicula lacus quis volutpat. Nulla consectetur ut mi sit amet feugiat. In hac habitasse platea dictumst. In venenatis, quam sed pretium rutrum, odio est efficitur purus, et ornare massa nulla quis enim. Suspendisse eget venenatis nunc, ac dapibus lectus. Duis quis ligula nulla. Duis malesuada metus et accumsan venenatis. Sed porttitor diam sed eros fermentum, a dignissim purus porta. Morbi ullamcorper magna in ipsum volutpat suscipit. In laoreet sapien sem, ac condimentum diam tempus nec. Cras consectetur arcu vitae magna placerat maximus.</p>', 'inst_1', '', '11', 'platinum', 123, 'https://www.youtube.com/embed/YE7VzlLtp-4', 1, 'tp_2'),
(44, 'club_web', 'vid_44', 'IOT video 3', 'Marques Brownlee', '', '00:00:05', '2018-09-25 00:00:00', '2018-09-26 12:49:09', 234, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis fermentum vel justo id faucibus. Praesent congue est odio, et vestibulum ex mollis et. Sed eu augue tempor, iaculis dolor ut, lobortis odio. Suspendisse consectetur tristique mi at aliquet. Etiam auctor suscipit sapien, sed sodales mi accumsan dignissim. Duis dapibus vehicula lacus quis volutpat. Nulla consectetur ut mi sit amet feugiat. In hac habitasse platea dictumst. In venenatis, quam sed pretium rutrum, odio est efficitur purus, et ornare massa nulla quis enim. Suspendisse eget venenatis nunc, ac dapibus lectus. Duis quis ligula nulla. Duis malesuada metus et accumsan venenatis. Sed porttitor diam sed eros fermentum, a dignissim purus porta. Morbi ullamcorper magna in ipsum volutpat suscipit. In laoreet sapien sem, ac condimentum diam tempus nec. Cras consectetur arcu vitae magna placerat maximus.</p>', 'inst_1', 'small.mp4', '12', 'gold', 234, '', 1, 'tp_2'),
(45, 'club_web', 'vid_45', 'IOT video 2', '<p>Casey Neistat</p>\r\n', '', '00:09:56', '2018-09-26 12:49:31', '2018-09-26 12:49:31', 123, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis fermentum vel justo id faucibus. Praesent congue est odio, et vestibulum ex mollis et. Sed eu augue tempor, iaculis dolor ut, lobortis odio. Suspendisse consectetur tristique mi at aliquet. Etiam auctor suscipit sapien, sed sodales mi accumsan dignissim. Duis dapibus vehicula lacus quis volutpat. Nulla consectetur ut mi sit amet feugiat. In hac habitasse platea dictumst. In venenatis, quam sed pretium rutrum, odio est efficitur purus, et ornare massa nulla quis enim. Suspendisse eget venenatis nunc, ac dapibus lectus. Duis quis ligula nulla. Duis malesuada metus et accumsan venenatis. Sed porttitor diam sed eros fermentum, a dignissim purus porta. Morbi ullamcorper magna in ipsum volutpat suscipit. In laoreet sapien sem, ac condimentum diam tempus nec. Cras consectetur arcu vitae magna placerat maximus.</p>\r\n', 'inst_1', '', '10', 'gold', 123, 'https://www.youtube.com/embed/YE7VzlLtp-4', 1, 'tp_2'),
(46, 'club_web', 'vid_46', 'IOT video 1', 'Linus tech Tips', '', '00:00:05', '2018-10-11 11:53:57', '2018-10-11 11:53:57', 1500, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis fermentum vel justo id faucibus. Praesent congue est odio, et vestibulum ex mollis et. Sed eu augue tempor, iaculis dolor ut, lobortis odio. Suspendisse consectetur tristique mi at aliquet. Etiam auctor suscipit sapien, sed sodales mi accumsan dignissim. Duis dapibus vehicula lacus quis volutpat. Nulla consectetur ut mi sit amet feugiat. In hac habitasse platea dictumst. In venenatis, quam sed pretium rutrum, odio est efficitur purus, et ornare massa nulla quis enim. Suspendisse eget venenatis nunc, ac dapibus lectus. Duis quis ligula nulla. Duis malesuada metus et accumsan venenatis. Sed porttitor diam sed eros fermentum, a dignissim purus porta. Morbi ullamcorper magna in ipsum volutpat suscipit. In laoreet sapien sem, ac condimentum diam tempus nec. Cras consectetur arcu vitae magna placerat maximus.</p>', 'inst_1', 'small.mp4', '7,8,9,10', 'gold', 1000, '', 1, 'tp_2'),
(47, 'club_web', 'vid_47', 'testingoct23', '<p>testingoct23</p>\r\n', '', '01:30:00', '2018-10-23 16:17:07', '2018-10-23 16:17:07', 100, '<p>testingoct23</p>\r\n', 'inst_2', 'linkk', '6,7', 'gold', 200, 'linked', 1, 'tp_4');

-- --------------------------------------------------------

--
-- Table structure for table `webinar`
--

CREATE TABLE `webinar` (
  `sno` int(11) NOT NULL,
  `club_id` varchar(20) NOT NULL,
  `webinar_id` varchar(20) NOT NULL,
  `title` varchar(100) NOT NULL,
  `speaker` varchar(100) NOT NULL,
  `speaker_desc` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `duration` time NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `mrp_price` int(11) NOT NULL,
  `time_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `vendor_id` varchar(20) DEFAULT NULL,
  `learning` text NOT NULL,
  `class_applicable_for` text NOT NULL,
  `subscription_level` varchar(20) NOT NULL,
  `school_price` int(11) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `status` int(11) NOT NULL,
  `topic_id` varchar(20) NOT NULL,
  `image` varchar(20) NOT NULL,
  `speaker_img` varchar(20) NOT NULL,
  `link` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `webinar`
--

INSERT INTO `webinar` (`sno`, `club_id`, `webinar_id`, `title`, `speaker`, `speaker_desc`, `description`, `duration`, `date`, `time`, `mrp_price`, `time_added`, `date_added`, `vendor_id`, `learning`, `class_applicable_for`, `subscription_level`, `school_price`, `start_time`, `end_time`, `status`, `topic_id`, `image`, `speaker_img`, `link`) VALUES
(1, 'club_app', 'web_1', 'App Developement', 'Kiran Nambiar', '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '05:13:00', '2018-08-11', '05:30:00', 1000, '2018-08-25 12:44:59', '2018-08-25 12:44:59', 'inst_1', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '6,7', 'gold', 500, '00:00:00', '00:00:00', 0, '', '', '', ''),
(5, 'club_app', 'web_5', 'Title 1', 'speaker 1', '', '<p>description 1</p>\r\n', '01:20:00', '2018-08-17', '12:29:00', 1232, '2018-08-25 14:03:30', '2018-08-25 14:03:30', 'inst_2', '<p>learning 1</p>\r\n', '', '', 0, '00:00:00', '00:00:00', 0, '', '', '', ''),
(6, 'club_app', 'web_6', 'aaa', 'aaa', '', '<p>aaa</p>\r\n', '01:00:00', '2018-08-21', '13:03:00', 123, '2018-08-30 18:44:03', '2018-08-30 18:44:03', 'inst_1', '<p>aaa</p>\r\n', '', '', 0, '00:00:00', '00:00:00', 0, '', '', '', ''),
(7, 'club_app', 'web_7', 'qqqq', 'qqqq', '', '<p>qqqq</p>\r\n', '01:30:00', '2018-08-23', '13:03:00', 123, '2018-08-30 18:44:49', '2018-08-30 18:44:49', 'inst_1', '<p>qqqq</p>\r\n', '', '', 0, '00:00:00', '00:00:00', 0, '', '', '', ''),
(8, 'club_web', 'web_8', 'asdasd', 'asd', '', '<p>asdasd</p>\r\n', '01:00:00', '2018-08-23', '02:03:00', 324234, '2018-08-31 16:16:02', '2018-08-31 16:16:02', 'inst_1', '<p>asdasd</p>\r\n', '', '', 0, '00:00:00', '00:00:00', 0, '', '', '', ''),
(9, 'club_web', 'web_9', 'asdasdasdasd', 'asd', '', '<p>asdasd</p>\r\n', '01:00:00', '2018-08-23', '02:03:00', 324234, '2018-08-31 16:16:22', '2018-08-31 16:16:22', 'inst_1', '<p>asdasd</p>\r\n', '', '', 0, '00:00:00', '00:00:00', 0, '', '', '', ''),
(10, 'club_web', 'web_10', 'asdasdasd', 'asd', '', '<p>asdasd</p>\r\n', '01:00:00', '0000-00-00', '02:34:00', 234, '2018-08-31 16:22:01', '2018-08-31 16:22:01', 'inst_1', '<p>asdasd</p>\r\n', '', '', 0, '00:00:00', '00:00:00', 1, 'tp_2', '', '', ''),
(11, 'club_web', 'web_11', 'AAAAAAAAAAAAAAA', 'asd', '', '<p>AAAAAAAAA</p>\r\n', '01:00:00', '2018-08-03', '02:34:00', 4324, '2018-08-31 16:29:20', '2018-08-31 16:29:20', 'inst_1', '<p>AAAAAAAAAAAA</p>\r\n', '', '', 0, '00:00:00', '00:00:00', 1, 'tp_2', '', '', ''),
(12, 'club_web', 'web_12', 'AAAAAAAAAAAAAAAsdf', 'asd', '', '<p>AAAAAAAAA</p>\r\n', '01:00:00', '2018-08-03', '02:34:00', 4324, '2018-08-31 17:06:21', '2018-08-31 17:06:21', 'inst_1', '<p>AAAAAAAAAAAA</p>\r\n', '', '', 0, '00:00:00', '00:00:00', 1, 'tp_2', '', '', ''),
(13, 'club_web', 'web_13', 'BBBBBBBBBBB', 'BBBBBBB', '', '<p>BBBBBBBBBBB</p>\r\n', '01:00:00', '2018-08-01', '01:01:00', 123, '2018-08-31 17:59:49', '2018-08-31 17:59:49', 'inst_1', '<p>VBBBBBBBBBBB</p>\r\n', '', '', 0, '00:00:00', '00:00:00', 1, 'tp_2', '', '', ''),
(14, 'club_web', 'web_14', 'webinar updated', 'webinar updated', '', '<p>webinar updated</p>\r\n', '01:00:00', '2018-10-03', '12:48:00', 1234, '2018-09-03 12:48:34', '2018-09-03 12:48:34', 'inst_1', '<p>webinar updated</p>\r\n', '', '', 0, '08:30:00', '20:00:00', 1, 'tp_2', '', '', ''),
(15, 'club_web', '', '', '', '', '', '00:00:00', '0000-00-00', '00:00:00', 0, '2018-09-03 14:20:09', '2018-09-03 14:20:09', NULL, '', '', '', 0, '00:00:00', '00:00:00', 0, '', '', '', ''),
(16, 'club_web', '', '', '', '', '', '00:00:00', '0000-00-00', '00:00:00', 0, '2018-09-03 14:20:42', '2018-09-03 14:20:42', NULL, '', '', '', 0, '00:00:00', '00:00:00', 0, '', '', '', ''),
(17, 'club_app', 'web_17', 'updated', 'updated', '', '<p>updated</p>\r\n', '03:25:00', '2018-09-26', '00:12:00', 1000, '2018-09-11 18:04:36', '2018-09-11 18:04:36', 'inst_1', '<p>updated</p>\r\n', '6,7,8,9,10', 'gold', 1000, '09:30:00', '21:00:00', 0, 'tp_5', '', '', ''),
(18, 'club_app', 'web_18', 'testweb', 'testweb', '', '<p>testweb</p>\r\n', '22:22:00', '2018-09-27', '00:00:00', 1000, '2018-09-26 10:04:00', '2018-09-26 10:04:00', 'inst_1', '<p>testweb</p>\r\n', '11', 'platinum', 1000, '10:30:00', '13:03:00', 0, '', '', '', ''),
(19, 'club_app', 'web_19', 'testwebs', 'testweb', '', '<p>testweb</p>\r\n', '22:22:33', '2018-09-12', '00:00:00', 123, '2018-09-26 10:08:19', '2018-09-26 10:08:19', 'inst_1', '<p>testweb</p>\r\n', '', '', 456, '10:30:00', '12:30:00', 0, '', '', '', ''),
(20, 'club_app', 'web_20', 'asd', 'asd', '', '<p>asd</p>\r\n', '22:22:33', '2018-09-20', '00:00:00', 123, '2018-09-26 10:20:41', '2018-09-26 10:20:41', 'inst_1', '<p>asd</p>\r\n', '11', '', 123, '10:30:00', '10:30:00', 0, '', '', '', ''),
(21, 'club_app', 'web_21', 'ddfg', 'asd', '', '<p>asd</p>\r\n', '00:00:00', '2018-09-20', '00:00:00', 1111, '2018-09-26 10:54:20', '2018-09-26 10:54:20', 'inst_1', '<p>asd</p>\r\n', '11', '', 1111, '11:11:00', '11:11:00', 0, '', '', '', ''),
(22, 'club_app', 'web_22', 'testingoct11', 'Kiran', '', '<p>testingoct11desc</p>\r\n', '12:00:00', '2018-10-12', '00:00:00', 1000, '2018-10-11 11:58:59', '2018-10-11 11:58:59', 'inst_1', '<p>testingoct11</p>\r\n', '7,8,9,10', 'gold', 800, '10:30:00', '13:30:00', 1, '', '', '', ''),
(24, 'club_web', 'web_24', 'Machine Learning for Beginners and Careers', 'Kiran Nambiar', 'Developer @ Domain E', '<p>This is a very informative webinar and I am going to teach you a lot of things</p>\r\n', '01:30:00', '2018-10-31', '00:00:00', 1000, '2018-10-29 14:31:14', '2018-10-29 14:31:14', 'inst_1', '<p>Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum </p>\r\n', '7,8', 'gold', 1000, '10:30:00', '13:30:00', 1, 'tp_2', 'webinar.png', 'avatar.png', '&*&kjbdwefbwehriuy3478yr98r823roh&Y*&^&*OUYFIYTYJBNHJLUGLLGYIUGYIUOUIYGIU*)YUI*UH');

-- --------------------------------------------------------

--
-- Table structure for table `webinar_attendance`
--

CREATE TABLE `webinar_attendance` (
  `sno` int(11) NOT NULL,
  `web_id` varchar(20) NOT NULL,
  `id` varchar(20) NOT NULL,
  `status` varchar(10) NOT NULL,
  `type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `webinar_schedule`
--

CREATE TABLE `webinar_schedule` (
  `sno` int(11) NOT NULL,
  `web_id` varchar(20) NOT NULL,
  `title` varchar(100) NOT NULL,
  `price` tinyint(4) NOT NULL,
  `type` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `url` text NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `duration` int(11) NOT NULL,
  `status` varchar(15) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `webinar_schedule`
--

INSERT INTO `webinar_schedule` (`sno`, `web_id`, `title`, `price`, `type`, `username`, `password`, `email`, `description`, `url`, `date`, `time`, `duration`, `status`, `datetime`) VALUES
(1, 'web_1', 'Vision Syncing Webinar 2', 0, 's2', '', '', '', 'Vision Syncing and Queries', 'www.sudopower.com', '2019-03-20', '14:04:00', 1, 'active', '2019-02-27 10:52:33'),
(2, 'web_2', 'Vision Syncing Webinar 2', 0, 's2', '', '', '', 'Vision Syncing and Queries', 'www.sudopower.com', '2019-03-04', '12:34:00', 1, 'active', '2019-02-27 10:53:05'),
(3, 'web_2', 'Vision Syncing Webinar 2', 0, 's2', '', '', '', 'Vision Syncing and Queries', 'www.sudopower.com', '2019-03-04', '12:34:00', 1, 'active', '2019-02-27 10:53:05'),
(4, 'web_4', 'Vision Syncing Webinar 2', 0, 's2', '', '', '', 'Vision Syncing and Queries', 'www.sudopower.com', '2019-03-04', '12:34:00', 1, 'active', '2019-03-02 16:04:06'),
(5, 'web_5', 'Vision Syncing Webinar 2', 0, 's2', '', '', '', 'Vision Syncing and Queries', 'www.sudopower.com', '2019-03-04', '12:34:00', 1, 'active', '2019-03-02 16:04:43'),
(6, 'web_6', 'Vision Syncing Webinar 2', 0, 's2', '', '', '', 'Vision Syncing and Queries', 'www.sudopower.com', '2019-03-04', '12:34:00', 1, 'active', '2019-03-04 12:20:30'),
(7, 'web_7', 'Vision Syncing Webinar 2', 0, 's2', '', '', '', 'Vision Syncing and Queries', 'www.sudopower.com', '2019-03-20', '14:22:00', 1, 'active', '2019-03-04 12:31:47'),
(8, 'web_8', 'Vision Syncing Webinar 2', 0, 's2', '', '', '', 'Vision Syncing and Queries', 'www.sudopower.com', '2019-03-04', '16:22:00', 1, 'active', '2019-03-04 12:34:37'),
(9, 'web_9', 'Club Managers Session Stage 4 Webinar', 0, 's4', '', '', '', 'Vision Syncing and Queries', 'http://tlcuniversal.com/contact', '2019-03-04', '16:07:00', 1, 'active', '2019-03-04 12:38:25'),
(10, 'web_10', 'Vision Syncing Webinar 3', 0, 's2', '', '', '', 'Vision Syncing and Queries', 'www.sudopower.com', '2019-03-04', '10:11:00', 1, 'active', '2019-03-04 12:34:37');

-- --------------------------------------------------------

--
-- Table structure for table `workshop`
--

CREATE TABLE `workshop` (
  `sno` int(11) NOT NULL,
  `club_id` varchar(20) NOT NULL,
  `workshop_id` varchar(20) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description_line` text NOT NULL,
  `no_of_classes` int(11) NOT NULL,
  `mrp_price` int(11) NOT NULL,
  `class_applicable_for` text NOT NULL,
  `subscription_level` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `primary_image` varchar(100) DEFAULT NULL,
  `secondary_image` varchar(100) DEFAULT NULL,
  `course_icon` varchar(100) DEFAULT NULL,
  `time_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `learning` text NOT NULL,
  `prerequisites` text NOT NULL,
  `vendor_id` varchar(20) DEFAULT NULL,
  `school_price` int(11) NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `duration` int(11) NOT NULL,
  `speaker` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `topic_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `workshop`
--

INSERT INTO `workshop` (`sno`, `club_id`, `workshop_id`, `title`, `description_line`, `no_of_classes`, `mrp_price`, `class_applicable_for`, `subscription_level`, `description`, `primary_image`, `secondary_image`, `course_icon`, `time_added`, `date_added`, `learning`, `prerequisites`, `vendor_id`, `school_price`, `date`, `start_time`, `end_time`, `duration`, `speaker`, `status`, `topic_id`) VALUES
(1, 'club_web', 'work_0', 'asdasda', '<p>2342</p>\r\n', 234, 234, '6', '2', '', 'asdasda_29.png', 'asdasda_16.png', 'asdasda_87.png', '2018-08-25 17:13:45', '2018-08-25 17:13:45', '<p>234</p>\r\n', '<p>234</p>\r\n', 'inst_2', 0, '0000-00-00', '00:00:00', '00:00:00', 0, '', 0, ''),
(2, 'club_web', 'work_2', 'CCCC', '<p>sdfsdf</p>\r\n', 345, 1000, '6,7,8,9,10,12', 'silver', '', 'CCCC_78.png', 'AAAAAAA_23.png', 'CCCC_33.png', '2018-08-25 17:14:45', '2018-08-25 17:14:45', '<p>ergtferg</p>\r\n', '<p>ergtferg</p>\r\n', 'inst_7', 500, '2018-10-31', '10:30:00', '12:30:00', 1, '', 0, 'tp_2'),
(3, 'club_web', 'work_3', 'sdfsdfasdasd', '<p>sdfsdf</p>\r\n', 345, 45345, '6', '1', '', 'sdfsdfasdasd_39.png', 'sdfsdfasdasd_81.png', 'sdfsdfasdasd_72.png', '2018-08-25 17:14:52', '2018-08-25 17:14:52', '<p>3453tf</p>\r\n', '<p>ergtferg</p>\r\n', 'inst_1', 0, '0000-00-00', '00:00:00', '00:00:00', 0, '', 0, ''),
(4, 'club_web', 'work_4', 'BBBBBB', '<p>asdasdasd</p>\r\n', 45, 345, '6', '1', '', 'BBBBBB_33.png', 'BBBBBB_58.png', 'BBBBBB_35.png', '2018-08-25 18:22:20', '2018-08-25 18:22:20', '<p>sfdsfe</p>\r\n', '<p>wsfwf</p>\r\n', 'inst_1', 0, '0000-00-00', '00:00:00', '00:00:00', 0, '', 0, ''),
(5, 'club_web', 'work_5', 'sdfss', '<p>sdfsdf</p>\r\n', 34, 43, '6', '1', '', 'sdfss_45.jpg', 'sdfss_11.jpg', 'sdfss_34.jpg', '2018-08-25 18:32:14', '2018-08-25 18:32:14', '<p>345345</p>\r\n', '<p>345345</p>\r\n', 'inst_1', 0, '0000-00-00', '00:00:00', '00:00:00', 0, '', 0, ''),
(6, 'club_web', 'work_6', 'asdasd', '<p>asdasd</p>\r\n', 234, 234, '5', '1', '', 'asdasd_99.png', 'asdasd_28.png', 'asdasd_24.png', '2018-08-27 10:34:45', '2018-08-27 10:34:45', '<p>fdsf</p>\r\n', '<p>345345</p>\r\n', 'inst_1', 0, '0000-00-00', '00:00:00', '00:00:00', 0, '', 0, ''),
(8, 'club_web', 'work_8', 'KIRAN', '<p>asdasd</p>\r\n', 234, 234, '5', '1', '', 'KIRAN_7.png', NULL, 'KIRAN_25.png', '2018-08-27 11:08:33', '2018-08-27 11:08:33', '<p>fdsf</p>\r\n', '<p>345345</p>\r\n', 'inst_1', 0, '0000-00-00', '00:00:00', '00:00:00', 0, '', 0, ''),
(9, 'club_web', 'work_9', 'AAAAAAAAAA', 'asdas', 23, 123, '1', '2', '', NULL, NULL, NULL, '2018-08-31 17:04:50', '2018-08-31 17:04:50', ' asdasd', ' asdasd', 'inst_1', 0, '0000-00-00', '00:00:00', '00:00:00', 0, '', 0, ''),
(10, 'club_web', 'work_10', 'AAAAAAAAAAj', 'asdas', 23, 123, '1', '2', '', 'AAAAAAAAAAj_44.png', 'AAAAAAAAAAj_24.png', 'AAAAAAAAAAj_10.png', '2018-08-31 17:05:39', '2018-08-31 17:05:39', ' asdasd', ' asdasd', 'inst_1', 0, '0000-00-00', '00:00:00', '00:00:00', 0, '', 0, ''),
(11, 'club_web', 'work_11', 'asdadasd', '<p>asdadasd</p>\r\n', 234, 234, '5', '2', '', 'asdadasd_75.png', 'asdadasd_39.png', 'asdadasd_36.png', '2018-08-31 17:19:50', '2018-08-31 17:19:50', '<p>234dwfsdf</p>\r\n', '<p>sdfsdf</p>\r\n', 'inst_1', 0, '0000-00-00', '00:00:00', '00:00:00', 0, '', 0, ''),
(12, 'club_web', 'work_12', 'workshop updated', '<p>workshop updated</p>\r\n', 12, 123, '7', '3', '', 'workshop updated_1.png', 'workshop updated_61.png', 'workshop updated_19.png', '2018-09-03 12:53:03', '2018-09-03 12:53:03', '<p>workshop updated</p>\r\n', '<p>workshop updated</p>\r\n', 'inst_2', 0, '0000-00-00', '00:00:00', '00:00:00', 0, '', 0, ''),
(13, 'club_app', 'work_13', 'testing workshop', '<p>testing workshop</p>\r\n', 12, 123, '2', '2', '', NULL, NULL, NULL, '2018-09-03 14:47:56', '2018-09-03 14:47:56', '<p>testing workshop</p>\r\n', '<p>testing workshop</p>\r\n', 'inst_1', 0, '0000-00-00', '00:00:00', '00:00:00', 0, '', 0, ''),
(19, 'club_app', 'work_19', 'test', '<p>test</p>\r\n', 10, 1000, '6,7,8,9,10,11,12', '1', '', '121350pm50.png', '121350pm40.png', '121350pm37.png', '2018-09-03 17:26:44', '2018-09-03 17:26:44', '<p>testas</p>\r\n', '<p>testas</p>\r\n', 'inst_1', 800, '2018-10-10', '00:00:00', '00:00:00', 3, 'Kiran', 0, ''),
(20, 'club_app', 'work_20', 'tetet', '<p>etetet</p>\r\n', 23, 123, '1', '3', '', NULL, NULL, NULL, '2018-09-05 13:42:14', '2018-09-05 13:42:14', '<p>sfasf</p>\r\n', '<p>asfasf</p>\r\n', 'inst_1', 0, '0000-00-00', '00:00:00', '00:00:00', 0, '', 0, ''),
(21, 'club_app', 'work_21', 'tetetawd', '<p>etetet</p>\r\n', 23, 123, '1', '3', '', '2018-09-05 10:15:16am.png', '2018-09-05 10:15:16am.png', '2018-09-05 10:15:16am.png', '2018-09-05 13:45:16', '2018-09-05 13:45:16', '<p>sfasf</p>\r\n', '<p>asfasf</p>\r\n', 'inst_1', 0, '0000-00-00', '00:00:00', '00:00:00', 0, '', 0, ''),
(22, 'club_app', 'work_22', 'tetetawdas', '<p>etetet</p>\r\n', 23, 123, '1', '3', '', '2018-09-0510:20:05am.png', '2018-09-0510:20:05am.png', '2018-09-0510:20:05am.png', '2018-09-05 13:50:05', '2018-09-05 13:50:05', '<p>sfasf</p>\r\n', '<p>asfasf</p>\r\n', 'inst_1', 0, '2018-09-20', '00:00:00', '00:00:00', 0, '', 0, ''),
(23, 'club_design', 'work_23', 'tetetawdasasd', '<p>etetet</p>\r\n', 23, 123, '1', '3', '', '2018-09-05.png', '2018-09-05.png', '2018-09-05.png', '2018-09-05 13:50:39', '2018-09-05 13:50:39', '<p>sfasf</p>\r\n', '<p>asfasf</p>\r\n', 'inst_1', 0, '0000-00-00', '00:00:00', '00:00:00', 0, '', 0, ''),
(24, 'club_maths', 'work_24', '123', '<p>etetet</p>\r\n', 23, 123, '1', '3', '', '2018-09-05.png', '2018-09-05.png', '2018-09-05.png', '2018-09-05 13:52:03', '2018-09-05 13:52:03', '<p>sfasf</p>\r\n', '<p>asfasf</p>\r\n', 'inst_1', 0, '0000-00-00', '00:00:00', '00:00:00', 0, '', 0, ''),
(25, 'club_science', 'work_25', 'asddd', '<p>etetet</p>\r\n', 23, 123, '1', '3', '', '20180905102344am.png', '20180905102344am.png', '20180905102344am.png', '2018-09-05 13:53:44', '2018-09-05 13:53:44', '<p>sfasf</p>\r\n', '<p>asfasf</p>\r\n', 'inst_1', 0, '0000-00-00', '00:00:00', '00:00:00', 0, '', 0, ''),
(26, 'club_science', 'work_26', 'asdasd2323', '<p>etetet</p>\r\n', 23, 123, '2', '1', '', '103155am22.png', '103155am75.png', '103155am29.png', '2018-09-05 13:55:16', '2018-09-05 13:55:16', '<p>asfasf</p>\r\n', '<p>asfasf</p>\r\n', 'inst_1', 0, '0000-00-00', '00:00:00', '00:00:00', 0, '', 0, ''),
(27, 'club_web', 'work_27', 'updated', '<p>updated</p>\r\n', 10, 1000, '6,7,8,9,10,11,12', 'platinum', '', NULL, NULL, NULL, '2018-09-11 18:13:04', '2018-09-11 18:13:04', '<p>updated</p>\r\n', '<p>updated</p>\r\n', 'inst_1', 1000, '2018-09-26', '09:00:00', '21:00:00', 10, '', 0, ''),
(28, 'club_web', 'work_28', 'asd', '<p>asd</p>\r\n', 12, 123, '11', 'gold', '', NULL, NULL, NULL, '2018-09-26 11:38:53', '2018-09-26 11:38:53', '<p>asd</p>\r\n', '<p>asd</p>\r\n', 'inst_1', 123, '2018-09-20', '11:11:00', '11:11:00', 222200, '', 0, ''),
(29, 'club_web', 'work_29', 'ad23rsdfc', '<p>asdfasd</p>\r\n', 2, 123, '9', 'gold', '', NULL, NULL, NULL, '2018-09-26 12:29:28', '2018-09-26 12:29:28', '<p>fd</p>\r\n', '<p>asd</p>\r\n', 'inst_1', 123, '2018-09-29', '11:11:00', '11:11:00', 10000, '', 0, ''),
(30, 'club_web', 'work_30', 'asda23423er', '<p>asdad</p>\r\n', 0, 0, '11', 'platinum', '', NULL, NULL, NULL, '2018-09-26 12:54:35', '2018-09-26 12:54:35', '<p>asdasd</p>\r\n', '<p>asd</p>\r\n', 'inst_1', 123, '2018-09-13', '11:11:00', '11:11:00', 0, '', 0, ''),
(31, 'club_web', 'work_31', 'asdasdad23', '<p>asd</p>\r\n', 0, 0, '11,12', 'gold', '', NULL, NULL, NULL, '2018-09-26 12:55:18', '2018-09-26 12:55:18', '<p>asdasd</p>\r\n', '<p>asdasd</p>\r\n', 'inst_1', 123, '2018-09-08', '11:11:00', '11:11:00', 0, '', 0, ''),
(32, 'club_web', 'work_32', 'testingoct11', '<p>testingockjhiufhiuweehfiehfiuwehifuhweoufwejfhiwehfiuwfhiuwSCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCChfiuwhfiuwehft11desc</p>\r\n', 10, 1000, '6,7,8,9,10,11', 'gold', '', '083343am30.png', '083343am12.png', '083343am23.png', '2018-10-11 12:03:43', '2018-10-11 12:03:43', '<p>testingoct11prereq</p>\r\n', '<p>testingoct11prereq</p>\r\n', 'inst_1', 800, '2018-10-11', '10:30:00', '13:30:00', 3, 'Kiran', 1, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `activity_restrict`
--
ALTER TABLE `activity_restrict`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`sno`),
  ADD UNIQUE KEY `article_id` (`article_id`),
  ADD KEY `vendor_id` (`vendor_id`),
  ADD KEY `club_id` (`club_id`);

--
-- Indexes for table `cc_club_assign`
--
ALTER TABLE `cc_club_assign`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `clubs`
--
ALTER TABLE `clubs`
  ADD PRIMARY KEY (`sno`),
  ADD UNIQUE KEY `club_id` (`club_id`),
  ADD KEY `club_category_id` (`club_category_id`);

--
-- Indexes for table `club_category`
--
ALTER TABLE `club_category`
  ADD PRIMARY KEY (`sno`,`club_category_name`),
  ADD UNIQUE KEY `club_category_id` (`club_category_id`);

--
-- Indexes for table `content_manager`
--
ALTER TABLE `content_manager`
  ADD PRIMARY KEY (`sno`),
  ADD UNIQUE KEY `content_manager_id` (`content_manager_id`);

--
-- Indexes for table `demo_user`
--
ALTER TABLE `demo_user`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `deployment_control`
--
ALTER TABLE `deployment_control`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `ebook`
--
ALTER TABLE `ebook`
  ADD PRIMARY KEY (`sno`),
  ADD KEY `vendor_id` (`vendor_id`),
  ADD KEY `club_id` (`club_id`);

--
-- Indexes for table `gen_course`
--
ALTER TABLE `gen_course`
  ADD PRIMARY KEY (`sno`,`course_id`),
  ADD UNIQUE KEY `course_id` (`course_id`),
  ADD KEY `course_code` (`course_code`);

--
-- Indexes for table `gen_course_class`
--
ALTER TABLE `gen_course_class`
  ADD PRIMARY KEY (`sno`,`class_id`),
  ADD UNIQUE KEY `class_id` (`class_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `gen_section`
--
ALTER TABLE `gen_section`
  ADD PRIMARY KEY (`sno`,`section_id`),
  ADD UNIQUE KEY `section_id` (`section_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `gen_subject`
--
ALTER TABLE `gen_subject`
  ADD PRIMARY KEY (`sno`,`subject_id`),
  ADD UNIQUE KEY `subject_id` (`subject_id`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `gen_subtopic`
--
ALTER TABLE `gen_subtopic`
  ADD PRIMARY KEY (`sno`,`subtopic_id`),
  ADD UNIQUE KEY `subtopic_id` (`subtopic_id`),
  ADD KEY `topic_id` (`topic_id`);

--
-- Indexes for table `gen_topic`
--
ALTER TABLE `gen_topic`
  ADD PRIMARY KEY (`sno`,`topic_id`),
  ADD UNIQUE KEY `topic_id` (`topic_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `institution`
--
ALTER TABLE `institution`
  ADD PRIMARY KEY (`sno`,`institute_id`),
  ADD UNIQUE KEY `institute_id` (`institute_id`);

--
-- Indexes for table `inst_batch`
--
ALTER TABLE `inst_batch`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `inst_batch_assign`
--
ALTER TABLE `inst_batch_assign`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `inst_class`
--
ALTER TABLE `inst_class`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `inst_club_assign`
--
ALTER TABLE `inst_club_assign`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `inst_club_coordinator`
--
ALTER TABLE `inst_club_coordinator`
  ADD PRIMARY KEY (`sno`),
  ADD UNIQUE KEY `coordinator_id` (`club_coordinator_id`);

--
-- Indexes for table `inst_course_assign`
--
ALTER TABLE `inst_course_assign`
  ADD PRIMARY KEY (`sno`),
  ADD KEY `course_code` (`course_code`),
  ADD KEY `institute_id` (`institute_id`);

--
-- Indexes for table `inst_user`
--
ALTER TABLE `inst_user`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `learning_video`
--
ALTER TABLE `learning_video`
  ADD PRIMARY KEY (`sno`),
  ADD KEY `vendor_id` (`vendor_id`),
  ADD KEY `club_id` (`club_id`);

--
-- Indexes for table `live_course`
--
ALTER TABLE `live_course`
  ADD PRIMARY KEY (`sno`),
  ADD KEY `vendor_id` (`vendor_id`),
  ADD KEY `club_id` (`club_id`);

--
-- Indexes for table `online_test`
--
ALTER TABLE `online_test`
  ADD PRIMARY KEY (`sno`),
  ADD KEY `vendor_id` (`vendor_id`),
  ADD KEY `club_id` (`club_id`);

--
-- Indexes for table `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`sno`),
  ADD KEY `vendor_id` (`vendor_id`),
  ADD KEY `club_id` (`club_id`);

--
-- Indexes for table `sales_comments`
--
ALTER TABLE `sales_comments`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `sample_work`
--
ALTER TABLE `sample_work`
  ADD PRIMARY KEY (`sno`),
  ADD KEY `vendor_id` (`vendor_id`),
  ADD KEY `club_id` (`club_id`);

--
-- Indexes for table `sample_work_submission`
--
ALTER TABLE `sample_work_submission`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `school__activities`
--
ALTER TABLE `school__activities`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `school__article`
--
ALTER TABLE `school__article`
  ADD PRIMARY KEY (`sno`),
  ADD UNIQUE KEY `article_id` (`article_id`),
  ADD KEY `vendor_id` (`vendor_id`),
  ADD KEY `club_id` (`club_id`);

--
-- Indexes for table `school__clubs`
--
ALTER TABLE `school__clubs`
  ADD PRIMARY KEY (`sno`),
  ADD UNIQUE KEY `club_id` (`club_id`),
  ADD KEY `club_category_id` (`club_category_id`);

--
-- Indexes for table `school__club_category`
--
ALTER TABLE `school__club_category`
  ADD PRIMARY KEY (`sno`,`club_category_name`),
  ADD UNIQUE KEY `club_category_id` (`club_category_id`);

--
-- Indexes for table `school__ebook`
--
ALTER TABLE `school__ebook`
  ADD PRIMARY KEY (`sno`),
  ADD KEY `vendor_id` (`vendor_id`),
  ADD KEY `club_id` (`club_id`);

--
-- Indexes for table `school__enquiry`
--
ALTER TABLE `school__enquiry`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `school__iclub_assign`
--
ALTER TABLE `school__iclub_assign`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `school__learning_video`
--
ALTER TABLE `school__learning_video`
  ADD PRIMARY KEY (`sno`),
  ADD KEY `vendor_id` (`vendor_id`),
  ADD KEY `club_id` (`club_id`);

--
-- Indexes for table `school__live_course`
--
ALTER TABLE `school__live_course`
  ADD PRIMARY KEY (`sno`),
  ADD KEY `vendor_id` (`vendor_id`),
  ADD KEY `club_id` (`club_id`);

--
-- Indexes for table `school__log_detail`
--
ALTER TABLE `school__log_detail`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `school__online_test`
--
ALTER TABLE `school__online_test`
  ADD PRIMARY KEY (`sno`),
  ADD KEY `vendor_id` (`vendor_id`),
  ADD KEY `club_id` (`club_id`);

--
-- Indexes for table `school__quiz`
--
ALTER TABLE `school__quiz`
  ADD PRIMARY KEY (`sno`),
  ADD KEY `vendor_id` (`vendor_id`),
  ADD KEY `club_id` (`club_id`);

--
-- Indexes for table `school__sample_work`
--
ALTER TABLE `school__sample_work`
  ADD PRIMARY KEY (`sno`),
  ADD KEY `vendor_id` (`vendor_id`),
  ADD KEY `club_id` (`club_id`);

--
-- Indexes for table `school__stage`
--
ALTER TABLE `school__stage`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `school__topic`
--
ALTER TABLE `school__topic`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `school__topic_download`
--
ALTER TABLE `school__topic_download`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `school__video`
--
ALTER TABLE `school__video`
  ADD PRIMARY KEY (`sno`),
  ADD KEY `vendor_id` (`vendor_id`),
  ADD KEY `club_id` (`club_id`);

--
-- Indexes for table `school__webinar`
--
ALTER TABLE `school__webinar`
  ADD PRIMARY KEY (`sno`),
  ADD KEY `vendor_id` (`vendor_id`),
  ADD KEY `club_id` (`club_id`);

--
-- Indexes for table `school__web_reg`
--
ALTER TABLE `school__web_reg`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `school__workshop`
--
ALTER TABLE `school__workshop`
  ADD PRIMARY KEY (`sno`),
  ADD KEY `vendor_id` (`vendor_id`),
  ADD KEY `club_id` (`club_id`);

--
-- Indexes for table `send_sms_school`
--
ALTER TABLE `send_sms_school`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `submission_feedback`
--
ALTER TABLE `submission_feedback`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `topic`
--
ALTER TABLE `topic`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `topic_download`
--
ALTER TABLE `topic_download`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`sno`,`vendor_id`),
  ADD UNIQUE KEY `vendor_id` (`vendor_id`);

--
-- Indexes for table `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`sno`),
  ADD KEY `vendor_id` (`vendor_id`),
  ADD KEY `club_id` (`club_id`);

--
-- Indexes for table `webinar`
--
ALTER TABLE `webinar`
  ADD PRIMARY KEY (`sno`),
  ADD KEY `vendor_id` (`vendor_id`),
  ADD KEY `club_id` (`club_id`);

--
-- Indexes for table `webinar_attendance`
--
ALTER TABLE `webinar_attendance`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `webinar_schedule`
--
ALTER TABLE `webinar_schedule`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `workshop`
--
ALTER TABLE `workshop`
  ADD PRIMARY KEY (`sno`),
  ADD KEY `vendor_id` (`vendor_id`),
  ADD KEY `club_id` (`club_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `activity_restrict`
--
ALTER TABLE `activity_restrict`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `cc_club_assign`
--
ALTER TABLE `cc_club_assign`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `clubs`
--
ALTER TABLE `clubs`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `club_category`
--
ALTER TABLE `club_category`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `content_manager`
--
ALTER TABLE `content_manager`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `demo_user`
--
ALTER TABLE `demo_user`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `deployment_control`
--
ALTER TABLE `deployment_control`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `ebook`
--
ALTER TABLE `ebook`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `gen_course`
--
ALTER TABLE `gen_course`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `gen_course_class`
--
ALTER TABLE `gen_course_class`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `gen_section`
--
ALTER TABLE `gen_section`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gen_subject`
--
ALTER TABLE `gen_subject`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `gen_subtopic`
--
ALTER TABLE `gen_subtopic`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gen_topic`
--
ALTER TABLE `gen_topic`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `institution`
--
ALTER TABLE `institution`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=259;

--
-- AUTO_INCREMENT for table `inst_batch`
--
ALTER TABLE `inst_batch`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT for table `inst_batch_assign`
--
ALTER TABLE `inst_batch_assign`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=211;

--
-- AUTO_INCREMENT for table `inst_class`
--
ALTER TABLE `inst_class`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `inst_club_assign`
--
ALTER TABLE `inst_club_assign`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- AUTO_INCREMENT for table `inst_club_coordinator`
--
ALTER TABLE `inst_club_coordinator`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `inst_course_assign`
--
ALTER TABLE `inst_course_assign`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `inst_user`
--
ALTER TABLE `inst_user`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `learning_video`
--
ALTER TABLE `learning_video`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `live_course`
--
ALTER TABLE `live_course`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `online_test`
--
ALTER TABLE `online_test`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `quiz`
--
ALTER TABLE `quiz`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sales_comments`
--
ALTER TABLE `sales_comments`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `sample_work`
--
ALTER TABLE `sample_work`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sample_work_submission`
--
ALTER TABLE `sample_work_submission`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `school__activities`
--
ALTER TABLE `school__activities`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `school__article`
--
ALTER TABLE `school__article`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `school__clubs`
--
ALTER TABLE `school__clubs`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `school__club_category`
--
ALTER TABLE `school__club_category`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `school__ebook`
--
ALTER TABLE `school__ebook`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `school__enquiry`
--
ALTER TABLE `school__enquiry`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `school__iclub_assign`
--
ALTER TABLE `school__iclub_assign`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `school__learning_video`
--
ALTER TABLE `school__learning_video`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `school__live_course`
--
ALTER TABLE `school__live_course`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `school__log_detail`
--
ALTER TABLE `school__log_detail`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `school__online_test`
--
ALTER TABLE `school__online_test`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `school__quiz`
--
ALTER TABLE `school__quiz`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `school__sample_work`
--
ALTER TABLE `school__sample_work`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `school__stage`
--
ALTER TABLE `school__stage`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `school__topic`
--
ALTER TABLE `school__topic`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `school__topic_download`
--
ALTER TABLE `school__topic_download`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `school__video`
--
ALTER TABLE `school__video`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `school__webinar`
--
ALTER TABLE `school__webinar`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `school__web_reg`
--
ALTER TABLE `school__web_reg`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `school__workshop`
--
ALTER TABLE `school__workshop`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `send_sms_school`
--
ALTER TABLE `send_sms_school`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `submission_feedback`
--
ALTER TABLE `submission_feedback`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `topic`
--
ALTER TABLE `topic`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `topic_download`
--
ALTER TABLE `topic_download`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `video`
--
ALTER TABLE `video`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `webinar`
--
ALTER TABLE `webinar`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `webinar_attendance`
--
ALTER TABLE `webinar_attendance`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `webinar_schedule`
--
ALTER TABLE `webinar_schedule`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `workshop`
--
ALTER TABLE `workshop`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
