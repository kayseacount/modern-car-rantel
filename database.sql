CREATE DATABASE IF NOT EXISTS modern_car_rent CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE modern_car_rent;

CREATE TABLE IF NOT EXISTS users (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(120) NOT NULL,
  email VARCHAR(190) NOT NULL UNIQUE,
  phone VARCHAR(40) NOT NULL,
  password_hash VARCHAR(255) NOT NULL,
  role ENUM('admin','customer') NOT NULL DEFAULT 'customer',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS cars (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(120) NOT NULL,
  type ENUM('Sedan','SUV','Luxury','Van') NOT NULL,
  seats TINYINT UNSIGNED NOT NULL DEFAULT 5,
  price_per_day DECIMAL(10,2) NOT NULL,
  image_url VARCHAR(1000) NOT NULL,
  description TEXT NOT NULL,
  available TINYINT(1) NOT NULL DEFAULT 1,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS bookings (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  user_id INT UNSIGNED NOT NULL,
  car_id INT UNSIGNED NOT NULL,
  start_date DATE NOT NULL,
  end_date DATE NOT NULL,
  days SMALLINT UNSIGNED NOT NULL,
  total DECIMAL(10,2) NOT NULL,
  payment_method ENUM('Zaad','Sahal','EVC Plus','Credit / Debit Card','Pay on pickup') NOT NULL,
  status ENUM('Pending','Confirmed','Completed','Cancelled') NOT NULL DEFAULT 'Pending',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_booking_user FOREIGN KEY (user_id) REFERENCES users(id),
  CONSTRAINT fk_booking_car FOREIGN KEY (car_id) REFERENCES cars(id),
  INDEX idx_car_dates_status (car_id, start_date, end_date, status),
  INDEX idx_booking_user (user_id)
) ENGINE=InnoDB;

-- Demo accounts are created by setup.php so passwords are hashed with PHP password_hash().
