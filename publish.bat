@echo off
del .\wp-plugin\achagua\app\*.* /Q
copy frontend\dist\achagua\*.js .\wp-plugin\achagua\app
copy frontend\dist\achagua\*.css .\wp-plugin\achagua\app
copy frontend\dist\achagua\*.ico .\wp-plugin\achagua\app
copy frontend\dist\achagua\*.txt .\wp-plugin\achagua\app
