{% extends 'layout.php' %}

{% block page_title %}{{title}}{% endblock %}
{% block content %}
<article>
	<h1 class="content-header">{{site.name}}</h1>

	<div class="content-box">
		{% autoescape false %} 
                      {{ site.content|raw }}
                {% endautoescape %} 
	</div>
</article>
{% endblock %}