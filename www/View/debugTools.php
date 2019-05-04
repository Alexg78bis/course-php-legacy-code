<div class="debugTool">
    <h1>Debug Bar</h1>
    <div class="debug">
        <section>
            <h3>Routing</h3>
            <ol>
                <?php foreach ($_SESSION['routingHistory'] as $route): ?>
                    <li><?= $route ?></li>
                <?php endforeach; ?>
            </ol>
        </section>
        <section>
            <h3>SQL</h3>
            <ol>
                <?php foreach ($_SESSION['sqlHistory'] as $query): ?>
                    <li>
                        <b>Page :</b> <?= $query['page'] ?? '' ?><br><br>
                        <b>SQL :</b> <?= $query['sql'] ?? '' ?><br><br>
                        <b>Params :</b>
                        <pre>
                            <?php print_r($query['params'] ?? []); ?>
                        </pre>
                    </li>
                <?php endforeach; ?>
            </ol>
        </section>
    </div>
</div>