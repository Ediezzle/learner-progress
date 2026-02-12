# Learner Progress Dashboard - Coding Challenge

## Getting Started

1. Run `composer install`
2. Configure your `.env` file from the example
3. Generate the App Key: `php artisan key:generate`
4. Run migrations and seeders: `php artisan migrate --seed`
5. Start the development server: `php artisan serve`
6. Install Node dependencies: `npm install`
7. In a separate terminal, run the Vite dev server: `npm run dev`
**Note:** Both the PHP server (step 5) and Vite dev server (step 7) need to run simultaneously in separate terminal windows.

## Test Cases
1. Create a file named .env.testing in the root of the project
2. Configure your test environment. You can take a look at phpunit.xml
3. You can generate APP_KEY by running `php artisan key:generate --env=testing`
4. Run test suite: `php artisan test --env=testing`

