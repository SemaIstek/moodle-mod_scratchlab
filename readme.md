# ScratchLab for Moodle

This project is a Moodle plugin based on the Scratch editor architecture. The original Scratch editor implementation was adapted from the Scratch-Editor GitHub repository for HEVS-PHVS and made available inside Moodle.

The following features are currently active:

- ✅ Embedded Scratch 3 editor inside Moodle
- ✅ Custom sprite / figure addition
- ✅ Custom visual assets and resource loading
- ✅ Project save and load support
- ✅ Moodle activity integration
- ✅ Classroom-friendly interface

## Project Purpose

This plugin allows students to access Scratch-based programming directly within the Moodle environment. In educational contexts such as HEVS-PHVS, it brings block-based learning experiences into the Moodle platform.

## Feature Summary

- Scratch 3-like interface
- Works as a Moodle activity module
- Students can create, save, and load projects
- Custom figure/sprite support is enabled
- Frontend is built on the Scratch editor-based architecture

## Plugin Structure

This project is organized according to the Moodle module structure.

Main folder structure:

- mod/scratcheditor/
  - version.php
  - lib.php
  - view.php
  - mod_form.php
  - frontend/
  - lang/en/scratcheditor.php

## Installation as a Moodle Plugin

### 1. Copy the plugin into your Moodle installation

Place the plugin folder into your Moodle root directory:

- Moodle root/mod/scratcheditor

If the folder name differs, it is recommended to keep it as `scratcheditor`.

### 2. Upgrade the Moodle database

Run the following command to make Moodle recognize the plugin:

```bash
php admin/cli/upgrade.php
```

### 3. Add it from the Moodle admin panel

1. Sign in with an administrator account.
2. Open a course from the Moodle dashboard.
3. Choose ScratchLab from the activity list.
4. Create and save the activity.

## Local Testing

### Option 1: Test with a local Moodle installation

1. Set up a local web server such as XAMPP, WAMP, MAMP, or a similar environment.
2. Run your Moodle installation locally.
3. Copy the plugin into the Moodle modules directory.
4. Run the Moodle database upgrade.
5. Open the relevant course and add the activity.
6. Test it in the browser.

### Option 2: Test the frontend only

If you want to test only the interface, you can open the frontend folder through a local server:

```bash
php -S localhost:8000
```

Then open the following URL in your browser:

```text
http://localhost:8000/mod/scratcheditor/frontend/index.html
```

Note: For full functionality, testing through a Moodle environment is recommended.

## Development Notes

- This project is based on the Scratch-Editor GitHub repository and adapted for Moodle.
- It has been customized for HEVS-PHVS requirements.
- Custom figure/sprite support has been enabled.
- If frontend files are modified, the corresponding Moodle-side files should also be updated.

## Troubleshooting

- If the plugin does not appear, clear the Moodle cache.
- If the activity does not open, confirm that `upgrade.php` has been run.
- If there are interface issues, check the browser developer console.
- If a feature does not work, verify that the frontend files were copied correctly into the Moodle plugin folder.

## Requirements

- Moodle 4.x / 5.x compatible environment
- PHP support
- Database support such as MySQL, PostgreSQL, or SQLite
- Modern web browser

## License

This project is an adaptation of Moodle and Scratch editor-based development work and should be used according to the relevant licensing terms.
