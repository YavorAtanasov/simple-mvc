<?php include_once('../app/views/header.php'); ?>
<center>
    <?php if (isset($data['errMSG']) and strlen($data['errMSG']) > 0): ?>

        <p class="bg-danger"><?php echo $data['errMSG']; ?></p>

    <?php elseif (isset($data['success']) and strlen($data['success']) > 0): ?>

        <p class="bg-success"><?php echo $data['success']; ?></p>

    <?php endif; ?>

    <?php if (!isset($data['doNotShowForm'])): ?>
        <div>
            <form class="form-inline" role="form" data-toggle="validator"  action="<?php echo BASEURL; ?>users/register" method="post">
                <div class="">
                    <label class="sr-only" for="Username">Username</label>
                    <input type="text" class="form-control" name ="username" id="username" placeholder="Username*" required="">
                </div>
                <div class="">
                    <label class="sr-only" for="password">Password</label>
                    <input type="password" required="" data-minlength="6"  class="form-control" id="password" name="password" placeholder="Password*">
                </div>
                <div class="">
                    <label class="sr-only" for="password2">Retype Password</label>
                    <input type="password" required="" data-match="#password" class="form-control" id="password2" name="password2" placeholder="Password*">
                </div>
                <div class="">
                    <label class="sr-only" for="name">First Name</label>
                    <input type="text" required="" class="form-control" id="name" name="first_name" placeholder="First Name*">
                </div>
                <div class="">
                    <label class="sr-only" for="LastName">Last Name</label>
                    <input type="text" required="" class="form-control" id="LastName" name="last_name" placeholder="Last Name*">
                </div>


                <div class="">
                    <label class="sr-only" for="phone">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone">
                </div>
                <div class="">
                    <label class="sr-only" for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                </div>
                <div class="">
                    <label class="sr-only" for="address">Address</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="Address">
                </div>
                <div class="">
                    <label class="sr-only" for="city">City</label>
                    <input type="city" class="form-control" id="city" name="city" placeholder="City">
                </div>
                <div class="">
                    <label class="sr-only" for="zip">Zip</label>
                    <input type="zip" class="form-control" id="zip" name="state" placeholder="Zip">
                </div>
                <button type="submit" name="submit" class="btn btn-default">Submit</button>
            </form>
        </div>
    <?php endif; ?>
</center>