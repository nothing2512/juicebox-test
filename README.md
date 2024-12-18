## Setup Instructions
1. Clone projects
2. copy file .env.example to .env
3. Replace database, mailer and weatherapi.com key with your own configuration
4. Run : 
```sh
php artisan serve
```

## Run mailer queue manually
```sh
php artisan send:mail <your-name> <your-email>
```