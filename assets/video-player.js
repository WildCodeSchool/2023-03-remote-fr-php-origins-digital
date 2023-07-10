import videojs from "video.js"
import "video.js/dist/video-js.css"
import './styles/_video.scss'


const players = document.querySelectorAll('[id^="modal-player-video"]');
players.forEach((playerElement, index) => {
    const player = videojs(playerElement.id, {
        controls: true,
        loop: false,
        playbackRates: [0.25, 0.5, 1, 1.5, 2, 2.5],
        autoload: true
    });
});








