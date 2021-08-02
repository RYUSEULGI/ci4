<h1>게시판</h1>
<ul>
    <?php
    foreach ($boardList as $entry) {
    ?>
        <li>
            <a href="/board/get/<?= $entry->id ?>">
                <?= $entry->title ?>
            </a>
        </li>
    <?php
    }
    ?>
</ul>