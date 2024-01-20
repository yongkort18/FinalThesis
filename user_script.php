<!--Bootstrap js-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>



<script type="text/javascript">
  
  
  function submitData() 
  {
    $(document).ready(function(){
        var data = {
            email: $('#email').val(),
            password: $('#password').val(),
            action: $('#action').val()
        };
        $.ajax({
            url:'code_login.php',
            type: 'post',
            data: data,
            success:function(response){
                alert(response);
                window.location = "index.php";

               
            }
        });
    })
  }
</script>