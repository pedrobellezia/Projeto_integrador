const campos = [];

function mostrarRetorno(divId, mensagem, tipo) {
    const div = document.getElementById(divId);
    div.textContent = mensagem;
    div.className = tipo; // 'sucesso' ou 'erro'
    div.style.display = 'block';
    div.style.opacity = '1';
    setTimeout(() => {
        div.style.opacity = '0';
        setTimeout(() => {
            div.style.display = 'none';
            div.textContent = '';
        }, 400);
    }, 3500);
}

function limpaCampos(){
    document.getElementById('field-title').value = '';
    document.getElementById('field-name').value = '';
    document.getElementById('input-values').value = '';
    document.getElementById('input-labels').value = '';
}

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

    if (!tipo || !titulo || !nome || ((tipo === 'radio' || tipo === 'checkbox') && (!value || !label))) {
        mostrarRetorno('input-retorno', 'Preencha todos os campos obrigatórios para adicionar o input.', 'erro');
        return;
    }

    const newCampo = {
        ...(tipo && { tipo: tipo }),
        ...(titulo && { titulo: titulo }),
        ...(nome && { nome: nome }),
        ...(value && { value: value }),
        ...(label && { label: label })
    };

    campos.push(newCampo);

    mostrarRetorno('input-retorno', `Input "${titulo}" foi adicionado com sucesso!`, 'sucesso');

    document.getElementById('input-type').value = '';
    document.getElementById('field-title').value = '';
    document.getElementById('field-name').value = '';
    document.getElementById('input-values').value = '';
    document.getElementById('input-labels').value = '';    
}


function enviarCampos() {
    if (campos.length === 0) {
        mostrarRetorno('template-retorno', 'Adicione pelo menos um campo antes de salvar o template.', 'erro');
        return;
    }

    const template_name = document.getElementById('template-name').value.trim();
    const template_desc = document.getElementById('template-desc').value.trim();

    if (!template_name) {
        mostrarRetorno('template-retorno', 'O nome do template é obrigatório.', 'erro');
        return;
    }

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
                mostrarRetorno('template-retorno', `Template "${template_name}" salvo com sucesso!`, 'sucesso');
                campos.length = 0;
                document.getElementById('lista-campos').innerHTML = '';
                document.getElementById('template-name').value = '';
                document.getElementById('template-desc').value = '';
            } else {
                mostrarRetorno('template-retorno', json.message || "Erro ao enviar template.", 'erro');
            }
        } catch (e) {
            mostrarRetorno('template-retorno', "Erro inesperado do servidor.", 'erro');
        }
    });
}
