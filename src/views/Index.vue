<script setup lang="ts">
  window.addEventListener('scroll', function(){
    const header =document.querySelector('header');
    header.classList.toggle("sticky", window.scrollY > 0 );
  });

  function toggleMenu(){
    const tmenuToggle = document.querySelector('.menuToggle');
    const navbar = document.querySelector('.navbar');
    navbar.classList.toggle('active');
    menuToggle.classList.toggle('active');
  }
</script>

<template>
<title>infowatchdog</title>

<header>
  <a href="#" class="logo"><span>i</span>nfowatchdog</a>
  <div class="menuToggle" onclick="toggleMenu();"></div>
  <ul class="navbar">
    <li><a href="#banniere" onclick="toggleMenu();">Accueil</a></li>
    <li><a href="#apropos" onclick="toggleMenu();">A propos</a></li>
    <li><a href="#menu" onclick="toggleMenu();">température</a></li>
    <li><RouterLink to="login">Login</RouterLink></li>
  </ul>
</header>

<section class="banniere" id="banniere"></section>
<section class="apropos" id="apropos">
  <div class="row">
    <div class="col50">
      <h2 class="titre-texte"><span>A</span> Propos De Nous</h2>
      <p>Lorsque les composants informatiques, tels que les processeurs, les cartes graphiques et les disques durs, fonctionnent, ils génèrent de la chaleur. Cette chaleur doit être dissipée efficacement pour éviter que les composants ne surchauffent, ce qui pourrait entraîner des problèmes de performance, des pannes ou même des dommages permanents.

         La plupart des composants informatiques sont conçus pour fonctionner dans une plage de température spécifiée par le fabricant. Par exemple, un processeur peut avoir une plage de température de fonctionnement optimale comprise entre 40°C et 80°C. Si la température dépasse ces limites, le processeur peut réduire sa fréquence de fonctionnement (throttling) pour éviter une surchauffe excessive, ce qui peut entraîner une diminution des performances.

         Il est donc important de maintenir une température adéquate à l'intérieur du boîtier de l'ordinateur en utilisant des techniques de refroidissement appropriées. Cela peut inclure l'utilisation de ventilateurs pour faire circuler l'air à l'intérieur du boîtier, l'installation de dissipateurs thermiques sur les composants chauds tels que le processeur, l'utilisation de pâtes thermiques pour améliorer le transfert de chaleur, et même l'utilisation de systèmes de refroidissement liquide plus avancés.
      </p>
    </div>
    <div class="col50">
      <div class="img">
        <img src="../assets/images/plat3.jpg" alt="image">
      </div>
    </div>
  </div>
</section>
<section class="menu" id="menu">
  <div class="titre">
    <h2 class="titre-texte"><span>T</span>emperature</h2>
  </div>
  <div class="contenu">
    <RouterLink to="/home">
      <div class="box">
        <div class="imbox">
          <img src="../assets/images/c1.jpg" alt="">
        </div>
        <div class="text">
          <h3>Data center</h3>
        </div>
      </div>
    </RouterLink>
    <div class="box">
      <div class="imbox">
        <img src="../assets/images/c2.jpg" alt="">
      </div>
      <div class="text">
        <h3>X</h3>
      </div>
    </div>
  </div>
  <div class="titre">
    <a href="#" class="btn1">notre information</a>
  </div>
</section>
<section class="temoignage" id="temoignage"></section>
</template>

<style scoped>
*{
  margin: 0px;
  padding: 0px;
  box-sizing: border-box;
  font-family: 'poppins', sans-serif;
  scroll-behavior: smooth;
}

p{
  font-weight: 300;
  color: #111;
}

header{
  position: fixed;
  top: 0%;
  left: 0%;
  padding: 20px 10px;
  width: 100%;
  z-index: 1;
  display: flex;
  justify-content: space-evenly;
  align-items: center;
  transition: 0.5s;
}

.logo{
  color: #fff;
  font-weight: bold;
  font-size: 2em;
  text-decoration: none;
}
.logo span{
  color: #00d0ff;
}

.navbar{
  display: flex;
  position: relative;
}
.navbar li{
  list-style: none;
}
.navbar a{
  color: #fff;
  text-decoration: none;
  margin-left: 30px;
  font-weight: 700;
}

.btn-reserve{
  padding: 10px 20px;
  background: #00d0ff;
  margin-top: -10px;
  text-transform:uppercase ;
}

