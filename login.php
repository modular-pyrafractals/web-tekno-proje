<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  http_response_code(403);
  die("Yetkisiz erişim.");
}

$email = isset($_POST["email"]) ? htmlspecialchars($_POST["email"]) : 'E-posta adresi girilmedi.';
$password = isset($_POST["password"]) ? htmlspecialchars($_POST["password"]) : 'Şifre girilmedi.';

if (preg_match("/^([a-zA-Z][0-9]{9})@sakarya\.edu\.tr$/", $email, $matches)) {
  if ($matches[1] === $password) {
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Logged In</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link href="/assets/css/style.css" rel="stylesheet">
    <link rel="icon" type="image/svg+xml" href="/assets/images/favicon.svg">
    <script src="/assets/js/vue.global.js"></script>
  </head>
  <body class="bg-black text-white">
    <header class="bg-dark text-white pt-3 pb-0 mb-0">
      <div class="container d-flex flex-wrap align-items-center justify-content-center">
        <a href="index.html" class="d-flex align-middle mb-3 mb-lg-0 text-white text-decoration-none">
          <img src="/assets/images/favicon.svg" alt="favicon" width="32" height="32">
          <span class="fs-4 align-top fix-margin-left-5">Pyrafractals</span>
        </a>
      </div>
    </header>
    <nav class="bg-dark text-white d-flex flex-wrap justify-content-center pt-0 pb-3 mb-0">
      <ul class="nav nav-pills me-auto fix-margin-left-10">
        <li class="nav-item fix-margin-right-5"><a href="index.html" class="nav-link bg-secondary active" aria-current="page">Hakkımda</a></li>
        <li class="nav-item fix-margin-right-5"><a href="ozgecmis.html" class="nav-link bg-secondary active">Özgeçmiş</a></li>
        <li class="nav-item fix-margin-right-5"><a href="sehrim.html" class="nav-link bg-secondary active">Şehrim</a></li>
        <li class="nav-item fix-margin-right-5"><a href="takimimiz.html" class="nav-link bg-secondary active">Takımımız</a></li>
        <li class="nav-item"><a href="ilgi-alanlarim.html" class="nav-link bg-secondary active">İlgi Alanlarım</a></li>
      </ul>
      <ul class="nav nav-pills fix-margin-right-10">
        <li class="nav-item fix-margin-right-5"><a href="contact.php" class="nav-link active bg-success">İletişim</a></li>
        <li class="nav-item"><a href="login.html" class="nav-link active bg-success">Giriş Yap</a></li>
      </ul>
    </nav>
    <div class="container py-5">
      <div class="text-center mb-5">
        <h1 class="display-4 text-info border-bottom border-info pb-2">Giriş Yapıldı</h1>
      </div>
      <div class="card bg-dark text-white mb-4">
        <div class="card-header text-warning fs-5">Giriş Bilgileri</div>
        <div class="card-body">
          <p>Hoşgeldiniz "<?php echo $password;?>".</p>
        </div>
      </div>
  </body>
</html>

<?php
}   else {
      header("Location: login.html");
      exit;
    }
} else {
    header("Location: login.html");
    exit;
}

?>
