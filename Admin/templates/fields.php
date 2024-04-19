<div class="option-fields option-fields--smartrecruiters">
    <?php if (count($params['fields'])) : ?>
        <?php foreach ($params['fields'] as $name => $field) : ?>
            <div class="option-fields__row option-fields__row--smartrecruiters">
                <?php if (count($params['fields']) > 1) : ?>
                    <div class="option-fields__title"><strong><?php echo $field['title'] ?></strong></div>
                <?php endif ?>
                <div class="option-fields__field">
                    <?php if($field['type'] == 'select') : ?>
                        <select name="<?php echo $params['name'] . '-' . $name ?>" class="option-fields__form-field option-fields__form-field--smartrecruiters">
                            <?php $value = get_option($params['name'] . '-' . $name) ?>
                            <?php foreach ($field['options'] as $optionKey => $optionValue) : ?>
                                <option value="<?php echo $optionKey ?>" <?php if($optionKey === $value): ?>selected<?php endif ?>><?php echo $optionKey ?></option>
                            <?php endforeach ?>
                        </select>
                    <?php elseif($field['type'] == 'checkbox') : ?>
                        <input name="<?php echo $params['name'] . '-' . $name ?>" type="<?php echo $field['type'] ?>" class="option-fields__form-field option-fields__form-field--smartrecruiters" <?php if(get_option($params['name'] . '-' . $name) == 'on'): ?>checked<?php endif ?>>
                    <?php else : ?>
                        <input name="<?php echo $params['name'] . '-' . $name ?>" type="<?php echo $field['type'] ?>" class="option-fields__form-field option-fields__form-field--smartrecruiters" value="<?php echo esc_attr(get_option($params['name'] . '-' . $name)) ?>">
                    <?php endif ?>
                    <?php if(!empty($field['description'])) : ?>
                        <div class="option-fields__description"><i><?php echo $field['description'] ?></i></div>
                    <?php endif ?>
                </div>
            </div>
        <?php endforeach ?>
    <?php endif ?>
    <h2>Bedienungsanleitung</h2>
    <ol>
        <li><p>Gebe hier im Feld "Company" die Company-ID der Firma ein, deren Jobangebote Du anzeigen willst.</p></li>
        <li><p>Auf den Seiten Table, Map und Job kannst Du Einstellungen für Farben und Überschriften anpassen</p></li>
        <li><p>Erstelle eine neue Seite mit dem Titel "Job-Angebot"<br>Achte darauf, dass der Permalink job-angebot lautet.</p></li>
        <li><p>Füge dort den folgenden Shortcode ein:<br>[smartrecruiters template="job"]</p></li>
        <li><p>Füge nun in der Seite auf der Du die Karte anzeigen willst den folgenden Shortcode ein:<br>[smartrecruiters template="map"]</p></li>
        <li><p>Füge nun in der Seite auf der Du die Tabelle anzeigen willst den folgenden Shortcode ein:<br>[smartrecruiters template="table"]</p></li>
        <li><p>Thats it, Happy recruiting :) </p></li>
    </ol>
</div>