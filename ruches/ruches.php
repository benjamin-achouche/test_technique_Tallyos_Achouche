<?php
session_start();
require '../extern/dbh.ext.php';

$sql = "SELECT * FROM ruches";
$res = mysqli_query($conn, $sql);

if (!$res) {
  echo $sql;
  exit();
}

$tab = mysqli_fetch_all($res);
$tabLength = mysqli_num_rows($res);


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Ruches</title>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
  <!-- Personal CSS -->
  <link rel="stylesheet" href="../shared/navbar.css" />
  <link rel="stylesheet" href="../shared/dataTable.css" />
  <link rel="stylesheet" href="../shared/dataInteraction.css" />
  <link rel="stylesheet" href="../shared/pagesNav.css" />
  <link rel="stylesheet" href="ruches.css" />
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  <!-- Personal JS -->
  <script type="module" src="ruches.js" defer></script>
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
        <li id="current-page" class="nav-item link">
          <a class="nav-link" href="#">Ruches <span class="badge badge-danger"><?php echo $tabLength ?></span></a>
        </li>
        <li class="nav-item link">
          <a class="nav-link" href="../ruchesInfos/ruchesInfos.php">Informations</a>
        </li>
        <li id="logout" class="nav-item">Déconnexion</li>
      </ul>
    </nav>
  </div>
  <div class="data-interaction-wrapper">
    <div class="data-interaction">
      <button type="button" class="btn btn-success ajouter-ruche" data-toggle="modal" data-target="#ajouter-ruche-modal">
        Ajouter une ruche
      </button>
      <div class="modal fade" id="ajouter-ruche-modal">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5>Ajouter une ruche</h5>
              <button class="close" data-dismiss="modal">X</button>
            </div>
            <div class="modal-body">
              <form id="ajouter-ruche-form" class="modal-form" action="../extern/ruches.ext.php" method="post">
                <input class="form-control mr-sm-2" type="text" placeholder="Nom" name="nom" />
                <input class="form-control mr-sm-2" type="number" step="0.000001" placeholder="Latitude" name="latitude" />
                <input class="form-control mr-sm-2" type="number" step="0.000001" placeholder="Longitude" name="longitude" />
                <div class="modal-confirm-div">
                  <button id="ajouter-ruche-confirm" type="submit" name="ajouter-ruche-submit" class="btn btn-outline-success">
                    Ajouter
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <form>
        <input class="form-control mr-sm-2" type="search" placeholder="Rechercher..." aria-label="Search" />
      </form>
    </div>
  </div>
  <div class="data-header">
    <ul class="data-header__list">
      <li class="data-header__item data-header-nom">
        <p>Nom</p>
        <button class="order-data">
          <span id="ordered-data">↑</span><span>↓</span>
        </button>
      </li>
      <li class="data-header__item data-header-latitude">
        <p>Latitude</p>
        <button class="order-data"><span>↑</span><span>↓</span></button>
      </li>
      <li class="data-header__item data-header-longitude">
        <p>Longitude</p>
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
                <li class='data__item nom-value'>" . $tab[$x][1] . "</li>
                <li class='data__item latitude-value'>" . $tab[$x][2] . "</li>
                <li class='data__item longitude-value'>" . $tab[$x][3] . "</li>
                <li class='data__item'>
                  <div class='data-modifiers'>
                    <button type='button' class='btn btn-link modifier-ruche' data-toggle='modal' data-target='#modifier-ruche-modal-$x'>Modifier</button>
                    <div class='modal fade' id='modifier-ruche-modal-$x'>
                      <div class='modal-dialog modal-dialog-centered'>
                        <div class='modal-content'>
                          <div class='modal-header'>
                            <h5>Modifier une ruche</h5>
                            <button class='close' data-dismiss='modal'>X</button>
                          </div>
                          <div class='modal-body'>
                            <form id='modifier-ruche-form-$x' class='modal-form' action='../extern/modify.ext.php' method='post'>
                              <input class='form-control mr-sm-2' type='text' placeholder='Nom' name='nom' value='" . $tab[$x][1] . "' />
                              <input class='form-control mr-sm-2' type='number' step='0.000001' placeholder='Latitude' name='latitude' value='" . $tab[$x][2] . "'/>
                              <input class='form-control mr-sm-2' type='number' step='0.000001' placeholder='Longitude' name='longitude' value='" . $tab[$x][3] . "'/>
                              <div class='modal-confirm-div'>
                                <button id='modifier-ruche-confirm-$x' type='submit' name='modify-submit' class='btn btn-outline-success' value='" . $tab[$x][0] . "'>
                                  Confirmer
                                </button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>/
                    <form action='../extern/delete.ext.php' method='post'>
                      <button type='submit' name='delete-submit' class='btn btn-link' value='" . $tab[$x][1] . "'>Supprimer</button>
                    </form>
                  </div>
                </li>
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