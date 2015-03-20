<?php

/* ::base.html.twig */
class __TwigTemplate_c148f170a109b3e5e99556d1317904d8b5f76e6c64620e67840ab09168a32df2 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'stylesheets' => array($this, 'block_stylesheets'),
            'nav' => array($this, 'block_nav'),
            'javascripts' => array($this, 'block_javascripts'),
            'header' => array($this, 'block_header'),
            'body' => array($this, 'block_body'),
            'footer' => array($this, 'block_footer'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html>
    <head>
        <meta charset=\"UTF-8\" />
        <title>";
        // line 5
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
       
            <link href=\"";
        // line 7
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/acmebscene/css/bootstrap.min.css"), "html", null, true);
        echo "\" rel=\"stylesheet\">
            <!-- Custom CSS -->
            <link href=\"";
        // line 9
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/acmebscene/css/bscene.css"), "html", null, true);
        echo "\" rel=\"stylesheet\">
        ";
        // line 10
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 12
        echo "        <link rel=\"icon\" type=\"image/x-icon\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("favicon.ico"), "html", null, true);
        echo "\" />
    </head>
    <body>
        
            <!-- Navigation -->
            <nav class=\"navbar navbar-inverse navbar-fixed-top\" role=\"navigation\">
                <div class=\"container\">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class=\"navbar-header\">
                        <button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\"#bs-example-navbar-collapse-1\">
                            <span class=\"sr-only\">Toggle navigation</span>
                            <span class=\"icon-bar\"></span>
                            <span class=\"icon-bar\"></span>
                            <span class=\"icon-bar\"></span>
                        </button>
                        <a class=\"navbar-brand\" href=\"#\"> B-Scene</a>
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class=\"collapse navbar-collapse\" id=\"bs-example-navbar-collapse-1\">
                        <ul class=\"nav navbar-nav\">
                            <li>
                                <a href=\"#\">About</a>
                            </li>
                            <li>
                                <a href=\"#\">Services</a>
                            </li>
                            <li>
                                <a href=\"#\">Contact</a>
                            </li>
                        </ul>
                        <form class=\"navbar-form navbar-left\" role=\"search\">
                            <div class=\"form-group\">
                                <input class=\"form-control\" type=\"text\" />
                            </div> 
                            <button type=\"button\" class=\"btn btn-default\" onclick=\"'#'\">Search</button>
                        </form>
                        <ul class=\"nav navbar-nav navbar-right\">
                            ";
        // line 49
        if (($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "session", array()), "get", array(0 => "admin"), "method") != null)) {
            // line 50
            echo "                                <li>
                                           <a href=\"";
            // line 51
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("acmebscene_dashboard", array("lastLogin" => twig_date_format_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "session", array()), "get", array(0 => "lastLogin"), "method"), "Y-m-d\\TH:i:sP"))), "html", null, true);
            echo "\">Dashboard</a>
                                </li>
                            ";
        }
        // line 53
        echo " 
                            ";
        // line 54
        if (($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "session", array()), "get", array(0 => "member"), "method") != null)) {
            // line 55
            echo "                                
                                 <li class=\"dropdown\">
                                           <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\"><i class=\"fa fa-user\"></i> Welcome ";
            // line 57
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "session", array()), "get", array(0 => "member"), "method"), "html", null, true);
            echo " <b class=\"caret\"></b></a>
                                           <ul class=\"dropdown-menu\">
                                               <li>
                                                   <a href=\"profile.html\"><i class=\"fa fa-fw fa-user\"></i> Profile</a>
                                               </li>

                                               <li>
                                                   <a href=\"createEvent.html\"><i class=\"fa fa-fw fa-gear\"></i> Post Event</a>
                                               </li>
                                               <li class=\"divider\"></li>
                                               <li>
                                                   <a href=\"index.html\"><i class=\"fa fa-fw fa-power-off\"></i> Log Out</a>
                                               </li>
                                          </ul>
                                  </li>
                            ";
        } else {
            // line 73
            echo "                            
                                    <li>
                                        <a class=\"login-window\" href=\"#login-box\">Login</a>
                                    </li>
                                    <li>
                                        <a href=\"#\">Sign up</a>
                                    </li>
                            ";
        }
        // line 81
        echo "                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
                    ";
        // line 84
        $this->displayBlock('nav', $context, $blocks);
        // line 86
        echo "                </div>
                <!-- /.container -->
            </nav>
            
            
                <script src=\"";
        // line 91
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/acmebscene/js/jquery.js"), "html", null, true);
        echo "\"></script>
                <!-- Bootstrap Core JavaScript -->
                <script src=\"";
        // line 93
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/acmebscene/js/bootstrap.min.js"), "html", null, true);
        echo "\"></script>
                ";
        // line 94
        $this->displayBlock('javascripts', $context, $blocks);
        // line 99
        echo "                <div id=\"login-box\" class=\"login-popup\">
                    <script type=\"text/javascript\">
                                \$(document).ready(function () {
                                    \$('a.login-window').click(function () {

                                        //Getting the variable's value from a link 
                                        var loginBox = \$(this).attr('href');

                                        //Fade in the Popup
                                        \$(loginBox).fadeIn(300);

                                        //Set the center alignment padding + border see css style
                                        var popMargTop = (\$(loginBox).height() + 24) / 2;
                                        var popMargLeft = (\$(loginBox).width() + 24) / 2;

                                        \$(loginBox).css({
                                            'margin-top': -popMargTop,
                                            'margin-left': -popMargLeft
                                        });

                                        // Add the mask to body
                                        \$('body').append('<div id=\"mask\"></div>');
                                        \$('#mask').fadeIn(300);

                                        return false;
                                    });

                                    // When clicking on the button close or the mask layer the popup closed
                                    \$('a.close, #mask').on('click', function () {
                                        \$('#mask , .login-popup').fadeOut(300, function () {
                                            \$('#mask').remove();
                                        });
                                        return false;
                                    });
                                });
                    </script>
                
                <a href=\"#\" class=\"close\"><img src=\"";
        // line 136
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/acmebscene/images/close_pop.png"), "html", null, true);
        echo "\" class=\"btn_close\" title=\"Close Window\" alt=\"Close\" /></a>
                <form  class=\"signin\" method=\"POST\" action=\"";
        // line 137
        echo $this->env->getExtension('routing')->getPath("acmebscene_login");
        echo "\">
                    
                    
                    <fieldset class=\"textbox\">
                        <label class=\"username\">
                            <span>Username or email</span>
                            <input id=\"username\" name=\"username\" value=\"\" type=\"text\" autocomplete=\"on\" placeholder=\"Username\">
                        </label>
                        <label class=\"password\">
                            <span>Password</span>
                            <input id=\"password\" name=\"password\" value=\"\" type=\"password\" placeholder=\"Password\">
                        </label>
                        <button class=\"button\" type=\"submit\">Sign in</button>
                        <p>
                            <a class=\"forgot\" href=\"forgetPassword.html\">Forgot your password?</a>
                        </p>        
                    </fieldset>
                </form>
            </div>
             <!-- Page Content -->
            <div class=\"container\">
                ";
        // line 158
        $this->displayBlock('header', $context, $blocks);
        // line 161
        echo "                 

                <div>
                     ";
        // line 164
        $this->displayBlock('body', $context, $blocks);
        // line 167
        echo "                </div>
                
                <!-- Footer -->
                <footer>
                    <div class=\"row\">
                        <div class=\"col-lg-12\">
                            <p>Copyright &copy; B-Scene 2015</p>
                        </div>
                    </div>
                    ";
        // line 176
        $this->displayBlock('footer', $context, $blocks);
        // line 179
        echo "                </footer>

            </div>
            
        
    </body>
