<?php 
session_start(); 
?>
<?php include 'included/header.php'; ?>

<style>
    body {
        overflow-x: hidden;

    }

    #reservation-body {
        margin-top: 10em;
    }

    @media only screen and (max-width: 500px) {
        #main {
            padding-top: 300px;
        }
    }

    @media only screen and (max-width: 540px) {
        #main {
            padding-top: 300px;
        }
    }

    @media only screen and (max-width: 412px) {
        #main {
            padding-top: 120px;
        }
    }
</style>

<body>
    <title>Loreto's - Reservation</title>

    <main id="main" class="main vh-100 d-flex justify-content-center align-items-center">
        <section class="section w-100">
            <div class="row d-flex justify-content-center">
                <div id="reservation-body" class="col-lg-6 align-items-center">
                    <div class="card">
                        <div class="card-header bg-warning">
                            <h2 class="text-center">Reservation</h2>
                        </div>
                        <div class="card-body">
                            <!--FORM-->
                            <form id="save_reservation" action="" method="" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="">Name:</label>
                                            <input id="name" type="text" value="<?php echo   $_SESSION["fistname"], " ", $_SESSION['middlename'], " ", $_SESSION["lastname"] ?>" name="user_name" class="form-control" placeholder="Name" required readonly>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="">Phone Number:</label>
                                        <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">63+</span>
                                        <input id="number" type="text" name="number" class="form-control" required oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="10">
                                    </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="">Email:</label>
                                            <div class="input-group">
                                                <span class="input-group-text" id="basic-addon1">@</span>
                                                <input id="email" type="email" value="<?php echo $_SESSION['email'] ?>" name="email" class="form-control" required readonly>
                                            </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="">Reserve Date:</label>
                                        <input id="datePicker" type="date" name="date" class="form-control" required min="" max="">
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label for="">Packages:</label>
                                        <div class="input-group">
                                            <label class="input-group-text" for="inputGroupSelect01">Options</label>
                                            <select class="form-select" id="inputGroupSelect01" name="food_package" onchange="updatePrice(this)">
                                                <?php
                                                include 'database/dbconn.php';
                                                $packages = mysqli_query($con, "Select * from package");
                                                while ($row = mysqli_fetch_assoc($packages)) {


                                                ?>
                                                    <option value="" disabled selected hidden>Choose Package</option>
                                                    <option value="<?php echo $row['package_name'] ?>" data-price="<?php echo $row['price'] ?>"><?php echo $row['package_name'] ?></option>
                                                <?php }  ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label for="">Price:</label>
                                        <input  type="number" id="priceInput" name="price" class="form-control" required readonly>
                                    </div>


                                    <div class="col-md-6 mb-4">
                                        <label for="">Pax:</label>
                                        <input id="pax" type="number" name="pax" class="form-control" min="30" required>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="">Total Amount:</label>
                                        <input id="total" type="number" name="total" class="form-control" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="">Payment Receipt:</label>
                                        <input id="" type="file" name="image" class="form-control" accept=".jpg, .jpeg, .png" required>
                                        <h6 class="text-secondary">Note: Kindly provide a screenshot of your payment for the reservation fee of ₱200.00.</h6>
                                    </div>

                                    <div class="form-group text-end">
                                        <button type="submit" name="save_reservation" class="btn btn-primary">Save</button>
                                    </div>

                                </div>
                            </form>

                        </div>
                    </div>
                </div>
        </section>
    </main>

    <script>
    document.getElementById('inputGroupSelect01').addEventListener('change', function () {
        var selectedOption = this.options[this.selectedIndex];

        document.getElementById('priceInput').value = selectedOption.getAttribute('data-price');
        
    });
    
     function updateTotal() {
        
        var pax = parseInt(document.getElementById('pax').value) || 0; 
        var price = parseFloat(document.getElementById('priceInput').value) || 0; 

        var total = pax * price;

        document.getElementById('total').value = total.toFixed(2); 
    }

    document.getElementById('pax').addEventListener('input', updateTotal);
    document.getElementById('priceInput').addEventListener('input', updateTotal);

    document.getElementById('inputGroupSelect01').addEventListener('change', function () {
        var selectedOption = this.options[this.selectedIndex];
        document.getElementById('priceInput').value = selectedOption.getAttribute('data-price');

        updateTotal();
    });
</script>
</body>

<?php include 'included/footer.php' ?>
<?php include 'reservation_script.php' ?>
<script>
  // Set min and max attributes for the date input
  var today = new Date();
  var minDate = new Date(today.getTime() + 14 * 24 * 60 * 60 * 1000); // 14 days from today
  var formattedMinDate = minDate.toISOString().split('T')[0]; // Convert to YYYY-MM-DD format
  document.getElementById('datePicker').setAttribute('min', formattedMinDate);
</script>