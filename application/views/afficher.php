<div id="afficher">
    <?= form_open('curl/choisir', array('method' => 'post')); ?>
    <?= form_label('Url', 'url'); ?>
    <?= form_input(array('name' => 'url', 'id' => 'url', 'placeholder' => 'Ex: http://www.google.be', 'type' => 'url')) ?>
    <?= form_submit('envoyer', 'Partager') ?>
    <?= form_close() ?>

    <? if ($this->session->userdata('url')): ?>
        <p class='erreur'>V&eacute;rifier votre Url et/ou son &eacute;criture (Ex: http://www.google.be)</p>
    <? endif; ?>

    <? foreach ($donnees as $key => $donnee) : ?>
        <article itemscope itemtype="http://schema.org/Article"> 
            <div class="image">
                <a href="<?= $donnee->url ?>" title="Se rendre sur le site"><img src="<?= site_url() . UPLOADS_DIR . $donnee->image ?>" itemprop="image"/></a>
            </div>
            <h2 itemprop="name"><?= $donnee->titre ?></h2>              
            <p itemprop="description">
                <?= $donnee->description ?>
            </p> 
            <p id="lien" itemprop="url">
                Site : <?= anchor($donnee->url, $donnee->url, array('title' => 'Se rendre sur le site')); ?>
            </p>
            <div class="action">
                <?= anchor('curl/voir/' . $donnee->id, 'Modifier', array('title' => 'Modifier cet article', 'class' => 'modifier')); ?>
                <?= anchor('curl/supprimer/' . $donnee->id, 'Supprimer', array('title' => 'Supprimer cet article', 'class' => 'supprimer')); ?>   
            </div>
        </article>        
    <? endforeach; ?>
</div>