</html>
";
    }

    // line 5
    public function block_title($context, array $blocks = array())
    {
        echo "B-Scene";
    }

    // line 10
    public function block_stylesheets($context, array $blocks = array())
    {
        echo "\t
        ";
    }

    // line 84
    public function block_nav($context, array $blocks = array())
    {
        // line 85
        echo "                    ";
    }

    // line 94
    public function block_javascripts($context, array $blocks = array())
    {
        // line 95
        echo "                    
                    
                    
                ";
    }

    // line 158
    public function block_header($context, array $blocks = array())
    {
        // line 159
        echo "                       
                 ";
    }

    // line 164
    public function block_body($context, array $blocks = array())
    {
        // line 165
        echo "                       
                     ";
    }

    // line 176
    public function block_footer($context, array $blocks = array())
    {
        // line 177
        echo "                       
                    ";
    }

    public function getTemplateName()
    {
        return "::base.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  312 => 177,  309 => 176,  304 => 165,  301 => 164,  296 => 159,  293 => 158,  286 => 95,  283 => 94,  279 => 85,  276 => 84,  269 => 10,  263 => 5,  252 => 179,  250 => 176,  239 => 167,  237 => 164,  232 => 161,  230 => 158,  206 => 137,  202 => 136,  163 => 99,  161 => 94,  157 => 93,  152 => 91,  145 => 86,  143 => 84,  138 => 81,  128 => 73,  109 => 57,  105 => 55,  103 => 54,  100 => 53,  94 => 51,  91 => 50,  89 => 49,  48 => 12,  46 => 10,  42 => 9,  37 => 7,  32 => 5,  26 => 1,);
    }
}
