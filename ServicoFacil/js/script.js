function sucesso() {
    alert("Solicitação concluída com sucesso!");
}

let senha = document.getElementById("senhaCadastro"),
    senhaConf = document.getElementById("senhaCadastroConf");
let check = document.getElementById("")
function validarSenha() {
    if (senha.value != senhaConf.value) {
        senhaConf.setCustomValidity("Senhas diferentes!");
    } else {
        senhaConf.setCustomValidity('');
    }
}
senha.onchange = validarSenha;
senhaConf.onkeyup = validarSenha;

