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

document.addEventListener('DOMContentLoaded', () => {
    const videos = document.getElementsByClassName('videoPlayerHome');
    for (let i = 0; i < videos.length; i++) {
        const video = videos[i];
        const playerId = "player-home-" + i;

        video.id = playerId;
        const player = videojs(playerId);

        player.on("mouseout", () => {
            player.pause();
            player.el().style.transform = "scale(1)";
            player.el().style.borderRadius = "12px";
        });

        player.on("mouseout", () => {
            player.pause();
            player.el().style.transform = "scale(1)";
            player.el().style.borderRadius = "12px";
        });
    }
});





