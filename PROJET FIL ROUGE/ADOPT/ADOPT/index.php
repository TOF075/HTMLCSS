<?php
include('./head.php');
?>
<link rel="stylesheet" href="./css/index.css" /> 

<body class="text-center">
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
  <header class="masthead mb-auto">
    <div class="inner">
      <img class="masthead-brand" src="./logoADOPT.png" alt="logo" width="75" height="75"/>
      <nav class="nav nav-masthead justify-content-center">
        <a class="nav-link active" href="./index.php">Accueil</a>
        <a class="nav-link" href="./connexion.php">Connexion</a>
      </nav>
    </div>
  </header>

  <main role="main" class="inner cover">
    <h1 class="cover-heading">Adopte Un Stage</h1>
    <p class="lead">Trouvez votre stage en un geste !</p>
    <p class="lead">
      <a href="./inscription.php"  class="btn btn-lg btn-secondary">Je Cherche un stage</a>
      <a href="./inscription.php"  class="btn btn-lg btn-secondary">Je Cherche un stagiaire</a>
    </p>
  </main>
 
  <footer class="mastfoot mt-auto">
    <div class="inner">
      <p>Marque déposée par IFA - Institut Francais Des Affaires, Coded by <a href="https://twitter.com/mdo">PERES</a>.</p>
    </div>
  </footer>
</div>
<?php
include('./js/bootstrap.php');
?>
</body>
</html>
