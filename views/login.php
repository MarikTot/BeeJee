<div class="container">
    <div class="row mb-2 mt-2">
        <div class="col-12">
            <form action="/login" method="post">
                <div class="form-group">
                    <label for="login">Login</label>
                    <input
                        id="login"
                        name="login"
                        type="text"
                        class="form-control <?= isset($errors['login']) ? 'is-invalid' : '' ?>"
                        placeholder="Mark"
                        value="<?= $auth['login'] ?? '' ?>"
                    />
                    <div class="invalid-feedback">
                        <?= $errors['login'] ?? '' ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input
                        id="password"
                        name="password"
                        type="password"
                        class="form-control <?= isset($errors['password']) ? 'is-invalid' : '' ?>"
                        value="<?= $auth['password'] ?? '' ?>"
                    />
                    <div class="invalid-feedback">
                        <?= $errors['password'] ?? '' ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <a href="/" class="btn btn-secondary">Back to list</a>
                    </div>
                    <div class="col-6 text-right">
                        <button type="submit" class="btn btn-success mb-2">Login</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>