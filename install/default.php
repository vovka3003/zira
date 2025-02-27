<?php
if (!defined('ZIRA_INSTALL')) exit;

/**
 * System default settings
 */
return array(
    'timezone' => 'UTC',
    'clean_url' => true,
    'language' => 'ru',
    'languages' => array('ru'),
    'detect_language' => false,
    'db_translates' => false,
    'theme' => 'default',
    'layout' => 'layout-right',
    'modules' => array(),
    'caching' => true,
    'cache_lifetime' => 3600,
    'thumbs_width' => 200,
    'thumbs_height' => 150,
    'watermark_enabled' => false,
    'watermark' => '',
    'use_smtp' => false,
    'smtp_host' => 'smtp.gmail.com',
    'smtp_port' => 587,
    'smtp_secure' => 'tls',
    'smtp_username' => '',
    'smtp_password' => '',
    'email_from' => 'info@'.$_SERVER['HTTP_HOST'],
    'email_from_name' => $_SERVER['HTTP_HOST'],
    'feedback_email' => 'info@'.$_SERVER['HTTP_HOST'],
    'date_format' => 'd.m.Y',
    'datepicker_date_format' => 'DD.MM.YYYY',
    'user_photo_min_width' => 250,
    'user_photo_min_height' => 250,
    'user_photo_max_width' => 700,
    'user_photo_max_height' => 700,
    'user_thumb_width' => 100,
    'user_thumb_height' => 100,
    'gzip' => true,
    'site_name' => 'Zira',
    'site_title' => 'Zira CMS',
    'site_slogan' => '',
    'site_logo' => 'assets/images/zira.png',
    'site_copyright' => '',
    'site_keywords' => '',
    'site_description' => '',
    'site_window_title' => true,
    'config_version' => 1,
    'db_version' => 5
);