## REST server

**Deployment plan:**

1. Run `git clone git@github.com:zrayev/laravel_rest_server.git .` in empty folder.
2. Run `composer install ` to install dependencies.
3. Run `npm install` to install node modules.
4. Create new mySql databases:
   - for local env - rest,
   - for testing env - rest_test.
5. Generate app key for local env: `php artisan key:generate` . Configure .env and .env.testing files.
6. Run `php artisan serve` or create apache2/nginx host for launch project.
7. Run `composer test` to run unit tests.
8. Run `php artisan migrate ` and `php artisan db:seed` for create schema and seeds data in local db.
6. Done.

**Instruction for REST server:**

- You would use Postman or curl for testing this API (I prefer Postman).
- You would show API routes in the path `/routes/api.php`.
- If you use Postman don't forget you would send the data as `x-www-form-urlencoded` for PUT and PATCH request.

**Examples url:**

- POST	`/register`	Register new User.
- POST	`/login`	User Login.
- POST	`/logout`	Logout User.
-
- GET	`/users`	Retrieves the collection of User resources.
- GET	`/users/1`	Retrieves a User resource.
- DELETE	`/users/1`	Removes the User resource.
-
- GET	`/posts`	Retrieves the collection of Post resources.
- GET	`/posts/1`	Retrieves a Post resource.
- POST	`/posts`	Creates a Post resource.
- PUT	`/posts/1`	Replaces the Post resource.
- PATCH	`/posts/1`	Replaces the Post resource.
- DELETE	`/posts/1`	Removes the Post resource.
-
- GET	`/users/1/posts`	Retrieves the collection of Post resources for User id=1.
- DELETE	`/users/1/posts`	Removes all Posts resource for User id=1.
- POST	`/users/1/posts`	Creates a Post resource for User id=1.
