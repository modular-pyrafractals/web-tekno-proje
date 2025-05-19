<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  http_response_code(403);
  die("Yetkisiz erişim.");
}

if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
  http_response_code(403);
  die("CSRF doğrulama hatası.");
  error_log("CSRF doğrulama hatası.");
}
}

$isim_ad = isset($_POST["isim_ad"]) ? htmlspecialchars($_POST["isim_ad"]) : 'Ad girilmedi.';
$isim_soyad = isset($_POST["isim_soyad"]) ? htmlspecialchars($_POST["isim_soyad"]) : 'Soyad girilmedi.';
$email = isset($_POST["email"]) ? htmlspecialchars($_POST["email"]) : 'Email girilmedi.';
$tel_no = isset($_POST["tel_no"]) ? htmlspecialchars($_POST["tel_no"]): 'Telefon numarası girilmedi.';
$egitim = isset($_POST["egitim"]) ? htmlspecialchars($_POST["egitim"]): 'Eğitim seviyesi girilmedi.';
$universite = isset($_POST["universite"]) ? htmlspecialchars($_POST["universite"]) : 'Üniversite adı girilmedi.';    
if(isset($_POST["ilgi_alanlari"]) && is_array($_POST["ilgi_alanlari"])) {
  $temiz_dizi = array_map('htmlspecialchars', $_POST["ilgi_alanlari"]);
  $ilgi_alanlari = implode(", ", $temiz_dizi);
} else {
  $ilgi_alanlari = "İlgi alanları belirtilmedi.";
}
$calisma_alani = isset($_POST["calisma_alani"]) ? htmlspecialchars($_POST["calisma_alani"]) : "Çalışma alanı seçilmedi.";
$konu = isset($_POST["konu"]) ? htmlspecialchars($_POST["konu"]) : "Konu belirtilmedi.";
$mesaj = isset($_POST["mesaj"]) ? htmlspecialchars($_POST["mesaj"]) : "Mesaj gönderilmedi.";
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Mesajınız Alındı</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link href="/assets/css/style.css" rel="stylesheet">
    <script src="/assets/js/vue.global.js"></script>
    <link rel="icon" type="image/svg+xml" href="/assets/images/favicon.svg">
  </head>
  <body class="bg-black text-white">
    <header class="bg-dark text-white pt-3 pb-0 mb-0">
      <div class="container d-flex flex-wrap align-items-center justify-content-center">
        <a href="index.html" class="d-flex align-middle mb-3 mb-lg-0 text-white text-decoration-none">
          <img src="/assets/images/favicon.svg" alt="favicon" width="32" height="32">
          <span class="fs-4 align-top fix-margin-left-5"> Testing</span>
        </a>
      </div>
    </header>
    <nav class="bg-dark d-flex flex-wrap justify-content-center pt-0 pb-3 mb-0">
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
      <h1>Formdan Gelen Bilgiler</h1>
      <table class='table table-bordered table-dark'>
        <tr><td>Adınız: </td><td><?php echo $isim_ad; ?></td></tr>
        <tr><td>Soyadınız: </td><td><?php echo $isim_soyad;?></td></tr>
        <tr><td>E-Posta Adresiniz:  </td><td><?php echo $email;?></td></tr>
        <tr><td>Telefon Numaranız: </td><td><?php echo $tel_no;?></td></tr>
        <tr><td>Eğitim Seviyeniz</td><td><?php echo $egitim;?></td></tr>
        <tr><td>Üniversiteniz: </td><td><?php echo $universite;?></td></tr>
        <tr><td>İlgi Alanlarınız: </td><td><?php echo $ilgi_alanlari;?></td></tr>
        <tr><td>Çalışma Alanınız</td><td><?php echo $calisma_alani;?></td></tr>
        <tr><td>Mesajınızın Konusu: </td><td><?php echo $konu;?></td></tr>
        <tr><td>Mesajınız: </td><td><?php echo $mesaj;?></td></tr>
      </table>
      <a href="contact.html" class="btn btn-light mt-4 text-dark">Geri Dön</a>
    </div> 
  </body>
</html>
