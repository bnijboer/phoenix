## "The Goddess In Me" (Working title: "Phoenix") [WIP]

### Description

This is a blog I am currently creating for my mother.

I aim to make this a Inertia-powered SPA. The reason for this is because I want to get more experience using Vue, and I found Inertia.js to be a powerful link between Laravel and Vue.

**Notes**:
- This project is far from complete (especially in terms of styling), but I decided to set it to public to showcase my current understanding of Laravel and Vue.
- I disabled the ability for users to register an account for now, as I am still considering whether I want other users apart from me (the admin) and my mother (the only editor) to own an account. I may enable registration in the future though.

### Instructions

- `git clone` repo
- `npm install`
- `composer install`
- `composer update`
- Rename `.env.example` to `.env`
- `php artisan key:generate`
- Create database `phoenix`
- Add database credentials to `.env`
- Add `MAIN_USER_PASSWORD=test` to `.env`
- `php artisan migrate:fresh --seed`
- `npm run dev`
- `php artisan serve`

#### Login using one of the following accounts:

`admin@phoenix.test`

`editor@phoenix.test`

`dummy@phoenix.test`

Password: `test`

**Note**: Use the admin account for full access.
