<?php

class AdminProductManager
{

    public static function CreateView()
    {
        $errors = [];

        if (!empty($_POST)) {

            $name = $_POST['name'];
            $description = $_POST['description'];
            $color = $_POST['color'];
            $price = intval($_POST['price']);

            if (empty($name))
                array_push($errors, "Le nom du dé doit être rempli.");
            if (empty($description))
                array_push($errors, "La description doit être remplie.");
            if (empty($color))
                array_push($errors, "La couleur doit être renseignée.");
            if (empty($price))
                array_push($errors, "Vous devez définir un prix.");

            // FILE UPLOAD
            $photoFile = $_FILES['photo'];

            if (empty($photoFile))
                array_push($errors, "Vous devez envoyer une image");

            // If there are no errors
            if ($photoFile['error'] === 0) {
                $targetPath = './Views/img/products/';
                $uniqueID = uniqid('', TRUE);

                // Retrieving original file extension
                $extension = explode('/', $photoFile['type']);
                $extensionFile = $extension[1];

                if ((strtolower($extensionFile) == 'jpg' || strtolower($extensionFile) == 'png' || strtolower($extensionFile) == 'jpeg') && empty($errors)) {
                    $targetFile = $targetPath . $uniqueID . '.' . $extensionFile;

                    // moving file to correct folder
                    move_uploaded_file($photoFile['tmp_name'], $targetFile);
                } else {
                    array_push($errors, "Votre fichier doit être au format JPG/JPEG ou PNG.");
                }
            } else {
                array_push($errors, "Il y a eu une erreur lors du téléchargement de votre fichier. Veuillez réessayer.");
            }

            if (empty($errors)) {
                $filePath = explode('Views', $targetFile);
                $pathData = $filePath[1];

                $model = new ProductModel();
                $model->addProduct($name, $description, $color, $price, $pathData);

                header('Location: ./admin-products');
                exit();
            }
        }

        $variables = compact('errors');

        Utils::render('AdminProductManager', $variables);
    }
}
