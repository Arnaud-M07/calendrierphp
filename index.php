<?php
    // if (!empty($_POST['month'])){}
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $selectedDate = $_POST['month'];
    } else {
        $selectedDate = date('Y-m-d'); // Utilise la date actuelle si la méthode n'est pas POST
    }
    
    $dateObj = new DateTime($selectedDate);

    // Transforme la date au format français
    $formatter = new IntlDateFormatter('fr_FR'); 
    $formatter->setPattern('MMMM YYYY');
    $frenchDate =  $formatter->format($dateObj);
    
    // Nbre de jour dans le mois
    $daysInMonth = $dateObj->format('t');
    
    // Premier jour du mois
    $firstDay  = $dateObj->modify('first day of this month');
    $firstDayLitteral = $firstDay->format('N');
    
    // Dernier jour du mois
    $lastDay = $dateObj->modify('last day of this month');
    $lastDayLitteral = $lastDay->format('N');
    
    // Trouver le nombre de semaine dans le mois puis boucler dessus
    $remainDays = 7 - $lastDayLitteral;
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>TP Calendrier PHP</title>
</head>
<body>
    <header>
        <!-- <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">TP Calendrier PHP</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="./exercice1.php">Home</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="./exercice2.php">Nop</a>
                    </li>
                </ul>
                </div>
            </div>
        </nav> -->
    </header>

    <main>
        <div class="container p-5">
            <div class="row">
                <div class="col">
                        <!-- <label for="start">Start month:</label> -->
                        <form action="" method="POST">
                        <div class="submit-title">
                            <div>
                                <input class="select-month" type="month" name="month" id="start" name="start" min="2018" value="<?=$selectedDate?>"/>
                                <button type="submit" class="btn btn-letsgo"><svg xmlns="http://www.w3.org/2000/svg" height="1.25em" viewBox="0 0 512 512"><style>svg{fill:#232424}</style><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg></button>
                            </div>
                            <div>
                                <h1><?=$frenchDate?></h1>
                            </div>
                        </div>
                        </form>
                        
                        <div class="calendar">
                            
                            <!-- Jours semaine -->
                            <div class="div1 case case-lit">Lun</div>
                            <div class="div2 case case-lit">Mar</div>
                            <div class="div3 case case-lit">Mer</div>
                            <div class="div4 case case-lit">Jeu</div>
                            <div class="div5 case case-lit">Ven</div>
                            <div class="div6 case case-lit">Sam</div>
                            <div class="div7 case case-lit">Dim</div>
                            <!-- Dates mois -->
                            <?php
                                // Afficher les jours vides au début du mois
                                for($i=1; $i < $firstDayLitteral; $i++){
                                    echo  "<div class=\"case case-num\"></div>";
                                }
                                // boucle retournant le nombre de jour dans le mois 
                                for($i=1; $i <= $daysInMonth; $i++){
                                    echo  "<div class=\"case case-num\"> $i </div>";
                                }
                                // Afficher les jours vides en fin de mois
                                for($i=0; $i < $remainDays; $i++){
                                    echo  "<div class=\"case case-num\"></div>";
                                }
                            ?>
                        </div>
                </div>
            </div>
        </div>
    </main>


    <footer></footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>