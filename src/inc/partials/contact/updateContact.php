<!-- Modal -->
<div class="modal fade" id="updateContact" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="updateLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">

            <div class="modal-body position-relative">
                <div id="updateAlert" class="alert position-fixed top-25 start-25 fade hide"></div>
                <form method="POST">
                    <h3 class="text-center">Mise à Jour</h3>
                    <div class="row">

                        <input type="text" name="id" hidden id="id">
                        <div class="col-md-12">
                            <div class="d-flex align-items-center flex-column">
                                <label for="photo" class="form-label">
                                    <img src="src/public/images/profile.svg" alt="Conact Profile" class="visuall-hidden rounded-circle" width="70px" height="70px">
                                </label>
                                <input type="file" id="photo" accept="image/*" name="photo">
                            </div>
                        </div>
                        <div class="col-md-6 mt-2">
                            <div class="form-group">
                                <label for="nom" class="form-label">Nom</label>
                                <input type="text" class="form-control" id="nom" name="nom">
                            </div>
                        </div>
                        <div class="col-md-6 mt-2">
                            <div class="form-group">
                                <label for="prenom" class="form-label">Prenom(s)</label>
                                <input type="text" class="form-control" id="prenom" name="prenom">
                            </div>
                        </div>
                        <div class="col-md-6 mt-2">

                            <div class="form-group">
                                <label for="telephone1" class="form-label">telephone1</label>
                                <input type="tel" class="form-control" id="telephone1" name="telephone1">
                            </div>
                        </div>
                        <div class="col-md-6 mt-2">

                            <div class="form-group">
                                <label for="telephone2" class="form-label">telephone2</label>
                                <input type="tel" class="form-control" id="telephone2" name="telephone2">

                            </div>
                        </div>
                        <div class="col-md-6 mt-2">

                            <div class="form-group">
                                <label for="email_perso" class="form-label">Email personnel</label>
                                <input type="email" class="form-control" id="email_perso" name="email_perso">
                            </div>
                        </div>
                        <div class="col-md-6 mt-2">

                            <div class="form-group">
                                <label for="email_pro" class="form-label">Email professionnel</label>
                                <input type="email" class="form-control" id="email_pro" name="email_pro">
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6 mt-2">

                        <label for="adresse" class="form-label">adresse</label>
                        <input type="text" class="form-control" id="adresse" required name="adresse">

                    </div>
                    <div class="col-md-6 mt-2">

                        <label for="genre" class="form-label">Genre</label>
                        <div>
                            <input type="radio" value="homme" id="homme" required name="genre">
                            <label for="homme">Homme</label>
                        </div>
                        <div>
                            <input type="radio" value="femme" id="femme" required name="genre">
                            <label for="femme">Femme</label>

                        </div>
                    </div>

                    <div class="mt-2">
                        <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-success">Enregistrer</button>
                    </div>
                </form>

            </div>

        </div>
    </div>

</div>