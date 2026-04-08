# Ponencias Repository

## Project Overview
Ponencias is a PHP-based virtual shop application designed to manage conferences, presentations, and users effectively. The application allows for the registration, management, and evaluation of presentations, as well as user authentication and authorization.

## Features
- User Registration: Users can register as different roles such as Conferencista, Coautor, Asistente, and Evaluador.
- User Authentication: Secure login and password handling with session management.
- Presentation Management: Create, edit, delete, and list presentations.
- Evaluation System: Assign evaluators to presentations and manage evaluations.
- Administrator options for managing users and presentations.

## Technology Stack
- PHP
- MySQL (Database)
- HTML/CSS for frontend
- JavaScript for client-side logic

## Getting Started
### Prerequisites
- PHP 7.x or higher
- MySQL 5.7 or higher
- A web server like Apache or Nginx

### Installation
1. Clone the repository:
   ```bash
   git clone https://github.com/underserver/Ponencias.git
   ```
2. Navigate to the project directory:
   ```bash
   cd Ponencias
   ```
3. Configure your database settings in `includes/config.php` with your MySQL credentials.
4. Set up the database using the provided SQL schema (make sure to import it into your MySQL server).
5. Start your web server and ensure it's pointing to the Ponencias directory.
6. Access the application via your web browser.

## Usage
1. Access the login page to sign in or register a new account.
2. Use different roles for different access levels:
   - Administrator: Full access to manage users and presentations.
   - Conferencista: Submit and manage own presentations.
   - Evaluador: Evaluate assigned presentations.
3. Administrators can manage the system through the admin panel, including changing access for users.

## Contribution
Feel free to open a pull request if you want to contribute. Please maintain the coding style and add tests for new features.

## License
This project is licensed under the MIT License.

## Contact
For any inquiries, please contact Sergio Ceron Figueroa at sxceron@laciudadx.com.
