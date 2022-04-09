<form action="controllers/signup.php" method="POST">
    <table>
        <tr>
            <td>nom</td>
            <td>
                <input type="text" name="lastname">
            </td>
        </tr>
        <tr>
            <td>prénom</td>
            <td>
                <input type="text" name="firstname">
            </td>
        </tr>
        <tr>
            <td>email</td>
            <td>
                <input type="text" name="email">
            </td>
        </tr>
        <tr>
            <td>data de naissance</td>
            <td>
                <input type="date" name="birthday">
            </td>
        </tr>
        <tr>
            <td>sexe</td>
            <td>
                <select name="sexe">
                    <option value="H">Homme</option>
                    <option value="F">Femme</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>mot de passe</td>
            <td>
                <input type="password" name="password">
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <br>
                <input type="submit" value="S'inscrire">
            </td>
        </tr>
    </table>
</form>

<?php 
    print_r($usr->getUsers());
?>