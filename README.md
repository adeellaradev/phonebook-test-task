# Run the following commands after cloning the project
 
- run composer install
- run npm install
- run php artisan storage:link
- copy .env.example file and rename it to .env
- create the database with name `phone_book`
- run php artisan migrate
- run php artisan key:generate


# After that run the servers as follows
- npm run dev
- php artisan serve

# Phone number format
- With country code: +1 (123) 456-7890
- Without country code: (123) 456-7890

# Other valid formats
- 123-456-7890
- 123.456.7890
- 123 456 7890
