import express from 'express';
import { createServer } from 'http';
import { Server } from 'socket.io';

// variables

const maxPlayers = 2

let rooms = {}
let playersWhoAnswered = 0
let playersWhoFinished = 0
let playersFinalResults= []

// methods

const repeatedUser = (data) => {
    return rooms[data.roomID].some((user)=> user.username === data.username)
}

// Socket Config
const port = 3200
const app = express()
const httpServer = createServer(app)
const io = new Server(httpServer, {
    cors: {
        origin: '*',
        methods: ['GET', 'POST']
    },
    transports: ['websocket']
})


// socket listeners/emits

httpServer.listen(port, () => {
    console.log(`Socket.IO server running at http://localhost:${port}/`);
})

// User enter the server (connected)
io.on('connect', (socket) => {

    console.log(`User connected to socket:`, socket.id)

    socket.emit('maxPlayers', maxPlayers)

    socket.on('joinRoom', (data) => {

        console.log(data.username + ' triying to join...\n')

        if (!rooms[data.roomID]){
            socket.join(data.roomID)
            rooms[data.roomID] = [{
                username: data.username,
                userSocket: socket.id
            }]

            console.log(data.username + 'room created and user succesfully join\n')

            io.to(data.roomID).emit('userJoinedSuccesfullyToRoom', {
                success: true,
                players: rooms[data.roomID]
            })

            console.log('existing rooms: '+ JSON.stringify(rooms))
            return
        }

        else if (repeatedUser(data)){
            socket.join(data.roomID)
            io.to(data.roomID).emit('userJoinedSuccesfullyToRoom', {
                success: true,
                players: rooms[data.roomID]
            })
            return
        }

        else if (rooms[data.roomID].length<maxPlayers ){
            console.log('new user in town')
            socket.join(data.roomID)
            rooms[data.roomID].push({
                username: data.username,
                userSocket: socket.id
            })
            io.to(data.roomID).emit('userJoinedSuccesfullyToRoom', {
                success: true,
                players: rooms[data.roomID]
            })
            console.log('existing rooms: '+ JSON.stringify(rooms))
            return
        }

        else if(rooms[data.roomID].length===maxPlayers) io.to(socket.id).emit('fullRoom', true)



    })

    socket.on('gameStarted', (res)=>{
        io.to(res.roomID).emit('gameStarted', res)
    })

    socket.on('playerAnsweredQuestion',(res) =>{
        playersWhoAnswered++
        if (playersWhoAnswered === rooms[res.roomID].length){
            io.to(res.roomID).emit('showResultsOfQuestion', res.success)
            playersWhoAnswered= 0
        }

    } )

    socket.on('playerFinish',(res) =>{
        playersWhoFinished++
        playersFinalResults.push(res)
        if (playersWhoFinished === rooms[res.roomID].length){
            let sorted = playersFinalResults.sort((a, b) => a.finalScore - b.finalScore)
            io.to(res.roomID).emit('allPlayersHaveFinished', sorted)
            playersWhoFinished=0
            playersFinalResults= []
        }

    } )


    socket.on('turnoff', (roomID) => {
        console.log('room to delete: ' + roomID)
        const deleted = delete rooms[roomID]
        console.log('room has been deleted? '+deleted)
        console.log('so, actual rooms: '+ JSON.stringify(rooms))
    })

    socket.on('disconnect', () => {
        console.log('User disconnected')
    })

})




