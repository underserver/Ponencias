# Ponencias

Ponencias is a PHP-based web application designed to manage conferences and presentations. It supports user roles like administrators, presenters, and evaluators, each with specific functionalities such as registering presentations, managing users, and evaluating submissions.

## Features
- User authentication and role management
- Presentation submission and management
- Evaluation and feedback system
- Administrative tools for managing users and content

## Technologies Used
- PHP
- MySQL
- jQuery
- HTML/CSS

## Installation

### Prerequisites
- Web Server with PHP support
- MySQL Database

### Setup Instructions
1. Clone the repository:
   ```
   git clone https://github.com/underserver/Ponencias.git
   ```
2. Navigate to the project directory:
   ```
   cd Ponencias
   ```
3. Import the database schema located in the 'database' directory into your MySQL server.
4. Update the `includes/config.php` file with your database credentials and configuration settings.
5. Make sure the `ponencias` folder has write permissions for file uploads.
6. Open the application in your browser to complete the installation steps via the web interface at `{your-server}/install`.

## Usage
After installation, access the application by navigating to the base URL of the installed server. Use the login screen to sign in or register as a new user. Administrators have access to the admin panel where they can manage users, presentations, and evaluations.

## Contributing
Contributions are welcome! Please fork the repository and submit a pull request for review.

## License
This project is licensed under the MIT License. See the LICENSE file for details.

