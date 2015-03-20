<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appDevUrlMatcher
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appDevUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    /**
     * Constructor.
     */
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($pathinfo);
        $context = $this->context;
        $request = $this->request;

        if (0 === strpos($pathinfo, '/_')) {
            // _wdt
            if (0 === strpos($pathinfo, '/_wdt') && preg_match('#^/_wdt/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => '_wdt')), array (  '_controller' => 'web_profiler.controller.profiler:toolbarAction',));
            }

            if (0 === strpos($pathinfo, '/_profiler')) {
                // _profiler_home
                if (rtrim($pathinfo, '/') === '/_profiler') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', '_profiler_home');
                    }

                    return array (  '_controller' => 'web_profiler.controller.profiler:homeAction',  '_route' => '_profiler_home',);
                }

                if (0 === strpos($pathinfo, '/_profiler/search')) {
                    // _profiler_search
                    if ($pathinfo === '/_profiler/search') {
                        return array (  '_controller' => 'web_profiler.controller.profiler:searchAction',  '_route' => '_profiler_search',);
                    }

                    // _profiler_search_bar
                    if ($pathinfo === '/_profiler/search_bar') {
                        return array (  '_controller' => 'web_profiler.controller.profiler:searchBarAction',  '_route' => '_profiler_search_bar',);
                    }

                }

                // _profiler_purge
                if ($pathinfo === '/_profiler/purge') {
                    return array (  '_controller' => 'web_profiler.controller.profiler:purgeAction',  '_route' => '_profiler_purge',);
                }

                // _profiler_info
                if (0 === strpos($pathinfo, '/_profiler/info') && preg_match('#^/_profiler/info/(?P<about>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_info')), array (  '_controller' => 'web_profiler.controller.profiler:infoAction',));
                }

                // _profiler_phpinfo
                if ($pathinfo === '/_profiler/phpinfo') {
                    return array (  '_controller' => 'web_profiler.controller.profiler:phpinfoAction',  '_route' => '_profiler_phpinfo',);
                }

                // _profiler_search_results
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/search/results$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_search_results')), array (  '_controller' => 'web_profiler.controller.profiler:searchResultsAction',));
                }

                // _profiler
                if (preg_match('#^/_profiler/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler')), array (  '_controller' => 'web_profiler.controller.profiler:panelAction',));
                }

                // _profiler_router
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/router$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_router')), array (  '_controller' => 'web_profiler.controller.router:panelAction',));
                }

                // _profiler_exception
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/exception$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_exception')), array (  '_controller' => 'web_profiler.controller.exception:showAction',));
                }

                // _profiler_exception_css
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/exception\\.css$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_exception_css')), array (  '_controller' => 'web_profiler.controller.exception:cssAction',));
                }

            }

            if (0 === strpos($pathinfo, '/_configurator')) {
                // _configurator_home
                if (rtrim($pathinfo, '/') === '/_configurator') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', '_configurator_home');
                    }

                    return array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::checkAction',  '_route' => '_configurator_home',);
                }

                // _configurator_step
                if (0 === strpos($pathinfo, '/_configurator/step') && preg_match('#^/_configurator/step/(?P<index>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_configurator_step')), array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::stepAction',));
                }

                // _configurator_final
                if ($pathinfo === '/_configurator/final') {
                    return array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::finalAction',  '_route' => '_configurator_final',);
                }

            }

            // _twig_error_test
            if (0 === strpos($pathinfo, '/_error') && preg_match('#^/_error/(?P<code>\\d+)(?:\\.(?P<_format>[^/]++))?$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => '_twig_error_test')), array (  '_controller' => 'twig.controller.preview_error:previewErrorPageAction',  '_format' => 'html',));
            }

        }

        if (0 === strpos($pathinfo, '/meeting')) {
            // meeting
            if (rtrim($pathinfo, '/') === '/meeting') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'meeting');
                }

                return array (  '_controller' => 'Acme\\bsceneBundle\\Controller\\MeetingController::indexAction',  '_route' => 'meeting',);
            }

            // meeting_show
            if (preg_match('#^/meeting/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'meeting_show')), array (  '_controller' => 'Acme\\bsceneBundle\\Controller\\MeetingController::showAction',));
            }

            // meeting_new
            if ($pathinfo === '/meeting/new') {
                return array (  '_controller' => 'Acme\\bsceneBundle\\Controller\\MeetingController::newAction',  '_route' => 'meeting_new',);
            }

            // meeting_create
            if ($pathinfo === '/meeting/create') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_meeting_create;
                }

                return array (  '_controller' => 'Acme\\bsceneBundle\\Controller\\MeetingController::createAction',  '_route' => 'meeting_create',);
            }
            not_meeting_create:

            // meeting_edit
            if (preg_match('#^/meeting/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'meeting_edit')), array (  '_controller' => 'Acme\\bsceneBundle\\Controller\\MeetingController::editAction',));
            }

            // meeting_update
            if (preg_match('#^/meeting/(?P<id>[^/]++)/update$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('POST', 'PUT'))) {
                    $allow = array_merge($allow, array('POST', 'PUT'));
                    goto not_meeting_update;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'meeting_update')), array (  '_controller' => 'Acme\\bsceneBundle\\Controller\\MeetingController::updateAction',));
            }
            not_meeting_update:

            // meeting_delete
            if (preg_match('#^/meeting/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('POST', 'DELETE'))) {
                    $allow = array_merge($allow, array('POST', 'DELETE'));
                    goto not_meeting_delete;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'meeting_delete')), array (  '_controller' => 'Acme\\bsceneBundle\\Controller\\MeetingController::deleteAction',));
            }
            not_meeting_delete:

        }

        if (0 === strpos($pathinfo, '/organization')) {
            // organization
            if (rtrim($pathinfo, '/') === '/organization') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'organization');
                }

                return array (  '_controller' => 'Acme\\bsceneBundle\\Controller\\OrganizationController::indexAction',  '_route' => 'organization',);
            }

            // organization_show
            if (preg_match('#^/organization/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'organization_show')), array (  '_controller' => 'Acme\\bsceneBundle\\Controller\\OrganizationController::showAction',));
            }

            // organization_new
            if ($pathinfo === '/organization/new') {
                return array (  '_controller' => 'Acme\\bsceneBundle\\Controller\\OrganizationController::newAction',  '_route' => 'organization_new',);
            }

            // organization_create
            if ($pathinfo === '/organization/create') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_organization_create;
                }

                return array (  '_controller' => 'Acme\\bsceneBundle\\Controller\\OrganizationController::createAction',  '_route' => 'organization_create',);
            }
            not_organization_create:

            // organization_edit
            if (preg_match('#^/organization/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'organization_edit')), array (  '_controller' => 'Acme\\bsceneBundle\\Controller\\OrganizationController::editAction',));
            }

            // organization_update
            if (preg_match('#^/organization/(?P<id>[^/]++)/update$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('POST', 'PUT'))) {
                    $allow = array_merge($allow, array('POST', 'PUT'));
                    goto not_organization_update;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'organization_update')), array (  '_controller' => 'Acme\\bsceneBundle\\Controller\\OrganizationController::updateAction',));
            }
            not_organization_update:

            // organization_delete
            if (preg_match('#^/organization/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('POST', 'DELETE'))) {
                    $allow = array_merge($allow, array('POST', 'DELETE'));
                    goto not_organization_delete;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'organization_delete')), array (  '_controller' => 'Acme\\bsceneBundle\\Controller\\OrganizationController::deleteAction',));
            }
            not_organization_delete:

        }

        if (0 === strpos($pathinfo, '/category')) {
            // category
            if (rtrim($pathinfo, '/') === '/category') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'category');
                }

                return array (  '_controller' => 'Acme\\bsceneBundle\\Controller\\CategoriesController::indexAction',  '_route' => 'category',);
            }

            // category_show
            if (preg_match('#^/category/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'category_show')), array (  '_controller' => 'Acme\\bsceneBundle\\Controller\\CategoriesController::showAction',));
            }

            // category_new
            if ($pathinfo === '/category/new') {
                return array (  '_controller' => 'Acme\\bsceneBundle\\Controller\\CategoriesController::newAction',  '_route' => 'category_new',);
            }

            // category_create
            if ($pathinfo === '/category/create') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_category_create;
                }

                return array (  '_controller' => 'Acme\\bsceneBundle\\Controller\\CategoriesController::createAction',  '_route' => 'category_create',);
            }
            not_category_create:

            // category_edit
            if (preg_match('#^/category/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'category_edit')), array (  '_controller' => 'Acme\\bsceneBundle\\Controller\\CategoriesController::editAction',));
            }

            // category_update
            if (preg_match('#^/category/(?P<id>[^/]++)/update$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('POST', 'PUT'))) {
                    $allow = array_merge($allow, array('POST', 'PUT'));
                    goto not_category_update;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'category_update')), array (  '_controller' => 'Acme\\bsceneBundle\\Controller\\CategoriesController::updateAction',));
            }
            not_category_update:

            // category_delete
            if (preg_match('#^/category/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('POST', 'DELETE'))) {
                    $allow = array_merge($allow, array('POST', 'DELETE'));
                    goto not_category_delete;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'category_delete')), array (  '_controller' => 'Acme\\bsceneBundle\\Controller\\CategoriesController::deleteAction',));
            }
            not_category_delete:

        }

        if (0 === strpos($pathinfo, '/account')) {
            // account
            if (rtrim($pathinfo, '/') === '/account') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'account');
                }

                return array (  '_controller' => 'Acme\\bsceneBundle\\Controller\\AccountController::indexAction',  '_route' => 'account',);
            }

            // account_show
            if (preg_match('#^/account/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'account_show')), array (  '_controller' => 'Acme\\bsceneBundle\\Controller\\AccountController::showAction',));
            }

            // account_new
            if ($pathinfo === '/account/new') {
                return array (  '_controller' => 'Acme\\bsceneBundle\\Controller\\AccountController::newAction',  '_route' => 'account_new',);
            }

            // account_create
            if ($pathinfo === '/account/create') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_account_create;
                }

                return array (  '_controller' => 'Acme\\bsceneBundle\\Controller\\AccountController::createAction',  '_route' => 'account_create',);
            }
            not_account_create:

            // account_edit
            if (preg_match('#^/account/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'account_edit')), array (  '_controller' => 'Acme\\bsceneBundle\\Controller\\AccountController::editAction',));
            }

            // account_update
            if (preg_match('#^/account/(?P<id>[^/]++)/update$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('POST', 'PUT'))) {
                    $allow = array_merge($allow, array('POST', 'PUT'));
                    goto not_account_update;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'account_update')), array (  '_controller' => 'Acme\\bsceneBundle\\Controller\\AccountController::updateAction',));
            }
            not_account_update:

            // account_delete
            if (preg_match('#^/account/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('POST', 'DELETE'))) {
                    $allow = array_merge($allow, array('POST', 'DELETE'));
                    goto not_account_delete;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'account_delete')), array (  '_controller' => 'Acme\\bsceneBundle\\Controller\\AccountController::deleteAction',));
            }
            not_account_delete:

        }

        // acmebscene_homepage
        if (0 === strpos($pathinfo, '/hello') && preg_match('#^/hello/(?P<name>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'acmebscene_homepage')), array (  '_controller' => 'Acme\\bsceneBundle\\Controller\\DefaultController::indexAction',));
        }

        if (0 === strpos($pathinfo, '/admin')) {
            // acmebscene_dashboard
            if ($pathinfo === '/admin') {
                return array (  '_controller' => 'Acme\\bsceneBundle\\Controller\\AdminController::indexAction',  '_route' => 'acmebscene_dashboard',);
            }

            // acmebscene_adminComment
            if ($pathinfo === '/admin/comment') {
                return array (  '_controller' => 'Acme\\bsceneBundle\\Controller\\CommentController::adminIndexAction',  '_route' => 'acmebscene_adminComment',);
            }

            // acmebscene_adminOrganization
            if ($pathinfo === '/admin/organization') {
                return array (  '_controller' => 'Acme\\bsceneBundle\\Controller\\OrganizationController::adminIndexAction',  '_route' => 'acmebscene_adminOrganization',);
            }

        }

        // acmebscene_login
        if (rtrim($pathinfo, '/') === '') {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'acmebscene_login');
            }

            return array (  '_controller' => 'Acme\\bsceneBundle\\Controller\\DefaultController::loginAction',  '_route' => 'acmebscene_login',);
        }

        // homepage
        if ($pathinfo === '/app/example') {
            return array (  '_controller' => 'AppBundle\\Controller\\DefaultController::indexAction',  '_route' => 'homepage',);
        }

        // _welcome
        if (rtrim($pathinfo, '/') === '') {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', '_welcome');
            }

            return array (  '_controller' => 'Acme\\DemoBundle\\Controller\\WelcomeController::indexAction',  '_route' => '_welcome',);
        }

        if (0 === strpos($pathinfo, '/demo')) {
            if (0 === strpos($pathinfo, '/demo/secured')) {
                if (0 === strpos($pathinfo, '/demo/secured/log')) {
                    if (0 === strpos($pathinfo, '/demo/secured/login')) {
                        // _demo_login
                        if ($pathinfo === '/demo/secured/login') {
                            return array (  '_controller' => 'Acme\\DemoBundle\\Controller\\SecuredController::loginAction',  '_route' => '_demo_login',);
                        }

                        // _demo_security_check
                        if ($pathinfo === '/demo/secured/login_check') {
                            return array (  '_controller' => 'Acme\\DemoBundle\\Controller\\SecuredController::securityCheckAction',  '_route' => '_demo_security_check',);
                        }

                    }

                    // _demo_logout
                    if ($pathinfo === '/demo/secured/logout') {
                        return array (  '_controller' => 'Acme\\DemoBundle\\Controller\\SecuredController::logoutAction',  '_route' => '_demo_logout',);
                    }

                }

                if (0 === strpos($pathinfo, '/demo/secured/hello')) {
                    // acme_demo_secured_hello
                    if ($pathinfo === '/demo/secured/hello') {
                        return array (  'name' => 'World',  '_controller' => 'Acme\\DemoBundle\\Controller\\SecuredController::helloAction',  '_route' => 'acme_demo_secured_hello',);
                    }

                    // _demo_secured_hello
                    if (preg_match('#^/demo/secured/hello/(?P<name>[^/]++)$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => '_demo_secured_hello')), array (  '_controller' => 'Acme\\DemoBundle\\Controller\\SecuredController::helloAction',));
                    }

                    // _demo_secured_hello_admin
                    if (0 === strpos($pathinfo, '/demo/secured/hello/admin') && preg_match('#^/demo/secured/hello/admin/(?P<name>[^/]++)$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => '_demo_secured_hello_admin')), array (  '_controller' => 'Acme\\DemoBundle\\Controller\\SecuredController::helloadminAction',));
                    }

                }

            }

            // _demo
            if (rtrim($pathinfo, '/') === '/demo') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', '_demo');
                }

                return array (  '_controller' => 'Acme\\DemoBundle\\Controller\\DemoController::indexAction',  '_route' => '_demo',);
            }

            // _demo_hello
            if (0 === strpos($pathinfo, '/demo/hello') && preg_match('#^/demo/hello/(?P<name>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => '_demo_hello')), array (  '_controller' => 'Acme\\DemoBundle\\Controller\\DemoController::helloAction',));
            }

            // _demo_contact
            if ($pathinfo === '/demo/contact') {
                return array (  '_controller' => 'Acme\\DemoBundle\\Controller\\DemoController::contactAction',  '_route' => '_demo_contact',);
            }

        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
