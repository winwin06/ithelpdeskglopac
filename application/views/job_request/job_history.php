<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Job Request History</h3>
        </div>
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Job Title</th>
                        <th>Job Description</th>
                        <th>Department</th>
                        <th>Notes</th>
                        <th>Image</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($job_request as $us) : ?>
                        <tr>
                            <td><?= $i; ?>.</td>
                            <td><?= $us['job_title']; ?></td>
                            <td><?= $us['job_description']; ?></td>
                            <td><?= $us['department']; ?></td>
                            <td><?= $us['notes']; ?></td>
                            <td><img src="<?= base_url('assets/dist/img/job_request/') . $us['image']; ?>" style="width: 100px;" class="img-thumbnail"></td>
                            <td><?= $us['status']; ?></td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>