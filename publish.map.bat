@echo off
del .\wp-plugin\achagua\map\*.* /Q
copy frontend\dist\achagua\*.js .\wp-plugin\achagua\map
copy frontend\dist\achagua\*.css .\wp-plugin\achagua\map
copy frontend\dist\achagua\*.ico .\wp-plugin\achagua\map
copy frontend\dist\achagua\*.txt .\wp-plugin\achagua\map
php upver.php
