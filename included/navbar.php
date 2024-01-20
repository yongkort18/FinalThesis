<style>
  .head {
    font-family: 'Montserrat', sans-serif;
    font-weight: bold;
  }
  
  .mobile-limited-width {
    max-width: 380px;
    margin: 0 auto; 
  }
   
  #login_btn {
    border-color: white;
    width: 150px;
    height: 50px;
    color: white;
  }

  #register_btn {
    border-color: white;
    width: 150px;
    height: 50px;
    color: white;
  }

  #login_btn:hover {
    border-color: #F7C815;
    color: #F7C815;
  }

  #register_btn:hover {
    background-color: #F7C815;
    border-color: #F7C815;
  }

  @media (max-width: 768px) {
    nav .navbar-brand {
      font-size: 18px;
    }

    nav img {
      max-width: 50px;
    }

    nav.navbar {
      width: 100%; 
      padding: 0 15px; 
    }

    .offcanvas-body {
      padding: 0; 
    }

    .offcanvas {
      width: 100%;
    }

    .offcanvas-end {
      width: 100%;
    }
  }
  .navbar {
        z-index: 999; /* Adjust the value as needed */
    }
</style>

<!--NAVBAR-->
<header>

  <?php
  $maintenance = getAll("tbl_maintenance");

  if (mysqli_num_rows($maintenance) > 0) {
    foreach ($maintenance as $data) {
  ?>
      <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: <?= $data['navcolor'] ?>; height: 100px;">
        <div class="container">
          <img src="admin/logo/<?= $data['image'] ?>" style="width:75px; mix-blend-mode: normal;"><!--Image-->
          <a class="navbar-brand m-3" href="#"><?= $data['titlepage'] ?> Reservation System</a><!--Title Page-->
          <button class="navbar-toggler bg-warning" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <!--Toggler-->
          <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
            <div class="offcanvas-header">
              <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel"><?= $data['titlepage'] ?></h5>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
        <?php
      }
    } else {
      echo "No Records Found";
    }
        ?>
        <div class="offcanvas-body">
          <ul class="navbar-nav justify-content-end flex-grow-1">
            <li class="nav-item m-3 mt-4">
              <a class="nav-link active head" href="index.php">Home</a>
            </li>
            <li class="nav-item m-3 mt-4">
              <a class="nav-link active head" href="menu.php">Menu</a>
            </li>
            <li class="nav-item m-3 mt-4">
              <a class="nav-link active head" href="about.php">About Us</a>
            </li>
            <li class="nav-item m-3 mt-4">
              <a class="nav-link active head" href="review.php">Review</a>
            </li>
            <li class="nav-item m-3 mt-4">
              <a class="nav-link active head ml-3 mr-2" href="contact.php">Contact Us</a>
            </li>
            <?php if (isset($_SESSION["email"])) { ?>
              <li class="nav-item m-3 mt-4">
                <a class="nav-link active head block" href="reservation.php">Reservation</a>
              </li>
              <li class=" nav-item dropdown m-3 mt-4">
                <a class="nav-link dropdown-toggle active head" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Hi! 
                  <?php echo$_SESSION["lastname"]?>
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="#">Profile</a></li>
                  <li>
                    <hr class="dropdown-divider">
                  </li>
                  <li><a class="dropdown-item" href="logout.php">logout</a></li>
                </ul>
              </li>

            <?php } else { ?>
              <li class="nav-item my-3 mt-4">
                <a id="login_btn" href="login.php" class="btn btn-white text-decoration-none btn-block head p-2 ">
                <span>Login</span></a>
              </li>
              <li class="nav-item mx-3 mt-4">
                <a id="register_btn" href="register.php" class="btn btn-white text-decoration-none btn-block head p-2 ">
                  <span>Registe</span>r</a>
              </li>
            <?php } ?>
          </ul>
        </div>
          </div>
        </div>
      </nav>
</header>