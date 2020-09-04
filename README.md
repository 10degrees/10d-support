# 10 Degrees WordCare

Management and reporting WordPress plugin for 10 Degrees WordCare clients.

## Development

Run `composer install` to install dependencies.

## Installing the plugin on client websites

0) If the WordCare plugin is already installed and at version 1.1.0 or below, delete the plugin.
1) Install the latest _Github Updater_ plugin from [https://github.com/afragen/github-updater/releases](https://github.com/afragen/github-updater/releases).
2) https://github.com/10degrees/10d-wordcare-report

Access to this plugin's private repository on Github is controlled via a Personal Access Token, stored in `lib/GithubUpdater.php`.
When this plugin is activated, the _Github Updater_ settings page will no longer be accessible.

## Pushing a plugin update to clients

1) Increment the _Version_ in `10d-wordcare-report.php`. Please use [https://semver.org/](semantic versioning).
2) _Tag_ a new _Release_ on Github. See [https://github.com/afragen/github-updater/wiki/Versions-and-Branches#tagging](Tagging). You can tag within git but it's perferable if you create a new Tag and Release on Github.

## To Do

TBC.