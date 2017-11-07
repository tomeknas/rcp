<?php
include("header.php");
mysql_query("
CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(11) NOT NULL auto_increment,
  `nazwa` varchar(50) collate utf8_unicode_ci NOT NULL,
  `opis` varchar(255) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");

mysql_query("
CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int(11) NOT NULL auto_increment,
  `project_id` int(11) NOT NULL,
  `nazwa` varchar(50) collate utf8_unicode_ci NOT NULL,
  `opis` varchar(255) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `project_id` (`project_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");

mysql_query("
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL auto_increment,
  `nazwa` varchar(15) collate utf8_unicode_ci NOT NULL,
  `imie` varchar(20) collate utf8_unicode_ci NOT NULL,
  `nazwisko` varchar(20) collate utf8_unicode_ci NOT NULL,
  `haslo` varchar(20) collate utf8_unicode_ci NOT NULL,
  `perm` int(11) NOT NULL default '1',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `nazwa` (`nazwa`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");

mysql_query("
CREATE TABLE IF NOT EXISTS `user_tasks` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `start` datetime NOT NULL,
  `stop` datetime NOT NULL,
  `komentarz` varchar(255) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`,`task_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");

mysql_query("
INSERT INTO users (id, nazwa, imie, nazwisko, haslo, perm)
VALUES (1, '$admin_default[user]', '$admin_default[imie]', '$admin_default[nazw]', '$admin_default[pass]', 3)
");

if(user_get(1))
	echo "Gotowe!";
else
	echo "Błąd";
include("footer.php");
?>