<?php
// --- 1. REGISTERING SETTINGS ---

function jdd_register_settings() {
    // Language Settings
    register_setting('jdd_theme_options_general', 'jdd_language_italian');
    
    // Animations
    register_setting('jdd_theme_options_animations', 'jdd_enable_gsap');
    register_setting('jdd_theme_options_animations', 'jdd_enable_lenis');
    register_setting('jdd_theme_options_animations', 'jdd_enable_fitty');

    // Custom Scripts
    register_setting('jdd_theme_options_custom_scripts', 'jdd_enable_custom_style');
    register_setting('jdd_theme_options_custom_scripts', 'jdd_enable_custom_scripts');

    // Performance
    register_setting('jdd_theme_options_performance', 'jdd_disable_gutenberg');
    register_setting('jdd_theme_options_performance', 'jdd_disable_comments');
    register_setting('jdd_theme_options_performance', 'jdd_enable_image_size_limit');

    // Third Part
    register_setting('jdd_theme_options_third_party', 'jdd_enable_admin_style_acpt');
}
add_action('admin_init', 'jdd_register_settings');


// --- 2. ADMIN MENU ---

function jdd_add_theme_menu() {
    $parent_slug = 'jdd-theme-options';
    $is_italian = get_option('jdd_language_italian', false);
    
    // Language - Specific Menu Names
    $menu_titles = [
        'main' => $is_italian ? 'Jovadd' : 'Jovadd',
        'animations' => $is_italian ? 'Animazioni' : 'Animations',
        'custom_scripts' => $is_italian ? 'Custom Scripts' : 'Custom Scripts',
        'performance' => $is_italian ? 'Performance' : 'Performance',
        'third_party' => $is_italian ? 'Terze Parti' : 'Third Party'
    ];

    add_menu_page(
        'JDD Bricks Option',
        $menu_titles['main'],
        'manage_options',
        $parent_slug,
        'jdd_render_main_page',
        get_stylesheet_directory_uri() . '/assets/svg/JB.svg',
        1
    );
    
    // Submenu
    add_submenu_page($parent_slug, $menu_titles['animations'], $menu_titles['animations'], 'manage_options', 'jdd-animations', 'jdd_render_animations_page');
    add_submenu_page($parent_slug, $menu_titles['custom_scripts'], $menu_titles['custom_scripts'], 'manage_options', 'jdd-custom-scripts', 'jdd_render_custom_scripts_page');
    add_submenu_page($parent_slug, $menu_titles['performance'], $menu_titles['performance'], 'manage_options', 'jdd-performance', 'jdd_render_performance_page');
    add_submenu_page($parent_slug, $menu_titles['third_party'], $menu_titles['third_party'], 'manage_options', 'jdd-third-party', 'jdd_render_third_party_page');
}
add_action('admin_menu', 'jdd_add_theme_menu'); 

// --- 3. TRANSLATION FUNCTION ---

function jdd_text($text_en, $text_it = null) {
    $is_italian = get_option('jdd_language_italian', false);
    
    if ($is_italian && $text_it !== null) {
        return $text_it;
    }
    
    return $text_en;
}

// --- 4. SAVE MESSAGE ---

function jdd_admin_notices() {
    if (isset($_GET['settings-updated']) && $_GET['settings-updated']) {
        $message = jdd_text(
            'Settings have been saved successfully.',
            'Le impostazioni sono state salvate correttamente.'
        );
        echo '<div class="banner-notice banner-notice-success notice notice-success is-dismissible"><p>' . $message . '</p></div>';
    }
}
add_action('admin_notices', 'jdd_admin_notices');


