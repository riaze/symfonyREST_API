<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/_profiler' => [[['_route' => '_profiler_home', '_controller' => 'web_profiler.controller.profiler::homeAction'], null, null, null, true, false, null]],
        '/_profiler/search' => [[['_route' => '_profiler_search', '_controller' => 'web_profiler.controller.profiler::searchAction'], null, null, null, false, false, null]],
        '/_profiler/search_bar' => [[['_route' => '_profiler_search_bar', '_controller' => 'web_profiler.controller.profiler::searchBarAction'], null, null, null, false, false, null]],
        '/_profiler/phpinfo' => [[['_route' => '_profiler_phpinfo', '_controller' => 'web_profiler.controller.profiler::phpinfoAction'], null, null, null, false, false, null]],
        '/_profiler/open' => [[['_route' => '_profiler_open_file', '_controller' => 'web_profiler.controller.profiler::openAction'], null, null, null, false, false, null]],
        '/api/articles' => [[['_route' => 'app_article_getarticle', '_controller' => 'App\\Controller\\ArticleController::getArticleAction'], null, ['GET' => 0], null, false, false, null]],
        '/api/article' => [[['_route' => 'app_article_postarticle', '_controller' => 'App\\Controller\\ArticleController::postArticleAction'], null, ['POST' => 0], null, false, false, null]],
        '/db' => [[['_route' => 'db', '_controller' => 'App\\Controller\\DbController::index'], null, null, null, false, false, null]],
        '/postttt' => [[['_route' => 'post', '_controller' => 'App\\Controller\\DbController::Lists'], null, null, null, false, false, null]],
        '/count' => [[['_route' => 'count', '_controller' => 'App\\Controller\\DbController::Home'], null, null, null, false, false, null]],
        '/test' => [[['_route' => 'test', '_controller' => 'App\\Controller\\DbController::test'], null, null, null, false, false, null]],
        '/api/lists' => [
            [['_route' => 'get_lists', '_controller' => 'App\\Controller\\TestController::getListsAction', '_format' => 'json'], null, ['GET' => 0], null, false, false, null],
            [['_route' => 'post_lists', '_controller' => 'App\\Controller\\TestController::postListsAction', '_format' => 'json'], null, ['POST' => 0], null, false, false, null],
            [['_route' => 'put_lists', '_controller' => 'App\\Controller\\TestController::putListsAction', '_format' => 'json'], null, ['PUT' => 0], null, false, false, null],
        ],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_(?'
                    .'|error/(\\d+)(?:\\.([^/]++))?(*:38)'
                    .'|wdt/([^/]++)(*:57)'
                    .'|profiler/([^/]++)(?'
                        .'|/(?'
                            .'|search/results(*:102)'
                            .'|router(*:116)'
                            .'|exception(?'
                                .'|(*:136)'
                                .'|\\.css(*:149)'
                            .')'
                        .')'
                        .'|(*:159)'
                    .')'
                .')'
                .'|/curl/([^/]++)(*:183)'
                .'|/api/lists/([^/]++)(?'
                    .'|/(?'
                        .'|background(*:227)'
                        .'|task(*:239)'
                    .')'
                    .'|(*:248)'
                .')'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        38 => [[['_route' => '_twig_error_test', '_controller' => 'twig.controller.preview_error::previewErrorPageAction', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        57 => [[['_route' => '_wdt', '_controller' => 'web_profiler.controller.profiler::toolbarAction'], ['token'], null, null, false, true, null]],
        102 => [[['_route' => '_profiler_search_results', '_controller' => 'web_profiler.controller.profiler::searchResultsAction'], ['token'], null, null, false, false, null]],
        116 => [[['_route' => '_profiler_router', '_controller' => 'web_profiler.controller.router::panelAction'], ['token'], null, null, false, false, null]],
        136 => [[['_route' => '_profiler_exception', '_controller' => 'web_profiler.controller.exception::showAction'], ['token'], null, null, false, false, null]],
        149 => [[['_route' => '_profiler_exception_css', '_controller' => 'web_profiler.controller.exception::cssAction'], ['token'], null, null, false, false, null]],
        159 => [[['_route' => '_profiler', '_controller' => 'web_profiler.controller.profiler::panelAction'], ['token'], null, null, false, true, null]],
        183 => [[['_route' => 'curl', '_controller' => 'App\\Controller\\DbController::curlPost'], ['title'], null, null, false, true, null]],
        227 => [[['_route' => 'background_list', '_controller' => 'App\\Controller\\TestController::backgroundListAction', '_format' => 'json'], ['id'], ['PATCH' => 0], null, false, false, null]],
        239 => [[['_route' => 'get_lists_task', '_controller' => 'App\\Controller\\TestController::getListsTaskAction', '_format' => 'json'], ['id'], ['GET' => 0], null, false, false, null]],
        248 => [
            [['_route' => 'get_list', '_controller' => 'App\\Controller\\TestController::getListAction', '_format' => 'json'], ['id'], ['GET' => 0], null, false, true, null],
            [['_route' => 'patch_lists', '_controller' => 'App\\Controller\\TestController::patchListsAction', '_format' => 'json'], ['id'], ['PATCH' => 0], null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
