<?php
$s = exec("dir *.php /B /S",$arr);
foreach ($arr as $value) {
$fileStr = file_get_contents($value);
$newStr  = '';

$commentTokens = array(T_COMMENT);

if (defined('T_DOC_COMMENT'))
    $commentTokens[] = T_DOC_COMMENT; if (defined('T_ML_COMMENT'))
    $commentTokens[] = T_ML_COMMENT;  
$tokens = token_get_all($fileStr);

foreach ($tokens as $token) {
    if (is_array($token)) {
        if (in_array($token[0], $commentTokens))
            continue;

        $token = $token[1];
    }

    $newStr .= $token;
}

file_put_contents($value,$newStr);
}
?>
