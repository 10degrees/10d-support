# 10 Degrees Support

Management and reporting WordPress plugin for 10 Degrees Support and maintenance clients.

## Functionality

* Provides a Dashboard widget to show plugin updates, website performance
* A report of the above can be emailed to one address
* Disables plugin and theme auto-update UI
* Disables full site editing

## Development

Run `composer install` to install dependencies.

## Installing the plugin on client websites

0) If the Support and maintenance plugin is already installed and at version 1.1.0 or below, delete the plugin.
1) Install the latest _Github Updater_ plugin from [https://github.com/afragen/github-updater/releases](https://github.com/afragen/github-updater/releases).
2) In Settings -> Github Updater -> Install plugin, using the URI [https://github.com/10degrees/10d-support-report](https://github.com/10degrees/10d-support-report) and the Github token. The token is stored in this plugin in `lib/GithubUpdater.php`.

When this plugin is activated, the _Github Updater_ settings page will no longer be accessible.

## Pushing a plugin update to clients

1) Increment the _Version_ in `10d-support-report.php`. Please use <a href="https://semver.org/">semantic versioning</a>.
2) _Tag_ a new _Release_ on Github. See <a href="https://github.com/afragen/github-updater/wiki/Versions-and-Branches#tagging">Tagging</a>. You can tag within git but it's preferable if you create a new Tag and Release on Github.

## To Do

TBC.
