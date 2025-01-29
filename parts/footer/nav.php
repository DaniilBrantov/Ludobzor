<div class="row navy">
    <div class="col-md-12">
        <ul class="footer__menu">
            <?php foreach ($footer_sections as $section): ?>
            <li>
                <span class="caption">
                    <?= $section['title'] ?>
                    <i class="perecluchatel">   
                    +
                    </i>
                </span>
                <ul class="footer__submenu">
                    <?php if (isset($section['links'])): ?>
                    <?php foreach ($section['links'] as $link): ?>
                    <li>
                        <a href="<?= $link['href'] ?>" rel="nofollow noreferrer noopener">
                            <?= $link['label'] ?>
                        </a>
                    </li>
                    <?php endforeach; ?>
                    <?php endif; ?>

                    <?php if (isset($section['post_type'])): ?>
                    <?php
                            $args = array(
                                'post_type' => $section['post_type'],
                                'posts_per_page' => 5,
                                'orderby' => 'menu_order',
                                'order' => 'ASC'
                            );
                            $pages = new WP_Query($args);

                            if ($pages->have_posts()) {
                                while ($pages->have_posts()) {
                                    $pages->the_post();
                                    echo '<li><a href="' . get_permalink() . '" rel="nofollow noreferrer noopener">' . get_trimmed_title(get_the_title()) . '</a></li>';
                                }
                            }
                            wp_reset_postdata();
                            ?>
                    <?php endif; ?>

                    <?php if (isset($section['extra_link'])): ?>
                    <li>
                        <a href="<?= $section['extra_link']['href'] ?>" title="<?= $section['extra_link']['label'] ?>"
                            rel="nofollow noreferrer noopener"><?= $section['extra_link']['label'] ?>
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>

