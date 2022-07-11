/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100424
 Source Host           : localhost:3306
 Source Schema         : stock_it

 Target Server Type    : MySQL
 Target Server Version : 100424
 File Encoding         : 65001

 Date: 06/07/2022 16:11:49
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for koffice
-- ----------------------------
DROP TABLE IF EXISTS `koffice`;
CREATE TABLE `koffice`  (
  `k_id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `k_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`k_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 46 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of koffice
-- ----------------------------
INSERT INTO `koffice` VALUES (001, 'IT');
INSERT INTO `koffice` VALUES (002, 'ห้องฟัน');
INSERT INTO `koffice` VALUES (003, 'NCD');
INSERT INTO `koffice` VALUES (004, 'ARI');
INSERT INTO `koffice` VALUES (005, 'ห้องยา');
INSERT INTO `koffice` VALUES (006, 'ห้องบัตร');
INSERT INTO `koffice` VALUES (007, 'ER');
INSERT INTO `koffice` VALUES (008, 'TB');
INSERT INTO `koffice` VALUES (010, 'ddd');
INSERT INTO `koffice` VALUES (012, 'aaa');
INSERT INTO `koffice` VALUES (013, 'ss');
INSERT INTO `koffice` VALUES (014, 'ee');
INSERT INTO `koffice` VALUES (015, 'tt');
INSERT INTO `koffice` VALUES (016, '66');
INSERT INTO `koffice` VALUES (017, 'asdasd');
INSERT INTO `koffice` VALUES (018, 'IT');
INSERT INTO `koffice` VALUES (019, 'asasasa');
INSERT INTO `koffice` VALUES (020, 'qqq');
INSERT INTO `koffice` VALUES (021, 'zzz');
INSERT INTO `koffice` VALUES (022, 'zzz2');
INSERT INTO `koffice` VALUES (023, 'd2');
INSERT INTO `koffice` VALUES (024, 'it2');
INSERT INTO `koffice` VALUES (025, '1');
INSERT INTO `koffice` VALUES (026, '2');
INSERT INTO `koffice` VALUES (027, '3');
INSERT INTO `koffice` VALUES (028, '4');
INSERT INTO `koffice` VALUES (029, '5');
INSERT INTO `koffice` VALUES (030, '6');
INSERT INTO `koffice` VALUES (031, '7');
INSERT INTO `koffice` VALUES (032, '8');
INSERT INTO `koffice` VALUES (033, '9');
INSERT INTO `koffice` VALUES (034, '10');
INSERT INTO `koffice` VALUES (035, '12');
INSERT INTO `koffice` VALUES (036, '13');
INSERT INTO `koffice` VALUES (037, '14');
INSERT INTO `koffice` VALUES (038, '15');
INSERT INTO `koffice` VALUES (039, '16');
INSERT INTO `koffice` VALUES (040, '17');
INSERT INTO `koffice` VALUES (041, '18');
INSERT INTO `koffice` VALUES (042, '19');
INSERT INTO `koffice` VALUES (043, '21');
INSERT INTO `koffice` VALUES (044, '20');
INSERT INTO `koffice` VALUES (045, 'qq1');

-- ----------------------------
-- Table structure for material
-- ----------------------------
DROP TABLE IF EXISTS `material`;
CREATE TABLE `material`  (
  `m_id` int NOT NULL AUTO_INCREMENT,
  `m_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `m_price` float NULL DEFAULT NULL,
  `m_number` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `m_date` date NULL DEFAULT NULL,
  `m_time` time NULL DEFAULT NULL,
  `m_detail` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `m_image` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `m_s_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`m_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of material
-- ----------------------------
INSERT INTO `material` VALUES (1, 'test2222', 1244, '12', '2022-07-05', '13:43:00', 'test222', '20220705562095945.jpg', 4);
INSERT INTO `material` VALUES (2, 'gsf///', 123, '66', '2022-07-05', '13:44:00', '55555', '202207051525235756.png', 2);

-- ----------------------------
-- Table structure for pname
-- ----------------------------
DROP TABLE IF EXISTS `pname`;
CREATE TABLE `pname`  (
  `pname_id` int NOT NULL,
  `pname_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`pname_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of pname
-- ----------------------------
INSERT INTO `pname` VALUES (1, 'นาย');
INSERT INTO `pname` VALUES (2, 'นาง');
INSERT INTO `pname` VALUES (3, 'น.ส.');

-- ----------------------------
-- Table structure for status
-- ----------------------------
DROP TABLE IF EXISTS `status`;
CREATE TABLE `status`  (
  `status_id` int NOT NULL,
  `status_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`status_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of status
-- ----------------------------
INSERT INTO `status` VALUES (1, 'อนุมัติ');
INSERT INTO `status` VALUES (2, 'รออนุมัติ');

-- ----------------------------
-- Table structure for tool
-- ----------------------------
DROP TABLE IF EXISTS `tool`;
CREATE TABLE `tool`  (
  `tool_id` int NOT NULL,
  `tool_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tool_price` float NOT NULL,
  `tool_type` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tool_qty` int NOT NULL,
  `tool_date_import` date NOT NULL,
  `tool_time_import` time NOT NULL,
  PRIMARY KEY (`tool_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tool
-- ----------------------------

-- ----------------------------
-- Table structure for tool_type
-- ----------------------------
DROP TABLE IF EXISTS `tool_type`;
CREATE TABLE `tool_type`  (
  `tool_type_id` int NOT NULL,
  `tool_type_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`tool_type_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tool_type
-- ----------------------------

-- ----------------------------
-- Table structure for txtoffice
-- ----------------------------
DROP TABLE IF EXISTS `txtoffice`;
CREATE TABLE `txtoffice`  (
  `txtoffice_id` int NOT NULL,
  `txtoffice_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`txtoffice_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of txtoffice
-- ----------------------------
INSERT INTO `txtoffice` VALUES (1, 'IT');
INSERT INTO `txtoffice` VALUES (2, 'ER');

-- ----------------------------
-- Table structure for type_stock
-- ----------------------------
DROP TABLE IF EXISTS `type_stock`;
CREATE TABLE `type_stock`  (
  `s_id` int NOT NULL AUTO_INCREMENT,
  `s_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`s_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of type_stock
-- ----------------------------
INSERT INTO `type_stock` VALUES (1, 'อุปกรณ์คอมพิวเตอร์');
INSERT INTO `type_stock` VALUES (2, 'อุปกรณ์ปริ้นเตอร์');
INSERT INTO `type_stock` VALUES (3, 'อุปกรณ์อินเตอร์เน็ต');
INSERT INTO `type_stock` VALUES (4, 'อุปกรณ์อื่นๆ');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `pname` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `fullname` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `cid` varchar(13) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tel` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ulevel` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `txtoffice` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `position` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`user_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'นาย', 'ศรายุทธ นวะศรี', '1400900249352', '0980877876', 'admin', 'IT', 'นักวิชาการคอมพิวเตอร์ ', 'อนุมัติ');
INSERT INTO `users` VALUES (2, 'user', 'e10adc3949ba59abbe56e057f20f883e', 'นาง', 'fnameuser', '1234567891234', '0912345678', 'member', 'it', 'computer', 'อนุมัติ');
INSERT INTO `users` VALUES (3, 'user2', 'e10adc3949ba59abbe56e057f20f883e', 'นาย', 'fnameuser', '1234567891234', '0912345678', 'member', 'it', 'computer', 'อนุมัติ');

SET FOREIGN_KEY_CHECKS = 1;
