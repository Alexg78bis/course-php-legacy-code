<div class="debugTool">
    <h1>Debug Bar</h1>
    <section>
        <h3>Routing</h3>
        <ol>
            <?php foreach ($_SESSION['routingHistory'] as $route): ?>
                <li><?= $route ?></li>
            <?php endforeach; ?>
        </ol>
    </section>
</div>
