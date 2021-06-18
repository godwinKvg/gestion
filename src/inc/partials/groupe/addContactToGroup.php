<!-- Contact List Modal -->
<div class="modal fade" id="addToGroup" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="addToGroupLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header py-0">
                <h5 class="modal-title" id="addToGroupLabel">Ajouter Contact au Groupe</h5>
                <i class="bi bi-x-octagon-fill " data-bs-dismiss="modal"
                    style="cursor:pointer; font-size: 2rem;color: green;"></i>
            </div>
            <div class="modal-body h-100">

                <?php
                foreach ($contacts as $c) {
                ?>

                <div class="d-flex justify-content-start align-items-start bg-light mb-2">
                    <div class="rounded-circle mt-1">
                        <img src="<?= $c->photo ? '/upload/' . $c->photo : '/src/public/images/404.svg' ?>"
                            alt="COntact image" width="50px" height="50px" class="me-2">
                    </div>
                    <div class="d-flex justify-content-between w-75">
                        <div>
                            <span class="text-bold d-block"><?= $c->prenom . ' ' . $c->nom ?></span>
                            <span class="text-muted" style="font-size: smaller;"><?= $c->adresse ?></span>
                        </div>
                        <div class="mb-2">
                            <a class="btn rounded-0 btn-primary btn-sm"
                                onclick="ajouterContact(<?= $c->id ?>)">Ajouter</a>
                        </div>

                    </div>
                </div>

                <?php } ?>
            </div>
        </div>
    </div>
</div>