## Login System Documentation

### Setup
1. Clone the repository from GitHub.
2. Ensure that you have a local web server setup with PHP and MySQL.
3. Import the provided SQL database file (`database.sql`) into your MySQL database.
4. Configure the database connection in `includes/config.php` with your database credentials.

### Usage
1. Open the application in your web browser.
2. Navigate to the login page (`login.php`).
3. Enter your username and password to log in.

### User Roles
- **Admin**: Has access to the admin panel and additional admin functionalities.
- **Evaluator**: Can evaluate submissions on the platform.

### Security
- Passwords are hashed using MD5 for security.
- Sessions are used to maintain user login states.

### Additional Information
- Use `action_login.php` for validating and logging users in.
- Customize user roles and permissions in the database as required.