# Student Demo Registration System

A full-stack web application for student demo registration with React frontend and Node.js backend.

## 🏗️ Project Structure

```
student-demo-registration-system/
├── frontend/                    # React frontend application
│   ├── src/                    # React source code
│   ├── package.json            # Frontend dependencies
│   └── vite.config.js          # Vite configuration
├── student-demo-registration-api/  # Node.js backend API
│   ├── index.js               # Main server file
│   ├── models/                # MongoDB models
│   └── package.json           # Backend dependencies
├── vercel.json                # Vercel deployment configuration
├── package.json               # Root package.json (monorepo)
└── README.md                  # This file
```

## 🚀 Quick Start

### Local Development

1. **Install dependencies:**
   ```bash
   npm install
   ```

2. **Set up environment variables:**
   Create `.env` file in `student-demo-registration-api/`:
   ```
   MONGODB_URI=your_mongodb_connection_string
   PORT=3000
   ```

3. **Run both frontend and backend:**
   ```bash
   npm run dev
   ```
   
   Or run separately:
   ```bash
   # Backend only
   npm run dev:backend
   
   # Frontend only  
   npm run dev:frontend
   ```

4. **Access the application:**
   - Frontend: http://localhost:5173
   - Backend API: http://localhost:3000

## 🌐 Deployment

This project is configured for deployment on Vercel as a single repository with both frontend and backend.

### Vercel Configuration

The `vercel.json` file configures:
- **Backend API**: Routes `/api/*` to the Node.js server
- **Frontend**: Serves the React app for all other routes
- **Build Process**: Automatically builds both frontend and backend

### Environment Variables

Set these in your Vercel project settings:
- `MONGODB_URI`: Your MongoDB Atlas connection string

## 📋 Features

### Frontend
- ✅ Student registration form
- ✅ Real-time time slot availability
- ✅ Form validation
- ✅ Responsive design
- ✅ Local storage fallback

### Backend
- ✅ RESTful API endpoints
- ✅ MongoDB integration
- ✅ Student registration
- ✅ Time slot management
- ✅ Duplicate prevention
- ✅ Admin dashboard

## 🔧 API Endpoints

- `GET /` - Health check
- `GET /api/time-slots` - Get available time slots
- `POST /api/register` - Register a student
- `GET /api/admin/registrations` - Get all registrations (admin)

## 🛠️ Technology Stack

- **Frontend**: React, Vite, CSS3
- **Backend**: Node.js, Express, MongoDB
- **Database**: MongoDB Atlas
- **Deployment**: Vercel
- **Package Manager**: npm

## 📝 Development Notes

- The frontend uses localStorage as a fallback when the backend is unavailable
- MongoDB connection is optimized for serverless environments
- CORS is configured for cross-origin requests
- All API responses include proper error handling

## 🔍 Troubleshooting

### MongoDB Connection Issues
1. Ensure `MONGODB_URI` is set in environment variables
2. Check MongoDB Atlas Network Access (add `0.0.0.0/0` for Vercel)
3. Verify connection string format

### Vercel Deployment Issues
1. Check Vercel function logs for detailed error messages
2. Ensure all environment variables are set
3. Verify `vercel.json` configuration

### Local Development Issues
1. Make sure both frontend and backend are running
2. Check port conflicts (frontend: 5173, backend: 3000)
3. Verify `.env` file exists in backend directory
