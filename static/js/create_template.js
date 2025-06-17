const campos = [];

function showCampos() {
    const type = document.getElementById('input-type').value;
    switch (type) {
        case "radio":
            document.getElementById('titulo').style.display = "inline-block";
            document.getElementById('nomeCampo').style.display = "inline-block";
            document.getElementById('valorCampo').style.display = "inline-block";
            document.getElementById('labelCampo').style.display = "inline-block";
            break;

        case "checkbox":
            document.getElementById('titulo').style.display = "inline-block";
            document.getElementById('nomeCampo').style.display = "inline-block";
            document.getElementById('valorCampo').style.display = "inline-block";
            document.getElementById('labelCampo').style.display = "inline-block";
            break;

        case "text":
            document.getElementById('titulo').style.display = "inline-block";
            document.getElementById('nomeCampo').style.display = "inline-block";
            document.getElementById('valorCampo').style.display = "None";
            document.getElementById('labelCampo').style.display = "None";
            break;

        case "number":
            document.getElementById('titulo').style.display = "inline-block";
            document.getElementById('nomeCampo').style.display = "inline-block";
            document.getElementById('valorCampo').style.display = "None";
            document.getElementById('labelCampo').style.display = "None";
            break;
    }

}

function adicionarCampo() {
    const tipo = document.getElementById('input-type').value;
    const titulo = document.getElementById('field-title').value.trim() || '';
    const nome = document.getElementById('field-name').value.trim() || '';
    const value = document.getElementById('input-values').value|| '';
    const label = document.getElementById('input-labels').value|| '';


    const newCampo = {
        ...(tipo && { tipo: tipo }),
        ...(titulo && { titulo: titulo }),
        ...(nome && { nome: nome }),
        ...(value && { value: value }),
        ...(label && { label: label })
    };

    console.log(newCampo);

    campos.push(newCampo);

    document.getElementById('input-type').value = '';
    document.getElementById('field-title').value = '';
    document.getElementById('field-name').value = '';
    document.getElementById('input-values').value = '';
    document.getElementById('input-labels').value = '';
}


function enviarCampos() {
    if (campos.length === 0) {
        alert("Adicione pelo menos um campo.");
        return;
    }

    const template_name = document.getElementById('template-name').value.trim();
    document.getElementById('template-name').value = '';
    
    const template_desc = document.getElementById('template-desc').value.trim();
    document.getElementById('template-desc').value = '';

    fetch('http://localhost/mvp/php/insert_values.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            data: campos,
            templateName: template_name,
            templateDesc: template_desc
        })
    })
    .then(async res => {
        const text = await res.text(); 
        try {
            const json = JSON.parse(text);
            if (res.ok) {
                alert(json.message || "Template enviado com sucesso!");
                campos.length = 0;
                document.getElementById('lista-campos').innerHTML = '';
            } else {
                alert(json.message || "Erro ao enviar template.");
            }
        } catch (e) {
            console.error("Resposta não é JSON:", text);
            alert("Erro inesperado do servidor.");
        }
    })


}