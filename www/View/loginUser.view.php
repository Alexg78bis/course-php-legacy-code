<?php use Core\Routing;

?>
<div class="card card-login mx-auto mt-5">
    <div class="card-header">Login</div>
    <div class="card-body">

        <?php
        if (!empty($form)) {
            $this->addModal('form', $form);
        }
        ?>

        <div class="text-center">
            <a class="d-block small mt-3" href="<?php echo Routing::getSlug('User', 'add'); ?>">Register an Account</a>
            <a class="d-block small" href="<?php echo Routing::getSlug('User', 'forgetPassword'); ?>">Forgot
                Password?</a>
        </div>
    </div>
</div>