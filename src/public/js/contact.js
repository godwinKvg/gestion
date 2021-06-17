    
const CONTACT_API_URL = 'src/api/gestionContact.php';
const GROUPE_API_URL = 'src/api/gestionGroupe.php';
const IMAGE_DIRECTORY = "/upload/";
const PUBLIC_DIRECTORY = "src/public/images/profile.svg";

const updateAlert = document.querySelector('#updateAlert');
const deleteAlert = document.querySelector('#deleteAlert');
const alerts = document.querySelectorAll('.alert');

alerts.forEach(elt => {
    elt.classList.add('hide');
});

const progress = document.querySelector('.progress');


// Gestion des formulaires
const updateModal = document.querySelector('#updateContact');

const updateFrom = updateModal.querySelector('form');

updateFrom.addEventListener('submit', (e) => {
    updateFrom.querySelector("button[type=submit]").setAttribute("disabled", "disabled");
    progress.classList.remove("d-none");
    e.preventDefault();
    e.stopPropagation();
    let formData = new FormData(e.target);
    const params = {
        body: formData,
        method: "POST"
    }

    fetch(CONTACT_API_URL, params)
        .then(data => data.json())
        .then(data => {
            progress.classList.add("d-none");

            if (data.status === 200) {
                document.querySelector('a[data-bs-target="#updateContact"]')
                    .setAttribute("data-contact", data.message);

                const contact = JSON.parse(data.message);

                let contactRow = document.querySelector("#row" + JSON.parse(data.message).id);


                JSON.parse(data.message).photo ? contactRow.querySelector('img')
                    .src = IMAGE_DIRECTORY + JSON.parse(data.message).photo : '';


                const contactRowList = contactRow.querySelectorAll('td');
                contactRowList[1].textContent = contact.nom;
                contactRowList[2].textContent = contact.prenom;
                contactRowList[3].textContent = contact.telephone1;
                contactRowList[4].textContent = contact.telephone2;
                contactRowList[5].textContent = contact.email_perso;
                contactRowList[6].textContent = contact.email_pro;
                contactRowList[7].textContent = contact.adresse;
                contactRowList[8].textContent = contact.genre;

                document.querySelector("a[data-contact]").setAttribute('data-contact', JSON.stringify(
                    contact))
                updateAlert.textContent = "Modification Effectuée";
                updateAlert.classList.add("show", "alert-success");
                setTimeout(() => {
                    updateAlert.classList.remove("show")
                }, 1000);


                updateFrom.querySelector("button[type=submit]").removeAttribute("disabled");

            } else {
                console.log(data.message);

                updateAlert.textContent = data.message;
                updateAlert.classList.add("show", "alert-danger");
                setTimeout(() => {
                    updateAlert.classList.remove("show")
                }, 1000);
            }

        })
        .catch(err => console.log(err));

})

updateFrom?.querySelector('input[type=file]').addEventListener('change', e => {

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


// Fonctions appélées dans ContactList


function modifierContact(e) {
    e.stopPropagation();

    const contact = JSON.parse(e.target.getAttribute("data-contact"));


    // Remplir le Modal avec les infos du contact
    const form = updateFrom;

    if (contact.photo) {
        form.querySelector("img").src = IMAGE_DIRECTORY + contact.photo;
    }

    form.querySelector("input#id").value = contact.id;
    form.querySelector("input#nom").value = contact.nom;
    form.querySelector("input#prenom").value = contact.prenom;
    form.querySelector("input#telephone1").value = contact.telephone1;
    form.querySelector("input#telephone2").value = contact.telephone2;
    form.querySelector("input#email_perso").value = contact.email_perso;
    form.querySelector("input#email_pro").value = contact.email_pro;
    form.querySelector("input#adresse").value = contact.adresse;
    form.querySelectorAll("input[name=genre]").forEach(
        input => {
            input.value == contact.genre ? input.setAttribute("checked", "checked") : '';
        }
    )

}

function supprimerContact(id) {
    if (confirm("Voulez vous vraiment supprimer ce contact ?")) {

        fetch(CONTACT_API_URL + "?action=delete&id=" + id)
            .then(data => data.json())
            .then(data => {
                if (data.status === 200) {
                    console.log(data.message);
                    document.querySelector("#row" + id).remove();
                }
            })
            .catch(err => console.log(err));
    }
}

// Appel au serveur puis récuperation des groupes
function getGroups(id) {
let groups=[];
    fetch(GROUPE_API_URL + "?idC=" + id)
    .then(data=>data.json())
    .then(
       (data)=>{
            groups = data;

        console.log(data);
       }
    )
    .catch(err=>{

        // TODO : Envoyer l'erreur au serveur.
        // console.log(err);
    })


    

    const groupList = document.querySelector("#groupList");
    let groupContent = '';
    groups.forEach(group => {

        groupContent += `<div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex align-items-center">
                            <img src=" ${ group.photo ? '/upload/' . group.photo : '/src/public/images/profile.svg'}" alt="Contact Profile" class="rounded-circle me-2" width="50">
                            <span class="fw-bold"> ${group.nom} </span>
                        </div>
                        <a class="mb-1 btn btn-sm btn-danger supprimer" onclick="retirerDuGroupe(${group.id})">Retirer</a>
                    </div>`
    })
    groupList.innerHTML = groupContent;


}



function retirerDuGroupe(id) {
    console.log(id);
}
