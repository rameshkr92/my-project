<?php
$sql = array();
$sql[] = "
CREATE TABLE IF NOT EXISTS `".DBPREFIX."_admin_modules` (
  `module_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'This will store the module id',
  `module_name` text NOT NULL COMMENT 'This will store the module names (Names of the controllers)',
  PRIMARY KEY (`module_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
";
$sql[] = "
INSERT INTO `".DBPREFIX."_admin_modules` (`module_id`, `module_name`) VALUES
(2, 'dashboard'),
(4, 'users'),
(5, 'categories'),
(6, 'subcategories'),
(7, 'brands'),
(8, 'vendors'),
(9, 'product'),
(10, 'sales');
";

$sql[] = "
CREATE TABLE IF NOT EXISTS `".DBPREFIX."_areas_covered` (
  `area_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `area_name` varchar(255) NOT NULL,
  `area_pin` int(11) NOT NULL,
  `created_id` bigint(20) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_id` bigint(20) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `deleted_id` bigint(20) DEFAULT NULL,
  `deleted_date` datetime DEFAULT NULL,
  PRIMARY KEY (`area_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
";

$sql[] = "
CREATE TABLE IF NOT EXISTS `".DBPREFIX."_backend_users` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'The backend users ID users',
  `admin_username` varchar(255) NOT NULL COMMENT 'username',
  `admin_password` varchar(255) NOT NULL COMMENT 'password',
  `user_type` text NOT NULL COMMENT 'the user type',
  `admin_name` char(255) NOT NULL COMMENT 'name of the backend user',
  `admin_email` varchar(255) NOT NULL COMMENT 'email of the backend user',
  `admin_mobile` varchar(255) NOT NULL COMMENT 'mobile of the backend user',
  `creator_id` int(11) NOT NULL COMMENT 'the id of the admin who created this user',
  `created_date` date NOT NULL COMMENT 'the date on which the user was created',
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
";

$sql[] = "
INSERT INTO `".DBPREFIX."_backend_users` (`admin_id`, `admin_username`, `admin_password`, `user_type`, `admin_name`, `admin_email`, `admin_mobile`, `creator_id`, `created_date`) VALUES
(1, 'admin', 'admin', '1', 'admin', 'contact@mywebadmin.in', '999999999', 1, '2014-08-25');

";
$sql[] = "
CREATE TABLE IF NOT EXISTS `".DBPREFIX."_backend_usertype` (
  `user_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_type_name` text NOT NULL,
  `user_type_dpname` text NOT NULL,
  `allowed_links` text NOT NULL,
  `disallowed_sub_links` text NOT NULL COMMENT 'list of links not allowed in modules',
  PRIMARY KEY (`user_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
";
$sql[] = "
INSERT INTO `".DBPREFIX."_backend_usertype` (`user_type_id`, `user_type_name`, `user_type_dpname`, `allowed_links`, `disallowed_sub_links`) VALUES
(1, 'admin', 'Admin', '*', '');
";

$sql[] = "
CREATE TABLE IF NOT EXISTS `".DBPREFIX."_brands` (
  `brand_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'The brand ID of the brand',
  `brand_name` text NOT NULL COMMENT 'Name of the Brand ',
  `brand_image` varchar(255) NOT NULL COMMENT 'Image url for brand logo',
  `brand_description` text NOT NULL COMMENT 'Description about the brand',
  `display_status` enum('0','1') NOT NULL DEFAULT '1',
  `created_id` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_id` int(11) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `deleted_id` int(11) DEFAULT NULL,
  `deleted_date` datetime DEFAULT NULL,
  PRIMARY KEY (`brand_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
";
$sql[] = "
CREATE TABLE IF NOT EXISTS `".DBPREFIX."_carousel` (
  `carousel_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `carousel_image` varchar(255) NOT NULL,
  `carousel_link` varchar(255) NOT NULL,
  `carousel_caption` text NOT NULL,
  `display_status` enum('0','1') NOT NULL DEFAULT '1',
  PRIMARY KEY (`carousel_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
";

$sql[] = "
CREATE TABLE IF NOT EXISTS `".DBPREFIX."_categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'The category ID',
  `parent_category_id` varchar(65) NOT NULL DEFAULT '0' COMMENT 'This will store the parent category of the sub category. Parent category will have this field 0',
  `category_name` text NOT NULL COMMENT 'Name of the Category',
  `category_image` varchar(255) NOT NULL COMMENT 'Category Image URL',
  `display_status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0=>not displayed, 1=>displayed',
  `created_id` int(11) DEFAULT NULL COMMENT 'User ID of the creator',
  `created_date` datetime DEFAULT NULL,
  `updated_id` int(11) DEFAULT NULL COMMENT 'User ID of the person who will update',
  `updated_date` datetime DEFAULT NULL,
  `deleted_id` int(11) DEFAULT NULL COMMENT 'User ID of the person who will delete',
  `deleted_date` datetime DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
";
$sql[] = "
CREATE TABLE IF NOT EXISTS `".DBPREFIX."_orders` (
  `order_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `cart_data` text NOT NULL,
  `customer_id` bigint(20) NOT NULL,
  `shippingaddress` text NOT NULL,
  `shipping_area` varchar(255) NOT NULL,
  `shipping_PIN` varchar(255) NOT NULL,
  `order_date_time` datetime NOT NULL,
  `is_viewed` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
";
$sql[] = "
CREATE TABLE IF NOT EXISTS `".DBPREFIX."_product` (
  `product_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'Id of the product',
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
  `deleted_date` datetime DEFAULT NULL COMMENT 'Date of deletion of the product',
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
";

$sql[] = "
CREATE TABLE IF NOT EXISTS `".DBPREFIX."_purchase_invoice` (
  `invoice_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'The ID of a particular purchase invoice',
  `vendor_ids` varchar(255) NOT NULL COMMENT 'The id of the vendor',
  `invoice_item_ids` varchar(255) NOT NULL COMMENT 'Comma seperated ids of the items purchased',
  `purchaser` int(11) NOT NULL COMMENT 'the id of the user who purchased',
  `purchase_date` date NOT NULL COMMENT 'The date of purchase',
  `transportation_cost` double NOT NULL COMMENT 'The cost of transportation',
  `total_purchase_cost` double NOT NULL COMMENT 'The total cost of purchase',
  `total_mrp` double NOT NULL COMMENT 'The total mrp of purchase',
  `total_margin` double NOT NULL COMMENT 'The total margin obtained from the transaction',
  PRIMARY KEY (`invoice_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
";

$sql[] = "
CREATE TABLE IF NOT EXISTS `".DBPREFIX."_purchase_invoice_items` (
  `purchase_invoice_item_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'The id of the purchased item',
  `purchase_master_id` bigint(20) NOT NULL COMMENT 'The id of the master invoice',
  `quantity` double NOT NULL COMMENT 'The quantity of the item purchased',
  `purchase_rate` double NOT NULL COMMENT 'The rate at which item was purchased per unit',
  `total_purchase_rate` double NOT NULL COMMENT 'The total purchase rate of the total quantity',
  `item_purchase_date` date NOT NULL COMMENT 'The date of purchase',
  `mrp_item` double NOT NULL COMMENT 'The selling or mrp of the item',
  `item_margin` double NOT NULL COMMENT 'This stores the margin obtained from each item',
  `vendor_id` varchar(255) NOT NULL COMMENT 'the id of the vendor',
  `product_id` bigint(20) NOT NULL COMMENT 'The id of the product purchased',
  PRIMARY KEY (`purchase_invoice_item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
";

$sql[] = "
CREATE TABLE IF NOT EXISTS `".DBPREFIX."_sales` (
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
";

$sql[] = "
CREATE TABLE IF NOT EXISTS `".DBPREFIX."_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
";

$sql[] = "
CREATE TABLE IF NOT EXISTS `".DBPREFIX."_test` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `dob` date NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `present_status` enum('0','1') NOT NULL,
  `application_status` enum('1','2','3','4') NOT NULL,
  `date_created` date NOT NULL,
  `image_url` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
";

$sql[] = "
CREATE TABLE IF NOT EXISTS `".DBPREFIX."_tmpcart` (
  `cart_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `cart_data` text NOT NULL,
  UNIQUE KEY `cart_id` (`cart_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
";

$sql[] = "
CREATE TABLE IF NOT EXISTS `".DBPREFIX."_users` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `userid` varchar(50) NOT NULL DEFAULT '',
  `password` varchar(50) NOT NULL DEFAULT '',
  `firstname` text NOT NULL,
  `middlename` text NOT NULL,
  `lastname` text NOT NULL,
  `email` varchar(100) NOT NULL DEFAULT '',
  `gender` enum('Male','Female') NOT NULL,
  `dob` date NOT NULL,
  `mobile` varchar(10) NOT NULL DEFAULT '',
  `telephone` varchar(15) NOT NULL DEFAULT '',
  `city` varchar(50) NOT NULL DEFAULT '',
  `address` text NOT NULL,
  `shippingaddress` text NOT NULL,
  `PIN` varchar(255) NOT NULL,
  `shipping_PIN` varchar(255) NOT NULL,
  `area` varchar(255) NOT NULL,
  `shipping_area` varchar(255) NOT NULL,
  `previouscart` text NOT NULL,
  `updatedon` datetime NOT NULL,
  `is_deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
";

$sql[] = "
CREATE TABLE IF NOT EXISTS `".DBPREFIX."_vendors` (
  `vendor_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'Id of the vendor',
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
  `deleted_date` datetime DEFAULT NULL COMMENT 'Deleted Date',
  PRIMARY KEY (`vendor_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

";
$conn = mysqli_connect(DBHOSTNAME,DBUSER,DBPWD) OR die('Connection to MySql Server could not be established');
mysqli_select_db($conn,DBNAME) OR die('Database not found');
foreach($sql as $query)
{
	mysqli_query($conn,$query) OR die('Could not create tables');
}
?>