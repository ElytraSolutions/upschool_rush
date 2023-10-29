## Steps for setup
1. [Install Xampp](https://sourceforge.net/projects/xampp/files/latest/download)
2. [Install php composer](https://getcomposer.org/Composer-Setup.exe)
3. [Clone this repo](https://github.com/ElytraSolutions/upschool_rush.git)
4. Open terminal in Vscode in upschool_rush directory
    - 4.1 git submodule init
    - 4.2 git submodule update
5. Modify php.ini file in your local system (most likely in c:/xampp/php), uncomment line ';extension=zip'
6. Type 'composer update' in terminal
7. Start Apache and MySQL in Xampp
8. Modify .env in the upschool_rush
9. Click admin in for MySQL in Xampp
10. Create a New database named 'laravel'
11. In terminal:
    - 11.1 php artisan migrate
    - 11.2 php artisan db:seed
    - 11.3 php artisan serve
    Now, the backend should successfully be ready. To view static frontend, follow the link, and click generate app key
12. Install node.js (major version 18 LTS)
13. Navigate to 'upschool_frontend', then in terminal
    - 13.1 npm install
    - 13.2 npm run dev