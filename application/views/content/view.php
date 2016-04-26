<?php
$text = str_replace('&lt;iframe', '<iframe', $text);
$text = str_replace('&gt;', '>', $text);
$text = str_replace('&lt;/iframe>', '</iframe>', $text);

echo $text;
?>