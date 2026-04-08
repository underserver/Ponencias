## Gestion de Ponencias

### Overview
Gestion de Ponencias is a PHP-based web application designed to manage conferences and presentations. This application provides a platform for managing users, submissions, evaluations, and reviews of research papers or ponencias. It supports multiple user roles such as administrators, presenters, co-authors, and evaluators.

### Setup Instructions

1. **Clone the Repository**
   ```bash
   git clone https://github.com/underserver/Ponencias.git
   cd Ponencias
   ```

2. **Configure the Database**
   - Create a MySQL database named `jshop`.
   - Import the initial schema and data using `ponencias.sql` file provided in the repository.

3. **Server Configuration**
   - Ensure that your server (Apache, Nginx, etc.) is configured to serve PHP files.
   - Modify the database connection settings in `includes/config.php` to match your database credentials.

4. **Install PHP Extensions**
   - Ensure required PHP extensions are installed (e.g., mysqli).

5. **Directory Permissions**
   - Set write permissions for directories that need to store uploaded files or cache data.

### Usage Guidelines 
- **Login**
  - Navigate to `/login.php` to access the user login page. Users can log in based on their user roles which define their permissions.

- **Register**
  - Different types of users can register through the `/register.php` by selecting their role type like Presenter, Co-author, etc.

- **Admin Panel**
  - Administrators can manage users, ponencias, and sessions from the `adminpanel.php`.

- **Submit Ponencia**
  - Presenters can submit their work through `admin_ponencias.php`.

### Key Directories & Files
- `index.php`: Entry point for the application which includes the login form.
- `includes/`: Contains configuration files, header, and database connection scripts.
  - `config.php`: Holds database configuration settings.
  - `db.php`: Initializes the database connection using ezSQL library.
- `dao/`: Data Access Objects for interacting with the database.
  - `PonenciaDao.php`, `UsuarioDao.php`: CRUD operations for Ponencias and Usuarios.
- `model/`: Contains PHP classes representing main entities like `Ponencia` and `Usuario`.
- `services/`: Business logic and management services like `PonenciaManager.php` and `UsuarioManager.php`.
- `install/`: Contains installation scripts and resources.
- `styles/`: CSS styling for the application.
- `jscripts/`: JavaScript files for enhancing client-side functionality.

### License
This project is licensed under the MIT License - see the LICENSE file for details.

