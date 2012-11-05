<section id="afficher">
    <?= form_open('curl/choisir', array('method' => 'post')); ?>
    <?= form_label('Url', 'url'); ?>
    <?= form_input(array('name' => 'url', 'id' => 'url','placeholder' => 'Introduisez une url !')) ?>
    <?= form_submit('envoyer', 'Partager') ?>
    <?= form_close() ?>

    <? foreach ($donnees as $key => $donnee) : ?>
    <article> 
        <a href="<?= $donnee->url ?>" title="Visiter ce site"><img src="<?= site_url(). UPLOADS_DIR .$donnee->image ?>" /></a>
        <h2><a href="<?= $donnee->url ?>" title="Visiter ce site"><?= $donnee->titre ?></a></h2>
        <?= anchor('curl/voir/' . $donnee->id, 'modifier', array('title' => 'Modifier cet article', 'id' => 'modifier')); ?>
        <?= anchor('curl/supprimer/' . $donnee->id, 'Supprimer', array('title' => 'Supprimer cet article', 'id' => 'supprimer')); ?>        
        <p>
            <?= $donnee->description ?>
        </p>    
    </article>
    <? endforeach; ?>
</section>