.btn-reserve:hover{
  background: #00d0ff;
  transition: ease-out;
}

header .navbar li a:hover{
  color: #00d0ff;
  border-bottom: 2px solid#00d0ff;
}

.banniere{
  position: relative;
  width: 100%;
  min-height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  background-image: url(../assets/images/pageheader-banner.jpg);
  background-size: cover;
}

.banniere .contenu{
  max-width: 70%;
  text-align: center;
}
.banniere .contenu h2{
  color: #fff;
  font-size: 3em;
  text-transform: capitalize;
}
.contenu p:nth-child(2){
  color: #ffff;
  font-size: 1.2em;
}

.btn1{
  font-size: 1em;
  color: #fff;
  background: #00d0ff;
  padding: 10px 20px;
  display: inline-block;
  margin-top: 20px;
  text-decoration: none;
  text-transform: uppercase;
  letter-spacing: 2px;
  transition: 0.5s;
  margin-left: 10px;
}
.btn2{
  font-size: 1em;
  color: #fff;
  background: #2a4963;
  padding: 10px 20px;
  display: inline-block;
  margin-top: 20px;
  text-decoration: none;
  text-transform: uppercase;
  letter-spacing: 2px;
  transition: 0.5s;
  margin-left: 10px;
}

.btn1:hover{
  letter-spacing: 4px;
}
section{
  padding: 100px;
}
.row{
  position: relative;
  width: 100%;
  display: flex;
  justify-content: space-between;
}

.row .col50{
  position: relative;
  width: 48%;
  justify-content: center;
  align-items: center;

}

.row .col50 h2{
  margin-bottom: 20px;
}

.titre-texte{
  color: #000;
  font-size: 2em;
  font-weight: 300px;
  text-transform: capitalize;
}

.titre-texte span{
  color:#00d0ff;
  font-size: 1.5em;
  font-weight: 700px;
}

.row .col50 img{
  height: 450px;
  width: 600px;
  position: relative;
}

.titre{
  display: flex;
  width: 100%;
  justify-content: center;
  align-items: center;
  flex-direction: column;
}

.menu{
  margin-top: -100px;
}

.menu .contenu{
  display: flex;
  justify-content: center;
  flex-wrap: wrap;
  margin-top: 40px;
}

.menu .contenu .box{
  width: 350px;
  margin: 20px;
  border: 20px solid #fff;
  box-shadow: 20px 15px 35px rgba(0,0,0, 0.8);
}

.menu .contenu .box .imbox{
  position: relative;
  width: 100%;
  height: 300px;
}

.menu .contenu .box .imbox img{
  position: relative;
  top: 0;
  left: 0;
  width: 100%;
  height: 300px;
  object-fit: cover;
}

.menu .contenu .box .text{
  text-align: center;
  font-weight: 300px;
  color: #111;
}

.menu .contenu .box .text h3{
  font-weight: 400;
}

.expert{
  margin-top:-100px;
}

.expert .contenu{
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  margin-top: 40px;
}

.expert .contenu .box{
  width: 250px;
  margin: 15px;
}
.expert .contenu .box img{
  position: relative;
  width: 100%;
  height: 300px;
  top: 0;
  left: 0;
  object-fit: cover;
}

.expert .contenu .box h3{
  color: #111;
  font-weight: 400;
  text-align: center;
}

.temoignage{
  background-image: url(./images/bg2.jpg);
  background-size: cover;
}

.temoignage .contenu{
  display: flex;
  margin-top: 40px;
  width: 100%;
  justify-content: center;
  align-items: center;
  flex-wrap: wrap;
  flex-direction: row;
}

.temoignage .contenu .box{
  width: 340px;
  margin: 20px;
  background: #fff;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  border-radius: 15px;
  padding: 40px;
}

.temoignage .contenu .box .imbox{
  width: 80px;
  height: 80px;
  border-radius: 50px;
  position: relative;
  margin-bottom: 20px;
  overflow: hidden;
}

.temoignage .contenu .box .imbox img{
  position: relative;
  width: 100%;
  height: 100%;
  top:0;
  left: 0;
  object-fit: cover;
  justify-content: center;
  align-items: center;
}

.temoignage .contenu .box .text{
  text-align: center;
  color: #666;
  font-style: italic;
}

.temoignage .contenu .box .text h3{
  color:#00d0ff;
  margin-top: 20px;
  font-size: 1em;
  font-weight: 600;
}

.blanc .titre-texte{
  color: #fff;
}

