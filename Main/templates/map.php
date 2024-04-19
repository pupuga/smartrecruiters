<script>let smartrecruitersConfigMap = <?php echo $params->json ?></script>
<style>
    :root {
        --smartrecruiters-map-height: 500px;
        --smartrecruiters-map-font-size: 14px;
        --smartrecruiters-map-marker-color: rgba(<?php echo $params->color ?>, 1);
        --smartrecruiters-map-buble-color: rgba(<?php echo $params->color ?>, 0.6);
        --smartrecruiters-map-buble-second-color: rgba(<?php echo $params->color ?>, 0.6);
        --smartrecruiters-map-buble-text-color: <?php echo $params->textMarkerColor ?>;
        --smartrecruiters-map-gray: <?php echo (empty($params->gray) ? 'none' : 'grayscale(1)') ?>;
    }
</style>
<div class="smartrecruiters">
    <div class="smartrecruiters__map" id="smartrecruiters-map"></div>
</div>