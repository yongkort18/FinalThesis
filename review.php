<?php include('included/header.php'); ?>

<title>Review</title>

<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
<script src="assets/js/jquery-3.6.0.min.js"></script>
<script src="assets/js/popper.min.js"></script>

<script src="assets/js/jquery-3.6.0.min.js"></script>
<script src="assets/js/popper.min.js"></script>


<div class="container" style="margin-top: 200px;">
    <div class="card">
        <?php
        $maintenance = getAll("tbl_maintenance");

        if (mysqli_num_rows($maintenance) > 0) {
            foreach ($maintenance as $data) {
        ?>
                <div class="card-header"><?= $data['titlepage'] ?> Reservation System Review</div>
        <?php
            }
        } else {
            echo "No Records Found";
        }
        ?>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-4 text-center">
                    <h1 class="text-warning mt-4 mb-4">
                        <b><span id="average_rating">0.0</span> / 5</b>
                    </h1>
                    <div class="mb-3">
                        <i class="fas fa-star star-light mr-1 main_star"></i>
                        <i class="fas fa-star star-light mr-1 main_star"></i>
                        <i class="fas fa-star star-light mr-1 main_star"></i>
                        <i class="fas fa-star star-light mr-1 main_star"></i>
                        <i class="fas fa-star star-light mr-1 main_star"></i>
                    </div>
                    <h3><span id="total_review">0</span> Review</h3>
                </div>
                <div class="col-sm-4">
                    <p>
                    <div class="progress-label-left"><b>5</b> <i class="fas fa-star text-warning"></i></div>
                    <div class="progress-label-right">(<span id="total_five_star_review">0</span>)</div>
                    <div class="progress">
                        <div class="progress-bar bg-warining" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="five_start_progress"></div>
                    </div>
                    </p>
                    <p>
                    <div class="progress-label-left"><b>4</b> <i class="fas fa-star text-warning"></i></div>
                    <div class="progress-label-right">(<span id="total_four_star_review">0</span>)</div>
                    <div class="progress">
                        <div class="progress-bar bg-warining" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="four_start_progress"></div>
                    </div>
                    </p>
                    <p>
                    <div class="progress-label-left"><b>3</b> <i class="fas fa-star text-warning"></i></div>
                    <div class="progress-label-right">(<span id="total_three_star_review">0</span>)</div>
                    <div class="progress">
                        <div class="progress-bar bg-warining" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="three_start_progress"></div>
                    </div>
                    </p>
                    <p>
                    <div class="progress-label-left"><b>2</b> <i class="fas fa-star text-warning"></i></div>
                    <div class="progress-label-right">(<span id="total_two_star_review">0</span>)</div>
                    <div class="progress">
                        <div class="progress-bar bg-warining" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="two_start_progress"></div>
                    </div>
                    </p>
                    <p>
                    <div class="progress-label-left"><b>1</b> <i class="fas fa-star text-warning"></i></div>
                    <div class="progress-label-right">(<span id="total_one_star_review">0</span>)</div>
                    <div class="progress">
                        <div class="progress-bar bg-warining" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="one_start_progress"></div>
                    </div>
                    </p>
                </div>
                <!-- Review Modal Button-->
                <div class="col-sm-4 text-center">
                    <?php if (isset($_SESSION["email"])) { ?>
                        <h3 class="mt-4 mb-3">Write Review Here</h3>
                        <button type="button" name="add_review" id="add_review" class="btn btn-primary">Review</button>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-5" id="review_content">
    </div>
    <div id="pagination" class="text-center mt-4">
        <ul class="pagination justify-content-center"></ul>
    </div>
</div>


<!-- Review Modal-->
<div id="review_modal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Submit Review</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="reviewForm">
                    <h3 class="text-center m-3">Star Rating:</h3>
                    <h4 class="text-center mt-2 mb-4">
                        <i class="fas fa-star star-light submit_star mr-1" id="submit_star_1" data-rating="1"></i>
                        <i class="fas fa-star star-light submit_star mr-1" id="submit_star_2" data-rating="2"></i>
                        <i class="fas fa-star star-light submit_star mr-1" id="submit_star_3" data-rating="3"></i>
                        <i class="fas fa-star star-light submit_star mr-1" id="submit_star_4" data-rating="4"></i>
                        <i class="fas fa-star star-light submit_star mr-1" id="submit_star_5" data-rating="5"></i>
                    </h4>
                    <div class="form-group mt-2">
                        <label for="">Full Name</label>
                        <input id="user_name" type="text" value="<?php echo   $_SESSION["fistname"], " ", $_SESSION['middlename'], " ", $_SESSION["lastname"] ?>" name="user_name" class="form-control" placeholder="Name" required readonly>
                    </div>
                    <div class="form-group mt-2">
                        <label for="">Reviews</label>
                        <textarea name="user_review" id="user_review" class="form-control" onkeypress="return /[a-zA-Z\s]/i.test(event.key)" placeholder="Your Review Here"></textarea>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="termsCheck">
                        <label class="form-check-label" for="termsCheck"> I agree to the terms and conditions</label>
                    </div>
                    <div class="form-group text-center mt-4">
                        <button type="button" class="btn btn-primary" id="save_review">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .progress-label-left {
        float: left;
        margin-right: 0.5em;
        line-height: 1em;
    }

    .progress-label-right {
        float: right;
        margin-left: 0.3em;
        line-height: 1em;
    }

    .star-light {
        color: #e9ecef;
    }
</style>

<script>
    function submitReview() {
        if (document.getElementById('termsCheck').checked) {
            document.getElementById('reviewForm').submit();
        } else {
            alert('Please agree to the terms and conditions.');
        }
    }

    $(document).ready(function() {

        $('#save_review').click(function() {
            submitReview();
        });

    });

    $(document).ready(function() {

        var rating_data = 0;

        var reviewsPerPage = 5;
        var currentPage = 1;

        $('#add_review').click(function() {

            $('#review_modal').modal('show');

        });

        $(document).on('mouseenter', '.submit_star', function() {

            var rating = $(this).data('rating');

            for (var count = 1; count <= rating; count++) {

                $('#submit_star_' + count).addClass('text-warning');
            }

        });

        function reset_background() {
            for (var count = 1; count <= 5; count++) {

                $('#submit_star_' + count).addClass('star-light');

                $('#submit_star_' + count).removeClass('text-warning');

            }
        }

        $(document).on('mouseleave', '.submit_star', function() {

            reset_background();

            for (var count = 1; count <= rating_data; count++) {

                $('#submit_star_' + count).removeClass('star-light');

                $('#submit_star_' + count).addClass('text-warning');
            }

        });

        $(document).on('click', '.submit_star', function() {

            rating_data = $(this).data('rating');

        });

        $('#save_review').click(function() {

            var user_name = $('#user_name').val();

            var user_review = $('#user_review').val();

            if (user_name == '' || user_review == '') {
                alert("Please Fill Both Field");
                return false;
            } else {
                $.ajax({
                    url: "submit_rating.php",
                    method: "POST",
                    data: {
                        rating_data: rating_data,
                        user_name: user_name,
                        user_review: user_review
                    },
                    success: function(data) {
                        $('#review_modal').modal('hide');

                        load_rating_data();

                        alert(data);
                    }
                })
            }

        });

        load_rating_data();

        function displayReviews(reviews) {
            var startIndex = (currentPage - 1) * reviewsPerPage;
            var endIndex = startIndex + reviewsPerPage;
            var paginatedReviews = reviews.slice(startIndex, endIndex);

            var reviewContent = document.getElementById('review_content');
            reviewContent.innerHTML = ''; // Clear previous content

            paginatedReviews.forEach(function(review) {
                var reviewElement = document.createElement('div');
                reviewElement.classList.add('review');
                // Create a structured layout for each review
                reviewElement.innerHTML = `
            <div class="card">
                <div class="card-header"><b>${review.user_name}</b></div>
                <div class="card-body">
                    <!-- Display star rating -->
                    <!-- Review content -->
                    <!-- Review date -->
                </div>
            </div>
        `;
                reviewContent.appendChild(reviewElement);
            });
        }

        function displayPagination(totalReviews) {
            var totalPages = Math.ceil(totalReviews / reviewsPerPage);

            var pagination = document.getElementById('pagination').querySelector('ul');
            pagination.innerHTML = ''; // Clear previous pagination

            for (var i = 1; i <= totalPages; i++) {
                var listItem = document.createElement('li');
                listItem.classList.add('page-item');
                var link = document.createElement('a');
                link.classList.add('page-link');
                link.href = '#';
                link.textContent = i;

                link.addEventListener('click', function(page) {
                    return function(event) {
                        event.preventDefault();
                        currentPage = page;
                        load_rating_data();
                    };
                }(i));

                listItem.appendChild(link);
                pagination.appendChild(listItem);
            }
        }


        function load_rating_data() {
            $.ajax({
                url: "submit_rating.php",
                method: "POST",
                data: {
                    action: 'load_data'
                },
                dataType: "JSON",
                success: function(data) {
                    $('#average_rating').text(data.average_rating);
                    $('#total_review').text(data.total_review);

                    var count_star = 0;

                    displayReviews(data.review_data);
                    displayPagination(data.review_data.length);

                    $('.main_star').each(function() {
                        count_star++;
                        if (Math.ceil(data.average_rating) >= count_star) {
                            $(this).addClass('text-warning');
                            $(this).addClass('star-light');
                        }
                    });

                    $('#total_five_star_review').text(data.five_star_review);

                    $('#total_four_star_review').text(data.four_star_review);

                    $('#total_three_star_review').text(data.three_star_review);

                    $('#total_two_star_review').text(data.two_star_review);

                    $('#total_one_star_review').text(data.one_star_review);

                    $('#five_star_progress').css('width', (data.five_star_review / data.total_review) * 100 + '%');

                    $('#four_star_progress').css('width', (data.four_star_review / data.total_review) * 100 + '%');

                    $('#three_star_progress').css('width', (data.three_star_review / data.total_review) * 100 + '%');

                    $('#two_star_progress').css('width', (data.two_star_review / data.total_review) * 100 + '%');

                    $('#one_star_progress').css('width', (data.one_star_review / data.total_review) * 100 + '%');
                    // Assuming data.review_data[count].user_name is a string

                    if (data.review_data.length > 0) {
                        var html = '';


                        for (var count = 0; count < data.review_data.length; count++) {
                            // Assuming data.review_data[count].user_name is a string
                            var userName = data.review_data[count].user_name;

                            // Extract the first and last letters
                            var firstLetter = userName.charAt(0);
                            var lastLetter = userName.charAt(userName.length - 1);

                            // Create the truncated name with only the first and last letters
                            var truncatedName = firstLetter + '*********' + lastLetter;
                            html += '<div class="row mb-3">';

                            html += '<div class="col-sm-1"><div class="rounded-circle bg-danger text-white pt-2 pb-2"><h3 class="text-center">' + data.review_data[count].user_name.charAt(0) + '</h3></div></div>';

                            html += '<div class="col-sm-11">';

                            html += '<div class="card">';

                            html += '<div class="card-header"><b id="rev_name">' + truncatedName + '</b></div>';

                            html += '<div class="card-body">';

                            for (var star = 1; star <= 5; star++) {
                                var class_name = '';

                                if (data.review_data[count].rating >= star) {
                                    class_name = 'text-warning';
                                } else {
                                    class_name = 'star-light';
                                }

                                html += '<i class="fas fa-star ' + class_name + ' mr-1"></i>';
                            }

                            html += '<br />';

                            html += data.review_data[count].user_review;

                            html += '</div>';

                            html += '<div class="card-footer text-right">On ' + data.review_data[count].datetime + '</div>';

                            html += '</div>';

                            html += '</div>';

                            html += '</div>';
                        }

                        $('#review_content').html(html);
                    }
                }
            })
        }

    });
</script>

<?php include('included/footer.php'); ?>