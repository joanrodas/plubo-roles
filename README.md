<p align="center">
  Plubo Roles
</p>

[![GitHub stars](https://img.shields.io/github/stars/joanrodas/plubo-roles?style=for-the-badge)](https://github.com/joanrodas/plubo-roles/stargazers)
![Code Climate maintainability](https://img.shields.io/codeclimate/maintainability-percentage/joanrodas/plubo-roles?style=for-the-badge)

WordPress roles simplified.


<br/>

## Getting started

`composer require joanrodas/plubo-roles`

> You can also install Plubo Roles as a standalone WordPress plugin, simply downloading the zip and placing it in the plugins folder.

<br/>

## Basic usage

```php
<?php
PluboRoles\RolesProcessor::init();

add_filter('plubo/roles', function($roles) {
  $roles[] = pb_role('student', 'Student')->extend('subscriber')->addCaps(['view_lesson', 'view_task']);
  $roles[] = pb_role('instructor')->extend('contributor')->restrictAdmin();
  $roles[] = pb_role('subscriber')->rename('Member');
  return $roles;
}); ?>
```

<br>

## Contributions
[![contributions welcome](https://img.shields.io/badge/contributions-welcome-brightgreen.svg?style=for-the-badge)](https://github.com/joanrodas/plubo-roles/issues)
[![GitHub issues](https://img.shields.io/github/issues/joanrodas/plubo-roles?style=for-the-badge)](https://github.com/joanrodas/plubo-roles/issues)
[![GitHub license](https://img.shields.io/github/license/joanrodas/plubo-roles?style=for-the-badge)](https://github.com/joanrodas/plubo-roles/blob/main/LICENSE)


Feel free to contribute to the project, suggesting improvements, reporting bugs and coding.
