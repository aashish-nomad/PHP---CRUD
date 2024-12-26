<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>
<?php require base_path('views/partials/banner.php') ?>
<main>
  <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
    <form action="/note" method="POST">
      <input type="hidden" name="_method" value="PATCH">
      <input type="hidden" name="id" value="<?= $note['id']; ?>">
      <div class="space-y-12">
        <div class="border-b border-gray-900/10 pb-12">
          <div class="mt-2 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
            <div class="col-span-full">
              <label for="title" class="block text-sm/6 font-medium text-gray-900">Note Title</label>
              <div class="mt-2">
                <textarea name="title" id="about" rows="1" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"><?= isset($_POST['title']) ? $_POST['title'] : $note['title']; ?></textarea>
              </div>
              <p class="text-red-700"><?= $errors['title'] ?? ''; ?></p>
            </div>
            <div class="col-span-full">
              <label for="body" class="block text-sm/6 font-medium text-gray-900">Note Body</label>
              <div class="mt-2">
                <textarea name="body" id="about" rows="3" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"><?= isset($_POST['body']) ? $_POST['body'] : $note['body']; ?></textarea>
              </div>
              <p class="text-red-700"><?= $errors['body'] ?? ''; ?></p>
            </div>
          </div>
        </div>
      </div>

      <div class="mt-2 flex items-center justify-end gap-x-6">
        <a href="/notes" class="text-gray-500 border border-current px-3 py-1 rounded">Cancel</a>
        <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Update</button>
      </div>
    </form>

  </div>
</main>
<?php require base_path('views/partials/footer.php') ?>