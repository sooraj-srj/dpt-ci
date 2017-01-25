<?php
$error = f('error_message') ? f('error_message') : validation_errors();
if (!empty($error)) {
    echo '<div class="text-left">                                        
            <div class="alert alert-danger">
            ' . $error . '
            </div>                                        
         </div>';
}
?>
<?php if (f('success_message') != '') : ?>
    <div class="text-center">                                        
        <div class="alert alert-success">
            <?php echo f('success_message'); ?>
        </div>                                        
    </div>
<?php endif; 