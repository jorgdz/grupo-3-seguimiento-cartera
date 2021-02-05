window.addEventListener('load', function () {
    var socket = new WebSocket('ws://localhost:8090');
    socket.send("Pago actualizado!!");
})