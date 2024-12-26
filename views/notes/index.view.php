<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>
<?php require base_path('views/partials/banner.php') ?>
<main>
  <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
    Welcome to the Notes page.

    <ol>
      <?php foreach ($notes as $note): ?>
        <li class="mx-auto px-4 py-4 sm:px-4 lg: ">
          <a href="/note?id=<?= $note['id']; ?>" class="text-blue-500 hover:underline">
            <h2 class="text-xl font-bold tracking-tight"><?= $note['title']; ?></h2>
          </a>
          <p><?= htmlspecialchars($note['body']); ?></p>
        </li>
      <?php endforeach; ?>
    </ol>

    <p class="mt-6"><a href="/note/create" class="text-blue hover:underline">Create a Note</a></p>
  </div>
</main>
<?php require base_path('views/partials/footer.php') ?>