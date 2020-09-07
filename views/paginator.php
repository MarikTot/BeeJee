<?php $links = $links ?? []; ?>
<?php foreach ($links as $page => $pageInfo): ?>
    <?php
    if ($page > 3) {
        if ($page < count($links)) {
            continue;
        } else {
            echo '...';
        }
    }
    ?>
    <a
        href="<?= $pageInfo['link'] ?? '' ?>"
        class="btn btn-info <?= isset($currentPage) && $page === $currentPage ? 'active' : '' ?> <?php if (isset($pageInfo['disabled']) && $pageInfo['disabled']): ?>disabled<?php endif;?>"
    >
        <?= $page ?>
    </a>
<?php endforeach; ?>
