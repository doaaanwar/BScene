<?php

/* AcmebsceneBundle:Account:index.html.twig */
class __TwigTemplate_91cb67fd588a308cf7638cb83dfb08a6f69f13dc0c4f7c71a42d9cba733cacb9 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        try {
            $this->parent = $this->env->loadTemplate("::base.html.twig");
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
        );
    }

    protected function doGetParent(array $context)
    {
        return "::base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_stylesheets($context, array $blocks = array())
    {
        echo "\t
    <link href=\"";
        // line 4
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/acmebscene/css/account.css"), "html", null, true);
        echo "\" rel=\"stylesheet\">
";
    }

    // line 6
    public function block_nav($context, array $blocks = array())
    {
    }

    // line 9
    public function block_header($context, array $blocks = array())
    {
    }

    // line 12
    public function block_body($context, array $blocks = array())
    {
        // line 13
        echo "    <h1>Account list</h1>

    <table class=\"records_list\">
        <thead>
            <tr>
                <th>Id</th>
                <th>Username</th>
                <th>Password</th>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Email</th>
                <th>Backupemail</th>
                <th>Businessphone</th>
                <th>Url</th>
                <th>Address1</th>
                <th>Address2</th>
                <th>Province</th>
                <th>Paymentamount</th>
                <th>Membersince</th>
                <th>Isadmin</th>
                <th>Lastlogin</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        ";
        // line 38
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["entities"]) ? $context["entities"] : $this->getContext($context, "entities")));
        foreach ($context['_seq'] as $context["_key"] => $context["entity"]) {
            // line 39
            echo "            <tr>
                <td><a href=\"";
            // line 40
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("account_show", array("id" => $this->getAttribute($context["entity"], "id", array()))), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute($context["entity"], "id", array()), "html", null, true);
            echo "</a></td>
                <td>";
            // line 41
            echo twig_escape_filter($this->env, $this->getAttribute($context["entity"], "username", array()), "html", null, true);
            echo "</td>
                <td>";
            // line 42
            echo twig_escape_filter($this->env, $this->getAttribute($context["entity"], "password", array()), "html", null, true);
            echo "</td>
                <td>";
            // line 43
            echo twig_escape_filter($this->env, $this->getAttribute($context["entity"], "firstName", array()), "html", null, true);
            echo "</td>
                <td>";
            // line 44
            echo twig_escape_filter($this->env, $this->getAttribute($context["entity"], "lastName", array()), "html", null, true);
            echo "</td>
                <td>";
            // line 45
            echo twig_escape_filter($this->env, $this->getAttribute($context["entity"], "email", array()), "html", null, true);
            echo "</td>
                <td>";
            // line 46
            echo twig_escape_filter($this->env, $this->getAttribute($context["entity"], "backupEmail", array()), "html", null, true);
            echo "</td>
                <td>";
            // line 47
            echo twig_escape_filter($this->env, $this->getAttribute($context["entity"], "businessPhone", array()), "html", null, true);
            echo "</td>
                <td>";
            // line 48
            echo twig_escape_filter($this->env, $this->getAttribute($context["entity"], "url", array()), "html", null, true);
            echo "</td>
                <td>";
            // line 49
            echo twig_escape_filter($this->env, $this->getAttribute($context["entity"], "address1", array()), "html", null, true);
            echo "</td>
                <td>";
            // line 50
            echo twig_escape_filter($this->env, $this->getAttribute($context["entity"], "address2", array()), "html", null, true);
            echo "</td>
                <td>";
            // line 51
            echo twig_escape_filter($this->env, $this->getAttribute($context["entity"], "province", array()), "html", null, true);
            echo "</td>
                <td>";
            // line 52
            echo twig_escape_filter($this->env, $this->getAttribute($context["entity"], "paymentAmount", array()), "html", null, true);
            echo "</td>
                <td>";
            // line 53
            if ($this->getAttribute($context["entity"], "memberSince", array())) {
                echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($context["entity"], "memberSince", array()), "Y-m-d H:i:s"), "html", null, true);
            }
            echo "</td>
                <td>";
            // line 54
            echo twig_escape_filter($this->env, $this->getAttribute($context["entity"], "isAdmin", array()), "html", null, true);
            echo "</td>
                <td>";
            // line 55
            if ($this->getAttribute($context["entity"], "lastLogin", array())) {
                echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($context["entity"], "lastLogin", array()), "Y-m-d H:i:s"), "html", null, true);
            }
            echo "</td>
                <td>
                <ul>
                    <li>
                        <a href=\"";
            // line 59
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("account_show", array("id" => $this->getAttribute($context["entity"], "id", array()))), "html", null, true);
            echo "\">show</a>
                    </li>
                    <li>
                        <a href=\"";
            // line 62
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("account_edit", array("id" => $this->getAttribute($context["entity"], "id", array()))), "html", null, true);
            echo "\">edit</a>
                    </li>
                </ul>
                </td>
            </tr>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['entity'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 68
        echo "        </tbody>
    </table>

        <ul>
        <li>
            <a href=\"";
        // line 73
        echo $this->env->getExtension('routing')->getPath("account_new");
        echo "\">
                Create a new entry
            </a>
        </li>
    </ul>
    ";
    }

    public function getTemplateName()
    {
        return "AcmebsceneBundle:Account:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  195 => 73,  188 => 68,  176 => 62,  170 => 59,  161 => 55,  157 => 54,  151 => 53,  147 => 52,  143 => 51,  139 => 50,  135 => 49,  131 => 48,  127 => 47,  123 => 46,  119 => 45,  115 => 44,  111 => 43,  107 => 42,  103 => 41,  97 => 40,  94 => 39,  90 => 38,  63 => 13,  60 => 12,  55 => 9,  50 => 6,  44 => 4,  39 => 3,  11 => 1,);
    }
}
