# Customer Management - CRUD  (Laravel-Vue SPA + Nuxt)



> Customer List Screenshot

<p align="center">
<img src="https://i.imgur.com/iLFXGMn.png">
</p>

## Features

- Customers List
- Customer Create
- Customer Edit
- Customer Delete
- Authentication with JWT


## Laravel Installation

- `cd laravel-backend`
- `composer update`
- Edit `.env` and set your database connection details

- (When installed via git clone or download, run `php artisan key:generate` and `php artisan jwt:secret`)
- `php artisan migrate`
- Then open `InsertUserSeeder` seeder and add your admin username and password.
- Then run the seeder `php artisan db:seed --class="InsertUserSeeder" `

## Nuxt Installation

- `cd nuxt-frontend`
- Create `.env` file and add following lines
```bash
API_URL=http://api.test.dev
SITE_NAME=YourSite
```
- Then run following commands as you wish.
```bash
# install dependencies
$ npm install

# serve with hot reload at localhost:3000
$ npm run dev

# build for production and launch server
$ npm run build
$ npm run start

# generate static project
$ npm run generate
```


