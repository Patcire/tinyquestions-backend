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

const rooms = {}

const port = 3200;
httpServer.listen(port, () => {
    console.log(`Socket.IO server running at http://localhost:${port}/`);
})

// User enter the room (connected)
io.on('connection', (socket) => {

    console.log(`User connected to socket:`, socket.id)

    const playersOnRoom = {}

    socket.on('joinRoom', (data) => {
        console.log(data)
        socket.join(data.roomID)
        if (!rooms[data.roomID]) rooms[data.roomID] = [socket.id]
        else if (rooms[data.roomID].length<4) rooms[data.roomID].push(socket.id)
        else  io.to(data.roomID).emit('fullRoom', true)

        console.log(rooms)

        io.to(data.roomID).emit('userJoinedSuccesfullyToRoom', {
            success: true,
            players: playersOnRoom
        })
    })


    socket.on('disconnect', (reason) => {
        console.log('user disconnected from socket:', socket.id, '-Reason:', reason)
    })



})




