<div class="card mb-3">
    <div class="card-header">
        <i class="fas fa-table"></i>
        Liste des utilisateurs
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Prénom</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Statut</th>
                    <th>Role</th>
                </tr>
                </thead>
                <tbody>
                <?php if (!empty($users)): ?>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= $user->getId() ?? ''; ?></td>
                            <td><?= $user->getName()->getFirstname() ?? ''; ?></td>
                            <td><?= $user->getName()->getLastname() ?? ''; ?></td>
                            <td><?= $user->getAccount()->getCredentials()->getEmail() ?? ''; ?></td>
                            <td><?= $user->getStatus() ?? ''; ?></td>
                            <td><?= $user->getAccount()->getRole() ?? ''; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer small text-muted">Mis à jour le <?= date('d/m/Y à H:i'); ?></div>
</div>
