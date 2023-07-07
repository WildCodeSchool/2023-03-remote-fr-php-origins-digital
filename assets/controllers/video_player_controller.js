import { Controller } from '@hotwired/stimulus';
import videojs from "video.js"
import "video.js/dist/video-js.css"
import '../styles/_video.scss'

export default class extends Controller {
    connect()
    {
      window.player = videojs(this.element, {
        controls: true,
        loop: false,
        playbackRates: [0.25, 0.5, 1, 1.5, 2, 2.5],
        autoload: true,
      });
    }
}

