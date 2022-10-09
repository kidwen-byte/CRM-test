<?php if ($clients) : ?>
    <div class="container">
        <div class="table">
            <div class="table-row">
                <div class="table-row__col">Имя</div>
                <div class="table-row__col">Email</div>
                <div class="table-row__col">Телефон</div>
            </div>
            <?php foreach ($clients as $client) : ?>
                <div class="table-row">
                    <div class="table-row__col"><?= $client['name'] ?></div>
                    <div class="table-row__col"><?= $client['email'] ?></div>
                    <div class="table-row__col">+<?= $client['tel'] ?></div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="filter">
            <select name="" id="">
                <option value="name">Имена</option>
                <option value="email">Email</option>
                <option value="tel">Телефоны</option>
            </select>
            <button>sdxfds</button>
        </div>
    </div>
<?php else : ?>
    <p>Список клиентов пуст</p>
<?php endif; ?>