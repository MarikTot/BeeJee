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
        <div class="col-5">
            Order by:
            <a href="/<?= $page ?? 1 ?>/id/<?= $orderType ?? 'asc' ?>" class="btn btn-info <?= $order === 'id' ? 'active' : '' ?>">Default</a>
            <a href="/<?= $page ?? 1 ?>/user/<?= $orderType ?? 'asc' ?>" class="btn btn-info <?= $order === 'user' ? 'active' : '' ?>">User</a>
            <a href="/<?= $page ?? 1 ?>/email/<?= $orderType ?? 'asc' ?>" class="btn btn-info <?= $order === 'email' ? 'active' : '' ?>">Email</a>
            <a href="/<?= $page ?? 1 ?>/completed_at/<?= $orderType ?? 'asc' ?>" class="btn btn-info <?= $order === 'completed_at' ? 'active' : '' ?>">Status</a>
        </div>
        <div class="col-2">
            <a
                    href="/<?= $page ?? 1 ?>/<?= $order ?? 'id' ?>/asc"
                    class="btn btn-secondary <?= $orderType === 'asc' ? 'active' : '' ?>"
            >
                ASC
            </a>
            <a
                    href="/<?= $page ?? 1 ?>/<?= $order ?? 'id' ?>/desc"
                    class="btn btn-secondary <?= $orderType === 'desc' ? 'active' : '' ?>"
            >
                DESC
            </a>
        </div>
        <div class="col-5 text-right">
            <?= $paginator->paginate() ?>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th width="30" scope="col">id</th>
                    <th width="200" scope="col">Name</th>
                    <th width="200" scope="col">Email</th>
                    <th width="200" scope="col">Text</th>
                    <th width="100" scope="col">Completed</th>
                    <th scope="col"></th>
                    <?php if (isAdmin()): ?>
                        <th width="180" scope="col">Actions</th>
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
                        <td><?= $item->updated_at ? 'Was edited by admin' : '' ?></td>
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

<script>
    function go(link)
    {
        let value = document.querySelector('input[name="order"]:checked').value;
        value = value || 'asc';
        link += '/' + value;
        location.href = link;
    }
</script>
