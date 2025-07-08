# PHPNuxBill Laravel Installation Guide

## Requirements
- PHP 8.2 or higher
- MySQL 5.7 or higher
- Composer
- Web server (Apache/Nginx)

## Installation Steps

1. **Extract the files**
   ```bash
   unzip phpnuxbill-laravel.zip
   cd phpnuxbill-laravel
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Configure environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configure database**
   Edit `.env` file with your database credentials:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

5. **Run migrations**
   ```bash
   php artisan migrate
   ```

6. **Create admin user**
   ```bash
   php artisan tinker
   ```
   Then run:
   ```php
   \App\Models\User::create([
       'name' => 'Administrator',
       'email' => 'admin@example.com',
       'password' => bcrypt('admin123')
   ]);
   ```

7. **Set permissions**
   ```bash
   chmod -R 755 storage bootstrap/cache
   ```

8. **Start the application**
   ```bash
   php artisan serve
   ```

## Features Converted

- ✅ Customer Management
- ✅ Plan Management  
- ✅ Router Management
- ✅ Transaction System
- ✅ Voucher System
- ✅ Payment Gateway Integration
- ✅ User Authentication
- ✅ Admin Dashboard
- ✅ Customer Portal
- ✅ Reporting System
- ✅ Settings Management

## Default Login

- URL: http://your-domain/login
- Admin: admin@example.com / admin123
- Customer: Register new account or create via admin panel

## Support

This is a converted version of PHPNuxBill to Laravel 12 framework.
All original features have been preserved and modernized.
