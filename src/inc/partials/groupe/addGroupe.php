<div class="d-flex -align-items-center justify-content-center flex-column h-100" style="background: url(src/public/images/bg.jpeg);background-repeat:no-repeat;background-size:cover">
    <h3 class="text-center text-white mt-3">Creation de Contact</h3>
    <form method="POST" id="addForm" enctype="multipart/form-data">

        <div class="d-flex align-items-center flex-column text-white">
            <label for="photo" class="form-label text-white mb-3">
                <img src="/src/public/images/groupe.png" alt="Conact Profile" class="visuall-hidden rounded-circle" width="80" height="80">
            </label>
            <input type="file" name="photo" id="photo" accept="image/*">
        </div>
        <div class="mt-2 d-flex justify-content-center">
            <input type="text" class="form-control w-50" placeholder="Nom du Groupe" id="nom" name="nom" required>
        </div>


        <div class=" mt-2 text-center">
            <a type="button" class="btn btn-warning me-2" href="/groupe">Liste Groupe</a>
            <button type="submit" class="btn btn-success">Creer</button>
        </div>
    </form>
</div>