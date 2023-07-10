import { Controller } from '@hotwired/stimulus';
import {Modal} from "bootstrap";

/*
 * This is an example Stimulus controller!
 *
 * Any element with a data-controller="hello" attribute will cause
 * this controller to be executed. The name "hello" comes from the filename:
 * hello_controller.js -> "hello"
 *
 * Delete this file or adapt it for your use!
 */
export default class extends Controller {
    static targets = ['component', 'modal'];
    findVideo(event)
    {
        event.preventDefault();
        const videoId = event.currentTarget.dataset.videoId;
        const component = this.componentTarget.__component;
        component.action('findVideo', {id: videoId})
        component.on('render:finished', () => {
            Modal.getOrCreateInstance(this.modalTarget).show();
        })
    }
}
