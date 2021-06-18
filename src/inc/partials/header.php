<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title> GESTION DES CONTACTS | By Godwin </title>
    <base href="/">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- <link
	href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css"
	rel="stylesheet"
	integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0"
	crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="src/public/bootstrap/css/bootstrap.min.css">
    <!-- <script src="src/public/bootstrap/js/bootstrap.min.js"></script> -->
    <link rel="shortcut icon" href="src/public/images/favicon.png" type="image/png">


    <style>
    html,
    body {
        height: 100%;
        margin: 0;
        padding: 0;
    }

    img {
        object-fit: contain;
    }

    .progress-bar-animation {
        background: green;
        animation: infinite-progress 1s ease-in-out infinite;
    }

    .active {

        animation: fadeIn .5s ease-in-out;
        background: darkslategray;
        border-radius: 50rem;
        padding: 10px;
    }

    /* 
    .nav-item {
         text-align: center;
        display: grid;
        place-items: center; 
    }*/
    @keyframes fadeIn {
        0% {
            opacity: 0.5;
        }

        100% {
            opacity: 1;
        }
    }

    @keyframes infinite-progress {
        0% {
            width: 20%;
        }

        100% {
            width: 100%;
        }
    }
    </style>
</head>

<body class="bg-light">
    <div class="progress w-100  d-none" style="height:10px;">
        <div class="progress-bar  progress-bar-animation" role="progressbar" style="width: 5%;" aria-valuenow="00"
            aria-valuemin="0" aria-valuemax="100"></div>
    </div>

    <!-- NavBar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark p-0">
        <div class="container-fluid">
            <a class="navbar-brand" href="/"> <img src="src/public/images/favicon.png" width="50px" />GESTION </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav  me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?= Sanitizer::sanitizeGet('p') === '' ? 'active' : '' ?>" href="">
                            <i class="bi bi-person-lines-fill text-white p-0"></i>
                            Liste des Contacts
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= Sanitizer::sanitizeGet('p') === 'groupe' ? 'active' : '' ?>"
                            href="/groupe">
                            <i class="bi bi-person-lines-fill text-white"></i>
                            Liste des groupes
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= Sanitizer::sanitizeGet('p') === 'addGroupe' ? 'active' : '' ?>"
                            href="/addGroupe">
                            <i class="bi bi-people-fill text-white"></i>
                            Ajouter Groupe
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= Sanitizer::sanitizeGet('p') === 'addContact' ? 'active' : '' ?>"
                            href="/addContact">
                            <i class="bi bi-person-fill text-white"></i>
                            Ajouter Contact
                        </a>
                    </li>

                </ul>
                <div class="d-flex mb-2 mb-lg-0">
                    <input class="form-control p-1 me-2" type="search" placeholder="Rechercher" aria-label="Rechercher"
                        id="recherche" onkeyup="rechercher(event)">

                </div>
            </div>
        </div>
    </nav>



    <!-- style=" backdrop-filter: blur(90px);" -->
    <div class="d-none text-white bg-secondary p-2 w-50 position-fixed top-50 start-50 translate-middle" id="search"
        style="overflow-y:scroll;max-height:75%">
        <h5 class="mb-2">Groupes</h5>
        <div id="searchList">


        </div>

        <div class="d-flex justify-content-end">
            <a class="btn btn-sm btn-warning"
                onclick="event.target.parentNode.parentNode.classList.add('d-none')">Fermer</a>
        </div>
    </div>