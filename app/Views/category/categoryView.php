<?= $this->extend('layout/base') ?>

<?= $this->section('content') ?>
    <div class="form_flex11">
        <!-- search_results.php -->
    <?php if (!empty($results)) : ?>
        <h2>Search Results:</h2>
        <ul>
            <?php foreach ($results as $result) : ?>
                <li><?= 'language Name = ' . $result['language_name'] ?></li>
                <li><?= 'Category Slug = ' . $result['category_slug'] ?></li>
            <?php endforeach; ?>
        </ul>
    <?php else : ?>
        <p>No results found.</p>
    <?php endif; ?>
    </div>
<?= $this->endSection('content') ?>