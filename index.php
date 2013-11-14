<?php
include '_header.php';
?>
<div class="container">
    <div class="starter-template">
        <h1>Current Wells Count</h1>

        <p>Use <code>+</code> and <code>-</code> keys to add/minus one count.</p>

        <div class="well well-lg" id="wellscount">
            0
        </div>
        <div class="btn-group">
            <button class="btn btn-lg btn-count btn-success" id="wells-up">+1</button>
            <button class="btn btn-lg btn-count btn-danger" id="wells-down">-1</button>
        </div>
    </div>
</div>
<!-- /.container -->
<?php
include '_footer.php';
?>
