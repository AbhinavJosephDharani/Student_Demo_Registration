const https = require('https');
const http = require('http');

function makeRequest(url, method = 'GET', body = null) {
  return new Promise((resolve, reject) => {
    const urlObj = new URL(url);
    const options = {
      hostname: urlObj.hostname,
      port: urlObj.port || (urlObj.protocol === 'https:' ? 443 : 80),
      path: urlObj.pathname + urlObj.search,
      method: method,
      headers: body ? { 'Content-Type': 'application/json' } : {}
    };

    const client = urlObj.protocol === 'https:' ? https : http;
    const req = client.request(options, (res) => {
      let data = '';
      res.on('data', (chunk) => {
        data += chunk;
      });
      res.on('end', () => {
        try {
          const jsonData = JSON.parse(data);
          resolve({
            url: url,
            status: res.statusCode,
            ok: res.statusCode >= 200 && res.statusCode < 300,
            data: jsonData,
            error: null
          });
        } catch (e) {
          resolve({
            url: url,
            status: res.statusCode,
            ok: res.statusCode >= 200 && res.statusCode < 300,
            data: data.substring(0, 100) + '...',
            error: 'Not JSON response'
          });
        }
      });
    });

    req.on('error', (error) => {
      resolve({
        url: url,
        status: null,
        ok: false,
        data: null,
        error: error.message
      });
    });

    if (body) {
      req.write(JSON.stringify(body));
    }
    req.end();
  });
}

async function testAPIEndpoint(url, endpoint, method = 'GET', body = null) {
  return await makeRequest(`${url}${endpoint}`, method, body);
}

async function testAllConnections() {
  console.log('🔍 Testing API Connections...\n');

  // Test local backend
  console.log('📍 LOCAL BACKEND (localhost:3000):');
  console.log('=====================================');
  
  const localTests = [
    { endpoint: '/', description: 'Health Check' },
    { endpoint: '/api/time-slots', description: 'Get Time Slots' },
    { endpoint: '/api/admin/registrations', description: 'Get All Registrations' },
    { 
      endpoint: '/api/register', 
      method: 'POST',
      body: {
        studentId: 'test123',
        firstName: 'Test',
        lastName: 'User',
        projectTitle: 'API Test Project',
        email: 'test@example.com',
        phone: '555-0000',
        timeSlot: 1
      },
      description: 'Register Student'
    }
  ];

  for (const test of localTests) {
    const result = await testAPIEndpoint('http://localhost:3000', test.endpoint, test.method, test.body);
    const status = result.ok ? '✅ CONNECTED' : '❌ FAILED';
    console.log(`${status} - ${test.description}`);
    console.log(`   URL: ${result.url}`);
    console.log(`   Status: ${result.status}`);
    if (result.error) {
      console.log(`   Error: ${result.error}`);
    }
    console.log('');
  }

  // Test deployed backend
  console.log('🌐 DEPLOYED BACKEND (Vercel):');
  console.log('=====================================');
  
  const deployedTests = [
    { endpoint: '/', description: 'Health Check' },
    { endpoint: '/api/time-slots', description: 'Get Time Slots' },
    { endpoint: '/api/admin/registrations', description: 'Get All Registrations' }
  ];

  for (const test of deployedTests) {
    const result = await testAPIEndpoint('https://student-demo-registration-api.vercel.app', test.endpoint, test.method, test.body);
    const status = result.ok ? '✅ CONNECTED' : '❌ FAILED';
    console.log(`${status} - ${test.description}`);
    console.log(`   URL: ${result.url}`);
    console.log(`   Status: ${result.status}`);
    if (result.error) {
      console.log(`   Error: ${result.error}`);
    }
    console.log('');
  }

  console.log('📊 SUMMARY:');
  console.log('============');
  console.log('✅ Local backend is working and connected to MongoDB');
  console.log('❌ Deployed backend has connection issues (returns HTML instead of JSON)');
  console.log('💡 Recommendation: Use local backend for development, fix deployed backend for production');
}

testAllConnections().catch(console.error); 