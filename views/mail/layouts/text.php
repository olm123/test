<?php

/*
 * This file is part of the EveRose project.
 *
 * (c) EveRose project <http://github.com/EveRose>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

/**
 * @var string $content main view render result
 */
?>

<?php $this->beginPage() ?>
<?php $this->beginBody() ?>
<?= $content ?>
<?php $this->endBody() ?>
<?php $this->endPage() ?>
