const nome = document.getElementById('nome');
const email = document.getElementById('email');
const telefone = document.getElementById('telefone');
const nascimento = document.getElementById('nascimento');
const mensagem = document.getElementById('mensagem');
const testnome = /^[A-Za-zÀ-ÿ]+\s[A-Za-zÀ-ÿ]+$/
const testemail = /^[A-Za-z0-9._]+@[A-Za-z0-9]+\.[A-Za-z.]{2,}$/
const testnascimento = /^[0-9]{2}\/[0-9]{2}\/[0-9]{4}$/
const testtelefone = /^[0-9]{10,11}$/
const submit = document.getElementById('enviar');
submit.addEventListener('click', function (event) {
    event.preventDefault();
    let formvalido = true;
    mensagem.innerHTML = "";
    if (!testnome.test(nome.value.trim())) {
        if (nome.value.length === 0) {
            const mensagem1 = document.createElement('p');
            mensagem1.textContent = "Preencha o nome";
            mensagem.appendChild(mensagem1);
        }
        nome.classList.add('erro');
        formvalido = false;
    } else {
        nome.classList.remove('erro');
    }
    if (!testemail.test(email.value.trim())) {
        if (email.value.length === 0) {
            const mensagem2 = document.createElement('p');
            mensagem2.textContent = "Preencha o email";
            mensagem.appendChild(mensagem2);
        }
        email.classList.add('erro');
        formvalido = false;
    } else {
        email.classList.remove('erro');
    }
    if (nascimento.value.trim()) {
        if (!testnascimento.test(nascimento.value.trim())) {
            nascimento.classList.add('erro');
            formvalido = false;
        } else {
            nascimento.classList.remove('erro');
        }
    }else{
        nascimento.classList.remove('erro');
    }
    if (telefone.value.trim()) {
        if (!testtelefone.test(telefone.value.trim())) {
            telefone.classList.add('erro');
            formvalido = false;
        } else {
            telefone.classList.remove('erro');
        }
    }else{
        telefone.classList.remove('erro');
    }
    if (formvalido) {
        event.target.closest('form').submit();
    }
})