<?php

/* AcmebsceneBundle:Default:index.html.twig */
class __TwigTemplate_2db539fb487a8782be5e0d3194b1513241a2b17a21f12b50152f72341d960399 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        try {
            $this->parent = $this->env->loadTemplate("base.html.twig");
        } catch (Twig_Error_Loader $e) {
            $e->setTemplateFile($this->getTemplateName());
            $e->setTemplateLine(1);

            throw $e;
        }

        $this->blocks = array(
            'stylesheets' => array($this, 'block_stylesheets'),
            'nav' => array($this, 'block_nav'),
            'header' => array($this, 'block_header'),
            'body' => array($this, 'block_body'),
            'javascripts' => array($this, 'block_javascripts'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_stylesheets($context, array $blocks = array())
    {
        echo "\t
";
    }

    // line 4
    public function block_nav($context, array $blocks = array())
    {
    }

    // line 7
    public function block_header($context, array $blocks = array())
    {
        // line 8
        echo "     <header class=\"jumbotron hero-spacer\">
                    <h1>Welcome to B-Scene!</h1>
                    <p>B-Scene is a hub for industry professionals events and workshops. You can create an account to publish your own or your organization events. You can search for events, add them to your calender and share them on your social websites.</p>
                    <p><a class=\"btn btn-warning btn-large\">Learn More</a>
                    </p>
     </header>               
";
    }

    // line 15
    public function block_body($context, array $blocks = array())
    {
        // line 16
        if (array_key_exists("errormessage", $context)) {
            // line 17
            echo "<div class=\"alert-info fade in\">
    
    <strong>";
            // line 19
            echo twig_escape_filter($this->env, (isset($context["errormessage"]) ? $context["errormessage"] : $this->getContext($context, "errormessage")), "html", null, true);
            echo "</strong>
</div>
";
        }
        // line 22
        echo "
";
    }

    // line 24
    public function block_javascripts($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "AcmebsceneBundle:Default:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  85 => 24,  80 => 22,  74 => 19,  70 => 17,  68 => 16,  65 => 15,  55 => 8,  52 => 7,  47 => 4,  40 => 2,  11 => 1,);
    }
}