// --- 5. MAIN RENDER PAGE ---
function jdd_render_main_page() {
    $description = jdd_text(
        '<p class="jdd-intro-text"><strong>Jovadd Bricks</strong> is a premium child theme developed by <a class="ninedesigns" target="_blank" href="https://github.com/jovadd"><strong>jovadd</strong></a>, meticulously crafted to supercharge <a class="bricks-color" target="_blank" href="https://bricksbuilder.io">Bricks Builder</a> with enhanced performance, flexibility, and professional features.</p>
        
        <p>This theme brings together the best optimization practices and cutting-edge animation libraries to help you create stunning, award-worthy websites with minimal effort. Whether you\'re building a professional portfolio, an e-commerce platform, or a creative agency site, Jovadd Bricks provides the perfect foundation with:</p>
        
        <ul class="jdd-features-list">
            <li>⚡ <strong>Lightning-fast performance</strong> optimizations for improved Core Web Vitals</li>
            <li>✨ <strong>Premium animation libraries</strong> including GSAP, Lenis, and Fitty</li>
            <li>🛠️ <strong>Developer-friendly</strong> custom scripts and styling options</li>
            <li>🔒 <strong>Enhanced security</strong> with unnecessary WordPress features removed</li>
            <li>🌐 <strong>Multilingual support</strong> with full Italian interface</li>
        </ul>
        
        <p>Start building exceptional websites today with Jovadd Bricks – where performance meets creativity.</p>',
        
        '<p class="jdd-intro-text"><strong>Jovadd Bricks</strong> è un tema child premium sviluppato da <a class="ninedesigns" target="_blank" href="https://github.com/jovadd"><strong>jovadd</strong></a>, meticolosamente realizzato per potenziare <a class="bricks-color" target="_blank" href="https://bricksbuilder.io">Bricks Builder</a> con prestazioni migliorate, flessibilità e funzionalità professionali.</p>
        
        <p>Questo tema riunisce le migliori pratiche di ottimizzazione e librerie di animazione all\'avanguardia per aiutarti a creare siti web straordinari, degni di premi, con il minimo sforzo. Che tu stia costruendo un portfolio professionale, una piattaforma e-commerce o il sito di un\'agenzia creativa, Jovadd Bricks fornisce la base perfetta con:</p>
        
        <ul class="jdd-features-list">
            <li>⚡ <strong>Prestazioni ultra-veloci</strong> ottimizzate per migliorare i Core Web Vitals</li>
            <li>✨ <strong>Librerie di animazione premium</strong> tra cui GSAP, Lenis e Fitty</li>
            <li>🛠️ <strong>Opzioni ideali per sviluppatori</strong> con script e stili personalizzati</li>
            <li>🔒 <strong>Sicurezza migliorata</strong> con funzionalità WordPress non necessarie rimosse</li>
            <li>🌐 <strong>Supporto multilingue</strong> con interfaccia italiana completa</li>
        </ul>
        
        <p>Inizia oggi a costruire siti web eccezionali con Jovadd Bricks – dove le prestazioni incontrano la creatività.</p>'
    );
    
    $language_label = jdd_text('Italian Language', 'Lingua Italiana');
    $language_desc = jdd_text(
        '🌍 Enable Italian language for the admin interface.',
        '🌍 Abilita la lingua italiana per l\'interfaccia di amministrazione.'
    );
    $save_text = jdd_text('Save Changes', 'Salva Modifiche');
    ?>
    <div class="wrap jdd-theme-options">
        <h1>Jovadd Bricks | A Bricks Child Theme Built for Performance</h1>
        <hr>
        <div class="jdd-theme-description">
            <?php echo $description; ?>
        </div>
        <hr>
        
        <!-- Opzione della lingua  -->
        <form method="post" action="options.php">
            <?php settings_fields('jdd_theme_options_general'); ?>
            <?php do_settings_sections('jdd_theme_options_general'); ?>
            
            <div class="jdd-language-option">
                <div class="jdd-language-checkbox">
                    <input type="checkbox" name="jdd_language_italian" id="jdd_language_italian" value="1" <?php checked(1, get_option('jdd_language_italian'), true); ?> />
                    <label for="jdd_language_italian"><?php echo $language_label; ?></label>
                </div>
                <div class="jdd-language-desc">
                    <p><?php echo $language_desc; ?></p>
                </div>
                <div class="jdd-language-submit">
                    <?php submit_button($save_text); ?>
                </div>
            </div>
        </form>
        
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const languageCheckbox = document.getElementById('jdd_language_italian');
            
            if (languageCheckbox) {
                languageCheckbox.addEventListener('change', function() {
                    this.form.submit();
                });
            }
        });
        </script>
        
        <style>
        .jdd-theme-description {
            margin: 25px 0;
        }
        .jdd-intro-text {
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 20px;
        }
        .jdd-features-list {
            background-color: #f9f9f9;
            border-left: 4px solid #0073aa;
            padding: 15px 20px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .jdd-features-list li {
            margin-bottom: 10px;
            line-height: 1.5;
        }
        .ninedesigns {
            color: #d54e21;
            text-decoration: none;
            font-weight: 500;
        }
        .bricks-color {
            color: #e4002b;
            text-decoration: none;
            font-weight: 500;
        }
        .jdd-theme-options h1 {
            margin-bottom: 15px;
        }
        /* Nuovo stile per l'opzione lingua */
        .jdd-language-option {
            display: flex;
            align-items: center;
            gap: 25px;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 6px;
            margin: 20px 0;
        }
        .jdd-language-checkbox {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .jdd-language-checkbox label {
            font-weight: 500;
            font-size: 15px;
        }
        .jdd-language-desc {
            flex-grow: 1;
            background-color: #f0f0f0;
            padding: 12px 16px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        .jdd-language-desc p {
            margin: 0;
            font-size: 14px;
        }
        .jdd-language-submit .button {
            background-color: #0073aa;
            color: white;
            border-color: #005177;
        }
        .jdd-language-submit .button:hover {
            background-color: #005177;
        }
        </style>
    </div>
    <?php
}


// --- 6. ANIMATIONS RENDER PAGE ---

function jdd_render_animations_page() {
    $title = jdd_text('Animations', 'Animazioni');
    $subtitle = jdd_text(
        'Gsap, Lenis and Fitty - Make your site Awwwards-ready 😉',
        'Gsap, Lenis e Fitty - Rendi il tuo sito pronto per Awwwards 😉'
    );
    $gsap_label = 'GSAP';
    $gsap_desc = jdd_text(
        '🚀 Activate the leading library for professional web animations. Enhance user experience with smooth transitions and dynamic interactions.',
        '🚀 Attiva la libreria leader per animazioni web professionali. Migliora l\'esperienza utente con transizioni fluide e interazioni dinamiche.'
    );
    $lenis_label = 'LENIS JS';
    $lenis_desc = jdd_text(
        '✨ Implement high-quality smooth scrolling for an elegant and seamless browsing experience.',
        '✨ Implementa uno smooth scrolling di alta qualità per un\'esperienza di navigazione elegante e senza interruzioni.'
    );
    $fitty_label = 'FITTY JS';
    $fitty_desc = jdd_text(
        '📏 Optimize responsive text with this library that perfectly adapts fonts to any container size.',
        '📏 Ottimizza il testo responsive con questa libreria che adatta perfettamente i font a qualsiasi dimensione del contenitore.'
    );
    $lenis_warning = jdd_text(
        '<strong style="color:#cc6600;">Warning:</strong> To use Lenis you must also activate GSAP + ScrollTrigger.',
        '<strong style="color:#cc6600;">Attenzione:</strong> Per usare Lenis devi attivare anche GSAP + ScrollTrigger.'
    );
    $save_text = jdd_text('Save Changes', 'Salva Modifiche');
    ?>
    <div class="wrap jdd-theme-options">
        <h1><?php echo $title; ?></h1>
        <hr>
        <p><?php echo $subtitle; ?></p>
        <hr>
        <form method="post" action="options.php">
            <?php settings_fields('jdd_theme_options_animations'); ?>
            <?php do_settings_sections('jdd_theme_options_animations'); ?>
            <table class="form-table jdd-form-table">
                <tr>
                    <th><label for="jdd_enable_gsap"><?php echo $gsap_label; ?></label></th>
                    <td class="td-back-flex">
                        <input type="checkbox" name="jdd_enable_gsap" id="jdd_enable_gsap" value="1" <?php checked(1, get_option('jdd_enable_gsap'), true); ?> />
                        <p class="description description-functions"><?php echo $gsap_desc; ?></p>
                    </td>
                </tr>

                <tr>
                    <th><label for="jdd_enable_lenis"><?php echo $lenis_label; ?></label></th>
                    <td class="td-back-flex">
                        <input type="checkbox" name="jdd_enable_lenis" id="jdd_enable_lenis" value="1" <?php checked(1, get_option('jdd_enable_lenis'), true); ?> />
                        <p class="description description-functions"><?php echo $lenis_desc; ?></p>
                    </td>
                </tr>
                <tr>
                    <th><label for="jdd_enable_fitty"><?php echo $fitty_label; ?></label></th>
                    <td class="td-back-flex">
                        <input type="checkbox" name="jdd_enable_fitty" id="jdd_enable_fitty" value="1" <?php checked(1, get_option('jdd_enable_fitty'), true); ?> />
                        <p class="description description-functions"><?php echo $fitty_desc; ?></p>
                    </td>
                </tr>
            </table>
            <?php submit_button($save_text); ?>
        </form>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const lenisCheckbox = document.getElementById('jdd_enable_lenis');
        const gsapCheckbox = document.getElementById('jdd_enable_gsap');

        if (!lenisCheckbox || !gsapCheckbox) return;

        const notice = document.createElement('div');
        notice.className = 'jdd-notice';
        notice.style = "margin-top:10px;padding:12px;background:#fff8e5;border-left:4px solid #ff9900;border-radius:5px;";
        notice.innerHTML = '<?php echo $lenis_warning; ?>';

        lenisCheckbox.closest('tr').appendChild(notice);

        function checkDependencies() {
            notice.style.display = (lenisCheckbox.checked && !gsapCheckbox.checked) ? 'block' : 'none';
        }
        checkDependencies();
        lenisCheckbox.addEventListener('change', checkDependencies);
        gsapCheckbox.addEventListener('change', checkDependencies);
    });
    </script>
    <?php
}


