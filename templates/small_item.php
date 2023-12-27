<?php include_once "utils/smarter.php"; ?>
<a href="/item.php?id=<?= $props['item']['id'] ?>">
<div>
    <div><?= $props['item']['name'] ?></div>
    <div><?= $props['item']['short_description'] ?></div>
    <div><?= Smarter\currency($props['item']['price']/100) ?></div>
</div>
</a>