
# Gra wisielec

Repozytorium zawiera część backendową gry wisielec wraz z możliwością rejestracji, logowania, zapisywaniam przeglądania własnych rekorów, a także rekordów liderów gry. Punkty przyznawane w grze zależą od czasu odgadnięcia i ilości znaków do odgadnięcia (bez powtórzeń). W projekcie został użyty framework PHP Laravel wraz z bazą danych MySql.

## Instrukcja instalacji

1. Sklonuj repozytorium
```bash
https://github.com/lomza02/hangman-back.git
```
2. Wejdź do folderu projektu
```bash
cd hangman-back
```
3. Zainstaluj wymagane paczki
```bash
composer install
```
4. Skopiuj plik .env.example do .env
```bash
cp .env.example .env
```
5. Skopiuj plik .env.example do .env
```bash
php artisan key:generate
```
6. Skopiuj plik .env.example do .env
```makefile
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=twojaBazaDanych
DB_USERNAME=twojLogin
DB_PASSWORD=twojeHaslo
```
7.Stwórz bazę danych MySQL

```css
mysql -u root -p
```
```sql
CREATE DATABASE twojaBazaDanych;
```
```bash
exit;
```
8.Uruchom migracje

```php
php artisan migrate
```
9. Uruchom aplikację
```php
php artisan serve
```
Aplikacja zostanie uruchomiona na http://localhost:8000.
