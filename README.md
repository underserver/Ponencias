# Ponencias Project

## Project Description
Ponencias is a web-based platform designed to manage conferences and presentations efficiently. Developed in PHP, this application supports users, sessions, and role-based content management, facilitating seamless operation for conference organizers and attendees.

## Features
- User registration and authentication
- Role-based access control for administrators, presenters, co-authors, evaluators, and attendees
- Presentation submission and management
- Evaluation and approval workflow for presentations
- User account management
- Presentation scheduling and tracking

## Setup Instructions
### Prerequisites
- PHP 7.4 or higher
- MySQL 5.7 or higher
- Web server (e.g., Apache)

### Installation
1. Clone the repository:
   ```bash
   git clone https://github.com/underserver/Ponencias.git
   ```
2. Navigate to the project directory:
   ```bash
   cd Ponencias
   ```
3. Set up the database:
   - Create a MySQL database named `jshop`.
   - Import the SQL schema from `database/schema.sql`:
     ```bash
     mysql -u [username] -p jshop < database/schema.sql
     ```
4. Configure the database connection:
   - Open `includes/config.php`.
   - Update the `db_host`, `db_user`, `db_pass`, and `db_name` variables to match your database configuration.

5. Start the web server and navigate to the project URL in your web browser.

## Usage
- Access the web application through the URL configured on your web server.
- Register a new user or log in with an existing account.
- Navigate through different sections like presentations, evaluations, and user management using the top menu.

## Contributing
Contributions are welcome! Please read [CONTRIBUTING.md](./CONTRIBUTING.md) for details on our code of conduct, and the process for submitting pull requests.

## License
This project is licensed under the MIT License - see the [LICENSE](./LICENSE) file for details.

## Contact
For any inquiries, please contact the project maintainer: Sergio Ceron Figueroa (sxceron@laciudadx.com)

## Acknowledgments
- [Bootstrap](https://getbootstrap.com/) - Frontend framework
- [ezSQL](http://www.ezsql.com/) - Database abstraction layer
