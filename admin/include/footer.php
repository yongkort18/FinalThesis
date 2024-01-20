</div>
</div>

<!-- Vendor JS Files -->
<script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../assets/vendor/chart.js/chart.umd.js"></script>
<script src="../assets/vendor/echarts/echarts.min.js"></script>
<script src="../assets/vendor/quill/quill.min.js"></script>
<script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="../assets/vendor/tinymce/tinymce.min.js"></script>
<script src="../assets/vendor/php-email-form/validate.js"></script>



<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<!-- ALERTIFY JS-->
<script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>


<script src="../assets/js/main.js"></script>

<script>
    <?php if(isset($_SESSION['message'])) 
    { ?> 
        alertify.set('notifier','position', 'top-right');
        alertify.success('<?= $_SESSION['message']; ?>');
        <?php 
        unset($_SESSION['message']);
    } 
    ?>
</script>

<script>
        $(document).ready(function() {
            $('#datatable').DataTable();
            $('#datatable2').DataTable();
        });
</script>

</body>
</html>