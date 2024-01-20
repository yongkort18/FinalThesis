    <script src="assets/js/jquery-3.7.1.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    
    <!-- ALERTIFY JS-->
    <script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>


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

</body>
</html>