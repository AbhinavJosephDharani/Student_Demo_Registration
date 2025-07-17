# Vercel Deployment Guide

## Prerequisites

Before deploying to Vercel, you'll need:

1. **GitHub Account** - Your code will be hosted on GitHub
2. **Vercel Account** - Sign up at [vercel.com](https://vercel.com)
3. **Database Hosting** - Since Vercel doesn't support MySQL, you'll need an external database

## Database Options for Vercel

Since Vercel doesn't support MySQL databases, you have several options:

### Option 1: PlanetScale (Recommended)
- Free tier available
- MySQL compatible
- Easy setup with Vercel

### Option 2: Railway
- Free tier available
- MySQL support
- Simple deployment

### Option 3: Clever Cloud
- Free tier available
- MySQL support
- Good performance

### Option 4: AWS RDS
- Pay-as-you-go
- Full MySQL support
- Enterprise-grade

## Deployment Steps

### 1. Prepare Your Repository

1. **Create a new GitHub repository**
2. **Push your code to GitHub:**
   ```bash
   git init
   git add .
   git commit -m "Initial commit"
   git branch -M main
   git remote add origin https://github.com/yourusername/your-repo-name.git
   git push -u origin main
   ```

### 2. Set Up Database

1. **Choose a database provider** (PlanetScale recommended)
2. **Create a new database**
3. **Import the schema:**
   ```sql
   -- Run the contents of database/schema.sql in your database
   ```

### 3. Configure Environment Variables

In your Vercel dashboard, add these environment variables:

```
DB_HOST=your-database-host
DB_NAME=your-database-name
DB_USER=your-database-username
DB_PASS=your-database-password
```

### 4. Deploy to Vercel

1. **Connect GitHub to Vercel:**
   - Go to [vercel.com](https://vercel.com)
   - Click "New Project"
   - Import your GitHub repository

2. **Configure the project:**
   - Framework Preset: Other
   - Root Directory: `./` (default)
   - Build Command: Leave empty
   - Output Directory: Leave empty

3. **Add Environment Variables:**
   - Go to Project Settings → Environment Variables
   - Add your database credentials

4. **Deploy:**
   - Click "Deploy"
   - Vercel will automatically deploy your app

### 5. Update Database Configuration

Since we can't commit the actual database credentials, you'll need to modify the database connection to use environment variables:

```php
// In config/database.php
define('DB_HOST', $_ENV['DB_HOST'] ?? 'localhost');
define('DB_NAME', $_ENV['DB_NAME'] ?? 'student_demo_registration');
define('DB_USER', $_ENV['DB_USER'] ?? 'root');
define('DB_PASS', $_ENV['DB_PASS'] ?? '');
```

## Vercel-Specific Considerations

### 1. Serverless Functions
- Vercel uses serverless functions
- Each PHP file becomes a function
- Cold starts may occur

### 2. Database Connections
- Use connection pooling if available
- Consider using PlanetScale's connection pooling

### 3. File System
- Vercel has read-only file system
- No file uploads (not needed for this project)
- Use environment variables for configuration

### 4. Performance
- Enable Vercel's Edge Network
- Use CDN for static assets
- Optimize database queries

## Troubleshooting

### Common Issues

1. **Database Connection Failed**
   - Check environment variables in Vercel dashboard
   - Verify database credentials
   - Ensure database is accessible from Vercel's IP ranges

2. **500 Errors**
   - Check Vercel function logs
   - Verify PHP syntax
   - Ensure all required files are present

3. **404 Errors**
   - Check `vercel.json` configuration
   - Verify file paths
   - Ensure routing is correct

### Debugging

1. **Check Vercel Logs:**
   - Go to your project in Vercel dashboard
   - Click on a deployment
   - Check "Functions" tab for logs

2. **Local Testing:**
   - Use Vercel CLI for local testing
   - Install: `npm i -g vercel`
   - Run: `vercel dev`

## Post-Deployment

### 1. Test Your Application
- Visit your Vercel URL
- Test registration functionality
- Check admin panel
- Verify database operations

### 2. Set Up Custom Domain (Optional)
- Go to Project Settings → Domains
- Add your custom domain
- Configure DNS settings

### 3. Monitor Performance
- Use Vercel Analytics
- Monitor database performance
- Check error rates

## Security Considerations

1. **Environment Variables**
   - Never commit database credentials
   - Use Vercel's environment variable system
   - Rotate credentials regularly

2. **Database Security**
   - Use SSL connections
   - Restrict database access
   - Regular backups

3. **Application Security**
   - Input validation (already implemented)
   - SQL injection prevention (already implemented)
   - XSS protection (already implemented)

## Cost Optimization

1. **Vercel Free Tier**
   - 100GB bandwidth/month
   - 100 serverless function executions/day
   - Perfect for small to medium projects

2. **Database Costs**
   - PlanetScale: Free tier available
   - Railway: Free tier available
   - Monitor usage to avoid unexpected charges

## Support

If you encounter issues:

1. Check Vercel documentation
2. Review function logs
3. Test locally with Vercel CLI
4. Contact Vercel support if needed 