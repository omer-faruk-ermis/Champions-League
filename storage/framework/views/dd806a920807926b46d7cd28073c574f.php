<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Champions League</title>
        <?php echo app('Illuminate\Foundation\Vite')->reactRefresh(); ?>
        <?php echo app('Illuminate\Foundation\Vite')(['resources/js/app.jsx', 'resources/css/app.css']); ?>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link rel="icon" href="<?php echo e(asset('src/icons/league-logo.png')); ?>" type="image/x-icon">

    </head>
    <body class="font-sans antialiased">
    <div id="app"></div>
    </body>
</html>
<?php /**PATH /Users/omerfarukermis/Desktop/Insider/champions_league/champions-league/resources/views/welcome.blade.php ENDPATH**/ ?>