<section class="section">
    <div class="section-header">
        <h1>Schedule</h1>
    </div>

    <div class="section-body">
        <b>Schedule Management</b>
    </div>
    <div class="card-body">
        <a href="<?= base_url()?>/report" class="btn btn-success">Check Booking</a>
    </div>
    <div class="card-body">
        <table id="" border="1" class="display" style="width:100%">
            <thead>
                <tr align="center">
                    <th>Sports</th>
                    <th>Senin</th>
                    <th>Selasa</th>
                    <th>Rabu</th>
                    <th>Kamis</th>
                    <th>Jumat</th>
                    <th>Sabtu</th>
                    <th>Minggu</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($groupedSchedules as $jenis => $times):?>
                <?php foreach ($times as $timeRange => $days): ?>
                <tr align="center">
                    <?php if ($timeRange === array_key_first($times)): ?>
                    <td rowspan="<?= count($times) ?>"><?= $jenis ?></td>
                    <?php endif; ?>
                    <th style="background-color: <?= empty($days['Senin']) ? '#ffcccc' : 'transparent' ?>;">
                        <?= $days['Senin'] ?? '' ?></th>
                    <th style="background-color: <?= empty($days['Selasa']) ? '#ffcccc' : 'transparent' ?>;">
                        <?= $days['Selasa'] ?? '' ?></th>
                    <th style="background-color: <?= empty($days['Rabu']) ? '#ffcccc' : 'transparent' ?>;">
                        <?= $days['Rabu'] ?? '' ?></th>
                    <th style="background-color: <?= empty($days['Kamis']) ? '#ffcccc' : 'transparent' ?>;">
                        <?= $days['Kamis'] ?? '' ?></th>
                    <th style="background-color: <?= empty($days['Jumat']) ? '#ffcccc' : 'transparent' ?>;">
                        <?= $days['Jumat'] ?? '' ?></th>
                    <th style="background-color: <?= empty($days['Sabtu']) ? '#ffcccc' : 'transparent' ?>;">
                        <?= $days['Sabtu'] ?? '' ?></th>
                    <th style="background-color: <?= empty($days['Minggu']) ? '#ffcccc' : 'transparent' ?>;">
                        <?= $days['Minggu'] ?? '' ?></th>
                </tr>
                <?php endforeach; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>
