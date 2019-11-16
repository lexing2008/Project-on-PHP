<div id="form_accept">
<?php
if( !empty($site['form']['accept']) ):?>
    <?php
    $size = count($site['form']['accept']);
    for($i=0; $i<$size; ++$i):?>
        <div><?=$site['form']['accept'][$i]?></div>
    <?php
    endfor;?>
<?php
endif;?>
</div>

<div id="form_errors">
<?php
if( !empty($site['form']['errors']) ):?>
    <?php
    $size = count($site['form']['errors']);
    for($i=0; $i<$size; ++$i):?>
        <div>- <?=$site['form']['errors'][$i]?></div>
    <?php
    endfor;?>
<?php
endif;?>
</div>