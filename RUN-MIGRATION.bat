@echo off
echo ============================================
echo   Website Pembelajaran Hindu
echo   Running Database Migration & Seeder
echo ============================================
echo.

REM Set PHP 8.3 path
set PATH=E:\app\Coding\laragon\bin\php\php-8.3.32-Win32-vs16-x64;%PATH%

REM Change to project directory
cd /d E:\app\Coding\laragon\www\pembelajaran-hindu

REM Check PHP version
echo Checking PHP version...
php -v
echo.

REM Run migration
echo Running migration and seeder...
echo This will reset the database and create fresh data!
echo.
pause

php artisan migrate:fresh --seed

echo.
echo ============================================
echo   Migration completed!
echo ============================================
echo.

pause
