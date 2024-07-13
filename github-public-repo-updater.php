<?php

/**
 * Plugin Name: GitHub Public Repo Updater
 * Plugin URI: https://github.com/JacobG321/wp-plugin-update-from-repo
 * Description: A simple plugin to update a public GitHub repository.
 * Version: 0.1.5
 * Author: Jacob Gruber
 * Author URI: jgruber.dev
 */


if (!defined('ABSPATH')) {
    exit;
}

add_action('admin_init', 'github_public_repo_updater_settings');
function github_public_repo_updater_settings()
{
    register_setting('github-public-repo-updater-settings-group', 'github_public_repo_updater_token');
    add_settings_section('github-public-repo-updater-main-settings', 'Main Settings', 'github_public_repo_updater_main_settings', 'github-public-repo-updater');
    add_settings_field('github_public_repo_updater_token', 'GitHub Token', 'github_public_repo_updater_token', 'github-public-repo-updater', 'github-public-repo-updater-main-settings');
}

function github_public_repo_updater_main_settings()
{
    echo 'Enter your GitHub token below:';
}

function github_public_repo_updater_token()
{
    $token = esc_attr(get_option('github_public_repo_updater_token'));
    echo '<input type="text" name="github_public_repo_updater_token" value="' . $token . '" />';
}

add_action('admin_menu', 'github_public_repo_updater_menu');

function github_public_repo_updater_menu()
{
    add_options_page('GitHub Public Repo Updater', 'GitHub Public Repo Updater', 'manage_options', 'github-public-repo-updater', 'github_public_repo_updater_options');
}

function github_public_repo_updater_options()
{
    ?>
    <div class="wrap">
        <h2>GitHub Public Repo Updater</h2>
        <form method="post" action="options.php">
            <?php settings_fields('github-public-repo-updater-settings-group'); ?>
            <?php do_settings_sections('github-public-repo-updater'); ?>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
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

// get the token
$token = esc_attr(get_option('github_public_repo_updater_token'));

//Optional: If you're using a private repository, specify the access token like this:

if ($token) {
    $myUpdateChecker->setAuthentication($token);
}

