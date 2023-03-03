<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" type="text/css">
    <title>Upload File Exercice</title>
</head>

<body>

    <?php
    // Je vérifie que le formulaire est soumis, comme pour tout traitement de formulaire.
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // chemin vers un dossier sur le serveur qui va recevoir les fichiers transférés (attention ce dossier doit être accessible en écriture)
        $uploadDir = 'uploads/';

        // le nom de fichier sur le serveur est celui du nom d'origine du fichier sur le poste du client (mais d'autres stratégies de nommage sont possibles)
        $uploadFile = $uploadDir . basename($_FILES['avatar']['name']);

        // Je récupère l'extension du fichier
        $extension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);

        // Les extensions autorisées
        $authorizedExtensions = ['jpg', 'png', 'gif', 'webp'];

        // Le poids max géré par PHP par défaut est de 2M
        $maxFileSize = 1000000;

        // Je sécurise et effectue mes tests

        /****** Si l'extension est autorisée *************/
        if ((!in_array($extension, $authorizedExtensions))) {
            $errors[] = 'Veuillez sélectionner une image de type Jpg ou Png ou gif ou webp!';
        }

        /****** On vérifie si l'image existe et si le poids est autorisé en octets *************/
        if (file_exists($_FILES['avatar']['tmp_name']) && filesize($_FILES['avatar']['tmp_name']) > $maxFileSize) {
            $errors[] = "Votre fichier doit faire moins de 1M !";
        }

        // on déplace le fichier temporaire vers le nouvel emplacement sur le serveur. Ça y est, le fichier est uploadé
        move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadFile);
    }

    ?>

    <section>
        <h2>SPRINGFIELD, IL</h2>
        <table>
            <tr>
                <th>LICENSE#</th>
                <th>BIRTH DATE</th>
                <th>EXPIRES</th>
                <th>CLASS</th>
            </tr>
            <tr>
                <td>64209</td>
                <td>4-24-56</td>
                <td>4-24-2015</td>
                <td>NONE</td>
            </tr>
        </table>
        <div>

            <?php
            if ($_FILES['avatar'] === null) {
                echo '<img src="/uploads/php.png">';
            } else {
                echo '<img src="/uploads/' . $_FILES['avatar']['name'] . '">';
            }
            ?>
            <div>
                <h3>DRIVERS LICENSE</h3>
                <p>
                    HOMER SIMPSON<br>
                    69 OLD PLUMTREE BLVD<br>
                    SPRINGFIELD, IL 62701<br>
                </p>
                <table>
                    <tr>
                        <th>SEX</th>
                        <th>HEIGHT</th>
                        <th>WEIGHT</th>
                        <th>HAIR</th>
                        <th>EYES</th>
                    </tr>
                    <tr>
                        <td>OK</td>
                        <td>MEDIUM</td>
                        <td>239</td>
                        <td>NONE</td>
                        <td>OVAL</td>
                    </tr>
                </table>
            </div>
        </div>
    </section>

    <form method="post" enctype="multipart/form-data">
        <label for="imageUpload">Upload an profile image</label>
        <input type="file" name="avatar" id="imageUpload" />
        <button name="send">Send</button>
    </form>
</body>

</html>