<?php
namespace PluboRoles;

/**
 * The Processor is in charge of the interaction between the roles and WordPress.
 *
 * @author Joan Rodas <joan@sirvelia.com>
 *
 */
class RolesProcessor
{
    /**
     * The roles.
     *
     * @var Roles
     */
    // private $roles;

    /**
     * Constructor.
     *
     * @param Roles  $roles
     */
    public function __construct()
    {
        // $this->roles = $roles;
    }

    /**
     * Initialize processor with WordPress.
     *
     */
    public static function init()
    {
        $self = new self();
        include_once plugin_dir_path( __FILE__ ) . 'functions.php';
        add_action('init', [$self, 'addRoles']);
        add_action('init', [$self, 'renameRoles']);
        add_action('admin_init', [$self, 'renameRoles']);
    }

    /**
     * Step 1: Add all our roles and register if the roles changed.
     */
    public function addRoles()
    {
        $roles = apply_filters('plubo/roles', []);
        $hash = md5(serialize($roles));
        if ($hash === get_option('plubo-roles-hash')) {
            return;
        }
        foreach ($roles as $role) {
            $this->processRole($role);
        }
        update_option('plubo-roles-hash', $hash);
    }

    private function processRole(Role $role)
    {
        $slug = $role->getSlug();
        $wp_roles = wp_roles();
        $role_exists = $wp_roles->is_role($slug);
        $capsToAdd = $role->getCapsToAdd();
        $capsToRemove = $role->getCapsToRemove();
        if (!$role_exists) {
            error_log('ADD new role ' . $role->getName());
            $baseCaps = get_role($role->getBaseRole())->capabilities;
            $capabilities = array_merge(array_diff($baseCaps, $capsToRemove), $capsToAdd);
            add_role($slug, $role->getName(), $capabilities);
            return;
        }
        if ($role->isSetToRemove()) {
            remove_role($slug);
            return;
        }
        $wp_role = get_role($slug);
        foreach ($capsToAdd as $cap) {
            $wp_role->add_cap($cap);
        }
        foreach ($capsToRemove as $cap) {
            $wp_role->remove_cap($cap);
        }
    }

    public function renameRoles()
    {
        $wp_roles = wp_roles();
        $roles = apply_filters('plubo/roles', []);
        foreach ($roles as $role) {
            if ($role->isSetToRename()) {
                $name = $role->getName();
                $slug = $role->getSlug();
                $wp_roles->roles[$slug]['name'] = $name;
                $wp_roles->role_names[$slug] = $name;
            }
        }
    }
}
