# Installation Guide - Student Demo Registration System

## Prerequisites

Before installing the system, ensure you have:

- **PHP 7.4 or higher** with the following extensions:
  - PDO
  - PDO MySQL
  - JSON
- **MySQL 5.7 or higher** (or MariaDB 10.2+)
- **Web server** (Apache/Nginx)
- **Composer** (optional, for dependency management)

## Installation Steps

### 1. Download and Extract

1. Download the project files to your web server directory
2. Extract the files to your desired location (e.g., `/var/www/html/student-registration/`)

### 2. Database Setup

1. **Create MySQL Database:**
   ```sql
   CREATE DATABASE student_demo_registration;
   ```

2. **Import Database Schema:**
   ```bash
   mysql -u your_username -p student_demo_registration < database/schema.sql
   ```

3. **Optional: Import Test Data:**
   ```bash
   mysql -u your_username -p student_demo_registration < test_data.sql
   ```

### 3. Configure Database Connection

1. Edit `config/database.php`
2. Update the database credentials:
   ```php
   define('DB_HOST', 'localhost');
   define('DB_NAME', 'student_demo_registration');
   define('DB_USER', 'your_username');
   define('DB_PASS', 'your_password');
   ```

### 4. Set File Permissions

Ensure your web server has proper permissions:
```bash
chmod 755 -R /path/to/your/project
chmod 644 config/database.php
```

### 5. Test the Installation

1. **Run the setup script:**
   Visit `http://your-domain.com/setup.php` in your browser
   This will check system requirements and database connectivity

2. **Access the application:**
   - Main registration page: `http://your-domain.com/index.php`
   - Admin panel: `http://your-domain.com/admin.php`

## Configuration Options

### Time Slots

The system comes with 6 predefined time slots. To modify them:

1. Edit the time slots in `database/schema.sql`
2. Re-import the schema or manually update the `time_slots` table

### Validation Rules

The system enforces the following validation rules:

- **Student ID:** Exactly 8 digits
- **Names:** Alpha characters only, cannot be empty
- **Email:** Standard format with domain validation (max 80 chars total domain)
- **Phone:** Format: 999-999-9999
- **Project Title:** Cannot be empty

### Security Features

- Input sanitization and validation
- SQL injection prevention using prepared statements
- XSS protection
- CSRF protection (basic)
- File access restrictions via .htaccess

## Troubleshooting

### Common Issues

1. **Database Connection Failed**
   - Check database credentials in `config/database.php`
   - Ensure MySQL service is running
   - Verify database exists

2. **"Page Not Found" Errors**
   - Ensure mod_rewrite is enabled (Apache)
   - Check .htaccess file is present
   - Verify file permissions

3. **Validation Errors Not Showing**
   - Check JavaScript console for errors
   - Ensure `js/validation.js` is loading
   - Verify CSS files are accessible

4. **Time Slots Not Updating**
   - Check `get_availability.php` is accessible
   - Verify database queries are working
   - Check browser console for AJAX errors

### Debug Mode

To enable debug mode, add this to the top of any PHP file:
```php
error_reporting(E_ALL);
ini_set('display_errors', 1);
```

## File Structure

```
student-demo-registration/
├── index.php              # Main registration page
├── admin.php              # Admin view of registrations
├── setup.php              # Installation checker
├── get_availability.php   # AJAX endpoint for availability
├── test_data.sql          # Sample data for testing
├── .htaccess              # Apache configuration
├── README.md              # Project overview
├── INSTALLATION.md        # This file
├── config/
│   └── database.php       # Database configuration
├── includes/
│   ├── functions.php      # Helper functions
│   ├── header.php         # Common header
│   └── footer.php         # Common footer
├── css/
│   └── style.css          # Styling
├── js/
│   └── validation.js      # Client-side validation
└── database/
    └── schema.sql         # Database schema
```

## Testing the System

1. **Test Registration:**
   - Visit the main page
   - Fill out the registration form
   - Verify validation works
   - Check database for new entry

2. **Test Admin Panel:**
   - Visit `/admin.php`
   - Verify all registrations are displayed
   - Check time slot availability

3. **Test Duplicate Registration:**
   - Try registering with the same Student ID
   - Verify the update functionality works

4. **Test Validation:**
   - Try invalid inputs (wrong email format, phone format, etc.)
   - Verify error messages appear
   - Check that valid inputs are preserved

## Production Deployment

For production deployment:

1. **Security:**
   - Remove or protect `setup.php`
   - Use HTTPS
   - Set proper file permissions
   - Configure firewall rules

2. **Performance:**
   - Enable PHP OPcache
   - Configure MySQL query cache
   - Use CDN for static assets

3. **Monitoring:**
   - Set up error logging
   - Monitor database performance
   - Track registration analytics

## Support

If you encounter issues:

1. Check the setup script output
2. Review error logs
3. Verify all files are present
4. Test database connectivity manually

## License

This project is created for educational purposes. Feel free to modify and use as needed. 