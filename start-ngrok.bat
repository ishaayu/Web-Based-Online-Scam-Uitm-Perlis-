@echo off
setlocal

echo.
echo === UiTM Guard - ngrok ===
echo.

where ngrok >nul 2>&1
if errorlevel 1 (
    echo ERROR: ngrok is not installed or not in PATH.
    exit /b 1
)

tasklist /FI "IMAGENAME eq ngrok.exe" 2>nul | find /I "ngrok.exe" >nul
if not errorlevel 1 (
    echo ngrok is already running. Do NOT start a second copy.
    echo.
    echo Your public URL should be:
    powershell -NoProfile -Command "try { (Invoke-RestMethod 'http://127.0.0.1:4040/api/tunnels').tunnels | ForEach-Object { $_.public_url } } catch { '  open http://127.0.0.1:4040 in your browser' }"
    echo.
    echo Local app must be running on port 8000:
    echo   cd C:\laragon\www\uitmguard
    echo   php artisan serve
    echo.
    echo To restart ngrok, run stop-ngrok.bat first, then run this script again.
    exit /b 0
)

netstat -ano | findstr ":8000" | findstr "LISTENING" >nul
if errorlevel 1 (
    echo WARNING: Nothing is listening on port 8000.
    echo Start Laravel first in another terminal:
    echo   cd C:\laragon\www\uitmguard
    echo   php artisan serve
    echo.
    pause
)

echo Starting ngrok tunnel to http://localhost:8000 ...
echo Copy the https://....ngrok-free.dev URL from below.
echo.
ngrok start uitmguard --config "%~dp0ngrok.yml"
