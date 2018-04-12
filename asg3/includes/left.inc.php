<!-- This file was taken from lab 4 (php 3) -->

<aside class="col-md-2">
    <div class="panel panel-info">
        <div class="panel-heading">Continents</div>
        <ul class="list-group">
            <?php loadSideCont($pdo) ?>
        </ul>
    </div>
    <div class="panel panel-info">
        <div class="panel-heading">Popular</div>
        <ul class="list-group">
           <?php loadSideCountry($pdo); ?>
        </ul>
    </div>
</aside>