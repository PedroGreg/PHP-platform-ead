const submit = document.getElementById('submit');
const result = document.getElementById('result');
const emailTest = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
const data = document.getElementById('data');
result.innerText = "Fill in the name field";
result.classList.add('rq');
submit.addEventListener('click', function (event) {
    event.preventDefault();
    const inputName = document.getElementById('name').value;
    const inputEmail = document.getElementById('email').value;
    const inputWS = document.getElementById('website').value;
    const inputComment = document.getElementById('comment').value;
    const inputRadio = document.querySelector("input[name='gender']:checked").value;
    // return (inputName, inputEmail, inputWS, inputComment, inputRadio);
    if (!inputName || inputName.length < 3 || inputName.length > 100) {
        result.textContent = "Fill in the name field";
        result.classList.add('rq');
        return;
    } else if (!emailTest.test(inputEmail)) {
        result.textContent = "Fill in the email field";
        result.classList.add('rq');
        return;
    } else if (inputRadio != "male" && inputRadio != "female" && inputRadio != "other") {
        result.textContent = "Fill in the Radio field";
        result.classList.add('rq');
        return;
    }
    try {
        new URL(inputWS)
    } catch {
        result.textContent = "Fill in the website field";
        result.classList.add('rq');
        return;
    }
    result.textContent = "Success"
    result.classList.remove('rq');

    add(inputName,inputEmail,inputWS,inputComment,inputRadio);
})
function add(inputN,inputE,inputW,inputC,inputR) {
    data.innerHTML = "";
    const name = document.createElement('p');
    const email = document.createElement('p');
    const ws = document.createElement('p');
    const comm = document.createElement('p');
    const gender = document.createElement('p');
    name.textContent = "Name: " + inputN;
    email.textContent = "Email: " + inputE;
    ws.textContent = "Website: " + inputW;
    comm.textContent = "Comment: " + inputC;
    gender.textContent = "Gender: " + inputR;
    data.appendChild(name);
    data.appendChild(email);
    data.appendChild(ws);
    data.appendChild(comm);
    data.appendChild(gender);
}
