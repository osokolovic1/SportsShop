<?php
  function zag() {
    header("{$_SERVER['SERVER_PROTOCOL']} 200 OK");
    header("Content-Type: text/html");
    header("Access-Control-Allow-Origin: *");
  }

  function rest_get($request, $data) {
    try {
      $veza = new PDO("mysql:host=" . getenv("MYSQL_SERVICE_HOST") . ";port=3306;dbname=sportsshop", "osokolovic1", "88xgjgizvyjfa7d2");
      $veza->exec("set names utf8");
    }
    catch (PDOException $e) {
      echo $e->getMessage();
      exit;
    }

    $id = "";
    if (isset($data["id"]))  //ako se pozove bez id parametra
      $id = $data["id"];

    $query = "SELECT naziv, cijena FROM artikli";
    if ($id != "") //tj ako je zadan id da pronadje samo taj artikal a ako nije vraca sve artikle
      $query = $query . " WHERE artikalid=?";

    $upit = $veza->prepare($query);
    $upit->execute($id == "" ? null : array($id));

    $vel = $upit->rowCount();
    $rezultat = $upit->fetchAll();
    $vel--;
    $i = 0;
    echo '{ "products":[';
    foreach ($rezultat as $red) {
      echo '{ "name":"' . $red["naziv"] . '", "price":"' . $red["cijena"] . '"';
      if ($i < $vel)
        echo "},";
      else
        echo "}";
      $i++;
    }
    echo ']}';
  }

  function rest_post($request, $data) {
      echo "Not Implemented";
  }

  function rest_delete($request) {
      echo "Not Implemented";
  }

  function rest_put($request, $data) {
      echo "Not Implemented";
  }

  function rest_error($request) {
      echo "Not Implemented";
  }

  $method  = $_SERVER["REQUEST_METHOD"];
  $request = $_SERVER["REQUEST_URI"];

  switch($method) {
      case "PUT":
          parse_str(file_get_contents('php://input'), $put_vars);
          zag();
          $data = $put_vars;
          rest_put($request, $data);
          break;
      case "POST":
          zag();
          $data = $_POST;
          rest_post($request, $data);
          break;
      case "GET":
          zag();
          $data = $_GET;
          rest_get($request, $data);
          break;
      case "DELETE":
          zag();
          rest_delete($request);
          break;
      default:
          header("{$_SERVER['SERVER_PROTOCOL']} 404 Not Found");
          rest_error($request);
          break;
  }
?>
