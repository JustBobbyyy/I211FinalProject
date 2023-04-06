<?php
/**
 * Author: Bobby Ezenwelu
 * Date: 4/6/23
 * File: error.php
 * Description:
 */
$page_title = "error";

IndexView::displayHeader($page_title);
?>
<hr>
<table>
    <tr>
        <td>
            <h3>error</h3>
            <div>
                <?= urldecode($message) ?>
            </div>
        </td>
    </tr>
</table>

<?php 
IndexView::displayFooter();
?>