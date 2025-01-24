### Laravel API Project

Ini adalah proyek API Laravel yang menggunakan Laravel 11, PHP 8.3.4, dan MySQL v8. Dokumentasi ini berisi langkah-langkah untuk mengkloning, mengatur, dan menjalankan proyek. Proyek ini dapat dijalankan menggunakan Artisan atau Docker.

### Persyaratan
Pastikan Anda telah menginstal atau memiliki:
- PHP 8.3.4 atau lebih baru
- [Composer](https://getcomposer.org/)
- [MySQL](https://dev.mysql.com/)
- [Docker](https://www.docker.com/) (jika menggunakan Docker)

### Tata Cara Clone dan Menjalankan Proyek

## 1. Clone Repository:  
   Jalankan perintah berikut untuk mengkloning repository:  
   `git clone https://github.com/Siputtttt/proses-rq-be.git`

## 2. Install Dependensi
  #jika artisan
  `composer install`

  #jika Docker
  `docker exec -it backend composer install`

## 3. Duplicat file env
  `cp .env.example .env`
  atur konfigurasi env nya ini jika artisan 
  * DB_CONNECTION=mysql
  * DB_HOST=127.0.0.1
  * DB_PORT=3306
  * DB_DATABASE=nama_database
  * DB_USERNAME=root
  * DB_PASSWORD=your_password`

  atur jika docker
  * DB_CONNECTION=mysql
  * DB_HOST=db
  * DB_PORT=3306
  * DB_DATABASE=laravel
  * DB_USERNAME=root
  * DB_PASSWORD=root
## 4. Mggration database

    # jika artisan
    `php artisan migrate`
    
    jika docker
    # `docker-compose up -d`

## 5. ambil data dari api public

    # jika artisan
    `php artisan fetch:public-data`
    
    # jika docker
    `docker exec -it backend php artisan fetch:public-data`
    
