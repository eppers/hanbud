{% extends 'layout.php' %}

{% block content %} 
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading"><h1>{% if form=='edit' %}Edytuj{% else %}Dodaj{% endif %} pozycję</h1></div>


<table border="0" width="100%" cellpadding="0" cellspacing="0" id="content-table">
<tr>
	<th rowspan="3" class="sized"><img src="/public/admin/img/shared/side_shadowleft.jpg" width="20" height="300" alt="" /></th>
	<th class="topleft"></th>
	<td id="tbl-border-top">&nbsp;</td>
	<th class="topright"></th>
	<th rowspan="3" class="sized"><img src="/public/admin/img/shared/side_shadowright.jpg" width="20" height="300" alt="" /></th>
</tr>
<tr>
	<td id="tbl-border-left"></td>
	<td>
	<!--  start content-table-inner -->
	<div id="content-table-inner">
	
	<table border="0" width="100%" cellpadding="0" cellspacing="0">
	<tr valign="top">
	<td>
        {% if error is defined %}
            {% include 'error.php' %}
        {% endif %}
		<!-- start id-form -->
   <form name="site-form" action="{% if form=='edit' %}/admin/offer/edit/{{foto.foto_id}} {% else %} /admin/offer/add {% endif %}" method="post" enctype="multipart/form-data">        
       
       
        <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
                <tr>
                    <th valign="top">Pozycja:</th>
                    <td><input type="text" name="pos" class="inp-form" value="{{foto.pos}}"/></td>
                    <td></td>
                </tr>	
                <tr>
                    <th valign="top">Opis (alt) obrazka:</th>
                    <td><input type="text" name="alt" class="inp-form" value="{{foto.alt}}"/></td>
                    <td></td>
                </tr>
                {% if(form=='edit') %}
                <tr>
                    <th valign="top">Obrazek:</th>
                    <td><img src="/public/img/{% if foto.img is not empty %}gallery/thumbs/{{ foto.img }}{% else %}no_thumb.jpg{% endif %}" ></td>
                </tr>
                {% else %}
                <tr>
                    <th valign="top">Wybierz obrazek:<br /><span style="font-size: 11px;">(MAX 2mb; jpg, gif, png)</span></th>
                    <td><input type="file" name="file" class="file_1" /></td>
                </tr>
                {% endif %}
                <tr>
                    <th valign="top">Opis realizacji:</th>
                    <td>
                        <div class="control-group">
                                <div class="controls">
                                    <textarea class="cleditor" id="textarea2" name="desc" rows="3">{{foto.desc}}</textarea>
                                </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>&nbsp;</th>
                    <td valign="top">
                            <button type="submit" class="btn btn-primary" >Zapisz</button>
                            <input type="reset" value="" class="form-reset"  />
                    </td>
                    <td></td>
                </tr>
	</table>
	<!-- end id-form  -->

    </form>
	</td>
	<td>

</td>
</tr>
<tr>
<td><img src="/public/admin/img/shared/blank.gif" width="695" height="1" alt="blank" /></td>
<td></td>
</tr>
</table>
 
<div class="clear"></div>
 

</div>
<!--  end content-table-inner  -->
</td>
<td id="tbl-border-right"></td>
</tr>
<tr>
	<th class="sized bottomleft"></th>
	<td id="tbl-border-bottom">&nbsp;</td>
	<th class="sized bottomright"></th>
</tr>
</table>









 





<div class="clear">&nbsp;</div>

</div>
<!--  end content -->
<div class="clear">&nbsp;</div>
</div>
<!--  end content-outer -->
{% endblock %}