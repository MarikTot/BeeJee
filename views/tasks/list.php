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
            <button onclick="go('/<?= $page ?>/id')" class="btn btn-info <?= $order === 'id' ? 'active' : '' ?>">Default</button>
            <button onclick="go('/<?= $page ?>/user')" class="btn btn-info <?= $order === 'user' ? 'active' : '' ?>">User</button>
            <button onclick="go('/<?= $page ?>/email')" class="btn btn-info <?= $order === 'email' ? 'active' : '' ?>">Email</button>
            <button onclick="go('/<?= $page ?>/completed_at')" class="btn btn-info <?= $order === 'completed_at' ? 'active' : '' ?>">Status</button>
        </div>
        <div class="col-1">
            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                <label class="btn btn-secondary <?= isset($orderType) && 'asc' === $orderType ? 'active' : '' ?>">
                    <input type="radio" name="order" id="asc" autocomplete="off" value="asc" <?= isset($orderType) && 'asc' === $orderType ? 'checked' : '' ?>>
                    ASC
                </label>
                <label class="btn btn-secondary <?= isset($orderType) && 'desc' === $orderType ? 'active' : '' ?>">
                    <input type="radio" name="order" id="desc" autocomplete="off" value="desc" <?= isset($orderType) && 'desc' === $orderType ? 'checked' : '' ?>>
                    DESC
                </label>
            </div>
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
                    <th width="100" scope="col">Name</th>
                    <th width="150" scope="col">Email</th>
                    <th scope="col">Text</th>
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
