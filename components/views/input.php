<?php

$className = $className ? ' ' . $className : '';

if ( $type !== 'textarea' ) {
?>
    <label class="leo-input<?=$className?>">
        <input
            value="<?=$value?>"
            <?=$name ? 'name="' . $name . '"' : ''?>
            <?=$type ? 'type="' . $type . '"' : 'type="text"'?>
            <?=$id ? 'id="' . $id . '"' : ''?>
            class="leo-input_value"
            placeholder=" "
            <?=$required ? 'required' : ''?>
        >
        <?=$placeholder ? 
            '<span class="leo-input_placeholder">' . $placeholder .'</span>'
        : ''
        ?>
        <?=$actionIcon ? $actionIcon : ''?>
    </label>
<?php
} else {
?>
    <label class="leo-input leo-input__textarea<?=$className?>">
        <textarea
            <?=$name ? 'name="' . $name . '"' : ''?>
            class="leo-input_value"
            <?=$id ? 'id="' . $id . '"' : ''?>
            placeholder=" "
            <?=$required ? 'required' : ''?>
        ><?=$value?></textarea>
        <?=$placeholder ? 
            '<span class="leo-input_placeholder">' . $placeholder .'</span>'
        : ''
        ?>
        <?=$actionIcon ? $actionIcon : ''?>
    </label>
<?php
}
?>