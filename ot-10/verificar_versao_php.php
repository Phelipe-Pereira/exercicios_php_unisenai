<?php
/*
    Data: 14/08/2025
    Nome: Phelipe Leandro Pereira
*/

function verificarVersaoPHP() {
    $versaoAtual = PHP_VERSION;
    $versaoAtualNum = (float) $versaoAtual;
    
    $versaoMinima = 8.0;
    $versaoRecomendada = 8.2;
    $ultimaVersao = 8.3;
    
    $status = '';
    $nivel = '';
    $recomendacoes = [];
    
    if ($versaoAtualNum >= $ultimaVersao) {
        $status = 'Atualizada';
        $nivel = 'excelente';
        $recomendacoes[] = 'Sua versão está atualizada! Continue monitorando atualizações.';
    } elseif ($versaoAtualNum >= $versaoRecomendada) {
        $status = 'Recomendada';
        $nivel = 'boa';
        $recomendacoes[] = 'Considere atualizar para a versão mais recente para obter as últimas correções de segurança.';
    } elseif ($versaoAtualNum >= $versaoMinima) {
        $status = 'Aceitável';
        $nivel = 'media';
        $recomendacoes[] = 'Recomenda-se atualizar para uma versão mais recente.';
        $recomendacoes[] = 'Versões mais antigas podem ter vulnerabilidades de segurança.';
    } else {
        $status = 'Desatualizada';
        $nivel = 'critica';
        $recomendacoes[] = 'ATENÇÃO: Sua versão está desatualizada e pode ter vulnerabilidades críticas!';
        $recomendacoes[] = 'Atualize imediatamente para uma versão suportada.';
        $recomendacoes[] = 'Versões antigas não recebem patches de segurança.';
    }
    
    return [
        'versao_atual' => $versaoAtual,
        'versao_atual_num' => $versaoAtualNum,
        'versao_minima' => $versaoMinima,
        'versao_recomendada' => $versaoRecomendada,
        'ultima_versao' => $ultimaVersao,
        'status' => $status,
        'nivel' => $nivel,
        'recomendacoes' => $recomendacoes
    ];
}

function verificarExtensoes() {
    $extensoesImportantes = [
        'mysqli' => 'MySQLi',
        'pdo_mysql' => 'PDO MySQL',
        'openssl' => 'OpenSSL',
        'mbstring' => 'Multibyte String',
        'json' => 'JSON',
        'curl' => 'cURL',
        'gd' => 'GD Graphics',
        'zip' => 'ZIP',
        'xml' => 'XML',
        'session' => 'Session'
    ];
    
    $extensoesVerificadas = [];
    foreach ($extensoesImportantes as $extensao => $nome) {
        $extensoesVerificadas[] = [
            'nome' => $nome,
            'extensao' => $extensao,
            'instalada' => extension_loaded($extensao)
        ];
    }
    
    return $extensoesVerificadas;
}

function verificarConfiguracoes() {
    $configuracoes = [
        'display_errors' => ['valor' => ini_get('display_errors'), 'recomendado' => 'Off'],
        'log_errors' => ['valor' => ini_get('log_errors'), 'recomendado' => 'On'],
        'allow_url_fopen' => ['valor' => ini_get('allow_url_fopen'), 'recomendado' => 'Off'],
        'expose_php' => ['valor' => ini_get('expose_php'), 'recomendado' => 'Off'],
        'session.cookie_httponly' => ['valor' => ini_get('session.cookie_httponly'), 'recomendado' => 'On'],
        'max_execution_time' => ['valor' => ini_get('max_execution_time'), 'recomendado' => '30'],
        'memory_limit' => ['valor' => ini_get('memory_limit'), 'recomendado' => '128M']
    ];
    
    return $configuracoes;
}

