<?php include_once('../app/views/header.php'); ?>

<?php if (isset($data['errMSG']) and strlen($data['errMSG']) > 0): ?>

    <p class="bg-danger"><?php echo $data['errMSG']; ?> </p>

<?php elseif (isset($data['success']) and strlen($data['success']) > 0): ?>

    <p class="bg-success"> <?php echo $data['success']; ?></p>

<?php endif; ?>
