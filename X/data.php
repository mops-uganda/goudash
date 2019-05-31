<?php
$url = 'report/votes?' . rand(1,200);
?>
<iframe src="<?php echo $url ?>" name="iframe_a" style="border:none;" onload="this.style.height=this.contentDocument.body.scrollHeight+150 +'px';" width="100%"></iframe>