{% extends 'layout.php' %}

{% block page_title %}Lista kategorii{% endblock %}
{% block content %} 
<!-- start content-outer ........................................................................................................................START -->
<div id="content-outer">
<!-- start content -->
<div id="content">

	<!--  start page-heading -->
	<div id="page-heading">
		<h1>Kategorie produktów</h1>
	</div>
	<!-- end page-heading -->
        <a href="/admin/catalog/category/add" id="add-program" class="btn btn-large btn-primary">Dodaj kategorię</a>
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
		<!--  start content-table-inner ...................................................................... START -->
		<div id="content-table-inner">
		
			<!--  start table-content  -->
			<div id="table-content">
                                

				<!--  start product-table ..................................................................................... -->
				<form id="mainform" action="">
				<table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
				<tr>
					<th class="table-header-check"><a id="toggle-all" ></a> </th>
					<th class="table-header-repeat line-left minwidth-1"><a href="">Nazwa grupy</a></th>
                                        <th class="table-header-repeat line-left minwidth-1"><a href="">Pozycja grupy</a></th>
                                        <th class="table-header-options line-left"><a href="">Options</a></th>
				</tr>
                           {% for category in categories %}
                            <tr {% if loop.index is divisibleby(2) %} class="alternate-row" {% endif %} >
                                    <td><input  type="checkbox"/></td>
                                    <td>{{ category.name }}</td>
                                    <td>{{ category.pos }}</td>
                                    <td class="options-width">
                                    <a href="/admin/catalog/category/edit/{{ category.cat_id }}" title="Edit" class="icon-1 info-tooltip"></a>
                                    <a href="/admin/catalog/category/delete/{{ category.cat_id }}" title="Delete" class="icon-2 info-tooltip"></a>
                                    </td>
                            </tr>
                            {% else %}  
                                <tr><td><p>Brak kategorii</p></td></tr>
                        {% endfor %}

				
				</table>
				<!--  end product-table................................... --> 
				</form>
			</div>
			<!--  end content-table  -->
		
	
			
			<div class="clear"></div>
		 
		</div>
		<!--  end content-table-inner ............................................END  -->
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
<!--  end content-outer........................................................END -->
{% endblock %}