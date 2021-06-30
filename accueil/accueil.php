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
  <link rel="stylesheet" href="../shared/navbar.css" />
  <link rel="stylesheet" href="accueil.css" />

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>

<body>
  <div class="container-fluid">
    <nav class="navbar navbar-expand-sm bg-dark">
      <ul class="navbar-nav">
        <li class="nav-item company">Company</li>
        <li id="current-page" class="nav-item link">
          <a class="nav-link" href="#">Accueil</a>
        </li>
        <li class="nav-item link">
          <a class="nav-link" href="../ruches/ruches.php">Ruches <span class="badge badge-danger"><?php echo $tabLength ?></span></a>
        </li>
        <li class="nav-item link">
          <a class="nav-link" href="../ruchesInfos/ruchesInfos.php">Informations</a>
        </li>
        <li id="logout" class="nav-item">Déconnexion</li>
      </ul>
    </nav>
  </div>
  <div class="content-container">
    <div class="content-wrapper">
      <div class="content-message">
        <div class="template-subject">
          <div id="bubble"></div>
          <div class="template-name">
            <label for="template-name">Template name</label>
            <input type="text" id="template-name" class="form-control mr-sm-2" value="Uncompleted Profile">
            <label for="subject">Subject</label>
            <input type="text" id="subject" class="form-control mr-sm-2" value="Hello, %USER_FULL_NAME%">
          </div>
        </div>
        <div>
          <label for="floatingTextarea2">Message</label>
          <textarea class="form-control" id="floatingTextarea2" style="height: 100px">Hello %USER_FULL_NAME%!

Some more pseudo text to fill the void Some more pseudo text to fill the void Some more pseudo text to fill the void Some more pseudo text to fill the void Some more pseudo text to fill the void Some more pseudo text to fill the void Some more pseudo text to fill the void Some more pseudo text to fill the void Some more pseudo text to fill the void Some more pseudo text to fill the void Some more pseudo text to fill the void Some more pseudo text to fill the void</textarea>
        </div>
        <div>
          <form action="">
            <div class="dropdown-wrapper">
              <label for="dropdown" style="margin-bottom: 0.25rem;">Message Type</label>
              <select class="custom-select" name="dropdown" id="dropdown">
                <option value="Email + Push" selected>Email + Push</option>
                <option value="SMS">SMS</option>
                <option value="MMS">MMS</option>
              </select>
            </div>
            <div class="send-group-wrapper">
              <label for="">Send to Group</label>
              <div style="margin-left: 3px">
                <div class="checkbox-div">
                  <input type="checkbox" class="checkbox-input">
                  <label class="send-group" for="">Top Management</label>
                </div>
                <div class="checkbox-div">
                  <input type="checkbox" class="checkbox-input">
                  <label class="send-group" for="">Marketing Department</label>
                </div>
                <div class="checkbox-div">
                  <input type="checkbox" class="checkbox-input">
                  <label class="send-group" for="">Design Department</label>
                </div>
                <div class="checkbox-div">
                  <input type="checkbox" class="checkbox-input">
                  <label class="send-group" for="">Financial Department</label>
                </div>
                <div class="checkbox-div">
                  <input type="checkbox" class="checkbox-input">
                  <label class="send-group" for="">Supply Department</label>
                </div>
              </div>
            </div>
            <button type="submit" class="btn btn-primary" style="width: 9rem">Valider</button>
            <button type="button" class="btn btn-outline-secondary" style="width: 6rem; margin-left: 1rem;">Annuler</button>
          </form>
        </div>
      </div>
      <div class="content-thumbnail">
        <div class="thumbnail-wrapper">
          <div class="grey-box">320x200</div>
          <div style="margin: 0 1rem">
            <h4 style="font-size: 25px">Thumbnail label</h4>
            <p style="font-size: 14px">Some pseudo text repeated a lot of times to take space Some pseudo text repeated a lot of times to take space</p>
          </div>
          <div class="thumbnail-btns">
            <button class="btn btn-primary">Button</button>
            <button class="btn btn-outline-secondary">Button</button>
          </div>
        </div>
        <div>
          <form action="">
            <div style="margin: 1rem 0;">
              <label for="liste">Tap target</label>
              <select class="custom-select" name="liste" id="liste">
                <option value="Profile Screen" selected>Profile Screen</option>
                <option value="Profile Image">Profile Image</option>
                <option value="Profile Management">Profile Management</option>
              </select>
            </div>
            <div class="send-group-wrapper">
              <label for="">Set Type</label>
              <div style="margin-left: 0.25rem">
                <div class="checkbox-div">
                  <input type="radio" name="radio-test" class="checkbox-input">
                  <label class="badge badge-success" for="">News</label>
                </div>
                <div class="checkbox-div">
                  <input type="radio" name="radio-test" class="checkbox-input" checked>
                  <label class="badge badge-info" for="">Reports</label>
                </div>
                <div class="checkbox-div">
                  <input type="radio" name="radio-test" class="checkbox-input">
                  <label class="badge badge-warning" style="color: white" for="">Documents</label>
                </div>
                <div class="checkbox-div">
                  <input type="radio" name="radio-test" class="checkbox-input">
                  <label class="badge badge-primary" for="">Media</label>
                </div>
                <div class="checkbox-div">
                  <input type="radio" name="radio-test" class="checkbox-input">
                  <label class="badge badge-secondary" for="">Text</label>
                </div>
              </div>
            </div>
            <button type="submit" class="btn btn-danger" style="margin: 0.3rem 0 0 0.3rem; width: 12rem">Supprimer</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>

</html>