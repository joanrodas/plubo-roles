<?php

/**
 * The plugin bootstrap file
 *
 * @wordpress-plugin
 * Plugin Name:       PLUBO Roles
 * Plugin URI:        https://sirvelia.com/
 * Description:       WordPress roles simplified.
 * Version:           0.1.0
 * Author:            Joan Rodas - Sirvelia
 * Author URI:        https://sirvelia.com/
 * License:           GPL-3.0+
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain:       plubo-roles
 * Domain Path:       /languages
 */

define( 'PBR_PATH', plugin_dir_path( __FILE__ ) );
require_once PBR_PATH . 'vendor/autoload.php';

PluboRoles\RolesProcessor::init();

add_filter('plubo/roles', function ($roles) {
    $roles[] = pb_role('test', 'Rol test')->extend('subscriber');
    $roles[] = pb_role('subscriber')->rename('Patata');
    return $roles;
});
