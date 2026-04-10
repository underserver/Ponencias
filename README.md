# Ponencias

Ponencias is a PHP-based virtual shop system geared towards managing conferences and presentations. It is part of the jShop version 1.0 developed by Sergio Ceron Figueroa.

## Features

- **Product Management:** Display and manage products with features to handle expiration and stock count.
- **User Authentication:** Login system with sessions for different user roles, including administrators, presenters, co-authors, evaluators, and attendees.
- **Presentation Evaluation:** Manage and evaluate conference presentations, assign evaluators, and handle feedback.

## Installation

1. Clone the repository from GitHub:
   ```bash
   git clone https://github.com/underserver/Ponencias.git
   ```
2. Upload the files to your web server.
3. Ensure that the server has PHP and MySQL installed and running.
4. Create a MySQL database named `jshop`. Import the SQL files to set up the tables.
5. Modify the `includes/config.php` with your database credentials:
   ```php
   $_config["db_host"] = "your_database_host";
   $_config["db_user"] = "your_database_user";
   $_config["db_pass"] = "your_database_password";
   $_config["db_name"] = "jshop";
   ````
6. Access the web application through your browser.

## Usage

- Navigate through different sections such as product listings, user registrations, and evaluation panels.
- Administrators can log in to perform administrative tasks, including managing users and presentations.
- Presenters can register and submit their presentations for evaluation.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Contributing

Please feel free to submit issues or fork the project to contribute changes.