// --- 7. CUSTOM SCRIPTS RENDER PAGE  ---

function jdd_render_custom_scripts_page() {
    $title = jdd_text('Custom Scripts', 'Custom Scripts');
    $subtitle = jdd_text(
        'Enable Custom CSS and Custom Javascript 😉',
        'Attiva Custom CSS e Custom Javascript 😉'
    );
    $custom_style_label = jdd_text('Custom Style', 'Stile Custom');
    $custom_style_desc = jdd_text(
        '🎨 Enable custom CSS to refine your site\'s appearance with unique styles without modifying theme files.',
        '🎨 Abilita CSS personalizzato per perfezionare l\'aspetto del tuo sito con stili unici senza modificare i file del tema.'
    );
    $custom_scripts_label = jdd_text('Custom Scripts', 'Scripts Custom');
    $custom_scripts_desc = jdd_text(
        '⚙️ Integrate custom JavaScript to add advanced functionality and dynamic interactions not available in the base theme.',
        '⚙️ Integra JavaScript personalizzato per aggiungere funzionalità avanzate e interazioni dinamiche non disponibili nel tema base.'
    );
    $save_text = jdd_text('Save Changes', 'Salva Modifiche');
    ?>
    <div class="wrap jdd-theme-options">
        <h1><?php echo $title; ?></h1>
        <hr>
        <p><?php echo $subtitle; ?></p>
        <hr>
        <form method="post" action="options.php">
            <?php settings_fields('jdd_theme_options_custom_scripts'); ?>
            <?php do_settings_sections('jdd_theme_options_custom_scripts'); ?>
            <table class="form-table jdd-form-table">
                <tr>
                    <th><label for="jdd_enable_custom_style"><?php echo $custom_style_label; ?></label></th>
                    <td class="td-back-flex">
                        <input type="checkbox" name="jdd_enable_custom_style" id="jdd_enable_custom_style" value="1" <?php checked(1, get_option('jdd_enable_custom_style'), true); ?> />
                        <p class="description description-functions"><?php echo $custom_style_desc; ?></p>
                    </td>
                </tr>
                <tr>
                    <th><label for="jdd_enable_custom_scripts"><?php echo $custom_scripts_label; ?></label></th>
                    <td class="td-back-flex">
                        <input type="checkbox" name="jdd_enable_custom_scripts" id="jdd_enable_custom_scripts" value="1" <?php checked(1, get_option('jdd_enable_custom_scripts'), true); ?> />
                        <p class="description description-functions"><?php echo $custom_scripts_desc; ?></p>
                    </td>
                </tr>
            </table>
            <?php submit_button($save_text); ?>
        </form>
    </div>
    <?php
}


