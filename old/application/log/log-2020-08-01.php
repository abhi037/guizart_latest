<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-08-01 00:33:27 --> 404 Page Not Found: Robotstxt/index
ERROR - 2020-08-01 00:36:01 --> Query error: Table 'u208937329_quizart_lis.tr_doc' doesn't exist - Invalid query: SELECT `tr_doc`.*, `subject`.`name`, `sm`.`id` AS `samester_id`, `sc`.`id` AS `subcategory_id`, `c`.`id` AS `category_id`, `sm`.`title` AS `samester_name`, `c`.`name` AS `category_name`, `sc`.`name` AS `sub_category_name`, `u`.`first_name`, `u`.`last_name`, `u`.`email`
FROM `tr_doc`
LEFT JOIN `users` AS `u` ON `tr_doc`.`userID` = `u`.`id`
LEFT JOIN `subject` ON `subject`.`id` =  `tr_doc`.`subject_id`
LEFT JOIN `m00_samester` AS `sm` ON `sm`.`id` = `subject`.`samester`
LEFT JOIN `category` AS `sc` ON `sc`.`id` = `sm`.`subcategory_id`
LEFT JOIN `category` AS `c` ON `c`.`id` = `sc`.`parent`
ERROR - 2020-08-01 03:17:23 --> 404 Page Not Found: Wp-includes/wlwmanifest.xml
ERROR - 2020-08-01 03:17:23 --> 404 Page Not Found: Xmlrpcphp/index
ERROR - 2020-08-01 03:17:24 --> 404 Page Not Found: Blog/wp-includes
ERROR - 2020-08-01 03:17:25 --> 404 Page Not Found: Web/wp-includes
ERROR - 2020-08-01 03:17:25 --> 404 Page Not Found: Wordpress/wp-includes
ERROR - 2020-08-01 03:17:26 --> 404 Page Not Found: Website/wp-includes
ERROR - 2020-08-01 03:17:26 --> 404 Page Not Found: Wp/wp-includes
ERROR - 2020-08-01 03:17:26 --> 404 Page Not Found: News/wp-includes
ERROR - 2020-08-01 03:17:27 --> 404 Page Not Found: Wp1/wp-includes
ERROR - 2020-08-01 03:17:27 --> 404 Page Not Found: Test/wp-includes
ERROR - 2020-08-01 03:17:27 --> 404 Page Not Found: Wp2/wp-includes
ERROR - 2020-08-01 03:17:28 --> 404 Page Not Found: Site/wp-includes
ERROR - 2020-08-01 03:17:28 --> 404 Page Not Found: Cms/wp-includes
ERROR - 2020-08-01 03:17:28 --> 404 Page Not Found: Sito/wp-includes
ERROR - 2020-08-01 05:47:11 --> 404 Page Not Found: Robotstxt/index
ERROR - 2020-08-01 05:47:16 --> Severity: Notice --> Undefined variable: category_name /home/u208937329/domains/quizart.co.in/public_html/application/views/frontend/default/category_page.php 19
ERROR - 2020-08-01 05:47:16 --> Severity: Notice --> Undefined variable: sub_category_name /home/u208937329/domains/quizart.co.in/public_html/application/views/frontend/default/category_page.php 23
ERROR - 2020-08-01 05:47:16 --> Severity: Notice --> Undefined variable: sub_category_name /home/u208937329/domains/quizart.co.in/public_html/application/views/frontend/default/category_page.php 28
ERROR - 2020-08-01 05:47:16 --> Severity: Notice --> Undefined variable: courses /home/u208937329/domains/quizart.co.in/public_html/application/views/frontend/default/category_page.php 68
ERROR - 2020-08-01 05:47:16 --> Severity: error --> Exception: Call to a member function result_array() on null /home/u208937329/domains/quizart.co.in/public_html/application/views/frontend/default/category_page.php 68
ERROR - 2020-08-01 06:44:05 --> 404 Page Not Found: Robotstxt/index
ERROR - 2020-08-01 06:44:19 --> Severity: Notice --> Undefined variable: category_name /home/u208937329/domains/quizart.co.in/public_html/application/views/frontend/default/category_page.php 19
ERROR - 2020-08-01 06:44:19 --> Severity: Notice --> Undefined variable: sub_category_name /home/u208937329/domains/quizart.co.in/public_html/application/views/frontend/default/category_page.php 23
ERROR - 2020-08-01 06:44:19 --> Severity: Notice --> Undefined variable: sub_category_name /home/u208937329/domains/quizart.co.in/public_html/application/views/frontend/default/category_page.php 28
ERROR - 2020-08-01 06:44:19 --> Severity: Notice --> Undefined variable: courses /home/u208937329/domains/quizart.co.in/public_html/application/views/frontend/default/category_page.php 68
ERROR - 2020-08-01 06:44:19 --> Severity: error --> Exception: Call to a member function result_array() on null /home/u208937329/domains/quizart.co.in/public_html/application/views/frontend/default/category_page.php 68
ERROR - 2020-08-01 07:10:12 --> 404 Page Not Found: Robotstxt/index
ERROR - 2020-08-01 07:33:05 --> 404 Page Not Found: Wp-includes/wlwmanifest.xml
ERROR - 2020-08-01 07:33:06 --> 404 Page Not Found: Xmlrpcphp/index
ERROR - 2020-08-01 07:33:07 --> 404 Page Not Found: Blog/wp-includes
ERROR - 2020-08-01 07:33:07 --> 404 Page Not Found: Web/wp-includes
ERROR - 2020-08-01 07:33:08 --> 404 Page Not Found: Wordpress/wp-includes
ERROR - 2020-08-01 07:33:09 --> 404 Page Not Found: Website/wp-includes
ERROR - 2020-08-01 07:33:09 --> 404 Page Not Found: Wp/wp-includes
ERROR - 2020-08-01 07:33:09 --> 404 Page Not Found: News/wp-includes
ERROR - 2020-08-01 07:33:09 --> 404 Page Not Found: 2018/wp-includes
ERROR - 2020-08-01 07:33:10 --> 404 Page Not Found: 2019/wp-includes
ERROR - 2020-08-01 07:33:10 --> 404 Page Not Found: Shop/wp-includes
ERROR - 2020-08-01 07:33:11 --> 404 Page Not Found: Wp1/wp-includes
ERROR - 2020-08-01 07:33:11 --> 404 Page Not Found: Test/wp-includes
ERROR - 2020-08-01 07:33:11 --> 404 Page Not Found: Media/wp-includes
ERROR - 2020-08-01 07:33:11 --> 404 Page Not Found: Wp2/wp-includes
ERROR - 2020-08-01 07:33:12 --> 404 Page Not Found: Site/wp-includes
ERROR - 2020-08-01 07:33:12 --> 404 Page Not Found: Cms/wp-includes
ERROR - 2020-08-01 07:33:12 --> 404 Page Not Found: Sito/wp-includes
ERROR - 2020-08-01 08:04:56 --> Severity: Notice --> Trying to get property 'name' of non-object /home/u208937329/domains/quizart.co.in/public_html/application/helpers/user_helper.php 24
ERROR - 2020-08-01 08:04:57 --> Severity: Warning --> include(/navigation.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:04:57 --> Severity: Warning --> include(/navigation.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:04:57 --> Severity: Warning --> include(): Failed opening '/navigation.php' for inclusion (include_path='.:/opt/alt/php72/usr/share/pear') /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:04:57 --> Severity: Warning --> include(/dashboard.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:04:57 --> Severity: Warning --> include(/dashboard.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:04:57 --> Severity: Warning --> include(): Failed opening '/dashboard.php' for inclusion (include_path='.:/opt/alt/php72/usr/share/pear') /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:04:59 --> Severity: Warning --> include(/navigation.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:04:59 --> Severity: Warning --> include(/navigation.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:04:59 --> Severity: Warning --> include(): Failed opening '/navigation.php' for inclusion (include_path='.:/opt/alt/php72/usr/share/pear') /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:04:59 --> Severity: Warning --> include(/dashboard.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:04:59 --> Severity: Warning --> include(/dashboard.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:04:59 --> Severity: Warning --> include(): Failed opening '/dashboard.php' for inclusion (include_path='.:/opt/alt/php72/usr/share/pear') /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:04:59 --> 404 Page Not Found: Uploads/user_image
ERROR - 2020-08-01 08:04:59 --> Severity: Warning --> include(/navigation.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:04:59 --> Severity: Warning --> include(/navigation.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:04:59 --> Severity: Warning --> include(): Failed opening '/navigation.php' for inclusion (include_path='.:/opt/alt/php72/usr/share/pear') /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:04:59 --> Severity: Warning --> include(/dashboard.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:04:59 --> Severity: Warning --> include(/dashboard.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:04:59 --> Severity: Warning --> include(): Failed opening '/dashboard.php' for inclusion (include_path='.:/opt/alt/php72/usr/share/pear') /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:05:15 --> Severity: Notice --> Trying to get property 'name' of non-object /home/u208937329/domains/quizart.co.in/public_html/application/helpers/user_helper.php 24
ERROR - 2020-08-01 08:05:15 --> Severity: Warning --> include(/navigation.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:05:15 --> Severity: Warning --> include(/navigation.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:05:15 --> Severity: Warning --> include(): Failed opening '/navigation.php' for inclusion (include_path='.:/opt/alt/php72/usr/share/pear') /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:05:15 --> Severity: Warning --> include(/dashboard.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:05:15 --> Severity: Warning --> include(/dashboard.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:05:15 --> Severity: Warning --> include(): Failed opening '/dashboard.php' for inclusion (include_path='.:/opt/alt/php72/usr/share/pear') /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:05:16 --> Severity: Warning --> include(/navigation.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:05:16 --> Severity: Warning --> include(/navigation.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:05:16 --> Severity: Warning --> include(): Failed opening '/navigation.php' for inclusion (include_path='.:/opt/alt/php72/usr/share/pear') /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:05:16 --> Severity: Warning --> include(/dashboard.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:05:16 --> Severity: Warning --> include(/dashboard.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:05:16 --> Severity: Warning --> include(): Failed opening '/dashboard.php' for inclusion (include_path='.:/opt/alt/php72/usr/share/pear') /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:05:17 --> Severity: Warning --> include(/navigation.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:05:17 --> Severity: Warning --> include(/navigation.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:05:17 --> Severity: Warning --> include(): Failed opening '/navigation.php' for inclusion (include_path='.:/opt/alt/php72/usr/share/pear') /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:05:17 --> Severity: Warning --> include(/dashboard.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:05:17 --> Severity: Warning --> include(/dashboard.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:05:17 --> Severity: Warning --> include(): Failed opening '/dashboard.php' for inclusion (include_path='.:/opt/alt/php72/usr/share/pear') /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:09:27 --> Query error: Table 'u208937329_quizart_lis.user_acl' doesn't exist - Invalid query: SELECT *
FROM `user_acl`
WHERE `role_id` = '2'
ERROR - 2020-08-01 08:09:47 --> Query error: Table 'u208937329_quizart_lis.user_acl' doesn't exist - Invalid query: SELECT *
FROM `user_acl`
WHERE `role_id` = '2'
ERROR - 2020-08-01 08:09:54 --> Query error: Table 'u208937329_quizart_lis.user_acl' doesn't exist - Invalid query: SELECT *
FROM `user_acl`
WHERE `role_id` = '1'
ERROR - 2020-08-01 08:15:40 --> 404 Page Not Found: Uploads/user_image
ERROR - 2020-08-01 08:16:30 --> Query error: Table 'u208937329_quizart_lis.user_acl' doesn't exist - Invalid query: SELECT *
FROM `user_acl`
WHERE `role_id` = '2'
ERROR - 2020-08-01 08:20:23 --> Severity: Notice --> Trying to get property 'name' of non-object /home/u208937329/domains/quizart.co.in/public_html/application/helpers/user_helper.php 24
ERROR - 2020-08-01 08:20:24 --> Severity: Warning --> include(/navigation.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:20:24 --> Severity: Warning --> include(/navigation.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:20:24 --> Severity: Warning --> include(): Failed opening '/navigation.php' for inclusion (include_path='.:/opt/alt/php72/usr/share/pear') /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:20:24 --> Severity: Warning --> include(/dashboard.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:20:24 --> Severity: Warning --> include(/dashboard.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:20:24 --> Severity: Warning --> include(): Failed opening '/dashboard.php' for inclusion (include_path='.:/opt/alt/php72/usr/share/pear') /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:20:25 --> Severity: Warning --> include(/navigation.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:20:25 --> Severity: Warning --> include(/navigation.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:20:25 --> Severity: Warning --> include(): Failed opening '/navigation.php' for inclusion (include_path='.:/opt/alt/php72/usr/share/pear') /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:20:25 --> Severity: Warning --> include(/dashboard.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:20:25 --> Severity: Warning --> include(/dashboard.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:20:25 --> Severity: Warning --> include(): Failed opening '/dashboard.php' for inclusion (include_path='.:/opt/alt/php72/usr/share/pear') /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:20:26 --> Severity: Warning --> include(/navigation.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:20:26 --> Severity: Warning --> include(/navigation.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:20:26 --> Severity: Warning --> include(): Failed opening '/navigation.php' for inclusion (include_path='.:/opt/alt/php72/usr/share/pear') /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:20:26 --> Severity: Warning --> include(/dashboard.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:20:26 --> Severity: Warning --> include(/dashboard.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:20:26 --> Severity: Warning --> include(): Failed opening '/dashboard.php' for inclusion (include_path='.:/opt/alt/php72/usr/share/pear') /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:21:30 --> Severity: Warning --> include(/navigation.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:21:30 --> Severity: Warning --> include(/navigation.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:21:30 --> Severity: Warning --> include(): Failed opening '/navigation.php' for inclusion (include_path='.:/opt/alt/php72/usr/share/pear') /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:21:30 --> Severity: Warning --> include(/role_add.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:21:30 --> Severity: Warning --> include(/role_add.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:21:30 --> Severity: Warning --> include(): Failed opening '/role_add.php' for inclusion (include_path='.:/opt/alt/php72/usr/share/pear') /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:21:31 --> Severity: Warning --> include(/navigation.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:21:31 --> Severity: Warning --> include(/navigation.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:21:31 --> Severity: Warning --> include(): Failed opening '/navigation.php' for inclusion (include_path='.:/opt/alt/php72/usr/share/pear') /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:21:31 --> Severity: Warning --> include(/role_add.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:21:31 --> Severity: Warning --> include(/role_add.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:21:31 --> Severity: Warning --> include(): Failed opening '/role_add.php' for inclusion (include_path='.:/opt/alt/php72/usr/share/pear') /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:21:32 --> Severity: Warning --> include(/navigation.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:21:32 --> Severity: Warning --> include(/navigation.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:21:32 --> Severity: Warning --> include(): Failed opening '/navigation.php' for inclusion (include_path='.:/opt/alt/php72/usr/share/pear') /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:21:32 --> Severity: Warning --> include(/role_add.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:21:32 --> Severity: Warning --> include(/role_add.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:21:32 --> Severity: Warning --> include(): Failed opening '/role_add.php' for inclusion (include_path='.:/opt/alt/php72/usr/share/pear') /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:21:35 --> Severity: Warning --> include(/navigation.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:21:35 --> Severity: Warning --> include(/navigation.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:21:35 --> Severity: Warning --> include(): Failed opening '/navigation.php' for inclusion (include_path='.:/opt/alt/php72/usr/share/pear') /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:21:35 --> Severity: Warning --> include(/roles.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:21:35 --> Severity: Warning --> include(/roles.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:21:35 --> Severity: Warning --> include(): Failed opening '/roles.php' for inclusion (include_path='.:/opt/alt/php72/usr/share/pear') /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:21:36 --> Severity: Warning --> include(/navigation.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:21:36 --> Severity: Warning --> include(/navigation.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:21:36 --> Severity: Warning --> include(): Failed opening '/navigation.php' for inclusion (include_path='.:/opt/alt/php72/usr/share/pear') /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:21:36 --> Severity: Warning --> include(/roles.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:21:36 --> Severity: Warning --> include(/roles.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:21:36 --> Severity: Warning --> include(): Failed opening '/roles.php' for inclusion (include_path='.:/opt/alt/php72/usr/share/pear') /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:21:37 --> Severity: Warning --> include(/navigation.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:21:37 --> Severity: Warning --> include(/navigation.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:21:37 --> Severity: Warning --> include(): Failed opening '/navigation.php' for inclusion (include_path='.:/opt/alt/php72/usr/share/pear') /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:21:37 --> Severity: Warning --> include(/roles.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:21:37 --> Severity: Warning --> include(/roles.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:21:37 --> Severity: Warning --> include(): Failed opening '/roles.php' for inclusion (include_path='.:/opt/alt/php72/usr/share/pear') /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:21:39 --> Severity: Warning --> include(/navigation.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:21:39 --> Severity: Warning --> include(/navigation.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:21:39 --> Severity: Warning --> include(): Failed opening '/navigation.php' for inclusion (include_path='.:/opt/alt/php72/usr/share/pear') /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:21:39 --> Severity: Warning --> include(/employee_edit.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:21:39 --> Severity: Warning --> include(/employee_edit.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:21:39 --> Severity: Warning --> include(): Failed opening '/employee_edit.php' for inclusion (include_path='.:/opt/alt/php72/usr/share/pear') /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:21:40 --> Severity: Warning --> include(/navigation.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:21:40 --> Severity: Warning --> include(/navigation.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:21:40 --> Severity: Warning --> include(): Failed opening '/navigation.php' for inclusion (include_path='.:/opt/alt/php72/usr/share/pear') /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:21:40 --> Severity: Warning --> include(/employee_edit.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:21:40 --> Severity: Warning --> include(/employee_edit.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:21:40 --> Severity: Warning --> include(): Failed opening '/employee_edit.php' for inclusion (include_path='.:/opt/alt/php72/usr/share/pear') /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:21:40 --> Severity: Warning --> include(/navigation.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:21:40 --> Severity: Warning --> include(/navigation.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:21:40 --> Severity: Warning --> include(): Failed opening '/navigation.php' for inclusion (include_path='.:/opt/alt/php72/usr/share/pear') /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:21:40 --> Severity: Warning --> include(/employee_edit.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:21:40 --> Severity: Warning --> include(/employee_edit.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:21:40 --> Severity: Warning --> include(): Failed opening '/employee_edit.php' for inclusion (include_path='.:/opt/alt/php72/usr/share/pear') /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:21:41 --> Severity: Warning --> include(/navigation.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:21:41 --> Severity: Warning --> include(/navigation.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:21:41 --> Severity: Warning --> include(): Failed opening '/navigation.php' for inclusion (include_path='.:/opt/alt/php72/usr/share/pear') /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:21:41 --> Severity: Warning --> include(/employee.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:21:41 --> Severity: Warning --> include(/employee.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:21:41 --> Severity: Warning --> include(): Failed opening '/employee.php' for inclusion (include_path='.:/opt/alt/php72/usr/share/pear') /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:21:42 --> Severity: Warning --> include(/navigation.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:21:42 --> Severity: Warning --> include(/navigation.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:21:42 --> Severity: Warning --> include(): Failed opening '/navigation.php' for inclusion (include_path='.:/opt/alt/php72/usr/share/pear') /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:21:42 --> Severity: Warning --> include(/employee.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:21:42 --> Severity: Warning --> include(/employee.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:21:42 --> Severity: Warning --> include(): Failed opening '/employee.php' for inclusion (include_path='.:/opt/alt/php72/usr/share/pear') /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:21:43 --> Severity: Warning --> include(/navigation.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:21:43 --> Severity: Warning --> include(/navigation.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:21:43 --> Severity: Warning --> include(): Failed opening '/navigation.php' for inclusion (include_path='.:/opt/alt/php72/usr/share/pear') /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:21:43 --> Severity: Warning --> include(/employee.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:21:43 --> Severity: Warning --> include(/employee.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:21:43 --> Severity: Warning --> include(): Failed opening '/employee.php' for inclusion (include_path='.:/opt/alt/php72/usr/share/pear') /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:21:44 --> Severity: Warning --> include(/navigation.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:21:44 --> Severity: Warning --> include(/navigation.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:21:44 --> Severity: Warning --> include(): Failed opening '/navigation.php' for inclusion (include_path='.:/opt/alt/php72/usr/share/pear') /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:21:44 --> Severity: Warning --> include(/approvequestions.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:21:44 --> Severity: Warning --> include(/approvequestions.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:21:44 --> Severity: Warning --> include(): Failed opening '/approvequestions.php' for inclusion (include_path='.:/opt/alt/php72/usr/share/pear') /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:21:44 --> Severity: Warning --> include(/navigation.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:21:44 --> Severity: Warning --> include(/navigation.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:21:44 --> Severity: Warning --> include(): Failed opening '/navigation.php' for inclusion (include_path='.:/opt/alt/php72/usr/share/pear') /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:21:44 --> Severity: Warning --> include(/approvequestions.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:21:44 --> Severity: Warning --> include(/approvequestions.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:21:44 --> Severity: Warning --> include(): Failed opening '/approvequestions.php' for inclusion (include_path='.:/opt/alt/php72/usr/share/pear') /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:21:46 --> Severity: Warning --> include(/navigation.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:21:46 --> Severity: Warning --> include(/navigation.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:21:46 --> Severity: Warning --> include(): Failed opening '/navigation.php' for inclusion (include_path='.:/opt/alt/php72/usr/share/pear') /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:21:46 --> Severity: Warning --> include(/approvequestions.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:21:46 --> Severity: Warning --> include(/approvequestions.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:21:46 --> Severity: Warning --> include(): Failed opening '/approvequestions.php' for inclusion (include_path='.:/opt/alt/php72/usr/share/pear') /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:21:58 --> Severity: Warning --> include(/navigation.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:21:58 --> Severity: Warning --> include(/navigation.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:21:58 --> Severity: Warning --> include(): Failed opening '/navigation.php' for inclusion (include_path='.:/opt/alt/php72/usr/share/pear') /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:21:58 --> Severity: Warning --> include(/dashboard.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:21:58 --> Severity: Warning --> include(/dashboard.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:21:58 --> Severity: Warning --> include(): Failed opening '/dashboard.php' for inclusion (include_path='.:/opt/alt/php72/usr/share/pear') /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:21:59 --> Severity: Warning --> include(/navigation.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:21:59 --> Severity: Warning --> include(/navigation.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:21:59 --> Severity: Warning --> include(): Failed opening '/navigation.php' for inclusion (include_path='.:/opt/alt/php72/usr/share/pear') /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:21:59 --> Severity: Warning --> include(/dashboard.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:21:59 --> Severity: Warning --> include(/dashboard.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:21:59 --> Severity: Warning --> include(): Failed opening '/dashboard.php' for inclusion (include_path='.:/opt/alt/php72/usr/share/pear') /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:22:00 --> Severity: Warning --> include(/navigation.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:22:00 --> Severity: Warning --> include(/navigation.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:22:00 --> Severity: Warning --> include(): Failed opening '/navigation.php' for inclusion (include_path='.:/opt/alt/php72/usr/share/pear') /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:22:00 --> Severity: Warning --> include(/dashboard.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:22:00 --> Severity: Warning --> include(/dashboard.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:22:00 --> Severity: Warning --> include(): Failed opening '/dashboard.php' for inclusion (include_path='.:/opt/alt/php72/usr/share/pear') /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:22:05 --> Severity: Warning --> include(/navigation.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:22:05 --> Severity: Warning --> include(/navigation.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:22:05 --> Severity: Warning --> include(): Failed opening '/navigation.php' for inclusion (include_path='.:/opt/alt/php72/usr/share/pear') /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:22:05 --> Severity: Warning --> include(/dashboard.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:22:05 --> Severity: Warning --> include(/dashboard.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:22:05 --> Severity: Warning --> include(): Failed opening '/dashboard.php' for inclusion (include_path='.:/opt/alt/php72/usr/share/pear') /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:22:05 --> Severity: Warning --> include(/navigation.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:22:05 --> Severity: Warning --> include(/navigation.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:22:05 --> Severity: Warning --> include(): Failed opening '/navigation.php' for inclusion (include_path='.:/opt/alt/php72/usr/share/pear') /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:22:05 --> Severity: Warning --> include(/dashboard.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:22:05 --> Severity: Warning --> include(/dashboard.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:22:05 --> Severity: Warning --> include(): Failed opening '/dashboard.php' for inclusion (include_path='.:/opt/alt/php72/usr/share/pear') /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:22:06 --> Severity: Warning --> include(/navigation.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:22:06 --> Severity: Warning --> include(/navigation.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:22:06 --> Severity: Warning --> include(): Failed opening '/navigation.php' for inclusion (include_path='.:/opt/alt/php72/usr/share/pear') /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 08:22:06 --> Severity: Warning --> include(/dashboard.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:22:06 --> Severity: Warning --> include(/dashboard.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:22:06 --> Severity: Warning --> include(): Failed opening '/dashboard.php' for inclusion (include_path='.:/opt/alt/php72/usr/share/pear') /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 08:23:03 --> Query error: Table 'u208937329_quizart_lis.user_acl' doesn't exist - Invalid query: SELECT *
FROM `user_acl`
WHERE `role_id` = '2'
ERROR - 2020-08-01 08:40:30 --> 404 Page Not Found: Assets/frontend
ERROR - 2020-08-01 08:40:30 --> 404 Page Not Found: Assets/frontend
ERROR - 2020-08-01 08:40:30 --> 404 Page Not Found: Assets/frontend
ERROR - 2020-08-01 08:40:31 --> 404 Page Not Found: Assets/frontend
ERROR - 2020-08-01 09:46:34 --> 404 Page Not Found: Assets/frontend
ERROR - 2020-08-01 09:46:34 --> 404 Page Not Found: Assets/frontend
ERROR - 2020-08-01 09:46:34 --> 404 Page Not Found: Assets/frontend
ERROR - 2020-08-01 09:46:34 --> 404 Page Not Found: Assets/frontend
ERROR - 2020-08-01 09:58:41 --> 404 Page Not Found: Assets/frontend
ERROR - 2020-08-01 09:58:42 --> 404 Page Not Found: Assets/frontend
ERROR - 2020-08-01 09:58:42 --> 404 Page Not Found: Assets/frontend
ERROR - 2020-08-01 09:58:43 --> 404 Page Not Found: Assets/frontend
ERROR - 2020-08-01 09:58:47 --> 404 Page Not Found: Assets/frontend
ERROR - 2020-08-01 09:58:47 --> 404 Page Not Found: Assets/frontend
ERROR - 2020-08-01 09:58:47 --> 404 Page Not Found: Assets/frontend
ERROR - 2020-08-01 09:58:49 --> 404 Page Not Found: Assets/frontend
ERROR - 2020-08-01 09:58:55 --> 404 Page Not Found: Assets/frontend
ERROR - 2020-08-01 09:58:56 --> 404 Page Not Found: Assets/frontend
ERROR - 2020-08-01 09:58:56 --> 404 Page Not Found: Assets/frontend
ERROR - 2020-08-01 09:59:00 --> 404 Page Not Found: Assets/frontend
ERROR - 2020-08-01 11:06:00 --> Query error: Table 'u208937329_quizart_lis.user_acl' doesn't exist - Invalid query: SELECT *
FROM `user_acl`
WHERE `role_id` = '2'
ERROR - 2020-08-01 11:23:30 --> 404 Page Not Found: Assets/backend
ERROR - 2020-08-01 11:23:31 --> 404 Page Not Found: Uploads/user_image
ERROR - 2020-08-01 11:25:13 --> 404 Page Not Found: Images/favicon.ico
ERROR - 2020-08-01 11:29:26 --> Query error: Table 'u208937329_quizart_lis.user_acl' doesn't exist - Invalid query: DELETE FROM `user_acl`
WHERE `role_id` = 4
ERROR - 2020-08-01 11:50:51 --> 404 Page Not Found: Images/favicon.ico
ERROR - 2020-08-01 11:51:05 --> 404 Page Not Found: Assets/backend
ERROR - 2020-08-01 12:29:23 --> 404 Page Not Found: Assets/frontend
ERROR - 2020-08-01 14:00:01 --> 404 Page Not Found: Assets/backend
ERROR - 2020-08-01 14:00:01 --> 404 Page Not Found: Uploads/user_image
ERROR - 2020-08-01 14:16:10 --> 404 Page Not Found: Uploads/user_image
ERROR - 2020-08-01 14:21:51 --> 404 Page Not Found: Assets/frontend
ERROR - 2020-08-01 14:21:52 --> 404 Page Not Found: Assets/frontend
ERROR - 2020-08-01 14:21:52 --> 404 Page Not Found: Assets/frontend
ERROR - 2020-08-01 14:21:52 --> 404 Page Not Found: Assets/frontend
ERROR - 2020-08-01 14:31:09 --> 404 Page Not Found: Assets/frontend
ERROR - 2020-08-01 14:31:09 --> 404 Page Not Found: Assets/frontend
ERROR - 2020-08-01 14:31:10 --> 404 Page Not Found: Assets/frontend
ERROR - 2020-08-01 14:31:11 --> 404 Page Not Found: Assets/frontend
ERROR - 2020-08-01 14:34:13 --> 404 Page Not Found: Assets/frontend
ERROR - 2020-08-01 14:34:14 --> 404 Page Not Found: Assets/frontend
ERROR - 2020-08-01 14:34:14 --> 404 Page Not Found: Assets/frontend
ERROR - 2020-08-01 14:34:15 --> 404 Page Not Found: Assets/frontend
ERROR - 2020-08-01 15:27:08 --> 404 Page Not Found: Uploads/user_image
ERROR - 2020-08-01 15:59:30 --> 404 Page Not Found: Robotstxt/index
ERROR - 2020-08-01 15:59:31 --> 404 Page Not Found: Adstxt/index
ERROR - 2020-08-01 16:14:23 --> The path to the image is not correct.
ERROR - 2020-08-01 16:14:23 --> Your server does not support the GD function required to process this type of image.
ERROR - 2020-08-01 16:14:30 --> 404 Page Not Found: Uploads/subcategory
ERROR - 2020-08-01 16:16:30 --> 404 Page Not Found: Assets/frontend
ERROR - 2020-08-01 16:16:30 --> 404 Page Not Found: Assets/frontend
ERROR - 2020-08-01 16:16:30 --> 404 Page Not Found: Assets/frontend
ERROR - 2020-08-01 16:16:30 --> 404 Page Not Found: Assets/frontend
ERROR - 2020-08-01 16:17:19 --> 404 Page Not Found: Uploads/subcategory
ERROR - 2020-08-01 16:17:57 --> 404 Page Not Found: Assets/backend
ERROR - 2020-08-01 16:17:57 --> 404 Page Not Found: Uploads/user_image
ERROR - 2020-08-01 16:18:15 --> 404 Page Not Found: Uploads/subcategory
ERROR - 2020-08-01 16:18:15 --> 404 Page Not Found: Assets/frontend
ERROR - 2020-08-01 16:18:16 --> 404 Page Not Found: Assets/frontend
ERROR - 2020-08-01 16:18:16 --> 404 Page Not Found: Assets/frontend
ERROR - 2020-08-01 16:18:39 --> 404 Page Not Found: Assets/frontend
ERROR - 2020-08-01 16:18:40 --> 404 Page Not Found: Assets/frontend
ERROR - 2020-08-01 16:18:40 --> 404 Page Not Found: Assets/frontend
ERROR - 2020-08-01 16:18:40 --> 404 Page Not Found: Assets/frontend
ERROR - 2020-08-01 16:22:09 --> 404 Page Not Found: Uploads/subcategory
ERROR - 2020-08-01 16:22:16 --> 404 Page Not Found: Uploads/subcategory
ERROR - 2020-08-01 16:23:22 --> 404 Page Not Found: Uploads/subcategory
ERROR - 2020-08-01 16:24:14 --> 404 Page Not Found: Uploads/subcategory
ERROR - 2020-08-01 16:30:14 --> 404 Page Not Found: Uploads/subcategory
ERROR - 2020-08-01 16:31:46 --> 404 Page Not Found: Uploads/subcategory
ERROR - 2020-08-01 16:31:54 --> 404 Page Not Found: Uploads/subcategory
ERROR - 2020-08-01 16:58:18 --> 404 Page Not Found: Assets/backend
ERROR - 2020-08-01 16:58:18 --> 404 Page Not Found: Uploads/user_image
ERROR - 2020-08-01 16:59:57 --> 404 Page Not Found: Images/favicon.ico
ERROR - 2020-08-01 17:01:21 --> 404 Page Not Found: Assets/backend
ERROR - 2020-08-01 17:01:21 --> 404 Page Not Found: Uploads/user_image
ERROR - 2020-08-01 17:02:01 --> 404 Page Not Found: Uploads/user_image
ERROR - 2020-08-01 18:02:21 --> Severity: Warning --> include(/navigation.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 18:02:21 --> Severity: Warning --> include(/navigation.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 18:02:21 --> Severity: Warning --> include(): Failed opening '/navigation.php' for inclusion (include_path='.:/opt/alt/php72/usr/share/pear') /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 26
ERROR - 2020-08-01 18:02:21 --> Severity: Warning --> include(/manage_profile.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 18:02:21 --> Severity: Warning --> include(/manage_profile.php): failed to open stream: No such file or directory /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 18:02:21 --> Severity: Warning --> include(): Failed opening '/manage_profile.php' for inclusion (include_path='.:/opt/alt/php72/usr/share/pear') /home/u208937329/domains/quizart.co.in/public_html/application/views/backend/index.php 30
ERROR - 2020-08-01 18:08:28 --> 404 Page Not Found: Uploads/user_image
ERROR - 2020-08-01 18:23:15 --> 404 Page Not Found: Robotstxt/index
ERROR - 2020-08-01 19:15:10 --> 404 Page Not Found: Uploads/user_image
ERROR - 2020-08-01 19:19:25 --> 404 Page Not Found: Uploads/user_image
ERROR - 2020-08-01 19:32:45 --> 404 Page Not Found: Assets/frontend
ERROR - 2020-08-01 19:32:45 --> 404 Page Not Found: Assets/frontend
ERROR - 2020-08-01 19:32:45 --> 404 Page Not Found: Assets/frontend
ERROR - 2020-08-01 19:32:45 --> 404 Page Not Found: Assets/frontend
ERROR - 2020-08-01 19:34:33 --> 404 Page Not Found: Assets/frontend
ERROR - 2020-08-01 19:34:33 --> 404 Page Not Found: Assets/frontend
ERROR - 2020-08-01 19:34:33 --> 404 Page Not Found: Assets/frontend
ERROR - 2020-08-01 19:34:33 --> 404 Page Not Found: Assets/frontend
ERROR - 2020-08-01 19:35:28 --> 404 Page Not Found: Assets/frontend
ERROR - 2020-08-01 19:35:28 --> 404 Page Not Found: Assets/frontend
ERROR - 2020-08-01 19:35:28 --> 404 Page Not Found: Assets/frontend
ERROR - 2020-08-01 19:35:28 --> 404 Page Not Found: Assets/frontend
ERROR - 2020-08-01 19:35:54 --> 404 Page Not Found: Assets/frontend
ERROR - 2020-08-01 19:35:54 --> 404 Page Not Found: Assets/frontend
ERROR - 2020-08-01 19:35:54 --> 404 Page Not Found: Assets/frontend
ERROR - 2020-08-01 19:35:54 --> 404 Page Not Found: Assets/frontend
ERROR - 2020-08-01 19:43:45 --> 404 Page Not Found: Assets/frontend
ERROR - 2020-08-01 19:43:45 --> 404 Page Not Found: Assets/frontend
ERROR - 2020-08-01 19:43:45 --> 404 Page Not Found: Assets/frontend
ERROR - 2020-08-01 19:43:45 --> 404 Page Not Found: Assets/frontend
ERROR - 2020-08-01 19:45:43 --> 404 Page Not Found: Assets/frontend
ERROR - 2020-08-01 19:45:43 --> 404 Page Not Found: Assets/frontend
ERROR - 2020-08-01 19:45:43 --> 404 Page Not Found: Assets/frontend
ERROR - 2020-08-01 19:45:43 --> 404 Page Not Found: Assets/frontend
ERROR - 2020-08-01 19:46:15 --> 404 Page Not Found: Assets/frontend
ERROR - 2020-08-01 19:46:15 --> 404 Page Not Found: Assets/frontend
ERROR - 2020-08-01 19:46:15 --> 404 Page Not Found: Assets/frontend
ERROR - 2020-08-01 19:46:15 --> 404 Page Not Found: Assets/frontend
ERROR - 2020-08-01 19:58:06 --> 404 Page Not Found: Assets/backend
ERROR - 2020-08-01 19:58:13 --> 404 Page Not Found: Assets/frontend
ERROR - 2020-08-01 19:58:13 --> 404 Page Not Found: Assets/frontend
ERROR - 2020-08-01 19:58:14 --> 404 Page Not Found: Assets/frontend
ERROR - 2020-08-01 19:58:16 --> 404 Page Not Found: Assets/frontend
ERROR - 2020-08-01 21:11:11 --> 404 Page Not Found: Assets/frontend
ERROR - 2020-08-01 21:11:12 --> 404 Page Not Found: Assets/frontend
ERROR - 2020-08-01 21:11:12 --> 404 Page Not Found: Assets/frontend
ERROR - 2020-08-01 21:11:12 --> 404 Page Not Found: Assets/frontend
ERROR - 2020-08-01 21:44:47 --> 404 Page Not Found: Assets/frontend
ERROR - 2020-08-01 21:44:47 --> 404 Page Not Found: Assets/frontend
ERROR - 2020-08-01 21:44:47 --> 404 Page Not Found: Assets/frontend
ERROR - 2020-08-01 21:44:47 --> 404 Page Not Found: Assets/frontend
