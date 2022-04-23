<?php
namespace PluboRoles;

/**
 * Describes a role and its parameters.
 *
 */
final class Role
{
    private $slug;
    private $name;
    private $baseRole;
    private $capsToAdd;
    private $capsToRemove;
    private $restrictAdmin;
    private $restrictAdminMenus;
    private $toRemove;
    private $rename;

    /**
     * Constructor.
     *
     * @param string $slug
     * @param string $name
     */
    public function __construct(string $slug, string $name = '')
    {
        $this->slug = $slug;
        $this->name = $name ?? $slug;
        $this->baseRole ='';
        $this->capsToAdd = [];
        $this->capsToRemove = [];
        $this->restrictAdmin = false;
        $this->restrictAdminMenus = [];
        $this->toRemove = false;
        $this->rename = false;
    }

    /**
     * Sets base roles to extend the capabilities from.
     *
     * @return Role
     */
    public function extend(string $role)
    {
        $this->baseRole = $role;
        return $this;
    }

    /**
     * Adds additional capabilities.
     *
     * @return Role
     */
    public function addCaps($caps)
    {
        $toAdd = is_array($caps) ? $caps : (array) $caps;
        foreach ($toAdd as $capToAdd) {
            $this->capsToAdd[] = $capToAdd;
        }
        return $this;
    }

    /**
     * Removes capabilities.
     *
     * @return Role
     */
    public function removeCaps($caps)
    {
        $toRemove = is_array($caps) ? $caps : (array) $caps;
        foreach ($toRemove as $capToAdd) {
            $this->capsToRemove[] = $capToAdd;
        }
        return $this;
    }

    /**
     * Sets the role name (not slug).
     *
     * @return Role
     */
    public function rename(string $name)
    {
        $this->name = $name;
        $this->rename = true;
        return $this;
    }

    /**
     * Set to delete the role.
     *
     * @return Role
     */
    public function remove()
    {
        $this->toRemove = true;
        return $this;
    }

    /**
     * Set Restricts access to admin menu.
     *
     * @return Role
     */
    public function restrictAdmin(bool $restrictAdmin = true)
    {
        $this->restrictAdmin = $restrictAdmin;
        return $this;
    }

    /**
     * Set Admin menu pages restrictions.
     *
     * @return Role
     */
    public function restrictAdminMenus($menus)
    {
        $toRestrict = is_array($menus) ? $menus : (array) $menus;
        foreach ($toRestrict as $menuToRestrict) {
            $this->restrictAdminMenus[] = $menuToRestrict;
        }
        return $this;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function getName()
    {
        return $this->name;
    }

    public function isSetToRename()
    {
        return $this->rename;
    }

    public function getBaseRole()
    {
        return $this->baseRole;
    }

    public function getCapsToAdd()
    {
        return $this->capsToAdd;
    }

    public function getCapsToRemove()
    {
        return $this->capsToRemove;
    }

    public function isAdminRestricted()
    {
        return $this->restrictAdmin;
    }

    public function getRestrictedAdminMenus()
    {
        return $this->restrictAdminMenus;
    }

    public function isSetToRemove()
    {
        return $this->toRemove;
    }
}
