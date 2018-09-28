<?php
/**
 * Created by PhpStorm.
 * User: ruanxinwu
 * Date: 2018/9/27
 * Time: 10:34
 */
function pd()
{
    echo '<pre>'.PHP_EOL;
    for($i=0;$i<func_num_args();$i++){
        echo '---------------'.($i+1).'---------------'.PHP_EOL;
        print_r(func_get_arg($i));
        echo PHP_EOL;
    }
    echo '</pre>';
    die;
}

function pd_var()
{
    echo '<pre>'.PHP_EOL;
    for($i=0;$i<func_num_args();$i++){
        echo '---------------'.($i+1).'---------------'.PHP_EOL;
        var_dump(func_get_arg($i));
        echo PHP_EOL;
    }
    echo '</pre>';
    die;
}