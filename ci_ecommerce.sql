-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 08, 2017 at 08:01 PM
-- Server version: 5.7.18-0ubuntu0.16.04.1
-- PHP Version: 7.0.17-3+deb.sury.org~xenial+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci_ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_admin_modules`
--

CREATE TABLE `ci_admin_modules` (
  `module_id` int(11) NOT NULL COMMENT 'This will store the module id',
  `module_name` text NOT NULL COMMENT 'This will store the module names (Names of the controllers)'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_admin_modules`
--

INSERT INTO `ci_admin_modules` (`module_id`, `module_name`) VALUES
(2, 'dashboard'),
(4, 'users'),
(5, 'categories'),
(6, 'subcategories'),
(7, 'brands'),
(8, 'vendors'),
(9, 'product'),
(10, 'sales');

-- --------------------------------------------------------

--
-- Table structure for table `ci_areas_covered`
--

CREATE TABLE `ci_areas_covered` (
  `area_id` bigint(20) NOT NULL,
  `area_name` varchar(255) NOT NULL,
  `area_pin` int(11) NOT NULL,
  `created_id` bigint(20) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_id` bigint(20) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `deleted_id` bigint(20) DEFAULT NULL,
  `deleted_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_areas_covered`
--

INSERT INTO `ci_areas_covered` (`area_id`, `area_name`, `area_pin`, `created_id`, `created_date`, `updated_id`, `updated_date`, `deleted_id`, `deleted_date`) VALUES
(1, 'Pune', 411014, 1, '2017-07-08 23:32:36', NULL, NULL, NULL, NULL),
(2, 'Mumbai', 411001, 1, '2017-07-08 23:32:36', NULL, NULL, NULL, NULL),
(3, 'Patna', 800001, 1, '2017-07-08 23:32:36', NULL, NULL, NULL, NULL),
(4, 'Buxar', 802101, 1, '2017-07-08 23:32:36', NULL, NULL, NULL, NULL),
(5, 'Wagholi', 412207, 1, '2017-07-08 23:32:36', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ci_backend_users`
--

CREATE TABLE `ci_backend_users` (
  `admin_id` int(11) NOT NULL COMMENT 'The backend users ID users',
  `admin_username` varchar(255) NOT NULL COMMENT 'username',
  `admin_password` varchar(255) NOT NULL COMMENT 'password',
  `user_type` text NOT NULL COMMENT 'the user type',
  `admin_name` char(255) NOT NULL COMMENT 'name of the backend user',
  `admin_email` varchar(255) NOT NULL COMMENT 'email of the backend user',
  `admin_mobile` varchar(255) NOT NULL COMMENT 'mobile of the backend user',
  `creator_id` int(11) NOT NULL COMMENT 'the id of the admin who created this user',
  `created_date` date NOT NULL COMMENT 'the date on which the user was created'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_backend_users`
--

INSERT INTO `ci_backend_users` (`admin_id`, `admin_username`, `admin_password`, `user_type`, `admin_name`, `admin_email`, `admin_mobile`, `creator_id`, `created_date`) VALUES
(1, 'admin', 'admin', '1', 'admin', 'contact@mywebadmin.in', '999999999', 1, '2014-08-25');

-- --------------------------------------------------------

--
-- Table structure for table `ci_backend_usertype`
--

CREATE TABLE `ci_backend_usertype` (
  `user_type_id` int(11) NOT NULL,
  `user_type_name` text NOT NULL,
  `user_type_dpname` text NOT NULL,
  `allowed_links` text NOT NULL,
  `disallowed_sub_links` text NOT NULL COMMENT 'list of links not allowed in modules'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_backend_usertype`
--

INSERT INTO `ci_backend_usertype` (`user_type_id`, `user_type_name`, `user_type_dpname`, `allowed_links`, `disallowed_sub_links`) VALUES
(1, 'admin', 'Admin', '*', '');

-- --------------------------------------------------------

--
-- Table structure for table `ci_brands`
--

CREATE TABLE `ci_brands` (
  `brand_id` int(11) NOT NULL COMMENT 'The brand ID of the brand',
  `brand_name` text NOT NULL COMMENT 'Name of the Brand ',
  `brand_image` varchar(255) NOT NULL COMMENT 'Image url for brand logo',
  `brand_description` text NOT NULL COMMENT 'Description about the brand',
  `display_status` enum('0','1') NOT NULL DEFAULT '1',
  `created_id` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_id` int(11) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `deleted_id` int(11) DEFAULT NULL,
  `deleted_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_brands`
--

INSERT INTO `ci_brands` (`brand_id`, `brand_name`, `brand_image`, `brand_description`, `display_status`, `created_id`, `created_date`, `updated_id`, `updated_date`, `deleted_id`, `deleted_date`) VALUES
(1, 'Dove', 'http://localhost/ramesh/ecommerce/custom/images?img=YTo1OntzOjQ6ImJhc2UiO3M6NzoidXBsb2FkcyI7czo0OiJ0eXBlIjtzOjY6ImJyYW5kcyI7czozOiJpbWciO3M6MjI6ImJyYW5kc18xNDk5NTM5MTQyMS5qcGciO3M6NToid2lkdGgiO2k6MTAwO3M6NjoiaGVpZ2h0IjtpOjEwMDt9', 'xas sa fds fsd fdsf<br>', '1', 1, '2017-07-09 00:09:02', NULL, NULL, NULL, NULL),
(2, 'Everest', 'http://localhost/ramesh/ecommerce/custom/images?img=YTo1OntzOjQ6ImJhc2UiO3M6NzoidXBsb2FkcyI7czo0OiJ0eXBlIjtzOjY6ImJyYW5kcyI7czozOiJpbWciO3M6MjM6ImJyYW5kc18xNDk5NTM5MTQyMTEuanBnIjtzOjU6IndpZHRoIjtpOjEwMDtzOjY6ImhlaWdodCI7aToxMDA7fQ==', 'a dsas dsadfsfds<br>', '1', 1, '2017-07-09 00:09:02', NULL, NULL, NULL, NULL),
(3, 'Everyuth', 'http://localhost/ramesh/ecommerce/custom/images?img=YTo1OntzOjQ6ImJhc2UiO3M6NzoidXBsb2FkcyI7czo0OiJ0eXBlIjtzOjY6ImJyYW5kcyI7czozOiJpbWciO3M6MjM6ImJyYW5kc18xNDk5NTM5MTQyMTIuanBnIjtzOjU6IndpZHRoIjtpOjEwMDtzOjY6ImhlaWdodCI7aToxMDA7fQ==', 'dsa dfds fds fds fds<br>', '1', 1, '2017-07-09 00:09:02', NULL, NULL, NULL, NULL),
(4, 'Fair & Lovely', 'http://localhost/ramesh/ecommerce/custom/images?img=YTo1OntzOjQ6ImJhc2UiO3M6NzoidXBsb2FkcyI7czo0OiJ0eXBlIjtzOjY6ImJyYW5kcyI7czozOiJpbWciO3M6MjM6ImJyYW5kc18xNDk5NTM5MTQyMTMuanBnIjtzOjU6IndpZHRoIjtpOjEwMDtzOjY6ImhlaWdodCI7aToxMDA7fQ==', 'sda dsa fsd fds fd<br>', '1', 1, '2017-07-09 00:09:02', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ci_carousel`
--

CREATE TABLE `ci_carousel` (
  `carousel_id` bigint(20) NOT NULL,
  `carousel_image` varchar(255) NOT NULL,
  `carousel_link` varchar(255) NOT NULL,
  `carousel_caption` text NOT NULL,
  `display_status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_carousel`
--

INSERT INTO `ci_carousel` (`carousel_id`, `carousel_image`, `carousel_link`, `carousel_caption`, `display_status`) VALUES
(1, 'http://localhost/ramesh/ecommerce/custom/images?img=YTo1OntzOjQ6ImJhc2UiO3M6NzoidXBsb2FkcyI7czo0OiJ0eXBlIjtzOjg6ImNhcm91c2VsIjtzOjM6ImltZyI7czoyNDoiY2Fyb3VzZWxfMTQ5OTUzNDQwMDEuanBnIjtzOjU6IndpZHRoIjtpOjEwMDtzOjY6ImhlaWdodCI7aToxMDA7fQ==', 'http://google.com', 'Book your desired service that serves directly to you in your desired time-slot at a reasonable cost. ', '1'),
(2, 'http://localhost/ramesh/ecommerce/custom/images?img=YTo1OntzOjQ6ImJhc2UiO3M6NzoidXBsb2FkcyI7czo0OiJ0eXBlIjtzOjg6ImNhcm91c2VsIjtzOjM6ImltZyI7czoyNDoiY2Fyb3VzZWxfMTQ5OTUzNDk4NzEuanBnIjtzOjU6IndpZHRoIjtpOjEwMDtzOjY6ImhlaWdodCI7aToxMDA7fQ==', 'http://www.google.com', 'Book your desired service that serves directly to you in your desired time-slot at a reasonable cost. ', '1'),
(3, 'http://localhost/ramesh/ecommerce/custom/images?img=YTo1OntzOjQ6ImJhc2UiO3M6NzoidXBsb2FkcyI7czo0OiJ0eXBlIjtzOjg6ImNhcm91c2VsIjtzOjM6ImltZyI7czoyNDoiY2Fyb3VzZWxfMTQ5OTUzNDk5OTEuanBnIjtzOjU6IndpZHRoIjtpOjEwMDtzOjY6ImhlaWdodCI7aToxMDA7fQ==', 'http://google.com', 'Book your desired service that serves directly to you in your desired time-slot at a reasonable cost. ', '1'),
(4, 'http://localhost/ramesh/ecommerce/custom/images?img=YTo1OntzOjQ6ImJhc2UiO3M6NzoidXBsb2FkcyI7czo0OiJ0eXBlIjtzOjg6ImNhcm91c2VsIjtzOjM6ImltZyI7czoyNDoiY2Fyb3VzZWxfMTQ5OTUzNTA1MDEuanBnIjtzOjU6IndpZHRoIjtpOjEwMDtzOjY6ImhlaWdodCI7aToxMDA7fQ==', 'http://www.google.com', 'Book your desired service that serves directly to you in your desired time-slot at a reasonable cost. ', '1');

-- --------------------------------------------------------

--
-- Table structure for table `ci_categories`
--

CREATE TABLE `ci_categories` (
  `category_id` int(11) NOT NULL COMMENT 'The category ID',
  `parent_category_id` varchar(65) NOT NULL DEFAULT '0' COMMENT 'This will store the parent category of the sub category. Parent category will have this field 0',
  `category_name` text NOT NULL COMMENT 'Name of the Category',
  `category_image` varchar(255) NOT NULL COMMENT 'Category Image URL',
  `display_status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0=>not displayed, 1=>displayed',
  `created_id` int(11) DEFAULT NULL COMMENT 'User ID of the creator',
  `created_date` datetime DEFAULT NULL,
  `updated_id` int(11) DEFAULT NULL COMMENT 'User ID of the person who will update',
  `updated_date` datetime DEFAULT NULL,
  `deleted_id` int(11) DEFAULT NULL COMMENT 'User ID of the person who will delete',
  `deleted_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_categories`
--

INSERT INTO `ci_categories` (`category_id`, `parent_category_id`, `category_name`, `category_image`, `display_status`, `created_id`, `created_date`, `updated_id`, `updated_date`, `deleted_id`, `deleted_date`) VALUES
(1, '0', 'ELECTRONICS', 'http://localhost/ramesh/ecommerce/custom/images?img=YTo1OntzOjQ6ImJhc2UiO3M6NzoidXBsb2FkcyI7czo0OiJ0eXBlIjtzOjEwOiJjYXRlZ29yaWVzIjtzOjM6ImltZyI7czoyNDoiY2F0ZWdvcnlfMTQ5OTUzODUzMzEuanBnIjtzOjU6IndpZHRoIjtpOjEwMDtzOjY6ImhlaWdodCI7aToxMDA7fQ==', '1', 1, '2017-07-08 23:58:53', NULL, NULL, NULL, NULL),
(2, '0', 'CLOTHES', 'http://localhost/ramesh/ecommerce/custom/images?img=YTo1OntzOjQ6ImJhc2UiO3M6NzoidXBsb2FkcyI7czo0OiJ0eXBlIjtzOjEwOiJjYXRlZ29yaWVzIjtzOjM6ImltZyI7czoyNToiY2F0ZWdvcnlfMTQ5OTUzODUzMzExLmpwZyI7czo1OiJ3aWR0aCI7aToxMDA7czo2OiJoZWlnaHQiO2k6MTAwO30=', '1', 1, '2017-07-08 23:58:53', NULL, NULL, NULL, NULL),
(3, '0', 'FOOD AND BEVERAGES', 'http://localhost/ramesh/ecommerce/custom/images?img=YTo1OntzOjQ6ImJhc2UiO3M6NzoidXBsb2FkcyI7czo0OiJ0eXBlIjtzOjEwOiJjYXRlZ29yaWVzIjtzOjM6ImltZyI7czoyNToiY2F0ZWdvcnlfMTQ5OTUzODUzMzEyLmpwZyI7czo1OiJ3aWR0aCI7aToxMDA7czo2OiJoZWlnaHQiO2k6MTAwO30=', '1', 1, '2017-07-08 23:58:53', NULL, NULL, NULL, NULL),
(4, '0', 'HEALTH & BEAUTY', 'http://localhost/ramesh/ecommerce/custom/images?img=YTo1OntzOjQ6ImJhc2UiO3M6NzoidXBsb2FkcyI7czo0OiJ0eXBlIjtzOjEwOiJjYXRlZ29yaWVzIjtzOjM6ImltZyI7czoyNToiY2F0ZWdvcnlfMTQ5OTUzODUzMzEzLmpwZyI7czo1OiJ3aWR0aCI7aToxMDA7czo2OiJoZWlnaHQiO2k6MTAwO30=', '1', 1, '2017-07-08 23:58:53', NULL, NULL, NULL, NULL),
(5, '0', 'SPORTS & LEISURE', 'http://localhost/ramesh/ecommerce/custom/images?img=YTo1OntzOjQ6ImJhc2UiO3M6NzoidXBsb2FkcyI7czo0OiJ0eXBlIjtzOjEwOiJjYXRlZ29yaWVzIjtzOjM6ImltZyI7czoyNToiY2F0ZWdvcnlfMTQ5OTUzODUzMzE0LmpwZyI7czo1OiJ3aWR0aCI7aToxMDA7czo2OiJoZWlnaHQiO2k6MTAwO30=', '1', 1, '2017-07-08 23:58:53', NULL, NULL, NULL, NULL),
(6, '0', 'BOOKS & ENTERTAINMENTS', 'http://localhost/ramesh/ecommerce/custom/images?img=YTo1OntzOjQ6ImJhc2UiO3M6NzoidXBsb2FkcyI7czo0OiJ0eXBlIjtzOjEwOiJjYXRlZ29yaWVzIjtzOjM6ImltZyI7czoyNToiY2F0ZWdvcnlfMTQ5OTUzODUzMzE1LmpwZyI7czo1OiJ3aWR0aCI7aToxMDA7czo2OiJoZWlnaHQiO2k6MTAwO30=', '1', 1, '2017-07-08 23:58:53', NULL, NULL, NULL, NULL),
(7, '1', 'Cameras', 'http://localhost/ramesh/ecommerce/custom/images?img=YTo1OntzOjQ6ImJhc2UiO3M6NzoidXBsb2FkcyI7czo0OiJ0eXBlIjtzOjEwOiJjYXRlZ29yaWVzIjtzOjM6ImltZyI7czoyNDoiY2F0ZWdvcnlfMTQ5OTUzODY1NzEuanBnIjtzOjU6IndpZHRoIjtpOjEwMDtzOjY6ImhlaWdodCI7aToxMDA7fQ==', '1', 1, '2017-07-09 00:00:57', NULL, NULL, NULL, NULL),
(8, '1', 'Computers, Tablets & laptop', 'http://localhost/ramesh/ecommerce/custom/images?img=YTo1OntzOjQ6ImJhc2UiO3M6NzoidXBsb2FkcyI7czo0OiJ0eXBlIjtzOjEwOiJjYXRlZ29yaWVzIjtzOjM6ImltZyI7czoyNDoiY2F0ZWdvcnlfMTQ5OTUzODc3ODEuanBnIjtzOjU6IndpZHRoIjtpOjEwMDtzOjY6ImhlaWdodCI7aToxMDA7fQ==', '1', 1, '2017-07-09 00:02:58', NULL, NULL, NULL, NULL),
(9, '1', 'Mobile Phone', 'http://localhost/ramesh/ecommerce/custom/images?img=YTo1OntzOjQ6ImJhc2UiO3M6NzoidXBsb2FkcyI7czo0OiJ0eXBlIjtzOjEwOiJjYXRlZ29yaWVzIjtzOjM6ImltZyI7czoyNToiY2F0ZWdvcnlfMTQ5OTUzODc3ODExLmpwZyI7czo1OiJ3aWR0aCI7aToxMDA7czo2OiJoZWlnaHQiO2k6MTAwO30=', '1', 1, '2017-07-09 00:02:58', NULL, NULL, NULL, NULL),
(10, '1', 'Sound & Vision', 'http://localhost/ramesh/ecommerce/custom/images?img=YTo1OntzOjQ6ImJhc2UiO3M6NzoidXBsb2FkcyI7czo0OiJ0eXBlIjtzOjEwOiJjYXRlZ29yaWVzIjtzOjM6ImltZyI7czoyNToiY2F0ZWdvcnlfMTQ5OTUzODc3ODEyLmpwZyI7czo1OiJ3aWR0aCI7aToxMDA7czo2OiJoZWlnaHQiO2k6MTAwO30=', '1', 1, '2017-07-09 00:02:58', NULL, NULL, NULL, NULL),
(11, '2', 'Men\'s Clothings', 'http://localhost/ramesh/ecommerce/custom/images?img=YTo1OntzOjQ6ImJhc2UiO3M6NzoidXBsb2FkcyI7czo0OiJ0eXBlIjtzOjEwOiJjYXRlZ29yaWVzIjtzOjM6ImltZyI7czoyNDoiY2F0ZWdvcnlfMTQ5OTUzODg1MjEuanBnIjtzOjU6IndpZHRoIjtpOjEwMDtzOjY6ImhlaWdodCI7aToxMDA7fQ==', '1', 1, '2017-07-09 00:04:12', NULL, NULL, NULL, NULL),
(12, '2', 'Kids Clothing', 'http://localhost/ramesh/ecommerce/custom/images?img=YTo1OntzOjQ6ImJhc2UiO3M6NzoidXBsb2FkcyI7czo0OiJ0eXBlIjtzOjEwOiJjYXRlZ29yaWVzIjtzOjM6ImltZyI7czoyNToiY2F0ZWdvcnlfMTQ5OTUzODg1MjExLmpwZyI7czo1OiJ3aWR0aCI7aToxMDA7czo2OiJoZWlnaHQiO2k6MTAwO30=', '1', 1, '2017-07-09 00:04:12', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ci_orders`
--

CREATE TABLE `ci_orders` (
  `order_id` bigint(20) NOT NULL,
  `cart_data` text NOT NULL,
  `customer_id` bigint(20) NOT NULL,
  `shippingaddress` text NOT NULL,
  `shipping_area` varchar(255) NOT NULL,
  `shipping_PIN` varchar(255) NOT NULL,
  `order_date_time` datetime NOT NULL,
  `is_viewed` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ci_product`
--

CREATE TABLE `ci_product` (
  `product_id` bigint(20) NOT NULL COMMENT 'Id of the product',
  `product_name` text NOT NULL COMMENT 'Name of the product',
  `product_image` varchar(255) NOT NULL COMMENT 'Image Url of the product',
  `is_new` enum('0','1') NOT NULL DEFAULT '1' COMMENT 'Is 1 if the product is displayed to be a new product',
  `is_featured` enum('0','1') NOT NULL DEFAULT '0' COMMENT 'Is 1 if the product is displayed in featured product',
  `product_features` text NOT NULL COMMENT 'features of the product(HTML)',
  `product_ingredients` text NOT NULL COMMENT 'Ingredients in product(HTML)',
  `product_price` double NOT NULL COMMENT 'MRP of the Product',
  `discount_price` double NOT NULL COMMENT 'The discounted price of the product',
  `discount_percent` float NOT NULL COMMENT 'The discounted percentage of the product',
  `discount_status` enum('0','1') NOT NULL DEFAULT '0' COMMENT 'to use discounted price or not',
  `display_status` enum('0','1') NOT NULL COMMENT 'The product to be displayed Or not',
  `category_id` varchar(255) NOT NULL COMMENT 'Category Ids of the product(comma seperated if multiple)',
  `subcategory_id` varchar(255) NOT NULL COMMENT 'Sub-Category Ids of the product(comma seperated if multiple)',
  `brands_id` bigint(20) NOT NULL COMMENT 'Brand Id of the product',
  `manufacturer_id` varchar(255) NOT NULL COMMENT 'The id of the manufacturer',
  `vendor_ids` varchar(255) NOT NULL COMMENT 'Comma Seperated Vendor Ids for this product',
  `created_id` varchar(255) DEFAULT NULL COMMENT 'Id of the creator',
  `created_date` datetime DEFAULT NULL COMMENT 'Date of creation of the product',
  `updated_id` varchar(255) DEFAULT NULL COMMENT 'Id of the updater',
  `updated_date` datetime DEFAULT NULL COMMENT 'Date of updation of the product',
  `deleted_id` varchar(255) DEFAULT NULL COMMENT 'Id of the deleter',
  `deleted_date` datetime DEFAULT NULL COMMENT 'Date of deletion of the product'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ci_purchase_invoice`
--

CREATE TABLE `ci_purchase_invoice` (
  `invoice_id` bigint(20) NOT NULL COMMENT 'The ID of a particular purchase invoice',
  `vendor_ids` varchar(255) NOT NULL COMMENT 'The id of the vendor',
  `invoice_item_ids` varchar(255) NOT NULL COMMENT 'Comma seperated ids of the items purchased',
  `purchaser` int(11) NOT NULL COMMENT 'the id of the user who purchased',
  `purchase_date` date NOT NULL COMMENT 'The date of purchase',
  `transportation_cost` double NOT NULL COMMENT 'The cost of transportation',
  `total_purchase_cost` double NOT NULL COMMENT 'The total cost of purchase',
  `total_mrp` double NOT NULL COMMENT 'The total mrp of purchase',
  `total_margin` double NOT NULL COMMENT 'The total margin obtained from the transaction'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ci_purchase_invoice_items`
--

CREATE TABLE `ci_purchase_invoice_items` (
  `purchase_invoice_item_id` bigint(20) NOT NULL COMMENT 'The id of the purchased item',
  `purchase_master_id` bigint(20) NOT NULL COMMENT 'The id of the master invoice',
  `quantity` double NOT NULL COMMENT 'The quantity of the item purchased',
  `purchase_rate` double NOT NULL COMMENT 'The rate at which item was purchased per unit',
  `total_purchase_rate` double NOT NULL COMMENT 'The total purchase rate of the total quantity',
  `item_purchase_date` date NOT NULL COMMENT 'The date of purchase',
  `mrp_item` double NOT NULL COMMENT 'The selling or mrp of the item',
  `item_margin` double NOT NULL COMMENT 'This stores the margin obtained from each item',
  `vendor_id` varchar(255) NOT NULL COMMENT 'the id of the vendor',
  `product_id` bigint(20) NOT NULL COMMENT 'The id of the product purchased'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ci_sales`
--

CREATE TABLE `ci_sales` (
  `order_id` bigint(20) NOT NULL,
  `customer_id` bigint(20) NOT NULL,
  `vendor_ids` text NOT NULL,
  `order_date` datetime NOT NULL,
  `shipping_address` text NOT NULL,
  `shipping_area` text NOT NULL,
  `shipping_pin` int(11) NOT NULL,
  `product_ids` text NOT NULL,
  `product_quantities` text NOT NULL,
  `delivered_by` bigint(20) NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `user_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('0f19e519bc4d6d9bfeadeb17e7d9ac17', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:54.0) Gecko/20100101 Firefox/54.0', 1499503666, 'a:34:{s:8:"admin_id";s:1:"1";s:14:"admin_username";s:5:"admin";s:14:"admin_password";s:5:"admin";s:9:"user_type";s:1:"1";s:10:"admin_name";s:5:"admin";s:11:"admin_email";s:21:"contact@mywebadmin.in";s:12:"admin_mobile";s:9:"999999999";s:10:"creator_id";s:1:"1";s:12:"created_date";s:10:"2014-08-25";s:8:"username";s:5:"admin";s:8:"password";s:5:"admin";s:8:"remember";s:2:"on";s:12:"display_name";s:5:"Admin";s:14:"allowedmodules";s:1:"*";s:2:"id";s:1:"1";s:6:"userid";s:6:"ramesh";s:9:"firstname";s:6:"Ramesh";s:10:"middlename";s:5:"Kumar";s:8:"lastname";s:5:"Singh";s:5:"email";s:21:"ramesh@panaceatek.com";s:6:"gender";s:4:"Male";s:3:"dob";s:10:"1992-08-17";s:6:"mobile";s:10:"9762137636";s:9:"telephone";s:10:"4545456454";s:4:"city";N;s:7:"address";s:21:"das fsd fgds gd fgfds";s:15:"shippingaddress";s:21:"das fsd fgds gd fgfds";s:3:"PIN";s:6:"411014";s:12:"shipping_PIN";s:6:"411014";s:4:"area";s:4:"Pune";s:13:"shipping_area";s:4:"Pune";s:12:"previouscart";N;s:9:"updatedon";N;s:10:"is_deleted";N;}');

-- --------------------------------------------------------

--
-- Table structure for table `ci_test`
--

CREATE TABLE `ci_test` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `dob` date NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `present_status` enum('0','1') NOT NULL,
  `application_status` enum('1','2','3','4') NOT NULL,
  `date_created` date NOT NULL,
  `image_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ci_tmpcart`
--

CREATE TABLE `ci_tmpcart` (
  `cart_id` bigint(20) NOT NULL,
  `cart_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ci_users`
--

CREATE TABLE `ci_users` (
  `id` bigint(20) NOT NULL,
  `userid` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `firstname` text,
  `middlename` text,
  `lastname` text,
  `email` varchar(100) DEFAULT NULL,
  `gender` enum('Male','Female') DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `telephone` varchar(15) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `address` text,
  `shippingaddress` text,
  `PIN` varchar(255) DEFAULT NULL,
  `shipping_PIN` varchar(255) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `shipping_area` varchar(255) DEFAULT NULL,
  `previouscart` text,
  `updatedon` datetime DEFAULT NULL,
  `is_deleted` enum('0','1') DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_users`
--

INSERT INTO `ci_users` (`id`, `userid`, `password`, `firstname`, `middlename`, `lastname`, `email`, `gender`, `dob`, `mobile`, `telephone`, `city`, `address`, `shippingaddress`, `PIN`, `shipping_PIN`, `area`, `shipping_area`, `previouscart`, `updatedon`, `is_deleted`) VALUES
(1, 'ramesh', '12345678', 'Ramesh', 'Kumar', 'Singh', 'ramesh@panaceatek.com', 'Male', '1992-08-17', '9762137636', '4545456454', NULL, 'das fsd fgds gd fgfds', 'das fsd fgds gd fgfds', '411014', '411014', 'Pune', 'Pune', NULL, NULL, '0');

-- --------------------------------------------------------

--
-- Table structure for table `ci_vendors`
--

CREATE TABLE `ci_vendors` (
  `vendor_id` bigint(20) NOT NULL COMMENT 'Id of the vendor',
  `vendor_name` char(128) NOT NULL COMMENT 'Name of the vendor',
  `vendor_address` text NOT NULL COMMENT 'address of the vendor(HTML)',
  `vendor_pin` varchar(255) NOT NULL COMMENT 'PINCODE of the vendor',
  `vendor_email` varchar(255) NOT NULL,
  `vendor_mobile` text NOT NULL COMMENT 'mobile number of the vendor(Comma Seperated if multiple)',
  `vendor_phone` text NOT NULL COMMENT 'Phone number of the vendor(Comma Seperated if multiple)',
  `vendor_area` varchar(255) NOT NULL COMMENT 'Area of the vendor(Comma Seperated if multiple)',
  `created_id` bigint(20) DEFAULT NULL COMMENT 'Id of the row creator',
  `created_date` datetime DEFAULT NULL COMMENT 'Created Date',
  `updated_id` bigint(20) DEFAULT NULL COMMENT 'Id of the row updater',
  `updated_date` datetime DEFAULT NULL COMMENT 'Updated Date',
  `deleted_id` bigint(20) DEFAULT NULL COMMENT 'Id of the row deleter',
  `deleted_date` datetime DEFAULT NULL COMMENT 'Deleted Date'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_vendors`
--

INSERT INTO `ci_vendors` (`vendor_id`, `vendor_name`, `vendor_address`, `vendor_pin`, `vendor_email`, `vendor_mobile`, `vendor_phone`, `vendor_area`, `created_id`, `created_date`, `updated_id`, `updated_date`, `deleted_id`, `deleted_date`) VALUES
(1, 'Apple', 'Wagholi Pune', '411014', 'joy@panaceatek.com', '97564654564', '8546466545', 'Mumbai,Patna', 1, '2017-07-09 00:12:29', NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ci_admin_modules`
--
ALTER TABLE `ci_admin_modules`
  ADD PRIMARY KEY (`module_id`);

--
-- Indexes for table `ci_areas_covered`
--
ALTER TABLE `ci_areas_covered`
  ADD PRIMARY KEY (`area_id`);

--
-- Indexes for table `ci_backend_users`
--
ALTER TABLE `ci_backend_users`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `ci_backend_usertype`
--
ALTER TABLE `ci_backend_usertype`
  ADD PRIMARY KEY (`user_type_id`);

--
-- Indexes for table `ci_brands`
--
ALTER TABLE `ci_brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `ci_carousel`
--
ALTER TABLE `ci_carousel`
  ADD PRIMARY KEY (`carousel_id`);

--
-- Indexes for table `ci_categories`
--
ALTER TABLE `ci_categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `ci_orders`
--
ALTER TABLE `ci_orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `ci_product`
--
ALTER TABLE `ci_product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `ci_purchase_invoice`
--
ALTER TABLE `ci_purchase_invoice`
  ADD PRIMARY KEY (`invoice_id`);

--
-- Indexes for table `ci_purchase_invoice_items`
--
ALTER TABLE `ci_purchase_invoice_items`
  ADD PRIMARY KEY (`purchase_invoice_item_id`);

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`session_id`),
  ADD KEY `last_activity_idx` (`last_activity`);

--
-- Indexes for table `ci_test`
--
ALTER TABLE `ci_test`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ci_tmpcart`
--
ALTER TABLE `ci_tmpcart`
  ADD UNIQUE KEY `cart_id` (`cart_id`);

--
-- Indexes for table `ci_users`
--
ALTER TABLE `ci_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ci_vendors`
--
ALTER TABLE `ci_vendors`
  ADD PRIMARY KEY (`vendor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ci_admin_modules`
--
ALTER TABLE `ci_admin_modules`
  MODIFY `module_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'This will store the module id', AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `ci_areas_covered`
--
ALTER TABLE `ci_areas_covered`
  MODIFY `area_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `ci_backend_users`
--
ALTER TABLE `ci_backend_users`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'The backend users ID users', AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ci_backend_usertype`
--
ALTER TABLE `ci_backend_usertype`
  MODIFY `user_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ci_brands`
--
ALTER TABLE `ci_brands`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'The brand ID of the brand', AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `ci_carousel`
--
ALTER TABLE `ci_carousel`
  MODIFY `carousel_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `ci_categories`
--
ALTER TABLE `ci_categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'The category ID', AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `ci_orders`
--
ALTER TABLE `ci_orders`
  MODIFY `order_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ci_product`
--
ALTER TABLE `ci_product`
  MODIFY `product_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'Id of the product';
--
-- AUTO_INCREMENT for table `ci_purchase_invoice`
--
ALTER TABLE `ci_purchase_invoice`
  MODIFY `invoice_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'The ID of a particular purchase invoice';
--
-- AUTO_INCREMENT for table `ci_purchase_invoice_items`
--
ALTER TABLE `ci_purchase_invoice_items`
  MODIFY `purchase_invoice_item_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'The id of the purchased item';
--
-- AUTO_INCREMENT for table `ci_test`
--
ALTER TABLE `ci_test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ci_tmpcart`
--
ALTER TABLE `ci_tmpcart`
  MODIFY `cart_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ci_users`
--
ALTER TABLE `ci_users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ci_vendors`
--
ALTER TABLE `ci_vendors`
  MODIFY `vendor_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'Id of the vendor', AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
