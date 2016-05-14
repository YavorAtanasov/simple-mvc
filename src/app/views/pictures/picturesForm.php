<?php include_once('../app/views/header.php'); ?>
<?php if (isset($data['errMSG']) and strlen($data['errMSG']) > 0) : ?>

    <p class="bg-danger"><?php echo $data['errMSG']; ?></p>

<?php elseif (isset($data['success']) and strlen($data['success']) > 0) : ?>

    <p class="bg-success"> <?php echo $data['success']; ?></p>

<?php endif; ?>

<center>
    <div>

        <form action="<?php echo BASEURL; ?>/pictures/upload" method="post" enctype="multipart/form-data">
            Select image to upload:
            <div class="form-group">
                <input type="file" name="file" id="fileToUpload">
            </div>
            <input type="submit" class="btn btn-primary" value="Upload Image" name="submit">
        </form>
    </div>
</center>