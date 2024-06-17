<?php
session_start();
  ?>

<!DOCTYPE html>
<html>
<head>
    <title>Запит на влаштування</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> <!-- Include Bootstrap CSS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> <!-- Include jQuery -->
</head>
<body style="background-image: url('../img/background.jpg'); background-repeat: no-repeat; background-size: cover;">
    <?php include("../include/header.php"); ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" style="margin-left: -30px">
                <?php include("sidenav.php"); ?>
            </div>
            <div class="col-md-10">
                <h5 class="text-center my-3">Запит на роботу</h5>
                <div id="show"></div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function(){
            show();

            function show(){
                $.ajax({
                    url: "ajax_job_request.php",
                    method: "POST",
                    success: function(data){
                        $('#show').html(data); // Corrected the selector
                    }
                });
            }

            // Add event listeners for approve and reject buttons
            $(document).on('click', '.approve', function(){
                var id = $(this).attr('id').split('_')[1];
                $.ajax({
                    url: 'ajax_approve.php',
                    method: 'POST',
                    data: {id: id},
                    success: function(data){
                        alert('Запит підтверджено');
                        show();
                    }
                });
            });

            $(document).on('click', '.reject', function(){
                var id = $(this).attr('id').split('_')[1];
                $.ajax({
                    url: 'ajax_reject.php',
                    method: 'POST',
                    data: {id: id},
                    success: function(data){
                        alert('Запит відхилено');
                        show();
                    }
                });
            });



        });
    </script>
</body>
</html>
