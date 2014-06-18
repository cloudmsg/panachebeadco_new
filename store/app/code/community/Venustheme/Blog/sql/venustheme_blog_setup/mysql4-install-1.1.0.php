<?php


$installer = $this;
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer->startSetup();
$installer->run("
 


CREATE TABLE IF NOT EXISTS `{$this->getTable('venustheme_blog/category')}` (
  `category_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `description` text NOT NULL,
  `title` varchar(255) NOT NULL DEFAULT '',
  `layout` varchar(250) NOT NULL,
  `identifier` varchar(255) NOT NULL DEFAULT '',
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `file` varchar(255) NOT NULL,
  `meta_keywords` text NOT NULL,
  `meta_description` text NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `position` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`category_id`),
  UNIQUE KEY `identifier` (`identifier`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `{$this->getTable('venustheme_blog/category')}`
--
 
-- --------------------------------------------------------

--
-- Table structure for table `{$this->getTable('venustheme_blog/comment')}`
--

CREATE TABLE IF NOT EXISTS `{$this->getTable('venustheme_blog/comment')}` (
  `comment_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(11) unsigned NOT NULL,
  `comment` text NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `user` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`comment_id`),
  KEY `FK_blog_comment` (`post_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `{$this->getTable('venustheme_blog/comment')}`
--
 

-- --------------------------------------------------------

--
-- Table structure for table `{$this->getTable('venustheme_blog/post')}``{$this->getTable('venustheme_blog/post')}`
--

CREATE TABLE IF NOT EXISTS `{$this->getTable('venustheme_blog/post')}` (
  `post_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `is_active` tinyint(1) NOT NULL,
  `title` varchar(255) NOT NULL DEFAULT '',
  `identifier` varchar(255) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `detail_content` text NOT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `update_user` varchar(255) NOT NULL,
  `meta_keywords` text NOT NULL,
  `meta_description` text NOT NULL,
  `position` int(11) NOT NULL,
  `tags` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `hits` int(11) NOT NULL,
  PRIMARY KEY (`post_id`),
  UNIQUE KEY `identifier` (`identifier`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;



");
$installer->endSetup();

