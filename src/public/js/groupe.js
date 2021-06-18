
const GROUPE_API_URL = 'src/api/gestionGroupe.php';
const CONTACT_API_URL = 'src/api/gestionContact.php';
const IMAGE_DIRECTORY = "/upload/";
const PUBLIC_DIRECTORY = "src/public/images/groupe.png";

let alert = document.querySelector('#alert');
const progress = document.querySelector('.progress');

// Fonction pour la recherche
function rechercher(event) {
    const recherche = event.target.value;

    if (recherche != '') {

        setTimeout(() => {

            document.querySelector("#search").classList.remove("d-none");



            let groupContent = '';
            fetch(`${GROUPE_API_URL}?action=recherche&value=${recherche}`)
                .then(data => data.json())
                .then(data => {
                    const groupes = JSON.parse(data.message);
                    if (groupes.length >= 1) {
                        groupes.forEach(group => {

                            groupContent += `<div class="d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex align-items-center">
                <img src=${('/upload/' + group.image) || '/src/public/images/profile.svg'} alt="Groupe Profile" class="rounded-circle me-2" width="50">
                <span class="fw-bold"> ${group.nom} </span >
                </div ></div>`;


                        })


                    } else {
                        groupContent = `<p class='text-white p-2'>Aucun groupe ayant pour nom {${recherche}} </p>`;
                    }

                    document.querySelector("#searchList").innerHTML = groupContent;
                })
        }, 500);

    } else {
        document.querySelector("#search").classList.add("d-none");

    }

}


function showAlert(msg, status = 0) {
    alert.style.zIndex = 108000;
    alert.textContent = msg;
    if (status === 1) {
        alert.classList.add("show", "alert-success");
    } else {
        alert.classList.add("show", "alert-danger");
    }
    setTimeout(() => {

        alert.classList.remove("show", "alert-danger", "alert-success");
        alert.style.zIndex = 0;

    }, 1000);
}

document.querySelectorAll("form").forEach(form => {


    // Le button d'envoi est disabled afin d'eviter d'envoyer des formulaires sans changements
    form.querySelector("button[type=submit]").setAttribute("disabled", "disabled");




    // Si l'input change la on peut donner la possibilite de cliquer


    form.querySelector("input[type=file]").addEventListener("change", () => {

        form.querySelector("button[type=submit]").removeAttribute("disabled", "disabled");

    })
    oldName = form.querySelector("input[name=nom]").value;
    // Si l'input change la on peut donner la possibilite de cliquer
    form.querySelector("input[name=nom]").addEventListener("keyup", (e) => {
        if (e.target.value !== oldName) {
            form.querySelector("button[type=submit]").removeAttribute("disabled", "disabled");
        } else {
            form.querySelector("button[type=submit]").setAttribute("disabled", "disabled");
        }



    })




    form.addEventListener("submit", (e) => {
        progress.classList.remove("d-none");
        e.preventDefault();
        let formData = new FormData(e.target);
        const params = {
            body: formData,
            method: "POST"
        }

        fetch(GROUPE_API_URL, params)
            .then(data => data.json())
            .then(data => {
                form.querySelector("button[type=submit]").setAttribute("disabled", "disabled");

                progress.classList.add("d-none");
                if (data.status === 1) {

                    const groupe = JSON.parse(data.message);

                    let contact = document.querySelector("#row" + groupe.id);

                    contact.querySelector("span").textContent = groupe.nom;

                    groupe.image ? contact.querySelector('img')
                        .src = IMAGE_DIRECTORY + groupe.image : '';
                    oldName = groupe.nom;

                    showAlert("Modification effectuee!", 1);


                } else {
                    showAlert(data.message, 1);
                }

            })
            .catch((err) => {
                // console .log(err);
                showAlert("Une erreur s'est produite. Veuillez reessayer!!", 0);
                progress.classList.add("d-none");

            });


    });


    // Pour le chargement de l'image que l'utilisateur voudrais uploader. C'est pour lui montrer comment l'image sera sur le site quand il sera uploade

    form.querySelector('input[type=file]').addEventListener('change', e => {
        const target = e.target;
        let file = target.files[0];
        if (file) {
            progress.classList.remove("d-none");
            const reader = new FileReader();

            reader.onload = (e) => {
                setTimeout(() => {
                    progress.classList.add("d-none");
                }, 1000);

                target.previousElementSibling.querySelector('img').src = e.currentTarget.result;
            }

            reader.readAsDataURL(file);
        }

    });
});



// Fonctions appélées dans GroupeList

function supprimerGroupe(id) {
    if (confirm("Voulez vous vraiment supprimer ce groupe ?")) {

        fetch(GROUPE_API_URL + "?action=delete&id=" + id)
            .then(data => data.json())
            .then(data => {
                if (data.status === 1) {

                    showAlert(data.message, 1);
                    document.querySelector("#row" + id).remove();


                }
            })
            .catch(() => {
                showAlert("Une erreur s'est produite. Veuillez reessayer!!", 0);

            });
    }
}


//  Ajout d'un contact a un groupe  
function ajouterContact(idC) {
    const id = sessionStorage.getItem("idG");
    fetch(`${GROUPE_API_URL}?action=add&idG=${id}&idC=${idC}`)
        .then(data => data.json())
        .then(data => {
            if (data.status === 1) {

                showAlert(data.message, 1);
                // document.querySelector("#row" + id).remove();
            }
            else if (data.status === -1) {
                showAlert(data.message, 0);
            }
        })
        .catch((err) => {
            // console.log(err);
            showAlert("Une erreur s'est produite. Veuillez reessayer!!", 0);

        });
}


function getContacts(id) {
    let contacts = [];
    const contactList = document.querySelector("#contactList");
    fetch(`${CONTACT_API_URL}?id=${id}&action=contacts`)
        .then(data => data.json())
        .then(
            (data) => {
                let contactContent = '';

                contacts = JSON.parse(data.message);
                if (contacts.length >= 1) {

                    contacts.forEach((contact, index) => {

                        contactContent += `<div class="d-flex justify-content-between align-items-center mb-3" id = contact${index}>
                <div class="d-flex align-items-center">
                    <img src=${('/upload/' + contact.photo) || '/src/public/images/profile.svg'} alt="Contact Profile" class="rounded-circle me-2" width="50">
                        <div>
                            <span class="fw-bold d-block"> ${contact.nom} ${contact.prenom} </span >
                            <span class="text-muted" style="font-size:smaller"> ${contact.adresse} </span >
                        </div>
                        </div >
                    <a class="mb-1 btn btn-sm btn-danger" onclick="retirerDuGroupe(${id},${contact.id},${index})">Retirer</a>
                </div> `
                    })
                } else {
                    contactContent = "<p class='text-danger p-2'>Ce groupe ne possede pas de contact</p>";
                }
                contactList.innerHTML = contactContent;
            }
        )
        .catch(err => {
            contactList.innerHTML = "<p class='text-danger p-2'>Une erreur s'est produite</p>";

            // TODO : Envoyer l'erreur au serveur.
            // console.log(err);
        })


}

// Retirer le contact du groupe 
function retirerDuGroupe(idG, idC, index) {
    fetch(`${GROUPE_API_URL}?idC=${idC}&idG=${idG}&action=delete`)
        .then(data => data.json())
        .then(
            (data) => {
                showAlert(data.message, 1);
                document.querySelector('#contact' + index).remove();
            }
        )
        .catch(err => {
            // console.log(err);
        });
}