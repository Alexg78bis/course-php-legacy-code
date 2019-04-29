<div class="card card-login mx-auto mt-5">
    <div class="card-header">Login</div>
    <div class="card-body">

        <?php $this->addModal("form", $form); ?>

        <div class="text-center">
            <a class="d-block small mt-3" href="<?php echo Routing::getSlug("Users", "add"); ?>">Register an Account</a>
            <a class="d-block small" href="<?php echo Routing::getSlug("Users", "forgetPassword"); ?>">Forgot
                Password?</a>
        </div>
    </div>
</div>