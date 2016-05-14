<?php include_once('../app/views/header.php'); ?>
<?php if (isset($_SESSION['user']['is_admin']) and $_SESSION['user']['is_admin'] == 1): ?>

    <div id='users'>
        <h2>Users Statistic</h2>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Username</th>
                    <th>Date Registered</th>
                    <th>Is Admin</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>City</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['users'] as $k => $v) : ?>
                    <tr>
                        <td><?php echo $v['first_name']; ?> </td>
                        <td><?php echo $v['last_name']; ?></td>
                        <td><?php echo $v['username'] ?></td>
                        <td><?php echo $v['date_created']; ?></td>
                        <td><?php echo $v['admin']; ?></td>
                        <td><?php echo $v['phone']; ?></td>
                        <td><?php echo $v['email']; ?></td>
                        <td><?php echo $v['city']; ?></td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>

    <div id='users'>
        <h2>Pictures Statistic</h2>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>File Name</th>
                    <th>Date Uploaded</th>
                    <th>Uploaded By</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['pics'] as $k => $v) : ?>
                    <tr>
                        <td><?php echo $v['file_name']; ?></td>
                        <td><?php echo $v['date_created']; ?></td>
                        <td><?php echo $v['first_name'] . " " . $v['last_name']; ?></td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>

<?php else : ?>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Name</th>
                <th>Date Uploaded</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $k => $v) : ?>

                <tr>
                    <td><a href="<?php echo BASEURL; ?>pictures/thumbview/<?php echo $v['id']; ?>"><?php echo $v['file_name']; ?></a></td>
                    <td><?php echo $v['date_created']; ?></td>
                </tr>           
            <?php endforeach; ?>

        </tbody>
    </table>
<?php endif; ?>
