@echo off
echo ============================================
echo   Website Pembelajaran Hindu
echo   Starting Laravel Development Server...
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

REM Start Laravel server
echo Starting server at http://localhost:8000
echo Press Ctrl+C to stop the server
echo.
php artisan serve

pause
