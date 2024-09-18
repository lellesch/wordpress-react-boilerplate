# WordPress React Boilerplate

WordPress React Boilerplate is a boilerplate plugin for WordPress that enables a modern React integration and provides a clear structure for the separation of admin and frontend functions.

## Features

- Separation of admin and frontend areas 
- React integration for admin and frontend components 
- psr 4 autoloading 
- Hook registration for admin and frontend 
- Shortcodes for the frontend areaet.

## Using the setup script:

The project contains a shell script (`replace.sh`) that replaces the placeholders in the plugin framework with user-defined values. The script facilitates the creation of a new plugin based on the boilerplate.

### Steps for use:

1. Make sure that you make the script executable:
   ```bash
   chmod +x replace.sh
2. execute the script:
   ````bash
   ./replace.sh
3. Provide the following information when prompted:
   - Plugin Name: The full name of your plugin (replaces My Plugin Name). 
   - Namespace Name: The namespace of your plugin (replaces MyPluginNamespace). 
   - Defined Name: The plugin constant (replaces MY_PLUGIN). 
   - Plugin Slug: The slug of your plugin (replaces my-plugin). 
   - Plugin Prefix: The prefix for your plugin functions (replaces my_plugin_name_).
4.	The script will replace the placeholders in the files, rename the main plugin file, and adjust the plugin directory accordingly.
5.	Once complete, your plugin’s directory and files will be correctly set up.
