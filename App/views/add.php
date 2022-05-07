<?php $title = 'Добавить новую задачу' ?>
<?php include 'wrapper.php' ?>
    <div class="container">
        <h2 class="py-3 text-center">Создать новую задачу</h2>
        <main class="col-sm-9 col-md-6 mx-auto">
            <form method="POST" novalidate>
                <label class="d-flex flex-column">
                    <div>Текст задачи</div>
                    <textarea class="mt-1 px-2 py-1" name="text" required rows="5"><?= $this->filteredInput['text'] ?? null ?></textarea>
                    <?php if (isset($this->errors['text'])): ?>
                        <div class="mt-1 small text-danger"><?= $this->errors['text'] ?></div>
                    <?php endif ?>
                </label>
                <label class="d-flex flex-column mt-3">
                    <div>Имя пользователя</div>
                    <input class="mt-1 px-2 py-1" name="username" required value="<?= $this->filteredInput['username'] ?? null ?>">
                    <?php if (isset($this->errors['username'])): ?>
                        <div class="mt-1 small text-danger"><?= $this->errors['username'] ?></div>
                    <?php endif ?>
                </label>
                <label class="d-flex flex-column mt-3">
                    <div>Email</div>
                    <input class="mt-1 px-2 py-1" name="email" type="email" required value="<?= $this->filteredInput['email'] ?? null ?>">
                    <?php if (isset($this->errors['email'])): ?>
                        <div class="mt-1 small text-danger"><?= $this->errors['email'] ?></div>
                    <?php endif ?>
                </label>
                <div class="d-flex justify-content-center">
                    <button class="mt-4 px-5 py-2 btn btn-primary">Создать</button>
                </div>
            </form>
        </main>
    </div>
<?php include 'footer.php' ?>

