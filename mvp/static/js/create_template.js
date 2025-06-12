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
    const valoresTexto = document.getElementById('input-values').value.trim();
    const labelsTexto = document.getElementById('input-labels').value.trim();

    let valores = [];
    let labels = [];

    if (typeof valoresTexto === "string") {
        valores = valoresTexto
            ? valoresTexto.split(';').map(v => v.trim()).filter(v => v.length > 0)
            : [];
    }

    if (typeof labelsTexto === "string") {
        labels = labelsTexto
            ? labelsTexto.split(';').map(v => v.trim()).filter(v => v.length > 0)
            : [];
    }

    const newCampo = {
        ...(tipo && { type: tipo }),
        ...(titulo && { title: titulo }),
        ...(nome && { name: nome }),
        ...(valores.length > 0 && { values: valores }),
        ...(labels.length > 0 && { labels: labels })
    };

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

    fetch('http://localhost/mvp/php/insert_values', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ data: campos, templateName: template_name, templateDesc: template_desc })
    })
        .then(res => {
            if (res.ok) {
                alert("Template enviado com sucesso!");
                campos.length = 0;
                document.getElementById('lista-campos').innerHTML = '';
            } else {
                alert("Erro ao enviar template.");
            }
        })

        .catch(err => {
            console.error("Erro:", err);
            alert("Erro ao conectar com o servidor.");
        });
}