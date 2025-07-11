# 🎓 Student Demo Registration System

A modern, responsive web application for managing student project demonstration registrations. Built with PHP, MySQL, and modern web technologies.

![PHP](https://img.shields.io/badge/PHP-8.1+-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.0+-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![Vercel](https://img.shields.io/badge/Vercel-000000?style=for-the-badge&logo=vercel&logoColor=white)

## ✨ Features

- **📝 Student Registration** - Easy-to-use form with real-time validation
- **🎯 Time Slot Management** - 6 time slots with up to 6 students each
- **🔄 Duplicate Handling** - Updates existing registrations automatically
- **📊 Admin Dashboard** - View all registrations and statistics
- **📱 Responsive Design** - Works perfectly on all devices
- **🔒 Security** - Input validation, SQL injection prevention, XSS protection
- **⚡ Real-time Updates** - Live availability tracking

## 🚀 Quick Start

### Option 1: Deploy to Vercel (Recommended)

1. **Fork this repository**
2. **Set up a database** (PlanetScale recommended)
3. **Deploy to Vercel**:
   - Connect your GitHub repo to Vercel
   - Add environment variables for database
   - Deploy automatically

See [VERCEL_DEPLOYMENT.md](VERCEL_DEPLOYMENT.md) for detailed instructions.

### Option 2: Local Development

1. **Clone the repository**:
   ```bash
   git clone https://github.com/yourusername/student-demo-registration.git
   cd student-demo-registration
   ```

2. **Set up database**:
   ```sql
   CREATE DATABASE student_demo_registration;
   mysql -u your_username -p student_demo_registration < database/schema.sql
   ```

3. **Configure database**:
   ```bash
   cp config/database.template.php config/database.php
   # Edit config/database.php with your credentials
   ```

4. **Start development server**:
   ```bash
   php -S localhost:8000
   ```

5. **Visit the application**:
   - Main page: http://localhost:8000
   - Admin panel: http://localhost:8000/admin.php

## 📋 Requirements

- **PHP 7.4+** with PDO and MySQL extensions
- **MySQL 5.7+** or compatible database
- **Web server** (Apache/Nginx) or Vercel

## 🏗️ Architecture

```
📁 Project Structure
├── 📄 index.php              # Main registration page
├── 📄 admin.php              # Admin dashboard
├── 📄 health.php             # Health check endpoint
├── 📄 vercel.json            # Vercel configuration
├── 📄 .gitignore             # Git ignore rules
├── 📁 config/
│   ├── 📄 database.php       # Database configuration
│   └── 📄 database.template.php # Template for setup
├── 📁 includes/
│   ├── 📄 functions.php      # Helper functions
│   ├── 📄 header.php         # Common header
│   └── 📄 footer.php         # Common footer
├── 📁 css/
│   └── 📄 style.css          # Modern styling
├── 📁 js/
│   └── 📄 validation.js      # Client-side validation
└── 📁 database/
    └── 📄 schema.sql         # Database schema
```

## 🎯 Core Features

### Student Registration
- **8-digit Student ID** validation
- **Name validation** (alpha characters only)
- **Email validation** with domain restrictions
- **Phone format** validation (999-999-9999)
- **Project title** required
- **Time slot selection** with availability

### Admin Dashboard
- **Complete student list** with all details
- **Registration statistics**
- **Time slot availability** overview
- **Export-ready** data format

### Security Features
- **Input sanitization** and validation
- **SQL injection prevention** with prepared statements
- **XSS protection**
- **Environment variable** configuration
- **File access restrictions**

## 🔧 Configuration

### Environment Variables (for Vercel)

```bash
DB_HOST=your-database-host
DB_NAME=your-database-name
DB_USER=your-database-username
DB_PASS=your-database-password
```

### Database Schema

The system uses two main tables:
- **`time_slots`** - Stores available time slots
- **`students`** - Stores student registrations

## 🧪 Testing

1. **Test Registration**:
   - Fill out the registration form
   - Verify validation works
   - Check database for new entry

2. **Test Admin Panel**:
   - Visit `/admin.php`
   - Verify all registrations display
   - Check time slot availability

3. **Test Duplicate Registration**:
   - Try registering with same Student ID
   - Verify update functionality

## 🚀 Deployment

### Vercel Deployment
- Automatic deployments from GitHub
- Serverless PHP functions
- Global CDN
- Free tier available

### Other Platforms
- **Netlify** - Similar to Vercel
- **Railway** - Full-stack platform
- **Heroku** - Traditional hosting
- **AWS** - Enterprise hosting

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Test thoroughly
5. Submit a pull request

## 📄 License

This project is created for educational purposes. Feel free to use and modify as needed.

## 🆘 Support

- **Documentation**: [INSTALLATION.md](INSTALLATION.md)
- **Vercel Deployment**: [VERCEL_DEPLOYMENT.md](VERCEL_DEPLOYMENT.md)
- **Issues**: Create an issue on GitHub

## 📊 Status

![GitHub last commit](https://img.shields.io/github/last-commit/yourusername/student-demo-registration)
![GitHub issues](https://img.shields.io/github/issues/yourusername/student-demo-registration)
![GitHub pull requests](https://img.shields.io/github/issues-pr/yourusername/student-demo-registration)

---

**Made with ❤️ for educational purposes** 