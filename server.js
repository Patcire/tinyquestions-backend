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
    }
})

const port = 3200;
httpServer.listen(port, () => {
    console.log(`Socket.IO server running at http://localhost:${port}/`);
})

app.get('/', (req, res) => {
    res.send('Socket.IO server is running.')
})


// Socket is connected

io.on('connection', (socket) => {
    console.log('a user connected')

    socket.on('disconnect', () => {
        console.log('user disconnected')
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

// Socket shutting down

//io.off('turnoff', (socket) =>{
//
//})
//


