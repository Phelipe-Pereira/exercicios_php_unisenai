<?php
/*
    Data: 14/08/2025
    Nome: Phelipe Leandro Pereira
*/

function verificarPorta($host, $porta) {
    $conexao = @fsockopen($host, $porta, $errno, $errstr, 2);
    if (is_resource($conexao)) {
        fclose($conexao);
        return true;
    }
    return false;
}

function verificarServico($servico) {
    $comando = "netstat -an | findstr :$servico";
    $output = shell_exec($comando);
    return !empty($output);
}

$portasComuns = [
    21 => 'FTP',
    22 => 'SSH',
    23 => 'Telnet',
    25 => 'SMTP',
    53 => 'DNS',
    80 => 'HTTP',
    110 => 'POP3',
    143 => 'IMAP',
    443 => 'HTTPS',
    3306 => 'MySQL',
    5432 => 'PostgreSQL',
    8080 => 'HTTP Alt'
];

$servicosVerificados = [];
foreach ($portasComuns as $porta => $servico) {
    $status = verificarPorta('localhost', $porta) ? 'Aberta' : 'Fechada';
    $recomendacao = '';
    
    if ($porta == 80 || $porta == 443) {
        $recomendacao = 'Permitir (servidor web)';
    } elseif ($porta == 22) {
        $recomendacao = 'Permitir (SSH)';
    } elseif ($porta == 3306) {
        $recomendacao = 'Restringir (banco de dados)';
    } else {
        $recomendacao = 'Fechar (não necessário)';
    }
    
    $servicosVerificados[] = [
        'porta' => $porta,
        'servico' => $servico,
        'status' => $status,
        'recomendacao' => $recomendacao
    ];
}

$portasAbertas = count(array_filter($servicosVerificados, function($s) { return $s['status'] === 'Aberta'; }));
$portasFechadas = count(array_filter($servicosVerificados, function($s) { return $s['status'] === 'Fechada'; }));
?>
<!DOCTYPE html>
<html>
<head>
    <title>Configuração de Firewall</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 50px; }
        .container { max-width: 1000px; margin: 0 auto; }
        .header { background: #f0f0f0; padding: 20px; border-radius: 5px; margin-bottom: 20px; }
        .status { font-size: 18px; font-weight: bold; }
        .seguro { color: green; }
        .inseguro { color: red; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background: #f2f2f2; }
        .aberta { background: #f8d7da; color: #721c24; }
        .fechada { background: #d4edda; color: #155724; }
        .info { background: #e8f4f8; padding: 15px; margin: 10px 0; border-radius: 5px; }
        .comando { font-family: monospace; background: #f8f9fa; padding: 10px; border-radius: 5px; margin: 5px 0; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Configuração de Firewall</h2>
            <div class="status <?php echo $portasAbertas <= 3 ? 'seguro' : 'inseguro'; ?>">
                Portas Abertas: <?php echo $portasAbertas; ?> | Portas Fechadas: <?php echo $portasFechadas; ?>
            </div>
        </div>
        
        <div class="info">
            <h4>Verificação de Portas e Serviços:</h4>
            <p>Esta verificação mostra quais portas estão abertas no servidor local.</p>
            <p>Para produção, mantenha apenas as portas necessárias abertas.</p>
        </div>
        
        <table>
            <thead>
                <tr>
                    <th>Porta</th>
                    <th>Serviço</th>
                    <th>Status</th>
                    <th>Recomendação</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($servicosVerificados as $servico): ?>
                    <tr class="<?php echo $servico['status'] === 'Aberta' ? 'aberta' : 'fechada'; ?>">
                        <td><?php echo $servico['porta']; ?></td>
                        <td><?php echo htmlspecialchars($servico['servico']); ?></td>
                        <td><?php echo $servico['status']; ?></td>
                        <td><?php echo htmlspecialchars($servico['recomendacao']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <div class="info">
            <h4>Configuração de Firewall no Windows:</h4>
            
            <h5>1. Firewall do Windows:</h5>
            <div class="comando">
                netsh advfirewall set allprofiles firewallpolicy blockinbound,allowoutbound
            </div>
            
            <h5>2. Permitir porta HTTP (80):</h5>
            <div class="comando">
                netsh advfirewall firewall add rule name="HTTP" dir=in action=allow protocol=TCP localport=80
            </div>
            
            <h5>3. Permitir porta HTTPS (443):</h5>
            <div class="comando">
                netsh advfirewall firewall add rule name="HTTPS" dir=in action=allow protocol=TCP localport=443
            </div>
            
            <h5>4. Bloquear porta MySQL (3306):</h5>
            <div class="comando">
                netsh advfirewall firewall add rule name="MySQL" dir=in action=block protocol=TCP localport=3306
            </div>
        </div>
        
        <div class="info">
            <h4>Configuração de Firewall no Linux (iptables):</h4>
            
            <h5>1. Política padrão:</h5>
            <div class="comando">
                iptables -P INPUT DROP<br>
                iptables -P FORWARD DROP<br>
                iptables -P OUTPUT ACCEPT
            </div>
            
            <h5>2. Permitir tráfego local:</h5>
            <div class="comando">
                iptables -A INPUT -i lo -j ACCEPT
            </div>
            
            <h5>3. Permitir HTTP e HTTPS:</h5>
            <div class="comando">
                iptables -A INPUT -p tcp --dport 80 -j ACCEPT<br>
                iptables -A INPUT -p tcp --dport 443 -j ACCEPT
            </div>
            
            <h5>4. Salvar configurações:</h5>
            <div class="comando">
                iptables-save > /etc/iptables/rules.v4
            </div>
        </div>
        
        <div class="info">
            <h4>Recomendações de Segurança:</h4>
            <ul>
                <li>Mantenha apenas as portas necessárias abertas</li>
                <li>Use HTTPS (443) em vez de HTTP (80) quando possível</li>
                <li>Configure rate limiting para prevenir ataques DDoS</li>
                <li>Monitore logs de firewall regularmente</li>
                <li>Use VPN para acesso remoto seguro</li>
                <li>Implemente fail2ban para bloquear IPs maliciosos</li>
            </ul>
        </div>
    </div>
</body>
</html>
