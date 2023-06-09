import videojs from "video.js"
import "video.js/dist/video-js.css"
import './styles/_video.scss'
import 'video.js/dist/video'
import  'videojs-playlist/dist/videojs-playlist.min'

const playerHome = videojs('my-player-home', {
    autoplay: true,
    controls: true,
    loop: false,
    playbackRates: [0.25,0.5,1,1.5,2,2.5],
    autoload: true,
});

const player = videojs('my-player', {
    autoplay: true,
    controls: true,
    loop: false,
    aspectRation: '16:9',
    playbackRates: [0.25,0.5,1,1.5,2,2.5],
    autoload: true,
    preload: 'none',
});

player.addClass('vjs-matrix');
document.addEventListener('DOMContentLoaded', () => {
    const videos = document.getElementsByClassName('recommandationVideo');
    for (let i = 0; i < videos.length; i++) {
        const video = videos[i];
        const playerId = "my-player-" + i;

        video.id = playerId;
        const player = videojs(playerId);

        player.on("mouseover", () => {
            player.play();
            player.el().style.transform = "scale(1.02)";
            player.el().style.borderRadius = "0";
        });

        player.on("mouseout", () => {
            player.pause();
            player.el().style.transform = "scale(1)";
            player.el().style.borderRadius = "12px";
        });
    }
});




