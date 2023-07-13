<?php
session_start();
session_destroy();
?>

<script>
    window.setTimeout(function(){
        window.location.href = "/pages/index.php";
    }, 1000);
    alert("Logout bem sucedido!");
</script>