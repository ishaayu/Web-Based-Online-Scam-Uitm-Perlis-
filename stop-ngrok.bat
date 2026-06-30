@echo off
echo Stopping ngrok...
taskkill /F /IM ngrok.exe >nul 2>&1
if errorlevel 1 (
    echo No ngrok process was running.
) else (
    echo ngrok stopped. You can now run start-ngrok.bat again.
)
