<?php include('included/header.php'); ?>

<title>Contact Us</title>

<script src="assets/js/contact.js"></script>
<script src="assets/js/email.min.js"></script>

<script type="text/javascript">
  (function() {
    emailjs.init("labzzGNxhcsFEnX61");
  })();
</script>

<style>
  .social-icons a {
    gap: 15px;
    margin-right: 25px;
  }

  .information img {
    width: 25px;
    height: 25px;
  }

  .social-icons img {
    width: 25px;
    height: 25px;
  }

  .text {
    font-family: 'Open Sans', sans-serif;
    font-size: 18px;
  }

  .title {
    font-family: 'Montserrat', sans-serif;
  }

  @media (max-width: 768px) {
    .text {
      font-size: 14px;
    }
  }

  @media (min-width: 768px) and (max-width: 992px) {
    .text {
      font-size: 16px;
    }
  }

  @media (min-width: 992px) and (max-width: 1200px) {
    .text {
      font-size: 18px;
    }
  }
</style>

<div class="container border bg-light" style="margin-top: 200px;">
    <?php
    $contacts = getAll("tbl_contact");
    
    if (mysqli_num_rows($contacts) > 0) {
      foreach ($contacts as $item) {
    ?>
    
      <div class="row">
        <div class="col-md-6 p-5" style="background-color: #F7C815;">
          <h2 class="title">CONTACT US</h2>
          <p class="text mt-3" style="word-wrap: break-word;"><?= $item['Intro']; ?></p>
          <div class="info mt-5">
            <div class="information d-flex align-items-center my-4">
              <img src="img/location.png" class="icon mr-3 mx-4" style="width: 75px; height: 50px;" alt="" />
              <p class="text" style="word-wrap: break-word;"><?= $item['Location']; ?></p>
            </div>
            <div class="information d-flex align-items-center my-4">
              <img src="img/email.png" class="icon mr-3 mx-4" style="width: 75px; height: 50px;" alt="" />
              <p class="text" style="word-wrap: break-word;"><?= $item['Email']; ?></p>
            </div>
            <div class="information d-flex align-items-center my-4">
              <img src="img/phone.png" class="icon mr-3 mx-4" style="width: 75px; height: 50px;" alt="" />
              <p class="text" style="word-wrap: break-word;"><?= $item['Phone']; ?></p>
            </div>
          </div>
          <div class="social-media mt-5">
            <p class="text">For More Info :</p>
            <div class="social-icons">
              <a href="https://www.facebook.com/LoretosEventManagement">
                <img src="img/facebook-f.png">
              </a>
            </div>
          </div>
        </div>
    <?php
      }
    } else {
      echo "No Records Found";
    }
    ?>

    <div class="col-md-6 border-left py-3">
      <h4 class="title m-3">Contact Us</h4>
      <div class="form-group m-3">
        <h5 for="name">Name</h5>
        <input type="text" id="name" name="name" class="form-control" placeholder="Name" onkeypress="return /[a-zA-Z\s]/i.test(event.key)" required />
      </div>
      <div class="form-group m-3">
        <h5 for="email">Email</h5>
        <input type="email" id="email" name="email" class="form-control" placeholder="Email" required />
      </div>
      <div class="form-group m-3">
        <h5 for="text">Subject</h5>
        <input type="text" id="subject" name="subject" class="form-control" placeholder="Subject" onkeypress="return /[a-zA-Z\s]/i.test(event.key)" required />
      </div>
      <div class="form-group textarea m-3">
        <h5 for="message">Messages</h5>
        <textarea id="message" name="message" class="form-control" rows='5' placeholder="Messages" required></textarea>
      </div>
      <button class="btn btn-primary m-3" onclick="sendMail()">Submit</button>
    </div>
      </div>
    </div>

    <!--FAQ-->
    <div class="container mt-5 mb-5">
      <div class="accordion-container text-center">
        <h1 class="title mt-5 mb-3">Frequently Asked Question</h1>
        <?php
        $faq = getAll("tbl_faq");

        if (mysqli_num_rows($faq) > 0) {
          foreach ($faq as $data) {
        ?>
            <div class="accordion mx-5">
              <div class="accordion-item">
                <h2 class="accordion-header ">
                  <button class="accordion-button bg-warning <?= $firstItem ? '' : 'collapsed' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne<?= $data['id'] ?>" aria-expanded="<?= $firstItem ? 'true' : 'false' ?>" aria-controls="collapseOne<?= $data['id'] ?>">
                    <?= $data['question'] ?>
                  </button>
                </h2>
                <div id="collapseOne<?= $data['id'] ?>" class="accordion-collapse <?= $firstItem ? 'show' : 'collapse' ?>" data-bs-parent="#accordionExample">
                  <div class="accordion-body text-start">
                    <?= $data['answer'] ?>
                  </div>
                </div>
              </div>
            </div>
        <?php
            $firstItem = false;
          }
        } else {
          echo "No Records Found";
        }
        ?>
      </div>
    </div>

    <?php include('included/footer.php'); ?>