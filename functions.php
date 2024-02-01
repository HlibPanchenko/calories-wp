<?php

require_once __DIR__ . '/vendor/autoload.php';

use src\InitTheme;

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if (class_exists('Kirki')) {
    require_once('config/customizer.php');
}

// Старт сессии
if (!session_id()) {
    session_start();
}

//if ( get_role('member_role') ) {
//    remove_role('member_role');
//}

InitTheme::initHooks();







