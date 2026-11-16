# Modern Car Rent — PHP + MySQL

This version uses **PHP 8.1+**, **MySQL 8+**, PDO, HTML, Bootstrap 5.3 CDN, and vanilla JavaScript. Node.js and npm are not required.

## Requirements
- PHP 8.1 or newer with `pdo_mysql` and `mbstring` enabled
- MySQL 8+ or MariaDB 10.5+
- XAMPP, WAMP, MAMP, or a PHP development server
- Internet connection for Bootstrap CDN and sample vehicle images

## Install with XAMPP (Windows)
1. Install and open XAMPP.
2. Start **Apache** and **MySQL**.
3. Copy this entire `modern-car-rent-php` folder into `C:\\xampp\\htdocs\\`.
4. Open phpMyAdmin at `http://localhost/phpmyadmin`.
5. Choose **Import**, select this project's `database.sql`, and import it. This creates the `modern_car_rent` database and tables.
6. Check `config.php`. Default XAMPP settings are `DB_USER='root'` and an empty `DB_PASS`. Change them if your MySQL credentials differ.
7. Visit `http://localhost/modern-car-rent-php/setup.php` once. This inserts securely hashed demo accounts and sample cars.
8. Delete `setup.php` after setup.
9. Open `http://localhost/modern-car-rent-php/`.

## Demo logins
- Admin: `admin@moderncar.com` / `Admin123!`
- Customer: `customer@example.com` / `User123!`

## Features
- Public car catalogue with search, type filtering, details, and USD daily prices.
- Registration and login with PHP sessions, password hashing, and role checks.
- Customer dashboard: bookings, reservation form, profile management.
- Admin dashboard: summary statistics, vehicle create/read/update/delete, and booking status management.
- Prepared SQL statements, CSRF tokens on forms, output escaping, and server-side validation.
- Booking date-overlap checks inside a database transaction to reduce double-booking races.

## Payment note
Zaad, Sahal, EVC Plus, Credit/Debit Card, and Pay on pickup are saved as the selected payment method only. No payment is processed. Real payment collection requires an approved provider integration and server-side verification.

## Production checklist
Use HTTPS, strong unique admin credentials, environment variables for database secrets, secure cookie settings, backups, rate limiting, audit logs, and a real payment gateway. Review deployment permissions and remove setup.php after initialization. Do not expose database credentials publicly.
