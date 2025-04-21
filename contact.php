<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//    if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
//        http_response_code(403); // Forbidden
//        die("Access denied.");
//    }
    $isimAd = isset($_POST["isim_ad"]) ? htmlspecialchars($_POST["isim_ad"]) : 'Ad girilmedi.';
    $isimSoyad = isset($_POST["isim_soyad"]) ? htmlspecialchars($_POST["isim_soyad"]) : 'Soyad girilmedi.';
    $email = isset($_POST["email"]) ? htmlspecialchars($_POST["email"]) : 'Email girilmedi.';
    $tel_no = isset($_POST["tel_no"]) ? htmlspecialchars($_POST["tel_no"]): 'Telefon numarası girilmedi.';
    $egitim = isset($_POST["egitim"]) ? htmlspecialchars($_POST["egitim"]): 'Eğitim seviyesi girilmedi.';
    $universite = isset($_POST["universite"]) ? htmlspecialchars($_POST["universite"]) : 'Üniversite adı girilmedi.';
    $konu = isset($_POST["konu"]) ? htmlspecialchars($_POST["konu"]) : "Konu belirtilmedi.";
    $mesaj = isset($_POST["mesaj"]) ? htmlspecialchars($_POST["mesaj"]) : "Mesaj gönderilmedi.";
    if(isset($_POST["ilgi_alanlari"])){
      $str="";
      foreach($_POST["ilgi_alanlari"] as $k){
        $str.="$k, ";
      }
      $ilgi_alanlari = $str;
    }
    else{$ilgi_alanlari = "İlgi alanları belirtilmedi.";}
    $calisma_alani = isset($_POST["calisma_alani"]) ? htmlspecialchars($_POST["calisma_alani"]) : "Çalışma alanı seçilmedi.";  
    echo "<!DOCTYPE html>
          <html>
            <head>
              <title>Mesajınız Alındı</title>
              <link rel='icon' type='image/png' sizes='32x32' href='favicon.png'>
              <meta charset='utf-8'>
              <link href=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css\" rel=\"stylesheet\" integrity=\"sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7\" crossorigin=\"anonymous\">
              <script src=\"https://unpkg.com/vue@3/dist/vue.global.js\"></script>
            </head>
            <body>";
    echo "<h1>Formdan Gelen Bilgiler</h1>";
    echo "<table class='table table-bordered'>
            <tr><td>Adınız: </td><td>$isimAd</td></tr>
            <tr><td>Soyadınız: </td><td>$isimSoyad</td></tr>
            <tr><td>E-Posta Adresiniz:  </td><td>$email</td></tr>
            <tr><td>Telefon Numaranız: </td><td>$tel_no</td></tr>
            <tr><td>Eğitim Seviyeniz</td><td>$egitim</td></tr>
            <tr><td>Üniversiteniz: </td><td>$universite</td></tr>
            <tr><td>İlgi Alanlarınız: </td><td>$ilgi_alanlari</td></tr>
            <tr><td>Çalışma Alanınız</td><td>$calisma_alani</td></tr>
            <tr><td>Mesajınızın Konusu: </td><td>$konu</td></tr>
            <tr><td>Mesajınız: </td><td>$mesaj</td></tr>
          </table>";
    echo "  </body>
         </html>";
} else {
    http_response_code(403); // Forbidden
    die("Access denied.");
}
?>
