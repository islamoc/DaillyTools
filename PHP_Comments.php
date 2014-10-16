<?php
/*
##      Coded by Mennouchi Islam Azeddine <azeddine.mennouchi@owasp.org>
##     This program is free software: you can redistribute it and/or modify
##     it under the terms of the GNU Affero General Public License as published
##     by the Free Software Foundation, either version 3 of the License, or
##     (at your option) any later version.

##     This program is distributed in the hope that it will be useful,
##     but WITHOUT ANY WARRANTY; without even the implied warranty of
##     MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
##     GNU Affero General Public License for more details.

##     You should have received a copy of the GNU Affero General Public License
##     along with this program.  If not, see <http://www.gnu.org/licenses/>.
############################################################################
This is a tool to remove all Comments from all PHP files under the current dir
and its subdirs. Support only Windows
*/
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
