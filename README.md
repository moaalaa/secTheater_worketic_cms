# Worketic

## Prerequisites
> This Project Required Composer To Be Installed And PHP 7.1 Or Above
- PHP 7.1 Or Above 
- [Composer](https://getcomposer.org/)

## Installation

### Clone The Project

```bash
git clone https://github.com/moaalaa/secTheater_worketic_cms
cd secTheater_worketic_cms
```

### Clone The Project on server

```bash
git clone https://github.com/moaalaa/secTheater_worketic_cms .
```

### Install Composer Dependencies 

```bash
composer install
```

### Create .env Then Edit It

```bash
cp .env.example .env
```

### Generate Laravel Key For encryption

```bash
php artisan key:generate
```

### Go to `.env` file and fill `DB_*` Keys Then

### Migrate The DB 

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=worketic
DB_USERNAME=root
DB_PASSWORD=
```

### Migrate The DB 

```bash
php artisan migrate
```

### Migrate The DB With Seed

```bash
php artisan migrate --seed
```

### Run The Server 

```bash
php artisan serve
```

### Login Credentials
`Admin`
- Email: admin@email.com
- Password: google
---
`Employer`
- Email: employer@email.com
- Password: google
---
`Freelancer`
- Email: freelancer@email.com
- Password: google
