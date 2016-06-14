
<div class="row" >

    <div class="col-md-3">
        <br />
        <ul class="nav nav-pills nav-stacked">
            <li><a href="<?= base_url('/ledenportaal/dashboard'); ?>">Dashboard</a></li>
            <li class="active"><a href="<?= base_url('/ledenportaal/dossiers'); ?>">Dossier overzicht</a></li>
            <li><a href="<?= base_url('/ledenportaal/contributieteruggaaf'); ?>">Contributieteruggaaf</a></li>
        </ul>


        <?php if (isset($dossier)) : ?>

            <br />
            <div class="panel panel-default">
                <div class="panel-heading">Dossierinformatie</div>
                <div class="panel-body">

                    <?php foreach($dossier->dossierinfo as $infoRegel) : ?>
                        <?= "<p>$infoRegel</p>"; ?>
                    <?php endforeach; ?>

                </div>
            </div>

        <?php endif; ?>

    </div>

    <div class="col-lg-9" >
        <h1>Webportaal Dossierhandelingen</h1>
        <h2>Dit is een beveiligde pagina</h2>

        <p>Let's put some happy little clouds in our world. Isn't that fantastic? You can just push a little tree out of your brush like that. See there how easy that is. Of course he's a happy little stone, cause we don't have any other kind.</p>

        <?php if (isset($dossier)) : ?>

            <?php $dossierLink = base_url('/ledenportaal/dossiers/downloadsecurefile/'); ?>
            <?php $backLink = base_url('/ledenportaal/dossiers/'); ?>

            <div class="panel panel-default">
                <div class="panel-heading"><a href="<?= $backLink ?>" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-arrow-left"></span> Terug</a>  Juridische handelingen</div>
                <div class="panel-body">
                    <table class="table">
                        <?php foreach($dossier->handelingen as $handeling) : ?>
                            <?php
                            $showLink = ($handeling->documentid != null) ? true : false;
                            echo "<tr><td>$handeling->datum</td><td>$handeling->onderwerp</td><td>";
                            echo ($showLink) ? "<a href='$dossierLink/$handeling->documentid' style='float: right;' target='_blank' >bekijken</a>" : null;
                            echo "</td></tr>";
                            ?>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>

        <?php endif; ?>
    </div>
</div>