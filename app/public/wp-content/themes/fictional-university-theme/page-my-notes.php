<?php
if (!is_user_logged_in()) {
    wp_redirect(site_url('/'));
    exit;
}
get_header();
while (have_posts()) {
    the_post();

    pageBanner();
    // pageBanner(array(
    //     'title' => 'Hi this is a title',
    //     'subtitle' => 'Hi this is a subtitle',
    //     'photo' => 'https://wallpapershome.com/images/pages/pic_h/5490.jpg'
    // ));
?>

    <div class="container container--narrow page-section">
        <div class="create-note">
            <h2 class="headline headline--medium">Create New Note</h2>
            <input placeholder="Title" class="new-note-title">
            <textarea placeholder="Your note here..." class="new-note-body"></textarea>
            <span class="submit-note">Create Note</span>
        </div>
        <ul class="min-list link-list" id="my-notes">
            <?php
            $userNotes = new WP_Query(array(
                'post_type' => 'note',
                'posts_per_page' => -1,
                'author' => get_current_user_id()
            ));
            while ($userNotes->have_posts()) {
                $userNotes->the_post();
            ?>
                <li data-id="<?php the_ID(); ?>">
                    <input readonly class="note-title-field" value="<?php echo str_replace('Private: ', '', esc_attr(get_the_title())); ?>">
                    <span class="edit-note"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</span>
                    <span class="delete-note"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</span>
                    <textarea readonly class="note-body-field"><?php echo esc_attr(wp_strip_all_tags(get_the_content())); ?></textarea>
                    <span class="update-note btn btn--blue btn--small"><i class="fa fa-arrow-right" aria-hidden="true"></i> Save</span>
                </li>
            <?php
            }
            ?>
        </ul>
    </div>


    <h2>This is a page not a post</h2>
<?php
}
get_footer();
?>