$infoVersao = verificarVersaoPHP();
$extensoes = verificarExtensoes();
$configuracoes = verificarConfiguracoes();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Verificação de Versão do PHP</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 50px; }
        .container { max-width: 1000px; margin: 0 auto; }
        .header { background: #f0f0f0; padding: 20px; border-radius: 5px; margin-bottom: 20px; }
        .status { font-size: 24px; font-weight: bold; }
        .excelente { color: #28a745; }
        .boa { color: #17a2b8; }
        .media { color: #ffc107; }
        .critica { color: #dc3545; }
        .info { background: #e8f4f8; padding: 15px; margin: 10px 0; border-radius: 5px; }
        .alerta { background: #fff3cd; padding: 15px; margin: 10px 0; border-radius: 5px; border-left: 4px solid #ffc107; }
        .critico { background: #f8d7da; padding: 15px; margin: 10px 0; border-radius: 5px; border-left: 4px solid #dc3545; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background: #f2f2f2; }
        .instalada { background: #d4edda; }
        .nao-instalada { background: #f8d7da; }
        .versao { font-family: monospace; background: #f8f9fa; padding: 2px 4px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Verificação de Segurança do PHP</h2>
            <div class="status <?php echo $infoVersao['nivel']; ?>">
                Status: <?php echo $infoVersao['status']; ?> - Versão: <span class="versao"><?php echo $infoVersao['versao_atual']; ?></span>
            </div>
        </div>
        
        <div class="info">
            <h3>Informações da Versão</h3>
            <p><strong>Versão Atual:</strong> <span class="versao"><?php echo $infoVersao['versao_atual']; ?></span></p>
            <p><strong>Versão Mínima Recomendada:</strong> <span class="versao"><?php echo $infoVersao['versao_minima']; ?></span></p>
            <p><strong>Versão Recomendada:</strong> <span class="versao"><?php echo $infoVersao['versao_recomendada']; ?></span></p>
            <p><strong>Última Versão Disponível:</strong> <span class="versao"><?php echo $infoVersao['ultima_versao']; ?></span></p>
        </div>
        
        <?php if ($infoVersao['nivel'] === 'critica'): ?>
            <div class="critico">
                <h4>⚠️ ATENÇÃO: Versão Crítica!</h4>
                <?php foreach ($infoVersao['recomendacoes'] as $recomendacao): ?>
                    <p><?php echo htmlspecialchars($recomendacao); ?></p>
                <?php endforeach; ?>
            </div>
        <?php elseif ($infoVersao['nivel'] === 'media'): ?>
            <div class="alerta">
                <h4>⚠️ Recomendação de Atualização</h4>
                <?php foreach ($infoVersao['recomendacoes'] as $recomendacao): ?>
                    <p><?php echo htmlspecialchars($recomendacao); ?></p>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="info">
                <h4>✅ Status Satisfatório</h4>
                <?php foreach ($infoVersao['recomendacoes'] as $recomendacao): ?>
                    <p><?php echo htmlspecialchars($recomendacao); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        
        <h3>Extensões Verificadas</h3>
        <table>
            <thead>
                <tr>
                    <th>Extensão</th>
                    <th>Status</th>
                    <th>Descrição</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($extensoes as $ext): ?>
                    <tr class="<?php echo $ext['instalada'] ? 'instalada' : 'nao-instalada'; ?>">
                        <td><?php echo htmlspecialchars($ext['nome']); ?></td>
                        <td><?php echo $ext['instalada'] ? '✅ Instalada' : '❌ Não Instalada'; ?></td>
                        <td><?php echo htmlspecialchars($ext['extensao']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <h3>Configurações de Segurança</h3>
        <table>
            <thead>
                <tr>
                    <th>Configuração</th>
                    <th>Valor Atual</th>
                    <th>Recomendado</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($configuracoes as $config => $info): ?>
                    <tr>
                        <td><span class="versao"><?php echo htmlspecialchars($config); ?></span></td>
                        <td><?php echo htmlspecialchars($info['valor']); ?></td>
                        <td><?php echo htmlspecialchars($info['recomendado']); ?></td>
                        <td><?php echo $info['valor'] == $info['recomendado'] ? '✅' : '❌'; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <div class="info">
            <h4>Como Atualizar o PHP:</h4>
            <ol>
                <li><strong>Windows:</strong> Baixe a versão mais recente do site oficial do PHP</li>
                <li><strong>Linux (Ubuntu/Debian):</strong> <code>sudo apt update && sudo apt install php8.2</code></li>
                <li><strong>CentOS/RHEL:</strong> <code>sudo yum install php82</code></li>
                <li><strong>XAMPP/WAMP:</strong> Atualize o pacote completo</li>
                <li>Após atualização, reinicie o servidor web</li>
                <li>Teste a aplicação para garantir compatibilidade</li>
            </ol>
            
            <h4>Monitoramento Contínuo:</h4>
            <ul>
                <li>Configure alertas para novas versões do PHP</li>
                <li>Monitore o changelog oficial para correções de segurança</li>
                <li>Use ferramentas como Composer para gerenciar dependências</li>
                <li>Implemente testes automatizados após atualizações</li>
            </ul>
        </div>
    </div>
</body>
</html>
