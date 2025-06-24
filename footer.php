        <footer id="footer" class="footer">
            <div class="container">
                <div class="footer__wrapper">
                    <?php
                    $logo = get_field('site_logo', 'option');

                    if ($logo):
                        echo '<img class="footer__logo" src="' . esc_url($logo['url']) . '" alt="' . esc_attr($logo['alt']) . '">';
                    endif;
                    ?>

                    <div>
                        <?php
                        $disclaimer = get_field('disclaimer', 'option');
                        if ($disclaimer) {
                            echo '<p class="footer__disclaimer">' . esc_html($disclaimer) . '</p>';
                        }
                        ?>
                        <p>Copyright &copy;<?php echo date("Y"); ?> All Rights Reserved.</p>
                    </div>
                </div>
            </div>
        </footer>
        <?php wp_footer(); ?>
    </div>
</body>

</html>