
{# debug is a template that is included in the base templates of BSIK #} 
{% include('debug.tpl') %}

<div class='container'>
    <span>Bye {{ name ?? 'User' }} from SIKTEC</span>
</div>