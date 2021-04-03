<?php	if(isset($errors) && !empty($errors)) { //var_dump($errors);?>
    <!-- echo '<script>alert("Enter Data is invalid")</script>'; -->
        <button style="display:none;" id="error-state"
            data-state="<?php // if(isset($errors) && !empty($errors)){echo 'true';} ?>"
            onclick="customAlert.alert('Enter Data is invalid')">
        </button>
    <?php } else { ?>
    <?php	if(isset($msg2)) {?>
        <button style="display:none;" id="error-state"
            data-state="<?php //if(isset($msg2)){echo 'true';} ?>"
            onclick="customAlert.alert('No Rooms Available')">
        </button>
    <?php }} ?>

<!-- popup -->