.blanc .titre-texte,
.blanc p{
  color: #fff;
}

.contact{
  background-image: url(./images/img-form.jpg);
  background-size: cover;
  box-shadow: 2px 2px 12px rgba(0,0,0, 0.8);
  width: 100%;
  background-position: unset;
}

.contactform{
  padding: 75px 50px;
  background: #fff;
  box-shadow: 5px 15px 50px rgba(0,0,0, 0.8);
  max-width: 500px;
  margin-top: 50px;
  justify-content: center;
  align-items: center;
  margin-left: 38%;
}

.contactform .inputboite{
  position: relative;
  width: 100%;
  margin-bottom: 20px;
}

.contactform h3{
  color: #111;
  font-size: 1.2em;
  margin-bottom: 20px;
}

.contactform .inputboite input,
.contactform .inputboite textarea{
  width: 100%;
  border: 1px solid #555;
  padding: 10px;
  color: #111;
  outline: none;
  font-size: 16px;
  font-weight: 300;
  resize: none;
}

.contactform .inputboite input[type="submit"]{
  font-size: 1em;
  font-weight: 700;
  color: #ffff;
  background: #00d0ff;
  display: inline-block;
  cursor: pointer;
  text-transform: uppercase;
  text-decoration: none;
  letter-spacing: 2px;
  outline: none;
  border: none;
  transition: 0.5s;
  max-width: 120px;
  align-items: center;
  justify-content: center;
}

.copyright{
  padding: 20px 40px;
  border-top: 2px solid rgba(0,0,0, 0.1);
  background: rgba(228,222,222,);
  text-align: center;
}

.copyright p:nth-child(1){
  color: #333;
}

.copyright a {
  color: #00d0ff;
  text-decoration: none;
  font-weight: 600;
  font-style: italic;
}

.contact .titre-text span{
  color: #00d0ff;
  font-size: 2em;
}

header.sticky{
  background: #fff;
  padding: 10px 10px;
  box-shadow: 0px 5px 20px rgba(0,0,0, 0.05);
}

header.sticky .logo{
  color: #000;
}

header.sticky .navbar li a {
  color: #000;
}

header.sticky li a:hover{
  color:#00d0ff;
  border-bottom: 2px solid#00d0ff;
}

@media (max-width: 991px) {
  header,
  header.sticky{
    padding: 10px 20px;
  }

  header .navbar li{
    margin-left: 0px;
  }

  header .navbar li a {
    text-decoration: none;
    color: #111;
    font-size: 1.6em;
    font-weight: 300;
  }

  .navbar{
    display: none;
  }
  section{
    padding: 20px;
  }

  header .navbar.active{
    width: 100%;
    height: calc(100% -68px);
    position: fixed;
    top: 68px;
    left:0;
    display: flex;
    justify-content: center;
    flex-direction: column;
    background: #ffff;
    align-items: center;
  }

  .menuToggle{
    position: relative;
    width: 40px;
    height: 40px;
    background-image: url(./images/menu.png);
    background-repeat: no-repeat;
    background-position: center;
    cursor: pointer;
    background-size: 30px;
  }

  .menuToggle.active
  {
    background-image: url(./images/close.png);
    background-size: 25px;
    background-repeat: no-repeat;
    background-origin: center;
  }

  header.sticky .menuToggle{
    filter: invert(1);
  }


  .banniere .contenu h2{
    font-size: 2em;
  }

  .row .col50 img{
    margin-left: 18%;
  }

  .contenu p:nth-child(2){
    font-size: 1.2em;
  }
  .expert{
    margin-top: 0px;
  }

  .menu{
    margin-top: 0px;
  }

  .row{
    display: flex;
    flex-direction: column;
  }



  .temoignage h2{
    font-size: 2em;
    text-align: center;
  }

  .temoignage p{
    text-align: center;
  }

  .contactform{
    margin-left: 25%;
  }


  .row .col50 {
    position: relative;
    width: 100%;
    justify-content: center;
    align-items: center;
    margin-bottom: 30px;

  }

  .row{
    flex-direction: column;
  }
}

@media (max-width: 480px)
{
  .banniere .contenu h2{
    font-size: 2.2em;
    color: #fff;
  }

  .titre-text{
    color: #000;
    font-size: 2rem;
    font-weight: 300;
    text-transform: capitalize;
  }

  .temoignage h2
  {
    font-size: 1.1em;
  }

  .temoignage p{
    text-align: center;
  }
}
</style>