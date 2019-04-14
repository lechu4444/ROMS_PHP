<?php

namespace App\Http\View\Composers;


use Illuminate\Support\Facades\Config;
use Illuminate\View\View;

class BreadcrumbsComposer
{
    public function compose(View $view)
    {
        $routesDetail = Config::get('constants.routes_detail');
        $routeObject = request()->route();
        $routeName = $routeObject->action['as'];
        $routeParameters = $routeObject->parameters();

        $prevPages = $routesDetail[$routeName]['prev_pages'];
        $breadcrumbs = [];

        foreach ($prevPages as $i => $route) {
            $breadcrumbs[$i]['route'] = $route;
            $breadcrumbs[$i]['routeParameters'] = [];
            $breadcrumbs[$i]['label'] = $routesDetail[$route]['title'];
            $breadcrumbs[$i]['active'] = false;
        }

        $breadcrumbs[] = [
            'route' => $routeName,
            'routeParameters' => $routeParameters,
            'label' => $routesDetail[$routeName]['title'],
            'active' => true
        ];

        $view->with('pageTitle', 'ROMS - ' . $routesDetail[$routeName]['title']);
        $view->with('pageHeader', $routesDetail[$routeName]['title']);
        $view->with('breadcrumbs', $breadcrumbs);
    }
}
