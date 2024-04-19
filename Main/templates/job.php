<style>
    :root {
        --smartrecruiters-color: <?php echo $params->color ?>;
        --smartrecruiters-color-second: #1e1e1e;
        --smartrecruiters-color-line: lightgray;
        --smartrecruiters-color-light: #ffffff;
        --smartrecruiters-custom-button-color: <?php echo $params->customButtonColor ?>;
        --smartrecruiters-custom-button-text-color: <?php echo $params->customButtonTextColor ?>;
    }
</style>
<div class="smartrecruiters">
    <div class="smartrecruiters__job">
        <?php if (!empty($params->name)) : ?>
            <div class="smartrecruiters__header">
                <h1 class="smartrecruiters__title"><?php echo $params->name ?></h1>
                <div class="smartrecruiters__subtitle">
                    <?php if (!empty($params->address)): ?>
                        <div class="smartrecruiters__subtitle-cell"><?php echo $params->address ?></div>
                    <?php endif ?>
                    <?php if (!empty($params->city)): ?>
                        <div class="smartrecruiters__subtitle-cell"><?php echo $params->city ?></div>
                    <?php endif ?>
                    <?php if (!empty($params->country)): ?>
                        <div class="smartrecruiters__subtitle-cell"><?php echo $params->country ?></div>
                    <?php endif ?>
                </div>
            </div>
            <div class="smartrecruiters__content">
                <?php if (!empty($params->descriptionText)): ?>
                    <div class="smartrecruiters__section">
                        <div class="smartrecruiters__columns smartrecruiters__columns--two">
                            <?php if (!empty($params->descriptionTitle) || !empty($params->descriptionText)): ?>
                            <div class="smartrecruiters__column">
                                <?php if (!empty($params->descriptionTitle)): ?>
                                    <div class="smartrecruiters__section-title smartrecruiters__section-title--color"><?php echo $params->descriptionTitle ?></div>
                                <?php endif ?>
                                <?php if (!empty($params->descriptionText)): ?>
                                    <div class="smartrecruiters__section-text"><?php echo $params->descriptionText ?></div>
                                <?php endif ?>
                            </div>
                            <?php endif ?>
                            <?php if(!empty($params->image)): ?>
                                <div class="smartrecruiters__column">
                                    <div class="smartrecruiters__image"><img src="<?php echo $params->image ?>"></div>
                                </div>
                            <?php endif ?>
                        </div>
                        <div class="smartrecruiters__block smartrecruiters__center">
                            <?php if (!empty($params->link) && !empty($params->linkTitle)): ?>
                                <a href="<?php echo $params->link ?>" class="smartrecruiters__button smartrecruiters__button--main" target="_blank" data-alert="<?php echo $params->alert ?>"><?php echo $params->linkTitle ?></a>
                            <?php endif ?>
                            <?php if (!empty($params->customButtonOn) && !empty($params->customButtonText) && !empty($params->customButtonLink)): ?>
                                <a href="<?php echo $params->customButtonLink ?>" class="smartrecruiters__button smartrecruiters__button--custom" <?php if($params->customButtonTargetBlank) : ?>target="_blank"<?php endif ?>>
                                    <?php echo $params->customButtonText ?>
                                </a>
                            <?php endif ?>
                        </div>
                    </div>
                <?php endif ?>
                <?php if (!empty($params->qualificationsText) || !empty($params->additionalInformationText)): ?>
                    <div class="smartrecruiters__section smartrecruiters__lines">
                        <div class="smartrecruiters__columns  smartrecruiters__columns--two">
                            <?php if (!empty($params->qualificationsText)): ?>
                                <div class="smartrecruiters__column">
                                    <?php if (!empty($params->qualificationsTitle)): ?>
                                        <div class="smartrecruiters__section-title"><?php echo $params->qualificationsTitle ?></div>
                                    <?php endif ?>
                                    <div class="smartrecruiters__section-text"><?php echo $params->qualificationsText ?></div>
                                </div>
                            <?php endif ?>
                            <?php if (!empty($params->additionalInformationText)): ?>
                                <div class="smartrecruiters__column">
                                    <?php if (!empty($params->additionalInformationTitle)): ?>
                                        <div class="smartrecruiters__section-title"><?php echo $params->additionalInformationTitle ?></div>
                                    <?php endif ?>
                                    <div class="smartrecruiters__section-text"><?php echo $params->additionalInformationText ?></div>
                                </div>
                            <?php endif ?>
                        </div>
                    </div>
                <?php endif ?>
                <?php if (!empty($params->video)): ?>
                    <div class="smartrecruiters__section">
                        <div class="smartrecruiters__block smartrecruiters__center">
                            <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $params->video ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                        </div>
                    </div>
                <?php endif ?>
            </div>
            <div class="smartrecruiters__bottom">
                <div class="smartrecruiters__block smartrecruiters__center">
                    <?php if (!empty($params->link) && !empty($params->linkTitle)): ?>
                        <a href="<?php echo $params->link ?>" class="smartrecruiters__button smartrecruiters__button--main" target="_blank" data-alert="<?php echo $params->alert ?>"><?php echo $params->linkTitle ?></a>
                    <?php endif ?>
                    <?php if (!empty($params->customButtonOn) && !empty($params->customButtonText) && !empty($params->customButtonLink)): ?>
                        <a href="<?php echo $params->customButtonLink ?>" class="smartrecruiters__button smartrecruiters__button--custom" <?php if($params->customButtonTargetBlank) : ?>target="_blank"<?php endif ?>>
                            <?php echo $params->customButtonText ?>
                        </a>
                    <?php endif ?>
                </div>
            </div>
        <?php else : ?>
            <div class="smartrecruiters__section smartrecruiters__section--empty">
                <div class="smartrecruiters__block smartrecruiters__block--empty"><?php echo $params->empty ?></div>
            </div>
        <?php endif ?>
    </div>
</div>