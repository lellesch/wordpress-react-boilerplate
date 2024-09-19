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

## Step-by-Step Guide for Translation Process

### Step 1: Start build so that the build code is created
   ```bash
   npm run build
   ```


### Step 2: Create the .pot file

1. Open your console/terminal and run the command to generate the `.pot` files:
   ```bash
   npm run makepot
   ```
   **What happens:**
   - This command creates the `.pot` files for PHP and JavaScript files from the Admin and Public directories.
   - The generated `.pot` files for Admin and Public are merged with the main `.pot` file.
   - The temporary `.pot` files are deleted after merging.

### Step 3: Load the .pot file in Poedit

1. Open **Poedit** (or any other translation tool).
2. Select the generated `.pot` file from the `languages` directory of your plugin, for example:
   ```bash
   languages/my-plugin.pot
   ```
3. Load the `.pot` file in Poedit to start translating.

### Step 4: Save the translation

1. Translate all necessary text strings in Poedit.
2. Once the translation is complete, save the file as a `.po` file for the desired language, e.g.:
   ```bash
   languages/my-plugin-de_DE.po
   ```

### Step 5: Generate the .json files for JavaScript translations

1. After saving the translation as a `.po` file, run the `makejson` command to generate the `.json` files:
   ```bash
   npm run makejson
   ```
   **What happens:**
   - This command generates the necessary `.json` files based on the `.po` file for German (`de_DE`).
   - The `--no-purge` option ensures that existing `.json` files are not deleted.

### Customizing the `makejson` command:

If you've created translations for another language, you need to adjust the command accordingly. Example for French (`fr_FR`):
   ```bash
   wp i18n make-json languages/my-plugin-fr_FR.po --no-purge
   ```

### Summary:

1. **Create the `.pot` files**: Run the command `npm run makepot`.
2. **Translate the texts**: Load the `.pot` file in Poedit and save the translation as a `.po` file.
3. **Generate the `.json` files**: Run the command `npm run makejson` to generate the `.json` files.
