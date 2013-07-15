ROM Stats
=========

**Description**:
Usage statistics for ROM developer (a la Cyanogenmod Stats)

This is a simple web client backend I wrote in php/mysql to save the submitted data.

This is just a demo application, done on the fly as an example of what can be done, I do not support it or have plans to make it a full web statistical application for the ROM Stats.

**Requirements**:
This application requires a web server that supports PHP/MySQL and .htaccess support

the .htaccess support is required because the ROM Stats Android applications submits the statistics to "http://stats.domain.com/submit" with no .php extension at the end, and to be able to map that action to the submit.php file the support of htaccess is required.

**Setup**: 
1) Create a new database on a MySQL server, and import the "database\create_db_table.sql" file in that database
2) Change the server parameters in the config.inc.php file to point to your MySQL server, with correct username and password
3) done
