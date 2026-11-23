<?php
// Ouverture d'un script PHP avec <?php ... //?//> (vu dans le slide 58)

// Tableau associatif de tableaux associatifs :
// clé = nom du serveur, valeur = tableau avec cpu, ram et status (vu dans le slides 64)
$serveurs = array(
    'api-01'   => array('cpu' => 45, 'ram' => 60, 'status' => '1'),
    'api-02'   => array('cpu' => 92, 'ram' => 78, 'status' => '1'),
    'db-prod'  => array('cpu' => 70, 'ram' => 95, 'status' => '1'),
    'web-01'   => array('cpu' => 30, 'ram' => 40, 'status' => '1'),
    'web-02'   => array('cpu' => 55, 'ram' => 65, 'status' => '0'),
    'cache-01' => array('cpu' => 88, 'ram' => 92, 'status' => '1')
);

// Fonction avec paramètres et retour (vu dans le slide 71)
function calculerScore($cpu, $ram) {
    // Opérateurs arithmétiques + - / (vu dans le slide 66)
    // score = 100 - (cpu + ram) / 2
    return 100 - ($cpu + $ram) / 2;
}

// Fonction qui renvoie un booléen (vu dans le slide 71)
function estCritique($cpu, $ram) {
    // Opérateurs relationnels > et opérateur logique || (OU) (vu dans le slide 66)
    return $cpu > 85 || $ram > 90;
}

// Variables initialisées pour le résumé (vu dans le slide 60)
// Ces variables sont globales, et on les utilise hors des fonctions (portée : slide 73)
$totalOnline   = 0;   // compteur de serveurs online
$sommeScores   = 0;   // somme des scores pour la moyenne
$meilleurNom   = "";  // nom du meilleur serveur
$meilleurScore = -1;  // meilleur score trouvé
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Monitoring de serveurs</title>
</head>
<body>
    <!-- Tableau HTML avec id="table1" et border="1" (énoncé du TP, slide 8) -->
    <table id="table1" border="1">
        <tr>
            <th>Serveur</th>
            <th>CPU%</th>
            <th>RAM%</th>
            <th>Status</th>
            <th>Score</th>
            <th>État</th>
        </tr>
        <?php
        // PHP mélangé avec du HTML (vu dans les slides 27 et 58)

        // Boucle foreach sur un tableau associatif : $nom = clé, $infos = valeur (vu dans le slide 69)
        foreach ($serveurs as $nom => $infos) {

            // Accès aux éléments d'un tableau associatif par leur clé (vu dans le slide 64)
            $cpu = $infos['cpu'];
            $ram = $infos['ram'];

            // Appel d'une fonction (vu dans le slide 71)
            $score = calculerScore($cpu, $ram);

            // Condition if / else (vu dans le slide 67)
            // Opérateur d'égalité == (vu dans le slide 66)
            if ($infos['status'] == "1") {
                $statusTexte = "online";
                // Opérateur d'incrémentation ++ (vu dans le slide 66)
                $totalOnline++;
            } else {
                $statusTexte = "offline";
            }

            // Condition if / elseif / else (vu dans le slide 67)
            if (estCritique($cpu, $ram)) {
                $etat = "CRITIQUE";
            } elseif ($score >= 50) {
                $etat = "OK";
            } else {
                $etat = "ATTENTION";
            }

            // Couleur de fond conditionnelle de la ligne (if / elseif / else : slide 67)
            if ($statusTexte == "offline") {
                $couleur = "rgb(200,200,200)";   // gris : serveur offline
            } elseif ($etat == "CRITIQUE") {
                $couleur = "rgb(255,180,180)";   // rouge : état critique
            } elseif ($score >= 50) {
                $couleur = "rgb(180,255,180)";   // vert : score >= 50
            } else {
                $couleur = "rgb(255,220,150)";   // orange : sinon
            }

            // Cumul des scores pour calculer la moyenne (opérateur arithmétique : slide 66)
            $sommeScores = $sommeScores + $score;

            // Recherche du meilleur score avec une condition (slide 67) et un opérateur > (slide 66)
            if ($score > $meilleurScore) {
                $meilleurScore = $score;
                $meilleurNom   = $nom;
            }

            // echo génère les lignes HTML dynamiquement (vu dans les slides 25, 26 et 27)
            // Guillemets doubles : les variables sont remplacées par leur valeur (vu dans le slide 61)
            // CSS inline avec l'attribut style, comme demandé dans l'énoncé
            echo "<tr class=\"row\" style=\"background-color:$couleur;\">";
            echo "<td class=\"serveur\">$nom</td>";
            echo "<td class=\"cpu\">$cpu</td>";
            echo "<td class=\"ram\">$ram</td>";
            echo "<td class=\"status\">$statusTexte</td>";
            echo "<td class=\"score\">$score</td>";
            echo "<td class=\"etat\">$etat</td>";
            echo "</tr>";
        }

        // count() donne le nombre d'éléments du tableau (vu dans le slide 65)
        // Division pour calculer la moyenne (opérateur arithmétique : slide 66)
        $scoreMoyen = $sommeScores / count($serveurs);
        ?>
    </table>

    <h3>Résumé</h3>
    <!-- echo pour afficher les valeurs calculées (vu dans le slide 25) -->
    <!-- Les id demandés par l'énoncé : total_online_servers, moy_scores, best_serv (slide 8) -->
    <p>Serveurs online: <span id="total_online_servers"><?php echo $totalOnline; ?></span></p>
    <p>Score moyen: <span id="moy_scores"><?php echo $scoreMoyen; ?></span></p>
    <!-- Concaténation avec le point . (vu dans le slide 60) -->
    <p>Meilleur serveur: <span id="best_serv"><?php echo $meilleurNom . " (" . $meilleurScore . ")"; ?></span></p>
</body>
</html>