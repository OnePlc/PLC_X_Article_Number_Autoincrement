--
-- Add custom art nr to article structure
--
ALTER TABLE `article` ADD `custom_art_nr` VARCHAR(50) NOT NULL DEFAULT '' AFTER `label`;

--
-- add new readonly field to form
--
INSERT INTO `core_form_field` (`Field_ID`, `type`, `label`, `fieldkey`, `tab`, `form`, `class`, `url_view`, `url_list`, `show_widget_left`, `allow_clear`, `readonly`, `tbl_cached_name`, `tbl_class`, `tbl_permission`) VALUES
(NULL, 'text', 'Custom Art Nr', 'custom_art_nr', 'article-base', 'article-single', 'col-md-2', '', '', '0', '1', '1', '', '', '');

--
-- add number prefix option
--
INSERT INTO `settings` (`settings_key`, `settings_value`) VALUES ('article-number-prefix', '');

--
-- add current number option
--
INSERT INTO `settings` (`settings_key`, `settings_value`) VALUES ('article-number-current', '1');