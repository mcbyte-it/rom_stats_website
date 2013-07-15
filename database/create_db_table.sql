CREATE TABLE IF NOT EXISTS `zrom_stats` (
  `date_register` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_last_checking` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `device_hash` varchar(40) NOT NULL,
  `device_name` varchar(60) NOT NULL,
  `device_version` varchar(50) NOT NULL,
  `device_country` varchar(20) NOT NULL,
  `device_carrier` varchar(50) NOT NULL,
  `device_carrier_id` varchar(100) NOT NULL,
  `rom_name` varchar(150) NOT NULL,
  `rom_version` varchar(50) NOT NULL,
  PRIMARY KEY (`device_hash`)
) CHARSET=utf8;
