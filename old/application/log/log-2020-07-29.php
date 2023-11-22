<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-07-29 02:14:40 --> 404 Page Not Found: Env/index
ERROR - 2020-07-29 02:16:12 --> 404 Page Not Found: Vendor/phpunit
ERROR - 2020-07-29 05:23:22 --> 404 Page Not Found: Robotstxt/index
ERROR - 2020-07-29 06:13:04 --> 404 Page Not Found: Robotstxt/index
ERROR - 2020-07-29 06:33:34 --> 404 Page Not Found: Robotstxt/index
ERROR - 2020-07-29 06:53:11 --> 404 Page Not Found: Robotstxt/index
ERROR - 2020-07-29 07:14:50 --> 404 Page Not Found: Robotstxt/index
ERROR - 2020-07-29 08:16:28 --> 404 Page Not Found: Robotstxt/index
ERROR - 2020-07-29 09:41:28 --> 404 Page Not Found: Home/about_us
ERROR - 2020-07-29 10:01:30 --> 404 Page Not Found: Robotstxt/index
ERROR - 2020-07-29 10:34:10 --> 404 Page Not Found: Robotstxt/index
ERROR - 2020-07-29 13:12:50 --> 404 Page Not Found: Robotstxt/index
ERROR - 2020-07-29 14:41:37 --> Severity: Notice --> Undefined variable: category_name /home/u208937329/domains/quizart.co.in/public_html/application/views/frontend/default/category_page.php 19
ERROR - 2020-07-29 14:41:37 --> Severity: Notice --> Undefined variable: sub_category_name /home/u208937329/domains/quizart.co.in/public_html/application/views/frontend/default/category_page.php 23
ERROR - 2020-07-29 14:41:37 --> Severity: Notice --> Undefined variable: sub_category_name /home/u208937329/domains/quizart.co.in/public_html/application/views/frontend/default/category_page.php 28
ERROR - 2020-07-29 14:41:37 --> Severity: Notice --> Undefined variable: courses /home/u208937329/domains/quizart.co.in/public_html/application/views/frontend/default/category_page.php 68
ERROR - 2020-07-29 14:41:37 --> Severity: error --> Exception: Call to a member function result_array() on null /home/u208937329/domains/quizart.co.in/public_html/application/views/frontend/default/category_page.php 68
ERROR - 2020-07-29 15:17:38 --> Severity: Notice --> Undefined variable: category_name /home/u208937329/domains/quizart.co.in/public_html/application/views/frontend/default/category_page.php 19
ERROR - 2020-07-29 15:17:38 --> Severity: Notice --> Undefined variable: sub_category_name /home/u208937329/domains/quizart.co.in/public_html/application/views/frontend/default/category_page.php 23
ERROR - 2020-07-29 15:17:38 --> Severity: Notice --> Undefined variable: sub_category_name /home/u208937329/domains/quizart.co.in/public_html/application/views/frontend/default/category_page.php 28
ERROR - 2020-07-29 15:17:38 --> Severity: Notice --> Undefined variable: courses /home/u208937329/domains/quizart.co.in/public_html/application/views/frontend/default/category_page.php 68
ERROR - 2020-07-29 15:17:38 --> Severity: error --> Exception: Call to a member function result_array() on null /home/u208937329/domains/quizart.co.in/public_html/application/views/frontend/default/category_page.php 68
ERROR - 2020-07-29 16:08:42 --> 404 Page Not Found: Adstxt/index
ERROR - 2020-07-29 16:32:07 --> Severity: Notice --> Undefined offset: 5 /home/u208937329/domains/quizart.co.in/public_html/application/models/Crud_model.php 2341
ERROR - 2020-07-29 16:50:45 --> Query error: Table 'u208937329_quizart_lis.tr_doc' doesn't exist - Invalid query: SELECT `tr_doc`.*, `subject`.`name`, `sm`.`id` AS `samester_id`, `sc`.`id` AS `subcategory_id`, `c`.`id` AS `category_id`, `sm`.`title` AS `samester_name`, `c`.`name` AS `category_name`, `sc`.`name` AS `sub_category_name`, `u`.`first_name`, `u`.`last_name`, `u`.`email`
FROM `tr_doc`
LEFT JOIN `users` AS `u` ON `tr_doc`.`userID` = `u`.`id`
LEFT JOIN `subject` ON `subject`.`id` =  `tr_doc`.`subject_id`
LEFT JOIN `m00_samester` AS `sm` ON `sm`.`id` = `subject`.`samester`
LEFT JOIN `category` AS `sc` ON `sc`.`id` = `sm`.`subcategory_id`
LEFT JOIN `category` AS `c` ON `c`.`id` = `sc`.`parent`
ERROR - 2020-07-29 16:52:37 --> Query error: Table 'u208937329_quizart_lis.tr_doc' doesn't exist - Invalid query: SELECT `tr_doc`.*, `subject`.`name`, `sm`.`id` AS `samester_id`, `sc`.`id` AS `subcategory_id`, `c`.`id` AS `category_id`, `sm`.`title` AS `samester_name`, `c`.`name` AS `category_name`, `sc`.`name` AS `sub_category_name`, `u`.`first_name`, `u`.`last_name`, `u`.`email`
FROM `tr_doc`
LEFT JOIN `users` AS `u` ON `tr_doc`.`userID` = `u`.`id`
LEFT JOIN `subject` ON `subject`.`id` =  `tr_doc`.`subject_id`
LEFT JOIN `m00_samester` AS `sm` ON `sm`.`id` = `subject`.`samester`
LEFT JOIN `category` AS `sc` ON `sc`.`id` = `sm`.`subcategory_id`
LEFT JOIN `category` AS `c` ON `c`.`id` = `sc`.`parent`
ERROR - 2020-07-29 16:52:55 --> Query error: Table 'u208937329_quizart_lis.tr_doc' doesn't exist - Invalid query: SELECT `tr_doc`.*, `subject`.`name`, `sm`.`id` AS `samester_id`, `sc`.`id` AS `subcategory_id`, `c`.`id` AS `category_id`, `sm`.`title` AS `samester_name`, `c`.`name` AS `category_name`, `sc`.`name` AS `sub_category_name`, `u`.`first_name`, `u`.`last_name`, `u`.`email`
FROM `tr_doc`
LEFT JOIN `users` AS `u` ON `tr_doc`.`userID` = `u`.`id`
LEFT JOIN `subject` ON `subject`.`id` =  `tr_doc`.`subject_id`
LEFT JOIN `m00_samester` AS `sm` ON `sm`.`id` = `subject`.`samester`
LEFT JOIN `category` AS `sc` ON `sc`.`id` = `sm`.`subcategory_id`
LEFT JOIN `category` AS `c` ON `c`.`id` = `sc`.`parent`
ERROR - 2020-07-29 16:55:53 --> Query error: Table 'u208937329_quizart_lis.user_acl' doesn't exist - Invalid query: SELECT *
FROM `user_acl`
WHERE `role_id` = '2'
ERROR - 2020-07-29 16:58:51 --> Query error: Table 'u208937329_quizart_lis.tr_doc' doesn't exist - Invalid query: SELECT `tr_doc`.*, `subject`.`name`, `sm`.`id` AS `samester_id`, `sc`.`id` AS `subcategory_id`, `c`.`id` AS `category_id`, `sm`.`title` AS `samester_name`, `c`.`name` AS `category_name`, `sc`.`name` AS `sub_category_name`, `u`.`first_name`, `u`.`last_name`, `u`.`email`
FROM `tr_doc`
LEFT JOIN `users` AS `u` ON `tr_doc`.`userID` = `u`.`id`
LEFT JOIN `subject` ON `subject`.`id` =  `tr_doc`.`subject_id`
LEFT JOIN `m00_samester` AS `sm` ON `sm`.`id` = `subject`.`samester`
LEFT JOIN `category` AS `sc` ON `sc`.`id` = `sm`.`subcategory_id`
LEFT JOIN `category` AS `c` ON `c`.`id` = `sc`.`parent`
ERROR - 2020-07-29 17:20:11 --> 404 Page Not Found: Robotstxt/index
ERROR - 2020-07-29 17:20:18 --> Severity: Notice --> Undefined variable: category_name /home/u208937329/domains/quizart.co.in/public_html/application/views/frontend/default/category_page.php 19
ERROR - 2020-07-29 17:20:18 --> Severity: Notice --> Undefined variable: sub_category_name /home/u208937329/domains/quizart.co.in/public_html/application/views/frontend/default/category_page.php 23
ERROR - 2020-07-29 17:20:18 --> Severity: Notice --> Undefined variable: sub_category_name /home/u208937329/domains/quizart.co.in/public_html/application/views/frontend/default/category_page.php 28
ERROR - 2020-07-29 17:20:18 --> Severity: Notice --> Undefined variable: courses /home/u208937329/domains/quizart.co.in/public_html/application/views/frontend/default/category_page.php 68
ERROR - 2020-07-29 17:20:18 --> Severity: error --> Exception: Call to a member function result_array() on null /home/u208937329/domains/quizart.co.in/public_html/application/views/frontend/default/category_page.php 68
ERROR - 2020-07-29 17:37:08 --> 404 Page Not Found: Robotstxt/index
ERROR - 2020-07-29 19:01:43 --> 404 Page Not Found: Robotstxt/index
