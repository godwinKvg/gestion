<div class="container">


    <div class=" d-flex flex-wrap justify-content-start">
        <div class="alert position-absolute fade hide " style="right:20px;top:15%" id="alert">
        </div>
        <?php

        foreach ($groups as $g) {
        ?>
        <div class="text-center me-2 my-2 d-flex flex-column justify-content-between bg-dark p-2 text-white"
            id="row<?= $g->id ?>" style="min-width:200px;min-height:200px">
            <div>
                <img src="<?= $g->image ? '/upload/' . $g->image : '/src/public/images/groupe.ico' ?>" alt="Groupe icon"
                    class="rounded-circle" style="width:100px;  height: auto;">
            </div>
            <div class="d-flex flex-column justify-content-center align-items-between">
                <span class="my-2 fw-bold mb-2 p-1 border "> <?= $g->nom ?> </span>
                <div class="d-flex justify-content-between mb-2">
                    <a href="#" class="btn btn-sm btn-primary me-1" data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop<?= $g->id ?>">Modifier</a>
                    <a class="btn btn-sm btn-danger" onclick=supprimerGroupe(<?= $g->id ?>)>Supprimer</a>
                </div>
                <a data-bs-toggle="modal" data-bs-target="#addToGroup"
                    onclick="sessionStorage.setItem('idG',<?= $g->id ?>)" class="btn btn-sm btn-warning mb-2">Ajouter
                    Contact </a>
                <a class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#groupeContacts"
                    onclick="getContacts(<?= $g->id ?>)">Contacts</a>

            </div>
        </div>



        <!-- Modal pour la modification des groupes -->
        <div class="modal fade" id="staticBackdrop<?= $g->id ?>" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header py-0">
                        <h5 class="modal-title" id="staticBackdropLabel<?= $g->id ?>">Modifier Groupe</h5>
                        <i class="bi bi-x-octagon-fill " data-bs-dismiss="modal"
                            style="cursor:pointer; font-size: 2rem;color: green;"></i>
                    </div>
                    <div class="modal-body d-flex -align-items-center justify-content-center flex-column h-100"
                        style="background: url(src/public/images/bg.jpeg);background-repeat:no-repeat;background-size:cover">


                        <form method="POST" id="addForm<?= $g->id ?>" enctype="multipart/form-data">

                            <div class="d-flex align-items-center flex-column text-white">
                                <input type="hidden" name="id" value="<?= $g->id ?>">
                                <label for="photo" class="form-label text-white mb-3">
                                    <img src="<?= $g->image ? '/upload/' . $g->image : '/src/public/images/groupe.ico' ?>"
                                        alt="Groupe Icon" class="visuall-hidden rounded-circle" width="80" height="80">
                                </label>
                                <input type="file" name="photo" id="photo<?= $g->id ?>" accept="image/*">
                            </div>
                            <div class="mt-2 d-flex justify-content-center">
                                <input type="text" class="form-control w-50 me-2" placeholder="Nom du Groupe" name="nom"
                                    value="<?= $g->nom ?>" required>
                                <button type="submit" class="btn btn-sm  btn-success">Modifier</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>



    <a class="btn btn-primary my-2" href="/addGroupe">Ajouter Groupe</a>
</div>