<?php 
use App\Application;
// use App\Utils;

// Utils::preEcho(Application::$app->user);

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Base Framework</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://bootswatch.com/5/simplex/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">Base Framework</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarColor02">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                  <a class="nav-link active" href="/">Home
                      <span class="visually-hidden">(current)</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/contact">Contact</a>
                </li>
            </ul>
          <?php if(Application::isGuest()):  ?>

              <ul class="navbar-nav ml-auto">
                  <li class="nav-item">
                  <a class="nav-link" href="/login">Login</a>
                  </li>
                  <li class="nav-item">
                  <a class="nav-link" href="/register">Register</a>
                  </li>
              </ul>

            <?php else: ?>
              
              <ul class="navbar-nav ml-auto">

                <li class="nav-item">

                  <a class="nav-link" href="/profile">
                    Profile
                  </a>

                </li>

                <li class="nav-item">

                  <a class="nav-link" href="/logout">Welcome <?php echo Application::$app->user->getDisplayName() ?>
                    (Logout)
                  </a>

                </li>

            </ul>
            
            <?php endif; ?>
        
            </div>
        </div>
    </nav>
    
    <!--  Messages flashs pour notifier l'utilisateur -->
    
    <div class="container my-5">

      <?php if (Application::$app->session->getFlash('success')): ?>

        <div class="alert alert-success">

          <?php echo Application::$app->session->getFlash('success') ?>
        
        </div>
      
      <?php endif;  ?>

      <!--  Fin des messages flashs pour notifier l'utilisateur -->

        {{content}}
        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>
