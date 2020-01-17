-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- 主机： localhost:3306
-- 生成日期： 2019-12-31 18:33:01
-- 服务器版本： 5.7.24
-- PHP 版本： 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `nndou`
--

-- --------------------------------------------------------

--
-- 表的结构 `nnd_banner`
--

CREATE TABLE `nnd_banner` (
  `ban_id` smallint(5) UNSIGNED NOT NULL COMMENT '展示图id',
  `ban_name` varchar(45) DEFAULT NULL COMMENT '展示图名称',
  `ban_url` varchar(255) DEFAULT NULL COMMENT '展示图地址',
  `ban_type` smallint(5) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='展示图';

--
-- 转存表中的数据 `nnd_banner`
--

INSERT INTO `nnd_banner` (`ban_id`, `ban_name`, `ban_url`, `ban_type`) VALUES
(2, 'banner1', '/static/images/public/banner1.png', 0),
(3, 'banner2', '/static/images/public/banner2.jpg', 0);

-- --------------------------------------------------------

--
-- 表的结构 `nnd_bantype`
--

CREATE TABLE `nnd_bantype` (
  `btype_id` smallint(5) UNSIGNED NOT NULL COMMENT '图片分类id',
  `btype_name` varchar(45) DEFAULT NULL COMMENT '图片分类名称'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='展示图分类';

-- --------------------------------------------------------

--
-- 表的结构 `nnd_cases`
--

CREATE TABLE `nnd_cases` (
  `case_id` smallint(5) UNSIGNED NOT NULL COMMENT '案例id',
  `case_name` varchar(50) NOT NULL COMMENT '案例名称',
  `case_img` varchar(200) NOT NULL COMMENT '案例截图',
  `case_desc` varchar(100) NOT NULL COMMENT '案例描述',
  `case_url` varchar(255) NOT NULL COMMENT '案例网址',
  `case_type` smallint(5) NOT NULL COMMENT '案例分类'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='案例表';

--
-- 转存表中的数据 `nnd_cases`
--

INSERT INTO `nnd_cases` (`case_id`, `case_name`, `case_img`, `case_desc`, `case_url`, `case_type`) VALUES
(1, '优购1', '/static/images/show/yougou.jpg', '优购网品牌旗舰店热销耐克、阿迪达斯、...', '', 1),
(2, '优购2', '/static/images/show/xinjv.jpg', '优购网品牌旗舰店热销耐克、阿迪达斯、...', '', 2),
(3, '优购3', '/static/images/show/yougou.jpg', '优购网品牌旗舰店热销耐克、阿迪达斯、...', '', 3),
(4, '优购4', '/static/images/show/xinjv.jpg', '优购网品牌旗舰店热销耐克、阿迪达斯、...', '', 1),
(5, '优购5', '/static/images/show/yougou.jpg', '优购网品牌旗舰店热销耐克、阿迪达斯、...', '', 2),
(6, '优购6', '/static/images/show/xinjv.jpg', '优购网品牌旗舰店热销耐克、阿迪达斯、...', '', 3),
(7, '优购7', '/static/images/show/yougou.jpg', '优购网品牌旗舰店热销耐克、阿迪达斯、...', '', 1),
(8, '优购8', '/static/images/show/xinjv.jpg', '优购网品牌旗舰店热销耐克、阿迪达斯、...', '', 2),
(9, '优购', '/static/images/show/xinjv.jpg', '优购网品牌旗舰店热销耐克、阿迪达斯、...', '', 3),
(10, '优购', '/static/images/show/yougou.jpg', '优购网品牌旗舰店热销耐克、阿迪达斯、...', '', 1),
(11, '优购', '/static/images/show/xinjv.jpg', '优购网品牌旗舰店热销耐克、阿迪达斯、...', '', 2),
(12, '优购', '/static/images/show/yougou.jpg', '优购网品牌旗舰店热销耐克、阿迪达斯、...', '', 3),
(13, '优购', '/static/images/show/xinjv.jpg', '优购网品牌旗舰店热销耐克、阿迪达斯、...', '', 1),
(14, '优购', '/static/images/show/yougou.jpg', '优购网品牌旗舰店热销耐克、阿迪达斯、...', '', 2),
(15, '优购', '/static/images/show/xinjv.jpg', '优购网品牌旗舰店热销耐克、阿迪达斯、...', '', 3),
(16, '优购', '/static/images/show/yougou.jpg', '优购网品牌旗舰店热销耐克、阿迪达斯、...', '', 1),
(17, '优购', '/static/images/show/xinjv.jpg', '优购网品牌旗舰店热销耐克、阿迪达斯、...', '', 2),
(18, '优购', '/static/images/show/xinjv.jpg', '优购网品牌旗舰店热销耐克、阿迪达斯、...', '', 3);

-- --------------------------------------------------------

--
-- 表的结构 `nnd_case_type`
--

CREATE TABLE `nnd_case_type` (
  `case_type_id` smallint(5) UNSIGNED NOT NULL COMMENT '案例分类id',
  `case_type_name1` varchar(30) NOT NULL COMMENT '分类名称1',
  `case_type_name2` varchar(30) NOT NULL COMMENT '分类名称2',
  `case_type_thumb` varchar(255) NOT NULL COMMENT '缩略图'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='案例分类表';

--
-- 转存表中的数据 `nnd_case_type`
--

INSERT INTO `nnd_case_type` (`case_type_id`, `case_type_name1`, `case_type_name2`, `case_type_thumb`) VALUES
(1, '电子商务网站', 'E-commercial web', '/static/images/show/case1.jpg'),
(2, '门户型网站', 'Protal web', '/static/images/show/case2.jpg'),
(3, '企业品牌网站', 'Enterprise web', '/static/images/show/case2.jpg');

-- --------------------------------------------------------

--
-- 表的结构 `nnd_config`
--

CREATE TABLE `nnd_config` (
  `config_id` smallint(5) UNSIGNED NOT NULL COMMENT '配置id',
  `config_addr` varchar(255) NOT NULL COMMENT '地址',
  `config_copy` varchar(255) NOT NULL COMMENT '版权',
  `config_beian` varchar(255) NOT NULL COMMENT '备案',
  `config_contact` varchar(255) NOT NULL COMMENT '联系方式'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='配置表';

--
-- 转存表中的数据 `nnd_config`
--

INSERT INTO `nnd_config` (`config_id`, `config_addr`, `config_copy`, `config_beian`, `config_contact`) VALUES
(1, '广州市海珠区广州大道南448号财智大厦28楼', '\r\n\r\n广州牛牛豆网络科技有限公司版权所有 Copyright 2009-2015, All Rights Reserved Wengdo', '粤ICP备12022584号-3  &emsp;法律顾问：广东晟晨律师事务所-张勇律师', '/static/images/public/footer-left.png');

-- --------------------------------------------------------

--
-- 表的结构 `nnd_nav`
--

CREATE TABLE `nnd_nav` (
  `nav_id` smallint(5) UNSIGNED NOT NULL COMMENT '导航ID',
  `nav_name` varchar(45) DEFAULT NULL COMMENT '导航名称',
  `nav_url` varchar(255) DEFAULT NULL COMMENT '导航url'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='导航表';

--
-- 转存表中的数据 `nnd_nav`
--

INSERT INTO `nnd_nav` (`nav_id`, `nav_name`, `nav_url`) VALUES
(1, '首页', 'index.php'),
(2, '解决方案', 'solution.php'),
(3, '资讯中心', 'news_center.php'),
(4, '案例展示', 'cases.php'),
(5, '了解牛牛豆', 'about.php');

-- --------------------------------------------------------

--
-- 表的结构 `nnd_service`
--

CREATE TABLE `nnd_service` (
  `serv_id` smallint(5) UNSIGNED NOT NULL COMMENT '服务id',
  `serv_name` varchar(45) DEFAULT NULL COMMENT '服务名称',
  `serv_name1` varchar(50) DEFAULT NULL COMMENT '服务标题1',
  `serv_desc` text COMMENT '服务描述',
  `serv_img` varchar(255) DEFAULT NULL COMMENT '图片地址',
  `serv_type` smallint(5) UNSIGNED NOT NULL COMMENT '服务表'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='服务表';

-- --------------------------------------------------------

--
-- 表的结构 `nnd_serv_type`
--

CREATE TABLE `nnd_serv_type` (
  `serv_type_id` smallint(5) UNSIGNED NOT NULL COMMENT '服务分类id',
  `serv_type_name` varchar(45) DEFAULT NULL COMMENT '服务类型名称',
  `serv_type_title` varchar(60) DEFAULT NULL COMMENT '服务类型标题',
  `serv_type_desc` varchar(255) DEFAULT NULL COMMENT '服务类型描述',
  `serv_type_thumb` varchar(255) DEFAULT NULL COMMENT '缩略图'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='服务类型表';

--
-- 转存表中的数据 `nnd_serv_type`
--

INSERT INTO `nnd_serv_type` (`serv_type_id`, `serv_type_name`, `serv_type_title`, `serv_type_desc`, `serv_type_thumb`) VALUES
(1, '移动端应用开发解决方案', '移动端应用开发解决方案', '牛牛豆为各个行业提供专业的APP开发方案，互动营销小游戏解决方案 ', '/static/images/index/services-01mobile.png'),
(2, ' 高品质网站解决方案', ' 高品质网站解决方案', '牛牛豆作为专业的广州网站建设公司，集团队智慧为您提供专业的企业门户解决方案\r\n', '/static/images/index/services-02PC.png'),
(3, '微信应用解决方案', '微信应用解决方案', '牛牛豆有着的微信应用开发经验，积累了众多互动社区的开发经验', '/static/images/index/services-03wechat.png'),
(4, 'IT人才培养服务', 'IT人才培养服务', '牛牛豆有着多年在PHP网站开发经验，也为各个企业提供PHP，UI设计，网站前端的人才', '/static/images/index/services-04IT-talent.png'),
(5, '电子商务平台解决方案', '电子商务平台解决方案', 'B2B，B2C，搜索引擎优化，基于多年网络营销和在电子商务运营的基础上形成的解决方案', '/static/images/index/services-05solution.png'),
(6, '企业信息化解决方案', '企业信息化解决方案', '采用领先的BS方式，提供OA系统，ERP，CRM等常见的BS管理系统的解决方案', '/static/images/index/services-06oa.png');

--
-- 转储表的索引
--

--
-- 表的索引 `nnd_banner`
--
ALTER TABLE `nnd_banner`
  ADD PRIMARY KEY (`ban_id`);

--
-- 表的索引 `nnd_bantype`
--
ALTER TABLE `nnd_bantype`
  ADD PRIMARY KEY (`btype_id`);

--
-- 表的索引 `nnd_cases`
--
ALTER TABLE `nnd_cases`
  ADD PRIMARY KEY (`case_id`);

--
-- 表的索引 `nnd_case_type`
--
ALTER TABLE `nnd_case_type`
  ADD PRIMARY KEY (`case_type_id`);

--
-- 表的索引 `nnd_config`
--
ALTER TABLE `nnd_config`
  ADD PRIMARY KEY (`config_id`);

--
-- 表的索引 `nnd_nav`
--
ALTER TABLE `nnd_nav`
  ADD PRIMARY KEY (`nav_id`);

--
-- 表的索引 `nnd_service`
--
ALTER TABLE `nnd_service`
  ADD PRIMARY KEY (`serv_id`);

--
-- 表的索引 `nnd_serv_type`
--
ALTER TABLE `nnd_serv_type`
  ADD PRIMARY KEY (`serv_type_id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `nnd_banner`
--
ALTER TABLE `nnd_banner`
  MODIFY `ban_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '展示图id', AUTO_INCREMENT=4;

--
-- 使用表AUTO_INCREMENT `nnd_bantype`
--
ALTER TABLE `nnd_bantype`
  MODIFY `btype_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '图片分类id';

--
-- 使用表AUTO_INCREMENT `nnd_cases`
--
ALTER TABLE `nnd_cases`
  MODIFY `case_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '案例id', AUTO_INCREMENT=19;

--
-- 使用表AUTO_INCREMENT `nnd_case_type`
--
ALTER TABLE `nnd_case_type`
  MODIFY `case_type_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '案例分类id', AUTO_INCREMENT=4;

--
-- 使用表AUTO_INCREMENT `nnd_config`
--
ALTER TABLE `nnd_config`
  MODIFY `config_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '配置id', AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `nnd_nav`
--
ALTER TABLE `nnd_nav`
  MODIFY `nav_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '导航ID', AUTO_INCREMENT=6;

--
-- 使用表AUTO_INCREMENT `nnd_service`
--
ALTER TABLE `nnd_service`
  MODIFY `serv_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '服务id';

--
-- 使用表AUTO_INCREMENT `nnd_serv_type`
--
ALTER TABLE `nnd_serv_type`
  MODIFY `serv_type_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '服务分类id', AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
