<?php $title = 'Список задач'; ?>
<?php include 'wrapper.php' ?>

<main class="container">
    <div class="row">
        <h2 class="py-3 text-center">Список задач</h2>
        <div class="col-md-12 mt-3 mt-md-0 py-3 border-bottom border-3">
            <form class="d-flex align-items-end flex-wrap gap-3">
                <div>
                    <div class="fw-bold">Сортировка</div>
                    <div class="mt-2 d-flex flex-column">
                        <select class="form-select" name="sort">
                            <?php foreach ($this::SORTING_FIELDS as $value => $title) : ?>
                                <option <?= $this->filteredInput['sort'] === $value ? 'selected' : '' ?> value="<?= $value ?>"><?= $title ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <div>
                    <div class="fw-bold">Порядок сортировки</div>
                    <div class="mt-2 d-flex flex-column">
                        <select class="form-select" name="sort_order">
                            <?php foreach ($this::SORTING_ORDERS as $value => $title) : ?>
                                <option <?= $this->filteredInput['sort_order'] === $value ? 'selected' : '' ?> value="<?= $value ?>"><?= $title ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <button class="btn btn-primary">Сортировать</button>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 mt-3 mb-3">
            <?php if (htmlspecialchars($success_message) ?? null) : ?>
                <div class="alert alert-success fw-bold" role="alert">
                    <?= htmlspecialchars($success_message) ?>
                </div>
            <?php elseif (htmlspecialchars($error_message) ?? null) : ?>
                <div class="alert alert-danger fw-bold" role="alert">
                    <?= htmlspecialchars($error_message) ?>
                </div>
            <?php endif; ?>
        </div>


        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col" class="col-1">Пользователь</th>
                        <th scope="col" class="col-1">Email</th>
                        <th scope="col" class="col">Текст задачи</th>
                        <th scope="col" class="col-1">Статус</th>
                        <?php if ($USER_ARR['is_admin'] ?? false) : ?>
                            <th scope="col" class="col-1">Действие</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tasks as $task) : ?>
                        <tr>
                            <td><?= $task['username'] ?></td>
                            <td><?= $task['email'] ?></td>

                            <td><?= nl2br($task['text']) ?>
                                <?php if ($task['text_edited']) : ?>
                                    <span class="badge bg-warning text-dark">Отредактировано админом</span>
                                <?php endif; ?>
                            </td>
                            <td><?= (int)$task['status'] === 1 ? '<span class="badge bg-success">Выполнена</span>' : '' ?></td>
                            <?php if ($USER_ARR['is_admin'] ?? false) : ?>
                                <td><a class="text-decoration-none" href="./edit?id=<?= $task['id'] ?>">Редактировать</a></td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>


        <nav>
            <ul class="pagination justify-content-center">
                <?php foreach (range(1, $AllPagesNumber) as $page) : ?>
                    <?php if ($page == $this->filteredInput['page']) : ?>
                        <li class="page-item active"><span class="page-link"><?= $page ?></span></li>
                    <?php else : ?>
                        <li class="page-item">
                            <a class="page-link" href="<?= $this->getPageUrl($page) ?>"><?= $page ?></a>
                        </li>
                    <?php endif; ?>
                <?php endforeach ?>
            </ul>
        </nav>


</main>
<?php include 'footer.php' ?>