<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Set the default time zone.
 */
date_default_timezone_set('Asia/Jakarta');

/**
 * Set the default locale.
 */
setlocale(LC_ALL, 'en_US.utf-8');

/**
 * Enable the Kohana auto-loader.
 */
spl_autoload_register(array('Kohana', 'auto_load'));

/**
 * Enable the Kohana auto-loader for unserialization.
 */
ini_set('unserialize_callback_func', 'spl_autoload_call');

/**
 * Initialize Kohana, setting the default options.
 */
Kohana::init(array(
	'base_url'  => '/',
	'caching'   => FALSE,
	'cache_dir' => MODPATH.'wakuwakuw_v2/cache',
	'profile'   => DEV_MODE,
));


/**
 * Attach a file reader to config. Multiple readers are supported.
 */
Kohana::$config->attach(new Kohana_Config_File);

/**
 * Enable modules. Modules are referenced by a relative or absolute path.
 */
Kohana::modules(array(
	'kohana-ext'     => MODPATH.'kohana-ext', 	// IMPORTANT!!! This must be the first line!!!
	'sprig-ext'	     => MODPATH.'sprig-ext',
	'wakuwakuw'	     => MODPATH.'wakuwakuw_v2',
	'cache'		     => MODPATH.'cache',
	'image'          => MODPATH.'image',      	
	'database'       => MODPATH.'database',     
	'sprig'		     => MODPATH.'sprig',
	'vendors'	     => MODPATH.'vendors',
	'acl' 		     => MODPATH.'acl_v2',
	'auth-desktop'   => MODPATH.'auth-desktop',
	'pseudo-desktop' => MODPATH.'pseudo-desktop',
	//'waku-test' 	 => MODPATH.'waku-tests_v2',
	'migrate' 	 	 => MODPATH.'migrate',
	'cron'			 => MODPATH.'cron', 
	'newsletter'	 => MODPATH.'newsletter',
	//'pagination'   => MODPATH.'pagination', 	
	//'captcha'      => MODPATH.'captcha',
	// 'auth'        => MODPATH.'auth',      
	// 'codebench'   => MODPATH.'codebench', 
	// 'orm'         => MODPATH.'orm',       
	// 'userguide'   => MODPATH.'userguide', 
));


/**
 * Set the routes. Each route must have a minimum of a name, a URI and a set of
 * defaults for the URI.
 */
include MODPATH.'wakuwakuw_v2/config/route.php';
include MODPATH.'auth-desktop/config/route.php';
include MODPATH.'newsletter/config/route.php';



/* End of file bootstrap.php */
/* Location: ./application/bootstrap.php */