<div class="alert alert-warning hide fade  position-fixed top-25 end-0 translate-middle-y" id="alert">Papa</div>
<div class="mx-2 mt-3 table-responsive">

    <table class="table table-success table-striped  rounded table-hover table-sm">
        <thead class="table-dark">
            <tr>
                <th scope="col">Photo</th>
                <th scope="col">Nom</th>
                <th scope="col">Prenom</th>
                <th scope="col">Telephone1</th>
                <th scope="col">Telephone2</th>
                <th scope="col">Email Personnel</th>
                <th scope="col">Email Professionnel</th>
                <th scope="col">Adresse</th>
                <th scope="col">Genre</th>
                <th scope="col">Actions</th>

            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($contacts as $c) {

            ?>
            <tr id="row<?= $c->id ?>">
                <td>
                    <img src="<?= $c->photo ? '/upload/' . $c->photo : '/src/public/images/profile.svg' ?>"
                        alt="Contact Profile" class="rounded-circle" width="50" height="50">
                </td>
                <td>
                    <?= $c->nom ?>
                </td>
                <td>
                    <?= $c->prenom ?>
                </td>
                <td>
                    <?= $c->telephone1  ?>
                </td>
                <td>
                    <?= $c->telephone2 ?>

                </td>
                <td>
                    <?= $c->email_perso ?>
                </td>
                <td>
                    <?= $c->email_perso  ?>
                </td>
                <td>
                    <?= $c->adresse ?>
                </td>
                <td>
                    <?= $c->genre ?>
                </td>
                <td>
                    <div class="d-flex flex-column justify-content-between">
                        <a href="#" class="mb-1 btn btn-sm btn-outline-primary modifier" data-bs-toggle="modal"
                            data-bs-target="#updateContact" data-contact='<?= json_encode($c) ?>'
                            onclick="modifierContact(event)">Modifier</a>
                        <a class="mb-1 btn btn-sm btn-danger supprimer"
                            onclick="supprimerContact(<?= $c->id ?>)">Supprimer</a>
                        <a class=" btn btn-sm btn-outline-success" data-bs-toggle="modal"
                            data-bs-target="#contactGroups" onclick="getGroups(<?= $c->id ?>)">Groupes</a>
                    </div>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <a class=" btn btn-sm btn-outline-primary my-2" href="/addContact">Ajouter Contact</a>


</div>
<style>
td,
tr {
    font-size: large;
    text-align: center;
    vertical-align: middle
}
</style>