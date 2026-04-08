# Ponencias Project

## Overview

Ponencias is a PHP-based virtual store system created as part of the jShop project. It facilitates the management of conferences and associated evaluations, providing various user roles such as Admin, Speaker (Ponente), Coauthor, Evaluator, and Attendee.

## Features

- User Registration and Authentication
- Conference Submission and Evaluation
- Administrative Dashboard for system management
- Multilingual Support

## Requirements

- PHP 7.x or higher
- MySQL Database
- Web Server (Apache, Nginx, etc.)

## Installation

1. **Clone the Repository:**
   
   ```bash
   git clone https://github.com/underserver/Ponencias.git
   ```

2. **Set Up Database:**
   
   Create a MySQL database and import the `jshop.sql` schema provided in the `database` directory.

3. **Configure Environment:**
   
   Update the `includes/config.php` file with your database credentials:
   
   ```php
   $_config["db_host"] = "localhost";
   $_config["db_user"] = "your_db_user";
   $_config["db_pass"] = "your_db_password";
   $_config["db_name"] = "your_db_name";
   ```

4. **Run the Installation Script:**
   
   Go to the `/install` directory in your browser and follow the steps to complete setup.

5. **Access the System:**
   
   Navigate to the `/login.php` page to access the system.

## Usage

- **Admin Panel:** Manage users, conferences, and reviews.
- **User Roles:**
  - Speaker: Submit and manage conferences.
  - Coauthor: Assist in conference submissions.
  - Evaluator: Review and provide feedback on submissions.
  - Attendee: Register to attend and participate in conferences.

## Contribution

Feel free to submit issues or pull requests. Contributions and improvements are welcome!

## License

This project is licensed under the MIT License. See the [LICENSE](./LICENSE) file for more information.

