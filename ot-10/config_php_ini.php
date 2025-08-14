<?php
/*
    Data: 14/08/2025
    Nome: Phelipe Leandro Pereira
*/

function verificarConfiguracao($configuracao, $valorEsperado, $descricao) {
    $valorAtual = ini_get($configuracao);
    $status = ($valorAtual == $valorEsperado) ? '✅' : '❌';
    $recomendacao = ($valorAtual != $valorEsperado) ? "Recomendado: $valorEsperado" : '';
    
    return [
        'configuracao' => $configuracao,
        'valor_atual' => $valorAtual,
        'valor_esperado' => $valorEsperado,
        'status' => $status,
        'descricao' => $descricao,
        'recomendacao' => $recomendacao
    ];
}

$configuracoes = [
    verificarConfiguracao('display_errors', 'Off', 'Oculta erros em produção'),
    verificarConfiguracao('log_errors', 'On', 'Registra erros em arquivo de log'),
    verificarConfiguracao('allow_url_fopen', 'Off', 'Desabilita inclusão de arquivos remotos'),
    verificarConfiguracao('allow_url_include', 'Off', 'Desabilita include de URLs'),
    verificarConfiguracao('session.cookie_httponly', 'On', 'Cookies não acessíveis via JavaScript'),
    verificarConfiguracao('session.cookie_secure', 'On', 'Cookies apenas via HTTPS'),
    verificarConfiguracao('max_execution_time', '30', 'Limita tempo de execução (segundos)'),
    verificarConfiguracao('memory_limit', '128M', 'Limita uso de memória'),
    verificarConfiguracao('upload_max_filesize', '2M', 'Limita tamanho de upload'),
    verificarConfiguracao('post_max_size', '8M', 'Limita tamanho de dados POST'),
    verificarConfiguracao('expose_php', 'Off', 'Oculta versão do PHP'),
    verificarConfiguracao('session.use_strict_mode', 'On', 'Modo estrito de sessão'),
    verificarConfiguracao('session.cookie_samesite', 'Strict', 'Proteção CSRF'),
    verificarConfiguracao('session.gc_maxlifetime', '1440', 'Tempo de vida da sessão (segundos)'),
    verificarConfiguracao('session.cookie_lifetime', '0', 'Cookie de sessão expira ao fechar navegador')
];

$totalConfiguracoes = count($configuracoes);
$configuracoesCorretas = count(array_filter($configuracoes, function($c) { return $c['status'] === '✅'; }));
$percentualSeguranca = round(($configuracoesCorretas / $totalConfiguracoes) * 100);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Configuração de Segurança do PHP</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 50px; }
        .container { max-width: 1000px; margin: 0 auto; }
        .header { background: #f0f0f0; padding: 20px; border-radius: 5px; margin-bottom: 20px; }
        .status { font-size: 24px; font-weight: bold; }
        .seguro { color: green; }
        .inseguro { color: red; }
        .medio { color: orange; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background: #f2f2f2; }
        .correto { background: #d4edda; }
        .incorreto { background: #f8d7da; }
        .info { background: #e8f4f8; padding: 15px; margin: 10px 0; border-radius: 5px; }
        .configuracao { font-family: monospace; background: #f8f9fa; padding: 2px 4px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Configuração de Segurança do PHP</h2>
            <div class="status <?php echo $percentualSeguranca >= 80 ? 'seguro' : ($percentualSeguranca >= 60 ? 'medio' : 'inseguro'); ?>">
                Segurança: <?php echo $percentualSeguranca; ?>% (<?php echo $configuracoesCorretas; ?>/<?php echo $totalConfiguracoes; ?>)
            </div>
        </div>
        
        <div class="info">
            <h4>Configurações de Segurança para Produção:</h4>
            <p>Estas configurações devem ser aplicadas no arquivo <span class="configuracao">php.ini</span> para ambientes de produção.</p>
            <p>Após alterações, reinicie o servidor web para aplicar as configurações.</p>
        </div>
        
        <table>
            <thead>
                <tr>
                    <th>Status</th>
                    <th>Configuração</th>
                    <th>Valor Atual</th>
                    <th>Valor Esperado</th>
                    <th>Descrição</th>
                    <th>Recomendação</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($configuracoes as $config): ?>
                    <tr class="<?php echo $config['status'] === '✅' ? 'correto' : 'incorreto'; ?>">
                        <td><?php echo $config['status']; ?></td>
                        <td><span class="configuracao"><?php echo htmlspecialchars($config['configuracao']); ?></span></td>
                        <td><?php echo htmlspecialchars($config['valor_atual']); ?></td>
                        <td><?php echo htmlspecialchars($config['valor_esperado']); ?></td>
                        <td><?php echo htmlspecialchars($config['descricao']); ?></td>
                        <td><?php echo htmlspecialchars($config['recomendacao']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <div class="info">
            <h4>Como aplicar estas configurações:</h4>
            <ol>
                <li>Localize o arquivo <span class="configuracao">php.ini</span> no seu servidor</li>
                <li>Edite o arquivo com as configurações recomendadas</li>
                <li>Reinicie o servidor web (Apache/Nginx)</li>
                <li>Execute este script novamente para verificar</li>
            </ol>
            
            <h4>Exemplo de configurações no php.ini:</h4>
            <pre style="background: #f8f9fa; padding: 15px; border-radius: 5px; overflow-x: auto;">
; Configurações de Segurança
display_errors = Off
log_errors = On
allow_url_fopen = Off
allow_url_include = Off
expose_php = Off

; Configurações de Sessão
session.cookie_httponly = On
session.cookie_secure = On
session.use_strict_mode = On
session.cookie_samesite = Strict

; Limites de Recursos
max_execution_time = 30
memory_limit = 128M
upload_max_filesize = 2M
post_max_size = 8M</pre>
        </div>
    </div>
</body>
</html>
