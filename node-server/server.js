const http = require('http'); // Ganti https dengan http
const socketIo = require('socket.io');

const hostname = '10.203.84.25';
const port = 3001;

// Buat server HTTP
const server = http.createServer((req, res) => {
  res.setHeader('Access-Control-Allow-Origin', '*');
  res.setHeader('Access-Control-Allow-Methods', 'GET, POST');
  res.setHeader('Access-Control-Allow-Headers', 'Content-Type');
  if (req.method === 'OPTIONS') {
    res.writeHead(204);
    res.end();
    return;
  }
  res.writeHead(200, { 'Content-Type': 'text/plain' });
  res.end('Server is running\n');
});

// Konfigurasi socket.io
const io = socketIo(server, {
  cors: {
    origin: '*',
    methods: ['GET', 'POST']
  }
});

io.on('connection', (socket) => {
  console.log('a user connected');

  socket.on('new-user', (user) => {
    io.emit('reload-datatable');
  });

  socket.on('update-user', (user) => {
    io.emit('reload-datatable');
  });

  socket.on('delete-user', (user) => {
    io.emit('reload-datatable');
  });

  socket.on('dashboard', () => {
    io.emit('reload-data');
    console.log('dashboard event received');
    console.log('reloaded event emitted');
  });

  socket.on('update-notif', () => {
    io.emit('reload-data');
  });

  socket.on('disconnect', () => {
    console.log('user disconnected');
  });
});

server.listen(port, hostname, () => {
  console.log(`Server running at http://${hostname}:${port}`);
});
