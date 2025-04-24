<?php
// Lista degli hotel
$hotels = [
    [
        'name' => 'Hotel Belvedere',
        'description' => 'Hotel Belvedere Descrizione',
        'parking' => true,
        'vote' => 4,
        'distance_to_center' => 10.4
    ],
    [
        'name' => 'Hotel Futuro',
        'description' => 'Hotel Futuro Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 2
    ],
    [
        'name' => 'Hotel Rivamare',
        'description' => 'Hotel Rivamare Descrizione',
        'parking' => false,
        'vote' => 1,
        'distance_to_center' => 1
    ],
    [
        'name' => 'Hotel Bellavista',
        'description' => 'Hotel Bellavista Descrizione',
        'parking' => false,
        'vote' => 5,
        'distance_to_center' => 5.5
    ],
    [
        'name' => 'Hotel Milano',
        'description' => 'Hotel Milano Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 50
    ],
];
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Lista Hotel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <h1 class="text-center mb-4">Lista Hotel</h1>

    <!-- Intestazione tabella -->
    <div class="row fw-bold border-bottom pb-2 mb-3">
        <div class="col-2">Nome</div>
        <div class="col-3">Descrizione</div>
        <div class="col-2">Parcheggio</div>
        <div class="col-2">Voto</div>
        <div class="col-3">Distanza dal centro</div>
    </div>

    <!-- Lista hotel -->
    <?php
    foreach ($hotels as $hotel) {
        echo '<div class="row border-bottom py-2">';

            echo '<div class="col-2">' . $hotel['name'] . '</div>';
            echo '<div class="col-3">' . $hotel['description'] . '</div>';

            echo '<div class="col-2">';
                if ($hotel['parking']) {
                    echo '<span class="badge bg-success">Sì</span>';
                } else {
                    echo '<span class="badge bg-danger">No</span>';
                }
            echo '</div>';

            echo '<div class="col-2">' . $hotel['vote'] . '/5</div>';
            echo '<div class="col-3">' . $hotel['distance_to_center'] . ' km</div>';

        echo '</div>';
    }
    ?>
</div>

</body>
</html>
