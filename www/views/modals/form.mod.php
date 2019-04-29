<?php $data = ($config["config"]["method"] == "POST") ? $_POST : $_GET; ?>

<?php if (!empty($config["errors"])): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach ($config["errors"] as $errors): ?>
            <li><?php echo $errors; ?>
                <?php endforeach ?>
        </ul>
    </div>
<?php endif ?>


<form
        action="<?php echo $config["config"]["action"]; ?>"
        method="<?php echo $config["config"]["method"]; ?>"
        class="<?php echo $config["config"]["class"]; ?>"
        id="<?php echo $config["config"]["id"]; ?>"
>

    <?php foreach ($config["data"] as $key => $value): ?>


        <div class="form-group">
            <div class="form-label-group">
                <?php if ($value["type"] == "text" || $value["type"] == "email" || $value["type"] == "password"): ?>

                    <?php if ($value["type"] == "password") {
                        unset($data[$key]);
                    } ?>


                    <input type="<?php echo $value["type"]; ?>"
                           name="<?php echo $key; ?>"
                           placeholder="<?php echo $value["placeholder"]; ?>"
                        <?php echo ($value["required"]) ? 'required="required"' : ''; ?>
                           id="<?php echo $value["id"]; ?>"
                           class="<?php echo $value["class"]; ?>"
                           value="<?php echo $data[$key] ?? '' ?>"
                    >

                    <label for="<?php echo $value["id"]; ?>" "><?php echo $value["placeholder"]; ?></label>

                <?php endif; ?>

            </div>
        </div>


    <?php endforeach; ?>


    <input type="submit" class="btn btn-primary btn-block" value="<?php echo $config["config"]["submit"]; ?>">


    <?php if (!empty($config["config"]["reset"])): ?>
        <input type="reset" class="btn btn-danger btn-block" value="<?php echo $config["config"]["reset"]; ?>">
    <?php endif; ?>


</form>
