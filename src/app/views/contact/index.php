<?php include_once('../app/views/header.php'); ?>
<center>
    <?php if (isset($data['errMSG']) and strlen($data['errMSG']) > 0): ?>

        <p class="bg-danger"><?php echo $data['errMSG']; ?></p>

    <?php elseif (isset($data['success']) and strlen($data['success']) > 0): ?>

        <p class="bg-success"><?php echo $data['success']; ?></p>
    <?php endif; ?>

    <div>
        <form class="form-inline"  action="" method='post' >

            <div class="">
                <label class="sr-only" for="name">Name</label>
                <input type="text" class="form-control" id="name" name='name' placeholder='Name'>
            </div>

            <div class="">
                <label class="sr-only" for="email">Email</label>
                <input type="email" class="form-control" id="email" name='email' placeholder='Email'>
            </div>
            <div class="">
                <label class="sr-only" for="message">Message</label>
                <textarea type="text" class="form-control" id="message" name='message' placeholder='Message'></textarea>
            </div>
            <button type="submit" name='submit' class="btn btn-default">Send</button>
        </form>
    </div>
</center>