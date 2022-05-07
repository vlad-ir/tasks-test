<?php $title = 'Вход для пользователя' ?>
<?php include 'wrapper.php' ?>
    <div class="container">
    <h2 class="py-3 text-center">Вход для пользователя</h2>
        <main class="col-sm-3 mx-auto">
            <form method="POST" novalidate>
                <label class="d-flex flex-column">
                    <div>Имя пользователя</div>
                    <input class="mt-1 px-2 py-1" name="username" value="<?= $this->filteredInput['username'] ?? null ?>" required>
                    <?php if (isset($this->errors['username'])): ?>
                        <div class="mt-1 small font-bold text-danger"><?= $this->errors['username'] ?></div>
                    <?php endif ?>
                </label>
                <label class="d-flex flex-column mt-3">
                    <div>Пароль</div>
                    <input class="mt-1 px-2 py-1" name="password" type="password" required>
                    <?php if (isset($this->errors['password'])): ?>
                        <div class="mt-1 small font-bold text-danger"><?= $this->errors['password'] ?></div>
                    <?php endif ?>
                </label>
                <div class="d-flex justify-content-center">
                    <button class="mt-4 px-5 py-2 btn btn-primary">Войти</button>
                </div>
            </form>
        </main>
    </div>
<?php include 'footer.php' ?>

