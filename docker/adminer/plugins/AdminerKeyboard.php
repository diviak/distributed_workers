<?php

class AdminerKeyboard
{
    public function __construct($scripts = ["js/jquery.min.js", "js/select2.min.js", "js/mousetrap.min.js"], $styles = ['css/select2.min.css'])
    {
        $this->scripts = $scripts;
        $this->styles = $styles;
    }

    public function tablesPrint($tables)
    {
        foreach ($this->scripts as $script) {
            echo "<script type='text/javascript' src='" . h($script) . "' " . nonce() . "></script>\n";
        }

        foreach ($this->styles as $style) {
            echo "<link href='" . h($style) . "' rel='stylesheet'/>\n";
        }

        ?>

        <style>
            .jtt-dropdown {
                background: #ccc;
                z-index: 1000;
                width: 500px;
                left: 50%;
                margin-left: -250px;
                top: 50%;
                margin-top: -100px;
                position: fixed;
            }

            .jtt-hidden {
                display: none;
            }

            .jtt-select2-results li:empty {
                display: none;
            }
        </style>

        <?php echo "<script type='text/javascript' src='" . h('js/adminer_keyboard.js') . "' " . nonce() . "></script>\n";?>

        <div class="jtt-dropdown jtt-hidden">
            <select class="jtt-dropdown-select">
                <option></option>
                <?php
                foreach (array_keys($tables) as $table) {
                    echo "<option>{$table}</option>";
                }
                ?>
            </select>
        </div>

        <?php
    }
}
