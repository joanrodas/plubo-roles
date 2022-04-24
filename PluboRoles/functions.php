<?php
if (!function_exists('pb_role')) {
	/**
	 * Role creator helper
	 *
	 * @param  string $slug The role slug.
     * @param  string $name The role name.
	 * @return Role Role object instance.
	 */
	function pb_role(string $slug, string $name = '')
    {
		return new PluboRoles\Role($slug, $name);
	}
}
