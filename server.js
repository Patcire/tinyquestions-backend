import express from 'express';
import { createServer } from 'http';
import { Server } from 'socket.io';

const app = express();
const httpServer = createServer(app);
const io = new Server(httpServer, {
    cors: {
        origin: '*',
        methods: ['GET', 'POST']
    }
});

const port = 3200;

app.get('/', (req, res) => {
    res.send('Socket.IO server is running.');
});

io.on('connection', (socket) => {
    console.log('a user connected');

    socket.on('disconnect', () => {
        console.log('user disconnected');
    });

    socket.on('message', (msg) => {
        console.log('message: ' + msg);
        io.emit('message', msg);
    });
});

httpServer.listen(port, () => {
    console.log(`Socket.IO server running at http://localhost:${port}/`);
});
