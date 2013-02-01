<section id="voir">
    <h3>
        <?= $donnee->titre; ?>
    </h3>
    <img src="<?= site_url() . UPLOADS_DIR . $donnee->image ?>" />
    
    <?php
        echo form_open('curl/modifier', array('method' => 'post'));
    ?>
    
    <div>
        <?php echo form_input(array('name' => 'titre', 'value' => $donnee->titre, 'id' => 'titre')); ?>
        <textarea name="descri" id="descri" rows="4" cols="50"><?= $donnee->description ?></textarea>
    </div>

    <?php
    echo form_input(array('type' => 'hidden', 'value' => $donnee->url, 'name' => 'url'));
    echo form_input(array('type' => 'hidden', 'value' => $donnee->id, 'name' => 'id'));
    echo form_input(array('type' => 'submit', 'value' => 'Modifier'));
    echo form_close();

    echo anchor('curl/index', 'Accueil', array('title' => 'Retourner à la liste des articles'));
    ?>


</section>