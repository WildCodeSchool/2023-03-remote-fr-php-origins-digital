import 'intro.js/introjs.css';

import introJs from 'intro.js';


introJs().setOptions({
    dontShowAgain: true,
    steps: [{
        intro: "Bonjour. Bienvenue dans votre espace administrateur !"
    },
    {
        element: document.querySelector(".step-user"),
        intro: "Ici vous pouvez voir, ajouter, modifier, supprimer vos utilisateurs.",
    },
    {
        element: document.querySelector(".step-category"),
        intro: "Ici vous pouvez voir, ajouter, modifier, supprimer vos categories.",
    },
    {
        element: document.querySelector(".step-tags"),
        intro: "Ici vous pouvez voir, ajouter, modifier, supprimer vos tags.",
    },
    {
        element: document.querySelector(".step-videos"),
        intro: "Ici vous pouvez voir, ajouter, modifier, supprimer vos vidéos.",
    },
    ],
}).start();

