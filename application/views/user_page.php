<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">User History</h3>
        </div>
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <tr>
                        <td><?= $i; ?>.</td>
                        <td><?= $user['name']; ?></td>
                        <td><?= $user['email']; ?></td>
                        <td><?= $user['role']; ?></td>
                    </tr>
                    <?php $i++; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>