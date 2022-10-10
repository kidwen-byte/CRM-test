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
            <select id="filter">
                <option value="name">Имена</option>
                <option value="email">Email</option>
                <option value="tel">Телефоны</option>
            </select>
            <button class="button-filter">Применить</button>
        </div>
    </div>
<?php else : ?>
    <p>Список клиентов пуст</p>
<?php endif; ?>


<script>
    let table = document.querySelector('.table');
    let filter = document.querySelector('.filter');
    let select = document.getElementById('filter');
    let button_filter = document.querySelector('.button-filter');

    button_filter.addEventListener('click', () => {
        let value = select.value;
        (async () => {
            const response = await fetch('/clients/filter', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json;charset=utf-8'
                },
                body: JSON.stringify({
                    params: value
                })
            });
            let answer = await response.json();
            table.innerHTML = ''
            switch (value) {
                case 'name':
                    table.innerHTML = '<div class="table-row"><div class="table-row__col">Имена</div></div>'
                    answer.forEach(function(item) {
                        table.insertAdjacentHTML('beforeend',
                            `<div class="table-row">
                                <div class="table-row__col">` + item.name + `</div>
                             </div>`);
                    });
                    break;
                case 'email':
                    table.innerHTML = '<div class="table-row"><div class="table-row__col">Email</div></div>'
                    answer.forEach(function(item) {
                        table.insertAdjacentHTML('beforeend',
                            `<div class="table-row">
                                <div class="table-row__col">` + item.email + `</div>
                            </div>`);
                    });
                    break;
                case 'tel':
                    table.innerHTML = '<div class="table-row"><div class="table-row__col">Телефоны</div></div>'
                    answer.forEach(function(item) {
                        table.insertAdjacentHTML('beforeend',
                            `<div class="table-row">
                                <div class="table-row__col">+` + item.tel + `</div>
                            </div>`);
                    });
                    break;
            }
        })();
        if (!document.querySelector(".button-reolad")) {
            filter.insertAdjacentHTML('beforeend', `<button class="button-reolad">Сбросить фильтр</button>`);
            document.querySelector('.button-reolad').addEventListener("click", function() {
                location.reload()
            });
        }
    });
</script>