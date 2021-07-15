## "The Goddess In Me" (Working title: "Phoenix") [WIP]

### Description

This is a blog I am currently creating for my mother.

I aim to make this a Inertia-powered SPA, as I want to get more experience using Vue and I found Inertia.js to be a powerful link between Laravel and Vue.

**Notes**:
- I have been working on some features such as email subscriptions and user banning that might see the light of day in the future, but aren't functional for now.

### Instructions

- `git clone https://github.com/bnijboer/phoenix.git`
- `npm install`
- `composer install && composer update`
- Rename `.env.example` to `.env`
- `php artisan key:generate`
- Create database `phoenix`
- Add database credentials to `.env`
- `php artisan migrate:fresh --seed`
- `npm run dev`
- `php artisan serve`

#### Login using one of the following accounts:

`admin@phoenix.test`

`editor@phoenix.test`

`dummy@phoenix.test`

Password: `test`

**Note**: Use the admin account for full authorized access.
