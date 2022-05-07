<?php $title = 'Редактировать задачу' ?>
<?php include 'wrapper.php' ?>
    <div class="container">
        <header class="py-5 text-center">
        <h2 class="py-3 text-center">Редактировать задачу</h2>
        </header>
        <main class="col-sm-9 col-md-6 mx-auto">
            <form method="POST" novalidate>
                <input name="id" type="hidden" value="<?= $this->filteredInput['id'] ?? null ?>">
                <label class="d-flex flex-column">
                    <div>Текст задачи</div>
                    <textarea class="mt-1 px-2 py-1" name="text" rows="5" required><?= $this->filteredInput['text'] ?? $this->task['text'] ?></textarea>
                    <?php if (isset($this->errors['text'])): ?>
                        <div class="mt-1 small text-danger"><?= $this->errors['text'] ?></div>
                    <?php endif ?>
                </label>
                <label class="d-flex flex-column mt-3">
                    <div>Имя пользователя</div>
                    <input class="mt-1 px-2 py-1" name="username" required value="<?= $this->filteredInput['username'] ?? $this->task['username'] ?>">
                    <?php if (isset($this->errors['username'])): ?>
                        <div class="mt-1 small text-danger"><?= $this->errors['username'] ?></div>
                    <?php endif ?>
                </label>
                <label class="d-flex flex-column mt-3">
                    <div>Email</div>
                    <input class="mt-1 px-2 py-1" name="email" type="email" required value="<?= $this->filteredInput['email'] ?? $this->task['email'] ?>">
                    <?php if (isset($this->errors['email'])): ?>
                        <div class="mt-1 small text-danger"><?= $this->errors['email'] ?></div>
                    <?php endif ?>
                </label>
                <div class="mt-3"></div>
                    <label class="d-flex align-items-center">
                        <input name="status" type="checkbox" value="1" <?= ($this->filteredInput['status'] ?? (int)$this->task['status']) === 1 ? 'checked' : '' ?>>
                        <div class="ms-2">Выполнена</div>
                    </label>
                </div>
                <div class="d-flex justify-content-center">
                    <button class="mt-4 px-5 py-2 btn btn-primary">Сохранить</button>
                </div>
            </form>
        </main>
    </div>
<?php include 'footer.php' ?>