import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ['shareButton'];

    connect()
    {
        this.addClickListenerToShareButtons();
        this.addGlobalClickListener();
    }

    addClickListenerToShareButtons()
    {
        this.shareButtonTargets.forEach((shareButton) => {
            shareButton.addEventListener("click", this.handleShareButtonClick.bind(this));
        });
    }

    addGlobalClickListener()
    {
        document.addEventListener("click", this.handleGlobalClick.bind(this));
    }

    handleShareButtonClick(event)
    {
        if (window.innerWidth <= 600) {
            this.hideShareButtons();
            event.stopPropagation();
        }
    }

    handleGlobalClick(event)
    {
        if (!this.shareButtonTargets.includes(event.target) && window.innerWidth <= 600) {
            this.showShareButtons();
        }
    }

    hideShareButtons()
    {
        this.shareButtonTargets.forEach((shareButton) => {
            shareButton.style.display = 'none';
        });
    }

    showShareButtons()
    {
        this.shareButtonTargets.forEach((shareButton) => {
            shareButton.style.display = 'block';
        });
    }
}
