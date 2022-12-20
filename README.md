# Welcome to MovieShare!!!

## About MovieShare

This project was made by Joel Johnson, Parth Mehta, Matthew Phan, and Sarvesh Chandrakumar for Mr. Millard's AP CSP class. This project was built using PHP, HTML, CSS, JavaScript, and MySQL.

MovieShare allows people to view the most popular movies outside right now, along with some information about those movies. Users who have watched those movies can leave reviews of those movies for other people to see. Users can also search for movies using the search feature.

## System Requirements

-   Windows 10 (or above) or MacOS 12.5.1 (or above)
-   PHP 8.0.26 (or above)
    -   To install PHP on MacOS follow [this link](https://www.geeksforgeeks.org/how-to-install-php-on-macos/)
    -   To install PHP on Windows follow [this link](https://www.php.net/manual/en/install.windows.php)
-   Composer for PHP 2.4.4 (or above)
    -   To install the Composer follow [this link](https://getcomposer.org/download/)
-   MySQL 8.0.31 (or above)

## Installation

1. Verify that you have met the system requirements.
2. Navigate to the project directory, and run `composer install`
3. Create a `.env` file in the root directory of the project and include the following information
    1. `SQL_USER_NAME=[NAME]` --> [NAME] should be replaced with the name of your MySQL user
    2. `SQL_USER_PASSWORD=[PASSWORD]` --> [PASSWORD] should be replaced with the name of your MySQL user
    3. `THE_MOVIEDB_KEY=f8f3426a4161d6634092fb817fab8fb9`
4. Once everything is installed, run a php server in the terminal using `php -S localhost:8080`
5. Then, in the webbrowser, navigate to `localhost:8080/initdb.php` to initialize the database, etc.
6. After the success message for the `/initdb` is displayed, the website should be 100% functional
