<div class="container">
    <h3 class="text-center mt-3">Creation de Contact</h3>
    <form method="POST" id="addForm" enctype="multipart/form-data">
        <div class="row">

            <div class="col-md-12">
                <div class="d-flex align-items-center flex-column">
                    <label for="photo" class="form-label">
                        <img src="/src/public/images/profile.svg" alt="Conact Profile"
                            class="visuall-hidden rounded-circle" width="80" height="80">
                    </label>
                    <input type="file" name="photo" id="photo" accept="image/*">
                </div>
            </div>
            <div class="col-md-6 mt-2">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" required>
            </div>
            <div class="col-md-6 mt-2">
                <label for="prenom" class="form-label">Prenom(s)</label>
                <input type="text" class="form-control" id="prenom" name="prenom" required>
            </div>
            <div class="col-md-6 mt-2">

                <label for="telephone1" class="form-label">telephone1</label>
                <input type="text" class="form-control" id="telephone1" name="telephone1" required>
            </div>
            <div class="col-md-6 mt-2">

                <label for="telephone2" class="form-label">telephone2</label>
                <input type="text" class="form-control" id="telephone2" name="telephone2">

            </div>
            <div class="col-md-6 mt-2">

                <label for="email_perso" class="form-label">Email personnel</label>
                <input type="email" class="form-control" id="email_perso" name="email_perso">
            </div>
            <div class="col-md-6 mt-2">

                <label for="email_pro" class="form-label">Email professionnel</label>
                <input type="email" class="form-control" id="email_pro" name="email_pro" required>
            </div>
            <div class="col-md-6 mt-2">

                <label for="adresse" class="form-label">adresse</label>
                <input type="text" class="form-control" id="adresse" name="adresse" required>
                <div class="invalid-feedback">Obligatoire!!</div>

            </div>
            <div class="col-md-6 mt-2">

                <label for="genre" class="form-label">Genre</label>
                <div>
                    <input type="radio" value="homme" name="genre" id="homme" required>
                    <label for="homme">Homme</label>
                </div>
                <div>
                    <input type="radio" value="femme" name="genre" id="femme" required>
                    <label for="femme">Femme</label>

                </div>
            </div>

        </div>


        <div class="mt-2">
            <a type="button" class="btn btn-warning" href="/">Retour</a>
            <button type="submit" class="btn btn-success">Creer</button>
        </div>
    </form>
</div>