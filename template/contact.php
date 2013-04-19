{% extends 'layout.php' %}

{% block page_title %}Strona główna{% endblock %}
{% block content %}
<article>
	<h1 class="content-header">Strona główna</h1>

	<div class="contact-box">
		<div class="contact-col-left">
			<p>
                            F.H.U. HAN-BUD Adrian Pawlisz<br/>
                            <br/>
                            Mazańcowice 57<br/>
                            <br/>
                            43-391 Mazańcowice <br/>
                            <br/>
                            <br/>
                            tel. kom 789-451-307<br/>
                            <br />
                            tel. / fax 33-815-50-13<br />
                            <br />
                            email: hanbudbielsko@gmail.com
                        </p>
		</div>
		
		<div class="contact-col-right">
			<p>Mapa dojazdowa:</p>
                        <div id="google-map"></div>
		</div>
	</div>
</article>
{% endblock %}