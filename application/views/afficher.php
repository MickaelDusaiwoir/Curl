<?= form_open('curl/choisir', array('method' => 'post')); ?>
<?= form_label('Url', 'url'); ?>
<?= form_input(array('name' => 'url', 'id' => 'url')) ?>
<?= form_submit('envoyer', 'Partager') ?>
<?= form_close() ?>

<? foreach ($donnees as $key => $donne) : ?>
<article>    
    <h2><?= anchor($donne->url,$donne->titre,array('title'=>'Se rendre sur ce site')) ?></h2>
    <?= anchor('curl/voir/' . $donne->id, 'modifier', array('title' => 'Modifier cet article')); ?>
    <?= anchor('curl/supprimer/' . $donne->id, 'Supprimer', array('title' => 'Supprimer cet article')); ?>
    <img src="<?= site_url(). UPLOADS_DIR .$donne->image ?>" />
    <p>
        <?= $donne->description ?>
    </p>    
</article>
<? endforeach; ?>


