<div class="card mb-3" style="max-width: 540px;">
    <div class="row no-gutters">
        <div class="col-md-8">
            <div class="card-body">
                <?php if ($user): ?>
                    <h5 class="card-title"><?= $user['name']; ?></h5>
                    <p class="card-text"><?= $user['email']; ?></p>
                    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                <?php else: ?>
                    <p class="card-text">User data not available.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
