#!/bin/bash

# Setzen der Umgebungsvariable für die Zeichenkodierung
export LC_CTYPE=C

read -p "Plugin Name (Replace My Plugin Name): " plugin_name
read -p "Plugin Namespace Name (Replace MyPluginNamespace): " namespace_name
read -p "Plugin Defined Name (Replace MY_PLUGIN): " plugin_defined_name
read -p "Plugin Slug Name (Replace my-plugin): " plugin_slug_name
read -p "Plugin Slug Prefix Name (Replace my_plugin_): " plugin_prefix_name

# Pfad zum Unterordner
plugin_dir="./my-plugin"

# Funktion zur Durchführung der Suche und Ersetzung
replace_string() {
  local suche=$1
  local ersetze=$2
  local pfad="$plugin_dir" # Pfad zum Unterordner
  grep -rl --exclude="*.sh" --exclude="*.md" --exclude="*.txt" "$suche" "$pfad" | xargs sed -i '' "s|$suche|$ersetze|g"
}

if [[ -z $plugin_name ]]; then
  plugin_name="My Plugin Name"
fi

replace_string "My Plugin Name" "${plugin_name}"

if [[ -z $namespace_name ]]; then
  namespace_name="MyPluginNamespace"
fi

replace_string "MyPluginNamespace" "${namespace_name}"

if [[ -z $plugin_defined_name ]]; then
  plugin_defined_name="MY_PLUGIN"
fi

replace_string "MY_PLUGIN" "${plugin_defined_name}"

if [[ -z $plugin_slug_name ]]; then
  plugin_slug_name="my-plugin"
fi

replace_string "my-plugin" "${plugin_slug_name}"

if [[ -z $plugin_prefix_name ]]; then
  plugin_prefix_name="my_plugin_"
fi

replace_string "my_plugin_" "${plugin_prefix_name}"

# Umbenennen der Haupt-Plugin-Datei
mv "${plugin_dir}/my-plugin.php" "${plugin_dir}/${plugin_slug_name}.php"

# Umbenennen des Verzeichnisses
mv "$plugin_dir" "./${plugin_slug_name}"

echo "Replacements and renaming have been completed. Directory is now ./${plugin_slug_name}."
exit 0
