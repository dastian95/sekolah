@echo off
REM ============================================================
REM  COPY PROJECT KE USB (Versi Ringan)
REM  Ukuran asli  : ~110 MB
REM  Setelah copy : ~3-5 MB (tanpa vendor & node_modules)
REM ============================================================
REM
REM  CARA PAKAI:
REM  1. Colokkan USB
REM  2. Double-click file ini ATAU jalankan di CMD:
REM       copy-to-usb.bat E
REM     (ganti E dengan huruf drive USB Anda)
REM
REM ============================================================

setlocal enabledelayedexpansion

REM --- Tentukan drive USB ---
if "%~1"=="" (
    echo.
    echo ============================================
    echo   COPY PROJECT KE USB - SDIT Labitech
    echo ============================================
    echo.
    set /p DRIVE="Masukkan huruf drive USB (contoh: E): "
) else (
    set DRIVE=%~1
)

set DEST=%DRIVE%:\sekolah

echo.
echo [INFO] Akan meng-copy project ke: %DEST%
echo [INFO] Folder vendor, node_modules, .git akan di-SKIP
echo.
pause

REM --- Buat folder tujuan ---
if not exist "%DEST%" mkdir "%DEST%"

REM --- Copy dengan EXCLUDE ---
robocopy "g:\laragon\www\sekolah" "%DEST%" /E /XD vendor node_modules .git storage\framework\cache storage\framework\sessions storage\framework\views storage\logs /XF *.log /NFL /NDL /NP

REM --- Buat folder storage yang dibutuhkan Laravel (kosong) ---
mkdir "%DEST%\storage\app\public" 2>nul
mkdir "%DEST%\storage\framework\cache\data" 2>nul
mkdir "%DEST%\storage\framework\sessions" 2>nul
mkdir "%DEST%\storage\framework\views" 2>nul
mkdir "%DEST%\storage\logs" 2>nul

REM --- Buat .gitkeep agar folder tidak hilang ---
echo. > "%DEST%\storage\logs\.gitkeep"
echo. > "%DEST%\storage\framework\cache\.gitkeep"
echo. > "%DEST%\storage\framework\sessions\.gitkeep"
echo. > "%DEST%\storage\framework\views\.gitkeep"

echo.
echo ============================================
echo   SELESAI!
echo ============================================
echo.
echo   Project sudah di-copy ke: %DEST%
echo.
echo   Untuk menjalankan kembali di PC lain:
echo   1. cd %DEST%
echo   2. composer install
echo   3. npm install
echo   4. cp .env.example .env
echo   5. php artisan key:generate
echo   6. php artisan migrate --seed
echo   7. npm run build
echo   8. php artisan serve
echo.
echo ============================================
pause
