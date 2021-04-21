<?php

/**
 * @author David Grudl
 * @license BSD
 */
class AdminerJush
{
	public function head()
	{
		if (!DB) {
			return;
		} ?>
    <script<?php echo nonce();?> type="text/javascript" src="plugins/jush/jush.js"></script>
    <script<?php echo nonce();?> type="text/javascript">
      jush.style('plugins/jush/jush.css');
      jush.highlight_tag('textarea.sqlarea');
    </script>
<?php
	}
}
