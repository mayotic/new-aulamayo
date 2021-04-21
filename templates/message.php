<?php if( !empty( $error )){ ?>
    <div class="alert alert-danger text-center">
        <span> <?php echo $error; ?> </span>
    </div>
<?php } ?>

<?php if( !empty( $success )){ ?>
    <div class="alert alert-success text-center">
        <span> <?php echo $success; ?> </span>
    </div>
<?php } ?>

<?php if( !empty( $success ) || !empty( $error ) ){ ?>
    <script>
        $(document).ready(function(){
            $('.alert').delay(4000).slideUp();
        });
    </script>
<?php } ?>