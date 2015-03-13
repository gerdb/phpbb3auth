Extends Joomla!® default user authentication to allow login with phpBB3 credentials, if Joomla! and phpBB3 share the same database.

[![](http://www.sebulli.com/pics/zip_icon_shaddow.png)](http://www.sebulli.com/phpBB3auth/phpBB3auth.zip)

[Download PlugIn](http://www.sebulli.com/phpBB3auth/phpBB3auth.zip)


[phpbb3auth in the Joomla! Extensions Directory ™](http://extensions.joomla.org/extensions/access-a-security/site-access/authentication-bridges/24619)


mySQL syntax to create a phpBB3 user Table with one entry.

Username: demo

Password: demodemo

```sql

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Table phpbb_users
--

CREATE TABLE IF NOT EXISTS phpbb_users (
user_id mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
user_type tinyint(2) NOT NULL DEFAULT '0',
group_id mediumint(8) unsigned NOT NULL DEFAULT '3',
user_permissions mediumtext COLLATE utf8_bin NOT NULL,
user_perm_from mediumint(8) unsigned NOT NULL DEFAULT '0',
user_ip varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '',
user_regdate int(11) unsigned NOT NULL DEFAULT '0',
username varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
username_clean varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
user_password varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '',
user_passchg int(11) unsigned NOT NULL DEFAULT '0',
user_pass_convert tinyint(1) unsigned NOT NULL DEFAULT '0',
user_email varchar(100) COLLATE utf8_bin NOT NULL DEFAULT '',
user_email_hash bigint(20) NOT NULL DEFAULT '0',
user_birthday varchar(10) COLLATE utf8_bin NOT NULL DEFAULT '',
user_lastvisit int(11) unsigned NOT NULL DEFAULT '0',
user_lastmark int(11) unsigned NOT NULL DEFAULT '0',
user_lastpost_time int(11) unsigned NOT NULL DEFAULT '0',
user_lastpage varchar(200) COLLATE utf8_bin NOT NULL DEFAULT '',
user_last_confirm_key varchar(10) COLLATE utf8_bin NOT NULL DEFAULT '',
user_last_search int(11) unsigned NOT NULL DEFAULT '0',
user_warnings tinyint(4) NOT NULL DEFAULT '0',
user_last_warning int(11) unsigned NOT NULL DEFAULT '0',
user_login_attempts tinyint(4) NOT NULL DEFAULT '0',
user_inactive_reason tinyint(2) NOT NULL DEFAULT '0',
user_inactive_time int(11) unsigned NOT NULL DEFAULT '0',
user_posts mediumint(8) unsigned NOT NULL DEFAULT '0',
user_lang varchar(30) COLLATE utf8_bin NOT NULL DEFAULT '',
user_timezone decimal(5,2) NOT NULL DEFAULT '0.00',
user_dst tinyint(1) unsigned NOT NULL DEFAULT '0',
user_dateformat varchar(30) COLLATE utf8_bin NOT NULL DEFAULT 'd M Y H:i',
user_style mediumint(8) unsigned NOT NULL DEFAULT '0',
user_rank mediumint(8) unsigned NOT NULL DEFAULT '0',
user_colour varchar(6) COLLATE utf8_bin NOT NULL DEFAULT '',
user_new_privmsg int(4) NOT NULL DEFAULT '0',
user_unread_privmsg int(4) NOT NULL DEFAULT '0',
user_last_privmsg int(11) unsigned NOT NULL DEFAULT '0',
user_message_rules tinyint(1) unsigned NOT NULL DEFAULT '0',
user_full_folder int(11) NOT NULL DEFAULT '-3',
user_emailtime int(11) unsigned NOT NULL DEFAULT '0',
user_topic_show_days smallint(4) unsigned NOT NULL DEFAULT '0',
user_topic_sortby_type varchar(1) COLLATE utf8_bin NOT NULL DEFAULT 't',
user_topic_sortby_dir varchar(1) COLLATE utf8_bin NOT NULL DEFAULT 'd',
user_post_show_days smallint(4) unsigned NOT NULL DEFAULT '0',
user_post_sortby_type varchar(1) COLLATE utf8_bin NOT NULL DEFAULT 't',
user_post_sortby_dir varchar(1) COLLATE utf8_bin NOT NULL DEFAULT 'a',
user_notify tinyint(1) unsigned NOT NULL DEFAULT '0',
user_notify_pm tinyint(1) unsigned NOT NULL DEFAULT '1',
user_notify_type tinyint(4) NOT NULL DEFAULT '0',
user_allow_pm tinyint(1) unsigned NOT NULL DEFAULT '1',
user_allow_viewonline tinyint(1) unsigned NOT NULL DEFAULT '1',
user_allow_viewemail tinyint(1) unsigned NOT NULL DEFAULT '1',
user_allow_massemail tinyint(1) unsigned NOT NULL DEFAULT '1',
user_options int(11) unsigned NOT NULL DEFAULT '230271',
user_avatar varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
user_avatar_type tinyint(2) NOT NULL DEFAULT '0',
user_avatar_width smallint(4) unsigned NOT NULL DEFAULT '0',
user_avatar_height smallint(4) unsigned NOT NULL DEFAULT '0',
user_sig mediumtext COLLATE utf8_bin NOT NULL,
user_sig_bbcode_uid varchar(8) COLLATE utf8_bin NOT NULL DEFAULT '',
user_sig_bbcode_bitfield varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
user_from varchar(100) COLLATE utf8_bin NOT NULL DEFAULT '',
user_icq varchar(15) COLLATE utf8_bin NOT NULL DEFAULT '',
user_aim varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
user_yim varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
user_msnm varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
user_jabber varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
user_website varchar(200) COLLATE utf8_bin NOT NULL DEFAULT '',
user_occ text COLLATE utf8_bin NOT NULL,
user_interests text COLLATE utf8_bin NOT NULL,
user_actkey varchar(32) COLLATE utf8_bin NOT NULL DEFAULT '',
user_newpasswd varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '',
user_form_salt varchar(32) COLLATE utf8_bin NOT NULL DEFAULT '',
user_new tinyint(1) unsigned NOT NULL DEFAULT '1',
user_reminded tinyint(4) NOT NULL DEFAULT '0',
user_reminded_time int(11) unsigned NOT NULL DEFAULT '0',
PRIMARY KEY (user_id),
UNIQUE KEY username_clean (username_clean),
KEY user_birthday (user_birthday),
KEY user_email_hash (user_email_hash),
KEY user_type (user_type)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1388 ;

--
-- Data
--

INSERT INTO phpbb_users (user_type, group_id, user_permissions, user_perm_from, user_ip, user_regdate, username, username_clean, user_password, user_passchg, user_pass_convert, user_email, user_email_hash, user_birthday, user_lastvisit, user_lastmark, user_lastpost_time, user_lastpage, user_last_confirm_key, user_last_search, user_warnings, user_last_warning, user_login_attempts, user_inactive_reason, user_inactive_time, user_posts, user_lang, user_timezone, user_dst, user_dateformat, user_style, user_rank, user_colour, user_new_privmsg, user_unread_privmsg, user_last_privmsg, user_message_rules, user_full_folder, user_emailtime, user_topic_show_days, user_topic_sortby_type, user_topic_sortby_dir, user_post_show_days, user_post_sortby_type, user_post_sortby_dir, user_notify, user_notify_pm, user_notify_type, user_allow_pm, user_allow_viewonline, user_allow_viewemail, user_allow_massemail, user_options, user_avatar, user_avatar_type, user_avatar_width, user_avatar_height, user_sig, user_sig_bbcode_uid, user_sig_bbcode_bitfield, user_from, user_icq, user_aim, user_yim, user_msnm, user_jabber, user_website, user_occ, user_interests, user_actkey, user_newpasswd, user_form_salt, user_new, user_reminded, user_reminded_time) VALUES
(0, 2, 0x3030303030303030303036787632396e77670a6931636a796f3030303030300a716c633470693030303030300a0a6931636a796f3030303030300a716c633470693030303030300a716c633470693030303030300a6931636a796f3030303030300a6931636a796f3030303030300a716c633470693030303030300a716c633470693030303030300a716c633470693030303030300a6931636a796f3030303030300a716c633470693030303030300a716c633470693030303030300a716c633470693030303030300a716c633470693030303030300a716c633470693030303030300a716c633470693030303030300a716c633470693030303030300a716c633470693030303030300a716c633470693030303030300a6931636a796f3030303030300a716c633470693030303030300a716c633470693030303030300a716c633470693030303030300a716c633470693030303030300a716c633470693030303030300a716c633470693030303030300a716c633470693030303030300a716c633470693030303030300a716c633470693030303030300a716c633470693030303030300a716c63347069303030303030, 0, '127.0.0.1', 1370892086, 'demo', 'demo', '$H$97B0tRYCXOUcxdf.H./vE71idl41W1/', 1370892086, 0, 'infoATyourdomain.com', 187905637916, '', 0, 1370892086, 0, '', '', 0, 0, 0, 0, 1, 1370892086, 0, 'en', 1.00, 1, 'd M Y H:i', 24, 0, '', 0, 0, 0, 0, -3, 0, 0, 't', 'd', 0, 't', 'a', 0, 1, 0, 1, 1, 1, 1, 230271, '', 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '1HYGC2U', '', '2b84737e4d787ec2', 0, 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

```




The Joomla! name and logos are registered trademarks in the United States and elsewhere held by Open Source Matters.

phpBB is a trademarks in the United States and other countries.