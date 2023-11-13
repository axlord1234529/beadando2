<h1>Admin</h1>

<form>
        <label for="szereloSelect">Szerelő:</label>
        <select id="szereloSelect" name="szerelo">
        <?php
            foreach ($viewData['szerelok'] as $item) {
                echo '<option value="' . $item['nev'] . '">' . $item['nev'] . '</option>';
            }
        ?>
        </select>
        <br>
        <label for="telepulesSelect">Település:</label>
        <select id="telepulesSelect" name="telepules">
        <?php
            foreach ($viewData['telepulesek'] as $item) {
                echo '<option value="' . $item['telepules'] . '">' . $item['telepules'] . '</option>';
            }
        ?>
        </select>
        <br>
        <label for="datum">Javítás dátum:</label>
        <input type="date" id="datum" value="<?=$viewData['minDatum']?>" min="<?=$viewData['minDatum']?>" max="<?=$viewData['maxDatum']?>">
        <br>
</form>
<button id="fetchData">Adatok lekérése</button>
    <div id="result"></div>
    <script src="<?php echo SITE_ROOT?>scripts/admin.js"></script>