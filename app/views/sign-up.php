<section class="right-section-home marg-main-home-right-section">
    <div class="form-groupe">
        <h1> <strong>Cinetic</strong></h1>
        <h3>Créer un compte GRATUIT</h3>
        <form id="form-signup">
            <div class="backup"></div>

            <label style="display: none;">Nom</label>
            <input type="text" name="lastname" placeholder="Nom">

            <label style="display: none;">Nom</label>
            <input type="text" name="firstname" placeholder="Prénom">

            <label style="display: none;">email</label>
            <input type="email" id="email" name="email" placeholder="Adresse email">

            <label style="display: none;">Date de naissance</label>
            <input type="text" onfocus="(this.type='date')" name="birthday" placeholder="Date de naissance">

            <label style="display: none;">Genre</label>
            <select name="sexe">
                <option value="">Quel est votre genre ?</option>
                <option value="H">Homme</option>
                <option value="F">Femme</option>
            </select>

            <label style="display: none;">Mot de passe</label>
            <input type="password" id="password" name="password" placeholder="Mot de passe">

            <label style="display: none;">Mot de passe</label>
            <input type="password"  id="cpassword" name="cpassword" placeholder="Confirmer mot de passe">

            <div class="pwd-forget-containe">
                <p>En cliquant sur « Créer un compte » ou en vous inscrivant, vous acceptez les Conditions d'utilisation et l'Avis de confidentialité. Vous consentez également à recevoir par email des informations et des offres concernant nos services. Vous pouvez vous désabonner à tout moment de ces emails sur la page Mon compte.</p>
            </div><br>
            <input type="submit" value="Créer un compte" class="is-ibtn is-black">
            <hr>
            <a href="?p=sign-in" class="is-ibtn is-red w-100">Se connecter</a>

        </form>
    </div>
</section>