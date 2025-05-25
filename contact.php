<?php
session_start();
if (empty($_SESSION['csrf_token'])) {
  $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>İletişim</title>
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
    <div id="app" class="container py-5">
    <div class="text-center mb-5">
      <h1 class="display-4 text-info border-bottom border-info pb-2">İletişim Formu</h1>
    <form id="contactForm" @submit.prevent="checkForm" method="post" action="process.php" ref="formRef">
      <div class="row">
        <div class="col-md-6 mb-3">
          <label for="isim_ad" class="form-label">Adınız</label>
          <input type="text" id="isim_ad" name="isim_ad" class="form-control" v-model="isim_ad">
        </div>
        <div class="col-md-6 mb-3">
          <label for="isim_soyad" class="form-label">Soyadınız</label>
          <input type="text" id="isim_soyad" name="isim_soyad" class="form-control" v-model="isim_soyad">
        </div>
        <div v-if="!isNameValid" class="text-danger mt-1">İsim boş bırakılamaz.</div>
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">E-postanız</label>
        <input type="text" id="email" name="email" class="form-control" v-model="email">
        <div v-if="!isEmailValid" class="text-danger mt-1">Geçerli bir e-posta giriniz.</div>
      </div>
      <div class="mb-3">
        <label for="tel_no">Telefon Numaranız</label>
        <input type="text" id="tel_no" name="tel_no" class="form-control" v-model="tel_no" placeholder="550xxxxxxx">
        <div v-if="!isPhoneValid" class="text-danger mt-1">Geçerli bir telefon numarası giriniz.</div>
      </div>
      <hr>
      <div class="mb-3">
        <label class="form-label d-block mb-2">Eğitim Seviyeniz</label>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="egitim" id="egitimLise" value="Lise">
          <label class="form-check-label" for="egitimLise">Lise</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="egitim" id="egitimOnlisans" value="Önlisans">
          <label class="form-check-label" for="egitimOnlisans">Önlisans</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="egitim" id="egitimLisans" value="Lisans">
          <label class="form-check-label" for="egitimLisans">Lisans</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="egitim" id="egitimYuksek" value="Yüksek Lisans">
          <label class="form-check-label" for="egitimYuksek">Yüksek Lisans</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="egitim" id="egitimDoktora" value="Doktora">
          <label class="form-check-label" for="egitimDoktora">Doktora</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" id="egitimMezun" name="egitim" value="Mezun" checked>
          <label class="form-check-label" for="egitimMezun">Mezun</label>
        </div>
      </div>
      <div class="mb-3">
        <label for="universite" class="form-label">Üniversiteniz</label>
        <input type="text" id="universite" name="universite" list="universiteler" class="form-control" v-model="universite">
        <datalist id="universiteler">
          <option value="Üniversiteye Girmedim">Üniversiteye Girmedim</option>
          <option value="SAÜ">Sakarya Üniversitesi</option>
          <option value="ODTÜ">ODTÜ</option>
          <option value="Boğaziçi Üniversitesi">Boğaziçiç Üniversitesi</option>
          <option value="İTÜ">İTÜ</option>
          <option value="Haccettepe Üniversitesi">Haccettepe Üniversitesi</option>
          <option value="Ankara Üniversitesi"></option>
        </datalist>
        <div v-if="!isUniversityValid" class="text-danger mt-1">Geçerli bir yanıt giriniz.</div>
      </div>
      <hr>
      <div class="mb-3">
        <label class="form-label d-block mb-2">İlgi Alanlarınız</label>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" id="ilgiSiber" name="ilgi_alanlari[]" value="Siber Güvenlik">
          <label class="form-check-label" for="ilgiSiber">Siber Güvenlik</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" id="ilgiFront" name="ilgi_alanlari[]" value="Front End Coding">
          <label class="form-check-label" for="ilgiFront">Front End Coding</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" id="ilgiBack" name="ilgi_alanlari[]" value="Back End Coding">
          <label class="form-check-label" for="ilgiBack">Back End Coding</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" id="ilgiCTI" name="ilgi_alanlari[]" value="Siber Tehdit İstihbaratı">
          <label class="form-check-label" for="ilgiCTI">Siber Tehdit İstihbaratı</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" id="ilgiAI" name="ilgi_alanlari[]" value="Yapay Zeka">
          <label class="form-check-label" for="ilgiAI">Yapay Zeka</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" id="ilgiMLOps" name="ilgi_alanlari[]" value="MLOps">
          <label class="form-check-label" for="ilgiMLOps">MLOps</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" id="ilgiDevOps" name="ilgi_alanlari[]" value="DevOps">
          <label class="form-check-label" for="ilgiDevOps">DevOps</label>
        </div>
      </div>
      <div class="mb-3">
        <label for="calisma_alani" class="form-label">Çalışma Alanınız</label>
        <select id="calisma_alani" name="calisma_alani" class="form-select">
          <option selected value="">Alan seçilmedi</option>
          <optgroup label="Siber">
            <option value="Red Team">Red Team</option>
            <option value="BlueTeam">Blue Team</option>
            <option value="DevOps">DevOps</option>
            <option value="Siber Tehdit İstihbaratı">Siber Tehdit İstihbaratı</option>
          </optgroup>
          <optgroup label="Sayısal">
            <option value="Bilgisayar Mühendisliği">Bilgisayar Mühendisliği</option>
            <option value="Elektrik-Elektronik Mühendisliği">Elektrik-Elektronik Mühendisliği</option>
            <option value="Makina Mühendisliği">Makina Mühendisliği</option>
          </optgroup>
          <optgroup label="Sözel">
            <option value="Ekonomi ve Finans">Ekonomi ve Finans</option>
            <option value="Sağlık">Sağlık Endüstrisi</option>
          </optgroup>
        </select>
      </div>
      <hr>
      <div class="mb-3">
        <label for="konu" class="form-label">Mesajınızın Konusu</label>
        <input type="text" id="konu" name="konu" class="form-control" v-model="konu">
        <div v-if="!isKonuValid" class="text-danger mt-1">Geçerli bir mesaj konusu giriniz.</div>
      </div>
      <div class="mb-3">
        <label for="mesaj" class="form-label">Mesajınız</label>
        <textarea id="mesaj" name="mesaj" class="form-control" rows="5" v-model="mesaj"></textarea>
        <div v-if="!isMesajValid" class="text-danger mt-1">Mesaj boş bırakılamaz.</div>
      </div>  
      <hr>

      <div class="alert alert-danger" v-if="errorMessage">{{ errorMessage }}</div>
      <div class="alert alert-success" v-if="responseMessage">{{ responseMessage }}</div>
      
      <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

      <div class="d-flex gap-3">
        <input type="reset" value="Temizle">
        <button type="button" class="btn btn-info" onclick="validateFormJS()">JS Kontrol</button>
        <button type="submit" class="btn btn-success" @click="checkForm">Vue Gönder</button>
      </div>
    </form>
  </div>
  <script>
    function validateFormJS() {
      const adInput = document.getElementById('isim_ad');
      const soyadInput = document.getElementById('isim_soyad');
      const emailInput = document.getElementById('email');
      const phoneInput = document.getElementById('tel_no');
      const uniInput = document.getElementById('universite');
      const konuInput = document.getElementById('konu');
      const mesajInput = document.getElementById('mesaj');

      let isValid = true;
    
      adInput.classList.remove('is-invalid');
      soyadInput.classList.remove('is-invalid');
      emailInput.classList.remove('is-invalid');
      phoneInput.classList.remove('is-invalid');
      uniInput.classList.remove('is-invalid');
      konuInput.classList.remove('is-invalid');
      mesajInput.classList.remove('is-invalid');
    
      if (adInput.value.trim() === '') {
        adInput.classList.add('is-invalid');
        isValid = false;
      }

      if (soyadInput.value.trim() === '') {
        soyadInput.classList.add('is-invalid');
        isValid = false;
      }

      const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
      if (!emailRegex.test(emailInput.value.trim())) {
        emailInput.classList.add('is-invalid');
        isValid = false;
      }

      const phoneRegex = /^[0-9]{10}$/;
      if(!phoneRegex.test(phoneInput.value.trim())) {
        phoneInput.classList.add('is-invalid');
        isValid = false;
      }

      if (uniInput.value.trim() === '') {
        uniInput.classList.add('is-invalid');
        isValid = false;
      }

      if (konuInput.value.trim() === '') {
        konuInput.classList.add('is-invalid');
        isValid = false;
      }

      if (mesajInput.value.trim() === '') {
        mesajInput.classList.add('is-invalid');
        isValid = false;
      }

      if (!isValid) {
        alert('Bazı alanlar hatalı. Lütfen kontrol edin.');
      } else {
        alert('Form JS ile başarılı şekilde doğrulandı.');
      }
    }
  </script>
  <script>
    const { createApp, ref } = Vue;

    createApp({
      setup() {
        const isim_ad = ref('');
        const isim_soyad = ref('');
        const email = ref('');
        const tel_no = ref('');
        const universite = ref('');
        const konu = ref('');
        const mesaj = ref('');
        const isNameValid = ref(true);
        const isEmailValid = ref(true);
        const isPhoneValid = ref(true);
        const isUniversityValid = ref(true);
        const isKonuValid = ref(true);
        const isMesajValid = ref(true);
        const errorMessage = ref('');
        const responseMessage = ref('');
        const formRef = ref(null);

        const validateEmail = () => {
          const eRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
          isEmailValid.value = eRegex.test(email.value);
        };

        const validateName = () => {
          isNameValid.value = (isim_ad.value.trim().length > 0) && (isim_soyad.value.trim().length > 0);
        };

        const validatePhone = () => {
          const phoneRegex = /^[0-9]{10}$/;
          isPhoneValid.value = phoneRegex.test(tel_no.value);
        };

        const validateUniversity = () => {
          isUniversityValid.value = universite.value.trim().length > 0;
        };

        const validateKonu = () => {
          isKonuValid.value = konu.value.trim().length > 0;
        };
 
        const validateMesaj = () => {
          isMesajValid.value = mesaj.value.trim().length > 0;
        };

        const checkForm = () => {
          validateName();
          validateEmail();
          validatePhone();
          validateUniversity();
          validateKonu();
          validateMesaj();

          if (!isNameValid.value || !isEmailValid.value || !isPhoneValid.value || !isUniversityValid.value || !isKonuValid.value || !isMesajValid.value) {
            errorMessage.value = 'Geçersiz alanlar mevcut. Lütfen tekrar kontrol edin.';
            responseMessage.value = '';
            return;
          }

          errorMessage.value = '';
          responseMessage.value = 'Form başarıyla gönderildi.';
          
          formRef.value.submit();
        };

        return {
          isim_ad,
          isim_soyad,
          email,
          tel_no,
          universite,
          konu,
          mesaj,
          isNameValid,
          isEmailValid,
          isPhoneValid,
          isUniversityValid,
          isKonuValid,
          isMesajValid,
          errorMessage,
          responseMessage,
          checkForm,
          formRef
        };
      }
    }).mount('#app');
  </script>
  </body>
</html>
