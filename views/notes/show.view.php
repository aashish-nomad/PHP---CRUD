<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>
<?php require base_path('views/partials/banner.php') ?>
<main>
  <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
    Welcome to the Note page.

    <div class="mx-auto px-4 py-4 sm:px-4 lg:">
      <h2 class="text-xl font-bold tracking-tight"><?= $note['title']; ?></h2>
      <p><?= htmlspecialchars($note['body']); ?></p>

      <footer class="mt-6">
        <a href="/note/edit?id=<?= $note['id']; ?>" class="text-gray-500 border border-current px-3 py-1 rounded">Edit</a>
      </footer>
    </div>
    <form action="" class="mt-6" method="POST">
      <input type="hidden" name="_method" value="DELETE">
      <input type="hidden" name="id" value="<?= $note['id']; ?>">
      <button class="text-sm text-red-500">Delete</button>
    </form>
  </div>
</main>
<?php require base_path('views/partials/footer.php') ?>