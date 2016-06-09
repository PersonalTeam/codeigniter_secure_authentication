
<div class="row" >

    <div class="col-md-3">
        <br />
        <ul class="nav nav-pills nav-stacked">
            <li><a href="<?= base_url('/ledenportaal/dashboard'); ?>">Dashboard</a></li>
            <li class="active"><a href="<?= base_url('/ledenportaal/dossiers'); ?>">Dossier overzicht</a></li>
            <li><a href="<?= base_url('/ledenportaal/contributieteruggaaf'); ?>">Contributieteruggaaf</a></li>
        </ul>
    </div>

    <div class="col-lg-9" >
        <h1>Webportaal Dossieroverzicht</h1>
        <h2>Dit is een beveiligde pagina</h2>

        <p>I think there's an artist hidden in the bottom of every single one of us. The very fact that you're aware of suffering is enough reason to be overjoyed that you're alive and can experience it. That's crazy. With practice comes confidence. This is a happy place, little squirrels live here and play. A tree cannot be straight if it has a crooked trunk.</p>
        <p>If we're going to have animals around we all have to be concerned about them and take care of them. Think about a cloud. Just float around and be there. Even the worst thing we can do here is good. It's so important to do something every day that will make you happy. I can't think of anything more rewarding than being able to express yourself to others through painting.</p>
        <?php if (isset($dossiers)) : ?>

            <div class="panel panel-default">
                <div class="panel-heading">Lopende dossiers</div>
                <div class="panel-body">
                    <table class="table">
                        <?php foreach($dossiers->lopend as $dossier) : ?>
                            <?= "<tr><td>$dossier->datum</td><td>$dossier->dossiernr</td><td>$dossier->onderwerp</td><td><a href='#' style='float: right;' >bekijken</a></td></tr>"; ?>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>



            <div class="panel panel-default">
                <div class="panel-heading">Afgeronde dossiers</div>
                <div class="panel-body">
                    <table class="table">
                        <?php foreach($dossiers->afgerond as $dossier) : ?>
                            <?= "<tr><td>$dossier->datum</td><td>$dossier->dossiernr</td><td>$dossier->onderwerp</td><td><a href='#' style='float: right;' >bekijken</a></td></tr>"; ?>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>


        <?php endif; ?>
    </div>
</div>