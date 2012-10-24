<section>
    echo form_open('curl/ajouter', array('method' => 'post'));

    echo form_label('Titre', 'titre');
    echo form_input(array('name' => 'titre', 'value' => $title, 'id' => 'titre'));
    echo form_label('Description', 'descri');
    ?>
    <textarea name="descri" id="descri" rows="4" cols="50"><?= $description ?></textarea>
    <?php
    if ($tabSrc != '') :
        $i = 0;

        foreach ($tabSrc as $src) :
            ?>
            <label for="<?= $i ?>"><img src="<?= $src ?>" /></label>
            <?php
            echo form_input(array('name' => 'choix', 'id' => $i, 'type' => 'radio', 'value' => $src));

            $i++;
        endforeach;
    endif;
    echo form_input(array('type' => 'hidden', 'value' => $url, 'name' => 'url'));
    echo form_input(array('type' => 'submit', 'value' => 'Enregistrer'));
    echo form_close();
    
    ?>

</section>