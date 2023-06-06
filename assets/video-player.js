import videojs from "video.js";
import './styles/_video.scss';

var player = videojs('myVideo', {
    autoplay: 'muted',
    controls: true,
    loop: true,
    fluid: true,
    aspectRatio: '4:3',
    playbackRates: [0.25,0.5,1,1.5,2.5,3]
})