// --- 8. PERFORMANCE RENDER PAGE ---

function jdd_render_performance_page() {
    $title = jdd_text('Performance', 'Performance');
    $subtitle = jdd_text(
        'Boost your website’s performance 🚀',
        'Aumenta le performance del tuo sito web 🚀'
    );
    $disable_gutenberg_label = jdd_text('Disable Gutenberg', 'Disabilita Gutenberg');
    $disable_gutenberg_desc = jdd_text(
        '⚡ Optimize server resources by disabling the Gutenberg editor. Ideal for sites exclusively using Bricks Builder.',
        '⚡ Ottimizza le risorse del server disattivando l\'editor Gutenberg. Ideale per siti che utilizzano esclusivamente Bricks Builder.'
    );
    $disable_comments_label = jdd_text('Disable Comments', 'Disabilita Commenti');
    $disable_comments_desc = jdd_text(
        '🛡️ Improve security and performance by completely removing the comments functionality from WordPress. Perfect for showcase sites.',
        '🛡️ Migliora sicurezza e performance rimuovendo completamente la funzionalità commenti da WordPress. Perfetto per siti vetrina.'
    );
    $image_limit_label = jdd_text('Limit Image Size', 'Limita Dimensione Immagini');
    $image_limit_desc =  jdd_text(
        '📏 Limit uploaded images to a maximum of 500 KB to improve site performance and reduce bandwidth usage.',
        '📏 Limita le immagini caricate a un massimo di 500 KB per migliorare le prestazioni del sito e ridurre il consumo di larghezza di banda.'
    );
    $save_text = jdd_text('Save Changes', 'Salva Modifiche');
    ?>
    <div class="wrap jdd-theme-options">
        <h1><?php echo $title; ?></h1>
        <hr>
        <p><?php echo $subtitle; ?></p>
        <hr>
        <form method="post" action="options.php">
            <?php settings_fields('jdd_theme_options_performance'); ?>
            <?php do_settings_sections('jdd_theme_options_performance'); ?>
            <table class="form-table jdd-form-table">
                <tr>
                    <th><label for="jdd_disable_gutenberg"><?php echo $disable_gutenberg_label; ?></label></th>
                    <td class="td-back-flex">
                        <input type="checkbox" name="jdd_disable_gutenberg" id="jdd_disable_gutenberg" value="1" <?php checked(1, get_option('jdd_disable_gutenberg'), true); ?> />
                        <p class="description description-functions"><?php echo $disable_gutenberg_desc; ?></p>
                    </td>
                </tr>
                <tr>
                    <th><label for="jdd_disable_comments"><?php echo $disable_comments_label; ?></label></th>
                    <td class="td-back-flex">
                        <input type="checkbox" name="jdd_disable_comments" id="jdd_disable_comments" value="1" <?php checked(1, get_option('jdd_disable_comments'), true); ?> />
                        <p class="description description-functions"><?php echo $disable_comments_desc; ?></p>
                    </td>
                </tr>
                <tr>
                    <th><label for="jdd_enable_image_size_limit"><?php echo $image_limit_label; ?></label></th>
                    <td class="td-back-flex">
                        <input type="checkbox" name="jdd_enable_image_size_limit" id="jdd_enable_image_size_limit" value="1" <?php checked(1, get_option('jdd_enable_image_size_limit'), true); ?> />
                        <p class="description description-functions"><?php echo $image_limit_desc; ?></p>
                    </td>
                </tr>
            </table>
            <?php submit_button($save_text); ?>
        </form>
    </div>
    <?php
}


