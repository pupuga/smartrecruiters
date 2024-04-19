<div class="wrap">
    <h2><?php echo get_admin_page_title() ?></h2>
    <form method="post" action="options.php">
        <?php settings_fields($params['group']); ?>
        <?php do_settings_sections($params['group']); ?>
        <?php echo $params['html-fields'] ?>
        <?php submit_button(); ?>
    </form>
</div>