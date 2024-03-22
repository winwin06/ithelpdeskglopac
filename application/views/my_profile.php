<div class="card mb-3" style="max-width: 540px;">
    <div class="row no-gutters">
        <div class="col-md-4">
        <img src="<?= base_url('assets/dist/img/profile/profile.png') ?>" 
        class="card-img" style="max-width: 100%; height: auto;">
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title"><?= $user['name']; ?></h5>
                <p class="card-text"></p><?= $user['email']; ?></p>
                <p class="card-text"><small class="text-muted">Member since <?= $user['created_at']; ?></small></p>
            </div>
        </div>
    </div>
</div>