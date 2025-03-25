# Laravel 11 Project

## 🚀 Giới thiệu

Đây là dự án Laravel 11 được cấu hình sẵn với **Tailwind CSS**, **Be Vietnam Pro Font**, và một số tính năng quan trọng khác.

## 📌 Yêu cầu hệ thống

-   **PHP** >= 8.1
-   **Composer** >= 2.0
-   **Node.js** >= 18.x & **npm** >= 9.x
-   **MySQL** hoặc **MariaDB**
-   **Git**

## 📥 Cài đặt

### 1️⃣ Clone project

```bash
git clone https://github.com/MThuyet/HTHshop.git
cd HTHshop
```

### 2️⃣ Cài đặt dependencies

```bash
composer install
npm install
```

### 3️⃣ Tạo file cấu hình

```bash
cp .env.example .env
```

### 4️⃣ Tạo key ứng dụng

```bash
php artisan key:generate
```

### 6️⃣ Biên dịch assets (Tailwind, JS...)

```bash
npm run dev  # Hoặc dùng 'npm run build' cho production
```

### 7️⃣ Khởi động server

```bash
php artisan serve
```

## 🎨 Cấu trúc dự án

```plaintext
├── app/                  # Code backend chính
├── bootstrap/            # File khởi động Laravel
├── config/               # Cấu hình hệ thống
├── database/             # Migrations và Seeders
├── public/               # Static files (CSS, JS, Images...)
├── resources/            # Views (Blade), CSS, JS
│   ├── css/              # Tailwind CSS
│   ├── js/               # JavaScript
│   ├── views/            # Blade templates
├── routes/               # Định nghĩa routes
├── storage/              # Logs, cache, uploads
├── tests/                # Unit tests
├── .env.example          # File mẫu cấu hình môi trường
├── artisan               # CLI Laravel
├── package.json          # Cấu hình npm
├── tailwind.config.js    # Cấu hình Tailwind CSS
└── webpack.mix.js        # Laravel Mix config
```

## ✨ Các công nghệ sử dụng

-   **Laravel 11** - Framework PHP mạnh mẽ
-   **Tailwind CSS** - Framework CSS tối giản
-   **Be Vietnam Pro** - Font mặc định
-   **MySQL** - Cơ sở dữ liệu
-   **PHPMailer** - Gửi email

## 📌 Các lệnh hữu ích

```bash
php artisan migrate:refresh --seed  # Reset database
npm run dev                         # Build CSS & JS
php artisan make:model ModelName -m # Tạo model + migration
php artisan cache:clear             # Xóa cache
```

## 🛠 Troubleshooting

Nếu gặp lỗi trong quá trình cài đặt, thử các bước sau:

1. Kiểm tra phiên bản PHP & Node.js
2. Chạy `composer update` và `npm update`
3. Xóa cache: `php artisan config:clear && php artisan cache:clear`
4. Kiểm tra logs trong `storage/logs/`

## 📬 Liên hệ

Nếu có vấn đề hoặc cần hỗ trợ, vui lòng tạo issue trên GitHub hoặc liên hệ qua email.
