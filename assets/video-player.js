import videojs from "video.js";

var player = videojs('myVideo', {
    autoplay: 'muted',
    controls: true,
    loop: true,
    fluid: true,
    aspectRatio: '4:3',
    playbackRates: [0.25,0.5,1,1.5,2.5,3]
})
