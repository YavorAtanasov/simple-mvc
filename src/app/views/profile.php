<?php include_once('../app/views/header.php'); ?>
<center>
    <?php if (isset($data['errMSG']) and strlen($data['errMSG']) > 0): ?>

        <p class="bg-danger"><?php echo $data['errMSG']; ?></p>

    <?php elseif (isset($data['success']) and strlen($data['success']) > 0): ?>

        <p class="bg-success"><?php echo $data['success']; ?></p>

    <?php endif; ?>

    <div>
        <form class="form-inline"  action="<?php echo BASEURL; ?>users/profile" method="post">

            <div class="">
                <label class="sr-only" for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
            </div>
            <div class="">
                <label class="sr-only" for="name">First Name</label>
                <input type="text" class="form-control" id="name" name="first_name" value="<?php echo isset($data['first_name']) ? $data['first_name'] : null ?>">
            </div>
            <div class="">
                <label class="sr-only" for="LastName">Last Name</label>
                <input type="text" class="form-control" id="LastName" name="last_name" value="<?php echo isset($data['last_name']) ? $data['last_name'] : null ?>">
            </div>


            <div class="">
                <label class="sr-only" for="phone">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" value="<?php echo isset($data['phone']) ? $data['phone'] : null ?>">
            </div>
            <div class="">
                <label class="sr-only" for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo isset($data['email']) ? $data['email'] : null ?>">
            </div>
            <div class="">
                <label class="sr-only" for="address">Address</label>
                <input type="text" class="form-control" id="address" name="address" value="<?php echo isset($data['address']) ? $data['address'] : null ?>">
            </div>
            <div class="">
                <label class="sr-only" for="city">City</label>
                <input type="city" class="form-control" id="city" name="city" value="<?php echo isset($data['city']) ? $data['city'] : null ?>">
            </div>
            <div class="">
                <label class="sr-only" for="zip">Zip</label>
                <input type="zip" class="form-control" id="zip" name="state" value="<?php echo isset($data['state']) ? $data['state'] : null ?>">
            </div>
            <button type="submit" name="submit" class="btn btn-default">Submit</button>
        </form>
    </div>
</center>