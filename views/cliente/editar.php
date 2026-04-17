<?php require 'includes/cabecalho.php'; ?>

<div class="cartao card-sm">
    <div class="card-header">
        <h3>✏️ Editar Cliente #<?= $cliente['id_cliente'] ?></h3>
    </div>

    <form action="index.php?controller=cliente&action=editar" method="POST">
        <input type="hidden" name="id_cliente" value="<?= $cliente['id_cliente'] ?>">
        
        <div class="grupo-input">
            <label>Nome Completo:</label>
            <input type="text" name="nome" class="input-form" value="<?= htmlspecialchars($cliente['nome']) ?>" required>
        </div>

        <div class="grupo-input">
            <label>CPF:</label>
            <input type="text" name="cpf" class="input-form" 
                   value="<?= htmlspecialchars($cliente['cpf']) ?>"
                   oninput="mascaraCPF(this)" maxlength="14" required>
        </div>

        <div class="grupo-input">
            <label>Telefone / WhatsApp:</label>
            <input type="text" name="telefone" class="input-form" 
                   value="<?= htmlspecialchars($cliente['telefone']) ?>"
                   oninput="mascaraTelefone(this)" maxlength="15" required>
        </div>

        <div style="margin-top: 25px; display: flex; gap: 10px; align-items: center;">
    <button type="submit" class="btn" style="background-color: #f59e0b; color: white; padding: 10px 20px; width: auto;">Atualizar Dados</button>
    
    <a href="index.php?controller=cliente&action=consultar" 
       style="background: #e2e8f0; color: #475569; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-size: 14px; font-weight: 600;">
       Voltar
    </a>
</div>
    </form>
</div>

<script>
function mascaraCPF(i) {
    let v = i.value.replace(/\D/g, "");
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