// --- 9. THIRD PARTY RENDER PAGE ---

function jdd_render_third_party_page() {
    $title = jdd_text('Third Party', 'Terze Parti');
    $subtitle = jdd_text(
        'Style and optimization of third-party plugins ⚡️',
        'Stile e ottimizzazione di plugin terzi ⚡️'
    );
    $admin_style_acpt_label = jdd_text('Admin Style ACPT', 'Stile Admin ACPT');
    $admin_style_acpt_desc = jdd_text(
        '✨ Enhance the administrative interface for Advanced Custom Post Types with more elegant styles and an optimized UX.',
        '✨ Migliora l\'interfaccia amministrativa per Advanced Custom Post Types con stili più eleganti e una UX ottimizzata.'
    );
    $save_text = jdd_text('Save Changes', 'Salva Modifiche');
    ?>
    <div class="wrap jdd-theme-options">
        <h1><?php echo $title; ?></h1>
        <hr>
        <p><?php echo $subtitle; ?></p>
        <hr>
        <form method="post" action="options.php">
            <?php settings_fields('jdd_theme_options_third_party'); ?>
            <?php do_settings_sections('jdd_theme_options_third_party'); ?>
            <table class="form-table jdd-form-table">
                <tr>
                    <th><label for="jdd_enable_admin_style_acpt"><?php echo $admin_style_acpt_label; ?></label></th>
                    <td class="td-back-flex">
                        <input type="checkbox" name="jdd_enable_admin_style_acpt" id="jdd_enable_admin_style_acpt" value="1" <?php checked(1, get_option('jdd_enable_admin_style_acpt'), true); ?> />
                        <p class="description description-functions"><?php echo $admin_style_acpt_desc; ?></p>
                    </td>
                </tr>
            </table>
            <?php submit_button($save_text); ?>
        </form>
    </div>
    <?php
}
?>
