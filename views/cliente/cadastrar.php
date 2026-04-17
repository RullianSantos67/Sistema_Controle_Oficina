<?php require 'includes/cabecalho.php'; ?>

<div class="cartao card-sm">
    <div class="card-header">
        <h3>👤 Cadastrar Novo Cliente</h3>
    </div>

    <form action="index.php?controller=cliente&action=cadastrar" method="POST">
        
        <div class="grupo-input">
            <label>Nome Completo:</label>
            <input type="text" name="nome" class="input-form" placeholder="Ex: Rullian Santos" required>
        </div>

        <div class="grupo-input">
            <label>CPF:</label>
            <input type="text" name="cpf" class="input-form" 
                   placeholder="000.000.000-00" 
                   oninput="mascaraCPF(this)" maxlength="14" required>
        </div>

        <div class="grupo-input">
            <label>Telefone / WhatsApp:</label>
            <input type="text" name="telefone" class="input-form" 
                   placeholder="(00) 00000-0000" 
                   oninput="mascaraTelefone(this)" maxlength="15" required>
        </div>

        <div style="margin-top: 25px; display: flex; gap: 10px; align-items: center;">
    <button type="submit" class="btn btn-blue" style="padding: 10px 20px; width: auto;">Salvar Cliente</button>
    
    <a href="index.php?controller=cliente&action=consultar" 
       style="background: #e2e8f0; color: #475569; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-size: 14px; font-weight: 600;">
       Cancelar
    </a>
</div>
    </form>
</div>

<script>
function mascaraCPF(i) {
    let v = i.value.replace(/\D/g, "");
    i.setAttribute("maxlength", "14");
    if (v.length >= 3) v = v.replace(/^(\d{3})(\d)/, "$1.$2");
    if (v.length >= 6) v = v.replace(/^(\d{3})\.(\d{3})(\d)/, "$1.$2.$3");
    if (v.length >= 9) v = v.replace(/^(\d{3})\.(\d{3})\.(\d{3})(\d)/, "$1.$2.$3-$4");
    i.value = v;
}

function mascaraTelefone(i) {
    let v = i.value.replace(/\D/g, "");
    if (v.length <= 10) {
        v = v.replace(/^(\d{2})(\d)/g, "($1) $2");
        v = v.replace(/(\d{4})(\d)/, "$1-$2");
    } else {
        v = v.replace(/^(\d{2})(\d)/g, "($1) $2");
        v = v.replace(/(\d{5})(\d)/, "$1-$2");
    }
    i.value = v;
}
</script>

<?php require 'includes/rodape.php'; ?>