<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>
<?php require base_path('views/partials/banner.php') ?>

<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">

        <p class="mt-6">
            Username: <?= $user['name'] ?>
        </p>
        <br>
        <p class="mt-6">
            Email: <?= $user['email'] ?>
        </p>
        <br>
        <p class="mt-6">
            Number of notes: <?= $notes ?>
        </p>
    </div>
</main>

<?php require base_path('views/partials/footer.php') ?>
