// import Atropos library
import Atropos from 'atropos';
import 'atropos/atropos.scss';

// Initialize
document.querySelectorAll('.genreAtropos').forEach((element) => {
    Atropos({
        el: element,
        activeOffset: 40,
        shadowScale: 1,
        rotateLock: true,
        rotateXMax: 15,
        rotateYMax: 15,
        highlight: false,
        rotateTouch: false,
    });
})

