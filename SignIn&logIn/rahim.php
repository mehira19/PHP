<!DOCTYPE html>
<html>

<head>
    <script src="./js/fetchUtil.js"></script>
    <script src="./js/authentifcation.js"></script>
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <ul>
        <li><a class="active" href="#home">BLIZZARD</a></li>
        <li class="dropdown">
            <a href="javascript:void(0)" class="dropbtn">Inscription</a>
            <div class="dropdown-content">
                <form method="POST" id="inscription">
                    <label for="pseudo">Pseudo :</label>
                    <input type="text" placeholder="votre pseudo " id="pseudo " name="pseudo" />

                    <table>
                        <tr>
                            <td align="right">
                            </td>
                            <td>
                            </td>
                        </tr>

                        <tr>
                            <td align=" right">
                                <label for="motDePasse">Mot de passe :</label>
                            </td>
                            <td>
                                <input type="password" placeholder=" votre mot de passe" id="motDePasse " name="password" />
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td align="center">
                                <br>
                                <input type="submit" name="form" value="Je m'inscris" />
                            </td>
                        </tr>
                    </table>
                    <br> <br>

                </form>
            </div>
        </li>
        <li class="dropdown">
            <a href="javascript:void(0)" class="dropbtn">Connexion</a>
            <div class="dropdown-content">
                <form method="POST" id="connexion">
                    <table>
                        <tr>
                            <td align="right">
                                <label for="pseudo">Pseudo :</label>
                            </td>
                            <td>
                                <input type="text" placeholder="votre pseudo " id="pseudo " name="pseudo" />
                            </td>
                        </tr>

                        <tr>
                            <td align=" right">
                                <label for="motDePasse">Mot de passe :</label>
                            </td>
                            <td>
                                <input type="password" placeholder=" votre mot de passe" id="motDePasse " name="password" />
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td align="center">
                                <br>
                                <input type="submit" name="form" value="Se connecter" />
                            </td>
                        </tr>
                    </table>
                    <br> <br>

                </form>
            </div>
        </li>
    </ul>

</body>


</html>