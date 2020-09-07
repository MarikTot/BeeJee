<div class="container">
    <div class="row mb-5 mt-2">
        <div class="col-12 text-right">
            <?php if (isAdmin()): ?>
                <a href="/logout" class="btn btn-info">Logout</a>
            <?php else: ?>
                <a href="/login" class="btn btn-info">Login</a>
            <?php endif; ?>
        </div>
    </div>

    <div class="row mb-2 mt-2">
        <div class="col-6">
            Order by:
            <a href="/<?= $page ?>/id" class="btn btn-info <?= $order === 'id' ? 'disabled' : '' ?>">Default</a>
            <a href="/<?= $page ?>/user" class="btn btn-info <?= $order === 'user' ? 'disabled' : '' ?>">User</a>
            <a href="/<?= $page ?>/email" class="btn btn-info <?= $order === 'email' ? 'disabled' : '' ?>">Email</a>
            <a href="/<?= $page ?>/completed_at" class="btn btn-info <?= $order === 'completed_at' ? 'disabled' : '' ?>">Status</a>
        </div>
        <div class="col-6 text-right">
            <?= $paginator->paginate() ?>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Text</th>
                    <th scope="col">Completed</th>
                    <?php if (isAdmin()): ?>
                        <th scope="col">Actions</th>
                    <?php endif; ?>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($list as $item): ?>
                    <tr>
                        <th scope="row"><?= $item->id ?></th>
                        <td><?= $item->user ?></td>
                        <td><?= $item->email ?></td>
                        <td><?= $item->text ?></td>
                        <td><?= $item->completed_at ? 'Yes' : 'no' ?></td>
                        <?php if (isAdmin()): ?>
                            <td>
                                <a class="btn btn-info btn-sm" href="/update/<?= $item->id ?>">Update</a>
                                <?php if (null === $item->completed_at): ?>
                                    <a class="btn btn-warning btn-sm text-light" href="/complete/<?= $item->id ?>">Complete</a>
                                <?php endif;?>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row mb-2 mt-2">
        <div class="col-12 text-right">
            <a href="/create" class="btn btn-success">Create new task +</a>
        </div>
    </div>
</div>