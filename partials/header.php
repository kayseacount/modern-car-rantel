<?php $pageTitle = $pageTitle ?? 'Modern Car Rent'; $viewer = current_user(); ?>
<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= h($pageTitle) ?></title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="assets/style.css"></head><body class="site-body">
<nav class="navbar navbar-expand-lg navbar-dark site-navbar sticky-top"><div class="container-fluid px-lg-4">
<a class="navbar-brand fw-bold" href="index.php"><span class="brand-mark">M</span> MODERN <span class="brand-green">CAR RENT</span></a>
<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav"><span class="navbar-toggler-icon"></span></button>
<div class="collapse navbar-collapse" id="mainNav"><ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
<li class="nav-item"><a class="nav-link" href="index.php#fleet">Explore Cars</a></li>
<?php if($viewer): ?><li class="nav-item"><a class="nav-link" href="<?= $viewer['role']==='admin'?'admin.php':'dashboard.php' ?>">Dashboard</a></li><li class="nav-item"><span class="nav-link small text-white-50"><?=h($viewer['name'])?></span></li><li class="nav-item"><a class="btn btn-outline-light btn-sm px-3" href="logout.php">Logout</a></li>
<?php else: ?><li class="nav-item"><a class="nav-link" href="login.php">Login</a></li><li class="nav-item"><a class="btn btn-success btn-sm px-3" href="register.php">Register</a></li><?php endif; ?>
</ul></div></div></nav><main><?php show_flash(); ?>
