# Advanced Blog Application with Sanctum API and Policies using Laravel 10

This is a multiple-role-based Advanced Blog Application with API authentication using Laravel. A normal user can CRUD his own posts and also see all the posts, an admin can CRUD all the user's posts and his own posts, and a Super Admin can CRUD all posts. Everyone can view the details of a single blog post. It includes user authentication, roles, and an API for managing blog posts and users.

## Deployment
Make sure the active directory is on the root project. Execute the following commands:
- `git pull origin main`
- Done

## If you are using Laravel 10+ then install Mix with this instruction

- `composer create-project laravel/laravel advanced_blog_final`
- `cd advanced_blog_final/`
- Run `composer require laravel/ui`
- Run `php artisan ui bootstrap --auth`
- Run `rm vite.config.js`
- Run `npm install --save-dev laravel-mix`
- Create a __.webpack.mix.cjs__ and copy past-
  ```bash
    const mix = require('laravel-mix');

    mix.js('resources/js/app.js', 'public/js')
    mix.postCss('resources/css/app.css', 'public/css', [
        //
    ]);
  ```
- Update __.package.json:__
   ```bash
    "type": "module",
    "scripts": {
        "dev": "npm run development",
        "development": "mix",
        "watch": "mix watch",
        "watch-poll": "mix watch -- --watch-options-poll=1000",
        "hot": "mix watch --hot",
        "prod": "npm run production",
        "production": "mix --production"
    },
    ```
- In __.env__ file remove vite and add this:
```bash
    MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
    MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
```
- From resources/js/app.js
```bash
    Replace import __'./bootstrap';__ with import __.'bootstrap';__
```
- Run `npm install laravel-mix-versionhash --save-dev`
- Run `npm run dev`
- Remove from __app.blade.php__
-     __.@vite(['resources/sass/app.scss', 'resources/js/app.js'])__
- Add these two into this file into __.app.blade.php__
  ```bash
    `<script src="{{ mix('js/app.js') }}" defer></script>`
    `<link href="{{ mix('css/app.css') }}" rel="stylesheet">`
  ```

## How to use

- Clone the repository with `git clone https://github.com/algaddafy/Advanced-Blog-Application.git`
- Run `cd advanced_blog_final`
- Run `composer install`
- Run `cp .env.example .env`
- Copy __.env.example__ file to __.env__ and edit database credentials there
- Run `php artisan key:generate`
- Run `php artisan migrate`
- Run `php artisan db:seed` Just for one time and then make comments full blocks of `run()` methods.
- Run `php artisan serve` to run the application

## API Route

- Register http://127.0.0.1:8000/api/register using the POST method. In Body tab, choose __form-data__, input __name__, __email__, __password__ and __password_confirmation__ or you can choose __raw__ and __JSON__

- Login: http://127.0.0.1:8000/api/login using POST method. In Body tab, choose __form-data__, input __email__ and __password__ or you can choose __raw__ and __JSON__. Copy the token for the next API route.

- Get self-identity: http://127.0.0.1:8000/api/logged_user using GET method. In Body tab, choose __form-data__, input __email__ and __password__. In Authorization tab, choose Bearer Token type, paste the Token.

- Logout: http://127.0.0.1:8000/api/logout using POST method. In Body tab, choose __form-data__, input __old_password__, __password__ and __password_confirmation__. In Authorization tab, choose Bearer Token type, paste the Token.

- Change Password: http://127.0.0.1:8000/api/change_password using POST method. In Body tab, choose __form-data__, input __email__ and __password__. In Authorization tab, choose Bearer Token type, paste the Token.

- Reset Password: http://127.0.0.1:8000/api/resetpassword using POST method. In Body tab, choose __form-data__, input __email__. In Authorization tab, choose Bearer Token type, paste the Token.

- Retrieve All Users: http://127.0.0.1:8000/api/users
    - Method: GET
    - Authorization: Bearer Token (Paste Token in Authorization tab)

- CRUD Posts: http://127.0.0.1:8000/api/posts
    - Method: GET
    - Authorization: Bearer Token (Paste Token in Authorization tab)

- Retrieve a Specific Post: http://127.0.0.1:8000/api/posts/{post}
    - Method: GET
    - Authorization: Bearer Token (Paste Token in Authorization tab)

- Create a Post: http://127.0.0.1:8000/api/posts/create
    - Method: POST
    - Body: Choose form-data and input title, description
    - Authorization: Bearer Token (Paste Token in Authorization tab)

- Update a Post: http://127.0.0.1:8000/api/posts/{post}
    - Method: PUT
    - Body: Choose form-data and input the title, and description in Params tab
    - Authorization: Bearer Token (Paste Token in Authorization tab)

- Update a Post: http://127.0.0.1:8000/api/posts/{post}
    - Method: DELETE
    - Authorization: Bearer Token (Paste Token in Authorization tab)
    - 
## Feedback and Support
Your time is valuable, and I appreciate your interest in this Blog Application. Your feedback is crucial to me. If you have suggestions for improvements or encounter bugs feel free to ask me.

Continuous improvement is my __commitment.__

Once again, thank you for your time. Feel free to **[Contact me](https://www.linkedin.com/in/algaddafy/)**; for more information. 
