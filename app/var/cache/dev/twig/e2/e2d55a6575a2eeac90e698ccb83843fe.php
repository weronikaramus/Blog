<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* blog/index.html.twig */
class __TwigTemplate_72ea56908b0a604873b03f91ff144ee6 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "./base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "blog/index.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "blog/index.html.twig"));

        $this->parent = $this->loadTemplate("./base.html.twig", "blog/index.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 3
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 4
        echo "    
    
    <nav class=\"navbar navbar-expand-sm navbar-dark\">
      <a href=\"#\" class=\"navbar-brand\"><img src=\"logo.png\"></a>
      <button class=\"navbar-toggler\" data-toggle=\"collapse\" data-target=\"#navbar-menu\">
        <span class=\"navbar-toddler-icon\"></span>
      </button>
      <div class=\"collapse navbar-collapse\" id=\"navbar-menu\">
        <ul class=\"navbar-nav ml-auto\">
          <li class=\"nav-item\"><a href=\"\" class=\"nav-link\">New post</a></li>
          <li class=\"nav-item\"><a href=\"\" class=\"nav-link\">My posts</a></li>
          <li class=\"nav-item\"><a href=\"\" class=\"nav-link\">Settings</a></li>
        </ul>
    </div>

    </nav>
    
    <div class=\"main-container\">
\t\t\t<form
        id=\"search\"
        class=\"search-form\"
        action=\"search.php\"
        method=\"post\"
        autocomplete=\"on\"
      >
          
            <input
              type=\"search\"
              placeholder=\"Search\"
              id=\"search\"
              name=\"search\"
            />
          
\t\t\t\t</form>

            
\t\t</div>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

    }

    public function getTemplateName()
    {
        return "blog/index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  68 => 4,  58 => 3,  35 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends \"./base.html.twig\" %}

{% block body %}
    
    
    <nav class=\"navbar navbar-expand-sm navbar-dark\">
      <a href=\"#\" class=\"navbar-brand\"><img src=\"logo.png\"></a>
      <button class=\"navbar-toggler\" data-toggle=\"collapse\" data-target=\"#navbar-menu\">
        <span class=\"navbar-toddler-icon\"></span>
      </button>
      <div class=\"collapse navbar-collapse\" id=\"navbar-menu\">
        <ul class=\"navbar-nav ml-auto\">
          <li class=\"nav-item\"><a href=\"\" class=\"nav-link\">New post</a></li>
          <li class=\"nav-item\"><a href=\"\" class=\"nav-link\">My posts</a></li>
          <li class=\"nav-item\"><a href=\"\" class=\"nav-link\">Settings</a></li>
        </ul>
    </div>

    </nav>
    
    <div class=\"main-container\">
\t\t\t<form
        id=\"search\"
        class=\"search-form\"
        action=\"search.php\"
        method=\"post\"
        autocomplete=\"on\"
      >
          
            <input
              type=\"search\"
              placeholder=\"Search\"
              id=\"search\"
              name=\"search\"
            />
          
\t\t\t\t</form>

            
\t\t</div>
{% endblock %}", "blog/index.html.twig", "/home/wwwroot/app/templates/blog/index.html.twig");
    }
}
