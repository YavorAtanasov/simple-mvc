<?php include_once('../app/views/header.php'); ?>

<table class="table table-hover">
    <thead>
        <tr>
            <th>Date Uploaded</th>
            <th>Comment</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data['res'] as $k => $v) : ?>
            <tr>
                <td><?php echo $v['date_created']; ?></td>;
                <td><?php echo $v['comment']; ?></td>;
                <td><a href="<?php echo BASEURL ?>comments/delete/<?php echo $v['id']; ?>" class="btn btn-danger">Delete</a></td>
            </tr>
        <?php endforeach; ?>       
    </tbody>
</table>