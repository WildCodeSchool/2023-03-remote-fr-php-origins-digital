import {Controller} from '@hotwired/stimulus';
import videojs from "video.js"
import "video.js/dist/video-js.css"
import '../styles/_video.scss'

export default class extends Controller {
    static values = { videoId: String };
    connect()
    {
        window.player = videojs(this.element, {
            controls: true,
            loop: false,
            playbackRates: [0.25, 0.5, 1, 1.5, 2, 2.5],
            autoload: true,
        });

        // Add a view after the video has been played for at least 15 seconds
        window.viewAdded = false;
        window.player.on('timeupdate', (event) => {
            console.log('timeupdate event triggered');
            if (!window.viewAdded && window.player.currentTime() >= 5) {
                window.viewAdded = true;
                this.updateViewCount();
            }
        });

        window.Sharer.init();
    }

    updateViewCount()
    {
        const videoId = this.element.getAttribute('data-video-id-value');
        try {
            fetch(`/video/api/videos/${videoId}/incrementView`)
                .then(res => res.json())
                .then(data => console.log(data))
        } catch (err) {
            console.error(err);
        }
    }
}
