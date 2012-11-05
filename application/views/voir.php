<section>
    <?php
    echo form_open('curl/modifier', array('method' => 'post'));

    echo form_label('Titre', 'titre');
    echo form_input(array('name' => 'titre', 'value' => $donnee->titre, 'id' => 'titre'));
    echo form_label('Description', 'descri');
    ?>
    <textarea name="descri" id="descri" rows="4" cols="50"><?= $donnee->description ?></textarea>

    <label for="img_enre"><img src="<?= site_url() . UPLOADS_DIR . $donnee->image ?>" /></label>
    <?= form_input(array('name' => 'choix', 'id' => 'img_enre', 'type' => 'radio', 'value' => $donnee->image)); ?>


    <?php
    echo form_input(array('type' => 'hidden', 'value' => $donnee->url, 'name' => 'url'));
    echo form_input(array('type' => 'hidden', 'value' => $donnee->id, 'name' => 'id'));
    echo form_input(array('type' => 'submit', 'value' => 'Modifier'));
    echo form_close();

    echo anchor('curl/index', 'Accueil', array('title' => 'Retourner à la liste des articles'));
    ?>


</section>