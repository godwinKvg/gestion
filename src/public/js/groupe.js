
const GROUPE_API_URL = 'src/api/gestionGroupe.php';
const IMAGE_DIRECTORY = "/upload/";
const PUBLIC_DIRECTORY = "src/public/images/groupe.png";

let alert = document.querySelector('#alert');

const progress = document.querySelector('.progress');

function showAlert(msg, status = 1) {
    alert.textContent = msg;
    if (status) {
        alert.classList.add("show", "alert-success");
    } else {
        alert.classList.add("show", "alert-danger");
    }
    setTimeout(() => {
        alert.classList.remove("show")
    }, 3000);
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
                if (data.status === 200) {

                    const groupe = JSON.parse(data.message);

                    let group = document.querySelector("#row" + groupe.id);

                    group.querySelector("span").textContent = groupe.nom;

                    groupe.image ? group.querySelector('img')
                        .src = IMAGE_DIRECTORY + groupe.image : '';
                    oldName = groupe.nom;

                    showAlert("Modification effectuee!", 1);
                    console.log('fait');


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
                if (data.status === 200) {

                    showAlert(data.message);
                    document.querySelector("#row" + id).remove();


                }
            })
            .catch(() => {
                showAlert("Une erreur s'est produite. Veuillez reessayer!!");

            });
    }
}