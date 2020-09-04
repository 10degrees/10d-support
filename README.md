# 10 Degrees WordCare

Management and reporting WordPress plugin for 10 Degrees WordCare clients.

## Development

Run `composer install` to install dependencies.

## Installing the plugin on client websites

1) Install the latest _Github Updater_ plugin from [https://github.com/afragen/github-updater/releases](https://github.com/afragen/github-updater/releases).
2) https://github.com/10degrees/10d-wordcare-report

Access to this plugin's private repository on Github is controlled via a Personal Access Token, stored in `lib/GithubUpdater.php`.
When this plugin is activated, the _Github Updater_ settings page will no longer be accessible.

## Pushing a plugin update to clients

Increment the _Version_ in `10d-wordcare-report.php`. Please use [https://semver.org/](semantic versioning).

## To Do

TBC.