<?php
    if ( $color === 'orange') {
        $color = '';
    }
    elseif ( $color === 'violet') {
        $color = ' leo-button__violet';
    }
    elseif ( $color === 'gray') {
        $color = ' leo-button__gray';
    }
    else {
        $color = ' leo-button__white';
    }

    $className = $className ? ' ' . $className : '';

    if ( $href ) {
?>
    <a
        <?=$id ? 'id="' . $id . '"' : ''?>
        <?=$title ? 'title="' . $title . '"' : ''?>
        <?=$ariaLabel ? 'aria-label="' . $ariaLabel . '"' : ''?>
        href="<?=$href?>"
        <?= $target ? ' target="' . $target . '"' : ''?>
        <?= $target === '_blank' ? ' rel="noopener noreferrer"' : ''?>
        class="leo-button<?=$color . $className?>"
    >
        <?=$icon ? $icon : '' ?>
        <?=$content?>
    </a>
<?php
    }
    else {
?>
    <button
        <?=$id ? 'id="' . $id . '"' : ''?>
        <?=$type ? 'type="' . $type . '"' : 'type="button"'?>
        <?=$title ? 'title="' . $title . '"' : ''?>
        <?=$ariaLabel ? 'aria-label="' . $ariaLabel . '"' : ''?>
        class="leo-button<?=$color . $className?>"
    >
        <?=$icon ? $icon : '' ?>
        <?=$content?>
    </button>
<?php
    }
?>