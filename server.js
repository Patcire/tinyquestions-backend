import express from 'express';
import { createServer } from 'http';
import { Server } from 'socket.io';

// Socket Config
const app = express();
const httpServer = createServer(app);
const io = new Server(httpServer, {
    cors: {
        origin: '*',
        methods: ['GET', 'POST']
    },
    transports: ['websocket']
})

const port = 3200;
httpServer.listen(port, () => {
    console.log(`Socket.IO server running at http://localhost:${port}/`);
})

// User enter the room (connected)
io.on('connection', (socket) => {

    console.log(`User connected to socket:`, socket.id)

    socket.on('disconnect', (reason) => {
        console.log('user disconnected from socket:', socket.id, '-Reason:', reason);
    })

    socket.on('message', (msg) => {
        console.log(msg)
        io.emit('message', msg)
    })

    socket.on('turnoff', () => {
        console.log('turnoff event, shutting down')
        io.emit('closeSocketOnClient')
    });

})



