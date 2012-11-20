<section id="afficher">
    <?= form_open('curl/choisir', array('method' => 'post')); ?>
    <?= form_label('Url', 'url'); ?>
    <?= form_input(array('name' => 'url', 'id' => 'url', 'placeholder' => 'Introduisez une url !')) ?>
    <?= form_submit('envoyer', 'Partager') ?>
    <?= form_close() ?>

    <? foreach ($donnees as $key => $donnee) : ?>
        <article> 
            <a href="<?= $donnee->url ?>" title="Se rendre sur le site"><img src="<?= site_url() . UPLOADS_DIR . $donnee->image ?>" /></a>
            <div>
                <h2><?= $donnee->titre ?></h2>              
                <p>
                    <?= $donnee->description ?>
                </p> 
                <p>
                    <small>
                        Site : <?= anchor($donnee->url ,$donnee->titre,array('title' => 'Se rendre sur le site')); ?>
                    </small>
                </p>
            </div>
            <aside>
                <?= anchor('curl/voir/' . $donnee->id, 'modifier', array('title' => 'Modifier cet article', 'id' => 'modifier')); ?>
                <?= anchor('curl/supprimer/' . $donnee->id, 'Supprimer', array('title' => 'Supprimer cet article', 'id' => 'supprimer')); ?>   
            </aside>
        </article>        
    <? endforeach; ?>
</section>

