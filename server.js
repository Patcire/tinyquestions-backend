import express from 'express';
import { createServer } from 'http';
import { Server } from 'socket.io';

// variables

const rooms = {}

let playersOnRoom = []
let playersWhoAnswered = 0
let playersWhoFinished = 0
let playersFinalResults= []

// methods

const repeatedUser = (data) => {
    return playersOnRoom.some((user)=> user === data.username )
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
io.on('connection', (socket) => {

    console.log(`User connected to socket:`, socket.id)

    socket.on('joinRoom', (data) => {
        socket.join(data.roomID)
        if (!rooms[data.roomID]){

            rooms[data.roomID] = [{
                username: data.username,
                userSocket: socket.id
            }]
            playersOnRoom.push(data.username)

        }

        else if (rooms[data.roomID].length<4 && !repeatedUser(data)){
            rooms[data.roomID].push({
                username: data.username,
                userSocket: socket.id
            })
            playersOnRoom.push(data.username)


        }
        else if (repeatedUser(data)){
            console.log('repeee')
        }
        else  io.to(data.roomID).emit('fullRoom', true)

        console.log('existing rooms: '+ JSON.stringify(rooms))

        io.to(data.roomID).emit('userJoinedSuccesfullyToRoom', {
            success: true,
            players: playersOnRoom
        })
    })

    socket.on('gameStarted', (res)=>{
        io.to(res.roomID).emit('gameStarted', res)
    })

    socket.on('playerAnsweredQuestion',(res) =>{
        playersWhoAnswered++
        if (playersWhoAnswered === playersOnRoom.length){
            io.to(res.roomID).emit('showResultsOfQuestion', res.success)
            playersWhoAnswered= 0
        }

    } )

    socket.on('playerFinish',(res) =>{
        playersWhoFinished++
        playersFinalResults.push(res)
        if (playersWhoFinished === playersOnRoom.length){
            let sorted = playersFinalResults.sort((a, b) => a.finalScore - b.finalScore)
            io.to(res.roomID).emit('allPlayersHaveFinished', sorted)
            playersWhoFinished=0
            playersFinalResults= []
        }

    } )


    socket.on('turnoff', (reason) => {
        playersOnRoom = []
        console.log('user disconnected from socket:', socket.id, '-Reason:', reason)
    })



})




