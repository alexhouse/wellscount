<?php
$redis = new Redis();
$redis->connect('localhost', 6969);

$keys = $redis->keys('*');
$vals = $redis->mget($keys);

$history = array_combine($keys, $vals);
krsort($history);

include '_header.php';
?>
<div class="container">
    <div class="starter-template">
        <h1>Wells Count, A History</h1>
        <table class="history">
            <colgroup>
                <col width="200"/>
                <col width="100"/>
            </colgroup>
            <thead>
            <tr>
                <th>Date</th>
                <th>Count</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($history as $date => $count): if ($count == 0) {
                continue;
            } ?>
                <tr>
                    <td><?php echo substr($date, 0, 4), '-', substr($date, 4, 2), '-', substr($date, 6, 2); ?></td>
                    <td><strong><?php echo $count; ?></strong></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div><!-- /.container -->
<?php
include '_footer.php';
?>>
