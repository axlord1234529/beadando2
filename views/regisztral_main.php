<h2>Regisztráció</h2>
<form action="<?= SITE_ROOT ?>regisztral" method="post">
<label for="csaladi_nev">Családi Név:</label>
    <input type="text" id="csaladi_nev" name="csaladi_nev" required><br><br>

    <label for="utonev">Utónév:</label>
    <input type="text" id="utonev" name="utonev" required><br><br>

    <label for="bejelentkezes">Bejelentkezés:</label>
    <input type="text" id="bejelentkezes" name="bejelentkezes" required><br><br>

    <label for="jelszo">Jelszó:</label>
    <input type="password" id="jelszo" name="jelszo" required><br><br>

    <input type="submit" value="Küldés">
</form>
<h2><br><?= (isset($viewData['uzenet']) ? $viewData['uzenet'] : "") ?><br></h2>
