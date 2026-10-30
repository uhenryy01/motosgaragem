<?php
if (!function_exists('adminIcon')) {
    function a_e($s): string { return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }
    function adminIcon(string $n, int $s = 20): string {
        static $p = [
            'home' => '<path d="M3 11l9-8 9 8"/><path d="M5 10v10h14V10"/><path d="M10 20v-6h4v6"/>',
            'bike' => '<circle cx="5.5" cy="17" r="3.5"/><circle cx="18.5" cy="17" r="3.5"/><path d="M5.5 17l4-7h5l4 7M9.5 10L8 7H6M14.5 10l1.5-3h2"/>',
            'plus' => '<path d="M12 5v14M5 12h14"/>',
            'list' => '<path d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01"/>',
            'cart' => '<circle cx="9" cy="20" r="1.5"/><circle cx="18" cy="20" r="1.5"/><path d="M2 3h3l2.5 12h11l2-8H6"/>',
            'box' => '<path d="M21 8l-9-5-9 5v8l9 5 9-5z"/><path d="M3 8l9 5 9-5M12 13v8"/>',
            'chat' => '<path d="M21 12a8 8 0 0 1-11.5 7.2L3 21l1.8-5.5A8 8 0 1 1 21 12z"/>',
            'chart' => '<path d="M4 20V10M10 20V4M16 20v-8M22 20H2"/>',
            'phone' => '<path d="M5 4h4l2 5-2.5 1.5a11 11 0 0 0 5 5L15 13l5 2v4a2 2 0 0 1-2 2A16 16 0 0 1 3 6a2 2 0 0 1 2-2z"/>',
            'out' => '<path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4M16 17l5-5-5-5M21 12H9"/>',
            'bell' => '<path d="M18 8a6 6 0 0 0-12 0c0 7-3 9-3 9h18s-3-2-3-9M13.7 21a2 2 0 0 1-3.4 0"/>',
            'search' => '<circle cx="11" cy="11" r="7"/><path d="M21 21l-4.3-4.3"/>',
            'user' => '<circle cx="12" cy="8" r="4"/><path d="M4 21a8 8 0 0 1 16 0"/>',
            'image' => '<rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="9" cy="9" r="2"/><path d="M21 15l-5-5L5 21"/>',
            'doc' => '<path d="M14 3H6a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"/><path d="M14 3v6h6M8 13h8M8 17h5"/>',
            'upload' => '<path d="M12 16V4M7 9l5-5 5 5M4 20h16"/>',
            'save' => '<path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><path d="M17 21v-8H7v8M7 3v5h8"/>',
            'refresh' => '<path d="M21 12a9 9 0 1 1-3-6.7L21 8M21 3v5h-5"/>',
            'chev' => '<path d="M6 9l6 6 6-6"/>',
            'menu' => '<path d="M3 6h18M3 12h18M3 18h18"/>',
        ];
        return '<svg class="ic" width="' . $s . '" height="' . $s . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' . ($p[$n] ?? '') . '</svg>';
    }
}
$pageTitle = $pageTitle ?? 'Painel';
$pageSubtitle = $pageSubtitle ?? '';
$pageIcon = $pageIcon ?? 'home';
$active = $active ?? '';
$pendentes = 0;
try { $pendentes = (int)Database::getConnection()->query('SELECT COUNT(*) FROM contatos WHERE resposta IS NULL')->fetchColumn(); } catch (Throwable $e) {}
$nav = [
    ['painel', 'Painel', 'home', 'index.php?controller=auth&action=dashboard'],
    ['motos', 'Motos', 'bike', 'index.php?controller=produto&action=index&view=lista'],
    ['adicionar', 'Adicionar Moto', 'plus', 'index.php?controller=produto&action=index&view=form'],
    null,
    ['vendas', 'Vendas', 'cart', 'index.php?controller=venda&action=index'],
    ['entradas', 'Entradas', 'box', 'index.php?controller=entrada&action=index'],
    ['mensagens', 'Mensagens', 'chat', 'index.php?controller=contato&action=index'],
    ['relatorios', 'Relatórios', 'chart', 'index.php?controller=relatorio&action=index'],
    ['whatsapp', 'WhatsApp', 'phone', 'index.php?controller=whatsapp&action=config'],
];
?>
<!doctype html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title><?= a_e($pageTitle) ?> - Garagem Motos</title>
<link rel="icon" type="image/png" href="img/logom.png">
<link rel="stylesheet" href="public/assets/css/style.css">
<link rel="stylesheet" href="public/assets/css/admin.css">
</head>
<body class="admin-shell">
<input type="checkbox" id="a-nav" class="a-toggle">
<header class="a-top">
    <label for="a-nav" class="a-burger"><?= adminIcon('menu', 26) ?></label>
    <a class="a-brand" href="index.php?controller=auth&action=dashboard"><span class="a-logo"><?= adminIcon('bike', 30) ?></span><span>Garagem <b>Motos</b></span></a>
    <form class="a-search" method="get" action="index.php">
        <input type="hidden" name="controller" value="produto"><input type="hidden" name="action" value="index"><input type="hidden" name="view" value="lista">
        <?= adminIcon('search', 18) ?>
        <input type="search" name="q" value="<?= a_e($_GET['q'] ?? '') ?>" placeholder="Buscar motos pelo nome, marca ou modelo...">
    </form>
    <a class="a-bell" href="index.php?controller=contato&action=index" title="Mensagens pendentes"><?= adminIcon('bell', 24) ?><?php if ($pendentes > 0): ?><span class="a-dot"><?= $pendentes ?></span><?php endif; ?></a>
    <details class="a-user">
        <summary><span class="a-avatar"><?= adminIcon('user', 22) ?></span><span><b><?= a_e($_SESSION['nome'] ?? 'Admin') ?></b><small>Administrador</small></span><?= adminIcon('chev', 16) ?></summary>
        <div class="a-menu"><a href="lojaview.php">Ir para a loja</a><a href="index.php?controller=auth&action=logout">Sair</a></div>
    </details>
</header>
<div class="a-body">
<aside class="a-side">
    <nav>
        <?php foreach ($nav as $i): if ($i === null) { echo '<div class="a-sep"></div>'; continue; } ?>
            <a class="a-link<?= $active === $i[0] ? ' on' : '' ?>" href="<?= a_e($i[3]) ?>"><?= adminIcon($i[2]) ?><span><?= a_e($i[1]) ?></span></a>
        <?php endforeach; ?>
    </nav>
    <a class="a-link a-out" href="index.php?controller=auth&action=logout"><?= adminIcon('out') ?><span>Sair</span></a>
</aside>
<main class="a-main">
    <div class="a-head"><?= adminIcon($pageIcon, 44) ?><div><h1><?= a_e($pageTitle) ?></h1><?php if ($pageSubtitle !== ''): ?><p><?= a_e($pageSubtitle) ?></p><?php endif; ?></div></div>
