<h1 align="center">Banking App With Cryptocurrency Investments</h1>

<p align="center">
Built as a final project for CODELEX course. The app includes features such as: authorization, different account type creation, making transfers (with currency conversions using ECB rates API), creation of transaction for each transfer and also cryptocurrency investment feature (using CoinMarketCap API or CoinPaprika free API as a failsafe).
User can create investment or private accounts, transfer funds to different accounts, create an investment account to buy crypto, check his investment holdings and transactions
</p>

<img src="/readme/dashboard.PNG"/>
<img src="/readme/cryptocurrencies.PNG"/>
<img src="/readme/transactions.PNG"/>

<h2 align="center">Requirements</h2>
<p>PHP >= 8.2</p>
<p>Composer</p>
<p>Node.js >= v14</p>
<p>npm >= 8.0.0</p>

<h2 align="center">Installation Steps</h2>

- `git clone https://github.com/Jurski/bank.git` Clone Repository
- Enviroment Setup: rename .env.example to .env (SQLite DB used for the project)
- `composer install` Install PHP Dependencies
- `npm install` Install Frontend Dependencies
- `php artisan key:generate` Generate Application Key
- `php artisan migrate` Launch migration to create schemas
- `npm run build` Build Frontend
- `php artisan serve` Serve the Application
- Open localhost page with port number that is specified in the terminal.

<h2 align="center">Commands</h2>
<h3>Required:</h3>

- `php artisan app:fetch-cryptocurrencies` Gets cryptocurrency data from an API<br>
- `php artisan app:fetch-exchange-rate` Gets exchange rates for EUR pairs from ECB API

<h3>Optional:</h3>

- `php artisan db:seed --class=UserSeeder` Creates a user for testing purposes<br>

<p>Login: johndoe@gmail.com</p>
<p>Password: password</p>
