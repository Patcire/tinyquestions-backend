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
    return rooms[data.roomID].some((user)=> user === data.username )
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

    socket.emit('maxPlayers', maxPlayers)

    socket.on('joinRoom', (data) => {

        console.log('triying to join...')

        if (!rooms[data.roomID]){

            socket.join(data.roomID)
            rooms[data.roomID] = [{
                username: data.username,
                userSocket: socket.id
            }]
            console.log('succesfully join')
            io.to(data.roomID).emit('userJoinedSuccesfullyToRoom', {
                success: true,
                players: rooms[data.roomID]
            })
            console.log('existing rooms: '+ JSON.stringify(rooms))
            return
        }
        else if (repeatedUser(data)){
            console.log('repe return 2')
            return
        }

        else if (rooms[data.roomID].length<maxPlayers ){
            socket.join(data.roomID)
            rooms[data.roomID].push({
                username: data.username,
                userSocket: socket.id
            })
            console.log('existing rooms: '+ JSON.stringify(rooms))
            return
        }

        else if(rooms[data.roomID].length===maxPlayers) io.to(data.roomID).emit('fullRoom', true)



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


    socket.on('turnoff', (data) => {
        //playersOnRoom = []
        const deleted = delete rooms[data.roomID]
        console.log('room has been deleted? '+deleted)
    })



})




