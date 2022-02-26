require('./bootstrap');

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

let main = document.getElementById('main');

Echo.channel('notification')
    .listen('MessageNotification', (e) => {
        console.log(e.message);
    });
