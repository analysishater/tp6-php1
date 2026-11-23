<?php
// Ouverture d'un script PHP avec <?php ... //?//> (vu dans le slide 58)

// Déclaration d'un tableau associatif : clé = nom, valeur = moyenne (vu dans le slide 64)
// Utilisation de variables avec le signe $ (vu dans le slide 60)
$etudiantsNote = array(
    'JOHN'   => 9,
    'BOB'    => 15.5,
    'RAYANE' => 7,
    'ROSIE'  => 13
);

// Déclaration d'une fonction avec paramètre et retour (vu dans le slide 71)
function estAdmissible($note) {
    // Opérateur relationnel >= (vu dans le slide 66)
    // return renvoie un booléen : true si note >= 10 (vu dans les slides 60 et 71)
    return $note >= 10;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Etudiants-Note</title>
</head>
<body>
    <!-- Tableau HTML avec id="table1" et border="1" (énoncé du TP, slide 4) -->
    <table id="table1" border="1">
        <tr>
            <th>Etudiant</th>
            <th>Note</th>
        </tr>
        <?php
        // PHP mélangé avec du HTML : le script est placé là où on en a besoin (vu dans les slides 27 et 58)

        // Boucle foreach sur un tableau associatif : $nom = clé, $note = valeur (vu dans le slide 69)
        foreach ($etudiantsNote as $nom => $note) {

            // Condition if / else (vu dans le slide 67)
            // Appel de la fonction estAdmissible() (vu dans le slide 71)
            if (estAdmissible($note)) {
                $couleur = "rgb(136,248,136)"; // vert (variable : slide 60)
            } else {
                $couleur = "rgb(251,173,173)"; // rouge
            }

            // echo sert à afficher du HTML généré dynamiquement (vu dans les slides 25 et 26)
            // Les guillemets doubles permettent d'insérer les variables dans la chaîne (vu dans le slide 61)
            // CSS inline avec l'attribut style, comme demandé dans l'énoncé
            echo "<tr class=\"row\">";
            echo "<td class=\"etud\">$nom</td>";
            echo "<td class=\"note\" style=\"background-color:$couleur;\">$note</td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>