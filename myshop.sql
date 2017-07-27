/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : myshop

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2017-07-27 19:50:28
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for shop_admin
-- ----------------------------
DROP TABLE IF EXISTS `shop_admin`;
CREATE TABLE `shop_admin` (
  `admin_id` int(50) NOT NULL AUTO_INCREMENT,
  `aid` varchar(50) NOT NULL,
  `role_id` int(50) NOT NULL DEFAULT '2',
  `aname` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nickname` varchar(50) DEFAULT NULL,
  `image` varchar(200) DEFAULT 'http://localhost/ShopProject/public/img/dataimg/uid.jpg',
  `deleted_at` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_admin
-- ----------------------------
INSERT INTO `shop_admin` VALUES ('1', '20161223195666', '1', 'root', '123456', '方瑶', 'http://localhost/ShopProject/public/img/dataimg/1eadf36cc35b4aa355208de263eaa716.jpg', '0');
INSERT INTO `shop_admin` VALUES ('3', '20161223195605', '2', 'root008', '234567', '小李', 'http://localhost/ShopProject/public/img/dataimg/uid.jpg', '0');

-- ----------------------------
-- Table structure for shop_area
-- ----------------------------
DROP TABLE IF EXISTS `shop_area`;
CREATE TABLE `shop_area` (
  `area_id` int(50) NOT NULL AUTO_INCREMENT,
  `arname` varchar(50) NOT NULL,
  `parent_id` int(50) NOT NULL,
  `path` varchar(50) NOT NULL,
  PRIMARY KEY (`area_id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_area
-- ----------------------------
INSERT INTO `shop_area` VALUES ('1', '福建省', '0', '0-1');
INSERT INTO `shop_area` VALUES ('2', '江西省', '0', '0-2');
INSERT INTO `shop_area` VALUES ('3', '广东省', '0', '0-3');
INSERT INTO `shop_area` VALUES ('4', '漳州市', '1', '0-1-4');
INSERT INTO `shop_area` VALUES ('5', '厦门市', '1', '0-1-5');
INSERT INTO `shop_area` VALUES ('6', '福州市', '1', '0-1-6');
INSERT INTO `shop_area` VALUES ('7', '泉州市', '1', '0-1-7');
INSERT INTO `shop_area` VALUES ('8', '南昌市', '2', '0-2-8');
INSERT INTO `shop_area` VALUES ('9', '萍乡市', '2', '0-2-9');
INSERT INTO `shop_area` VALUES ('10', '广州市', '3', '0-3-10');
INSERT INTO `shop_area` VALUES ('11', '深圳市', '3', '0-3-11');
INSERT INTO `shop_area` VALUES ('12', '珠海市', '3', '0-3-12');
INSERT INTO `shop_area` VALUES ('13', '漳浦县', '4', '0-1-4-13');
INSERT INTO `shop_area` VALUES ('14', '云霄县', '4', '0-1-4-14');
INSERT INTO `shop_area` VALUES ('15', '思明区', '5', '0-1-5-15');
INSERT INTO `shop_area` VALUES ('16', '海沧区', '5', '0-1-5-16');
INSERT INTO `shop_area` VALUES ('17', '湖里区', '5', '0-1-5-17');
INSERT INTO `shop_area` VALUES ('18', '鼓楼区', '6', '0-1-6-18');
INSERT INTO `shop_area` VALUES ('19', '台江区', '6', '0-1-6-19');
INSERT INTO `shop_area` VALUES ('20', '仓山区', '6', '0-1-6-20');
INSERT INTO `shop_area` VALUES ('21', '鲤城区', '7', '0-1-7-21');
INSERT INTO `shop_area` VALUES ('22', '丰泽区', '7', '0-1-7-22');
INSERT INTO `shop_area` VALUES ('23', '洛江区', '7', '0-1-7-23');
INSERT INTO `shop_area` VALUES ('24', '南昌县', '8', '0-2-8-24');
INSERT INTO `shop_area` VALUES ('25', '安义县', '8', '0-2-8-25');
INSERT INTO `shop_area` VALUES ('26', '莲花县', '9', '0-2-9-26');
INSERT INTO `shop_area` VALUES ('27', '越秀区', '10', '0-3-10-27');
INSERT INTO `shop_area` VALUES ('28', '天河区', '10', '0-3-10-28');
INSERT INTO `shop_area` VALUES ('29', '罗湖区', '11', '0-3-11-29');
INSERT INTO `shop_area` VALUES ('30', '福田区', '11', '0-3-11-30');
INSERT INTO `shop_area` VALUES ('31', '香洲区', '12', '0-3-12-31');
INSERT INTO `shop_area` VALUES ('32', '金湾区', '12', '0-3-12-32');

-- ----------------------------
-- Table structure for shop_attr
-- ----------------------------
DROP TABLE IF EXISTS `shop_attr`;
CREATE TABLE `shop_attr` (
  `attr_id` int(50) NOT NULL AUTO_INCREMENT,
  `cid` int(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  PRIMARY KEY (`attr_id`),
  KEY `cid` (`cid`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_attr
-- ----------------------------
INSERT INTO `shop_attr` VALUES ('2', '1', '品牌');
INSERT INTO `shop_attr` VALUES ('3', '1', '网络');
INSERT INTO `shop_attr` VALUES ('4', '1', '内存');
INSERT INTO `shop_attr` VALUES ('5', '1', '机身内存');
INSERT INTO `shop_attr` VALUES ('6', '1', '价格');
INSERT INTO `shop_attr` VALUES ('7', '1', '像素');
INSERT INTO `shop_attr` VALUES ('11', '1', '屏幕尺寸');
INSERT INTO `shop_attr` VALUES ('12', '33', '品牌');
INSERT INTO `shop_attr` VALUES ('15', '33', '硬盘容量');
INSERT INTO `shop_attr` VALUES ('17', '33', '显卡');
INSERT INTO `shop_attr` VALUES ('18', '33', '内存容量');
INSERT INTO `shop_attr` VALUES ('19', '33', '屏幕大小');
INSERT INTO `shop_attr` VALUES ('20', '33', '系统');
INSERT INTO `shop_attr` VALUES ('21', '33', '处理器');

-- ----------------------------
-- Table structure for shop_attr_value
-- ----------------------------
DROP TABLE IF EXISTS `shop_attr_value`;
CREATE TABLE `shop_attr_value` (
  `avid` int(50) NOT NULL AUTO_INCREMENT,
  `attr_id` int(50) NOT NULL,
  `value` varchar(50) NOT NULL,
  PRIMARY KEY (`avid`),
  KEY `attr_id` (`attr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_attr_value
-- ----------------------------
INSERT INTO `shop_attr_value` VALUES ('2', '2', '小米');
INSERT INTO `shop_attr_value` VALUES ('3', '2', '华为');
INSERT INTO `shop_attr_value` VALUES ('4', '3', '联通4G');
INSERT INTO `shop_attr_value` VALUES ('5', '3', '电信4G');
INSERT INTO `shop_attr_value` VALUES ('6', '3', '全网通4G');
INSERT INTO `shop_attr_value` VALUES ('7', '3', '移动4G');
INSERT INTO `shop_attr_value` VALUES ('8', '4', '2G');
INSERT INTO `shop_attr_value` VALUES ('9', '4', '无');
INSERT INTO `shop_attr_value` VALUES ('10', '5', '512M');
INSERT INTO `shop_attr_value` VALUES ('11', '5', '4G');
INSERT INTO `shop_attr_value` VALUES ('12', '6', '0-499');
INSERT INTO `shop_attr_value` VALUES ('13', '6', '500-2000');
INSERT INTO `shop_attr_value` VALUES ('14', '6', '2001-3999');
INSERT INTO `shop_attr_value` VALUES ('15', '6', '4000-5999');
INSERT INTO `shop_attr_value` VALUES ('16', '6', '6000以上');
INSERT INTO `shop_attr_value` VALUES ('17', '7', '500万以下');
INSERT INTO `shop_attr_value` VALUES ('18', '7', '500万-1000万');
INSERT INTO `shop_attr_value` VALUES ('19', '7', '1000万以上');
INSERT INTO `shop_attr_value` VALUES ('23', '5', '8G');
INSERT INTO `shop_attr_value` VALUES ('24', '2', 'iPhone');
INSERT INTO `shop_attr_value` VALUES ('25', '4', '16G');
INSERT INTO `shop_attr_value` VALUES ('26', '5', '64G');
INSERT INTO `shop_attr_value` VALUES ('27', '11', '3.0英寸及以下');
INSERT INTO `shop_attr_value` VALUES ('28', '11', '5.1-3.1英寸');
INSERT INTO `shop_attr_value` VALUES ('29', '11', '5.1-5.5英寸');
INSERT INTO `shop_attr_value` VALUES ('30', '11', '5.6英寸及以上');
INSERT INTO `shop_attr_value` VALUES ('31', '12', '联想');
INSERT INTO `shop_attr_value` VALUES ('32', '12', '戴尔');
INSERT INTO `shop_attr_value` VALUES ('33', '12', '惠普');
INSERT INTO `shop_attr_value` VALUES ('34', '12', '华硕');
INSERT INTO `shop_attr_value` VALUES ('35', '15', '500G');
INSERT INTO `shop_attr_value` VALUES ('36', '15', '1T');
INSERT INTO `shop_attr_value` VALUES ('37', '15', '2T');
INSERT INTO `shop_attr_value` VALUES ('38', '17', '1G独立显卡');
INSERT INTO `shop_attr_value` VALUES ('39', '17', '2G独立显卡');
INSERT INTO `shop_attr_value` VALUES ('40', '17', '集成显卡');
INSERT INTO `shop_attr_value` VALUES ('41', '19', '12.5英寸及以下');
INSERT INTO `shop_attr_value` VALUES ('42', '19', '13.3英寸');
INSERT INTO `shop_attr_value` VALUES ('43', '19', '14.0英寸');
INSERT INTO `shop_attr_value` VALUES ('44', '19', '15.6英寸及以上');
INSERT INTO `shop_attr_value` VALUES ('45', '20', 'Windows');
INSERT INTO `shop_attr_value` VALUES ('46', '20', 'Linux');
INSERT INTO `shop_attr_value` VALUES ('47', '20', '其他');
INSERT INTO `shop_attr_value` VALUES ('48', '21', 'Intel i5');
INSERT INTO `shop_attr_value` VALUES ('49', '21', 'Intel i7');
INSERT INTO `shop_attr_value` VALUES ('50', '21', 'Intel i3');
INSERT INTO `shop_attr_value` VALUES ('51', '21', 'AMD');
INSERT INTO `shop_attr_value` VALUES ('52', '2', '魅族');
INSERT INTO `shop_attr_value` VALUES ('53', '4', '4G');
INSERT INTO `shop_attr_value` VALUES ('54', '4', '8G');
INSERT INTO `shop_attr_value` VALUES ('55', '18', '2G');
INSERT INTO `shop_attr_value` VALUES ('56', '18', '4G');

-- ----------------------------
-- Table structure for shop_cart
-- ----------------------------
DROP TABLE IF EXISTS `shop_cart`;
CREATE TABLE `shop_cart` (
  `cart_id` int(50) NOT NULL AUTO_INCREMENT,
  `uid` int(50) NOT NULL,
  `gid` int(50) NOT NULL,
  `gname` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `img_path` varchar(500) NOT NULL,
  `discount` float NOT NULL,
  `num` int(50) NOT NULL,
  PRIMARY KEY (`cart_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_cart
-- ----------------------------
INSERT INTO `shop_cart` VALUES ('2', '2', '22', '魅族 魅蓝3 移动定制版 4G+8GB 白色 移动4G魅族手机 ', '2000.00', 'http://localhost/ShopProject/public/img/dataimg/45fb3fe408fc66194ce1e60a2b715871.jpg', '0.8', '1');
INSERT INTO `shop_cart` VALUES ('3', '2', '20', '华为 G9 青春版 玫瑰金 移动4G华为手机 8G+4G ', '1000.00', 'http://localhost/ShopProject/public/img/dataimg/334096fb4abd93b5aac21864db16e1cd.jpg', '0.8', '1');
INSERT INTO `shop_cart` VALUES ('4', '2', '19', '华为 麦芒5 全网通 4G华为手机  4GB+64GB版 香槟金', '5000.00', 'http://localhost/ShopProject/public/img/dataimg/dc0a3643d107ddb253326c98323f032e.jpg', '0.9', '1');
INSERT INTO `shop_cart` VALUES ('5', '2', '8', '小米 Max  2GB内存 8GB ROM 银色 移动4G手机 小米手机', '3000.00', 'http://localhost/ShopProject/public/img/dataimg/1b1fb5362df415834b526f2acc35f27a.jpg', '0.9', '1');
INSERT INTO `shop_cart` VALUES ('12', '3', '19', '华为 麦芒5 全网通 4G华为手机  4GB+64GB版 香槟金', '5000.00', 'http://localhost/ShopProject/public/img/dataimg/dc0a3643d107ddb253326c98323f032e.jpg', '0.9', '1');

-- ----------------------------
-- Table structure for shop_category
-- ----------------------------
DROP TABLE IF EXISTS `shop_category`;
CREATE TABLE `shop_category` (
  `cid` int(50) NOT NULL AUTO_INCREMENT,
  `cname` varchar(50) NOT NULL,
  `parentid` int(50) NOT NULL DEFAULT '0',
  `parentname` varchar(50) NOT NULL DEFAULT '顶级类别',
  PRIMARY KEY (`cid`),
  KEY `parentid` (`parentid`),
  KEY `cname` (`cname`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_category
-- ----------------------------
INSERT INTO `shop_category` VALUES ('1', '手机通讯', '0', '顶级类别');
INSERT INTO `shop_category` VALUES ('3', '智能手机', '1', '手机通讯');
INSERT INTO `shop_category` VALUES ('32', '非智能手机', '1', '手机通讯');
INSERT INTO `shop_category` VALUES ('33', '电脑专区', '0', '顶级类别');
INSERT INTO `shop_category` VALUES ('35', '笔记本电脑', '33', '电脑专区');
INSERT INTO `shop_category` VALUES ('37', '台式电脑', '33', '电脑专区');

-- ----------------------------
-- Table structure for shop_collect
-- ----------------------------
DROP TABLE IF EXISTS `shop_collect`;
CREATE TABLE `shop_collect` (
  `collect_id` int(50) NOT NULL AUTO_INCREMENT,
  `uid` int(50) NOT NULL,
  `gid` int(50) NOT NULL,
  PRIMARY KEY (`collect_id`),
  KEY `uid` (`uid`),
  KEY `gid` (`gid`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_collect
-- ----------------------------
INSERT INTO `shop_collect` VALUES ('6', '1', '19');
INSERT INTO `shop_collect` VALUES ('7', '1', '28');
INSERT INTO `shop_collect` VALUES ('8', '1', '29');

-- ----------------------------
-- Table structure for shop_detail_order
-- ----------------------------
DROP TABLE IF EXISTS `shop_detail_order`;
CREATE TABLE `shop_detail_order` (
  `odid` int(50) NOT NULL AUTO_INCREMENT,
  `oid` int(50) NOT NULL,
  `gid` int(50) NOT NULL,
  `gname` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `num` int(50) NOT NULL,
  `discount` decimal(2,1) NOT NULL DEFAULT '1.0',
  `imgpath` varchar(200) NOT NULL,
  PRIMARY KEY (`odid`),
  KEY `oid` (`oid`),
  KEY `gid` (`gid`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_detail_order
-- ----------------------------
INSERT INTO `shop_detail_order` VALUES ('13', '13', '19', '华为 麦芒5 全网通 4G华为手机  4GB+64GB版 香槟金', '5000.00', '1', '0.9', 'http://localhost/ShopProject/public/img/dataimg/dc0a3643d107ddb253326c98323f032e.jpg');
INSERT INTO `shop_detail_order` VALUES ('14', '13', '7', '小米5 全网通 高配版 2GB内存 64GB ROM 淡紫色 全网通4G小米手机', '5000.00', '1', '0.9', 'http://localhost/ShopProject/public/img/dataimg/6cb8e43623670e9eb787dafd418e8bb4.jpg');
INSERT INTO `shop_detail_order` VALUES ('18', '16', '19', '华为 麦芒5 全网通 4G华为手机  4GB+64GB版 香槟金', '5000.00', '1', '0.9', 'http://localhost/ShopProject/public/img/dataimg/dc0a3643d107ddb253326c98323f032e.jpg');
INSERT INTO `shop_detail_order` VALUES ('24', '20', '28', '联想（Lenovo） IdeaCentre C560 23英寸一体机电脑', '2000.00', '1', '0.8', 'http://localhost/ShopProject/public/img/dataimg/2a07640ee59e86fcd38b907e4458b9a6.jpg');
INSERT INTO `shop_detail_order` VALUES ('25', '21', '29', '戴尔(DELL)灵越3650-R5838台式电脑整机(i5-6400 8G 1TB 2G独显 DVD', '5000.00', '1', '0.8', 'http://localhost/ShopProject/public/img/dataimg/9d55ff1008a18c2f9eb0281abb31b976.jpg');

-- ----------------------------
-- Table structure for shop_evaluate
-- ----------------------------
DROP TABLE IF EXISTS `shop_evaluate`;
CREATE TABLE `shop_evaluate` (
  `eva_id` int(50) NOT NULL AUTO_INCREMENT,
  `gid` int(50) NOT NULL,
  `uid` int(50) NOT NULL,
  `evascore` int(1) NOT NULL,
  `evadescript` varchar(500) NOT NULL,
  `evatime` datetime NOT NULL,
  PRIMARY KEY (`eva_id`),
  KEY `gid` (`gid`),
  KEY `uid` (`uid`),
  KEY `evascore` (`evascore`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_evaluate
-- ----------------------------
INSERT INTO `shop_evaluate` VALUES ('1', '6', '1', '4', '这款手机我很喜欢！', '2016-11-26 17:58:39');
INSERT INTO `shop_evaluate` VALUES ('2', '19', '1', '5', '购买的商品，我很喜欢', '2016-11-29 09:32:55');
INSERT INTO `shop_evaluate` VALUES ('3', '7', '1', '4', '使用手感不错', '2016-11-29 09:32:56');
INSERT INTO `shop_evaluate` VALUES ('4', '19', '1', '4', '这款手机不错，我喜欢', '2016-12-24 10:45:03');

-- ----------------------------
-- Table structure for shop_goods
-- ----------------------------
DROP TABLE IF EXISTS `shop_goods`;
CREATE TABLE `shop_goods` (
  `gid` int(50) NOT NULL AUTO_INCREMENT,
  `gname` varchar(50) NOT NULL,
  `cid` int(50) NOT NULL,
  `num` int(50) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `discount` decimal(2,1) NOT NULL DEFAULT '1.0',
  `descript` varchar(500) DEFAULT NULL,
  `tprice` decimal(10,2) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `img_path` varchar(200) NOT NULL,
  `img_path1` varchar(200) NOT NULL,
  `img_path2` varchar(200) DEFAULT NULL,
  `img_path3` varchar(200) DEFAULT NULL,
  `store_time` datetime DEFAULT NULL,
  PRIMARY KEY (`gid`),
  KEY `gname` (`gname`),
  KEY `status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_goods
-- ----------------------------
INSERT INTO `shop_goods` VALUES ('6', 'Apple iPhone SE (A1723) 16G 玫瑰金色 全网通4G', '3', '201', '7000.00', '0.8', '', '4000.00', '1', 'http://localhost/ShopProject/public/img/dataimg/e23639164f9b292128de790f13461883.png', 'http://localhost/ShopProject/public/img/dataimg/799db683c17a629aa6eba51fd3584d2b.png', 'http://localhost/ShopProject/public/img/dataimg/b6d96f150f6df9ea55bb8792f9e452e5.jpg', '', '2016-11-24 22:22:02');
INSERT INTO `shop_goods` VALUES ('7', '小米5 全网通 高配版 2GB内存 64GB ROM 淡紫色 全网通4G小米手机', '3', '199', '5000.00', '0.9', '小米5限量发行，赶紧抢购', '4000.00', '1', 'http://localhost/ShopProject/public/img/dataimg/6cb8e43623670e9eb787dafd418e8bb4.jpg', 'http://localhost/ShopProject/public/img/dataimg/954e0613586637decdfa63be146749c4.jpg', 'http://localhost/ShopProject/public/img/dataimg/92ba391bc8c2208e16e3a66780bde10d.jpg', '', '2016-11-25 17:42:06');
INSERT INTO `shop_goods` VALUES ('8', '小米 Max  2GB内存 8GB ROM 银色 移动4G手机 小米手机', '3', '200', '3000.00', '0.9', '小米max版', '2000.00', '1', 'http://localhost/ShopProject/public/img/dataimg/1b1fb5362df415834b526f2acc35f27a.jpg', 'http://localhost/ShopProject/public/img/dataimg/d66f7555295ddb24aa6f0c4350a40f56.jpg', 'http://localhost/ShopProject/public/img/dataimg/0a763af400bea9e4e590dd72c5fa1eaf.jpg', '', '2016-11-25 17:50:23');
INSERT INTO `shop_goods` VALUES ('9', '小米 4c 标准版 4G 8G 白色 电信4G小米手机 ', '3', '50', '1000.00', '0.9', '', '400.00', '1', 'http://localhost/ShopProject/public/img/dataimg/8b395fe7d0413ae5b8efec1b93e2da1f.jpg', 'http://localhost/ShopProject/public/img/dataimg/fd7e83ebbfb735673d79bc122a7a7eff.jpg', 'http://localhost/ShopProject/public/img/dataimg/720b6ad5076b4b3aa373a8ac8160487d.jpg', '', '2016-11-25 17:50:26');
INSERT INTO `shop_goods` VALUES ('10', 'Apple iPhone 7(A1660) 8G 64G 黑色 联通4G苹果手机', '3', '200', '7000.00', '0.9', 'APPLE 7 全新发送', '4000.00', '1', 'http://localhost/ShopProject/public/img/dataimg/b1a46ab766169ea0b3f4779e27706995.jpg', 'http://localhost/ShopProject/public/img/dataimg/921b98bb4d525858d43104b7b8fafc35.jpg', 'http://localhost/ShopProject/public/img/dataimg/fa2d8636eca56c4dc7d74e5a6a511e99.jpg', '', '2016-11-25 17:50:49');
INSERT INTO `shop_goods` VALUES ('11', 'Apple iPhone 7 (A1660) 32G 银色 联通4G苹果手机', '3', '200', '6000.00', '0.9', 'apple 7 闪亮登场', '4000.00', '1', 'http://localhost/ShopProject/public/img/dataimg/bf33996b2d29d6f850e2a48b4d232cdd.jpg', 'http://localhost/ShopProject/public/img/dataimg/747447bbb10e9ef91fe73516a9c4e605.jpg', 'http://localhost/ShopProject/public/img/dataimg/d8f468f198feaffea3e6313b8e86280f.jpg', '', '2016-11-25 17:50:52');
INSERT INTO `shop_goods` VALUES ('12', '苹果手机Apple iPhone7 4   Plus 移动4G手机黑色 64G', '3', '200', '7000.00', '0.9', '', '3000.00', '1', 'http://localhost/ShopProject/public/img/dataimg/fadd3f076284499e319e8153d95f0042.jpg', 'http://localhost/ShopProject/public/img/dataimg/d92349e1ddfc5c40b97a6f93102d4c65.jpg', 'http://localhost/ShopProject/public/img/dataimg/53d5d02c719f5ea32a81004d35a40c6c.jpg', '', '2016-11-25 17:50:55');
INSERT INTO `shop_goods` VALUES ('13', '苹果（Apple）iPhone 4s 2 8G 联通4G苹果手机 白色', '3', '20', '1000.00', '0.8', '', '200.00', '1', 'http://localhost/ShopProject/public/img/dataimg/0238bfa0e022fbf2b6bca5e08d6d825b.jpg', 'http://localhost/ShopProject/public/img/dataimg/e11e1435948110bccbe1a109e4f8f7af.jpg', 'http://localhost/ShopProject/public/img/dataimg/4af662d5d2b1f9282081e7d6fac0153a.jpg', '', '2016-11-25 17:50:58');
INSERT INTO `shop_goods` VALUES ('14', 'Apple iPhone 7 Plus  移动4G苹果手机 黑色 4G  8G', '3', '99', '7200.00', '0.9', '', '3000.00', '1', 'http://localhost/ShopProject/public/img/dataimg/36729477c4b2915bc23519310bca82ae.jpg', 'http://localhost/ShopProject/public/img/dataimg/ee7ba9fbfbcd4e4f066ac5c5485a4a70.jpg', 'http://localhost/ShopProject/public/img/dataimg/6079c8b8b175b560f774cb39b23894d4.png', '', '2016-11-25 17:51:00');
INSERT INTO `shop_goods` VALUES ('15', 'Apple 苹果 iPhone6s Plus 16G 64 全网通苹果4G 玫瑰金', '3', '201', '7500.00', '0.9', '', '3000.00', '1', 'http://localhost/ShopProject/public/img/dataimg/d1a2902c56b61ab6047a4638fbe4f60c.jpg', 'http://localhost/ShopProject/public/img/dataimg/68958898670c9013c07ca9719918d69e.jpg', 'http://localhost/ShopProject/public/img/dataimg/8c6535a45c65f20306c8275de4550b2a.jpg', '', '2016-11-25 17:51:03');
INSERT INTO `shop_goods` VALUES ('16', '荣耀7 2GB+64GB内存版 荣耀金 全网通4G华为手机 ', '3', '201', '3000.00', '0.7', '荣耀7 全新上市，火热销售中..', '1000.00', '1', 'http://localhost/ShopProject/public/img/dataimg/ecb58d2740c0d1ec893104c3065fbd34.jpg', 'http://localhost/ShopProject/public/img/dataimg/27f69f79d1b63d2bc1dea6332cee9eec.jpg', 'http://localhost/ShopProject/public/img/dataimg/5bc48bd9055a07b816fb71ac3ec1b250.jpg', '', '2016-11-25 17:51:07');
INSERT INTO `shop_goods` VALUES ('17', '华为 畅享5S 金色 16G 内存8G 电信4G华为手机 ', '3', '200', '3000.00', '0.9', '', '1000.00', '1', 'http://localhost/ShopProject/public/img/dataimg/c9da430b2b76c0caccae9aed340094bb.jpg', 'http://localhost/ShopProject/public/img/dataimg/84e24e169a58a35c4d3e2069858e7fb9.jpg', 'http://localhost/ShopProject/public/img/dataimg/f92e7b7fecd110bf409311b9d21b9c69.jpg', '', '2016-11-25 17:51:11');
INSERT INTO `shop_goods` VALUES ('18', '荣耀 畅玩5A 白色 移动4G手机 内存8G 4G 华为手机', '3', '200', '3000.00', '0.7', '荣耀 畅玩5A 辉煌上线', '2000.00', '1', 'http://localhost/ShopProject/public/img/dataimg/6138b55d3210db70ecb00f7a984425f0.jpg', 'http://localhost/ShopProject/public/img/dataimg/5b9462919f7b6ee1af4f0dd7f5b8f6f6.jpg', 'http://localhost/ShopProject/public/img/dataimg/230a66e9e2a626b4385cba2cb1a31c73.jpg', '', '2016-11-25 17:51:17');
INSERT INTO `shop_goods` VALUES ('19', '华为 麦芒5 全网通 4G华为手机  4GB+64GB版 香槟金', '3', '197', '5000.00', '0.9', '', '2000.00', '1', 'http://localhost/ShopProject/public/img/dataimg/dc0a3643d107ddb253326c98323f032e.jpg', 'http://localhost/ShopProject/public/img/dataimg/dc66000529a3a790e4ac4f6e91ac704a.jpg', 'http://localhost/ShopProject/public/img/dataimg/ff6f621ca6e54bbe4b219444e7d0f339.png', 'http://localhost/ShopProject/public/img/dataimg/403a9863ec06eebaa15006476c52401a.jpg', '2016-11-25 17:51:21');
INSERT INTO `shop_goods` VALUES ('20', '华为 G9 青春版 玫瑰金 移动4G华为手机 8G+4G ', '3', '39', '1000.00', '0.8', '', '300.00', '1', 'http://localhost/ShopProject/public/img/dataimg/334096fb4abd93b5aac21864db16e1cd.jpg', 'http://localhost/ShopProject/public/img/dataimg/38134bc3464786fc0d3a339ee0b61c3c.jpg', 'http://localhost/ShopProject/public/img/dataimg/bfa8e7533d2f25ba8aee04c83a677a4a.jpg', '', '2016-11-25 17:51:24');
INSERT INTO `shop_goods` VALUES ('21', '华为 HUAWEI nova 4GB+64GB版 香槟金（黑）电信4G手机 ', '3', '200', '5500.00', '0.5', '', '2000.00', '1', 'http://localhost/ShopProject/public/img/dataimg/9613cf6788cbc1fd16d8d6df9dd1f85f.jpg', 'http://localhost/ShopProject/public/img/dataimg/5b5d0bc4d9f73f93d8fdb3f8394348fa.jpg', 'http://localhost/ShopProject/public/img/dataimg/69a8c290f3b1dd07e674a5e476a8df73.jpg', '', '2016-11-25 17:51:28');
INSERT INTO `shop_goods` VALUES ('22', '魅族 魅蓝3 移动定制版 4G+8GB 白色 移动4G魅族手机 ', '3', '199', '2000.00', '0.8', '魅族 魅蓝3 全新上市！！！', '300.00', '1', 'http://localhost/ShopProject/public/img/dataimg/45fb3fe408fc66194ce1e60a2b715871.jpg', 'http://localhost/ShopProject/public/img/dataimg/9cb5c29c9597743217bdc33f39af1910.jpg', 'http://localhost/ShopProject/public/img/dataimg/30e8bf5747c15b1d0d80aa4760d90be0.jpg', '', '2016-11-25 17:51:57');
INSERT INTO `shop_goods` VALUES ('23', '魅族 MX5e 内存64GB+2G 银白色 全网通4G手机 魅族手机', '3', '100', '1000.00', '0.9', '', '300.00', '1', 'http://localhost/ShopProject/public/img/dataimg/8e068268b42dff63e2066b1799aebc8b.jpg', 'http://localhost/ShopProject/public/img/dataimg/eb295386b866d173a0c0d39a28627cd4.jpg', 'http://localhost/ShopProject/public/img/dataimg/2f0335997b4b2db33fed4a7d36af75df.jpg', '', '2016-11-25 17:51:31');
INSERT INTO `shop_goods` VALUES ('24', '惠普(HP)暗影精灵i5 15.6英寸 2G独显 1T 内存4G  Win10', '35', '199', '5000.00', '0.7', '', '3000.00', '1', 'http://localhost/ShopProject/public/img/dataimg/bb44afbaef8e5878d003bba89473530c.jpg', 'http://localhost/ShopProject/public/img/dataimg/f3e443c947e34222aecf6c6121717a48.jpg', 'http://localhost/ShopProject/public/img/dataimg/de340a117919787439143fe4fd2a0a6a.jpg', '', '2016-12-02 23:38:15');
INSERT INTO `shop_goods` VALUES ('28', '联想（Lenovo） IdeaCentre C560 23英寸一体机电脑', '37', '29', '2000.00', '0.8', '', '800.00', '1', 'http://localhost/ShopProject/public/img/dataimg/2a07640ee59e86fcd38b907e4458b9a6.jpg', 'http://localhost/ShopProject/public/img/dataimg/eb79fb2acd00d8840e4497db4018366b.jpg', 'http://localhost/ShopProject/public/img/dataimg/f194274599a4eac700c97d85e3e0ee5f.jpg', '', '2017-03-23 20:11:36');
INSERT INTO `shop_goods` VALUES ('29', '戴尔(DELL)灵越3650-R5838台式电脑整机(i5-6400 8G 1TB 2G独显 DVD', '37', '199', '5000.00', '0.8', '搭载戴尔23英寸IPS全尺寸高清大屏，大屏幕让你显示更悦目', '2000.00', '1', 'http://localhost/ShopProject/public/img/dataimg/9d55ff1008a18c2f9eb0281abb31b976.jpg', 'http://localhost/ShopProject/public/img/dataimg/964f2a96af3e23a267873a76af9bd2fb.jpg', 'http://localhost/ShopProject/public/img/dataimg/7ebd65a6cec8030376ea687190f33a41.jpg', '', '2017-03-25 16:47:02');

-- ----------------------------
-- Table structure for shop_goods_attr
-- ----------------------------
DROP TABLE IF EXISTS `shop_goods_attr`;
CREATE TABLE `shop_goods_attr` (
  `gid` int(50) NOT NULL,
  `avid` int(50) NOT NULL,
  `attr_id` int(50) NOT NULL,
  `value` varchar(50) NOT NULL,
  PRIMARY KEY (`gid`,`avid`),
  KEY `attr_id` (`attr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_goods_attr
-- ----------------------------
INSERT INTO `shop_goods_attr` VALUES ('6', '6', '3', '');
INSERT INTO `shop_goods_attr` VALUES ('6', '15', '6', '');
INSERT INTO `shop_goods_attr` VALUES ('6', '19', '7', '');
INSERT INTO `shop_goods_attr` VALUES ('6', '24', '2', '');
INSERT INTO `shop_goods_attr` VALUES ('6', '25', '4', '');
INSERT INTO `shop_goods_attr` VALUES ('6', '26', '5', '');
INSERT INTO `shop_goods_attr` VALUES ('6', '30', '11', '');
INSERT INTO `shop_goods_attr` VALUES ('7', '2', '2', '');
INSERT INTO `shop_goods_attr` VALUES ('7', '6', '3', '');
INSERT INTO `shop_goods_attr` VALUES ('7', '8', '4', '');
INSERT INTO `shop_goods_attr` VALUES ('7', '15', '6', '');
INSERT INTO `shop_goods_attr` VALUES ('7', '19', '7', '');
INSERT INTO `shop_goods_attr` VALUES ('7', '26', '5', '');
INSERT INTO `shop_goods_attr` VALUES ('7', '29', '11', '');
INSERT INTO `shop_goods_attr` VALUES ('8', '2', '2', '');
INSERT INTO `shop_goods_attr` VALUES ('8', '7', '3', '');
INSERT INTO `shop_goods_attr` VALUES ('8', '8', '4', '');
INSERT INTO `shop_goods_attr` VALUES ('8', '14', '6', '');
INSERT INTO `shop_goods_attr` VALUES ('8', '18', '7', '');
INSERT INTO `shop_goods_attr` VALUES ('8', '23', '5', '');
INSERT INTO `shop_goods_attr` VALUES ('8', '28', '11', '');
INSERT INTO `shop_goods_attr` VALUES ('9', '2', '2', '');
INSERT INTO `shop_goods_attr` VALUES ('9', '5', '3', '');
INSERT INTO `shop_goods_attr` VALUES ('9', '13', '6', '');
INSERT INTO `shop_goods_attr` VALUES ('9', '17', '7', '');
INSERT INTO `shop_goods_attr` VALUES ('9', '23', '5', '');
INSERT INTO `shop_goods_attr` VALUES ('9', '28', '11', '');
INSERT INTO `shop_goods_attr` VALUES ('9', '53', '4', '');
INSERT INTO `shop_goods_attr` VALUES ('10', '4', '3', '');
INSERT INTO `shop_goods_attr` VALUES ('10', '16', '6', '');
INSERT INTO `shop_goods_attr` VALUES ('10', '19', '7', '');
INSERT INTO `shop_goods_attr` VALUES ('10', '24', '2', '');
INSERT INTO `shop_goods_attr` VALUES ('10', '26', '5', '');
INSERT INTO `shop_goods_attr` VALUES ('10', '29', '11', '');
INSERT INTO `shop_goods_attr` VALUES ('10', '54', '4', '');
INSERT INTO `shop_goods_attr` VALUES ('11', '4', '3', '');
INSERT INTO `shop_goods_attr` VALUES ('11', '15', '6', '');
INSERT INTO `shop_goods_attr` VALUES ('11', '18', '7', '');
INSERT INTO `shop_goods_attr` VALUES ('11', '23', '5', '');
INSERT INTO `shop_goods_attr` VALUES ('11', '24', '2', '');
INSERT INTO `shop_goods_attr` VALUES ('11', '25', '4', '');
INSERT INTO `shop_goods_attr` VALUES ('11', '28', '11', '');
INSERT INTO `shop_goods_attr` VALUES ('12', '7', '3', '');
INSERT INTO `shop_goods_attr` VALUES ('12', '16', '6', '');
INSERT INTO `shop_goods_attr` VALUES ('12', '18', '7', '');
INSERT INTO `shop_goods_attr` VALUES ('12', '24', '2', '');
INSERT INTO `shop_goods_attr` VALUES ('12', '26', '5', '');
INSERT INTO `shop_goods_attr` VALUES ('12', '29', '11', '');
INSERT INTO `shop_goods_attr` VALUES ('12', '53', '4', '');
INSERT INTO `shop_goods_attr` VALUES ('13', '4', '3', '');
INSERT INTO `shop_goods_attr` VALUES ('13', '8', '4', '');
INSERT INTO `shop_goods_attr` VALUES ('13', '13', '6', '');
INSERT INTO `shop_goods_attr` VALUES ('13', '17', '7', '');
INSERT INTO `shop_goods_attr` VALUES ('13', '23', '5', '');
INSERT INTO `shop_goods_attr` VALUES ('13', '24', '2', '');
INSERT INTO `shop_goods_attr` VALUES ('13', '28', '11', '');
INSERT INTO `shop_goods_attr` VALUES ('14', '7', '3', '');
INSERT INTO `shop_goods_attr` VALUES ('14', '16', '6', '');
INSERT INTO `shop_goods_attr` VALUES ('14', '18', '7', '');
INSERT INTO `shop_goods_attr` VALUES ('14', '23', '5', '');
INSERT INTO `shop_goods_attr` VALUES ('14', '24', '2', '');
INSERT INTO `shop_goods_attr` VALUES ('14', '30', '11', '');
INSERT INTO `shop_goods_attr` VALUES ('14', '53', '4', '');
INSERT INTO `shop_goods_attr` VALUES ('15', '6', '3', '');
INSERT INTO `shop_goods_attr` VALUES ('15', '16', '6', '');
INSERT INTO `shop_goods_attr` VALUES ('15', '19', '7', '');
INSERT INTO `shop_goods_attr` VALUES ('15', '24', '2', '');
INSERT INTO `shop_goods_attr` VALUES ('15', '25', '4', '');
INSERT INTO `shop_goods_attr` VALUES ('15', '26', '5', '');
INSERT INTO `shop_goods_attr` VALUES ('15', '29', '11', '');
INSERT INTO `shop_goods_attr` VALUES ('16', '3', '2', '');
INSERT INTO `shop_goods_attr` VALUES ('16', '6', '3', '');
INSERT INTO `shop_goods_attr` VALUES ('16', '8', '4', '');
INSERT INTO `shop_goods_attr` VALUES ('16', '14', '6', '');
INSERT INTO `shop_goods_attr` VALUES ('16', '17', '7', '');
INSERT INTO `shop_goods_attr` VALUES ('16', '26', '5', '');
INSERT INTO `shop_goods_attr` VALUES ('16', '29', '11', '');
INSERT INTO `shop_goods_attr` VALUES ('17', '3', '2', '');
INSERT INTO `shop_goods_attr` VALUES ('17', '5', '3', '');
INSERT INTO `shop_goods_attr` VALUES ('17', '14', '6', '');
INSERT INTO `shop_goods_attr` VALUES ('17', '17', '7', '');
INSERT INTO `shop_goods_attr` VALUES ('17', '23', '5', '');
INSERT INTO `shop_goods_attr` VALUES ('17', '25', '4', '');
INSERT INTO `shop_goods_attr` VALUES ('17', '28', '11', '');
INSERT INTO `shop_goods_attr` VALUES ('18', '3', '2', '');
INSERT INTO `shop_goods_attr` VALUES ('18', '7', '3', '');
INSERT INTO `shop_goods_attr` VALUES ('18', '11', '5', '');
INSERT INTO `shop_goods_attr` VALUES ('18', '14', '6', '');
INSERT INTO `shop_goods_attr` VALUES ('18', '17', '7', '');
INSERT INTO `shop_goods_attr` VALUES ('18', '28', '11', '');
INSERT INTO `shop_goods_attr` VALUES ('18', '54', '4', '');
INSERT INTO `shop_goods_attr` VALUES ('19', '3', '2', '');
INSERT INTO `shop_goods_attr` VALUES ('19', '6', '3', '');
INSERT INTO `shop_goods_attr` VALUES ('19', '11', '5', '');
INSERT INTO `shop_goods_attr` VALUES ('19', '15', '6', '');
INSERT INTO `shop_goods_attr` VALUES ('19', '19', '7', '');
INSERT INTO `shop_goods_attr` VALUES ('19', '30', '11', '');
INSERT INTO `shop_goods_attr` VALUES ('19', '53', '4', '');
INSERT INTO `shop_goods_attr` VALUES ('20', '3', '2', '');
INSERT INTO `shop_goods_attr` VALUES ('20', '7', '3', '');
INSERT INTO `shop_goods_attr` VALUES ('20', '11', '5', '');
INSERT INTO `shop_goods_attr` VALUES ('20', '13', '6', '');
INSERT INTO `shop_goods_attr` VALUES ('20', '17', '7', '');
INSERT INTO `shop_goods_attr` VALUES ('20', '30', '11', '');
INSERT INTO `shop_goods_attr` VALUES ('20', '54', '4', '');
INSERT INTO `shop_goods_attr` VALUES ('21', '3', '2', '');
INSERT INTO `shop_goods_attr` VALUES ('21', '5', '3', '');
INSERT INTO `shop_goods_attr` VALUES ('21', '14', '6', '');
INSERT INTO `shop_goods_attr` VALUES ('21', '17', '7', '');
INSERT INTO `shop_goods_attr` VALUES ('21', '26', '5', '');
INSERT INTO `shop_goods_attr` VALUES ('21', '28', '11', '');
INSERT INTO `shop_goods_attr` VALUES ('21', '53', '4', '');
INSERT INTO `shop_goods_attr` VALUES ('22', '7', '3', '');
INSERT INTO `shop_goods_attr` VALUES ('22', '13', '6', '');
INSERT INTO `shop_goods_attr` VALUES ('22', '17', '7', '');
INSERT INTO `shop_goods_attr` VALUES ('22', '23', '5', '');
INSERT INTO `shop_goods_attr` VALUES ('22', '28', '11', '');
INSERT INTO `shop_goods_attr` VALUES ('22', '52', '2', '');
INSERT INTO `shop_goods_attr` VALUES ('22', '53', '4', '');
INSERT INTO `shop_goods_attr` VALUES ('23', '6', '3', '');
INSERT INTO `shop_goods_attr` VALUES ('23', '8', '4', '');
INSERT INTO `shop_goods_attr` VALUES ('23', '13', '6', '');
INSERT INTO `shop_goods_attr` VALUES ('23', '17', '7', '');
INSERT INTO `shop_goods_attr` VALUES ('23', '26', '5', '');
INSERT INTO `shop_goods_attr` VALUES ('23', '28', '11', '');
INSERT INTO `shop_goods_attr` VALUES ('23', '52', '2', '');
INSERT INTO `shop_goods_attr` VALUES ('24', '33', '12', '');
INSERT INTO `shop_goods_attr` VALUES ('24', '36', '15', '');
INSERT INTO `shop_goods_attr` VALUES ('24', '39', '17', '');
INSERT INTO `shop_goods_attr` VALUES ('24', '44', '19', '');
INSERT INTO `shop_goods_attr` VALUES ('24', '45', '20', '');
INSERT INTO `shop_goods_attr` VALUES ('24', '48', '21', '');
INSERT INTO `shop_goods_attr` VALUES ('24', '56', '18', '');
INSERT INTO `shop_goods_attr` VALUES ('28', '31', '12', '');
INSERT INTO `shop_goods_attr` VALUES ('28', '35', '15', '');
INSERT INTO `shop_goods_attr` VALUES ('28', '38', '17', '');
INSERT INTO `shop_goods_attr` VALUES ('28', '41', '19', '');
INSERT INTO `shop_goods_attr` VALUES ('28', '45', '20', '');
INSERT INTO `shop_goods_attr` VALUES ('28', '48', '21', '');
INSERT INTO `shop_goods_attr` VALUES ('28', '55', '18', '');
INSERT INTO `shop_goods_attr` VALUES ('29', '32', '12', '');
INSERT INTO `shop_goods_attr` VALUES ('29', '36', '15', '');
INSERT INTO `shop_goods_attr` VALUES ('29', '39', '17', '');
INSERT INTO `shop_goods_attr` VALUES ('29', '44', '19', '');
INSERT INTO `shop_goods_attr` VALUES ('29', '45', '20', '');
INSERT INTO `shop_goods_attr` VALUES ('29', '48', '21', '');
INSERT INTO `shop_goods_attr` VALUES ('29', '55', '18', '');

-- ----------------------------
-- Table structure for shop_message
-- ----------------------------
DROP TABLE IF EXISTS `shop_message`;
CREATE TABLE `shop_message` (
  `mid` int(50) NOT NULL AUTO_INCREMENT,
  `sendid` varchar(50) NOT NULL,
  `receiveid` varchar(50) NOT NULL,
  `sendname` varchar(50) NOT NULL,
  `receivename` varchar(50) NOT NULL,
  `sendtime` datetime NOT NULL,
  `ctmess` varchar(500) NOT NULL,
  `state` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`mid`),
  KEY `sendid` (`sendid`),
  KEY `receiveid` (`receiveid`),
  KEY `receivename` (`receivename`),
  KEY `sendtime` (`sendtime`),
  KEY `state` (`state`),
  KEY `sendname` (`sendname`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_message
-- ----------------------------
INSERT INTO `shop_message` VALUES ('13', '1', '20161223195666', 'fy103123', '方瑶', '2017-03-23 20:44:45', '尽快发货', '0');
INSERT INTO `shop_message` VALUES ('14', '1', '20161223195666', 'fy103123', '方瑶', '2017-03-25 09:31:15', '在吗？', '0');
INSERT INTO `shop_message` VALUES ('15', '2', '20161223195666', 'fy121212', '方瑶', '2017-03-25 09:33:15', '哦', '0');
INSERT INTO `shop_message` VALUES ('16', '1', '20161223195666', 'fy103123', '方瑶', '2017-03-25 09:36:15', '2', '0');

-- ----------------------------
-- Table structure for shop_order
-- ----------------------------
DROP TABLE IF EXISTS `shop_order`;
CREATE TABLE `shop_order` (
  `oid` int(50) NOT NULL AUTO_INCREMENT,
  `ocode` varchar(50) NOT NULL,
  `uid` int(50) NOT NULL,
  `rec_id` int(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `osid` int(50) NOT NULL DEFAULT '1',
  `comptime` datetime DEFAULT NULL,
  `paytime` datetime DEFAULT NULL,
  `sendtime` datetime DEFAULT NULL,
  `message` varchar(150) DEFAULT NULL,
  `gsid` int(50) NOT NULL DEFAULT '1',
  PRIMARY KEY (`oid`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_order
-- ----------------------------
INSERT INTO `shop_order` VALUES ('13', '120161129092756', '1', '6', '2016-11-29 09:27:56', '2016-11-29 09:31:14', '4', '2016-11-29 09:30:44', '2016-11-29 09:29:09', '2016-11-29 09:29:59', '', '3');
INSERT INTO `shop_order` VALUES ('16', '120161224115202', '1', '6', '2016-12-24 11:52:02', '2016-12-24 11:57:08', '2', null, '2016-12-24 11:54:07', '2016-12-24 11:57:08', '', '2');
INSERT INTO `shop_order` VALUES ('20', '120170325112634', '1', '6', '2017-03-25 11:26:34', '2017-03-25 11:26:34', '1', null, null, null, '', '1');
INSERT INTO `shop_order` VALUES ('21', '120170326102618', '1', '6', '2017-03-26 10:26:18', '2017-03-26 10:27:53', '4', '2017-03-26 10:27:53', '2017-03-26 10:26:36', '2017-03-26 10:27:33', '', '2');

-- ----------------------------
-- Table structure for shop_recaddress
-- ----------------------------
DROP TABLE IF EXISTS `shop_recaddress`;
CREATE TABLE `shop_recaddress` (
  `rec_id` int(50) NOT NULL AUTO_INCREMENT,
  `uid` varchar(50) NOT NULL,
  `recname` varchar(50) NOT NULL,
  `tel` varchar(11) NOT NULL,
  `province` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `county` varchar(50) NOT NULL,
  `detail` varchar(500) NOT NULL,
  `postcode` int(6) DEFAULT NULL,
  PRIMARY KEY (`rec_id`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_recaddress
-- ----------------------------
INSERT INTO `shop_recaddress` VALUES ('6', '1', '方瑶', '13159119108', '福建省', '漳州市', '漳浦县', '绥安镇王鼎北4号', '363200');
INSERT INTO `shop_recaddress` VALUES ('7', '1', '方煌', '13159119108', '福建省', '厦门市', '思明区', '软件园二期莲前街道观日路50号之一306', '362000');
INSERT INTO `shop_recaddress` VALUES ('8', '1', '蔡聪斌', '13159119108', '福建省', '漳州市', '漳浦县', '绥安镇大亭路', '363200');
INSERT INTO `shop_recaddress` VALUES ('9', '1', '连爱情', '13159119108', '北京市', '市辖县', '延庆县', '这里是详细地址', '365688');

-- ----------------------------
-- Table structure for shop_role
-- ----------------------------
DROP TABLE IF EXISTS `shop_role`;
CREATE TABLE `shop_role` (
  `role_id` int(50) NOT NULL AUTO_INCREMENT,
  `rname` varchar(50) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_role
-- ----------------------------
INSERT INTO `shop_role` VALUES ('1', '系统管理员');
INSERT INTO `shop_role` VALUES ('2', '普通管理员');

-- ----------------------------
-- Table structure for shop_status_goods
-- ----------------------------
DROP TABLE IF EXISTS `shop_status_goods`;
CREATE TABLE `shop_status_goods` (
  `gsid` int(50) NOT NULL AUTO_INCREMENT,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`gsid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_status_goods
-- ----------------------------
INSERT INTO `shop_status_goods` VALUES ('1', '未发货');
INSERT INTO `shop_status_goods` VALUES ('2', '已发货');
INSERT INTO `shop_status_goods` VALUES ('3', '已签收');

-- ----------------------------
-- Table structure for shop_status_order
-- ----------------------------
DROP TABLE IF EXISTS `shop_status_order`;
CREATE TABLE `shop_status_order` (
  `osid` int(50) NOT NULL AUTO_INCREMENT,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`osid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_status_order
-- ----------------------------
INSERT INTO `shop_status_order` VALUES ('1', '未付款');
INSERT INTO `shop_status_order` VALUES ('2', '已付款');
INSERT INTO `shop_status_order` VALUES ('3', '已取消');
INSERT INTO `shop_status_order` VALUES ('4', '已完成');

-- ----------------------------
-- Table structure for shop_user
-- ----------------------------
DROP TABLE IF EXISTS `shop_user`;
CREATE TABLE `shop_user` (
  `uid` int(50) NOT NULL AUTO_INCREMENT,
  `uname` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `gender` tinyint(4) NOT NULL DEFAULT '1',
  `age` int(3) NOT NULL DEFAULT '16',
  `email` varchar(50) DEFAULT NULL,
  `tel` varchar(11) DEFAULT NULL,
  `birth` varchar(50) DEFAULT NULL,
  `nickname` varchar(50) DEFAULT NULL,
  `memo` varchar(150) DEFAULT NULL,
  `image` varchar(200) NOT NULL DEFAULT 'http://localhost/ShopProject/public/img/dataimg/uid.jpg',
  `loan` decimal(15,2) NOT NULL DEFAULT '99999.00',
  `lasttime` datetime NOT NULL,
  `deleted_at` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_user
-- ----------------------------
INSERT INTO `shop_user` VALUES ('1', 'fy103123', '1234567', '1', '23', '103123@qq.com', '', '', '啊尼', '', 'http://localhost/ShopProject/public/img/dataimg/b3ec95bfd03f6a6d29b93984c350dd64.jpg', '995999.00', '2017-03-26 10:25:38', '0');
INSERT INTO `shop_user` VALUES ('2', 'fy121212', '123456', '1', '23', '', '', null, '小陈', null, 'http://localhost/ShopProject/public/img/dataimg/uid.jpg', '99999.00', '2016-12-23 23:24:26', '0');
INSERT INTO `shop_user` VALUES ('3', 'fy121213', '123456', '1', '16', null, null, null, null, null, 'http://localhost/ShopProject/public/img/dataimg/uid.jpg', '99999.00', '2016-12-24 11:50:36', '0');
INSERT INTO `shop_user` VALUES ('4', 'fy103123s', '123456', '1', '16', null, null, null, null, null, 'http://localhost/ShopProject/public/img/dataimg/uid.jpg', '99999.00', '2017-03-23 19:55:54', '0');
INSERT INTO `shop_user` VALUES ('5', 'fy909090', '123456', '1', '16', null, null, null, null, null, 'http://localhost/ShopProject/public/img/dataimg/uid.jpg', '99999.00', '2017-03-23 19:56:23', '0');
