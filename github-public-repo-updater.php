<?php

/**
 * Plugin Name: GitHub Public Repo Updater
 * Plugin URI: https://github.com/JacobG321/wp-plugin-update-from-repo
 * Description: A simple plugin to update a public GitHub repository.
 * Version: 0.0.1
 * Author: Jacob Gruber
 * Author URI: jgruber.dev
 */


if (!defined('ABSPATH')) {
    exit;
}


require 'inc/plugin-update-checker/plugin-update-checker.php';

use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

$myUpdateChecker = PucFactory::buildUpdateChecker(
    'https://github.com/JacobG321/wp-plugin-update-from-repo',
    __FILE__,
    'wp-plugin-update-from-repo'
);

//Set the branch that contains the stable release.
$myUpdateChecker->setBranch('main');

//Optional: If you're using a private repository, specify the access token like this:
// $myUpdateChecker->setAuthentication('your-token-here');
