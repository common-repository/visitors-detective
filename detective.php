<?
/*
 * Author: Sam (Buzzcop)
 * Author URI: http://profiles.wordpress.org/buzzcop
 * Plugin Name: Visitors Detective
 * Description: A simple plugin for have more information on who and when visit your wordpress site
 * Version: 1.0.5
 */

define('DVP',dirname(__FILE__).'/inc');

function db_active(){
    global $table_prefix;
    mysql_query("
        CREATE TABLE IF NOT EXISTS `".$table_prefix."visitors` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `nation` tinytext NOT NULL,
  `site` tinytext NOT NULL,
  `ip` tinytext NOT NULL,
  `page` tinytext NOT NULL,
  `date` datetime NOT NULL,
  `user` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
        ") or die(get_query_error());
    
}

function remove_table(){
    global $table_prefix;
    mysql_query("DROP TABLE `".$table_prefix."visitors`");
}

register_activation_hook(__FILE__,'db_active');
register_uninstall_hook(__FILE__, 'remove_table');


function add_opt_detective(){
    add_options_page('Visitors Detective', 'Visitors Detective', 'manage_options', 'dtv', 'get_visitors');
}

function get_visitors(){
    require_once DVP.'/visitors.php';
}

function add_visit(){
    require_once DVP.'/vv_adding.php';
}

function get_query_error(){
    echo '<div class="error">
       <p>Impossible create the table necessary for the plugin, check your db or '.DVP.'/detective.php</p>
    </div>';
}

function block_ip(){
    if(!is_super_admin()){
    $ip_list = file(DVP.'/ip_list.php');
    if(in_array($_SERVER['REMOTE_ADDR']."\n",$ip_list)) die('Access denied!');
}
}

add_action('admin_menu','add_opt_detective');
add_action('init','block_ip');
add_action('init','add_visit');