<div class="container">
    <div class="row mb-2 mt-2">
        <div class="col-12">
            <form action="/update/<?= $task['id'] ?? '' ?>" method="post">
                <div class="form-group">
                    <label for="user">User</label>
                    <input
                        id="user"
                        name="user"
                        type="text"
                        class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>"
                        placeholder="Mark"
                        value="<?= $task['user'] ?? '' ?>"
                        disabled
                    />
                    <div class="invalid-feedback">
                        <?= $errors['user'] ?? '' ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input
                        id="email"
                        name="email"
                        type="email"
                        class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>"
                        placeholder="mark@gmail.com"
                        value="<?= $task['email'] ?? '' ?>"
                        disabled
                    />
                    <div class="invalid-feedback">
                        <?= $errors['email'] ?? '' ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="text">Text</label>
                    <textarea id="text" name="text" class="form-control <?= isset($errors['text']) ? 'is-invalid' : '' ?>" rows="3"><?= $task['text'] ?? '' ?></textarea>
                    <div class="invalid-feedback">
                        <?= $errors['text'] ?? '' ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <a href="/" class="btn btn-secondary">Back to list</a>
                    </div>
                    <div class="col-6 text-right">
                        <button type="submit" class="btn btn-info mb-2">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>