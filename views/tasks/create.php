<div class="container">
    <div class="row mb-2 mt-2">
        <div class="col-12">
            <form action="/create" method="post">
                <div class="form-group">
                    <label for="user">User</label>
                    <input
                        id="user"
                        name="user"
                        type="text"
                        class="form-control"
                        placeholder="Mark"
                        value="<?= $task['user'] ?? '' ?>"
                    />
                    <small class="form-text text-danger">
                        <?= $errors['user'] ?? '' ?>
                    </small>
                </div>
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input
                        id="email"
                        name="email"
                        type="email"
                        class="form-control"
                        placeholder="mark@gmail.com"
                        value="<?= $task['email'] ?? '' ?>"
                    />
                    <small class="form-text text-danger">
                        <?= $errors['email'] ?? '' ?>
                    </small>
                </div>
                <div class="form-group">
                    <label for="text">Text</label>
                    <textarea id="text" name="text" class="form-control" rows="3"><?= $task['text'] ?? '' ?></textarea>
                    <small class="form-text text-danger"><?= $errors['text'] ?? '' ?></small>
                </div>
                <div class="row">
                    <div class="col-6">
                        <a href="/" class="btn btn-secondary">Back to list</a>
                    </div>
                    <div class="col-6 text-right">
                        <button type="submit" class="btn btn-success mb-2">Create +</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>