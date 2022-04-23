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
 * Text Domain:       plubo-routes
 * Domain Path:       /languages
 */

require_once plugin_dir_path(__FILE__) . 'vendor/autoload.php';

PluboRoles\RolesProcessor::init();

add_filter('plubo/roles', function ($roles) {
    $roles[] = (new PluboRoles\Role('test', 'Rol test'))->extend('subscriber');
    $roles[] = (new PluboRoles\Role('subscriber'))->rename('Patata');
    return $roles;
});
