<?php include_once('../app/views/header.php'); ?>
<?php if (isset($data['errMSG']) and strlen($data['errMSG']) > 0) : ?>

    <p class="bg-danger"><?php echo $data['errMSG'] ?></p>

<?php elseif (isset($data['success']) and strlen($data['success']) > 0): ?>

    <p class="bg-success"><?php echo $data['success']; ?></p>

<?php endif ?>
<center>
    <?php if (isset($_SESSION['user']['id']) && ($_SESSION['user']['id'] == $data['pic']['owner_id'] || $_SESSION['user']['is_admin'] == 1)): ?>

        <a href="<?php echo BASEURL; ?>pictures/delete/<?php echo $data['pic']['id']; ?> " class="btn btn-danger">Delete</a>

    <?php endif; ?>
    <img src="<?php echo BASEURL; ?>uploads/<?php echo $data['pic']['file_name']; ?>" alt="<?php echo $data['pic']['file_name']; ?>" class="img-responsive">

</center>
<?php if (isset($_SESSION['user']['id'])): ?>
    <?php if ($_SESSION['user']['is_admin'] == 1) : ?>

        <h2>Comments:</h2>
        <hr/>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Date Uploaded</th>
                    <th>Comment</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['comments'] as $k => $v) : ?>

                    <tr>
                        <td><?php echo $v['date_created']; ?></td>
                        <td><?php echo $v['comment']; ?></td>
                        <td><a href="<?php echo BASEURL; ?>comments/delete/<?php echo $v['id']; ?>" class="btn btn-danger">Delete</a></td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>

    <?php else: ?>
        <hr/>
        <br/>
        <center>
            <div>
                <form class="form-inline" method='post'>
                    <label for='comment'>Leave Comment</label><br/>
                    <textarea name='comment'></textarea>
                    <button type="submit" name='submit' class="btn btn-default">Sent</button>
                </form>
            </div>
        </center>
    <?php endif; ?>
<?php endif; ?>