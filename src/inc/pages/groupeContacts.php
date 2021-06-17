<div class="container">
    <form class="d-flex mt-2 w-50" method="get">
        <select class="form-select form-select-sm me-2" aria-label=".form-select-sm example">

            <?php
            foreach ($groups as $g) {
            ?>
            <option value="<?= $g->id ?>"><?=$g->nom?></option>
            <?php }?>
        </select>
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
</div>