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
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/blog(?'
                    .'|(?:/([^/]++))?(*:29)'
                    .'|/blog/([^/]++)(*:50)'
                .')'
                .'|/login(?:/([a-zA-Z]+))?(*:81)'
                .'|/_(?'
                    .'|error/(\\d+)(?:\\.([^/]++))?(*:119)'
                    .'|wdt/([^/]++)(*:139)'
                    .'|profiler/([^/]++)(?'
                        .'|/(?'
                            .'|search/results(*:185)'
                            .'|router(*:199)'
                            .'|exception(?'
                                .'|(*:219)'
                                .'|\\.css(*:232)'
                            .')'
                        .')'
                        .'|(*:242)'
                    .')'
                .')'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        29 => [[['_route' => 'blog_index', 'name' => 'index', '_controller' => 'App\\Controller\\BlogController::index'], ['name'], ['GET' => 0], null, false, true, null]],
        50 => [[['_route' => 'blog_menu', '_controller' => 'App\\Controller\\BlogController::show'], ['nav'], null, null, false, true, null]],
        81 => [[['_route' => 'login_index', 'name' => 'World', '_controller' => 'App\\Controller\\LoginController::index'], ['name'], ['GET' => 0], null, false, true, null]],
        119 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        139 => [[['_route' => '_wdt', '_controller' => 'web_profiler.controller.profiler::toolbarAction'], ['token'], null, null, false, true, null]],
        185 => [[['_route' => '_profiler_search_results', '_controller' => 'web_profiler.controller.profiler::searchResultsAction'], ['token'], null, null, false, false, null]],
        199 => [[['_route' => '_profiler_router', '_controller' => 'web_profiler.controller.router::panelAction'], ['token'], null, null, false, false, null]],
        219 => [[['_route' => '_profiler_exception', '_controller' => 'web_profiler.controller.exception_panel::body'], ['token'], null, null, false, false, null]],
        232 => [[['_route' => '_profiler_exception_css', '_controller' => 'web_profiler.controller.exception_panel::stylesheet'], ['token'], null, null, false, false, null]],
        242 => [
            [['_route' => '_profiler', '_controller' => 'web_profiler.controller.profiler::panelAction'], ['token'], null, null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
