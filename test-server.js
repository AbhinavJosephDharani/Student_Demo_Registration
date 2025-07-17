const express = require('express');
const app = express();

app.use(express.json());

// Health check
app.get('/', (req, res) => res.send('API is running!'));

// Test endpoint
app.get('/test', (req, res) => res.json({ message: 'Test endpoint working!' }));

const PORT = process.env.PORT || 3000;
app.listen(PORT, () => console.log(`Server running on port ${PORT}`)); 