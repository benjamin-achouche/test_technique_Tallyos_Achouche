<?php
session_start();
require '../extern/dbh.ext.php';

$sql = "SELECT * FROM ruches_infos";
$res = mysqli_query($conn, $sql);

if (!$res) {
  echo $sql;
  exit();
}

$tab = mysqli_fetch_all($res);
$tabLength = mysqli_num_rows($res);

$sqlRuches = "SELECT * FROM ruches";
$resRuches = mysqli_query($conn, $sqlRuches);

if (!$resRuches) {
  echo $sqlRuches;
  exit();
}

$tabRuchesLength = mysqli_num_rows($resRuches);

$months = array(
  "janvier", "février", "mars", "avril", "mai", "juin",
  "juillet", "août", "septembre", "octobre", "novembre", "décembre"
);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Informations</title>

  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
  <link rel="stylesheet" href="../shared/navbar.css" />
  <link rel="stylesheet" href="../shared/dataTable.css" />
  <link rel="stylesheet" href="../shared/dataInteraction.css" />
  <link rel="stylesheet" href="../shared/pagesNav.css" />
  <link rel="stylesheet" href="ruchesInfos.css" />

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  <!-- Personal JS -->
  <script type="module" src="./ruchesInfos.js" defer></script>
  <script type="module" src="../shared/pagination.js" defer></script>
</head>

<body>
  <div class="container-fluid">
    <nav class="navbar navbar-expand-sm bg-dark">
      <ul class="navbar-nav">
        <li class="nav-item company">Company</li>
        <li class="nav-item link">
          <a class="nav-link" href="../accueil/accueil.php">Accueil</a>
        </li>
        <li class="nav-item link">
          <a class="nav-link" href="../ruches/ruches.php">Ruches <span class="badge badge-danger"><?php echo $tabRuchesLength ?></span></a>
        </li>
        <li id="current-page" class="nav-item link">
          <a class="nav-link" href="#">Informations</a>
        </li>
        <li id="logout" class="nav-item">Déconnexion</li>
      </ul>
    </nav>
  </div>
  <div class="data-interaction-wrapper">
    <div class="data-interaction">
      <h3>Information des ruches</h3>
      <form>
        <input class="form-control mr-sm-2" type="search" placeholder="Rechercher..." aria-label="Search" />
      </form>
    </div>
  </div>
  <div class="data-header">
    <ul class="data-header__list">
      <li class="data-header__item data-header-ruche">
        <p>Ruche</p>
        <button class="order-data">
          <span id="ordered-data">↑</span><span>↓</span>
        </button>
      </li>
      <li class="data-header__item data-header-date">
        <p>Date</p>
        <button class="order-data"><span>↑</span><span>↓</span></button>
      </li>
      <li class="data-header__item data-header-poids">
        <p>Poids</p>
        <button class="order-data"><span>↑</span><span>↓</span></button>
      </li>
      <li class="data-header__item data-header-temperature">
        <p>Température</p>
        <button class="order-data"><span>↑</span><span>↓</span></button>
      </li>
      <li class="data-header__item data-header-humidite">
        <p>Humidité</p>
        <button class="order-data"><span>↑</span><span>↓</span></button>
      </li>
    </ul>
  </div>
  <input type='hidden' id="tab-length" value='<?php echo $tabLength ?>' />
  <div id="data-wrapper">
    <?php if ($tabLength > 0) {
      for ($x = 0; $x < $tabLength; $x++) {
        echo "<div class='data'>";
        if ($x % 2 === 0) {
          echo "<ul class='data__list bg-grey'>";
        } else {
          echo "<ul class='data__list'>";
        }
        echo   "<input type='hidden' class='id-value' value='" . $tab[$x][0] . "' />
                <li class='data__item ruche-value'>" . $tab[$x][1] . "</li>
                <li class='data__item date-value'>";
        list($date, $time) = explode(" ", $tab[$x][2]);
        list($year, $month, $day) = explode("-", $date);
        list($hour, $min, $sec) = explode(":", $time);
        echo "$day " . $months[$month - 1] . " $year ${hour}h${min} </li> 
                <li class='data__item poids-value'>" . floor($tab[$x][3] * 2) / 2 . "</li>
                <li class='data__item temperature-value'>" . $tab[$x][4] . "</li>
                <li class='data__item humidite-value'>" . $tab[$x][5] . "</li>
              </ul>
            </div>";
      }
    }
    ?>
  </div>
  <div class="pages-navigation-wrapper">
    <div class="pages-navigation">
      <p id="line-count">Ligne 1 à <?php echo $tabLength ?> sur <?php echo $tabLength ?></p>
      <div class="pages-navigation-div">
        <button class="btn btn-outline-secondary btn-pages-left">
          < </button>
            <button class="btn btn-primary btn-pages-center">1</button>
            <button class="btn btn-outline-secondary btn-pages-right">></button>
      </div>
    </div>
  </div>
  <div class="pages-count-wrapper">
    <div class="pages-count">
      <select class="custom-select pagination" name="pages" id="pages">
        <option value="5">5</option>
        <option value="10">10</option>
        <option value="15">15</option>
        <option value="20">20</option>
      </select>
      <p>lignes par page</p>
    </div>
  </div>
</body>

</html>