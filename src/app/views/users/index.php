<?php include_once('../app/views/header.php'); ?>

<table class="table table-hover">
    <thead>
        <tr>
            <th>Name</th>
            <th>Uploads</th>
            <?php if (isset($_SESSION['user']['is_admin']) && $_SESSION['user']['is_admin'] == 1): ?>
                <th></th>
            <?php endif; ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data['res'] as $k => $v) : ?>


            <tr>
                <td><span><?php echo $v['first_name'] ?> <?php echo $v['last_name']; ?></span></td>
                <td><?php echo $v['number_of_posts'] ?></td>

                <?php if (isset($_SESSION['user']['is_admin']) && $_SESSION['user']['is_admin'] == 1) : ?>
                    <td> <a href="<?php echo BASEURL ?>pictures/listU/<?php echo $v['id']; ?> " class="btn btn-pimary">Pictures</a>
                        <a href="<?php BASEURL; ?>users/delete/<?php $v['id']; ?>" class="btn btn-danger">Delete</a> </td>

                <?php endif ?>
            </tr>
        <?php endforeach; ?>

    </tbody>
</table>
<?php if ($data['vars']['count'] > 10) : ?>
    <hr/>
    <center>
        <div id='pagination'>
            <?php if ($data['vars']['page'] > 1) : ?>
                <?php $prevPage = $data['vars']['page'] - 1; ?>
                <span style="padding:5px"><a href="<?php echo BASEURL; ?>users/index/<?php echo $prevPage; ?>"><</a>
                <?php endif ?>
                <?php for ($i = 1; $i <= $data['vars']['limit']; $i++) : ?>

                    <span style="padding:5px"><a href="<?php echo BASEURL; ?>users/index/<?php echo $i; ?>"><?php echo $i; ?></a>

                    <?php endfor ?>

                    <?php if ($data['vars']['page'] < $data['vars']['limit']) : ?>
                        <?php $data['vars']['page'] ++; ?>
                        <span style="padding:5px"><a href="<?php echo BASEURL; ?>users/index/<?php echo $data['vars']['page']; ?>">></a>
                        <?php endif ?>
                        </div>
                        </center>
                    <?php endif; ?>
