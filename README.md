# TaxonomyCaseGuard Plugin

**This README.md file should be modified to describe the features, installation, configuration, and general usage of the plugin.**

The **TaxonomyCaseGuard** Plugin is an extension for [Grav CMS](http://github.com/getgrav/grav). taxonomy-case-guard

## Installation

Installing the TaxonomyCaseGuard plugin can be done in one of three ways: The GPM (Grav Package Manager) installation method lets you quickly install the plugin with a simple terminal command, the manual method lets you do so via a zip file, and the admin method lets you do so via the Admin Plugin.

### Manual Installation

To install the plugin manually, download the zip-version of this repository and unzip it under `/your/site/grav/user/plugins`. Then rename the folder to `taxonomy-case-guard`. You can find these files on [GitHub](https://github.com/taxonomy-case-guard/grav-plugin-taxonomy-case-guard) or via [GetGrav.org](http://getgrav.org/downloads/plugins#extras).

You should now have all the plugin files under

    /your/site/grav/user/plugins/taxonomy-case-guard
	
> NOTE: This plugin is a modular component for Grav which may require other plugins to operate, please see its [blueprints.yaml-file on GitHub](https://github.com/taxonomy-case-guard/grav-plugin-taxonomy-case-guard/blob/master/blueprints.yaml).


## Configuration

Before configuring this plugin, you should copy the `user/plugins/taxonomy-case-guard/taxonomy-case-guard.yaml` to `user/config/plugins/taxonomy-case-guard.yaml` and only edit that copy.

Here is the default configuration and an explanation of available options:

```yaml
enabled: true
case: capitalize  # One of capitalize|uppercase|lowercase
```

Note that if you use the Admin Plugin, a file with your configuration named taxonomy-case-guard.yaml will be saved in the `user/config/plugins/`-folder once the configuration is saved in the Admin.

## Usage

### CLI
- `$ bin/plugin taxonomy-case-guard set-case --case capitalize` # one of capitalize|uppercase|lowercase

    This command will loop through all pages and will replace each and every taxonomy value to the preferred case.
- `$ bin/plugin taxonomy-case-guard replace --search category.blog --replace Blog`

    This command will search for pages with taxonomy `category.blog` and will replace it with `Blog`
### Admin
- When saving a page, the taxonomy values in the header will be converted to the preferred case (as set in config file).

## Credits

**Did you incorporate third-party code? Want to thank somebody?**

## To Do

- [ ] Future plans, if any

