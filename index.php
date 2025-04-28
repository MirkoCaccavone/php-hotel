<?php
// Array contenente i dati degli hotel
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

// Inizializzazione array per gli hotel filtrati
$filteredHotels = [];

// Gestione dei filtri dalla query string ($_GET)
// Verifica se è stato richiesto il filtro per il parcheggio
$filter_parking = isset($_GET['parking']) && $_GET['parking'] == '1';

// Verifica se è stato richiesto il filtro per il voto minimo
// Controlla che il parametro esista, non sia vuoto e sia numerico
$filter_vote = isset($_GET['vote']) && $_GET['vote'] !== '' && is_numeric($_GET['vote']);

// Converte il voto minimo in intero se il filtro è attivo, altrimenti usa 0
$min_vote = $filter_vote ? intval($_GET['vote']) : 0;

// Ciclo di filtro degli hotel
foreach ($hotels as $hotel) {
    // Verifica condizione parcheggio:
    // - se non c'è filtro (!$filter_parking) passa sempre
    // - se c'è filtro, passa solo se l'hotel ha il parcheggio
    $passes_parking = !$filter_parking || $hotel['parking'];

    // Verifica condizione voto:
    // - se non c'è filtro (!$filter_vote) passa sempre
    // - se c'è filtro, passa solo se il voto dell'hotel è >= al minimo richiesto
    $passes_vote = !$filter_vote || $hotel['vote'] >= $min_vote;

    // Se l'hotel passa entrambi i filtri, viene aggiunto all'array filtrato
    if ($passes_parking && $passes_vote) {
        $filteredHotels[] = $hotel;
    }
}
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

        <!-- Form per i filtri -->
        <form method="GET" class="mb-4">
            <!-- Checkbox per filtrare per parcheggio 
                 Il checkbox mantiene lo stato (checked) se il filtro è attivo -->
            <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" name="parking" value="1" id="parkingCheck"
                    <?php if ($filter_parking) echo 'checked'; ?>>
                <label class="form-check-label" for="parkingCheck">
                    Mostra solo hotel con parcheggio
                </label>
            </div>

            <!-- Input numerico per il voto minimo 
                 Mantiene il valore inserito dopo il submit -->
            <div class="mb-2">
                <label for="voteInput" class="form-label">Voto minimo</label>
                <input type="number" class="form-control" name="vote" id="voteInput" min="1" max="5"
                    value="<?php echo $filter_vote ? htmlspecialchars($_GET['vote']) : ''; ?>">
            </div>

            <button type="submit" class="btn btn-primary">Filtra</button>
        </form>

        <!-- Intestazione della tabella con i campi -->
        <div class="row fw-bold border-bottom pb-2 mb-3">
            <div class="col-2">Nome</div>
            <div class="col-3">Descrizione</div>
            <div class="col-2">Parcheggio</div>
            <div class="col-2">Voto</div>
            <div class="col-3">Distanza dal centro</div>
        </div>

        <!-- Visualizzazione degli hotel filtrati -->
        <?php
        foreach ($filteredHotels as $hotel) {
            // Creazione di una riga per ogni hotel
            echo '<div class="row border-bottom py-2">';
            // Visualizzazione dei dati dell'hotel
            echo '<div class="col-2">' . $hotel['name'] . '</div>';
            echo '<div class="col-3">' . $hotel['description'] . '</div>';
            // Badge colorato per la disponibilità del parcheggio
            echo '<div class="col-2">';
            if ($hotel['parking']) {
                echo '<span class="badge bg-success">Sì</span>';
            } else {
                echo '<span class="badge bg-danger">No</span>';
            }
            echo '</div>';
            // Visualizzazione voto e distanza
            echo '<div class="col-2">' . $hotel['vote'] . '/5</div>';
            echo '<div class="col-3">' . $hotel['distance_to_center'] . ' km</div>';
            echo '</div>';
        }
        ?>
    </div>
</body>
</html>
