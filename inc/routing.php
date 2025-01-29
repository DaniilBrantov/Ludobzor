<?php

class CustomRoutingManager {
    public function __construct() {
        add_action('template_redirect', [$this, 'redirectOldPostTypeUrls']);
        add_action('pre_get_posts', [$this, 'fixAllPostTypesRouting']);
        add_action('template_redirect', [$this, 'custom404Debug']);
        add_action('init', [$this, 'addRewriteRules']);
        add_filter('query_vars', [$this, 'registerQueryVars']);
        add_filter('the_content', [$this, 'replaceUploadToUploadsInImgSrc']);
        register_activation_hook(__FILE__, [$this, 'flushRewriteRulesOnActivation']);
    }

    // Редирект старых URL
    public function redirectOldPostTypeUrls() {
        $requestUri = $_SERVER['REQUEST_URI'];
        $postTypes = get_post_types(['public' => true], 'objects');

        foreach ($postTypes as $postType) {
            if ($postType->name === 'page') {
                continue;
            }

            $slug = $postType->rewrite['slug'] ?? $postType->name;
            if (strpos($requestUri, '/' . $slug . '/') === 0) {
                $postSlug = trim(str_replace('/' . $slug . '/', '', $requestUri), '/');
                $post = get_page_by_path($postSlug, OBJECT, $postType->name);

                if ($post) {
                    $newUrl = home_url('/' . $postSlug . '/');
                    error_log("Redirecting old URL: $requestUri to $newUrl");
                    wp_redirect($newUrl, 301);
                    exit;
                }
            }
        }
    }

    // Исправление маршрутов для всех типов записей
    public function fixAllPostTypesRouting($query) {
        if (!is_admin() && $query->is_main_query() && isset($query->query['name'])) {
            $postTypes = get_post_types(['public' => true], 'names');
            foreach ($postTypes as $postType) {
                if ($postType === 'page') {
                    continue;
                }

                $post = get_page_by_path($query->query['name'], OBJECT, $postType);
                if ($post) {
                    error_log("Post found: {$post->post_title} (Type: $postType)");
                    $query->set('post_type', $postType);
                    break;
                }
            }
        }
    }

    // Отладка ошибок 404
    public function custom404Debug() {
        if (is_404()) {
            error_log('404 triggered for: ' . $_SERVER['REQUEST_URI']);
        }
    }

    // Добавление правил маршрутизации
    public function addRewriteRules() {
        add_rewrite_rule(
            '^otzyvy-([^/]+)/?$',
            'index.php?pagename=reviews&post=$matches[1]',
            'top'
        );

        add_rewrite_rule(
            '^freegames-([^/]+)-([^/]+)/?$',
            'index.php?pagename=freegames&taxonomy=$matches[1]&slug=$matches[2]',
            'top'
        );
    }

    // Регистрация новых переменных запроса
    public function registerQueryVars($vars) {
        $vars[] = 'taxonomy';
        $vars[] = 'slug';
        return $vars;
    }

    // Замена ссылок в контенте
    public function replaceUploadToUploadsInImgSrc($content) {
        $pattern = '/<img[^>]+src="([^"]*\/upload\/[^"]*)"[^>]*>/i';
        return preg_replace_callback($pattern, function ($matches) {
            return str_replace($matches[1], str_replace('/upload/', '/wp-content/uploads/', $matches[1]), $matches[0]);
        }, $content);
    }

    // Сброс правил перезаписи
    public function flushRewriteRulesOnActivation() {
        flush_rewrite_rules();
    }
}

// Инициализация класса
new CustomRoutingManager();
