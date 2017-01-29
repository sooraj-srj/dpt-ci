ALTER TABLE `default_tour_categories` CHANGE `header_image` `header_image` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL;

ALTER TABLE `default_visa_booking` ADD `how_discover_us` VARCHAR(155) NOT NULL AFTER `passport_copy`;

ALTER TABLE `default_visa_booking` ADD `nationality` VARCHAR(155) NOT NULL AFTER `contact_no`;