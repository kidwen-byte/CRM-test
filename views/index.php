<h1>Добавить нового клиента</h1>
<input type="text" id="name" placeholder="Имя">
<input type="text" id="email" placeholder="Email">
<input type="text" id="tel" placeholder="Телефон +7999999">
<button class="button-add">Сохранить</button>
<div class="message"></div>

<script>
    let button = document.querySelector('.button-add');
    let message = document.querySelector('.message');
    button.addEventListener('click', () => {
        let name = document.getElementById('name').value;
        let email = document.getElementById('email').value;
        let tel = document.getElementById('tel').value;
        message.innerHTML = '';
        (async () => {
            const response = await fetch('/clients/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json;charset=utf-8'
                },
                body: JSON.stringify({
                    name: name,
                    email: email,
                    tel: tel
                })
            });
            let answer = await response.json();
            clear(); 
            message.innerHTML = answer;
        })();
    });

    function clear() {
        document.getElementById('name').value = '';
        document.getElementById('email').value = '';
        document.getElementById('tel').value = '';
    }
</script>