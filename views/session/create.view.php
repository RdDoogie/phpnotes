<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>
<?php require base_path('views/partials/banner.php') ?>

<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="mt-5 md:col-span-2 md:mt-0">
                <form method="POST" action="/session">
                    <div class="shadow sm:overflow-hidden sm:rounded-md">
                        <div class="space-y-6 bg-white px-4 py-5 sm:p-6">
                            <div>
                                <label
                                    for="register"
                                    class="block text-sm font-medium text-gray-700"
                                >Log In</label>

                                <div class="mt-1">
                                    <label for="email">
                                        <input type="email" placeholder="email" class ="mt-5" id="email" value="<?= htmlspecialchars(old('email')) ?>" name="email" required>
                                    </label>
                                    <?php if (isset($errors['email'])) : ?>
                                        <p class="text-red-500 text-xs mt-2"><?= $errors['email'] ?></p>
                                    <?php endif; ?>
                                    <br>
                                    <label for = "password">
                                        <input type="password" placeholder="password" class ="mt-5" id="password" name="password" required>
                                    </label>
                                    <?php if (isset($errors['password'])) : ?>
                                        <p class="text-red-500 text-xs mt-2"><?= $errors['password'] ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                            <button
                                type="submit"
                                class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                            >
                                Log In
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<?php require base_path('views/partials/footer.php') ?>
